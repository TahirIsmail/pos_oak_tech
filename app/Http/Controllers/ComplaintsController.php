<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Complaints;
use Illuminate\Http\Request;
use App\Models\Complaints as ComplaintModel;
use App\Models\User as UserModel;
use App\Models\Customer as CustomerModel;
use Pusher\Pusher;
use Illuminate\Support\Facades\File;
use App\Models\User;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;

use Mpdf\Mpdf;

use function PHPUnit\Framework\isNull;

class ComplaintsController extends Controller
{
    //
    public function index(Request $request)
    {
        $data['menu_key'] = 'MM_COMPLAIN';
        $data['sub_menu_key'] = 'SM_CUSTOMER_COMPLAINTS';
        check_access(array($data['menu_key'], $data['sub_menu_key']));

        return view('complaints.customer_complaints', $data);
    }

    public function add_complaints(Request $request,$slack = null)
    {
        $data['menu_key'] = 'MM_COMPLAIN';
        $data['sub_menu_key'] = 'SM_CUSTOMER_COMPLAINTS';
        $data['action_key'] = ($slack == null) ? 'A_ADD_CUSTOMER_COMPLAINT' : 'A_EDIT_CUSTOMER_COMPLAINT';
        check_access(array($data['action_key']));


        $data['complaints_data'] = [];

       
        
        if ($slack) {

            $complaint = ComplaintModel::with('customer', 'order')->where('slack', '=', $slack)->first();
            if (empty($complaint)) {
                abort(404);
            }

            $data['complaints_data'] = $complaint;
        }
        
        if($request->logged_user_role_id == 2){
            $customers = User::where('id', $request->logged_user_id)->get();
        }
        else{
            $customers = User::where('role_id', 2)->get();
        }

        $data['customers_list'] = $customers;

        return view('complaints.add_customer_complaint', $data);

    }

    public function view_complaints(Request $request, $slack = null)
    {
        $data['menu_key'] = 'MM_COMPLAIN';
        $data['sub_menu_key'] = 'SM_CUSTOMER_COMPLAINTS';
        $data['action_key'] = 'A_VIEW_CUSTOMER_COMPLAINT';
        check_access(array($data['action_key']));
        $users = UserModel::withCount(['assignComplaints' => function ($query) {
            $query->where('complaint_status', '!=', 'Completed Complaint');
        }])->get();
        
        $complaint = ComplaintModel::with('customer', 'order', 'product', 'user')->where('slack', '=', $slack)->first();
        $data['labTechnician'] = $users;
        $data['complaint'] = $complaint;
       
        $data['assign_access_key'] = 'A_ASSIGN_CUSTOMER_COMPLAINT_LABTECHNICIAN';
        if (check_access(array($data['assign_access_key']), true) == false) {
           
        }else{
            $data['assign_access'] = true;
        }


        $data['requirement_request_key'] = 'A_REQUIREMENT_REQUEST_LABTECHNICIAN';
        if (check_access(array($data['requirement_request_key']), true) == false) {
           
        }else{
            $data['requirement_request_access'] = true;
        }


        $data['Customer_complaint_make_invoice_key'] = 'A_CUSTOMER_COMPLAINT_MAKE_INVOICE';
        if (check_access(array($data['Customer_complaint_make_invoice_key']), true) == false) {
           
        }else{
            $data['Customer_complaint_make_invoice'] = true;
        }




        $data['delete_access_key'] = 'A_DELETE_CUSTOMER_COMPLAINT';
        if (check_access(array($data['delete_access_key']), true) == false) {
           
        }else{
            $data['delete_access'] = true;
        }



        
        return view('complaints.view_customer_complaint', $data);
    }

    public function print_invoice(Request $request, $slack, $type = 'INLINE', $full_path = false){
        $data['menu_key'] = 'MM_COMPLAIN';
        $data['sub_menu_key'] = 'SM_CUSTOMER_COMPLAINTS';
        $data['action_key'] = 'A_PRINT_CUSTOMER_COMPLAINT_INVOICE';
        check_access(array($data['action_key']));
        
        $complaint_invoice = ComplaintModel::with('order','storeData','linkToProduct','complaintCharges', 'transactions')->where('slack', '=', $slack)->first();
        // dd('kashif');
        
        if (empty($complaint_invoice)) {
            abort(404);
        }

        $print_logo_path = config("app.invoice_print_logo");
       
        $print_data = view('invoice.invoice.complaint_invoice_print', ['data' => json_encode($complaint_invoice), 'logo_path' => $print_logo_path])->render();

        $mpdf_config = [
            'mode'          => 'utf-8',
            'format'        => 'A4',
            'orientation'   => 'P',
            'margin_left'   => 7,
            'margin_right'  => 7,
            'margin_top'    => 7,
            'margin_bottom' => 7,
            'tempDir' => storage_path()."/pdf_temp" 
        ];

        $cache_params = '?='.uniqid();
        $stylesheet = File::get(public_path('css/invoice_print_invoice.css'));
        $mpdf = new Mpdf($mpdf_config);
        $mpdf->SetDisplayMode('real');
        $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->SetHTMLFooter('<div class="footer">Page: {PAGENO}/{nb}</div>');
        $mpdf->WriteHTML($print_data);
        header('Content-Type: application/pdf');

        $filename = 'invoice_'.$complaint_invoice['invoice_number'].'.pdf';

        Storage::disk('invoice')->delete(
            [
                $filename
            ]
        );

        if($type == 'INLINE'){
            $mpdf->Output($filename.$cache_params, \Mpdf\Output\Destination::INLINE);
        }else{
            $view_path = Config::get('constants.upload.invoice.view_path');
            $upload_dir = Storage::disk('invoice')->getAdapter()->getPathPrefix();

            $mpdf->Output($upload_dir.$filename, \Mpdf\Output\Destination::FILE);

            $download_link = ($full_path == false)?$view_path.$filename.$cache_params:$upload_dir.$filename;
            return $download_link; 
        }
    }
}
