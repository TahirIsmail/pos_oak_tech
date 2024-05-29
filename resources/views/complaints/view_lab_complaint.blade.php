@extends('layouts.layout')
@section('content')
<viewlabcomplaint :user_data="{{ json_encode($user_data) }}" :is_customer="{{ json_encode($is_customer) }}" :out_source_items="{{ json_encode($out_source_items) }}" :is_lab_tech="{{ json_encode($is_lab_tech) }}" :complaint="{{ json_encode($complaint) }}" ></viewlabcomplaint>
@endsection