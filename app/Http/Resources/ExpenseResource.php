<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MasterStatusResource;
use App\Http\Resources\UserResource;

class ExpenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $request->request->add(['blocking_recurring_data_in_transaction' => true]);
   
        return [
            'slack' => $this->slack,
            'expense_name' => $this->expense_name,
            'expense_category' => $this->expenseCategory->name,
            'amount' => $this->amount,
            'notes' => $this->notes,
            'status' => new MasterStatusResource($this->status_data),
            'detail_link' => (check_access(['A_DETAIL_EXPENSE'], true)) ? route('view_expensess', ['slack' => $this->slack]) : '',
            'created_at_label' => $this->parseDate($this->created_at),
            'updated_at_label' => $this->parseDate($this->updated_at),
            'transactin_id' => $this->transaction_id,
            'created_by' => new UserResource($this->createdUser),
            'updated_by' => new UserResource($this->updatedUser)
        ];
    }
}
