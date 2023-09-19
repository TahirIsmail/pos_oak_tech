@extends('layouts.layout')

@section("content")
<addcustomercomponent :statuses="{{ json_encode($statuses) }}" :stores="{{ json_encode($stores) }}" :customer_data="{{ json_encode($customer_data) }}"></addcustomercomponent>
@endsection