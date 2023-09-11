<div class="container mx-auto">
    <form ref="attendanceForm" @submit.prevent="submitAttendance" class="mb-3">
        <div class="w-100 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Save Attendance</button>
        </div>
    </form>
    <table class="table">
        <thead>
            <th>#</th>
            <th>Staff Name</th>
            <th>Staff Role</th>
            <th>Attendance</th>
            <th>Note</th>
        </thead>
        <tbody>
            @php $count = 1; @endphp
            @foreach ($staff_list as $staff)
            <tr>
                <td>{{ $count }}</td>
                <td>{{ $staff->fullname }} ({{ $staff->user_code }})</td>
                <td>{{ $staff->role->label }}</td>
                <td class="d-flex">
                    <input type="hidden" v-model="staffAttendanceData[{{ $count - 1 }}].staff_id" value="{{ $staff->id }}">
                    @foreach ($staff_attendance_types as $key => $type)
                    @php
                    $att_type = str_replace(' ', '_', strtolower($type['type']));
                    $inputName = "staff_attendance_type_{$staff->id}_{$type['id']}";
                    $inputId = "staff_attendance_type_{$staff->id}_{$type['id']}";
                    @endphp
                    <div class="radio radio-info radio-inline mx-4">
                        <input type="radio" :id="{{ $inputId }}" :name="{{ $inputName }}" :value="{{ $type['id'] }}" v-model="staffAttendanceData[{{ $count - 1 }}].attendance_type_id" />
                        <label :for="{{ $inputId }}">{{ $type['type'] }}</label>
                    </div>
                    @endforeach
                </td>
                <td><input type="text" v-model="staffAttendanceData[{{ $count - 1 }}].note"></td>
            </tr>
            @php $count++; @endphp
            @endforeach
            
        </tbody>
    </table>
</div>


