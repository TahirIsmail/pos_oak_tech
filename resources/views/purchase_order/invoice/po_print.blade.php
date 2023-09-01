@php 
    $data = json_decode($data); 
    $colspan = 5+((isset($data->tax_option_data) && count($data->tax_option_data->component_array) > 0)?count($data->tax_option_data->component_array):1);
@endphp
<!DOCTYPE html>
<html>
    <head>
        <title>Purchase Order #{{ $data->po_number }}</title>
    </head>
    <body>
        <div class="invoice-head center bg-black">
            <h2 class="color-white">Purchase Order / Supply Order</h2>
        </div>
        <table class = "mb-1rem header-table w-100 h-100px">
            <tr>
                <td class='center w-50' >
                    @if($logo_path != '')
                    <img src="{{ $logo_path }}" />
                    @endif
                </td>
                <td class='center w-50'>
                    <div class='display-block'>U MicroFinance Bank Ltd</div>
                    <div class='display-block'>Plot 13-b College Road,F-7 Markaz</div>
                    <div class='display-block'>Jinnah Super F-7 Islammabad</div>
                    <div class='display-block'>UAN : 111-182-265</div>
                </td>
                <td class='center w-50'>
                    <div class='display-block'>Purchase Order Number: {{ $data->po_number }}</div>
                    <div class='display-block'>Reference Number: {{ $data->po_reference }}</div>
                    <div class='display-block'>Order Date: {{ $data->order_date }}</div>
                    <div class='display-block'>Order Due Date: {{ $data->order_due_date }}</div> 
                </td>
            </tr>
        </table>
        <table class="w-100 mb-1rem h-100px" id="entity-details">
            <tr class='bg-black'>
                <th  class="left w-50 color-white" colspan="2"><h3>Supplier/Issuedto</h3></th>
                
                <th  class="left w-50 color-white" colspan="2"><h3>Supplier Contact Detail</h3></th>
                
            </tr>
            <tr rowspan="4">
                <td class="left w-25 bg-black color-white" style="border: none !important" colspan="1"><p>Supplier Name:</p></td>
                <td class="left w-25 center" colspan="1">{{ $data->supplier_name }}</td>
                <td class="w-25 bg-black color-white center" colspan="1"><p>Contact Person:</p></td>
                <td class="w-25" colspan="1">Name of the contact person</td><br>
                
            </tr>
            <tr>
                <td colspan="2"  class="w-50 bg-black color-white" style="border: none !important"></td>
                <td colspan="1" class="bg-black color-white center ">Telephone</td>
                <td colspan="1" >{{ $data->store->primary_contact }}</td>
            </tr>
            <tr>
                <td class="left w-25 bg-black color-white" colspan="1"><p>Supplier Address:</p></td>
                <td class="left w-25 center" colspan="1">{{ $data->supplier_address }}</td>
                <td class="w-25 bg-black color-white center" colspan="1"><p>Fax:</p></td>
                <td class="w-25" colspan="1">The Fax Number</td><br>
                
            </tr>
            <tr>
                <td colspan="2"  class="w-50 bg-black color-white "></td>
                <td colspan="1" class="bg-black color-white center">Email</td>
                <td colspan="1" class="border-none">{{ $data->supplier->email }}</td>
            </tr>
            <tr>
                <td colspan="2"  class="w-50 bg-black color-white"></td>
                <td colspan="1" class="bg-black color-white center ">Supplier NTN/CNIC</td>
                <td colspan="1" class="border-none">_______________________</td>
            </tr>
            <tr>
                <td colspan="2"  class="w-50 bg-black color-white "></td>
                <td colspan="1" class="bg-black color-white center ">Supplier STRN</td>
                <td colspan="1" class="">{{ $data->store->primary_contact }}</td>
            </tr>
        </table>
        

        {{-- <table class='w-100 mb-1rem'>
            <tr>
                <td class='v-top w-50 pr-20px'>
                    <div class='bold display-block'>SUPPLIER </div>
                    <div class='display-block'>{{ $data->supplier_name }} ({{ $data->supplier_code }})</div>
                    <div class='pr-100px'>
                        {{ $data->supplier_address }}
                        @if ($data->store->pincode != '')
                        Pincode: {{ $data->store->pincode }}
                        @endif
                        @if ($data->supplier->email != '')
                            Email: {{ $data->supplier->email }}
                        @endif
                        @if ($data->supplier->phone != '')
                            Contact No: {{ $data->supplier->phone }}
                        @endif
                    </div>
                </td>
                <td class='v-top w-50 pr-20px'>
                    <div class='bold display-block'>SHIP TO </div>
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
                            <div>Email 1: {{ $data->store->primary_email }}</div>
                        @endif
                        @if ($data->store->secondary_email != '')
                            <div>Email 2: {{ $data->store->secondary_email }}</div>
                        @endif
                        @if ($data->store->primary_contact != '')
                            <div>Contact No 1: {{ $data->store->primary_contact }}</div>
                        @endif
                        @if ($data->store->secondary_contact != '')
                            <div>Contact No 2: {{ $data->store->secondary_contact }}</div>
                        @endif
                    </div>
                </td>
            </tr>
        </table> --}}
        <table class="w-100 mb-1rem h-100px">
            <tr >
                <td class="bg-black color-white left">Purchase Requisition Numbers</td></tr>
            <tr>
                <td>202300718</td></tr>
        </table>
        <table class="w-100 mb-1rem h-100px">
            <tr >
                <td class="bg-black color-white left">Note To Suppliers</td></tr>
            <tr>
                <td>N/A</td></tr>
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
                    
                    @foreach ($data->products as $item_key => $po_products)
                    <tr v-for="(po_product, key, index) in products" v-bind:value="$po_products->product_slack" v-bind:key="index">
                        <td>{{ $item_key+1 }}</td>
                        <td>{{ ($po_products->product_code != ''? $po_products->product_code." - ": '') }}{{ $po_products->name }}</td>
                        <td class="right">{{ $po_products->quantity }}</td>
                        <td class="right">{{ $po_products->amount_excluding_tax }}</td>
                        <td class="right">{{ $po_products->discount_amount }}<br>({{ $po_products->discount_percentage }}%)</td>
                        
                        @if (isset($data->tax_option_data) && count($data->tax_option_data->component_array) > 0)
                            @foreach ($data->tax_option_data->component_array as $component_array_key => $component_array_item)
                                <td class="right">{{ $po_products->tax_component_array->$component_array_item }}</td>
                            @endforeach
                        @else
                            <td class="right">{{ $po_products->tax_amount }}<br>({{ $po_products->tax_percentage }}%)</td>
                        @endif

                        <td class="right">{{ $po_products->subtotal_amount_excluding_tax }}</td>
                    </tr>
                    @endforeach

                    <tr>
                        <td colspan="{{$colspan}}" class="right">Sub Total (EXCL Tax)</td>
                        <td class="right">{{ $data->subtotal_excluding_tax }}</td>
                    </tr>
                    <tr>
                        <td colspan="{{$colspan}}" class="right">Total Discount</td>
                        <td class="right">{{ $data->total_discount_amount }}</td>
                    </tr>
                    <tr>
                        <td colspan="{{$colspan}}" class="right">Total After Discount</td>
                        <td class="right">{{ $data->total_after_discount }}</td>
                    </tr>
                    <tr>
                        <td colspan="{{$colspan}}" class="right">Total Tax</td>
                        <td class="right">{{ $data->total_tax_amount }}</td>
                    </tr>
                    <tr>
                        <td colspan="{{$colspan}}" class="right">Shipping Charge</td>
                        <td class="right">{{ $data->shipping_charge }}</td>
                    </tr>
                    <tr>
                        <td colspan="{{$colspan}}" class="right">Packaging Charge</td>
                        <td class="right">{{ $data->packing_charge }}</td>
                    </tr>
                    <tr>
                        <td colspan="{{$colspan}}" class="right bold">Total (INCL Tax)</td>
                        <td class="right bold">{{ $data->total_order_amount }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="w-100 mb-1rem h-100px">
                <tr >
                    <td class="bg-black color-white left">Total Amount without GST/PST/SST</td>
                    <td class="bg-black color-white right"> {{ $data->total_order_amount }}</td>
                </tr>
              
                </table>
            @if($data->currency_code != '')
            <div>
                <small>All prices are in {{ $data->currency_name }} ({{ $data->currency_code }})</small>
            </div>
            @endif
        </div>

        @if($data->terms != '')
        <div class="mb-1rem">
            <div class='bold display-block'>Terms</div>
            <pre>{{ $data->terms }}</pre>
        </div>
        @endif

        <div class='center'>
            <div class='display-block'>Thank You!</div>
        </div>

    </body>
</html>