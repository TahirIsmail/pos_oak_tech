@extends('layouts.layout')

@section("content")
<customerdetailcomponent :child_customers="{{ json_encode($child_customers) }}" :customer_data="{{ json_encode($customer_data) }}" :delete_access="{{ json_encode($delete_access) }}"></customerdetailcomponent>
@endsection