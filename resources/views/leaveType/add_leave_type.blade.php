@extends('layouts.layout')

@section("content")
<addleavetype :statuses="{{ json_encode($statuses) }}" :leave_type_data="{{ json_encode($leave_type_data) }}"></addleavetype>
@endsection