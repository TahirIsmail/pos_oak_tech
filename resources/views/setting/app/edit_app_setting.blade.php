@extends('layouts.layout')

@section("content")
<editappsettingcomponent :date_time_formats ="{{ json_encode($date_time_formats) }}" :company_contact_person="{{ json_encode($contact_person) }}" :date_formats ="{{ json_encode($date_formats) }}" :users="{{ json_encode($users) }}" :setting_data="{{ json_encode($setting_data) }}" :timezones="{{ json_encode($timezones) }}" :deactivation_eligible="{{ json_encode($deactivation_eligible) }}" :chost="{{ json_encode($chost) }}" :cip="{{ json_encode($cip) }}" ></editappsettingcomponent>
@endsection