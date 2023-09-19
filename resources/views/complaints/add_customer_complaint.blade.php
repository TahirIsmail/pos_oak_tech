@extends('layouts.layout')
@section('content')

<add-customer-complaint-component @if($selectedComplaintId) :selectedComplaintId="{{ $selectedComplaintId }}" @endif :complaints_data = "{{json_encode($complaints_data)}}" :customer_list = "{{json_encode($customers_list)}}" ></add-customer-complaint-component>

@endsection