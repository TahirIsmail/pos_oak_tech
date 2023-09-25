@extends('layouts.layout')

@section("content")
<expensedetailcomponent :expense="{{ json_encode($expense_data) }}" :delete_access="{{ json_encode($delete_access) }}"></expensedetailcomponent>
@endsection