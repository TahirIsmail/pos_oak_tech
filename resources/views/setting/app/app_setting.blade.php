@extends('layouts.layout')

@section("content")
<appsettingcomponent :app_setting="{{ json_encode($setting_data) }}" :contact_person="{{ json_encode($contact_person) }}" :customer="{{ json_encode($customer) }}" :supplier={{ json_encode($supplier) }} ></appsettingcomponent>
@endsection