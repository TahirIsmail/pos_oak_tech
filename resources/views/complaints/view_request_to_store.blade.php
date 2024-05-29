@extends('layouts.layout')
@section('content')
<viewrequeststore  :out_source_items="{{ json_encode($out_source_items) }}"  :complaint="{{ json_encode($complaint) }}" :request_to_store="{{ json_encode($requestToStore) }}" ></viewrequeststore>
@endsection