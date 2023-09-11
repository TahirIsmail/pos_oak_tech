@extends('layouts.layout')

@section("content")
<viewstaffleave :staff_leave_data="{{ json_encode($staff_leave_data) }}" :delete_access="{{ json_encode($delete_access) }}"></viewstaffleave>
@endsection