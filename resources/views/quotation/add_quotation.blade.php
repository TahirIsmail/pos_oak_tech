@extends('layouts.layout')

@section("content")
<addquotationcomponent :is_supplier="{{ json_encode($is_supplier) }}" :currency_list="{{ json_encode($currency_list) }}" :quotation_data="{{ json_encode($quotation_data) }}" :tax_options="{{ json_encode($tax_options) }}"></addquotationcomponent>
@endsection