@extends('layouts.layout')

@section("content")
<supplierperformancedetailcomponent :supplier_data="{{ json_encode($supplier_data) }}" :delete_access="{{ json_encode($delete_access) }}"></supplierperformancedetailcomponent>
@endsection