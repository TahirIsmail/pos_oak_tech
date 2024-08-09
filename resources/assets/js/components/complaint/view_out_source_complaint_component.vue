<template>
  <div class="row card p-4">

    <div class="col-md-12">
      <div class="d-flex flex-wrap mb-4">
        <div class="mr-auto">
          <div class="d-flex">
            <div>
              <span class="text-title">
                <span class="text-muted">{{ $t("Complaint") }}</span>
              </span>
            </div>
          </div>
        </div>

       
      </div>

       <div class="">      
          <div v-if="complaint.complaint.complaint_assign_to_lab_enggs[0]">
            <span class="alert alert-info">
             OAK Technology has Assign you Complaint at ({{ complaint.start_time }} )
              {{
                complaint.end_time == null 
                ? 'And Still Waiting...' 
                : `And Completed at ${complaint.end_time}`
              }}
            </span>
          </div>


        </div>

      <div class="d-flex flex-wrap mb-4">
        <div class="ml-auto">
            <button
              type="submit"
              class="alert alert-success mr-1"
              v-if="complaint.complaint.out_source_complaint_completed == 0"
            >
              {{ $t("Complaint Assigned") }}
            </button>
            <button
              type="submit"
              class="alert alert-success mr-1"
              v-else
            >
              {{ $t("Complaint Completed") }}
            </button>
        </div>
      </div>

      <div class="d-flex flex-wrap mb-4">
        <p v-html="server_errors" v-bind:class="[error_class]"></p>
        
        <div class="ml-auto d-flex">
          
          <div v-if="complaint.complaint.complaint_assign_to_lab_enggs[0].complaint_outsource == 'Yes'">
            <button
              type="submit"
              class="btn btn-success mr-1"
              v-on:click="OutSourceComplaint(complaint)"
            >
              {{ $t("Complaint Complete") }}
            </button>
          </div>
        </div>
      </div>

      <hr />

      <div class="mb-2">
        <span class="text-subhead">{{ $t("Basic Information") }}</span>
      </div>

      <div class="form-row mb-2">

        <div class="form-group col-md-3" v-if="complaint.complaint.out_source_vendor">
          <label for="label">{{ $t("OAK Descriptions") }}</label>

          <p class="alert alert-success w-75">
            {{ complaint.complaint.out_source_vendor.details }}
          </p>
        </div>
     

        <div class="form-group col-md-3" v-if="complaint.complaint.c_status">
          <label for="label">{{ $t("Complaint Status") }}</label>

          <p class="alert alert-success w-50">
            {{ complaint.complaint.c_status }}
          </p>
        </div>
        <div class="form-group col-md-3" v-if="complaint.complaint.complaint_status_label">
          <label for="label">{{ $t("Status") }}</label>

          <p class="alert alert-success w-50">
            {{ complaint.complaint.complaint_status_label }}
          </p>
        </div>


        <div class="form-group col-md-3">
          <label for="created_by">{{ $t("Complaint Details") }}</label>

          <p class="">{{ complaint.complaint.complaint_details }}</p>
        </div>

        <div class="form-group col-md-3">
          <label for="created_by">{{ $t("End User Details") }}</label>

          <p class="">{{ complaint.complaint.end_user_details }}</p>
        </div>


        <div class="form-group col-md-3">
          <label for="created_by">{{ $t("POC Name") }}</label>

          <p class="">{{ complaint.complaint.poc_name }}</p>
        </div>


        <div class="form-group col-md-3">
          <label for="created_by">{{ $t("Equipment Make") }}</label>
          <p class="">{{ complaint.complaint.complaint_assign_to_lab_enggs[0].make }}</p>
        </div>

        <div class="form-group col-md-3">
          <label for="created_by">{{ $t("Model") }}</label>
          <p class="">{{ complaint.complaint.complaint_assign_to_lab_enggs[0].model }}</p>
        </div>

        <div class="form-group col-md-3">
          <label for="created_by">{{ $t("Serial No") }}</label>
          <p class="">{{ complaint.complaint.complaint_assign_to_lab_enggs[0].serial_no }}</p>
        </div>

        <div class="form-group col-md-3" v-if="!is_customer">
          <div v-if="complaint.complaint.due_date">
            <label for="created_by">{{ $t("due Date") }}</label>

            <p class="alert alert-danger w-50">{{ complaint.complaint.due_date }}</p>
          </div>
        </div>

        <div class="form-group col-md-3" v-if="complaint.complaint.admin_remark">
          <label
            for="created_by"
            >{{ $t("Manager Remark to Lab Technician") }}</label
          >  
          <p> {{ complaint.complaint.admin_remark }} </p>
        </div>

     

        <div class="form-group col-md-3" v-else>
          <div v-if="complaint.complaint.lab_staff_remark">
            <label
              for=""
              >{{ $t("Lab Technician Requirement Request.") }}</label
            >

            <p>
              <strong class="alert alert-danger">
                {{ complaint.complaint.lab_staff_remark }}
              </strong>
            </p>
          </div>
        </div>
      </div> 

      <div class="form-row mb-2">
        <div class="form-group col-md-6">
          <label for="description">{{ $t("Description") }}</label>

          <p></p>
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
        <button type="button" class="btn btn-light" @click="$emit('close')">
          Cancel
        </button>

        <button
          type="button"
          class="btn btn-primary"
          @click="$emit('submit')"
          v-bind:disabled="processing == true"
        >
          <i class="fa fa-circle-notch fa-spin" v-if="processing == true"></i>
          Continue
        </button>
      </template>
    </modalcomponent>
  
    <modalcomponent
      v-if="out_source_complaint"
      v-on:close="out_source_complaint = false"
      :modal_width="'modal-container-xl'"
    >
      <template v-slot:modal-header>
        {{ $t("OutSource Product") }}
      </template>
      <template v-slot:modal-body>
        <div class="form-row mb-2">
          <input type="hidden" name="out_source_id" v-model="out_source_id" />
          <input type="hidden" name="complaint_id" v-model="complaint_id" />
          <input type="hidden" name="lab_complaint" v-model="lab_complaint" />

         
          <div class="form-group col-md-12">
            <label
              for="product_details"
              >{{ $t("Enter Details") }} </label
            >  
            <textarea
              name="product_details"
              v-model="product_details"
              class="form-control form-control-custom"
              row="1"
            ></textarea>
          </div>
        </div>
      </template>
      <template v-slot:modal-footer>
       

        <button
          type="button"
          class="btn btn-primary"
          @click="submit_out_source_complaint()"
          v-bind:disabled="processing == true"
        >
          <i class="fa fa-circle-notch fa-spin" v-if="processing == true"></i>
          Continue
        </button>
      </template>
    </modalcomponent>
  </div>
