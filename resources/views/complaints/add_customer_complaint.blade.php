@extends('layouts.layout')
@section('content')

<add-customer-complaint-component :lab_engineers="{{ json_encode($lab_engineers) }}" :complaints_data = "{{json_encode($complaints_data)}}" :equipment_types="{{ json_encode($equipment_types) }}"></add-customer-complaint-component>

@endsection