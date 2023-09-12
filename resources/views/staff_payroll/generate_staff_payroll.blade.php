@extends('layouts.layout')

@section('content')
    <generatestaffpayroll :staff_with_attendance="{{ json_encode($staff_with_attendance) }}" :profile_image="{{ json_encode($profile_image) }}" :attendance_records="{{ json_encode($attendance_records) }}" :month="{{ json_encode($month) }}" :year="{{ json_encode($year) }}"></generatestaffpayroll>
@endsection
