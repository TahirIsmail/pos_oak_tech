@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex flex-wrap mb-4">
                    <div class="mr-auto">
                        <span class="text-title">{{ __('Products') }}</span>
                    </div>
                    <div class="">
                        @if (check_access(['A_ADD_PRODUCT'], true))
                            <a href="{{ route('add_product') }}" role="button"
                                class="btn btn-primary">{{ __('New Product') }}</a>
                        @endif
                    </div>
                </div>

                {{-- <div class="form-row mb-1">
            <div class="form-group col-md-3">
                <label for="product_type_filter">{{ __("Filter Product") }}</label>
                <select name="product_type_filter" id="product_type_filter" class="form-control form-control-custom custom-select">
                    <option value="all">All</option>
                    <option value="billing_products" selected>Billing Products</option>
                    <option value="addon_products">Add-on Products</option>
                    @if ($restaurant_mode)
                    <option value="ingredients">Ingredients</option>
                    @endif
                </select>
            </div>
        </div> --}}

        <div class="table-responsive">
            <table id="listing-table" class="display table nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __("Product Code") }}</th>
                        <th>{{ __("Name") }}</th>
                        <th>{{ __("Supplier") }}</th>
                        <th>{{ __("Category") }}</th>
                        <th>{{ __("Tax Code") }}</th>
                        <th>{{ __("Discount Code") }}</th>
                        <th>{{ __("Quantity") }}</th>
                        <th>{{ __("Amount") }}</th>
                        <th>{{ __("Status") }}</th>
                        <th>{{ __("Product Status") }}</th>
                        <th>{{ __("Created On") }}</th>
                        <th>{{ __("Updated On") }}</th>
                        <th>{{ __("Created By") }}</th>
                        <th>{{ __("Action") }}</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="{{ asset('js/pages/products.js') }}"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.9/js/dataTables.fixedHeader.min.js"></script>
    <script>
        'use strict';
        var products = new Products();
        products.load_listing_table().val();

        // $(document).on('change', '#product_type_filter', function(){
        //     var product_type = $(this).val();
        //     products.load_listing_table(product_type);
        //     event = new CustomEvent("product_type_filter", { "detail": product_type });
        //     document.dispatchEvent(event);
        // });
        // $(document).ready(function(){
        //     var product_type = $('#product_type_filter').val();
        //     event = new CustomEvent("product_type_filter", { "detail": product_type });
        //     document.dispatchEvent(event);
        // });
    </script>
@endpush
<style scoped>
    .card-header {
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: rgba(0, 0, 0, .03);
        border-bottom: 1px solid rgba(0, 0, 0, .125);
    }


    .card {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, .125);
        border-radius: 0.25rem;
    }

    .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
        margin-left: 18px;
    }
</style>
