@extends('layouts.layout')
@section('content')
    <addexpensecomponent :expense_categories = "{{json_encode($expenseCategories)}}" :expense_data= "{{json_encode($expenses_data)}}" :selected_expense_id="{{json_encode($selectedExpenseId)}}"></addexpensecomponent>
@endsection