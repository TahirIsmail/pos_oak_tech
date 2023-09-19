@extends('layouts.layout')
@section('content')

<add-customer-complaint-component @if($selectedComplaintId) :selected-complaint-id="{{ $selectedComplaintId }}" @endif :complaint_data = "{{json_encode($complaints_data)}}" :customer_list = "{{json_encode($customers_list)}}" :user_list = "{{json_encode($users_list)}}"></add-customer-complaint-component>

@endsection