<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaxcodeResource;
use App\Models\GstOnProduct;
use App\Models\MasterStatus;
use App\Models\Taxcode as TaxcodeModel;
use Illuminate\Http\Request;

use App\Models\Invoice;


class Taxcode extends Controller
{
    //This is the function that loads the listing page
    public function index(Request $request)
    {
        //check access
        $data['menu_key'] = 'MM_TAX_AND_DISCOUNT';
        $data['sub_menu_key'] = 'SM_TAXCODES';
        check_access(array($data['menu_key'], $data['sub_menu_key']));

        return view('tax_code.tax_codes', $data);
    }
    public function gst_on_product(Request $request)
    {
        //check access
        $data['menu_key'] = 'MM_TAX_AND_DISCOUNT';
        $data['sub_menu_key'] = 'SM_GST_PRODUCT';
        check_access(array($data['menu_key'], $data['sub_menu_key']));
        $gst_paid_on_product = GstOnProduct::with('product')
            ->where('receiving_from_customer', 0)
            ->get();

        $total_gst = 0;
        $total_gst_paid = 0;
        $total_gst_unpaid = 0;

        foreach ($gst_paid_on_product as $gst_item) {
            $purchase_amount_excluding_tax = $gst_item->product->purchase_amount_excluding_tax;
            $gst_percentage = $gst_item->gst_percentage ?? 0;
        
            $total_gst += ($gst_item->gst_percentage === null) ? $gst_item->gst_paid_for_product : ($purchase_amount_excluding_tax * $gst_percentage / 100);
        
            $total_gst_paid += ($gst_item->is_paid == 1) ? (($gst_item->gst_percentage === null) ? $gst_item->gst_paid_for_product : ($purchase_amount_excluding_tax * $gst_percentage / 100)) : 0;
        
            $total_gst_unpaid += ($gst_item->is_paid == 0) ? (($gst_item->gst_percentage === null) ? $gst_item->gst_paid_for_product : ($purchase_amount_excluding_tax * $gst_percentage / 100)) : 0;
        }
        

        // $invoices = Invoice::with(['products.product' => function ($query) {
        //     $query->where('gst_paid_for_product', 0);
        // }])->get();
        $invoices = Invoice::select('slack', 'invoice_number', 'invoice_reference')->get();
        $data['invoices'] = $invoices;

        $data['total_paid_gst'] = $total_gst;
        $data['total_gst_paid'] = $total_gst_paid;
        $data['total_gst'] = $total_gst - $total_gst_paid;
        $data['total_gst_unpaid'] = $total_gst_unpaid;

        return view('tax_code.gst_on_product', $data);
    }

    public function receiving_gst(Request $request)
    {
        //check access
        $data['menu_key'] = 'MM_TAX_AND_DISCOUNT';
        $data['sub_menu_key'] = 'SM_RECEIVING_GST';
        check_access(array($data['menu_key'], $data['sub_menu_key']));
        $gst_paid_on_product = GstOnProduct::with('product')
            ->where('receiving_from_customer', 1)
            ->get();

        $total_gst = 0;

        foreach ($gst_paid_on_product as $item) {
            $total_gst += $item->gst_paid_for_product;
        }

        $data['total_gst'] = $total_gst;

        return view('tax_code.receiving_gst', $data);
    }

    //This is the function that loads the add/edit page
    public function add_tax_code($slack = null)
    {
        //check access
        $data['menu_key'] = 'MM_TAX_AND_DISCOUNT';
        $data['sub_menu_key'] = 'SM_TAXCODES';
        $data['action_key'] = ($slack == null) ? 'A_ADD_TAXCODE' : 'A_EDIT_TAXCODE';
        check_access(array($data['action_key']));

        $data['statuses'] = MasterStatus::select('value', 'label')->filterByKey('TAX_CODE_STATUS')->active()->sortValueAsc()->get();

        $data['tax_code_data'] = null;
        if (isset($slack)) {

            $tax_code = TaxcodeModel::where('slack', '=', $slack)->first();
            if (empty($tax_code)) {
                abort(404);
            }

            $tax_code_data = new TaxcodeResource($tax_code);
            $data['tax_code_data'] = $tax_code_data;
        }

        return view('tax_code.add_tax_code', $data);
    }

    //This is the function that loads the detail page
    public function detail($slack)
    {
        $data['menu_key'] = 'MM_TAX_AND_DISCOUNT';
        $data['sub_menu_key'] = 'SM_TAXCODES';
        $data['action_key'] = 'A_DETAIL_TAXCODE';
        check_access([$data['action_key']]);

        $tax_code = TaxcodeModel::where('slack', '=', $slack)->first();

        if (empty($tax_code)) {
            abort(404);
        }

        $tax_code_data = new TaxcodeResource($tax_code);

        $data['tax_code_data'] = $tax_code_data;

        $data['delete_access'] = check_access(['A_DELETE_TAXCODE'], true);

        return view('tax_code.tax_code_detail', $data);
    }
}
