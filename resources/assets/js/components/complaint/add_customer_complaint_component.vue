<template>
    <div>
        <form @submit.prevent="submit_form">
            <div class="d-flex flex-wrap mb-4">
                <div class="mr-auto">
                    <span class="text-title" v-if="complaint_slack == null">{{
                        $t("Add Customer Complaint")
                    }}</span>
                    <span class="text-title" v-else>{{ $t("Edit Customer Complaint") }}
                    </span>
                </div>
                <div class="">
                    <button v-if="complaint_slack == null" type="submit" class="btn btn-primary"
                        v-bind:disabled="processing == true">
                        <i class="fa fa-circle-notch fa-spin" v-if="processing == true"></i>
                        {{ $t("Save") }}
                    </button>
                    <button v-else type="submit" class="btn btn-primary" v-bind:disabled="processing == true">
                        <i class="fa fa-circle-notch fa-spin" v-if="processing == true"></i>
                        {{ $t("Update") }}
                    </button>
                </div>
            </div>
            <p v-html="server_errors" v-bind:class="[error_class]"></p>

            <div class="form-row mb-2">

                <div class="form-group col-sm-12 col-md-4">
                    <label for="selectedCustomer">{{ $t("Choose Customer") }}</label>
                    <select name="selectedCustomer" v-model="selectedCustomer" @change="fetchCustomerOrders"
                        v-validate="'required'" class="form-control form-control-custom" placeholder="Choose Customers..">
                        <option value="" disabled selected>Choose Customers..</option>

                        <option v-for="(customer_item, index) in customer_list" :value="customer_item.slack"
                            placeholder="Choose Customers.." :key="index">
                            {{ customer_item.name }} - {{ customer_item.email }}
                        </option>
                    </select>
                    <span v-bind:class="{ 'error': errors.has('selectedCustomer') }">{{ errors.first('selectedCustomer')
                    }}</span>
                </div>

                <div class="form-group col-sm-12 col-md-4">
                    <label for="selectedOrder">{{ $t("Choose Order") }}</label>
                    <select name="selectedOrder" v-model="selectedOrder" class="form-control form-control-custom"
                        v-validate="'required'" @change="fetchOrderProducts">
                        <option value="" disabled>Select an Order..</option>
                        <option v-for="(order, index) in customerOrders" :value="order.slack" :key="index">
                            Order#{{ order.order_number }}
                        </option>
                    </select>
                    <span v-bind:class="{ 'error': errors.has('selectedOrder') }">{{ errors.first('selectedOrder')
                    }}</span>
                </div>


                <div class="form-group col-sm-12 col-md-4">
                    <label for="product_id">{{ $t("Choose Product") }}</label>
                    <select name="product_id" v-model="product_id" class="form-control form-control-custom"
                        v-validate="'required'">
                        <option value="" disabled>Select an Order..</option>
                        <option v-for="(product, index) in orderProducts" :value="product.id" :key="index">
                            {{ product.name }} - {{ product.product_code }}
                        </option>
                    </select>
                    <span v-bind:class="{ 'error': errors.has('product_id') }">{{ errors.first('product_id')
                    }}</span>
                </div>

                <div class="form-group col-sm-12 col-md-6">
                    <label for="complaint_ref">{{ $t("Complaint Reference No") }}</label>
                    <input type="text" name="complaint_ref" v-model="complaint_ref" v-validate="'required'"
                        class="form-control form-control-custom" rows="5" :placeholder="$t('Enter Complaint Reference')" />
                    <span v-bind:class="{ error: errors.has('complaint_ref') }">{{
                        errors.first("complaint_ref")
                    }}</span>
                </div>

                <div class="form-group col-sm-12 col-md-6">
                    <label for="name">{{ $t("Description") }}</label>
                    <textarea name="description" v-model="description" v-validate="'required|max:65535'"
                        class="form-control form-control-custom" rows="1"
                        :placeholder="$t('Complaint Description')"></textarea>

                    <span v-bind:class="{ error: errors.has('description') }">{{
                        errors.first("description")
                    }}</span>

                </div>
            </div>

        </form>
        <modalcomponent v-if="show_modal" v-on:close="show_modal = false">
            <template v-slot:modal-header>
                {{ $t("Confirm") }}
            </template>

            <template v-slot:modal-footer>
                <button type="button" class="btn btn-light" @click="$emit('close')">
                    Cancel
                </button>
                <button type="button" class="btn btn-primary" @click="$emit('submit')" v-bind:disabled="processing == true">
                    <i class="fa fa-circle-notch fa-spin" v-if="processing == true"></i>
                    Continue
                </button>
            </template>
        </modalcomponent>
    </div>
