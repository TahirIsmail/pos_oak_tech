@php
    $data = json_decode($data);
    $colspan =
        5 +
        (isset($data->tax_option_data) && count($data->tax_option_data->component_array) > 0
            ? count($data->tax_option_data->component_array)
            : 1);
@endphp
<!DOCTYPE html>
<html>

<head>

    <title>Order #{{ $data->order_number }}</title>
    <style>
        table,
        td,
        th {
            border: 1px solid !important;
        }

        table {
            width: 100% !important;
            border-collapse: collapse !important;

        }

        .fixed-bottom {
            position: fixed;
            bottom: 0;
            width: 100%;
            padding: 10px;
        }

        a {
            color: #4990e2 !important;
            text-decoration: none !important;
        }


        body {
            font-family: "Trebuchet MS", "Segoe UI", Candara, "Bitstream Vera Sans", "DejaVu Sans", "Bitstream Vera Sans", Verdana, "Verdana Ref", sans-serif !important;
            font-size: 14px !important;
            line-height: 20px;
            color: black !important;
        }

        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 15px;
            line-height: 20px;

        }

        tr {
            padding-top: 10px !important;
            padding-bottom: 10px !important;
        }
    </style>
</head>

<body>
    <div>

        {{-- <div style="overflow: hidden;"> --}}
            <table class="mb-1rem header-table" style="width:100%;border:none;">
                <tr style="width:100%;">
                    <td style="font-size: 12px; width:50%; padding: 1px; border:none;">
                        @if($logo_path != '')
                        <img src="{{ $logo_path }}" class='h-50px'/>
                        @endif
                    </td>
                    <td style="font-size: 12px; width:50%; padding: 1px; border:none;text-align:center;">
                        Oak Technologies <br>
                        info@oaktechnology.com <br>
                        +923528734958 <br>
                        https://oak.technology
                    </td>
                </tr>
                
            </table>
        {{-- </div> --}}
        
        

        <table class="mb-1rem header-table w-100 h-100px;" style="border:none;">
            <tr>
                <td
                    style="font-size: 15px; width:100%; padding: 1px; border:none; font-weight: bold; text-align: center;">
                    Cash Invoice </td>
            </tr>
        </table>



        <table class="mb-1rem header-table w-100 h-100px;" style="border:none;">
            <tr>
                <td style="font-size: 12px; width:75%; padding: 1px; border:none;"> Customer Name: <span style="text-decoration: underline">{{ $data->customer_name}}</span>
                    </td>
                <td style="font-size: 12px; width:25%; padding: 1px; border:none;"> S.no:  <span style="text-decoration: underline">{{ $data->order_number }}</span> </td>
            </tr>
            <tr>
                <td style="font-size: 12px; width:75%; padding: 1px; border:none;"> Address: <span style="text-decoration: underline">{{ $data->address}}</span>
                    </td>
                <td style="font-size: 12px; width:25%; padding: 1px; border:none;"> Date: <span style="text-decoration: underline">{{ $data->created_at_label  }}</span> </td>
            </tr>

        </table>




        <table class="mb-1rem header-table w-100 h-100px;" style="border:none;">
            <tr>
                <th style="font-size: 12px; width:10%; padding: 1px; ">S.no</th>
                <th style="font-size: 12px; width:10%; padding: 1px; ">QTV</th>
                <th style="font-size: 12px; width:40%; padding: 1px; ">Descriptions</th>
                <th style="font-size: 12px; width:20%; padding: 1px; ">Rate</th>
                <th style="font-size: 12px; width:20%; padding: 1px; ">Account</th>
            </tr>
            @php
                $serial_no = 1;
            @endphp
            @foreach ($data->products as $order_products)
            @php 
            $spacing = '';        
            if($order_products->tax_percentage>0 || $order_products->discount_percentage >0){
                $spacing = 'pb-0'; 
            }
            $addon_spacing = '';
            $addon_indicator = '';
            if($order_products->parent_order_product ==  false){
                $addon_spacing = ' pl-12';
                $addon_indicator = '+ ';
            }
        @endphp
            <tr>
                <td class='{{ $spacing.$addon_spacing }}'> {{ $serial_no }}</td>
                <td class='{{ $spacing }} right'>{{ $order_products->quantity }} </td>
                <td class='{{ $spacing }} right'>  </td>
                <td class='{{ $spacing }} right'>{{  $data->total_order_amount }} </td>
                <td class='{{ $spacing }} right'>{{  $data->total_order_amount }} </td>
            </tr>
          
            @php
                $serial_no++;
            @endphp
            @endforeach
        </table>

        <table class='border-bottom-dashed mb-1rem w-100'>
            <tr>
                <td class='w-50'>Sub Total</td>
                <td class='right'>{{ $data->sale_amount_subtotal_excluding_tax }}</td>
            </tr>
            
            @php 
                $spacing = '';            
                if($data->order_level_discount_percentage > 0 || $data->product_level_total_discount > 0){
                    $spacing = 'pb-0';
                }
            @endphp

            <tr>
                <td class='{{ $spacing }} w-50'>Discount</td>
                <td class='{{ $spacing }} right'>{{ $data->total_discount_before_additional_discount }}</td>
            </tr>
            @if($data->order_level_discount_percentage > 0)
            <tr>
                <td class='{{ $spacing }} small' colspan='2'>
                    [Overall Discount {{ ($data->order_level_discount_percentage >0 )?'('.$data->order_level_discount_percentage.'%)':'' }}: {{ $data->order_level_discount_amount }}]
                </td>
            </tr>
            @endif
            @if($data->product_level_total_discount > 0)
            <tr>
                <td class='small' colspan='2'>
                    [Product Discount: {{ $data->product_level_total_discount }}]
                </td>
            </tr>
            @endif

            @if($data->additional_discount_percentage > 0)
            <tr>
                <td class='w-50'>Additional Discount</td>
                <td class='right'>({{ $data->additional_discount_percentage }}%) {{ $data->additional_discount_amount }}</td>
            </tr>
            @endif

            <tr>
                <td class='w-50'>Total Amount After Discount</td>
                <td class='right'>{{ $data->total_after_discount }}</td>
            </tr>

            @php 
                $spacing = '';            
                if($data->order_level_tax_percentage > 0 || $data->order_level_tax_amount > 0){
                    $spacing = 'pb-0';
                }
            @endphp
            <tr>
                <td class='{{ $spacing }} w-50'>Tax</td>
                <td class='{{ $spacing }} right'>{{ $data->total_tax_amount }}</td>
            </tr>
            @if($data->order_level_tax_percentage >0)
            <tr>
                <td class='{{ $spacing }} small' colspan='2'>
                    @if(count($data->order_level_tax_components)>0)
                        [Overall Tax: 
                        @foreach ($data->order_level_tax_components as $tax_component)
                            {{ strtoupper($tax_component->tax_type) }}({{ $tax_component->tax_percentage }}%) : {{ round($tax_component->tax_amount, 2) }}|
                        @endforeach
                        Tax Amount: {{ $data->order_level_tax_amount }}]
                    @endif
                </td>
            </tr>
            @endif

            @if($data->product_level_total_tax > 0)
            <tr>
                <td class='small' colspan='2'>
                    [Product Tax: {{ $data->product_level_total_tax }}]
                </td>
            </tr>
            @endif

            <tr>
                <td class='bold w-50'>Bill Total</td>
                <td class='bold right'>{{ $data->store->currency_code }} {{ $data->total_order_amount }}</td>
            </tr>

            <tr>
                <td class='bold w-50'>Received Amount</td>
                <td class='bold right'>{{ $data->store->currency_code }} {{ $total_received_amount }}</td>
            </tr>


            <tr>
                <td class='bold w-50'>Pending Amount</td>
                <td class='bold right'>{{ $data->store->currency_code }} {{ $data->total_order_amount - $total_received_amount }}</td>
            </tr>

        </table>


        <table class="mb-1rem header-table w-100 h-100px;" style="border:none;">
            <tr>
                <td style="font-size: 12px; width:75%; padding: 1px; border:none;"><strong>Note</strong> Used equipment
                    only has check warranty. Damaged <br>and burend equipment shall not be claimed in warranty
                </td>
                <td style="font-size: 12px; width:25%; padding: 1px; border:none;"> Signature_________________</td>
            </tr>


        </table>






    </div>
    <div class='center' style="margin-top:10px;">
        <div class='display-block'>Thank You!</div>
    </div>
</body>

</html>




</body>

</html>
