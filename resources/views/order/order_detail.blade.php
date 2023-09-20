@extends('layouts.layout')

@section("content")
<orderdetailcomponent :payment_methods="{{ json_encode($payment_methods) }}" :default_business_account="{{ json_encode($default_business_account) }}" :business_accounts="{{ json_encode($business_accounts) }}" :total_received_amount="{{ json_encode($total_received_amount) }}" :order_data="{{ json_encode($order_data) }}" :delete_order_access="{{ json_encode($delete_order_access) }}" :share_invoice_sms_access="{{ json_encode($share_invoice_sms_access) }}" :merge_order_access="{{ json_encode($merge_order_access) }}" :unmerge_order_access="{{ json_encode($unmerge_order_access) }}" :print_order_link="{{ json_encode($print_order_link) }}" :print_kot_link="{{ json_encode($print_kot_link) }}" :printnode_enabled="{{ json_encode($printnode_enabled) }}"></orderdetailcomponents>
@endsection