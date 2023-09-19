<?php

namespace App\Http\Controllers;

use App\Models\MasterExpenseCategory;
use App\Http\Requests\StoreMasterExpenseCategoryRequest;
use App\Http\Requests\UpdateMasterExpenseCategoryRequest;

class MasterExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMasterExpenseCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMasterExpenseCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterExpenseCategory  $masterExpenseCategory
     * @return \Illuminate\Http\Response
     */
    public function show(MasterExpenseCategory $masterExpenseCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterExpenseCategory  $masterExpenseCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterExpenseCategory $masterExpenseCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMasterExpenseCategoryRequest  $request
     * @param  \App\Models\MasterExpenseCategory  $masterExpenseCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMasterExpenseCategoryRequest $request, MasterExpenseCategory $masterExpenseCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterExpenseCategory  $masterExpenseCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterExpenseCategory $masterExpenseCategory)
    {
        //
    }
}
