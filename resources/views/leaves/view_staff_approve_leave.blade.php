@extends('layouts.layout')

@section("content")
<viewstaffapproveleave :staff_leave_data="{{ json_encode($staff_leave_data) }}" :approve_access="{{ json_encode($approve_access) }}"></viewstaffapproveleave>
@endsection