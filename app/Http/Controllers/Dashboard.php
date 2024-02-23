<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use App\Models\Invoice;
use App\Models\Store as StoreModel;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Product;

class Dashboard extends Controller
{
    //This is the function that loads the dashboard page
    public function index(Request $request)
    {
        $data['menu_key'] = "MM_DASHBOARD";
        $data['sub_menu_key'] = "SM_MASTER_DASHBOARD";
        check_access(array($data['menu_key'], $data['sub_menu_key']));

        $data['store'] = StoreModel::select('currency_name', 'currency_code')
            ->where('id', $request->logged_user_store_id)
            ->first();


        $months = range(1, 12);


        $total_invoices = Invoice::where('invoice_against_po_from_customer', 1)->count();

        $sale_according_to_month = DB::table('transactions')
            ->where('transaction_from_customer', 1)
            ->select(
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 1 THEN 1 END) AS jan'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 2 THEN 1 END) AS feb'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 3 THEN 1 END) AS mar'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 4 THEN 1 END) AS apr'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 5 THEN 1 END) AS may'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 6 THEN 1 END) AS jun'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 7 THEN 1 END) AS july'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 8 THEN 1 END) AS aug'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 9 THEN 1 END) AS sep'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 10 THEN 1 END) AS oct'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 11 THEN 1 END) AS nov'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 12 THEN 1 END) AS dece')
            )
            ->first();
        $total_sale_according_to_month = collect($sale_according_to_month)->values()->all();

        $all_sale_according_to_month = array_values(array_combine($months, $total_sale_according_to_month));

        $sale_transactions = DB::table('transactions')
            ->select(DB::raw('SUM(amount) as total_sale'))
            ->where('transaction_from_customer', 1)
            ->get()->toArray();

        $total_income = DB::table('transactions')
            ->select(DB::raw('SUM(amount) as total_income'))
            ->where('transaction_from_customer', 1)
            ->orWhere(function ($query) {
                $query->where('bill_to', 'LAB_CHARGES')
                    ->orWhere('bill_to', 'COMPLAINTS');
            })
            ->get()
            ->toArray();
        $total_expense = DB::table('transactions')
            ->select(DB::raw('SUM(amount) as total_expense'))
            ->where('invoice_created_by_supplier', 1)
            ->orWhere(function ($query) {
                $query->where('bill_to', 'OTHER_EXPENSE')
                    ->orWhere('bill_to', 'STAFF');
            })
            ->get()
            ->toArray();
        $total_net_profits = $total_income[0]->total_income - $total_expense[0]->total_expense;
      

        $total_purchase_order_values = DB::table('transactions')
            ->select(DB::raw('SUM(amount) as total_purchase_order'))
            ->where('invoice_created_by_supplier', 1)            
            ->get()
            ->toArray();

        



        $total_invoices = Invoice::where('invoice_against_po_from_customer', 1)->count();

        $invoices_per_month = DB::table('invoices')
            ->where('invoice_against_po_from_customer', 1)
            ->select(
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 1 THEN 1 END) AS jan'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 2 THEN 1 END) AS feb'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 3 THEN 1 END) AS mar'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 4 THEN 1 END) AS apr'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 5 THEN 1 END) AS may'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 6 THEN 1 END) AS jun'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 7 THEN 1 END) AS july'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 8 THEN 1 END) AS aug'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 9 THEN 1 END) AS sep'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 10 THEN 1 END) AS oct'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 11 THEN 1 END) AS nov'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 12 THEN 1 END) AS dece')
            )
            ->first();
        $total_invoices_count_per_month = collect($invoices_per_month)->values()->all();

        $total_invoices_per_month = array_values(array_combine($months, $total_invoices_count_per_month));



        $total_customers = Customer::where('customer_type', '!=', 'DEFAULT')->where('parent_id', null)->count();
        
        $customers_per_month = DB::table('customers')
            ->where('customer_type', '!=', 'DEFAULT')
            ->where('parent_id', null)
            ->whereNull('deleted_at')
            ->select(
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 1 THEN 1 END) AS jan'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 2 THEN 1 END) AS feb'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 3 THEN 1 END) AS mar'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 4 THEN 1 END) AS apr'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 5 THEN 1 END) AS may'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 6 THEN 1 END) AS jun'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 7 THEN 1 END) AS july'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 8 THEN 1 END) AS aug'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 9 THEN 1 END) AS sep'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 10 THEN 1 END) AS oct'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 11 THEN 1 END) AS nov'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 12 THEN 1 END) AS dece')
            )
            ->first();
        $total_customers_count_per_month = collect($customers_per_month)->values()->all();

        $total_customers_per_month = array_values(array_combine($months, $total_customers_count_per_month));


        $total_suppliers = Supplier::where('supplier_type', '!=', 'DEFAULT')->count();

        $suppliers_per_month = DB::table('suppliers')
            ->where('supplier_type', '!=', 'DEFAULT')
            ->select(
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 1 THEN 1 END) AS jan'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 2 THEN 1 END) AS feb'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 3 THEN 1 END) AS mar'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 4 THEN 1 END) AS apr'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 5 THEN 1 END) AS may'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 6 THEN 1 END) AS jun'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 7 THEN 1 END) AS july'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 8 THEN 1 END) AS aug'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 9 THEN 1 END) AS sep'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 10 THEN 1 END) AS oct'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 11 THEN 1 END) AS nov'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 12 THEN 1 END) AS dece')
            )
            ->first();
        $total_suppliers_count_per_month = collect($suppliers_per_month)->values()->all();

        $total_suppliers_per_month = array_values(array_combine($months, $total_suppliers_count_per_month));



        $total_staff =  DB::table('users')
            ->whereNotIn('role_id', [1, 2, 3])
            ->where('customer_child_id', null)
            ->count();

        $staff_per_month = DB::table('users')
            ->whereNotIn('role_id', [1, 2, 3])
            ->where('customer_child_id', null)
            ->select(
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 1 THEN 1 END) AS jan'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 2 THEN 1 END) AS feb'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 3 THEN 1 END) AS mar'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 4 THEN 1 END) AS apr'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 5 THEN 1 END) AS may'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 6 THEN 1 END) AS jun'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 7 THEN 1 END) AS july'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 8 THEN 1 END) AS aug'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 9 THEN 1 END) AS sep'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 10 THEN 1 END) AS oct'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 11 THEN 1 END) AS nov'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 12 THEN 1 END) AS dece')
            )
            ->first();
        $total_staff_count_per_month = collect($staff_per_month)->values()->all();

        $total_staff_per_month = array_values(array_combine($months, $total_staff_count_per_month));

        $total_purchase_orders = DB::table('purchase_orders')->where('po_from_customer', 0)->where('status', 2)->count();
        $purchase_orders_per_month = DB::table('purchase_orders')
            ->where('po_from_customer', 0)->where('status', 2)
            ->select(
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 1 THEN 1 END) AS jan'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 2 THEN 1 END) AS feb'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 3 THEN 1 END) AS mar'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 4 THEN 1 END) AS apr'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 5 THEN 1 END) AS may'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 6 THEN 1 END) AS jun'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 7 THEN 1 END) AS july'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 8 THEN 1 END) AS aug'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 9 THEN 1 END) AS sep'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 10 THEN 1 END) AS oct'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 11 THEN 1 END) AS nov'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 12 THEN 1 END) AS dece')
            )
            ->first();
        $total_purchase_orders_count_per_month = collect($purchase_orders_per_month)->values()->all();

        $total_purchase_orders_per_month = array_values(array_combine($months, $total_purchase_orders_count_per_month));



        $total_products = Product::all()->count();
        $products_per_month = DB::table('products')
            ->select(
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 1 THEN 1 END) AS jan'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 2 THEN 1 END) AS feb'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 3 THEN 1 END) AS mar'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 4 THEN 1 END) AS apr'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 5 THEN 1 END) AS may'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 6 THEN 1 END) AS jun'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 7 THEN 1 END) AS july'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 8 THEN 1 END) AS aug'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 9 THEN 1 END) AS sep'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 10 THEN 1 END) AS oct'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 11 THEN 1 END) AS nov'),
                DB::raw('COUNT(CASE WHEN MONTH(created_at) = 12 THEN 1 END) AS dece')
            )
            ->first();
        $products_count_per_month = collect($products_per_month)->values()->all();

        $total_products_per_month = array_values(array_combine($months, $products_count_per_month));






        $data['dashboard_data'] = [
            'total_net_profits' => $total_net_profits,
            'total_purchase_order_values' => $total_purchase_order_values[0]->total_purchase_order,
            'total_income' => $total_income[0]->total_income,
            'total_expense' => $total_expense[0]->total_expense,
            'total_sale_values' => $sale_transactions[0]->total_sale,
            'total_invoices' => $total_invoices,
            'total_invoices_per_month' => $total_invoices_per_month,
            'all_sale_according_to_month' => $all_sale_according_to_month,
            'total_customers' => $total_customers,
            'total_customers_per_month' => $total_customers_per_month,
            'total_suppliers' => $total_suppliers,
            'total_suppliers_per_month' => $total_suppliers_per_month,
            'total_staff' => $total_staff,
            'total_staff_per_month' => $total_staff_per_month,
            'total_purchase_orders' => $total_purchase_orders,
            'total_purchase_orders_per_month' => $total_purchase_orders_per_month,
            'total_products' => $total_products,
            'total_products_per_month' => $total_products_per_month,
        ];


        return view('dashboard.dashboard', $data);
    }

    public function billing_counter_dashboard(Request $request)
    {
        $data['menu_key'] = "MM_DASHBOARD";
        $data['sub_menu_key'] = "SM_BILLING_COUNTER_DASHBOARD";
        check_access(array($data['menu_key'], $data['sub_menu_key']));

        $data['store'] = StoreModel::select('currency_name', 'currency_code')
            ->where('id', $request->logged_user_store_id)
            ->first();

        return view('dashboard.billing_counter_dashboard', $data);
    }
}
