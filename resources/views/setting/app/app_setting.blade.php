@extends('layouts.layout')

@section("content")
<appsettingcomponent :app_setting="{{ json_encode($setting_data) }}" :contact_person="{{ json_encode($contact_person) }}" ></appsettingcomponent>
@endsection