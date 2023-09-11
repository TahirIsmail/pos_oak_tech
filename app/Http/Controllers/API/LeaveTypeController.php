<?php

namespace App\Http\Controllers\API;



use App\Http\Controllers\Controller;
use App\Http\Resources\Collections\SupplierCollection;
use App\Http\Resources\SupplierResource;
use App\Models\Leave;
use App\Models\User;
use App\Models\LeaveType;
use App\Models\Supplier as SupplierModel;
use App\Models\SupplierPerformance;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DataTables;

use Validator;

class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $slack = null)
    {

        try {

            if (!check_access(['A_ADD_LEAVE_TYPE'], true)) {
                throw new Exception("Invalid request", 400);
            }

            if ($slack == null) {

                $this->validate_request($request);

                $leave_type_data_exists = LeaveType::select('id')
                    ->where('type', '=', trim($request->leave_type))
                    ->first();
                if (!empty($leave_type_data_exists)) {
                    throw new Exception("Supplier already exists", 400);
                }

                // dd($request->all());


                DB::beginTransaction();

                $leave_type = [
                    "slack" => $this->generate_slack("leave_types"),
                    "type" => $request->leave_type,
                    "store_id" => $request->logged_user_store_id,
                    "status" => $request->status,
                ];

                $leave_type_id = LeaveType::create($leave_type)->id;


                DB::commit();

                return response()->json($this->generate_response(
                    array(
                        "message" => "Supplier created successfully",
                        "data" => $leave_type['slack'],
                    ),
                    'SUCCESS'
                ));
            } else {
                $leave_type = [
                    "type" => $request->leave_type,
                    "status" => $request->status,
                ];
                $conditions = [
                    "slack" => $slack,
                ];
                $leave_type_update = LeaveType::updateOrInsert($conditions, $leave_type);
                if ($leave_type_update) {
                    return response()->json($this->generate_response(
                        array(
                            "message" => "Leave Type Update successfully",
                            "data" => $leave_type_update,
                            'msg' => 'success',
                        ),
                        'SUCCESS'
                    ));
                }
            }
        } catch (Exception $e) {
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode(),
                )
            ));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $slack)
    {
        try {
            if (!check_access(['A_DELETE_LEAVE_TYPE'], true)) {
                throw new Exception("Invalid request", 400);
            }

            $leave_type = LeaveType::select('id')->where('slack', $slack)->first();
            if (empty($leave_type)) {
                throw new Exception("Invalid leave type provided", 400);
            }
            $leave_type_id = $leave_type->id;

            DB::beginTransaction();

            LeaveType::where('id', $leave_type_id)->delete();

            DB::commit();

            $forward_link = route('leave_type');

            return response()->json($this->generate_response(
                array(
                    "message" => "Supplier deleted successfully",
                    "data" => $slack,
                    "link" => $forward_link,
                ),
                'SUCCESS'
            ));
        } catch (Exception $e) {
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode(),
                )
            ));
        }
    }




    // leaves apply listing and view delete functions here 

    public function leaves_listing(Request $request)
    {
        $data['action_key'] = 'A_LISTING_LEAVES';

        if (check_access(array($data['action_key']), true) == false) {
            $response = $this->no_access_response_for_listing_table();
            return $response;
        }

        if ($request->ajax()) {
            $data = Leave::with('staff', 'lineManager', 'leaveType', 'appliedBy')->where('staff_id', $request->logged_user_id)->get();

            // dd($data);

            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('leave_type_id', function ($row) {
                    $output = $row['leaveType']->type;
                    return $output;
                })

                ->addColumn('staff_id', function ($row) {
                    $output = $row['staff']->fullname . ' (' . $row['staff']->user_code . ')';
                    return $output;
                })

                ->addColumn('line_manager', function ($row) {
                    $output = $row['linemanager']->fullname . ' (' . $row['linemanager']->user_code . ')';
                    return $output;
                })

                ->addColumn('applied_by', function ($row) {
                    $output = $row['appliedBy']->fullname . ' (' . $row['appliedBy']->user_code . ')';
                    return $output;
                })

                ->addColumn('action', function ($row) {
                    $data['supplier'] = $row;
                    return view('leaves.layout.leave_type_action', $data)->render();
                })
                ->rawColumns(['staff_id', 'line_manager', 'leave_type_id','applied_by', 'action'])
                ->make(true);
        }
    }



    public function approve_leaves_listing(Request $request)
    {
        $data['action_key'] = 'A_LISTING_APPROVE_LEAVES';

        if (check_access(array($data['action_key']), true) == false) {
            $response = $this->no_access_response_for_listing_table();
            return $response;
        }

        if ($request->ajax()) {
            if($request->logged_user_role_id == 1){
                $data = Leave::with('staff', 'lineManager', 'leaveType')->get();

            }
            else{
                $data = Leave::with('staff', 'lineManager', 'leaveType')->where('line_manager', $request->logged_user_id)->get();
            }

            // dd($data);

            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('leave_type_id', function ($row) {
                    $output = $row['leaveType']->type;
                    return $output;
                })

                ->addColumn('staff_id', function ($row) {
                    $output = $row['staff']->fullname . ' (' . $row['staff']->user_code . ')';
                    return $output;
                })

                ->addColumn('line_manager', function ($row) {
                    $output = $row['linemanager']->fullname . ' (' . $row['linemanager']->user_code . ')';
                    return $output;
                })

                ->addColumn('action', function ($row) {
                    $data['supplier'] = $row;
                    return view('leaves.layout.approve_leave_actions', $data)->render();
                })
                ->rawColumns(['staff_id', 'line_manager', 'leave_type_id', 'action'])
                ->make(true);
        }
    }


    public function add_staff_leave(Request $request, $slack = null)
    {
        try {

            if (!check_access(['A_ADD_LEAVES'], true)) {
                throw new Exception("Invalid request", 400);
            }

            // dd($slack);

            if ($slack == null) {

                $this->validate_staff_leave_request($request);

                $line_manager = User::where('id', $request->logged_user_id)->get()->toArray();

                $startDate = new \DateTime($request->from_date);
                $endDate = new \DateTime($request->from_to);

                if ($startDate == $endDate) {
                    $numberOfDays = 1; // Same date, so 1 day of leave
                } else {
                    $interval = $startDate->diff($endDate);
                    $numberOfDays = $interval->days;
                }


                // dd($request->logged_user_id);
               

                DB::beginTransaction();

                $leave = [

                    "slack" => $this->generate_slack("leaves"),
                    "store_id" => $request->logged_user_store_id,
                    "staff_id" => $request->logged_user_id,
                    "line_manager" => $line_manager[0]['line_manager'],
                    "leave_type_id" => $request->leave_type,
                    "leave_from" => $request->from_date,
                    "leave_to" => $request->from_to,
                    "apply_date" => $request->apply_date,
                    "leave_days" => $numberOfDays,
                    "employee_remarks" => $request->reason,
                    "leave_status" => 'Pending',
                    "applied_by" => $request->logged_user_id
                ];

                $leave_type_id = Leave::create($leave)->id;


                DB::commit();

                return response()->json($this->generate_response(
                    array(
                        "message" => "Staff Leave created successfully",
                        "data" => $leave['slack'],
                    ),
                    'SUCCESS'
                ));
            }


            else{

                $this->validate_staff_leave_request($request);
                $startDate = new \DateTime($request->from_date);
                $endDate = new \DateTime($request->from_to);

                if ($startDate == $endDate) {
                    $numberOfDays = 1; // Same date, so 1 day of leave
                } else {
                    $interval = $startDate->diff($endDate);
                    $numberOfDays = $interval->days;
                }

                $leave = [
                    "leave_type_id" => $request->leave_type,
                    "leave_from" => $request->from_date,
                    "leave_to" => $request->from_to,
                    "apply_date" => $request->apply_date,
                    "leave_days" => $numberOfDays,
                    "employee_remarks" => $request->reason,
                    "applied_by" => $request->logged_user_id
                ];

                $staff_leave = Leave::where('slack', $slack)
                ->update($leave);

                if($staff_leave){
                    return response()->json($this->generate_response(
                        array(
                            "message" => "Staff Leave updated successfully",
                            "data" => $leave,
                        ),
                        'SUCCESS'
                    ));
                }



            }


        } catch (Exception $e) {
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode(),
                )
            ));
        }
    }



    public function validate_request($request)
    {
        $validator = Validator::make($request->all(), [
            'leave_type' => $this->get_validation_rules("leave_type", true),

        ]);
        $validation_status = $validator->fails();
        if ($validation_status) {
            throw new Exception($validator->errors());
        }
    }


    public function validate_staff_leave_request($request)
    {
        $validator = Validator::make($request->all(), [
            'apply_date' => $this->get_validation_rules("Apply Leave", true),
            'from_date' => $this->get_validation_rules("from_date", true),
            'from_to' => $this->get_validation_rules("from_to", true),
            'leave_type' => $this->get_validation_rules("Leave Type", true),

        ]);
        $validation_status = $validator->fails();
        if ($validation_status) {
            throw new Exception($validator->errors());
        }
    }

    public function delete_staff_leave($slack){
        try {
            if (!check_access(['A_DELETE_LEAVES'], true)) {
                throw new Exception("Invalid request", 400);
            }

            $leave = Leave::select('id')->where('slack', $slack)->first();
            if (empty($leave)) {
                throw new Exception("Invalid leave provided", 400);
            }
            $leave_id = $leave->id;

            DB::beginTransaction();

            Leave::where('id', $leave_id)->delete();

            DB::commit();

            $forward_link = route('leave_listing');

            return response()->json($this->generate_response(
                array(
                    "message" => "Leave deleted successfully",
                    "data" => $slack,
                    "link" => $forward_link,
                ),
                'SUCCESS'
            ));
        } catch (Exception $e) {
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode(),
                )
            ));
        }
    }


    public function approve_staff_leave_status(Request $request, $slack){
        try {

            if (!check_access(['A_APPROVE_STAFF_LEAVES'], true)) {
                throw new Exception("Invalid request", 400);
            }

            if ($slack) {

                $this->validate_approve_staff_leave_request($request);

                $approve_leave = [
                    "leave_status" => $request->leave_status,                   
                    "admin_remarks" => $request->admin_remarks,
                    "approved_by" => $request->logged_user_id,
                ];
               
                $staff_leave = Leave::where('slack', $slack)
                ->update($approve_leave);

                if($staff_leave){
                    return response()->json($this->generate_response(
                        array(
                            "message" => "Staff Leave approved successfully",
                            "data" => $approve_leave,
                        ),
                        'SUCCESS'
                    ));
                }



            }


        } catch (Exception $e) {
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode(),
                )
            ));
        }
    }

    public function validate_approve_staff_leave_request($request)
    {
        $validator = Validator::make($request->all(), [
            'admin_remarks' => $this->get_validation_rules("admin_remarks", true),

        ]);
        $validation_status = $validator->fails();
        if ($validation_status) {
            throw new Exception($validator->errors());
        }
    }
}
