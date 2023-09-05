@extends('layouts.layout')

@section('content')
<staffattendancecomponent :roles_data="{{ json_encode($roles_data) }}"></staffattendancecomponent>

@endsection
