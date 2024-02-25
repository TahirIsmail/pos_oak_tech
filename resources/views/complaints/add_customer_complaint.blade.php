@extends('layouts.layout')
@section('content')

<add-customer-complaint-component :is_customer="{{ json_encode($is_customer) }}" :lab_engineers="{{ json_encode($lab_engineers) }}" :complaints_data = "{{json_encode($complaints_data)}}" :equipment_types="{{ json_encode($equipment_types) }}" :customer_slack="{{ json_encode($customer_slack) }}"></add-customer-complaint-component>

@endsection