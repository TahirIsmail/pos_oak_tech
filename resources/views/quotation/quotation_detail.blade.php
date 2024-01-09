@extends('layouts.layout')

@section("content")
<quotationdetailcomponent :is_customer="{{ json_encode($is_customer) }}" :is_supplier={{ json_encode($is_supplier) }} :quotation_statuses="{{ json_encode($quotation_statuses) }}" :quotation_data="{{ json_encode($quotation_data) }}" :delete_quotation_access="{{ json_encode($delete_quotation_access) }}" :printnode_enabled="{{ json_encode($printnode_enabled) }}"></quotationdetailcomponent>
@endsection