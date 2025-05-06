<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form @submit.prevent="submit_form" class="mb-3">

                    <div class="card-header d-flex flex-wrap mb-4">
                        <div class="mr-auto">
                            <span class="text-title" v-if="delivery_challan_slack == ''">{{ $t("Add Delivery Challan") }}</span>
                            <span class="text-title" v-else>{{ $t("Edit Delivery Challan") }}</span>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-primary" v-bind:disabled="processing == true"> 
                                <i class='fa fa-circle-notch fa-spin' v-if="processing == true"></i> {{ $t("Save") }}
                            </button>
                        </div>
                    </div>
                    
                    <p v-html="server_errors" v-bind:class="[error_class]"></p>

                    <!-- Bill To Section -->
                    <div class="form-row mb-2">
                        <div class="form-group col-md-3">
                            <label for="bill_to">{{ $t("Bill To") }}</label>
                            <select name="bill_to" v-model="bill_to" v-validate="'required'" class="form-control form-control-custom custom-select">
                                <option value="">Choose Bill To..</option>
                                <option v-for="(bill_to_item, index) in bill_to_master_list" v-bind:value="bill_to_item" v-bind:key="index">
                                    {{ bill_to_item }}
                                </option>
                            </select>
                            <span v-bind:class="{ 'error' : errors.has('bill_to') }">{{ errors.first('bill_to') }}</span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="bill_to_slack">{{ $t("Choose Customer") }}</label>
                            <cool-select type="text" name="bill_to_slack" v-validate="'required'" :placeholder="$t('Please choose Customer or Supplier')" autocomplete="off" v-model="bill_to_slack" :items="bill_to_list" item-text="label" itemValue='slack' @search='get_bill_to_list' ref="bill_to_label">
                            </cool-select>
                            <span v-bind:class="{ 'error' : errors.has('bill_to_slack') }">{{ errors.first('bill_to_slack') }}</span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="challan_reference">{{ $t("Challan Reference #") }}</label>
                            <input type="text" name="challan_reference" v-model="challan_reference" v-validate="'max:30'" class="form-control form-control-custom" :placeholder="$t('Please enter Challan Reference #')" autocomplete="off">
                            <span v-bind:class="{ 'error' : errors.has('challan_reference') }">{{ errors.first('challan_reference') }}</span>
                        </div>
                    </div>

                    <!-- Date & Currency Section -->
                    <div class="form-row mb-2">
                        <div class="form-group col-md-3">
                            <label for="delivery_challan_date">{{ $t("Challan Date") }}</label>
                            <date-picker :format="date.format" :lang='date.lang' v-model="delivery_challan_date" v-validate="'required|date_format:yyyy-MM-dd'" input-class="form-control form-control-custom bg-white" ref="delivery_challan_date" name="delivery_challan_date" :placeholder="$t('Please enter Challan Date')" autocomplete="off"></date-picker>
                            <span v-bind:class="{ 'error' : errors.has('delivery_challan_date') }">{{ errors.first('delivery_challan_date') }}</span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="delivery_due_date">{{ $t("Challan Due Date") }}</label>
                            <date-picker :format="date.format" :lang='date.lang' v-model="delivery_due_date" :disabled-date="not_before_order_date" name="delivery_due_date" v-validate="'required|date_format:yyyy-MM-dd'" input-class="form-control form-control-custom bg-white" :placeholder="$t('Please enter Challan Due Date')" autocomplete="off"></date-picker>
                            <span v-bind:class="{ 'error' : errors.has('delivery_due_date') }">{{ errors.first('delivery_due_date') }}</span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="currency">{{ $t("Currency") }}</label>
                            <select name="currency" v-model="currency" v-validate="'required'" class="form-control form-control-custom custom-select">
                                <option value="">Choose Currency..</option>
                                <option v-for="(currency_item, index) in currency_list" v-bind:value="currency_item.currency_code" v-bind:key="index">
                                    {{ currency_item.currency_code }} - {{ currency_item.currency_name }}
                                </option>
                            </select>
                            <span v-bind:class="{ 'error' : errors.has('currency') }">{{ errors.first('currency') }}</span>
                        </div>
                    </div>

                    <!-- Terms Section -->
                    <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <label for="terms">{{ $t("Terms") }}</label>
                            <textarea name="terms" v-model="terms" v-validate="'max:65535'" class="form-control form-control-custom" rows="5" :placeholder="$t('Enter Terms')"></textarea>
                            <span v-bind:class="{ 'error' : errors.has('terms') }">{{ errors.first('terms') }}</span>
                        </div>
                    </div>

                    <!-- Products Section -->
                    <div class="d-flex flex-wrap mb-1">
                        <div class="mr-auto">
                            <span class="text-subhead">{{ $t("Products") }}</span>
                        </div>
                    </div>

                    <!-- Product Search -->
                    <div class="form-row mb-2">
                        <div class="form-group col-md-3" v-show="bill_to == 'CUSTOMER'">
                            <label for="supplier">{{ $t("Choose Supplier") }}</label>
                            <cool-select type="text" name="supplier" :placeholder="$t('Please choose supplier')" autocomplete="off" v-model="supplier" :items="supplier_list" item-text="label" itemValue='slack' @search='load_suppliers'>
                            </cool-select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="barcode">{{ $t("Search and Add Products") }}</label>
                            <cool-select type="text" v-model="search_product" autocomplete="off" inputForTextClass="form-control form-control-custom" :items="product_list" item-text="label" itemValue='label' :resetSearchOnBlur="false" disable-filtering-by-search @search='load_products' @select='add_product_to_list' :placeholder="$t('Start Typing..')"></cool-select>
                        </div>
                    </div>

                    <!-- Products Table -->
                    <div class="form-row">
                        <div class="form-group col-md-4 mb-1">
                            <label for="name">{{ $t("Name & Description") }}</label>
                        </div>
                        <div class="form-group col-md-1 mb-1">
                            <label for="quantity">{{ $t("Quantity") }}</label>
                        </div>
                        <div class="form-group col-md-1 mb-1">
                            <label for="unit_price">{{ $t("Unit Price") }}</label>
                        </div>
                        <div class="form-group col-md-1 mb-1">
                            <label for="discount_percentage">{{ $t("Discount %") }}</label>
                        </div>
                        <div class="form-group col-md-1 mb-1">
                            <label for="tax_percentage">{{ $t("Tax %") }}</label>
                        </div>
                        <div class="form-group col-md-2 mb-1">
                            <label for="amount">{{ $t("Amount") }}</label>
                        </div>
                    </div>

                    <div class="form-row mb-2" v-for="(product, index) in products" :key="index">
                        <div class="form-group col-md-4">
                            <input type="text" v-bind:name="'product.name_'+index" v-model="product.name" v-validate="'required|max:250'" data-vv-as="Name" class="form-control form-control-custom" autocomplete="off">
                            <span v-bind:class="{ 'error' : errors.has('product.name_'+index) }">{{ errors.first('product.name_'+index) }}</span>
                        </div>
                        <div class="form-group col-md-1">
                            <input type="number" v-bind:name="'product.quantity_'+index" v-model="product.quantity" v-validate="'required|decimal|min_value:1'" data-vv-as="Quantity" class="form-control form-control-custom" autocomplete="off" step="1" min="0" v-on:input="calculate_price">
                            <span v-bind:class="{ 'error' : errors.has('product.quantity_'+index) }">{{ errors.first('product.quantity_'+index) }}</span>
                        </div>
                        <div class="form-group col-md-1">
                            <input type="number" v-bind:name="'product.unit_price_'+index" v-model="product.unit_price" v-validate="'required|decimal|min_value:0'" data-vv-as="Unit Price" class="form-control form-control-custom" autocomplete="off" step="0.01" min="0" v-on:input="calculate_price">
                            <span v-bind:class="{ 'error' : errors.has('product.unit_price_'+index) }">{{ errors.first('product.unit_price_'+index) }}</span>
                        </div>
                        <div class="form-group col-md-1">
                            <input type="number" v-bind:name="'product.discount_percentage_'+index" v-model="product.discount_percentage" v-validate="'decimal|min_value:0'" data-vv-as="Discount %" class="form-control form-control-custom" autocomplete="off" step="0.01" min="0" v-on:input="calculate_price">
                        </div>
                        <div class="form-group col-md-1">
                            <input type="number" v-bind:name="'product.tax_percentage_'+index" v-model="product.tax_percentage" v-validate="'decimal|min_value:0'" data-vv-as="Tax %" class="form-control form-control-custom" autocomplete="off" step="0.01" min="0" v-on:input="calculate_price">
                        </div>
                        <div class="form-group col-md-2">
                            <input type="number" v-bind:name="'product.amount_'+index" v-model="product.amount" v-validate="'required|decimal|min_value:0'" data-vv-as="Amount" class="form-control form-control-custom" autocomplete="off" step="0.01" min="0" readonly>
                        </div>
                        <div class="form-group col-md-1" v-if="products.length>1">
                            <button type="button" class="btn btn-outline-danger" @click="remove_product(index)"><i class="fas fa-times"></i></button>
                        </div>
                    </div>

                    <button type="button" class="btn btn-sm btn-outline-primary" @click="add_new_product">{{ $t("Add More") }}</button>

                    <!-- Charges Section -->
                    <div class="form-row mb-3">
                        <div class="col-md-2 offset-md-7 text-right">
                            <span class="align-text-top">{{ $t("Shipping Charge") }}</span>
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="shipping_charge" v-model="shipping_charge" v-validate="'decimal|min_value:0'" class="form-control form-control-custom" autocomplete="off" step="0.01" min="0" v-on:input="calculate_price">
                        </div>
                    </div>

                    <div class="form-row mb-3">
                        <div class="col-md-2 offset-md-7 text-right">
                            <span class="align-text-top">{{ $t("Packing Charge") }}</span>
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="packing_charge" v-model="packing_charge" v-validate="'decimal|min_value:0'" class="form-control form-control-custom" autocomplete="off" step="0.01" min="0" v-on:input="calculate_price">
                        </div>
                    </div>

                    <!-- Total Section -->
                    <div class="form-row mb-3">
                        <div class="col-md-2 offset-md-7 text-right">
                            {{ $t("Total") }}
                        </div>
                        <div class="col-md-2">
                            {{ grand_total }}
                        </div>
                    </div>

                </form>
            </div>

            <!-- Modal Component -->
            <modalcomponent v-if="show_modal" v-on:close="show_modal = false">
                <template v-slot:modal-header>
                    {{ $t("Confirm") }}
                </template>
                <template v-slot:modal-body>
                    {{ $t("Are you sure you want to proceed?") }}
                </template>
                <template v-slot:modal-footer>
                    <button type="button" class="btn btn-light" @click="$emit('close')">Cancel</button>
                    <button type="button" class="btn btn-primary" @click="$emit('submit')" v-bind:disabled="processing == true">
                        <i class='fa fa-circle-notch fa-spin' v-if="processing == true"></i> Continue
                    </button>
                </template>
            </modalcomponent>

        </div>
    </div>
