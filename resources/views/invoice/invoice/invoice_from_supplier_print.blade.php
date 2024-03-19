@php
    $data = json_decode($data);
    $colspan = 5 + (isset($data->tax_option_data) && count($data->tax_option_data->component_array) > 0 ? count($data->tax_option_data->component_array) : 1);
@endphp
<!DOCTYPE html>
<html>

<head>
    <title>Invoice #{{ $data->invoice_number }}</title>
</head>

<body>



    <div class='mb-1rem'>
        <table class='w-100'>
            <tr>
                <td class='left'>
                    @if ($logo_path != '')
                        <img src="{{ $logo_path }}" class='h-50px' />
                    @endif
                </td>
                <td class="right">
                    <table class='w-50'>
                        <tr>
                            <td>
                                <div class='display-block left'>Invoice No:</div>

                            </td>
                            <td>
                                <div class="bold">
                                    {{ $data->invoice_number }}</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class='display-block'>Reference No:</div>

                            </td>
                            <td>
                                <div class="bold"> {{ $data->invoice_reference }}</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class='display-block'>Invoice Date:</div>

                            </td>
                            <td class="bold">
                                {{ $data->invoice_date }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class='display-block'>Invoice Due Date:</div>

                            </td>
                            <td>
                                <div class="bold"> {{ $data->invoice_due_date }}</div>
                            </td>
                        </tr>

                    </table>

                </td>

            </tr>
        </table>
    </div>

    <table class='w-100 mb-1rem'>
        <tr>
            <td class='v-top w-50 pr-20px'>
                <div class='bold display-block'>Invoice From </div>
                <div class='display-block'>Supplier</div>
                <div>
                    {{ $data->bill_from_address }}
                    
                </div>
                    <div>Email: {{ $data->bill_from_email }}</div>
                    <div>Contact: {{ $data->bill_from_contact }}</div>
                </div>
            </td>
            <td class='v-top w-50 pr-20px'>
                <div class='bold display-block'>Invoice To </div>
                <div class='display-block'>{{ $data->bill_to_name }} @if ($data->bill_to_code != '')
                        ({{ $data->bill_to_code }})
                    @endif
                </div>
                <div class='pr-100px'>
                    {{ $data->bill_to_address }}
                    @if ($data->bill_to_email != '')
                        Email: {{ $data->bill_to_email }}
                    @endif
                    @if ($data->bill_to_contact != '')
                        Contact No: {{ $data->bill_to_contact }}
                    @endif
                </div>
            </td>
        </tr>
    </table>
    <div class="invoice-head center">
        <h2>GST INVOICE</h2>
    </div>

    <div class="mb-1rem">
        <table class="w-100 product-table mb-1rem">
            <thead>
                <tr>
                    <th class="left">#</th>
                    <th class="left">Product Description</th>
                    <th class="right">Qty</th>
                    <th class="right">Price (EXCL Tax)</th>
                    <th class="right">Discount</th>

                    @if (isset($data->tax_option_data) && count($data->tax_option_data->component_array) > 0)
                        @foreach ($data->tax_option_data->component_array as $component_array_key => $component_array_item)
                            <th class="right">{{ $component_array_item }}</th>
                        @endforeach
                    @else
                        <th class="right">Tax</th>
                    @endif

                    <th class="right">Total</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data->products as $item_key => $invoice_products)
                    <tr v-for="(po_product, key, index) in products" v-bind:value="$invoice_products->product_slack"
                        v-bind:key="index">
                        <td>{{ $item_key + 1 }}</td>
                        <td>{{ $invoice_products->product_code != '' ? $invoice_products->product_code . ' - ' : '' }}{{ $invoice_products->name }}
                        </td>
                        <td class="right">{{ $invoice_products->quantity }}</td>
                        <td class="right">{{ $invoice_products->amount_excluding_tax }}</td>
                        <td class="right">
                            {{ $invoice_products->discount_amount }}<br>({{ $invoice_products->discount_percentage }}%)
                        </td>

                        @if (isset($data->tax_option_data) && count($data->tax_option_data->component_array) > 0)
                            @foreach ($data->tax_option_data->component_array as $component_array_key => $component_array_item)
                                <td class="right">{{ $invoice_products->tax_component_array->$component_array_item }}
                                </td>
                            @endforeach
                        @else
                            <td class="right">
                                {{ $invoice_products->tax_amount }}<br>({{ $invoice_products->tax_percentage }}%)</td>
                        @endif

                        <td class="right">{{ $invoice_products->subtotal_amount_excluding_tax }}</td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="{{ $colspan }}" class="right">Sub Total (EXCL Tax)</td>
                    <td class="right">{{ $data->subtotal_excluding_tax }}</td>
                </tr>
                <tr>
                    <td colspan="{{ $colspan }}" class="right">Total Discount</td>
                    <td class="right">{{ $data->total_discount_amount }}</td>
                </tr>
                <tr>
                    <td colspan="{{ $colspan }}" class="right">Total After Discount</td>
                    <td class="right">{{ $data->total_after_discount }}</td>
                </tr>
                <tr>
                    <td colspan="{{ $colspan }}" class="right">Total Tax</td>
                    <td class="right">{{ $data->total_tax_amount }}</td>
                </tr>
                <tr>
                    <td colspan="{{ $colspan }}" class="right">Shipping Charge</td>
                    <td class="right">{{ $data->shipping_charge }}</td>
                </tr>
                <tr>
                    <td colspan="{{ $colspan }}" class="right">Packaging Charge</td>
                    <td class="right">{{ $data->packing_charge }}</td>
                </tr>
                <tr>
                    <td colspan="{{ $colspan }}" class="right bold">Total (INCL Tax)</td>
                    <td class="right bold">{{ $data->total_order_amount }}</td>
                </tr>
            </tbody>
        </table>
        @if ($data->currency_code != '')
            <div>
                <small>All prices are in {{ $data->currency_name }} ({{ $data->currency_code }})</small>
            </div>
        @endif
    </div>

    @if ($data->words != '')
        <div class="mb-1rem">
            <div class='bold display-block'>In Words</div>
            <pre>{{ $data->words }}</pre>
        </div>
    @endif

    @if ($data->terms != '')
        <div class="mb-1rem">
            <div class='bold display-block'>Terms & Conditions</div>
            <pre>{{ $data->terms }}</pre>
        </div>
    @endif
    <div class="col6 bold">
        <h3>Recieved By:</h3>
        <hr>
        
            <div><h3>Name:</h3><div><hr></div></div>
            
        
        
        
            
            <div><h3>Signature:</h3><div><hr></div></div>
           
        
        
    </div>
    

        
    
    <div class='col12 center'>
        <div class='display-block'>Thank You!</div>
    </div>

</body>

</html>