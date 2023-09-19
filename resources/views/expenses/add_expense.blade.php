@extends('layouts.layout')
@section('content')
    <addexpensecomponent :expense_categories = "{{json_encode($expenseCategories)}}" :expense_data= "{{json_encode($expenses_data)}}" @if(!empty($selectedExpenseCatId)):selected_expense_cat_id="{{json_encode($selectedExpenseCatId)}}"@endif></addexpensecomponent>
@endsection