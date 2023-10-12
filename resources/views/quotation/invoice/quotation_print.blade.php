@php
$data = json_decode($data);
$colspan = 5+((isset($data->tax_option_data) && count($data->tax_option_data->component_array) > 0)?count($data->tax_option_data->component_array):1);
@endphp
<!DOCTYPE html>
<html>

<head>
    <style>
        .backbg {

            height: 100%;
            width: 100%;
            background-image: url('{{ $first_bg_image }} ');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            position: relative;


        }

        .innercontent-div {
            height: 350px;
            width: 89.4%;
            background-color: #0f243e;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 700px;
            margin-left: 25px;
        }



        .innercontent {
            width: 100%;
            background-color: #0f243e;
            border-collapse: collapse;
            margin-top: 200px;

        }


        .finacial {
            width: 80%;
            height: 100%;
            text-align: center;
            vertical-align: middle;
            color: #e36c0a;


        }



        .fian-detail {

            color: #0393ca;

            line-height: 1.5 !important;
        }


        .contact-detail {
            width: 50%;
            height: 100%;
        }

        .td-head {
            color: white;
            font-size: x-large;
            font-weight: normal;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;

        }

        .td-data {
            color: #0393ca;
            font-size: x-large;
            font-weight: normal;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        .backbg1 {
            height: 100%;
            width: 100%;
            background-image: url('{{ $sec_bg_image }} ');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            position: relative;
        }

        .backbg2 {
            height: 100%;
            width: 100%;
            background-image: url('{{  $third_bg_image }} ');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            position: relative;
        }

        .padd {

            padding-top: 80px;
        }
    </style>
    <title>Quotation #{{ $data->quotation_number }}</title>

</head>

<body>

    <table>
        <tr>
            <td>
                <!-- <h2>QUOTATION</h2> -->

            </td>
        </tr>
    </table>
    <div class="backbg">
        <div class="innercontent-div ">
            <table class="innercontent">
                <tr>
                    <td class="finacial">
                        <h1>
                            FINANCIAL PROPOSAL
                        </h1>
                        <br>
                        <br>
                        <h2 class="fian-detail"> Print & Tonner <br>
                            <br>
                            Mount Khalid
                        </h2>
                    </td>
                    <td class="contact-detail">


                        <table class="padd">
                            <tr>
                                <td class="td-head">contact: </td>
                                <td class="td-data">info@oaktechnologies.com.pk</td>
                            </tr>
                            <tr>
                                <td class="td-head">Ph #:</td>
                                <td class="td-data">051-873942-6</td>
                            </tr>

                            <tr>
                                <td class="td-head">WhatsApp: </td>
                                <td class="td-data">0317-6258625</td>
                            </tr>

                            <tr>
                                <td class="td-head">Address: </td>
                                <td class="td-data">Sector A, Bahria Enclave Islamabad</td>
                            </tr>

                        </table>

                    </td>
                </tr>
            </table>

        </div>
    </div>
    <div>
        <div class="backbg1">

        </div>
    </div>
    <div>
        <div class="backbg2">

        </div>
    </div>

    <div class='mb-1rem'>
        <table class='w-100'>
            <tr>
                <td class='w-50'>
                    <div class='display-block'>Quotation Number: {{ $data->quotation_number }}</div>
                    <div class='display-block'>Reference Number: {{ $data->quotation_reference }}</div>
                    <div class='display-block'>Quotation Date: {{ $data->quotation_date }}</div>
                    <div class='display-block'>Quotation Due Date: {{ $data->quotation_due_date }}</div>

                </td>
                <td class='right'>
                    @if($logo_path != '')
                    <img src="{{ $logo_path }}" class='h-50px' />
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <table class='w-100 mb-1rem'>
        <tr>
            <td class='v-top w-50 pr-20px'>
                <div class='bold display-block'>Bill From </div>
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
            <td class='v-top w-50 pr-20px'>
                <div class='bold display-block'>Bill To </div>
                <div class='display-block'>{{ $data->bill_to_name }} @if ($data->bill_to_code != '')({{ $data->bill_to_code }}) @endif </div>
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

                @foreach ($data->products as $item_key => $quotation_products)
                <tr v-for="(po_product, key, index) in products" v-bind:value="$quotation_products->product_slack" v-bind:key="index">
                    <td>{{ $item_key+1 }}</td>
                    <td>{{ ($quotation_products->product_code != ''? $quotation_products->product_code." - ": '') }}{{ $quotation_products->name }}</td>
                    <td class="right">{{ $quotation_products->quantity }}</td>
                    <td class="right">{{ $quotation_products->amount_excluding_tax }}</td>
                    <td class="right">{{ $quotation_products->discount_amount }}<br>({{ $quotation_products->discount_percentage }}%)</td>



                    <td class="right">{{ $quotation_products->subtotal_amount_excluding_tax }}</td>
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
        @if($data->currency_code != '')
        <div>
            <small>All prices are in {{ $data->currency_name }} ({{ $data->currency_code }})</small>
        </div>
        @endif
    </div>

    @if($data->notes != '')
    <div class="mb-1rem">
        <div class='bold display-block'>Notes</div>
        <pre>{{ $data->notes }}</pre>
    </div>
    @endif
    <div class='center'>
        <div class='display-block'>Thank You!</div>
    </div>

</body>

</html>