</template>

<script>
'use strict';
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import moment from "moment";
import { event_bus } from '../../event_bus.js';
export default {
    data() {
        return {
            processing: false,
            transaction_type: [],
            transaction_type_data: '',
            amount: '',
            payment_methods: [],
            payment_method: '',
            transaction_date: '',
            accounts: [],
            account: '',
            transactions: [],
            out_source_id: '',
            notes: '',
            transaction_type_data: '',
            complaint_status_modal: false,
            add_customer_feedback: false,
            request_part_store: false,
            out_source_product_model: false,
            add_remark_modal: false,
            delete_processing: false,
            show_payment_modal: false,
            show_modal: false,
            show_assign_complaint: false,
            out_source_complaint: false,
            complaint_complete: false,
            delete_access: true,
            assign_processing: false,
            required_product: false,
            assign_required_product: false,
            payment_pending_amount: 0,
            tax_component_count: 0,
            server_errors: '',
            categories: [],
            category: '',
            scategories: [],
            currency_codes: [],
            payment_total_amount: 0,
            products: [],
            charge_label: [""],
            charge_price: [""],
            complaint_product_ids: [],
            Selectedproducts: [],
            ComplaintProducts: [],
            complaint_invoice: false,
            payment_received_amount: 0,
            payment_pending_amount: 0,
            product_ids: [],
            ComplaintRecord: [],
            s_category: '',
            extend_date: '',
            submit_complaint_technician: false,
            labtechnician: '',
            final_lab_staff_remark: '',
            due_date: '',
            admin_remark: '',
            lab_staff_remark: '',
            admin_again_remark: '',
            requirement_request: (this.complaint.lab_staff_remark) ? this.complaint.lab_staff_remark : null,
            complaint_slack: this.complaint.slack,
            delete_category_api_link: '/api/delete_complaint/' + this.complaint.slack,
            charges: [],

            billable: (this.complaint.billable) ? this.complaint.billable : '',
            parts_required: (this.complaint.parts_required) ? this.complaint.parts_required : '',
            complaint_status: (this.complaint.complaint_status_label) ? this.complaint.complaint_status_label : '',
            type_of_service: (this.complaint.type_of_service) ? this.complaint.type_of_service : '',
            complaint_ok: (this.complaint.complaint_ok) ? this.complaint.complaint_ok : '',
            picked_for_workshop: (this.complaint.picked_for_workshop) ? this.complaint.picked_for_workshop : '',
            equipment_s_no: (this.complaint.equipments_S_no) ? this.complaint.equipments_S_no : '',
            equipment_specs: (this.complaint.equipment_specs) ? this.complaint.equipment_specs : '',
            accessories: (this.complaint.accessories) ? this.complaint.accessories : '',
            invoice_number: (this.complaint.invoice_number) ? this.complaint.invoice_number : '',
            po_number: (this.complaint.po_number) ? this.complaint.po_number : '',
            condition: (this.complaint.complaint_condition) ? this.complaint.complaint_condition : '',
            equipment_part_serial_number: (this.complaint.equipment_part_serial_number) ? this.complaint.equipment_part_serial_number : '',
            outsource_date: (this.complaint.outsource_date) ? this.complaint.outsource_date : '',
            return_date: (this.complaint.return_date) ? this.complaint.return_date : '',
            delivery_date: (this.complaint.delivery_date) ? this.complaint.delivery_date : '',
            fault_report_by_customer: (this.complaint.fault_report_by_customer) ? this.complaint.fault_report_by_customer : '',
            outsource: (this.complaint.outsource) ? this.complaint.outsource : '',
            outsource_item: (this.complaint.out_source_item) ? this.complaint.out_source_item : '',
            ready_date: (this.complaint.ready_date) ? this.complaint.ready_date : '',
            diagnose_by_engg: (this.complaint.diagnose_by_engg) ? this.complaint.diagnose_by_engg : '',
            customer_feedback: (this.complaint.customer_feedback) ? this.complaint.customer_feedback : '',
            c_status: (this.complaint.c_status) ? this.complaint.c_status : '',
            status: (this.complaint.status) ? this.complaint.status : '',
            engineer_id: '',
            request_id: '',
            complaint_id: '',
            request_detail: '',
            request_text: '',
            product_details: '',
            product_on_request_id: '',
            request_to_store_id: '',
            out_source_vendor: '',
            lab_complaint: '',
        }
    },
    props: {        
        complaint: [Array, Object],       
    },
   
    methods: {
      formatEngineerType(engineerType) {
        return engineerType.replace(/_/g, ' ');
      },
      showPartRequestModal(request){    
        this.request_id = request.id,     
        this.engineer_id = request.engineer_id;
        this.complaint_id = request.complaint_id;
        this.request_detail = request.request;
        this.request_text = 'OutSource Request for: ' + request.request;
        this.request_part_store = true;
      },
    
      submit_out_source_complaint(){
        var formData = new FormData();
        this.processing = true;
        formData.append("access_token", window.settings.access_token);
        formData.append('out_source_id', this.out_source_id);
        formData.append('complaint_id', this.complaint_id);
        formData.append('lab_complaint', this.lab_complaint);
        formData.append('out_source_vendor', this.out_source_vendor);
        formData.append('product_details', this.product_details);


        console.log(...formData);

        axios.post('/api/out_source_complaint_complete', formData).then((response) => {

          if (response.status == 200) {
              this.show_response_message(response.data.msg, 'Success');

              location.reload();

          } else {
              this.show_modal = false;
              this.processing = false;
              try {
                  var error_json = JSON.parse(response.data.msg);
                  this.loop_api_errors(error_json);
              } catch (err) {
                  this.server_errors = response.data.msg;
              }
              this.error_class = 'error';
          }

        })
        .catch((error) => {
          console.log(error);
        });
      },
     
   

        cancel_complaint() {
            this.$off("cancel_complaint");
            this.show_assign_complaint = false;
            this.required_product = false;
            this.assign_required_product = false;
            this.complaint_complete = false;
            this.complaint_invoice = false;
            this.show_payment_modal = false;
        },
        record_payment_invoice() {
            this.show_payment_modal = true;
        },
        request_for_product() {
            this.required_product = true;
        },

        OutSourceComplaint(request) {
         
          
          this.out_source_id = request.id;          
          this.complaint_id = request.complaint.id;
          this.lab_complaint = request.lab_complaint_id;
          this.out_source_complaint = true;    
        },

        complaint_completed() {
            this.complaint_complete = true
        },
        assign_requested_product() {
            this.assign_required_product = true;
        },
        submit_complaint_completed() {
            this.$validator.validateAll().then((result) => {
                if (result) {
                    this.$off("submit");
                    this.$off("close");
                    this.show_modal = true;

                    this.$on("submit", function() {

                        var formData = new FormData();
                        formData.append("access_token", window.settings.access_token);
                        formData.append('final_lab_staff_remark', this.final_lab_staff_remark);
                        formData.append('complaint_slack', this.complaint_slack);

                        axios.post('/api/complaint_completed', formData).then((response) => {

                                if (response.data.status_code == 200) {
                                    this.show_response_message(response.data.msg, 'Success');

                                    location.reload();

                                } else {
                                    this.show_modal = false;
                                    this.processing = false;
                                    try {
                                        var error_json = JSON.parse(response.data.msg);
                                        this.loop_api_errors(error_json);
                                    } catch (err) {
                                        this.server_errors = response.data.msg;
                                    }
                                    this.error_class = 'error';
                                }

                            })
                            .catch((error) => {
                                console.log(error);
                            });
                    });

                    this.$on("close", function() {
                        this.show_modal = false;
                    });
                }
            });
        },

        delete_category() {
            this.$off("submit");
            this.$off("close");
            this.show_modal = true;

            this.$on("submit", function() {
                this.processing = true;
                this.delete_processing = true;

                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);

                axios.post(this.delete_category_api_link, formData).then((response) => {

                        if (response.data.status_code == 200) {
                            this.show_response_message(response.data.msg, 'Success');
                            if (response.data.link != "") {
                                window.location.href = response.data.link;
                            } else {
                                location.reload();
                            }
                        } else {
                            this.show_modal = false;
                            this.processing = false;
                            try {
                                var error_json = JSON.parse(response.data.msg);
                                this.loop_api_errors(error_json);
                            } catch (err) {
                                this.server_errors = response.data.msg;
                            }
                            this.error_class = 'error';
                        }
                        this.delete_processing = false;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            });

            this.$on("close", function() {
                this.show_modal = false;
            });
        },
        requested_for_required_product() {
            this.$off("submit");
            this.$off("close");
            this.show_modal = true;

            this.$on("submit", function() {
                this.processing = true;
                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);
                formData.append("lab_staff_remark", this.lab_staff_remark);
                formData.append('complaint_slack', this.complaint_slack);
                axios.post('/api/request_requirement', formData).then((response) => {

                        if (response.data.status_code == 200) {
                            this.show_response_message(response.data.msg, 'Success');
                            if (response.data.link != "") {
                                location.reload();
                            } else {
                                location.reload();
                            }
                        } else {
                            this.show_modal = false;
                            this.processing = false;
                            try {
                                var error_json = JSON.parse(response.data.msg);
                                this.loop_api_errors(error_json);
                            } catch (err) {
                                this.server_errors = response.data.msg;
                            }
                            this.error_class = 'error';
                        }
                        this.delete_processing = false;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            })
        },
        submit_transaction() {
            // this.$validator.validateAll().then((result) => {
            // if (result) {
            this.$off("submit");
            this.$off("close");
            this.show_modal = true;
            // alert(this.show_modal);
            this.$on("submit", function() {

                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);
                formData.append('complaint_slack', this.complaint_slack);
                formData.append('received_amount', this.amount);
                formData.append('notes', this.notes);
                formData.append('payment_method', this.payment_method);
                formData.append('account', this.account);
                formData.append('transaction_type_data', this.transaction_type_data);
                formData.append('transaction_date', this.transaction_date);
                formData.append('payment_total_amount', this.payment_total_amount);

                axios.post('/api/complaint_submit_transaction', formData).then((response) => {

                        if (response.data.status_code == 200) {
                            this.show_response_message(response.data.msg, 'Success');

                            location.reload();

                        } else {
                            this.show_modal = false;
                            this.processing = false;
                            try {
                                var error_json = JSON.parse(response.data.msg);
                                this.loop_api_errors(error_json);
                            } catch (err) {
                                this.server_errors = response.data.msg;
                            }
                            this.error_class = 'error';
                        }

                    })
                    .catch((error) => {
                        console.log(error);
                    });
            });

            this.$on("close", function() {
                this.show_modal = false;
            });
            //     }
            // });
        }
    }
}
</script>
