<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryChallanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $request->request->add(['blocking_recurring_data_in_transaction' => true]);
        $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
        
        return [
            'slack' => $this->slack,
            'delivery_challan_number' => $this->delivery_challan_number,
            'delivery_challan_reference' => $this->delivery_challan_reference,
            'delivery_challan_date' => $this->parseDateOnly($this->delivery_challan_date),
            'delivery_due_date' => $this->parseDateOnly($this->delivery_due_date),
            'delivery_challan_date_raw' => $this->delivery_challan_date,
            'delivery_due_date_raw' => $this->delivery_due_date,
            'parent_po_id' => $this->parent_po_id,
            'bill_to' => $this->bill_to,
            'delivery_against_po_from_customer' => $this->delivery_against_po_from_customer,
            
            'bill_to_id' => $this->bill_to_id,
            'bill_to_code' => $this->bill_to_code,
            'bill_to_name' => $this->bill_to_name,
            'bill_to_email' => $this->bill_to_email,
            'bill_to_contact' => $this->bill_to_contact,
            'bill_to_address' => $this->bill_to_address,

            'bill_from_id' => $this->bill_from_id,
            'bill_from_code' => $this->bill_from_code,
            'bill_from_name' => $this->bill_from_name,
            'bill_from_email' => $this->bill_from_email,
            'bill_from_contact' => $this->bill_from_contact,
            'bill_from_address' => $this->bill_from_address,

            'supplier' => ($this->bill_to == "SUPPLIER")? new SupplierResource($this->supplier):'',
            'customer' => ($this->bill_to == "CUSTOMER")?new CustomerResource($this->customer):'',
            'user' => ($this->bill_to == "OAK TECHNOLOGY")?new UserResource($this->user):'',

            'currency_name' => $this->currency_name,
            'currency_code' => $this->currency_code,
            
            'subtotal_excluding_tax' => $this->subtotal_excluding_tax,
            'total_discount_amount' => $this->total_discount_amount,
            'total_after_discount' => $this->total_after_discount,
            'total_tax_amount' => $this->total_tax_amount,
            'shipping_charge' => $this->shipping_charge,
            'packing_charge' => $this->packing_charge,
            'total_order_amount' => $this->total_order_amount,
            
            'tax_option_data' => new MasterTaxOptionResource($this->tax_option_data),
            'terms' => $this->terms,
            'words' => $f->format($this->total_order_amount),
            'products' => InvoiceProductResource::collection($this->products),
            'store' => new StoreResource($this->storeData),
            'status' => new MasterStatusResource($this->status_data),
            'transactions' => TransactionResource::collection($this->transactions),
            
            'detail_link' => (check_access(['A_DETAIL_DELIVERY_CHALLAN'], true))?route('delivery_challan_detail', ['slack' => $this->slack]):'',
            
            'created_at_label' => $this->parseDate($this->created_at),
            'updated_at_label' => $this->parseDate($this->updated_at),
            'created_by' => new UserResource($this->createdUser),
            'updated_by' => new UserResource($this->updatedUser)
        ];
    }
}