@if($data['is_paid'] == 0)
<button class="btn btn-danger" onclick="updateGstStatus({{ $data['id'] }})">Unpaid</button>
@else
<button class="btn btn-success">Paid</button>
@endif