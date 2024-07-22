@extends('layouts.layout')

@section("content")
<addoutsourcevendorcomponent :roles="{{ json_encode($roles) }}" :users="{{ json_encode($users) }}" :statuses="{{ json_encode($statuses) }}" :stores="{{ json_encode($stores) }}"  :user_data="{{ json_encode($user_data) }}"></addoutsourcevendorcomponent>
@endsection