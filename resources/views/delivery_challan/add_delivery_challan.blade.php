@extends('layouts.layout')

@section("content")
<adddeliverychallancomponent 
    :currency_list="{{ json_encode($currency_list) }}" 
    :delivery_challan_data="{{ json_encode($delivery_challan_data) }}" 
    :tax_options="{{ json_encode($tax_options) }}" 
    :challan_type="{{ json_encode($challan_type) }}">
</adddeliverychallancomponent>
@endsection