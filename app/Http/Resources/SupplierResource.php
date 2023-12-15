<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
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
        
        return [
            'slack' => $this->slack,
            'supplier_code' => $this->supplier_code,
            'supplier_id' => $this->supplier_id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'city' => $this->city,
            'country' => $this->country,
            'gender' => $this->gender,
            'pincode' => $this->pincode,
            'banks' => $this->bank_details,
            'business_type' => $this->business_type,
            'contact_people' => $this->contact_persons,
            'status' => new MasterStatusResource($this->status_data),
            'detail_link' => (check_access(['A_DETAIL_SUPPLIER'], true))?route('supplier', ['slack' => $this->slack]):'',
            'created_at_label' => $this->parseDate($this->created_at),
            'updated_at_label' => $this->parseDate($this->updated_at),
            'created_by' => new UserResource($this->createdUser),
            'updated_by' => new UserResource($this->updatedUser)
        ];
    }
}
