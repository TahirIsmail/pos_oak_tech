<template>
    <div class="card p-4">
       
        <form @submit.prevent="submit_form">
            <div class="d-flex flex-wrap mb-4">
                <div class="mr-auto">
                    <span class="text-title" v-if="complaint_slack.length === 0">{{
                        $t("Add Customer Complaint")
                    }}</span>
                    <span class="text-title" v-else>{{ $t("Edit Customer Complaint") }}
                    </span>
                </div>
                <div class="">
                    <button v-if="complaint_slack.length === 0" type="submit" class="btn btn-primary"
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


            <div>
                <div class="form-row mb-2">
    
    
                    <div class="form-group col-sm-12 col-md-4">
                        <label for="service_type">{{ $t("Choose Service Type") }}</label>
                        <select name="service_type" v-model="service_type" class="form-control form-control-custom">
                            <option value="" disabled selected>Select an Service Type...</option>
                            <option value="warranty (Invoice or Purchase Order Number)">warranty (Invoice or Purchase Order Number)</option>
                            <option value="SLA With Parts">SLA With Parts</option>
                            <option value="SLA Without Parts">SLA Without Parts</option>
                            <option value="Per Call">Per Call</option>                           
                        </select>
                       
                    </div>


                    <div class="form-group col-sm-12 col-md-4" v-if="service_type == 'warranty (Invoice or Purchase Order Number)'">
                        <label for="poc_name">{{ $t("Enter Invoice or Purchase Order Number") }}</label>
                        <input name="poc_name" v-model="invoice_po_number" class="form-control form-control-custom" />
                    </div>
    
                    
                    <div class="form-group col-sm-12 col-md-4">
                        <label for="poc_name">{{ $t("POC Name") }}</label>
                        <input name="poc_name" v-model="poc_name" class="form-control form-control-custom" />
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
                        <input type="text" name="end_user_details" v-model="end_user_details"
                            class="form-control form-control-custom" rows="5" :placeholder="$t('Enter End User Details')" />
                        <span v-bind:class="{ error: errors.has('end_user_details') }">{{
                            errors.first("end_user_details")
                        }}</span>
                    </div>
    
        
                    
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
        const complaintsDataIsEmpty = !this.complaints_data || Object.keys(this.complaints_data).length === 0;
        return {
            no_of_devices: complaintsDataIsEmpty ? '' : this.complaints_data.no_of_devices,
            mode_of_complaint: complaintsDataIsEmpty ? '' : this.complaints_data.mode_of_complaint,
            invoice_po_number: complaintsDataIsEmpty ? '' : this.complaints_data.invoice_po_number,
            max: 5,
            server_errors: "",
            processing: false,
            modal: false,
            show_modal: false,
            customer_list: [],
            error_class: "",
            assign_to: complaintsDataIsEmpty ? (this.assign_type == 'field' ? 'assigned_to_field_eng' : 'assigned_to_lab_eng') : this.complaints_data.assign_to,
            api_link: complaintsDataIsEmpty ? "/api/submit_customer_side_complaint" : `/api/update_customer_side_complaint/${this.complaints_data.slack}`,
            complaint_slack: complaintsDataIsEmpty ? '' : this.complaints_data.slack,
            selectedCustomer: complaintsDataIsEmpty || !this.complaints_data.customer ? (this.is_customer ? this.customer_slack : '') : this.complaints_data.customer.slack,
            selectedOrder: complaintsDataIsEmpty || !this.complaints_data.order ? '' : this.complaints_data.order?.slack || '',
            product_id: complaintsDataIsEmpty || !this.complaints_data.product_id ? '' : this.complaints_data.product_id,
            customerInvoices: [],
            orderProducts: '',
            complaint_ref: complaintsDataIsEmpty ? '' : this.complaints_data.complaint_ref,
            complaint_status: complaintsDataIsEmpty ? '' : this.complaints_data.c_status,
            description: complaintsDataIsEmpty ? '' : this.complaints_data.description,
            customer_category: complaintsDataIsEmpty ? '' : this.complaints_data.customer?.customer_type || '',
            service_type: complaintsDataIsEmpty ? '' : this.complaints_data.type_of_service,
            equipment_type: complaintsDataIsEmpty ? '' : this.complaints_data.equipment_type,
            equipment_make: complaintsDataIsEmpty ? '' : this.complaints_data.equipment_make,
            service_required: complaintsDataIsEmpty ? '' : this.complaints_data.service_required,
            assigned_to: complaintsDataIsEmpty ? '' : this.complaints_data.user?.slack || '',
            assigned_to_field_enng: complaintsDataIsEmpty ? '' : this.complaints_data.field_user?.slack || '',
            poc_name: complaintsDataIsEmpty ? '' : this.complaints_data.poc_name,
            model: complaintsDataIsEmpty ? '' : this.complaints_data.model,
            serial_no: complaintsDataIsEmpty ? '' : this.complaints_data.serial_no,
            complaint_details: complaintsDataIsEmpty ? '' : this.complaints_data.complaint_details,
            end_user_details: complaintsDataIsEmpty ? '' : this.complaints_data.end_user_details,
            customer_feedback: ''

        };

    },
    props: {
        lab_engineers: [Array, Object],
        complaints_data: Array,
        equipment_types: Array,
        is_customer: Boolean,
        customer_slack: String,
        assign_type: String

    },
    watch: {
        complaints_data: {
            immediate: true,
            handler() {
                
                this.fetchCustomers();
            },
        },
        no_of_devices: function(value) {
            if (value < 1) {
                this.no_of_devices = 1;
            }
        }
    },
    methods: {
        async fetchCustomers() {
        if (this.customer_category) {
        
            const formData = new FormData();
            formData.append("access_token", window.settings.access_token);
            formData.append("customer_category", this.customer_category);

            try {
                const response = await axios.post('/api/fetchCustomers', formData);
              
                

                if (response.status === 200) {
                    this.customer_list = response.data.data;
                  
                }
                
            } catch (error) {
                console.error(error);
            }
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
                        formData.append("assigned_to_field_enng", this.assigned_to_field_enng);
                        formData.append("poc_name", this.poc_name);
                        formData.append("complaint_status", this.complaint_status);
                        formData.append("assign_to", this.assign_to);
                        formData.append('no_of_devices', this.no_of_devices);
                        formData.append('mode_of_complaint', this.mode_of_complaint);
                        formData.append('invoice_po_number', this.invoice_po_number);
                        formData.append('assign_type', this.assign_type);
                        // formData.append("customer_feedback", this.customer_feedback);
                        console.log(...formData);
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


        
    }
}
</script>
<style></style>