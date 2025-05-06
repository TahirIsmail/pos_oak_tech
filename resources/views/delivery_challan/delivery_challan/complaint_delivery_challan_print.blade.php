@php
    $data = json_decode($data);
    // echo '<pre>'; print_r($data);echo '</pre>'; exit;
    $colspan = 5 + (isset($data->tax_option_data) && count($data->tax_option_data->component_array) > 0 ? count($data->tax_option_data->component_array) : 1);
@endphp
<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
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
                                <div class='display-block left'>Complaint Ticket:</div>

                            </td>
                            <td>
                                <div class="bold">
                                    {{ $data->ticket }}</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class='display-block'>Complaint Date:</div>

                            </td>
                            <td class="bold">
                                {{ $data->created_at }}
                            </td>
                        </tr>
                       
                      
                        <tr>
                            <td>
                                <div class='display-block'>Complaint Due Date:</div>

                            </td>
                            <td>
                                <div class="bold"> {{ $data->due_date }}</div>
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
                <div class='bold display-block'>Complaint From </div>
                <div class='display-block'>{{ $data->store_data->name }}</div>
                <div>
                    {{ $data->store_data->address }}
                    @if ($data->store_data->pincode != '')
                        Pincode: {{ $data->store_data->pincode }}
                    @endif
                </div>
                @if ($data->store_data->tax_number != '')
                    <div>GST: {{ $data->store_data->tax_number }}</div>
                @endif
                @if ($data->store_data->primary_email != '')
                    <div>Email 1: {{ $data->store_data->primary_email }}</div>
                @endif
                @if ($data->store_data->secondary_email != '')
                    <div>Email 2: {{ $data->store_data->secondary_email }}</div>
                @endif
                @if ($data->store_data->primary_contact != '')
                    <div>Contact No 1: {{ $data->store_data->primary_contact }}</div>
                @endif
                @if ($data->store_data->secondary_contact != '')
                    <div>Contact No 2: {{ $data->store_data->secondary_contact }}</div>
                @endif
                </div>
            </td>
            <td class='v-top w-50 pr-20px'>
                <div class='bold display-block'>Complaint To </div>
                {{-- <div class='display-block'>{{ $data->order->customer_name }} --}}
                </div>
                <div class='pr-100px'>
                  
                </div>
            </td>
        </tr>
    </table>
    {{-- <div class="invoice-head center">
        <h2>GST INVOICE</h2>
    </div> --}}

    <div class="mb-1rem">
        <table class="w-100 product-table mb-1rem">
            <thead>
                <tr>
                    <th class="left">#</th>
                    <th class="left">Product Description</th>
                    <th class="right">Qty</th>                  
                    <th class="right">Total</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data->link_to_product as $item_key => $invoice_products)
                    <tr v-for="(po_product, key, index) in products" v-bind:value="$invoice_products->product_slack"
                        v-bind:key="index">
                        <td>{{ $item_key + 1 }}</td>
                        <td class="center">{{ $invoice_products->product_code != '' ? $invoice_products->product_code . ' - ' : '' }}{{ $invoice_products->name }}
                        </td>
                        <td class="right">{{ $invoice_products->quantity }}</td>
                        <td class="right">{{ $invoice_products->sale_amount_excluding_tax }}</td>
                    </tr>
                @endforeach

               
            </tbody>
        </table>

        <table class="w-100 product-table mb-1rem">
            <thead>
                <tr>
                <th class="center">#</th>
                <th class="center">Charges Label</th>
                <th class="right">Charges Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->complaint_charges as $item_key => $invoice_charges)
                <tr>
    
                    <td class="center">{{ $item_key + 1 }}</td>
                    <td class="center">{{ $invoice_charges->charge_label }}</td>
                    <td class="right">{{ $invoice_charges->charge_price }}</td>
                </tr>            
                @endforeach
            </tbody>
        </table>



        {{-- @if ($data->currency_code != '') --}}
            <div>
                <small>All prices are in (RS.)</small>
            </div>
        {{-- @endif --}}
    </div>

    {{-- @if ($data->words != '')
        <div class="mb-1rem">
            <div class='bold display-block'>In Words</div>
            <pre>{{ $data->words }}</pre>
        </div>
    @endif --}}

    {{-- @if ($data->terms != '')
        <div class="mb-1rem">
            <div class='bold display-block'>Terms & Conditions</div>
            <pre>{{ $data->terms }}</pre>
        </div>
    @endif --}}
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
