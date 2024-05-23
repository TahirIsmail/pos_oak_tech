<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

use App\Http\Resources\ProductResource;

use Carbon\Carbon;

class ProductExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    protected $serialNumber = 1;
    
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function collection()
    {
        $from_created_date = $this->data['from_created_date'];
        $to_created_date = $this->data['to_created_date'];
        $supplier = $this->data['supplier'];
        $category = $this->data['category'];
        $tax_code = $this->data['tax_code'];
        $discount_code = $this->data['discount_code'];
        $product_type = $this->data['product_type'];
        $status = $this->data['status'];

        $query = Product::with('product_specifications.category_specification_details')
            ->select('products.*', 'category.id as category_id', 'suppliers.id as supplier_id', 'tax_codes.id as tax_code_id', 'discount_codes.id as discount_code_id')
            ->categoryJoin()
            ->supplierJoin()
            ->taxcodeJoin()
            ->discountcodeJoin();

        if ($from_created_date != '') {
            $from_created_date = strtotime($from_created_date);
            $from_created_date = date(config('app.sql_date_format'), $from_created_date);
            $from_created_date = $from_created_date . ' 00:00:00';
            $query = $query->where('products.created_at', '>=', $from_created_date);
        }
        if ($to_created_date != '') {
            $to_created_date = strtotime($to_created_date);
            $to_created_date = date(config('app.sql_date_format'), $to_created_date);
            $to_created_date = $to_created_date . ' 23:59:59';
            $query = $query->where('products.created_at', '<=', $to_created_date);
        }
        if ($supplier != '') {
            $query = $query->where('suppliers.slack', $supplier);
        }
        if ($category != '') {
            $query = $query->where('products.category_id', $category);
        }
        if ($tax_code != '') {
            $query = $query->where('tax_codes.slack', $tax_code);
        }
        if ($discount_code != '') {
            $query = $query->where('discount_codes.slack', $discount_code);
        }
        if (isset($status)) {
            $query = $query->where('products.status', $status);
        }

        $query = $query->when($product_type == 'billing_products', function ($query) {
            $query->mainProduct();
        });

        $query = $query->when($product_type == 'ingredients', function ($query) {
            $query->isIngredient();
        });

        $products = $query->get();
        return $products;
    }

    public function headings(): array
    {
        return [
            'S.NO',
            'SERIAL NO',
            'PRODUCT NAME',
            'MODEL',
            'SUPPLIER NAME',
            'CATEGORY NAME',          
            'QUANTITY',
            'PURCHASE PRICE',
            'SALE PRICE',
            'STATUS',
            'CREATED BY',
        ];
    }

    public function map($product): array
    {
        $product = collect(new ProductResource($product));
        $modelDetails = '';
        if (isset($product['product_specifications'])) {
            foreach ($product['product_specifications'] as $specification) {
                if ($specification['specification_label'] === 'Model') {
                    $modelDetails = $specification['specification_details'];
                    break;
                }
            }
        }
        return [
            $this->serialNumber++,
            (isset($product['product_code']))?$product['product_code']:'',
            (isset($product['name']))?$product['name']:'',
            $modelDetails,
            
            (isset($product['supplier']['name']))?$product['supplier']['name']:'',

            (isset($product['category']['label']))?$product['category']['label']:'',         
            
            (isset($product['quantity']))?$product['quantity']:'',
            (isset($product['purchase_amount_excluding_tax'])) ? number_format($product['purchase_amount_excluding_tax']):'',
            (isset($product['sale_amount_excluding_tax'])) ? number_format($product['sale_amount_excluding_tax']):'',

            (isset($product['status']['label']))?$product['status']['label']:'',
            (isset($product['created_by']['fullname']))?$product['created_by']['fullname']:'',
        ];
    }
}
