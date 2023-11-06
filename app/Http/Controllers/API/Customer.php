<?php

defined('BASEPATH') or exit('No direct script access allowed');



use QuickBooksOnline\API\Facades\Invoice as qb_invoice;
use QuickBooksOnline\API\Core\Http\Serialization\XmlObjectSerializer;
use QuickBooksOnline\API\Facades\Account as qb_account_obj;
use QuickBooksOnline\API\Facades\Customer as qb_customer_obj;
/**
 * Qb_test
 *
 * @author Tahir Ismail
 */
class Customer extends CI_Controller
{

    /**
     * @var QuickBooksOnline\API\DataService\DataService
     */
    private $dataService = null;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        // First of all, take a look at the examples here:
        // [installation path]vendor/quickbooks/v3-php-sdk/src/_Samples/
        // 
        // and from now on, keep an eye here:
        // https://intuit.github.io/QuickBooks-V3-PHP-SDK/overview.html

        // This library will make our life easier.
        // On our marks...
        $this->load->library('quickbooks');

        // Set...
        $this->dataService = $this->quickbooks->getDataService();
        $this->dataService->setLogLocation("/tmp/QB-tests.log");
    }

    public function index()
    {
       
        $data['vendors'] = $this->dataService->query("SELECT * FROM Customer");
        echo json_encode($data['vendors']);
        //$this->create_invoice();
        //$this->verify_invoice();
    }

    /**
     * List Vendors
     */
    public function list_vendors()
    {

        $data['vendors'] = [];

        try {
            $data['vendors'] = $this->dataService->query("SELECT * FROM Vendor STARTPOSITION 1 MAXRESULTS 10");
        } catch (Exception $ex) {
            // One of the reasons you might get here is that you don't have the
            // Oauth2 authorization info in your session. print_r($_SESSION) to see what
            // you have in there
            //print "<pre>"; print_r($_SESSION);
            print $ex->getMessage();
        }

        //print_r($vendors);die;
        $this->load->view('qb_tests', $data);
    }

    /**
     * Create Invoice
     */
    public function create_customer()
    {

        // This sample follows closely QuickBooks PHP SDK documentation here:
        // https://intuit.github.io/QuickBooks-V3-PHP-SDK/quickstart.html

        // Uncomment these and play with the parameters
        // 
        //// I picked a random Customer from this list
        // print "<pre>";
        // print_r($this->dataService->FindById('Customer', 11)); die;
        //
        //// I took a look at the internal structure of Invoice objects
        //print "<pre>";
        //print_r($this->dataService->FindAll('Invoice', 1, 100)); die;

        /* @var $invoice \QuickBooksOnline\API\Facades\Invoice */
        $invoice = qb_customer_obj::create([

            "Line" => [
                [
                    "Description" => "Programming services: accounting solution", // :)
                    "Amount" => 6200,
                    "DetailType" => "SalesItemLineDetail",
                    "SalesItemLineDetail" => [
                        "ItemRef" => [
                            "value" => 1,
                            "name" => "Services"
                        ]
                    ]
                ]
            ],
            "CustomerRef" => [
                "value" => "11",
                "name" => "Gevelber Photography" // This is not required
            ]
        ]);

        // This is the object representation (copy) of what we should have inserted
        // if everything went Ok
        $resultInvoice  = $this->dataService->Add($invoice);

        /* @var $lastError QuickBooksOnline\API\Core\HttpClients\FaultHandler */
        $lastError      = $this->dataService->getLastError();

        if ($lastError) {
            echo "The Status code is: " . $lastError->getHttpStatusCode() . "\n";
            echo "The Helper message is: " . $lastError->getOAuthHelperError() . "\n";
            echo "The Response message is: " . $lastError->getResponseBody() . "\n";
        } else {
            // This should look nice...
            print "<pre>";
            print_r($resultInvoice);
        }
    }

    public function verify_customer()
    {

        $invoice = null;

        try {
            // While I was testing, this was the generated Id number for the Invoice
            // Note: this is not MySQL, use quotes for field values.
            $invoice = $this->dataService->query("SELECT * FROM Customer WHERE Id = '145'");
        } catch (Exception $ex) {
            print $ex->getMessage();
        }

        print "<pre>";
        print_r($invoice);
    }
    public function all_customer()
    {
        //$id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $allInvoices = $this->dataService->Query("SELECT * FROM Customer");


        $error =  $this->dataService->getLastError();
        if ($error) {
            echo "The Status code is: " . $error->getHttpStatusCode() . "\n";
            echo "The Helper message is: " . $error->getOAuthHelperError() . "\n";
            echo "The Response message is: " . $error->getResponseBody() . "\n";
        } else {
            echo  json_encode($allInvoices);
        }
    }
}
