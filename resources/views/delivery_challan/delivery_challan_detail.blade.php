@extends('layouts.layout')

@section("content")
<delivery-challan-detail-component 
    :challan_data="{{ json_encode($invoice_data) }}"
    :challan_statuses="{{ json_encode($invoice_statuses) }}"
    :delete_challan_access="{{ json_encode($delete_invoice_access) }}"
    :printnode_enabled="{{ json_encode($printnode_enabled) }}"
>
</delivery-challan-detail-component>
@endsection