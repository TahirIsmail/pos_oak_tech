<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'slack' => $this->slack,
            'type' => $this->customer_type,
            'customer_id' => $this->customer_id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'mobile_number' => $this->mobile_number,
            'account_opening_date' => $this->account_opening_date,
            'customer_strn' => $this->customer_strn,
            'customer_ntn' => $this->customer_ntn,
            'customer_type' => $this->customer_type,
            'account_manager' => $this->account_manager,
            'contact_people' => $this->customer_contact_people,
            'address' => $this->address,
            'country' => $this->country,
            'city' => $this->city,
            'father_name' => $this->father_name,
            'gender' => $this->gender,
            'cnic' => $this->cnic,
            'cheque_due_date' => $this->cheque_due_date,
            'cheque_limit' => $this->cheque_limit,
            'reference_name' => $this->reference_name,
            'reference_mobile' => $this->reference_mobile,
            'reference_cnic' => $this->reference_cnic,
            'cheque_image' => $this->cheque_image, 
            'cnic_image' => $this->cnic_image,
            'dob' => $this->parseDateOnly($this->dob),
            'dob_raw' => $this->dob,
            'user' => $this->user,
            'status' => new MasterStatusResource($this->status_data),
            'detail_link' => (check_access(['A_DETAIL_CUSTOMER'], true))?route('customer', ['slack' => $this->slack]):'',
            'created_at_label' => $this->parseDate($this->created_at),
            'updated_at_label' => $this->parseDate($this->updated_at),
            'created_by' => new UserResource($this->createdUser),
            'updated_by' => new UserResource($this->updatedUser)
        ];
    }
}
