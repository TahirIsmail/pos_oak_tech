@extends('layouts.layout')
@section('content')

<add-customer-side-complaint-component :assign_type="{{ json_encode($assign_type) }}" :is_customer="{{ json_encode($is_customer) }}" :lab_engineers="{{ json_encode($lab_engineers) }}" :complaints_data = "{{json_encode($complaints_data)}}" :equipment_types="{{ json_encode($equipment_types) }}" :customer_slack="{{ json_encode($customer_slack) }}"></add-customer-side-complaint-component>

@endsection