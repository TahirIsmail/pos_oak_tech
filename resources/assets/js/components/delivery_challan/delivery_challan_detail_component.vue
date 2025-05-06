<template>
    <div class="row">
       
        <div class="col-md-12">
            <div class="card p-4">
                <div class="d-flex flex-wrap mb-4">
                    <div class="mr-auto">
                        <div class="d-flex">
                            <div>
                                <span class="text-title"> {{ $t("Delivery Challan") }} #{{ challan_basic.delivery_challan_number }} </span>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <span v-bind:class="challan_basic.status.color">{{ challan_basic.status.label }}</span>
                    </div>
                </div>

                <div class="d-flex flex-wrap mb-4">
                    <p v-html="server_errors" v-bind:class="[error_class]"></p>

                    <div class="ml-auto">
                        <button class="btn btn-outline-primary mr-1" v-if="printnode_enabled == true" v-on:click="printnode_print('DELIVERY_CHALLAN')" v-bind:disabled="printing_processing == true"> 
                            <i class='fa fa-circle-notch fa-spin' v-if="printing_processing == true"></i> {{ $t("Print") }}
                        </button>

                        <a class="btn btn-outline-primary mr-1" v-bind:href="'/print_delivery_challan/'+slack" target="_blank">{{ $t("PDF") }}</a>

                        <button type="submit" class="btn btn-danger mr-1" v-if="delete_challan_access == true" v-on:click="delete_challan()" v-bind:disabled="challan_delete_processing == true">
                            <i class='fa fa-circle-notch fa-spin' v-if="challan_delete_processing == true"></i> {{ $t("Delete Challan") }}
                        </button>

                        <div class="dropdown d-inline" v-if="challan_statuses != ''">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="challan_action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $t("Change Status") }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="challan_action">
                                <button class="dropdown-item" type="button" v-for="(challan_status, key, index) in challan_statuses" v-bind:value="challan_status.value_constant" v-bind:key="index" v-on:click="change_challan_status(challan_status.value_constant)">
                                    Mark as {{ challan_status.label }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="mb-2">
                    <span class="text-subhead">{{ $t("Basic Information") }}</span>
                </div>
                <div class="form-row mb-2">
                    <div class="form-group col-md-3">
                        <label for="challan_reference">{{ $t("Reference Number") }}</label>
                        <p>{{ challan_basic.delivery_challan_reference }}</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="challan_date">{{ $t("Challan Date") }}</label>
                        <p>{{ challan_basic.delivery_challan_date }}</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="challan_due_date">{{ $t("Challan Due Date") }}</label>
                        <p>{{ challan_basic.delivery_due_date }}</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="created_by">{{ $t("Created By") }}</label>
                        <p>{{ (challan_basic.created_by == null)?'-':challan_basic.created_by['fullname']+' ('+challan_basic.created_by['user_code']+')' }}</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="updated_by">{{ $t("Updated By") }}</label>
                        <p>{{ (challan_basic.updated_by == null)?'-':challan_basic.updated_by['fullname']+' ('+challan_basic.updated_by['user_code']+')' }}</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="created_on">{{ $t("Created On") }}</label>
                        <p>{{ challan_basic.created_at_label }}</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="updated_on">{{ $t("Updated On") }}</label>
                        <p>{{ challan_basic.updated_at_label }}</p>
                    </div>
                </div>
                <hr>

                <div class="mb-3">
                    <div class="mb-2">
                        <span class="text-subhead">{{ $t("Customer Information") }}</span>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col-md-3">
                            <label for="customer_name">{{ $t("Customer Name") }}</label>
                            <p>{{ (challan_basic.bill_to_name != null)?challan_basic.bill_to_name:'-' }}</p>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="customer_email">{{ $t("Customer Email") }}</label>
                            <p>{{ (challan_basic.bill_to_email != null)?challan_basic.bill_to_email:'-' }}</p>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="customer_phone">{{ $t("Customer Phone") }}</label>
                            <p>{{ (challan_basic.bill_to_contact != null)?challan_basic.bill_to_contact:'-' }}</p>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="customer_address">{{ $t("Customer Address") }}</label>
                            <p class='custom-pre'>{{ (challan_basic.bill_to_address != null)?challan_basic.bill_to_address:'-' }}</p>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col-md-3">
                            <label for="currency_name">{{ $t("Currency") }}</label>
                            <p>{{ challan_basic.currency_name }} ({{ challan_basic.currency_code }})</p>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="mb-2">
                    <span class="text-subhead">{{ $t("Product Information") }}</span>
                </div>
                <div class="table-responsive mb-2">
                    <table class="table table-striped display nowrap text-nowrap w-100">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ $t("Product Code") }}</th>
                                <th scope="col">{{ $t("Product") }}</th>
                                <th scope="col" class="text-right">{{ $t("Quantity") }}</th>
                                <th scope="col" class="text-right">{{ $t("Price") }}</th>
                                <th scope="col" class="text-right">{{ $t("Discount %") }}</th>
                                <th scope="col" class="text-right">{{ $t("Tax %") }}</th>
                                <th scope="col" class="text-right">{{ $t("Amount") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(product, key, index) in products" v-bind:key="index">
                                <th scope="row">{{ key+1 }}</th>
                                <td>{{ (product.product_code)?product.product_code:'-' }}</td>
                                <td>{{ product.name }}</td>
                                <td class="text-right">{{ product.quantity }}</td>
                                <td class="text-right">{{ product.amount_excluding_tax }}</td>
                                <td class="text-right">{{ product.discount_percentage }}</td>
                                <td class="text-right">{{ product.tax_percentage }}</td>
                                <td class="text-right">{{ product.total_amount }}</td>
                            </tr>
                            <tr>
                                <td colspan="7" class="text-right">{{ $t("Sub Total") }}</td>
                                <td class="text-right">{{ challan_basic.subtotal_excluding_tax }}</td>
                            </tr>
                            <tr>
                                <td colspan="7" class="text-right">{{ $t("Total Discount") }}</td>
                                <td class="text-right">{{ challan_basic.total_discount_amount }}</td>
                            </tr>
                            <tr>
                                <td colspan="7" class="text-right">{{ $t("Total Tax") }}</td>
                                <td class="text-right">{{ challan_basic.total_tax_amount }}</td>
                            </tr>
                            <tr>
                                <td colspan="7" class="text-right">{{ $t("Shipping Charge") }}</td>
                                <td class="text-right">{{ challan_basic.shipping_charge }}</td>
                            </tr>
                            <tr>
                                <td colspan="7" class="text-right">{{ $t("Packaging Charge") }}</td>
                                <td class="text-right">{{ challan_basic.packing_charge }}</td>
                            </tr>
                            <tr>
                                <td colspan="7" class="text-right">{{ $t("Total Amount") }}</td>
                                <td class="text-right">{{ challan_basic.total_order_amount }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>

                <div class="mb-2">
                    <span class="text-subhead">{{ $t("Terms") }}</span>
                </div>
                <div class="form-row mb-2">
                    <div class="form-group col-md-6">
                        <p class='custom-pre'>{{ (challan_basic.terms != null)?challan_basic.terms:'-' }}</p>
                    </div>
                </div>

            </div>
        </div>

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
</template>

<script>
    'use strict';

    export default {
        data(){
            return{
                server_errors: '',
                error_class: '',
                processing: false,
                show_modal: false,
                challan_delete_processing: false,
                printing_processing: false,
                
                change_challan_link: '/api/update_delivery_challan_status/'+this.challan_data.slack,
                delete_challan_api_link: '/api/delete_delivery_challan/'+this.challan_data.slack,
                printnode_api_link: '/api/print_with_printnode',

                slack: this.challan_data.slack,
                challan_basic: this.challan_data,
                products: this.challan_data.products
            }
        },
        props: {
            challan_data: [Array, Object],
            challan_statuses: [Array, Object],
            delete_challan_access: Boolean,
            printnode_enabled: Boolean
        },
        mounted() {
            console.log('Delivery challan detail page loaded');
        },
        methods: {
            change_challan_status(challan_status){
                this.processing = true;
                var formData = new FormData();

                formData.append("access_token", window.settings.access_token);
                formData.append("status", challan_status);

                axios.post(this.change_challan_link, formData).then((response) => {
                    this.show_modal = false;
                    this.processing = false;

                    if(response.data.status_code == 200) {
                        location.reload();
                    }else{
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
            },

            delete_challan(){
                this.$off("submit");
                this.$off("close");
                this.show_modal = true;

                this.$on("submit", function () {       
                    this.processing = true;
                    this.challan_delete_processing = true;

                    var formData = new FormData();
                    formData.append("access_token", window.settings.access_token);

                    axios.post(this.delete_challan_api_link, formData).then((response) => {
                        if(response.data.status_code == 200) {
                            if(typeof response.data.link != 'undefined' && response.data.link != ""){
                                window.location.href = response.data.link;
                            }else{
                                location.reload();
                            }
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
                        this.challan_delete_processing = false;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
                });

                this.$on("close", function () {
                    this.show_modal = false;
                });
            },

            printnode_print(type){
                this.printing_processing = true;

                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);
                formData.append("print_type", type);
                formData.append("slack", this.slack);

                axios.post(this.printnode_api_link, formData).then((response) => {
                    if(response.data.status_code == 200) {
                        this.show_response_message(response.data.msg + ' (Job ID: '+response.data.data+')', 'SUCCESS');
                        this.printing_processing = false;
                    }else{
                        this.printing_processing = false;
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
            }
        }
    }
</script>