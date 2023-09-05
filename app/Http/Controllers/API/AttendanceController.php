<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\StaffAttendanceType;
use App\Models\StaffAttendance;
use App\Models\User;
use Illuminate\Http\Request;

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

            // $attendance_date = $request->attendance_date;
            
            $attendance_date = \Carbon\Carbon::parse($request->input('attendance_date'))->format('Y-m-d');

            $staff_attendance_types = StaffAttendanceType::all();
            $staff_list = User::with('role')->where('role_id', $request->staff_role)->get();
            $staffIds = $staff_list->pluck('id')->toArray();
            
            $already_mark_attendance = StaffAttendance::whereIn('staff_id', $staffIds)
            ->where('date', '=', $attendance_date)
            ->get();

            dd($already_mark_attendance);


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

            $attendance_date = json_decode($request->input('attendance_date'));
            $staffAttendanceData = json_decode($request->input('staffAttendanceData'));

            foreach ($staffAttendanceData as $attendanceRecord) {
                $staffId = $attendanceRecord->staff_id;
                $attendanceTypeId = $attendanceRecord->attendance_type_id;
                $note = $attendanceRecord->note;

                $staff_attendance_store = StaffAttendance::create([
                    'slack' => $this->generate_slack("staff_attendances"), // Replace with the actual value
                    'store_id' => $request->logged_user_store_id, // Replace with the actual value
                    'date' => $attendance_date,
                    'staff_id' => $staffId,
                    'staff_attendance_type_id' => $attendanceTypeId,
                    'remark' => $note, // Use the note as the remark, or adjust as needed
                    'status' => 0, // Set the status as needed
                ]);
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
