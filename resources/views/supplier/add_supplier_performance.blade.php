@extends('layouts.layout')

@section("content")
<addsupplierperformancecomponent :statuses="{{ json_encode($statuses) }}" @if($selectedSupplierId) :selected-supplier-id="{{ $selectedSupplierId }}" @endif :supplier_data="{{ json_encode($supplier_data) }}" :suppliers="{{ json_encode($suppliers) }}" ></addsupplierperformancecomponent>
@endsection