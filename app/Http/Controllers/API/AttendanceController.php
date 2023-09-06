<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\StaffAttendanceType;
use App\Models\StaffAttendance;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            if (!check_access(['A_ADD_STAFF_ATTENDANCE'], true)) {
                throw new Exception("Invalid request", 400);
            }

            

           

            $attendance_date = $request->attendance_date;
            // dd($attendance_date);
            $attendance_date = str_replace('"', '', $attendance_date); // Remove the extra quotes
            $attendance_date = Carbon::parse($attendance_date)->toDateTimeString();


            $staff_attendance_types = StaffAttendanceType::all();

            if(!is_numeric($request->staff_role)){

                $staff_list = User::with('role')->get();
                
            }
            else{

                $staff_list = User::with('role')->where('role_id', $request->staff_role)->get();
            }

            $staffIds = $staff_list->pluck('id')->toArray();


            $already_mark_attendance = StaffAttendance::whereIn('staff_id', $staffIds)
                ->where('date', '=', $attendance_date)
                ->get();

            if ($already_mark_attendance) {
                $data['already_mark_staff_attendance'] = $already_mark_attendance;
            } else {
                $data['already_mark_staff_attendance'] = null;
            }

            // dd($data['already_mark_staff_attendance']);
            $data['staff_attendance_types'] = $staff_attendance_types;
            $data['staff_list'] = $staff_list;
            $data['staff_attendance_date'] = $attendance_date;

            $html = view('staff_attendance.staff_attendance_list_render', $data)->render();



            return response()->json($this->generate_response(
                array(
                    "message" => "Staff details loaded successfully",
                    "data"    => $data,
                ),
                'SUCCESS'
            ));
        } catch (Exception $e) {
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            if (!check_access(['A_ADD_STAFF_ATTENDANCE'], true)) {
                throw new Exception("Invalid request", 400);
            }


            // dd($request->all());

            $attendance_date = json_decode($request->input('attendance_date'));
            $staffAttendanceData = json_decode($request->input('staffAttendanceData'));

            foreach ($staffAttendanceData as $attendanceRecord) {
                $staff_attendance_id = $attendanceRecord->staff_attendance_id;


                $staffId = $attendanceRecord->staff_id;
                $attendanceTypeId = $attendanceRecord->attendance_type_id;
                $note = $attendanceRecord->note;

                if ($staff_attendance_id) {
                    $staffAttendance = StaffAttendance::find($staff_attendance_id);
                    if ($staffAttendance) {
                        $staff_attendance_store = $staffAttendance->update([
                            'date' => $attendance_date,
                            'staff_id' => $staffId,
                            'staff_attendance_type_id' => $attendanceTypeId,
                            'remark' => $note,
                        ]);
                    } 
                }
                    else {
                        // dd($staffId, $attendance_date);
                        $staff_attendance_store = StaffAttendance::create([
                            'slack' => $this->generate_slack("staff_attendances"),
                            'store_id' => $request->logged_user_store_id,
                            'date' => $attendance_date,
                            'staff_id' => $staffId,
                            'staff_attendance_type_id' => $attendanceTypeId,
                            'remark' => $note,
                            'status' => 0,
                        ]);
                    }
                
            }


            return response()->json($this->generate_response(
                array(
                    "message" => "Staff Attendance Mark Successfully",
                    "data"    => $staff_attendance_store,
                ),
                'SUCCESS'
            ));
        } catch (Exception $e) {
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
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
    public function destroy($id)
    {
        //
    }
}
