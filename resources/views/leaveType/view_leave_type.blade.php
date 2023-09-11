@extends('layouts.layout')

@section("content")
<viewleavetype :leave_type_data="{{ json_encode($leave_type) }}" :delete_access="{{ json_encode($delete_access) }}"></viewleavetype>
@endsection