</template>
<script>
"use strict";

export default {

    data() {

        return {
            max: 5,
            server_errors: "",
            processing: false,
            modal: false,
            show_modal: false,
            error_class: "",
            complaint_slack: this.complaints_data.length === 0 ? '' : this.complaints_data.slack,
            selectedCustomer: this.complaints_data.length === 0 && this.complaints_data.customer == null ? '' : this.complaints_data.customer.slack,
            selectedOrder: this.complaints_data.length === 0 && this.complaints_data.order == null ? '' : this.complaints_data.order.slack,
            product_id: this.complaints_data.length === 0 && this.complaints_data.product_id == null ? '' : this.complaints_data.product_id,
            customerOrders: [],
            orderProducts: [],
            api_link: this.complaints_data.length === 0 ? "/api/submit_customer_complaint" : "/api/update_customer_complaint/" + this.complaints_data.slack,
            // complaint_slack: this.complaints_data.length === 0 && this.complaints_data.slack !== null ? this.complaints_data.slack : null,
            complaint_ref: this.complaints_data.length === 0 ? '' : this.complaints_data.complaint_ref,
            complaint_status: this.complaints_data.length === 0 && this.complaints_data.complaint_status !== null ? this.complaints_data.complaint_status : null,
            description: this.complaints_data.length === 0 ? '' : this.complaints_data.description,


        };

    },
    props: {
        complaints_data: Array,
        customer_list: Array,

    },
    watch: {
        complaints_data: {
            immediate: true,
            handler() {
                this.fetchCustomerOrders();
                this.fetchOrderProducts();
            },
        },
    },
    methods: {

        fetchCustomerOrders() {

            if (this.selectedCustomer) {

                const formData = new FormData();
                formData.append("access_token", window.settings.access_token);
                formData.append("customer_slack", this.selectedCustomer);
                console.log(...formData);
                axios.post('/api/customer_orders', formData)
                    .then(response => {
                        this.customerOrders = response.data.data;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        },
        submit_form() {
            this.$validator.validateAll().then((result) => {
                if (result) {
                    this.show_modal = true;
                    this.$on("submit",() => {
                        // alert(this.api_link);
                        this.processing = true;
                        const formData = new FormData();
                        formData.append("access_token", window.settings.access_token);
                        formData.append("complaint_ref", this.complaint_ref);
                        formData.append("descriptions", this.description);
                        formData.append("customer_slack", this.selectedCustomer);
                        formData.append("order_slack", this.selectedOrder);
                        formData.append("product_id", this.product_id);
                        
                        axios
                            .post(this.api_link, formData)
                            .then((response) => {
                                if (response.data.status_code == 200) {
                                    this.show_response_message(response.data.msg, "Success");

                                    setTimeout(function () {
                                        location.reload();
                                    }, 1000);
                                } else {
                                    this.show_modal = false;
                                    this.processing = false;
                                    try {
                                        var error_json = JSON.parse(response.data.msg);
                                        this.loop_api_errors(error_json);
                                    } catch (err) {
                                        this.server_errors = response.data.msg;
                                    }
                                    this.error_class = "error";
                                }
                            })
                            .catch((error) => {
                                console.log("error");
                                console.log(error);
                            });
                        this.$off("submit");
                    });

                    this.$on("close", function () {
                        this.show_modal = false;
                        this.$off("close");
                    });
                }
            });
        },


        fetchOrderProducts() {

            if (this.selectedOrder) {

                const formData = new FormData();
                formData.append("access_token", window.settings.access_token);
                formData.append("order_slack", this.selectedOrder);
                console.log(...formData);
                axios.post('/api/customer_orders_products', formData)
                    .then(response => {
                        console.log(response.data.data[0]);
                        this.orderProducts = response.data.data;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        }
    }
}
</script>
<style></style>