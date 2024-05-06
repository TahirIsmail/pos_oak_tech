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
    <style>
        .backbg {
            height: 100%;
            width: 100%;
            background-image: url({{ $first_bg_image }});
            /* background-size: cover; */
            background-repeat: no-repeat;
            /* background-position: center; */
            position: relative;


        }

        .innercontent-div {
            width: inherit !important;
            height: 330px;
            background-color: #051b31;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 730px;
            margin-left: 25px;
        }



        .innercontent {
            width: 100%;
            background-color: #051b31;
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
            height: 95%;
            width: 100%;
            /* margin-bottom: 20px; */
            background-image: url({{ $sec_bg_image }});
            background-size: cover;
            background-repeat: no-repeat;
            /* background-position: center; */
            position: relative;
        }

        .backbg2 {
            height: 100%;
            width: 100%;
            background-image: url({{ $third_bg_image }});
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
                        <h2 class="fian-detail">

                            {{ $data->bill_to_name }}
                            <br>
                            @if ($data->bill_to_email != '')
                                Email: {{ $data->bill_to_email }}
                            @endif
                            <br>
                            @if ($data->bill_to_contact != '')
                                Contact No: {{ $data->bill_to_contact }}
                            @endif
                        </h2>
                    </td>
                    <td class="contact-detail">
                        <table class="padd">
                            <tr>
                                <td class="td-head">Contact: </td>
                                <td class="td-data">Info@oaktechnologies.com.pk</td>
                            </tr>
                            <tr>
                                <td class="td-head">Ph #:</td>
                                <td class="td-data">(051)-873942-6</td>
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
        {{-- <div class="backbg2">

        </div> --}}
    </div>


    <table class='w-100 mb-1rem'>
        <tr>
            <td class='w-50'>

                <div class='display-block'>Quotation Number: {{ $data->quotation_number }}</div>
                <div class='display-block'>Reference Number: {{ $data->quotation_reference }}</div>
                <div class='display-block'>Quotation Date: {{ $data->quotation_date }}</div>
                <div class='display-block'>Quotation Due Date: {{ $data->quotation_due_date }}</div>

            </td>
            <td class='v-top w-50 pr-20px'>
                <div class='bold display-block'>Quotation To</div>
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

    @if ($data->gst_tax_option == 'gst')
        <div style="width:100%">
            <h3 style="text-align: center">QUOTATION WITH GST</h3>
        </div>
    @else
        <div style="width:100%">
            <h3 style="text-align: center">QUOTATION</h3>
        </div>
    @endif
    <div class="mb-1rem">
        <table class="w-100 product-table mb-1rem">
            <thead>
                <tr>
                    <th class="left">#</th>
                    <th class="left" style="width: 30%">Product Description</th>
                    <th class="right">Qty</th>
                    <th class="right">Unit Price Without GST</th>
                    <th class="right">Total Without GST</th>
                    <th class="right">GST</th>
                    <th class="right">Total With GST</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data->products as $item_key => $quotation_products)
                    <tr v-for="(po_product, key, index) in products" v-bind:value="$quotation_products->product_slack"
                        v-bind:key="index">
                        <td>{{ $item_key + 1 }}</td>
                        <td>{{ $quotation_products->name }}</td>
                        <td class="right">{{ number_format($quotation_products->quantity, 0) }}</td>
                        <td class="right">{{ number_format($quotation_products->amount_excluding_tax) }}</td>
                        <td class="right">
                            {{ number_format($quotation_products->quantity * $quotation_products->amount_excluding_tax) }}
                        </td>
                        <td class="right">
                            {{ number_format((($quotation_products->amount_excluding_tax * $quotation_products->tax_percentage) / 100) * $quotation_products->quantity) }}
                            ({{ number_format($quotation_products->tax_percentage, 0) }}%)
                        </td>
                        <td class="right">
                            {{ number_format($quotation_products->quantity * $quotation_products->amount_excluding_tax + (($quotation_products->amount_excluding_tax * $quotation_products->tax_percentage) / 100) * $quotation_products->quantity) }}
                        </td>

                    </tr>
                @endforeach

                <tr>
                    <td colspan="{{ $colspan }}" class="right">Sub Total (EXCL GST)</td>
                    <td class="right">{{ number_format($data->subtotal_excluding_tax, 0) }}</td>
                </tr>
                <tr>
                    <td colspan="{{ $colspan }}" class="right">Total Discount</td>
                    <td class="right">{{ number_format($data->total_discount_amount, 0) }}</td>
                </tr>
                <tr>
                    <td colspan="{{ $colspan }}" class="right">Total After Discount</td>
                    <td class="right">{{ number_format($data->total_after_discount, 0) }}</td>
                </tr>
                <tr>
                    <td colspan="{{ $colspan }}" class="right">Total GST</td>
                    <td class="right">{{ number_format($data->total_tax_amount, 0) }}</td>
                </tr>
                <tr>
                    <td colspan="{{ $colspan }}" class="right">Other Charge</td>
                    <td class="right">{{ number_format($data->shipping_charge, 0) }}</td>
                </tr>
                {{-- <tr>
                    <td colspan="{{ $colspan }}" class="right">Packaging Charge</td>
                    <td class="right">{{ $data->packing_charge }}</td>
                </tr> --}}
                <tr>
                    <td colspan="{{ $colspan }}" class="right bold">Total (INCL GST)</td>
                    <td class="right bold">{{ number_format($data->total_order_amount) }}</td>
                </tr>
            </tbody>
        </table>
        {{-- <div class="mb-1">
            <i class=""><span style="color:red">*</span>{{ $data->gst_tax_option }}</i>
        </div> --}}
        {{-- @if ($data->currency_code != '')
            <div>
                <small>All prices are in {{ $data->currency_name }} ({{ $data->currency_code }}) only/-</small>
            </div>
        @endif --}}
    </div>

    @if ($data->notes != '')
        <div class="mb-1rem">
            <div class='bold display-block'>Terms & Conditions</div>
            <pre>{{ $data->notes }}</pre>
        </div>
    @endif
    <div class='center'>
        <div class='display-block'>Thank You!</div>
    </div>

</body>

</html>
