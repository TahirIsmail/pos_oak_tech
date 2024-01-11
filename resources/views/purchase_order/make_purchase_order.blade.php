@extends('layouts.layout')

@section("content")
<makepurchaseordercomponent :is_customer="{{ json_encode($is_customer) }}" :currency_list="{{ json_encode($currency_list) }}" :quotation_data="{{ json_encode($quotation_data) }}" :tax_options="{{ json_encode($tax_options) }}"></makepurchaseordercomponent>
@endsection