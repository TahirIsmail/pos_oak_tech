@php 
    $data = json_decode($data); 
    $colspan = 5 + ((isset($data->tax_option_data) && count($data->tax_option_data->component_array) > 0) ? count($data->tax_option_data->component_array) : 1);
@endphp
<!DOCTYPE html>
<html>
    <head>
        <title>Delivery Challan #{{ $data->delivery_challan_number }}</title>
    </head>
    <body>
        <div class='mb-1rem'>
            <table class='w-100'>
                <tr>
                    <td class='left'>
                        @if ($logo_path != '')
                            <img src="{{ $logo_path }}" class='h-50px'/>
                        @endif
                    </td>
                    <td class="right">
                        <table class='w-50'>
                            <tr>
                                <td>
                                    <div class='display-block left'>Challan No:</div>
                                </td>
                                <td>
                                    <div class="bold">{{ $data->delivery_challan_number }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class='display-block'>Reference No:</div>
                                </td>
                                <td>
                                    <div class="bold">{{ $data->delivery_challan_reference }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class='display-block'>Challan Date:</div>
                                </td>
                                <td class="bold">
                                    {{ $data->delivery_challan_date }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class='display-block'>Challan Due Date:</div>
                                </td>
                                <td>
                                    <div class="bold">{{ $data->delivery_due_date }}</div>
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
                    <div class='bold display-block'>From </div>
                    <div class='display-block'>{{ $data->store->name }}</div>
                    <div>
                        {{ $data->store->address }}
                        @if ($data->store->pincode != '')
                            Pincode: {{ $data->store->pincode }}
                        @endif
                    </div>
                    @if ($data->store->tax_number != '')
                        <div>GST: {{ $data->store->tax_number }}</div>
                    @endif
                    @if ($data->store->primary_email != '')
                        <div>Email: {{ $data->store->primary_email }}</div>
                    @endif
                    @if ($data->store->primary_contact != '')
                        <div>Contact: {{ $data->store->primary_contact }}</div>
                    @endif
                </td>
                <td class='v-top w-50 pr-20px'>
                    <div class='bold display-block'>To </div>
                    <div class='display-block'>
                        {{ $data->bill_to_name }} 
                        @if ($data->bill_to_code != '')
                            ({{ $data->bill_to_code }})
                        @endif
                    </div>
                    <div class='pr-100px'>
                        {{ $data->bill_to_address }}
                        @if ($data->bill_to_email != '')
                            <div>Email: {{ $data->bill_to_email }}</div>
                        @endif
                        @if ($data->bill_to_contact != '')
                            <div>Contact: {{ $data->bill_to_contact }}</div>
                        @endif
                    </div>
                </td>
            </tr>
        </table>

        <div class="mb-1rem">
            <table class="w-100 product-table mb-1rem">
                <thead>
                    <tr>
                        <th class="left">#</th>
                        <th class="left">Product Description</th>
                        <th class="right">Qty</th>
                        <th class="right">Price (EXCL Tax)</th>
                        <th class="right">Discount</th>
                        <th class="right">Tax</th>
                        <th class="right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data->products as $item_key => $product)
                        <tr>
                            <td>{{ $item_key + 1 }}</td>
                            <td>{{ $product->name }}</td>
                            <td class="right">{{ $product->quantity }}</td>
                            <td class="right">{{ $product->amount_excluding_tax }}</td>
                            <td class="right">{{ $product->discount_amount }}<br>({{ $product->discount_percentage }}%)</td>
                            <td class="right">{{ $product->tax_amount }}<br>({{ $product->tax_percentage }}%)</td>
                            <td class="right">{{ $product->total_amount }}</td>
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
                        <td colspan="{{ $colspan }}" class="right">Other Charges</td>
                        <td class="right">{{ $data->shipping_charge }}</td>
                    </tr>
                    <tr>
                        <td colspan="{{ $colspan }}" class="right bold">Total Amount</td>
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

        @if ($data->terms != '')
            <div class="mb-1rem">
                <div class='bold display-block'>Terms & Conditions</div>
                <pre>{{ $data->terms }}</pre>
            </div>
        @endif

        <div class="col6 bold">
            <h3>Received By:</h3>
            <hr>
            <div>
                <h3>Name:</h3>
                <div><hr></div>
            </div>
            <div>
                <h3>Signature:</h3>
                <div><hr></div>
            </div>
        </div>

        <div class='col12 center'>
            <div class='display-block'>Thank You!</div>
        </div>
    </body>
</html>