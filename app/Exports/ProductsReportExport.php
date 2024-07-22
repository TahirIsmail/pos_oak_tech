<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use Carbon\Carbon;

class ProductsReportExport implements FromCollection, WithMapping, WithHeadings, WithStyles
{
    use Exportable;

    private $specificationLabels = [];
    protected $serialNumber = 1;
    private $seenRows = [];
    private $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
        $this->specificationLabels = $this->getSpecificationLabels();
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

        // $query = $query->when($product_type == 'ingredients', function ($query) {
        //     $query->isIngredient();
        // });

        $products = $query->get();
        return $products;
    }

    public function headings(): array
    {
        $headings = [
            'Serial No#',
            'PRODUCT NAME',
        ];

        foreach ($this->specificationLabels as $label) {
            $headings[] = $label;
        }

        $headings[] = 'PRICES';

        return $headings;
    }

    public function map($product): array
    {
        $mapped = [
            $product->product_code ?? '',
            $product->name ?? '',
        ];

        // Add product specifications
        $specificationDetails = [];
        if (isset($product->product_specifications)) {
            foreach ($this->specificationLabels as $label) {
                $found = false;
                foreach ($product->product_specifications as $specification) {
                    if ($specification->specification_label === $label) {
                        if ($specification->specification_label == 'Model') {
                            $specificationDetails['Model'] = $specification->specification_details;
                            $found = true;
                            break;
                        } else {
                            $specificationDetails[$label] = $specification->category_specification_details['values'] ?? '';
                            $found = true;
                            break;
                        }
                    }
                }
                if (!$found && $label != 'Model') {
                    $specificationDetails[$label] = ''; // Add empty string if specification not found
                }
            }
        } else {
            foreach ($this->specificationLabels as $label) {
                if ($label != 'Model') {
                    $specificationDetails[$label] = '';
                }
            }
        }

        // Create a row without the 'Model' for duplicate checking
        // $checkRow = array_filter($specificationDetails, function($key) {
        //     return $key !== 'Model';
        // }, ARRAY_FILTER_USE_KEY);

        $saleAmount = $product->sale_amount_excluding_tax ?? null;

        // Check if the row is unique except for the 'Model'
        // $serializedRow = serialize($checkRow);
        // if (in_array($serializedRow, $this->seenRows)) {
        //     return []; // Skip the row if it has already been seen
        // }
        // Add the row to the seen rows
        // $this->seenRows[] = $serializedRow;
        // Append the 'Model' and sale amount to the mapped row
        
        $specificationDetails = array_values($specificationDetails);
        $mapped = array_merge($mapped, $specificationDetails);
        $mapped[] = $saleAmount;
        return $mapped;
    }

    private function getSpecificationLabels(): array
    {
        $query = Product::with('product_specifications');

        if (!empty($this->data['category'])) {
            $query->where('category_id', $this->data['category']);
        }

        return $query->get()
            ->pluck('product_specifications')
            ->flatten(1)
            ->pluck('specification_label')
            ->unique()
            ->toArray();
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold and blue
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => Color::COLOR_WHITE],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['argb' => '103663'], // Blue color
                ],
            ],
        ];
    }
}
