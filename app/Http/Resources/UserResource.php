<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $profile_image = config('constants.upload.profile.default');
        if($this->profile_image != ''){
            $profile_image = config('constants.upload.profile.view_path').'medium_'.$this->profile_image;
        }
        return [
            'slack' => $this->slack,
            'user_code' => $this->user_code,
            'fullname' => $this->fullname,
            'father_name' => $this->father_name,
            'gender' => $this->gender,
            'cnic' => $this->cnic,
            'dob' => $this->dob,
            'doj' => $this->doj,
            'country' => $this->country,
            'city' => $this->city,
            'address' => $this->address,
            'reference' => $this->reference,
            'email' => $this->email,
            'phone' => $this->phone,
            'emergency_number' => $this->emergency_number,
            "bank_name" => $this->bank_name,
            "bank_code" => $this->bank_code,
            "account_title" => $this->account_title,
            "account_number" => $this->account_number,
            "iban_number" => $this->iban_number,
            'role' => new RoleResource($this->role),
            'status' => new MasterStatusResource($this->status_data),
            'profile_images' => $this->profile_image,
            'profile_image' => $profile_image,
            'line_manager' => $this->manager,
            'init_pass' => $this->init_password,
            'detail_link' => (check_access(['A_DETAIL_USER'], true))?route('user', ['slack' => $this->slack]):'',
            'created_at_label' => $this->parseDate($this->created_at),
            'updated_at_label' => $this->parseDate($this->updated_at),
            'created_by' => $this->createdUser,
            'updated_by' => $this->updatedUser
        ];
    }
}
