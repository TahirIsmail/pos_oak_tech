<template>
    <div class="card p-4">
        
        <form @submit.prevent="submit_form">
            <div class="d-flex flex-wrap mb-4">
                <div class="mr-auto">
                    <span class="text-title" v-if="complaint_slack == ''">{{
                        $t("Add Customer Complaint")
                    }}</span>
                    <span class="text-title" v-else>{{ $t("Edit Customer Complaint") }}
                    </span>
                </div>
                <div class="">
                    <button v-if="complaint_slack == ''" type="submit" class="btn btn-primary"
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

                <div class="form-group col-sm-12 col-md-4" v-if="!is_customer">
                    <label for="customer_category">{{ $t("Customer Category") }}</label>
                    <select name="customer_category" v-model="customer_category" @change="fetchCustomers"
                        v-validate="'required'" class="form-control form-control-custom" placeholder="Choose Customer Category...">
                        <option value="" disabled selected>Choose Customer Category...</option>
                        <option value="CUSTOM">Corporate</option>
                        <option value="WALKIN">Walkin</option>
                    </select>
                    <span v-bind:class="{ 'error': errors.has('customer_category') }">{{ errors.first('customer_category')
                    }}</span>
                </div>


                <div class="form-group col-sm-12 col-md-4" v-if="!is_customer">
                    <label for="selectedCustomer">{{ $t("Choose Customer") }}</label>
                    <select name="selectedCustomer" v-model="selectedCustomer"
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
                    <label for="service_type">{{ $t("Choose Service Type") }}</label>
                    <select name="service_type" v-model="service_type" class="form-control form-control-custom">
                        <option value="" disabled selected>Select an Service Type...</option>
                        <option value="warranty (Invoice or Purchase Order Number)">warranty (Invoice or Purchase Order Number)</option>
                        <option value="SLA With Parts">SLA With Parts</option>
                        <option value="SLA Without Parts">SLA Without Parts</option>
                        <option value="Per Call">Per Call</option>
                       
                    </select>
                    <!-- <span v-bind:class="{ 'error': errors.has('service_type') }">{{ errors.first('service_type')
                    }}</span> -->
                </div>

                <div class="form-group col-sm-12 col-md-4">
                    <label for="poc_name">{{ $t("POC Name") }}</label>
                    <input name="poc_name" v-model="poc_name" class="form-control form-control-custom" />
                </div>

                <div class="form-group col-sm-12 col-md-4">
                    <label for="equipment_type">{{ $t("Choose Equipment Type") }}</label>
                    <select name="equipment_type" v-model="equipment_type" class="form-control form-control-custom">
                        <option value="" disabled selected>Select an Equipment Type...</option>
                        <option v-for="(type, index) in equipment_types" :key="index" :value="type">{{ type }}</option>
                       
                    </select>
                    <!-- <span v-bind:class="{ 'error': errors.has('equipment_type') }">{{ errors.first('equipment_type')
                    }}</span> -->
                </div>

                <div class="form-group col-sm-12 col-md-4">
                    <label for="equipment_make">{{ $t("Equipment Make") }}</label>
                    <input type="text" name="equipment_make" v-model="equipment_make" v-validate="'required'"
                        class="form-control form-control-custom" rows="5" :placeholder="$t('Enter Equipment Make')" />
                    <span v-bind:class="{ error: errors.has('equipment_make') }">{{
                        errors.first("equipment_make")
                    }}</span>
                </div>

                <div class="form-group col-sm-12 col-md-4">
                    <label for="model">{{ $t("Model") }}</label>
                    <input type="text" name="model" v-model="model" v-validate="'required'"
                        class="form-control form-control-custom" rows="5" :placeholder="$t('Enter Model')" />
                    <span v-bind:class="{ error: errors.has('model') }">{{
                        errors.first("model")
                    }}</span>
                </div>

                <div class="form-group col-sm-12 col-md-4">
                    <label for="serial_no">{{ $t("Serial No") }}</label>
                    <input type="text" name="serial_no" v-model="serial_no" v-validate="'required'"
                        class="form-control form-control-custom" rows="5" :placeholder="$t('Enter Serial No')" />
                    <span v-bind:class="{ error: errors.has('serial_no') }">{{
                        errors.first("serial_no")
                    }}</span>
                </div>

                <div class="form-group col-sm-12 col-md-4">
                    <label for="complaint_details">{{ $t("Complaint Details") }}</label>
                    <input type="text" name="complaint_details" v-model="complaint_details" v-validate="'required'"
                        class="form-control form-control-custom" rows="5" :placeholder="$t('Enter Complaint Details')" />
                    <span v-bind:class="{ error: errors.has('complaint_details') }">{{
                        errors.first("complaint_details")
                    }}</span>
                </div>

                <div class="form-group col-sm-12 col-md-4">
                    <label for="end_user_details">{{ $t("End User Details") }}</label>
                    <input type="text" name="end_user_details" v-model="end_user_details" v-validate="'required'"
                        class="form-control form-control-custom" rows="5" :placeholder="$t('Enter End User Details')" />
                    <span v-bind:class="{ error: errors.has('end_user_details') }">{{
                        errors.first("end_user_details")
                    }}</span>
                </div>


                <div class="form-group col-sm-12 col-md-4">
                    <label for="service_required">{{ $t("Choose Service Required") }}</label>
                    <select name="service_required" v-model="service_required" class="form-control form-control-custom">
                        <option value="" disabled>Select Service Required...</option>
                        <option value="On-Site">On-Site</option>
                        <option value="Pickup for Workshop">Pickup for Workshop</option>
                        <option value="Deliver by Customer">Deliver by Customer</option>
                       
                    </select>
                    <!-- <span v-bind:class="{ 'error': errors.has('service_required') }">{{ errors.first('service_required')
                    }}</span> -->
                </div>

                 <div class="form-group col-sm-12 col-md-4" v-if="!is_customer">
                    <label for="assigned_to">{{ $t("Assigned To") }}</label>
                    <select name="assigned_to" v-model="assigned_to" class="form-control form-control-custom">
                        <option value="" disabled>Select...</option>
                        <option v-for="(engg, index) in lab_engineers" :key="index" :value="engg.slack">{{ engg.fullname }} ({{ engg.assign_complaints_count }})</option>
                       
                    </select>
                    
                </div>

                <div class="form-group col-sm-12 col-md-4" v-if="!is_customer">
                    <label for="complaint_status">{{ $t("Choose Status") }}</label>
                    <select name="complaint_status" v-model="complaint_status" class="form-control form-control-custom">
                        <option value="" disabled>Select Status...</option>
                        <option value="Complaint Logged">Complaint Logged</option>
                        <option value="Complaint Assigned">Complaint Assigned</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Complete">Complete</option>
                        <option value="Approval Pending">Approval Pending</option>
                        <option value="Not Repairable">Not Repairable</option>
                        <option value="CSE">CSE</option>                       
                    </select>                    
                </div>
                <!-- <div class="form-group col-sm-12 col-md-4">
                    <label for="customer_feedback">{{ $t("Feedback") }}</label>
                    <input type="text" name="customer_feedback" v-model="customer_feedback" v-validate="'required'"
                        class="form-control form-control-custom" rows="5" :placeholder="$t('Enter Feedback')" />
                    <span v-bind:class="{ error: errors.has('customer_feedback') }">{{
                        errors.first("customer_feedback")
                    }}</span>
                </div> -->
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
            customer_list: [],
            

            error_class: "",
            complaint_slack: this.complaints_data.length === 0 ? '' : this.complaints_data.slack,
            selectedCustomer: this.complaints_data.length === 0 || this.complaints_data.customer == null ? (this.is_customer ? this.customer_slack : '') : this.complaints_data.customer.slack,

            selectedOrder: this.complaints_data.length === 0 && this.complaints_data.order == null ? '' : this.complaints_data.order.slack,
            product_id: this.complaints_data.length === 0 && this.complaints_data.product_id == null ? '' : this.complaints_data.product_id,
            customerInvoices: [],
            orderProducts: [],
            api_link: this.complaints_data.length === 0 ? "/api/submit_customer_complaint" : "/api/update_customer_complaint/" + this.complaints_data.slack,
            // complaint_slack: this.complaints_data.length === 0 && this.complaints_data.slack !== null ? this.complaints_data.slack : null,
            complaint_ref: this.complaints_data.length === 0 ? '' : this.complaints_data.complaint_ref,
            complaint_status: this.complaints_data.length === 0 && this.complaints_data.complaint_status !== null ? this.complaints_data.complaint_status : null,
            description: this.complaints_data.length === 0 ? '' : this.complaints_data.description,
            customer_category: '',
            service_type: '',
            equipment_type: '',
            equipment_make: '',
            service_required: '',
            assigned_to: '',
            poc_name: '',
            complaint_status: '',
            model: '',
            serial_no: '',
            complaint_details: '',
            end_user_details: '',
            customer_feedback: '',

        };

    },
    props: {
        lab_engineers: [Array, Object],
        complaints_data: Array,
        equipment_types: Array,
        is_customer: Boolean,
        customer_slack: String,

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

        fetchCustomers(){
            if(this.customer_category){
                // alert(this.customer_category);
                const formData = new FormData();
                formData.append("access_token", window.settings.access_token);
                formData.append("customer_category", this.customer_category);
                axios.post('/api/fetchCustomers', formData)
                    .then(response => {
                        if(response.status == 200){
                            console.log(response.data.data);
                            this.customer_list = response.data.data;

                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });

            }
        },
        fetchCustomerOrders() {

            if (this.selectedCustomer) {

                const formData = new FormData();
                formData.append("access_token", window.settings.access_token);
                formData.append("customer_slack", this.selectedCustomer);

                
                axios.post('/api/customer_orders', formData)
                    .then(response => {
                        this.customerInvoices = response.data.data;
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
                        // this.processing = true;
                        const formData = new FormData();
                        formData.append("access_token", window.settings.access_token);
                        formData.append("customer_slack", this.selectedCustomer);
                        formData.append("service_type", this.service_type);
                        formData.append("equipment_type", this.equipment_type);
                        formData.append("equipment_make", this.equipment_make);
                        formData.append("model", this.model);
                        formData.append("serial_no", this.serial_no);
                        formData.append("complaint_details", this.complaint_details);
                        formData.append("end_user_details", this.end_user_details);
                        formData.append("service_required", this.service_required);
                        formData.append("assigned_to", this.assigned_to);
                        formData.append("poc_name", this.poc_name);
                        formData.append("complaint_status", this.complaint_status);
                        // formData.append("customer_feedback", this.customer_feedback);
                        
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