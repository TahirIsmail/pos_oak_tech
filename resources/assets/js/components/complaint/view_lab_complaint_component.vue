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
  
          <div class="">
            <span></span>
          </div>
        </div>
        <div class="d-flex flex-wrap mb-4" v-if="user_data && user_data.part_requests">
          <span class="alert alert-success" v-for="request in user_data.part_requests" :key="request.id">
            {{ 'Your Request for ' + request.request + (request.request_status == 2 && request.engineer_type == 'Lab_Engineer' ? ' Completed' : ' is Pending') }}
          </span>
          </div>
          
          <div class="d-flex flex-wrap mb-4" v-if="complaint.complaint_assign_to_lab_enggs[0].complaint_outsource_request == 1">
          <span class="alert alert-success">
            {{ 'Request for OutSource Product' }}
          </span>
          </div>

        <div class="d-flex flex-wrap mb-4">
          <div class="ml-auto">
              <button
                type="submit"
                class="alert alert-success mr-1"
                v-if="complaint.complaint_completed_date == null && complaint.complaint_assign_to_lab_enggs[0].assign_complaint_complete_time == null"
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
            
            
  
            <div v-if="complaint.complaint_completed_date == null && complaint.complaint_assign_to_lab_enggs[0].assign_complaint_complete_time == null && complaint.complaint_assign_to_lab_enggs[0].complaint_outsource_request == 0">
              <button
                type="submit"
                class="btn btn-success mr-1"                
                v-on:click="request_for_product()">
                {{ $t("Add Required Product") }}
              </button>
            </div>

            <div v-if="complaint.complaint_completed_date == null && complaint.complaint_assign_to_lab_enggs[0].assign_complaint_complete_time == null && complaint.complaint_assign_to_lab_enggs[0].complaint_outsource_request == 0">
              <button
                type="submit"
                class="btn btn-primary mr-1"
                v-on:click="add_remarks()">
                {{ $t("Add Remarks") }}
              </button>
            </div>

          
  
            <div v-if="complaint.complaint_completed_date == null && complaint.complaint_assign_to_lab_enggs[0].assign_complaint_complete_time == null && complaint.complaint_assign_to_lab_enggs[0].complaint_outsource_request == 0">
              <button
                type="submit"
                class="btn btn-success mr-1"
                v-on:click="complaint_completed()"
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
          <div class="form-group col-md-3">
            <label for="category_code">{{ $t("Complaint Ticket") }}</label>
  
            <p>{{ complaint.ticket }}</p>
          </div>
  
          <div class="form-group col-md-3">
            <label for="label">{{ $t("Date") }}</label>
  
            <p>{{ complaint.date }}</p>
          </div>
  
          <div class="form-group col-md-3">
            <label for="label">{{ $t("Time") }}</label>
  
            <p>{{ complaint.time }}</p>
          </div>
  
          <div class="form-group col-md-3">
            <label for="label">{{ $t("Customer Name") }}</label>
  
            <p>{{ complaint.user_name }}</p>
          </div>
  
          <div class="form-group col-md-3">
            <label for="label">{{ $t("Complaint Status") }}</label>
  
            <p class="alert alert-success w-50">
              {{ complaint.c_status }}
            </p>
          </div>
          <div class="form-group col-md-3" v-if="complaint.complaint_status_label">
            <label for="label">{{ $t("Status") }}</label>  
            <p class="alert alert-success w-50">
              {{ complaint.complaint_status_label }}
            </p>
          </div>

          <div class="form-group col-md-3" v-if="complaint.status">
            <label for="label">{{ $t("Status For OAK") }}</label>  
            <p class="alert alert-success w-50">
              {{ complaint.status }}
            </p>
          </div>

          <div
            class="form-group col-md-3"
            v-if="complaint.complaint_completed_date"
          >
            <label for="created_by">{{ $t("Completed Date") }}</label> 
            <p class="alert alert-success w-50">{{ complaint.complaint_completed_date }}</p>
          </div>
  
          <div class="form-group col-md-3">
            <label for="created_by">{{ $t("Complaint Details") }}</label>
  
            <p class="">{{ complaint.complaint_details }}</p>
          </div>
  
          <div class="form-group col-md-3">
            <label for="created_by">{{ $t("End User Details") }}</label>  
            <p class="">{{ complaint.end_user_details }}</p>
          </div>
  
          <div class="form-group col-md-3">
            <label for="created_by">{{ $t("Service Required") }}</label>  
            <p class="">{{ complaint.service_required }}</p>
          </div>
  
          <div class="form-group col-md-3">
            <label for="created_by">{{ $t("POC Name") }}</label>  
            <p class="">{{ complaint.poc_name }}</p>
          </div>
  
          <div class="form-group col-md-3">
            <label for="created_by">{{ $t("Parts Required") }}</label>
            <p class="">{{ complaint.parts_required }}</p>
          </div>
  
          <div class="form-group col-md-3">
            <label for="created_by">{{ $t("Service Type") }}</label>
            <p class="">{{ complaint.type_of_service }}</p>
          </div>  
  
          <div class="form-group col-md-3" v-if="!is_customer">
            <div v-if="complaint.due_date">
              <label for="created_by">{{ $t("due Date") }}</label>  
              <p class="alert alert-danger w-50">{{ complaint.due_date }}</p>
            </div>
          </div>
  
          <div class="form-group col-md-3" v-if="complaint.admin_remark">
            <label for="created_by">{{ $t("Manager Remark to Lab Technician") }}</label>  
            <p> {{ complaint.admin_remark }} </p>
          </div>
  
         
  
          <div
            class="form-group col-md-3"
            v-if="complaint.complaint_status == 'Request Completed' || complaint.complaint_status == 'Completed Complaint'"
          >
            <div v-if="complaint.lab_staff_remark">
              <label for="" >{{ $t("Lab Technician Requirement Request.") }}</label>  
              <p>
                <strong class="alert alert-success">
                  {{ complaint.lab_staff_remark }}
                </strong>
              </p>
            </div>
          </div>
  
          <div class="form-group col-md-3" v-else>
            <div v-if="complaint.lab_staff_remark">
              <label for="">{{ $t("Lab Technician Requirement Request.") }}</label>  
              <p>
                <strong class="alert alert-danger">
                  {{ complaint.lab_staff_remark }}
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
  
        <div>

          <div class="form-row mb-2 mt-2" v-if="user_data && user_data.part_requests">
          <div class="form-group col-12">
            <table class="table table-striped display nowrap text-nowrap w-100">
            <thead>
              <tr>
                <th scope="col">#</th>  
                <th scope="col">{{ $t("Part Request") }}</th>  
                <th scope="col">{{ $t("Request Start Time") }}</th>
                <th scope="col">{{ $t("Request Complete Time") }}</th>  
                <th scope="col">{{ $t("Request Status") }}</th>  
              </tr>
            </thead>  
            <tbody>
              <tr
                v-for="(request, key, index) in user_data.part_requests"               
                v-bind:key="index"
              >
                <th scope="col">{{ key+1 }}</th>  
                <td>{{ request.request }}</td>  
                <td>{{ request.start_request_time }}</td>  
                <td>{{ request.end_request_time }}</td>  
                <td v-if="request.request_status == 0">
                  <span class="alert alert-danger" >Pending manager side</span>
                </td>
                <td v-else-if="request.request_status == 1">
                  <span class="alert alert-danger">Pending store side</span>
                </td>
                <td v-else-if="request.request_status == 2 && request.end_request_time != null">
                  <span class="alert alert-info">Completed</span>
                </td>
                <td v-else></td>               
              </tr>
            </tbody>
          </table>
          </div>
        </div>
        
          
        </div>
  
      
  
        
      </div>
  
   
      <modalcomponent
        v-if="required_product == true"
        v-on:close="required_product = false"
        :modal_width="'modal-container-md'"
      >
        <template v-slot:modal-header>
          Add Request For Required Product
        </template>
        <template v-slot:modal-body>
          <div class="form-row mb-2">
            <div class="form-group col-sm-12 col-md-10 mx-auto">
              <label for="lab_staff_remark">{{ $t("Add Request") }}</label>
  
              <textarea
                name="lab_staff_remark"
                v-model="lab_staff_remark"
                v-validate="'required|max:65535'"
                class="form-control form-control-custom"
                rows="5"
                :placeholder="$t('Enter Remark')"
              ></textarea>
  
              <span v-bind:class="{ error: errors.has('lab_staff_remark') }">{{
      
                              errors.first("lab_staff_remark")
  
              }}</span>
            </div>
          </div>
        </template>
        <template v-slot:modal-footer>
          <button type="button" class="btn btn-light" @click="cancel_complaint">
            Cancel
          </button>
  
          <button
            type="button"
            class="btn btn-primary"
            @click="requested_for_required_product"
          >
            Requested
          </button>
        </template>
      </modalcomponent>
  
      <modalcomponent
        v-if="complaint_complete == true"
        v-on:close="complaint_complete = false"
        :modal_width="'modal-container-md'"
      >
        <template v-slot:modal-header> Complaint Completed </template>
        <template v-slot:modal-body>
          <div class="form-row mb-2">
            <div class="form-group col-sm-12 col-md-10 mx-auto">
              <label
                for="final_lab_staff_remark"
                >{{ $t("Add Comment On Complaint") }}</label
              >
  
              <textarea
                name="final_lab_staff_remark"
                v-model="final_lab_staff_remark"
                v-validate="'required|max:65535'"
                class="form-control form-control-custom"
                rows="5"
                :placeholder="$t('Enter Comment')"
              ></textarea>
  
              <span
                v-bind:class="{ error: errors.has('final_lab_staff_remark') }"
                >{{
      
                              errors.first("final_lab_staff_remark")
  
                }}</span
              >
            </div>
          </div>
        </template>
        <template v-slot:modal-footer>
          <button type="button" class="btn btn-light" @click="cancel_complaint">
            Cancel
          </button>
  
          <button
            type="button"
            class="btn btn-primary"
            @click="submit_complaint_completed"
          >
            Complaint Completed
          </button>
        </template>
      </modalcomponent>
  
      
  
  

      <modalcomponent
        v-if="add_remark_modal"
        v-on:close="add_remark_modal = false"
        :modal_width="'modal-container-xl'"
      >
        <template v-slot:modal-header>
          {{ $t("Add Complaint Remarks") }}
        </template>
        <template v-slot:modal-body>
          <div class="form-row mb-2">           
  
            <div class="form-group col-md-4">
              <label for="parts_required">{{ $t("Parts Required") }}</label>
  
              <select
                name="parts_required"
                v-model="parts_required"
                v-validate="'required'"
                class="form-control form-control-custom custom-select"
              >
                <option value="" disabled>Choose parts_required..</option>
  
                <option value="Yes">Yes</option>
  
                <option value="No">No</option>
              </select>
  
              <span
                v-bind:class="{ 'error' : errors.has('parts_required') }"
                >{{ errors.first('parts_required') }}</span
              >
            </div>

            <div class="form-group col-md-4">
              <label for="outsource">{{ $t("OutSource") }}</label>  
              <select
                name="outsource"
                v-model="outsource"
                v-validate="'required'"
                class="form-control form-control-custom custom-select"
              >
                <option value="" disabled>Choose Out-Source..</option>  
                <option value="Yes">Yes</option>  
                <option value="No">No</option>
              </select>
            </div>


            <div class="form-group col-md-8">
              <label
                for="diagnose_by_engg"
                >{{ $t("Fault Diagnose By Engineer") }} </label
              >  
              <textarea
                name="diagnose_by_engg"
                v-model="diagnose_by_engg"
                class="form-control form-control-custom"
                row="1"
              ></textarea>
            </div>
  
  


          </div>
        </template>
        <template v-slot:modal-footer>
          <button
            type="submit"
            class="btn btn-primary"
            v-bind:disabled="processing == true"
            @click="submit_complaint_remarks()"
          >
          <i class="fa fa-circle-notch fa-spin" v-if="processing == true"></i>
            Continue
          </button>
        </template>
      </modalcomponent>


      <modalcomponent
        v-if="add_customer_feedback"
        v-on:close="add_customer_feedback = false"
        :modal_width="'modal-container-xl'"
      >
        <template v-slot:modal-header>
          {{ $t("Add Complaint Feedback") }}
        </template>
        <template v-slot:modal-body>
          <div class="form-row mb-2">

            <div class="form-group col-md-8">
              <label
                for="customer_feedback"
                >{{ $t("Add Complaint Feedback") }} </label
              >  
              <textarea
                name="customer_feedback"
                v-model="customer_feedback"
                class="form-control form-control-custom"
                row="1"
              ></textarea>
            </div>
  
  


          </div>
        </template>
        <template v-slot:modal-footer>
          <button
            type="submit"
            class="btn btn-primary"
            @click="submit_customer_feedback()"
          >
            Continue
          </button>
        </template>
      </modalcomponent>
  
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
              notes: '',
              transaction_type_data: '',
              complaint_status_modal: false,
              add_customer_feedback: false,
              add_remark_modal: false,
              delete_processing: false,
              show_payment_modal: false,
              show_modal: false,
              show_assign_complaint: false,
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
              assign_complaint_id: (this.complaint.complaint_assign_to_lab_enggs) ?  this.complaint.complaint_assign_to_lab_enggs[0].id : '',
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
          }
      },
      props: {
          labusers: Array,
          complaint: Array,
          user_data: [Array, Object],
          assign_access: Boolean,
          requirement_request_access: Boolean,
          Customer_complaint_make_invoice: Boolean,
          delete_access: Boolean,
          is_lab_tech: Boolean,
          out_source_items: [Array, Object],
          is_customer: Boolean
      },
      mounted() {
          console.log('Category detail page loaded');
          event_bus.$on('cancel_complaint', this.cancel_complaint);
          this.fetchCategorySubcategoryMounted();
          this.fetchComplaintRecord();
      },
      methods: {
          addCharge() {
              if (this.charges.length < 10) {
                  this.charges.push("");
              }
          },
  
          add_complaint_status() {
              this.complaint_status_modal = true;
          },

          add_remarks(){
            this.add_remark_modal = true;
          },
          add_feedback(){
            this.add_customer_feedback = true;
          },

          submit_customer_feedback(){
            var formData = new FormData();
            formData.append("access_token", window.settings.access_token);
            formData.append('complaint_slack', this.complaint_slack);
            formData.append('customer_feedback', this.customer_feedback);
            axios.post('/api/add_customer_feedback', formData).then((response) => {
  
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
          },

          submit_complaint_remarks(){
            this.processing = true;
            var formData = new FormData();
            formData.append("access_token", window.settings.access_token);
            formData.append('complaint_slack', this.complaint_slack);
            formData.append('parts_required', this.parts_required);
            formData.append('outsource', this.outsource);
            formData.append('assign_complaint_id', this.assign_complaint_id);
            formData.append('outsource_item', this.outsource_item);
            formData.append('ready_date', this.ready_date);
            formData.append('diagnose_by_engg', this.diagnose_by_engg);

            axios.post('/api/change_complaint_remark_by_engg', formData).then((response) => {
  
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
          },
  
          submit_complaint_status() {           
              var formData = new FormData();
              formData.append("access_token", window.settings.access_token);
              formData.append("complaint_slack", this.complaint_slack);
              formData.append('billable', this.billable);
              formData.append('parts_required', this.parts_required);
              formData.append('complaint_status_label', this.complaint_status);
              formData.append('type_of_service', this.type_of_service);
              formData.append('complaint_ok', this.complaint_ok);
              formData.append('picked_for_workshop', this.picked_for_workshop);
              formData.append('equipment_s_no', this.equipment_s_no);
              formData.append('equipment_specs', this.equipment_specs);
              formData.append('accessories', this.accessories);
              formData.append('invoice_number', this.invoice_number);
              formData.append('po_number', this.po_number);
              formData.append('condition', this.condition);
              formData.append('equipment_part_serial_number', this.equipment_part_serial_number);
              formData.append('outsource_date', this.outsource_date);
              formData.append('return_date', this.return_date);
              formData.append('delivery_date', this.delivery_date);
              formData.append('fault_report_by_customer', this.fault_report_by_customer);  
              formData.append('c_status', this.c_status);
              formData.append('status', this.status);        
  
              axios.post('/api/change_complaint_status', formData).then((response) => {
  
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
  
          },
  
          complaint_invoice_make() {
              this.$off("submit");
              this.$off("close");
              this.show_modal = true;
  
              this.$on("submit", function() {
  
                  var formData = new FormData();
                  formData.append("access_token", window.settings.access_token);
                  formData.append("complaint_slack", this.complaint_slack);
                  formData.append('charge_label', this.charge_label);
                  formData.append('charge_price', this.charge_price);
                  formData.append('complaint_product_ids', this.complaint_product_ids);
  
                  axios.post('/api/complaint_invoice_make', formData).then((response) => {
  
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
          },
          fetchComplaintRecord() {
              var formData = new FormData();
              formData.append("access_token", window.settings.access_token);
              formData.append("complaint_slack", this.complaint_slack);
              axios.post('/api/fetchComplaintRecord', formData).then((response) => {
  
                      if (response.data.status_code == 200) {
                          this.ComplaintRecord = response.data.data.complaints;
                          this.transactions = response.data.data.complaints[0].transactions;
                          this.currency_codes = response.data.data.currency_codes;
                          this.payment_pending_amount = response.data.data.total_pending_amount;
                          this.payment_total_amount = response.data.data.total_complaint_amount_invoice;
  
                          this.payment_received_amount = response.data.data.total_received_amount;
                          // this.payment_pending_amount = response.data.data.total_pending_amount;
                          this.transaction_type = response.data.data.transaction_type;
                          this.payment_methods = response.data.data.payment_methods;
                          this.accounts = response.data.data.accounts;
  
  
                      } else {
  
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
          make_complaint_invoice() {
              var formData = new FormData();
              formData.append("access_token", window.settings.access_token);
              formData.append("complaint_slack", this.complaint_slack);
              axios.post('/api/assign_products_complaint', formData).then((response) => {
  
                      if (response.data.status_code == 200) {
                          this.ComplaintProducts = response.data.data.products;
                          this.complaint_product_ids = this.ComplaintProducts.map(product => product.id);
                          this.complaint_invoice = true;
                      } else {
  
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
          assign_required_product_on_requested() {
              this.$validator.validateAll().then((result) => {
                  if (result) {
                      this.$off("submit");
                      this.$off("close");
                      this.show_modal = true;
  
                      this.$on("submit", function() {
                          this.processing = true;
  
                          var formData = new FormData();
                          formData.append("access_token", window.settings.access_token);
                          formData.append('admin_again_remark', this.admin_again_remark);
                          formData.append('complaint_slack', this.complaint_slack);
                          formData.append('extend_date', this.extend_date);
                          formData.append('product_ids', this.product_ids);
  
                          console.log(...formData);
  
                          axios.post('/api/assign_product_to_technician', formData).then((response) => {
  
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
                                  this.delete_processing = false;
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
          fetchCategorySubcategoryMounted() {
              var formData = new FormData();
              formData.append("access_token", window.settings.access_token);
              axios.post('/api/fetchCategorySubcategory', formData).then((response) => {
  
                      if (response.data.status_code == 200) {
                          this.categories = response.data.data;
                          console.log(response.data.data);
                      } else {
  
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
  
          fetchCategoryProduct() {
              var formData = new FormData();
              formData.append("access_token", window.settings.access_token);
              formData.append("category_slack", this.category);
  
              axios.post('/api/fetchCategoryProduct', formData).then((response) => {
  
                      if (response.data.status_code == 200) {
                          this.scategories = response.data.data.subCategories;
                          this.products = response.data.data.products;
                      } else {
  
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
          fetchSubCategoryProduct() {
              // alert(this.s_category);
              var formData = new FormData();
              formData.append("access_token", window.settings.access_token);
              formData.append("sub_category_id", this.s_category);
  
              axios.post('/api/fetchSubCategoryProduct', formData).then((response) => {
  
                      if (response.data.status_code == 200) {
                          this.products = response.data.data.products;
                      } else {
  
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
          fetchSelectedProducts() {
              var formData = new FormData();
              formData.append("access_token", window.settings.access_token);
              formData.append("product_ids[]", this.product_ids);
              axios.post('/api/fetchSelectedProduct', formData).then((response) => {
  
                      if (response.data.status_code == 200) {
                          this.Selectedproducts = response.data.data.products;
                      } else {
  
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
          assign_complaint_to_labtechnician() {
              this.$validator.validateAll().then((result) => {
                  if (result) {
                      this.$off("submit");
                      this.$off("close");
                      this.show_modal = true;
  
                      this.$on("submit", function() {
                          this.processing = true;
                          this.delete_processing = true;
  
                          var formData = new FormData();
                          formData.append("access_token", window.settings.access_token);
                          formData.append('lab_staff_slack', this.labtechnician);
                          formData.append('complaint_slack', this.complaint_slack);
                          formData.append('due_date', this.due_date);
                          formData.append('admin_remark', this.admin_remark);
  
                          console.log(...formData);
  
                          axios.post('/api/assign_complaint_to_technician', formData).then((response) => {
  
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
                                  this.delete_processing = false;
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
          assigncomplaint_to_labtachnician() {
              this.show_assign_complaint = true;
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
                          formData.append('lab_complaint_id', this.assign_complaint_id);
  
                          axios.post('/api/lab_complaint_completed', formData).then((response) => {
  
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
                  formData.append('assign_complaint_id', this.assign_complaint_id);
                  console.log(...formData);
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
  