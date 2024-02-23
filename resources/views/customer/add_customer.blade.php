@extends('layouts.layout')

@section("content")
<addcustomercomponent :child_customers="{{ json_encode($child_customers) }}" :customer_roles="{{ json_encode($CustomerRoles) }}" :customer_type="{{ json_encode($customer_type) }}" :employers="{{ json_encode($employers) }}" :statuses="{{ json_encode($statuses) }}" :stores="{{ json_encode($stores) }}" :customer_data="{{ json_encode($customer_data) }}"></addcustomercomponent>
@endsection