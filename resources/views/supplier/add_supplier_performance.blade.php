@extends('layouts.layout')

@section("content")
<addsupplierperformancecomponent :statuses="{{ json_encode($statuses) }}" :suppliers="{{ json_encode($suppliers) }}" ></addsupplierperformancecomponent>
@endsection