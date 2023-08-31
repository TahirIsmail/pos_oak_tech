@extends('layouts.layout')

@section("content")
<addstaffleave :users="{{ json_encode($users) }}" :leave_types="{{ json_encode($leave_types) }}"></addstaffleave>
@endsection