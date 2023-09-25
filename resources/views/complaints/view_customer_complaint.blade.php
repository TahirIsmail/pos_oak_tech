@extends('layouts.layout')
@section('content')
<viewcustomercomplaint @if(isset($Customer_complaint_make_invoice)) :Customer_complaint_make_invoice="{{ $Customer_complaint_make_invoice }}" @endif @if(isset($requirement_request_access)) :requirement_request_access="{{ $requirement_request_access }}" @endif  @if(isset($assign_access)) :assign_access="{{ $assign_access }}" @endif  @if(isset($delete_access)) :delete_access="{{ $delete_access }}" @endif  :complaint="{{ json_encode($complaint) }}" :labusers="{{ json_encode($labTechnician) }}"></viewcustomercomplaint>
@endsection