</template>

<script>
    'use strict';
    
    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';
    import moment from "moment";
    import { CoolSelect } from "vue-cool-select";
    import 'vue-cool-select/dist/themes/bootstrap.css';

    export default {
        components: {
            DatePicker,
            CoolSelect
        },
        data(){
            return{
                date: {
                    lang: 'en',
                    format: "YYYY-MM-DD"
                },
                server_errors   : '',
                error_class    : '',
                processing     : false,
                modal         : false,
                show_modal    : false,
                api_link      : (this.delivery_challan_data == null)?'/api/add_delivery_challan':'/api/update_delivery_challan/'+this.delivery_challan_data.slack,

                bill_to_master_list: ['CUSTOMER'],
                bill_to_list: [],
                product_list: [],
                supplier_list: [],
                search_product: '',
                supplier: '',

                delivery_challan_slack: (this.delivery_challan_data == null)?'':(this.delivery_challan_data.slack != null)?this.delivery_challan_data.slack:'',
                bill_to: (this.delivery_challan_data == null)?'':this.delivery_challan_data.bill_to,
                bill_to_slack: (this.delivery_challan_data == null)?'':this.delivery_challan_data.bill_to_slack,
                challan_reference: (this.delivery_challan_data == null)?'':(this.delivery_challan_data.delivery_challan_reference != null)?this.delivery_challan_data.delivery_challan_reference:'',
                delivery_challan_date: (this.delivery_challan_data == null)?'':(this.delivery_challan_data.delivery_challan_date_raw != null)?new Date(this.delivery_challan_data.delivery_challan_date_raw):'',
                delivery_due_date: (this.delivery_challan_data == null)?'':(this.delivery_challan_data.delivery_due_date_raw != null)?new Date(this.delivery_challan_data.delivery_due_date_raw):'',
                currency: (this.delivery_challan_data == null)?'':(this.delivery_challan_data.currency_code != null)?this.delivery_challan_data.currency_code:'',
                
                shipping_charge: (this.delivery_challan_data == null)?'':(this.delivery_challan_data.shipping_charge != null)?this.delivery_challan_data.shipping_charge:'',
                packing_charge: (this.delivery_challan_data == null)?'':(this.delivery_challan_data.packing_charge != null)?this.delivery_challan_data.packing_charge:'',
                terms: (this.delivery_challan_data == null)?'':(this.delivery_challan_data.terms != null)?this.delivery_challan_data.terms:'',

                products: [],
                products_template: {
                    slack: '',
                    name: '',
                    quantity: '',
                    unit_price: '',
                    discount_percentage: '',
                    tax_type: 'EXCLUSIVE',
                    tax_percentage: '',
                    amount: ''
                },

                grand_total: 0,

                tax_types: [
                    {
                        tax_type_constant: 'EXCLUSIVE',
                        label: 'Excl.'
                    },
                    {
                        tax_type_constant: 'INCLUSIVE',
                        label: 'Inc.'
                    }
                ]
            }
        },

        props: {
            currency_list: Array,
            delivery_challan_data: [Array, Object],
            tax_options: [Array, Object],
            challan_type: String
        },

        mounted() {
            console.log('Add delivery challan page loaded');
            if(this.delivery_challan_data != null){
                this.load_delivery_challan_data();
            }else{
                this.products.push({...this.products_template});
            }
        },

        methods: {
            load_delivery_challan_data(){
                this.bill_to_changed();
                if(this.delivery_challan_data.products != null && this.delivery_challan_data.products.length > 0){
                    this.products = [];
                    this.delivery_challan_data.products.forEach(item => {
                        this.products.push({
                            slack: item.product_slack,
                            name: item.name,
                            quantity: item.quantity,
                            unit_price: item.unit_price,
                            discount_percentage: item.discount_percentage,
                            tax_type: item.tax_type,
                            tax_percentage: item.tax_percentage,
                            amount: item.amount
                        });
                    });
                }
                this.calculate_price();
            },

            convert_date_format(date){
                return (date != '')?moment(date).format("YYYY-MM-DD"):'';
            },

            not_before_order_date(date) {
                return date < this.delivery_challan_date;
            },

            bill_to_changed(){
                if(this.bill_to != ''){
                    this.get_bill_to_list();
                }
            },

            get_bill_to_list(){
                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);
                
                formData.append("type", this.bill_to);
                axios.post('/api/get_bill_to_list', formData).then((response) => {
                    if(response.data.status_code == 200) {
                        
                        this.bill_to_list = response.data.data;
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
            },

            load_suppliers(keywords){
                if(typeof keywords != 'undefined' && keywords.length > 0){
                    var formData = new FormData();
                    formData.append("access_token", window.settings.access_token);
                    formData.append("keywords", keywords);

                    axios.post('/api/load_suppliers', formData).then((response) => {
                        if(response.data.status_code == 200) {
                            this.supplier_list = response.data.data;
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    });
                }
            },

            load_products(keywords){
                if(typeof keywords != 'undefined' && keywords.length > 0){
                    var supplier = (this.bill_to == 'customer')?this.bill_to_slack:this.supplier;
                    
                    var formData = new FormData();
                    formData.append("access_token", window.settings.access_token);
                    formData.append("keywords", keywords);
                    formData.append("customer", supplier);

                    axios.post('/api/load_product_for_po', formData).then((response) => {
                        if(response.data.status_code == 200) {
                            this.product_list = response.data.data;
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    });
                }
            },

            add_product_to_list(item){
                if(item.product_slack != ''){
                    var current_product = {
                        slack: item.product_slack,
                        name: item.label,
                        quantity: 1,
                        unit_price: item.sale_amount_excluding_tax,
                        discount_percentage: item.discount_percentage,
                        tax_percentage: item.tax_percentage,
                        amount: ''
                    };

                    if(this.products[0].name == '' && this.products[0].quantity == '' && this.products[0].unit_price == ''){
                        this.$set(this.products, 0, current_product);
                    }else{
                        this.products.push(current_product);
                    }
                    this.product_list = [];
                    this.calculate_price();
                }
            },

            add_new_product(){
                this.products.push({...this.products_template});
            },

            remove_product(index){
                this.products.splice(index, 1);
                this.calculate_price();
            },

            calculate_price(){
                var grand_total = 0;
                for(var index in this.products){
                    var quantity = this.products[index].quantity;
                    var unit_price = this.products[index].unit_price;
                    var discount_percentage = (this.products[index].discount_percentage != '')?parseFloat(this.products[index].discount_percentage):0;
                    var tax_percentage = (this.products[index].tax_percentage != '')?parseFloat(this.products[index].tax_percentage):0;

                    if(!isNaN(quantity) && quantity != '' && !isNaN(unit_price) && unit_price != ''){
                        var amount_before_discount = quantity * unit_price;
                        var discount_amount = amount_before_discount * (discount_percentage/100);
                        var amount_after_discount = amount_before_discount - discount_amount;
                        var tax_amount = amount_after_discount * (tax_percentage/100);
                        var total_amount = amount_after_discount + tax_amount;

                        this.products[index].amount = total_amount.toFixed(2);
                        grand_total += parseFloat(total_amount);
                    }
                }

                var shipping_charge = (this.shipping_charge != '')?parseFloat(this.shipping_charge):0;
                var packing_charge = (this.packing_charge != '')?parseFloat(this.packing_charge):0;

                this.grand_total = (grand_total + shipping_charge + packing_charge).toFixed(2);
            },

            submit_form(){
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.show_modal = true;
                        this.$on("submit", () => {
                            this.processing = true;
                            var formData = new FormData();

                            formData.append("access_token", window.settings.access_token);
                            formData.append("bill_to", this.bill_to);
                            formData.append("bill_to_slack", this.bill_to_slack);
                            formData.append("challan_reference", this.challan_reference);
                            formData.append("delivery_challan_date", this.convert_date_format(this.delivery_challan_date));
                            formData.append("delivery_due_date", this.convert_date_format(this.delivery_due_date));
                            formData.append("currency", this.currency);
                            formData.append("shipping_charge", this.shipping_charge || 0);
                            formData.append("packing_charge", this.packing_charge || 0);
                            formData.append("terms", this.terms);
                            formData.append("products", JSON.stringify(this.products));
                            formData.append("challan_type", this.challan_type);

                            axios.post(this.api_link, formData)
                            .then((response) => {
                                if(response.data.status_code == 200) {
                                    this.show_response_message(response.data.msg, 'SUCCESS');
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1000);
                                }else{
                                    this.show_modal = false;
                                    this.processing = false;
                                    try{
                                        var error_json = JSON.parse(response.data.msg);
                                        this.loop_api_errors(error_json);
                                    }catch(err){
                                        this.server_errors = response.data.msg;
                                    }
                                    this.error_class = 'error';
                                }
                            })
                            .catch((error) => {
                                console.log(error);
                            });
                        });

                        this.$on("close", () => {
                            this.show_modal = false;
                        });
                    }
                });
            },

            show_response_message(msg, type){
                if(type == 'SUCCESS'){
                    this.processing = false;
                    toastr.success(msg);
                }else if(type == 'ERROR'){
                    this.processing = false;
                    toastr.error(msg);
                }
            }
        }
    }
</script>

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

.mb-2,
.my-2 {
    margin-left: 10px;
    margin-bottom: 0.5rem !important;
}

.mb-1,
.my-1 {
    margin-bottom: 0.25rem !important;
    margin-left: 10px;
}

.form-row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: 10px;
    margin-left: 10px;
}
</style>