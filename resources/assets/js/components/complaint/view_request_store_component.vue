<template>
    <div class="row card p-4">
      
      <div class="col-md-12">
        <div class="d-flex flex-wrap mb-4">
          <div class="mr-auto">
            <div class="d-flex">
              <div>
                <span class="text-title">
                  <span class="text-muted">{{ $t("Product Request") }}</span>
                </span>
              </div>
            </div>
          </div>
  
          <div class="">
            <span></span>
          </div>
        </div>

        <div class="">
           
            <div>
              
              <span class="alert alert-success">
                {{ request_to_store.user.fullname}} Has Request for {{ request_to_store.request }} at {{ request_to_store.start_request_time }} Please Assign Product to {{ request_to_store.user.fullname }}
              </span>
            </div>           


        </div>
  
        <div class="d-flex flex-wrap mb-4">
          <p v-html="server_errors" v-bind:class="[error_class]"></p>
          
          <div class="ml-auto d-flex">
          
  
            <div v-if="!request_to_store.end_request_time">
              <button
                type="submit"
                class="btn btn-success mr-1"
                
                v-on:click="assign_requested_product()"
              >
                {{ $t("Requirement Assign") }}
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
            <label for="category_code">{{ $t("Product Request") }}</label>
  
            <p>{{ request_to_store.request }}</p>
          </div>
          <div class="form-group col-md-3">
            <label for="category_code">{{ $t("Request Assign Time") }}</label>
  
            <p>{{ request_to_store.start_request_time }}</p>
          </div>

          <div class="form-group col-md-3">
            <label for="category_code">{{ $t("Request Status") }}</label>
  
            <p :class="request_to_store.end_request_time ? 'alert alert-success w-50' : 'alert alert-info w-50'">
              {{ request_to_store.end_request_time ? 'Completed' : 'Pending...' }}
            </p>
          </div>

          <div class="form-group col-md-3" v-if="request_to_store.end_request_time">
            <label for="category_code">{{ $t("Request Status") }}</label>  
            <p>{{ request_to_store.end_request_time }}</p>
          </div>
  
          
        </div>
  

      </div>
  
      <modalcomponent
        v-if="assign_required_product == true"
        v-on:close="assign_required_product = false"
        :modal_width="'modal-container-xl'"
      >
        <template v-slot:modal-header> Add Require Products </template>
        <template v-slot:modal-body>
        <div class="form-row mb-2">
            <div class="form-group col-sm-12 col-md-6">
                <label for="extend_date">{{ $t("Enter Product Serial No  OR Product Model") }}</label>
                <input 
                    type="text" 
                    class="form-control form-control-custom" 
                    v-model="serial_no" 
                    @keyup="onKeyUp"
                >
            </div>
        </div>
          <div class="form-row mb-2">
  
            <div
              class="form-group col-sm-12 col-md-12 mx-auto"
              v-if="products.length > 0"
            >
              <table class="table">
                <tr>
                  <th>Product Serial</th>  
                  <th>Product Name</th>  
                  <th>Product Category</th>  
                  <th>Product Model</th>
                  <th>Assign</th>
                </tr>
  
                <tr v-for="(product, index) in products" :key="index">
                  <td>{{ product.product_code }}</td>  
                  <th>{{ product.name }}</th>  
                  <th>
                    {{ product.subcategory.category.label }}
                    ({{product.subcategory.category.category_code }})
                  </th>
                  <th>
                    <span v-for="(spec, index) in product.product_specifications" :key="index" >
                        <p v-if="spec.specification_label == 'Model'">
                            {{ spec.specification_details }}
                        </p>
                    </span>
                  </th>
                  <td>
                    <input
                      type="checkbox"
                      name="product_id"
                      v-model="product_ids"
                      @change="fetchSelectedProducts"
                      :value="product.id"
                    />
                  </td>
                </tr>
              </table>
            </div>
  
            <div
              class="form-group col-sm-12 col-md-12 mx-auto"
              v-if="Selectedproducts.length > 0"
            >
              <table class="table">
                <tr v-for="(product, index) in Selectedproducts" :key="index">
                  <td>{{ product.product_code }}</td>
  
                  <td>{{ product.name }}</td>
  
                  <th>
                    {{ product.subcategory.category.label }}
                    ({{product.subcategory.category.category_code }})
                  </th>
  
                  <th>{{ product.subcategory.sub_category_name }}</th>
  
                  <td>
                    <input
                      type="checkbox"
                      name="product_id"
                      v-model="product_ids"
                      @change="fetchSelectedProducts"
                      :value="product.id"
                    />
                  </td>
                </tr>
              </table>
            </div>

            <div class="form-group col-12 mx-auto">
                <input
                      type="checkbox"
                      name="product_id"
                      v-model="out_source_request"
                    /> There's not that product in inventory
            </div>
  
            <div class="form-group col-sm-12 col-md-12 mx-auto">
              <label for="store_remark">{{ $t("Add Remark") }}</label>
  
              <textarea
                name="store_remark"
                v-model="store_remark"
                v-validate="'required|max:65535'"
                class="form-control form-control-custom"
                rows="5"
                :placeholder="$t('Enter Remark')"
              ></textarea>
  
              <span v-bind:class="{ error: errors.has('store_remark') }">{{
      
                              errors.first("store_remark")
  
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
            @click="assign_required_product_on_requested"
          >
            Assigned
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
      <modalcomponent
        v-if="request_part_store"
        v-on:close="request_part_store = false"
        :modal_width="'modal-container-xl'"
      >
        <template v-slot:modal-header>
          {{ $t("Request Product") }}
        </template>
        <template v-slot:modal-body>
          <div class="form-row mb-2">
            <input type="hidden" name="request_id" v-model="request_id" />
            <input type="hidden" name="engineer_id" v-model="engineer_id" />
            <input type="hidden" name="complaint_id" v-model="complaint_id" />
            <input type="hidden" name="request_detail" v-model="request_detail" />
            <div class="form-group col-md-12">
              <input name="request_text" class="form-control" v-model="request_text" readonly />
            </div>
            <div class="form-group col-md-12">
              <label
                for="product_details"
                >{{ $t("Details for Product") }} </label
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
            type="submit"
            class="btn btn-primary"
            @click="submit_request_to_store()"
          >
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
              out_source_request: '',
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
              request_part_store: false,
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
              store_remark: '',
              request_id: this.request_to_store.id,
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
              complaint_id: '',
              request_detail: '',
              request_text: '',
              product_details: '',
              serial_no: '',
              debounceTimeout: null
          }
      },
      props: {
          
          complaint: Array,
          out_source_items: [Array, Object],
          request_to_store: [Array, Object]
      },
      mounted() {
          console.log('Category detail page loaded');
          event_bus.$on('cancel_complaint', this.cancel_complaint);
          this.fetchCategorySubcategoryMounted();
          this.fetchComplaintRecord();
      },
      methods: {
            onKeyUp() {
                clearTimeout(this.debounceTimeout);
                this.debounceTimeout = setTimeout(() => {
                    this.SearchProducts();
                }, 1000);
            },
            SearchProducts() {
                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);
                formData.append("serial_no", this.serial_no);
                axios.post('/api/search_products_against_serial_no', formData).then((response) => {  
                    
                    if (response.status == 200) {    
                        console.log(response.data.data.products);                    
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
                          formData.append('store_remark', this.store_remark);
                          formData.append('request_id', this.request_id);
                          formData.append('out_source_request', this.out_source_request);
                          formData.append('product_ids', this.product_ids);
  
                          console.log(...formData);
  
                          axios.post('/api/assign_product_to_technician', formData).then((response) => {
  
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
  
                      if (response.status == 200) {
                        
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
  