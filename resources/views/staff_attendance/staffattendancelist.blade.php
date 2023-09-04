@extends('layouts.layout')

@section("content")
<div class="row">
    <div class="col-md-12">
        
        <form @submit.prevent="submit_form" class="mb-3">

            <div class="d-flex flex-wrap mb-4">
                <div class="mr-auto">
                    <span class="text-title">Product Label</span>
                </div>
                <div class="">
                    <button type="submit" class="btn btn-primary" v-bind:disabled="processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="processing == true"></i>Search Staff List</button>
                </div>
            </div>
                
            <p v-html="server_errors" v-bind:class="[error_class]"></p>

            <div class="form-row mb-2">
                <div class="form-group col-md-3">
                    <label for="supplier">{{ $t("Choose Supplier") }}</label>
                    <cool-select type="text" name="supplier" :placeholder="$t('Please choose supplier')"  autocomplete="off" v-model="supplier" :items="supplier_list" item-text="label" itemValue='slack' @search='load_suppliers'></cool-select>
                </div>
                <div class="form-group col-md-3">
                    <label for="barcode">{{ $t("Search and Choose Products") }}</label>
                    <cool-select type="text" v-model="search_product"  autocomplete="off" inputForTextClass="form-control form-control-custom" :placeholder="Start Typing.."></cool-select>
                </div>
            </div> 

        </form>
            
    </div>
@endsection