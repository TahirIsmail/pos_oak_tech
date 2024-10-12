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
            <div v-if="complaint.assign_to_field_engg == '1'">
              <span class="alert alert-info">
                  Complaint Assign To Field Engineer ({{complaint.field_user.fullname }} ({{ complaint.field_user.email }})) at 
                  {{ complaint.complaint_assign_to_field_enggs[0].assign_complaint_time }}
                  And 
                  {{
                      (complaint.complaint_assign_to_field_enggs[0].assign_complaint_complete_time === null && 
                      complaint.complaint_assign_to_field_enggs[0].complaint_complete == 'No') 
                      ? (complaint.picked_for_workshop == 'Yes' ? 'Moved to It Workshop.' : 'Still Not Complete') 
                      : 'Completed at ' + complaint.complaint_assign_to_field_enggs[0].assign_complaint_complete_time
                  }}
              </span>
            </div>
            <br />          
            <div v-if="complaint.assign_to_lab_engg == '1'">
              <span class="alert alert-info">
                Complaint Assign To Lab Engineer at ({{ complaint.user.fullname }} ({{ complaint.user.email }})) 
                {{ complaint.complaint_assign_to_lab_enggs[0].assign_complaint_time }}
                And 
                {{
                    complaint.complaint_assign_to_lab_enggs[0].assign_complaint_complete_time === null && 
                    complaint.complaint_assign_to_lab_enggs[0].complaint_complete == 'No'
                        ? (complaint.complaint_assign_to_lab_enggs[0].request_for_part == '1' && complaint.complaint_assign_to_lab_enggs[0].request_for_out_source_at != null
                            ? 'OutSource Request at: ' + complaint.complaint_assign_to_lab_enggs[0].request_for_out_source_at
                            : 'Still Not Complete')
                        : 'Completed at ' + complaint.complaint_assign_to_lab_enggs[0].assign_complaint_complete_time
                }}
            </span>
            </div>

            <div v-if="complaint.complaint_assign_to_lab_enggs.length > 0">
              <span class="alert alert-info">
               Devices Assign To Lab Engineers
            </span>
            </div>
            <br />

            <div v-if="complaint.part_requests && complaint.part_requests.length > 0">
              
              <p class="alert alert-success" v-for="request in complaint.part_requests" :key="request.id">
                {{ request.engineer_type === 'Lab_Engineer' 
                  ? `Lab Engineer ${request.engineer.fullname} has requested for ${request.request} at ${request.start_request_time}` +
                    (request.end_request_time == null
                      ? ' but not complete yet'
                      : ` and completed at ${request.end_request_time}`)
                  : '' 
                }}
              </p>
            </div>
             
            <br />

            <div v-if="complaint.outsource == 'Yes'">
              <span class="alert alert-info">
                  Lab Engineer ({{ complaint.user.fullname }} ({{ complaint.user.email }})) wants to OutSource Complaint...
              </span>
            </div>

            <br />

            <div v-if="complaint.out_source_vendor">
              <span class="alert alert-info">
                Complaint OutSource To ({{ complaint.out_source_vendor.vendor.fullname }} ({{ complaint.out_source_vendor.vendor.email }}))
                Vendor Start at {{ complaint.out_source_vendor.start_time }} 
                {{
                  complaint.out_source_vendor.end_time == null 
                  ? 'And Still Waiting...' 
                  : `And Completed at ${complaint.out_source_vendor.end_time}`
                }}
              </span>
            </div>

          </div>

        <div class="d-flex flex-wrap mb-4">
          <div class="ml-auto">
              <button
                type="submit"
                class="alert alert-success mr-1"
                v-if="complaint.complaint_completed_date == null"
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
            <div class="d-flex" >
              <div v-if="complaint.assign_to_field_staff_id == null && complaint.assign_to_lab_staff_id == null">
                <button  
                  type="submit"
                  class="btn btn-success mr-1"                 
                  v-on:click="assign_to_field_Engg()"
                  v-bind:disabled="assign_processing == true"
                >
                  <i
                    class="fa fa-circle-notch fa-spin"
                    v-if="assign_processing == true"
                  ></i>
                  {{ $t("Assign To Field Engg") }}
                </button>
              </div>

              <div v-if="complaint.picked_for_workshop == 'Yes'">
                <button  
                  type="submit"
                  class="btn btn-success mr-1"                 
                  v-on:click="assigncomplaint_to_labtachnician()"
                  v-bind:disabled="assign_processing == true"
                >
                  <i
                    class="fa fa-circle-notch fa-spin"
                    v-if="assign_processing == true"
                  ></i>
                  {{ $t("Assign Complaint") }}
                </button>
              </div>
  
              <!-- <button
                type="button"
                class="btn btn-primary mr-1"
                v-on:click="add_complaint_status()"
              >
                {{ $t("Complaint Status") }}
              </button> -->
            </div>
  
            <div v-if="complaint.outsource == 'Yes' && !complaint.out_source_vendor">
              <button
                type="submit"
                class="btn btn-success mr-1"
                v-on:click="OutSourceComplaint(complaint)"
              >
                {{ $t("OutSource Complaint") }}
              </button>
            </div>
            
  
            <div v-if="complaint.complaint_completed_date == null">
              <button
                type="submit"
                class="btn btn-success mr-1"
                v-if="complaint.assign_to_lab_staff_id != null && is_lab_tech"
                v-on:click="request_for_product()">
                {{ $t("Add Required Product") }}
              </button>
            </div>

            <div v-if="complaint.complaint_completed_date == null">
              <button
                type="submit"
                class="btn btn-primary mr-1"
                v-if="complaint.assign_to_lab_staff_id != null && is_lab_tech"
                v-on:click="add_remarks()">
                {{ $t("Add Remarks") }}
              </button>
            </div>

            <div v-if="complaint.complaint_completed_date != null">
              <button
                type="submit"
                class="btn btn-primary mr-1"
                v-if="is_customer && complaint.customer_feedback == null"
                v-on:click="add_feedback()">
                {{ $t("Add Feedback") }}
              </button>
            </div>
  
            <div v-if="complaint.complaint_completed_date == null">
              <button
                type="submit"
                class="btn btn-success mr-1"
                v-on:click="complaint_completed()"
              >
                {{ $t("Complaint Complete") }}
              </button>
            </div>
  
            <div
              v-if="requirement_request_access && complaint.complaint_completed_date == null"
            >
              <button
                type="submit"
                class="btn btn-success mr-1"
                v-if="requirement_request"
                v-on:click="assign_requested_product()"
              >
                {{ $t("Requirement Assign") }}
              </button>
            </div>
  
            <div
              v-if="Customer_complaint_make_invoice && complaint.complaint_completed_date != null && complaint.final_total_amount == null"
            >
              <button
                type="submit"
                class="btn btn-success mr-1"
                v-if="Customer_complaint_make_invoice"
                v-on:click="make_complaint_invoice()"
              >
                {{ $t("Generate Invoice") }}
              </button>
            </div>
  
            <div
              v-if="Customer_complaint_make_invoice && complaint.complaint_completed_date != null && complaint.final_total_amount != null"
            >
              <button
                type="submit"
                class="btn btn-success mr-1"
                v-if="Customer_complaint_make_invoice"
                v-on:click="record_payment_invoice()"
              >
                {{ $t("Record Payment") }}
              </button>
            </div>
  
            <div
              v-if="payment_pending_amount == 0 && complaint.final_total_amount != null"
            >
              <a
                class="btn btn-outline-primary mr-1"
                v-bind:href="'/print_complaint_invoice/'+complaint_slack"
                target="_blank"
                >{{ $t("PDF") }}</a
              >
            </div>
  
            <div v-if="delete_access">
              <button
                type="submit"
                class="btn btn-danger mr-1"
                v-if="delete_access == true"
                v-on:click="delete_category()"
                v-bind:disabled="delete_processing == true"
              >
                <i
                  class="fa fa-circle-notch fa-spin"
                  v-if="delete_processing == true"
                ></i>
                {{ $t("Delete Complaint") }}
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
            <label for="category_code">{{ $t("No of Devices") }}</label>  
            <input 
              type="number"
              ref="noOfDevicesInput"
              :value="no_of_devices" 
              :readonly="isReadonly" 
              @input="updateNoOfDevices($event)"
            >
            <i 
              :class="isReadonly ? 'fa fa-edit' : 'fa fa-check'" 
              @click="toggleEdit"
              style="cursor: pointer;"
            ></i>
          </div>
  
          <div class="form-group col-md-3">
            <label for="label">{{ $t("Customer Name") }}</label>
  
            <p>{{ complaint.user_name }}</p>
          </div>
  
          <div class="form-group col-md-3" v-if="complaint.c_status">
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

          <div class="form-group col-md-3" v-if="!is_customer && complaint.status">
            <label for="label">{{ $t("Status For OAK") }}</label>  
            <p class="alert alert-success w-50">
              {{ complaint.status }}
            </p>
          </div>
  
          <div class="form-group col-md-3" v-if="!is_customer && complaint.user">
            <label for="created_by">{{ $t("Assign to LabTechnician") }}</label>
  
            <p v-if="complaint.user">{{ complaint.user.fullname }} ({{ complaint.user.email }})</p>
            <p v-else class="alert alert-danger w-50">Not Assign Yet</p>
          </div>

          <div class="form-group col-md-3" v-if="!is_customer">
            <label for="created_by">{{ $t("Assign to Field Engineer") }}</label>
  
            <p v-if="complaint.field_user">{{ complaint.field_user.fullname }} ({{ complaint.field_user.email }})</p>
            <p v-else class="alert alert-danger w-50">Not Assign</p>
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
            <label for="created_by">{{ $t("Service Type") }}</label>
            <p class="">{{ complaint.type_of_service }}</p>
          </div>
  
          <div class="form-group col-md-3">
            <label for="created_by">{{ $t("Picked For Workshop") }}</label>
            <p class="">{{ complaint.picked_for_workshop }}</p>
          </div>  
         
          <div class="form-group col-md-3" v-if="!is_customer">
            <div v-if="complaint.due_date">
              <label for="created_by">{{ $t("due Date") }}</label>
  
              <p class="alert alert-danger w-50">{{ complaint.due_date }}</p>
            </div>
          </div>
  
          <div class="form-group col-md-3" v-if="complaint.admin_remark">
            <label
              for="created_by"
              >{{ $t("Manager Remark to Lab Technician") }}</label
            >  
            <p> {{ complaint.admin_remark }} </p>
          </div>
  
         
  
          <div
            class="form-group col-md-3"
            v-if="complaint.complaint_status == 'Request Completed' || complaint.complaint_status == 'Completed Complaint'"
          >
            <div v-if="complaint.lab_staff_remark">
              <label
                for=""
                >{{ $t("Lab Technician Requirement Request.") }}</label
              >
  
              <p>
                <strong class="alert alert-success">
                  {{ complaint.lab_staff_remark }}
                </strong>
              </p>
            </div>
          </div>
  
          <div class="form-group col-md-3" v-else>
            <div v-if="complaint.lab_staff_remark">
              <label
                for=""
                >{{ $t("Lab Technician Requirement Request.") }}</label
              >
  
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
          <hr />
  
          <div class="mb-2" v-if="complaint.final_total_amount != null">
            <span class="text-subhead">Product Information</span>
          </div>
  
          <div class="mb-2" v-if="complaint.final_total_amount != null">
            <span class="text-subhead">Other Charges Information</span>
          </div>
        </div>
  
        <div class="mb-2" v-if="complaint.final_total_amount != null">
          <span class="text-subhead">{{ $t("Transactions") }}</span>
        </div>
  
        <br>
        


        <div class="table-responsive mb-2" v-if="complaint.complaint_assign_to_lab_enggs">
          <table class="table table-striped display nowrap text-nowrap w-100">
            <thead>
              <tr>
                <th scope="col">#</th>  
                <th scope="col">{{ $t("Complaint Ticket") }}</th>  
                <th scope="col">{{ $t("Device Name") }}</th>
                <th scope="col">{{ $t("Model") }}</th>
                <th scope="col">{{ $t("Make") }}</th>
                <th scope="col">{{ $t("Serial No") }}</th>
                <th scope="col">{{ $t("Assign Date") }}</th>
                <th scope="col">{{ $t("Assigned To") }}</th>  
                <th scope="col">{{ $t("Complaint Complete") }}</th>
                <th scope="col">{{ $t("Status") }}</th>  
                <th scope="col">{{ $t("Action") }}</th>  
              </tr>
            </thead>
  
            <tbody>
              <tr
                v-for="(comp, key, index) in complaint.complaint_assign_to_lab_enggs"
                v-bind:value="comp.id"
                v-bind:key="index"
              >
                <th scope="col">{{ key+1 }}</th>  
                <td>{{ complaint.ticket }}</td>  
                <td>{{ comp.product_name }}</td>  
                <td>{{ comp.model }}</td>
                <td>{{ comp.make }}</td>
                <td>{{ comp.serial_no }}</td>
                <td>{{ comp.assign_complaint_time }}</td>
                <td>{{ comp.users.fullname }}({{ comp.users.email }})</td>
                <td v-if="comp.outsourced_complaint == 1 && comp.out_source_complaint_completed == 1 && comp.out_source_complaint_completed_time != null">
                    <div class="alert alert-success">OutSource Complaint completed at {{ comp.out_source_complaint_completed_time }}</div>
                </td>
                <td v-else-if="comp.outsourced_complaint == 0 && comp.complaint_complete == 'Yes' && comp.assign_complaint_complete_time != null">
                  <div class="alert alert-success">Complaint completed at {{ comp.assign_complaint_complete_time }}</div>
                </td>
                <td v-else>

                </td>
                <td v-if="comp.complaint_status == '0'">
                  <div class="alert alert-warning">Pending...</div>
                </td>
                <td v-else-if="comp.complaint_status == '1'">
                  <button type="button" class="btn btn-primary" @click="OutSourceComplaint(comp)">{{ $t("OutSource Product") }}</button>
                </td>
                <td v-else-if="comp.complaint_status == '2'">
                  <div class="alert alert-success">Completed</div>
                </td>
                <td v-else-if="comp.complaint_status == '3'">
                  <div class="alert alert-success">OutSource To Vendor...</div>
                </td>
                
                <td>
                  <div v-if="comp.complaint_status != '2'">
                    <button type="button" class="btn btn-success" @click="editProduct(comp)">{{ $t("Edit") }}</button>
                    <button type="button" class="btn btn-primary" @click="reAssign(comp)">{{ $t("Re-Assign") }}</button>
                  </div>                 
                </td>
              </tr>
            </tbody>
          </table>
        </div>


        <div class="form-row mb-2 mt-2" v-if="complaint.part_requests && complaint.part_requests.length > 0">
          <div>
            <h4>Part Requests</h4>
          </div>
          <div class="table-responsive form-group col-12">
            <table class="table table-striped display nowrap text-nowrap w-100">
            <thead>
              <tr>
                <th scope="col">#</th>  
                <th scope="col">{{ $t("Engineer") }}</th>  
                <th scope="col">{{ $t("Engineer Type") }}</th>  
                <th scope="col">{{ $t("Part Request") }}</th>  
                <th scope="col">{{ $t("Request Start Time") }}</th>
                <th scope="col">{{ $t("Request Complete Time") }}</th>  
                <th scope="col">{{ $t("Request Status") }}</th>  
                <th scope="col">{{ $t("Action") }}</th>
              </tr>
            </thead>  
            <tbody>
              <tr
                v-for="(request, key, index) in complaint.part_requests"               
                v-bind:key="index"
              >
                <th scope="col">{{ key+1 }}</th>  
                <td>{{ request.engineer.fullname }}</td>  
                <td>{{ formatEngineerType(request.engineer_type) }}</td>  
                <td>{{ request.request }}</td>  
                <td>{{ request.start_request_time }}</td>  
                <td>{{ request.end_request_time }}</td>  
                <td v-if="request.request_status == 0">
                  <span class="alert alert-danger" >Pending manager side</span>
                </td>
                <td v-else-if="request.request_status == 1 && request.request_to_store[0].status != 2" >
                  <span class="alert alert-danger">Pending store side</span>
                </td>
                <td v-else-if="request.request_status == 2 && request.end_request_time != null && request.request_to_store[0].status != 2">
                  <span class="alert alert-info">Completed</span>
                </td>
                <td v-else-if="request.request_to_store[0].status == 2 && request.request_to_store[0].end_request_time != null">
                  <span class="alert alert-info">Complete <small>(Request to OutSource)</small></span>
                </td>

                <td v-else></td>
                <td>
                  <div v-if="request.request_status == 0 && request.end_request_time == null">
                    <button type="button" class="btn btn-primary" @click="showPartRequestModal(request)">{{ $t("Request Product") }}</button>
                  </div>
                  <div v-else-if="request.request_status == 1 && request.end_request_time == null && request.request_to_store[0].status != 2">
                      <span class="alert alert-danger">Pending...</span>
                  </div>
                  
                  <div v-else-if="request.request_status == 2 && request.request_to_store[0].status != 2">
                      Completed Part Request
                  </div>

                  <!-- <div v-else-if="request.request_to_store[0].status == 2 && request.request_to_store[0].end_request_time != null">
                    <button type="button" class="btn btn-primary" @click="OutSourceProduct(request)">{{ $t("OutSource Product") }}</button>
                  </div> -->


                </td>
              </tr>

            </tbody>
          </table>
          </div>
        </div>
  


        <br>
        <br>
        <div class="table-responsive mb-2" v-if="transactions.length>0">
          <table class="table table-striped display nowrap text-nowrap w-100">
            <thead>
              <tr>
                <th scope="col">#</th>
  
                <th scope="col">{{ $t("Transaction Code") }}</th>
  
                <th scope="col">{{ $t("Transaction Date") }}</th>
  
                <th scope="col">{{ $t("Payment Method") }}</th>
  
                <th scope="col" class="text-right">{{ $t("Amount") }}</th>
  
                <th scope="col" class="text-right">
                  {{ $t("Received Amount") }}
                </th>
  
                <th scope="col">{{ $t("Created On") }}</th>
  
                <th scope="col">{{ $t("Action") }}</th>
              </tr>
            </thead>
  
            <tbody>
              <tr
                v-for="(transaction, key, index) in transactions"
                v-bind:value="transactions.slack"
                v-bind:key="index"
              >
                <th scope="col">{{ key+1 }}</th>
  
                <td>{{ transaction.transaction_code }}</td>
  
                <td>{{ transaction.transaction_date }}</td>
  
                <td>{{ transaction.payment_method }}</td>
  
                <td class="text-right">{{ transaction.amount }}</td>
  
                <td class="text-center">{{ transaction.received_amount }}</td>
  
                <td>{{ transaction.created_at }}</td>
  
                <td>
                  <div class="dropdown" v-show="transaction.detail_link != ''">
                    <button
                      class="btn btn-sm btn-outline-primary dropdown-toggle actions-dropdown-btn"
                      type="button"
                      id="dropdown"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="fas fa-ellipsis-h actions-dropdown"></i>
                    </button>
  
                    <div
                      class="dropdown-menu dropdown-menu-right"
                      aria-labelledby="dropdown"
                    >
                      <a
                        v-bind:href="transaction.detail_link"
                        class="dropdown-item"
                        >{{ $t("View") }}</a
                      >
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
  
        <div v-else>
          <p>No transactions found</p>
        </div>



      </div>
  
      <modalcomponent
        v-if="show_payment_modal"
        v-on:close="show_payment_modal = false"
        :modal_width="'modal-container-md'"
      >
        <template v-slot:modal-header> Record Payment </template>
        <template v-slot:modal-body>
          <div class="col-md-12">
            <!-- <form class="mb-3" v-on:submit="submit_form"> -->
  
            <!-- <p v-html="server_errors" v-bind:class="[error_class]"></p> -->
  
            <div v-if="payment_pending_amount>0">
              <div class="form-row mb-2">
                <div class="form-group col-4">
                  <label for="transaction_date"
                    >{{ $t("Total Amount") }} ({{ currency_codes.store_currency
                    }})</label
                  >
  
                  <div class="text-subtitle">{{ payment_total_amount }}</div>
                </div>
  
                <div class="form-group col-4">
                  <label for="transaction_date"
                    >{{ $t("Total Received Amount") }}
                    ({{ currency_codes.store_currency }})</label
                  >
  
                  <div class="text-subtitle">{{ payment_received_amount }}</div>
                </div>
  
                <div class="form-group col-4">
                  <label for="transaction_date"
                    >{{ $t("Total Pending Amount") }}
                    ({{ currency_codes.store_currency }})</label
                  >
  
                  <div class="text-subtitle">{{ payment_pending_amount }}</div>
                </div>
              </div>
  
              <div class="form-row mb-2">
                <div class="form-group col-md-6">
                  <label for="account">{{ $t("Transaction Type") }}</label>
  
                  <select
                    name="transaction_type"
                    v-model="transaction_type_data"
                    v-validate="'required'"
                    class="form-control form-control-custom custom-select"
                  >
                    <option value="">Choose Transaction Type..</option>
  
                    <option
                      v-for="(transaction_type_item, index) in transaction_type"
                      v-bind:value="transaction_type_item"
                      v-bind:key="index"
                    >
                      {{transaction_type_item }}
                    </option>
                  </select>
  
                  <!-- <span v-bind:class="{ 'error' : errors.has('transaction_type') }">{{ errors.first('transaction_type') }}</span>  -->
                </div>
  
                <div class="form-group col-md-6">
                  <label
                    for="transaction_date"
                    >{{ $t("Transaction Date") }}</label
                  >
  
                  <input
                    type="date"
                    v-model="transaction_date"
                    class="form-control form-control-custom bg-white"
                    ref="transaction_date"
                    name="transaction_date"
                    :placeholder="$t('Please enter transaction date')"
                    autocomplete="off"
                  />
  
                  <span
                    v-bind:class="{ 'error' : errors.has('transaction_date') }"
                    >{{ errors.first('transaction_date') }}</span
                  >
                </div>
              </div>
  
              <div class="form-row mb-2">
                <div class="form-group col-md-6">
                  <label for="payment_method">{{ $t("Payment Method") }}</label>
  
                  <select
                    name="payment_method"
                    v-model="payment_method"
                    v-validate="'required'"
                    class="form-control form-control-custom custom-select"
                  >
                    <option value="">Choose Payment Method..</option>
  
                    <option
                      v-for="(payment_method, index) in payment_methods"
                      v-bind:value="payment_method.slack"
                      v-bind:key="index"
                    >
                      {{ payment_method.label }}
                    </option>
                  </select>
  
                  <span
                    v-bind:class="{ 'error' : errors.has('payment_method') }"
                    >{{ errors.first('payment_method') }}</span
                  >
                </div>
  
                <div class="form-group col-md-6">
                  <label for="account">{{ $t("Account") }}</label>
  
                  <select
                    name="account"
                    v-model="account"
                    v-validate="'required'"
                    class="form-control form-control-custom custom-select"
                  >
                    <option value="">Choose Account..</option>
  
                    <option
                      v-for="(account, index) in accounts"
                      v-bind:value="account.slack"
                      v-bind:key="index"
                    >
                      {{ account.label }} ({{ account.account_type_label }})
                    </option>
                  </select>
  
                  <span
                    v-bind:class="{ 'error' : errors.has('account') }"
                    >{{ errors.first('account') }}</span
                  >
                </div>
              </div>
  
              <div class="form-row mb-2">
                <div class="form-group col-md-6">
                  <label for="amount"
                    >{{ $t("Amount") }} ({{ currency_codes.store_currency
                    }})</label
                  >
  
                  <input
                    type="number"
                    name="amount"
                    v-model="amount"
                    v-validate="`required|decimal|max_value:${payment_pending_amount}`"
                    class="form-control form-control-custom"
                    :placeholder="$t('Please enter the amount')"
                    autocomplete="off"
                    step="0.01"
                    min="0"
                  />
  
                  <span
                    v-bind:class="{ 'error' : errors.has('amount') }"
                    >{{ errors.first('amount') }}</span
                  >
                </div>
              </div>
  
              <div class="form-row mb-2">
                <div class="form-group col-md-12">
                  <label for="notes">{{ $t("Notes") }}</label>
  
                  <textarea
                    name="notes"
                    v-model="notes"
                    v-validate="'max:65535'"
                    class="form-control form-control-custom"
                    rows="3"
                    :placeholder="$t('Enter notes')"
                  ></textarea>
  
                  <span
                    v-bind:class="{ 'error' : errors.has('notes') }"
                    >{{ errors.first('notes') }}</span
                  >
                </div>
              </div>
            </div>
  
            <div v-else>
              <p>You have already made the payment(s).</p>
            </div>
  
            <!-- </form> -->
          </div>
        </template>
        <template v-slot:modal-footer>
          <button type="button" class="btn btn-light" @click="cancel_complaint">
            Cancel
          </button>
  
          <button
            type="button"
            class="btn btn-primary"
            @click="submit_transaction"
          >
            Continue
          </button>
        </template>
      </modalcomponent>
  
      <modalcomponent
        v-if="show_assign_complaint == true"
        v-on:close="show_assign_complaint = false"
        :modal_width="'modal-container-xl'"
      >
        <template v-slot:modal-header>
          Assign Complaint To Available Lab Technician
        </template>
        <template v-slot:modal-body>
          <div>
            <div class="form-row mb-2" v-for="(form, index) in forms" :key="index">
              <div class="form-group col-sm-12 col-md-2">
                <label>{{ $t("Complaint Ticket") }}</label>
                <input type="text" name="complaint_ticket" v-model="form.complaint_ticket" class="form-control form-control-custom" readonly />
              </div>
              <div class="form-group col-sm-12 col-md-2">
                <label>{{ $t("Device Name") }}</label>
                <input type="text" name="device_name" v-model="form.device_name" class="form-control form-control-custom" />
              </div>
              <div class="form-group col-sm-12 col-md-2">
                <label>{{ $t("Make") }}</label>
                <input type="text" name="make" v-model="form.make" class="form-control form-control-custom" />
              </div>
              <div class="form-group col-sm-12 col-md-2">
                <label>{{ $t("Model") }}</label>
                <input type="text" name="model" v-model="form.model" class="form-control form-control-custom" :class="{ 'is-invalid': !form.model && formSubmitted }" />
                <div v-if="!form.model && formSubmitted" class="invalid-feedback">
                  Model is required.
                </div>
              </div>
              <div class="form-group col-sm-12 col-md-2">
                <label>{{ $t("Serial No#") }}</label>
                <input type="text" name="serial_no" v-model="form.serial_no" class="form-control form-control-custom" />
              </div>
              <div class="form-group col-sm-12 col-md-2 mx-auto">
                <label for="labtechnician">{{ $t("Assigned To") }}</label>
                <select v-model="form.labtechnician" name="labtechnician" class="form-control form-control-custom" :class="{ 'is-invalid': !form.labtechnician && formSubmitted }">

                  <option value="" disabled>Choose Lab Technician..</option>
                  <option v-for="(technician, index) in labusers" :value="technician.slack" :key="index">
                    {{ technician.fullname }} - {{ technician.email }} - ({{ technician.assign_complaints_count }})
                  </option>
                </select>
                <div v-if="!form.labtechnician && formSubmitted" class="invalid-feedback">
                  Assigned To Engg Required.
                </div>
              </div>
            </div>
            <button @click="addFormRow" :disabled="isDisabled" class="btn btn-primary">Add More</button>
          </div>
          
        </template>
        <template v-slot:modal-footer>
          <button type="button" class="btn btn-light" @click="cancel_complaint">
            Cancel
          </button>
  
          <button
            type="button"
            class="btn btn-primary"
            @click="assign_complaint_to_labtechnician"
            v-show="show_assign_complaint"
            :disabled="isSubmitDisabled"
          >
            <i
              class="fa fa-circle-notch fa-spin"
              v-if="submit_complaint_technician"
            ></i>
            Continue
          </button>
        </template>
      </modalcomponent>
  
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
        v-if="assign_field_engg == true"
        v-on:close="assign_field_engg = false"
        :modal_width="'modal-container-xl'"
      >
        <template v-slot:modal-header>
          Assign Complaint To Field Lab Technician
        </template>
        <template v-slot:modal-body>
          <div>          
              
              <div class="form-group col-sm-12 col-md-12">
                <label for="field_engg">{{ $t("Assigned To Field Technician") }}</label>
                <select v-model="field_engg" name="field_engg" class="form-control form-control-custom" >

                  <option value="" disabled>Choose Lab Technician..</option>
                  <option v-for="(technician, index) in labusers" :value="technician.slack" :key="index">
                    {{ technician.fullname }} - {{ technician.email }} - ({{ technician.assign_complaints_count }})
                  </option>
                </select>
               
              </div>

              <div class="form-group col-sm-12 col-md-12">
                        <label for="complaint_status">{{ $t("Choose Status") }}</label>
                        <select name="complaint_status" v-model="complaint_status" class="form-control form-control-custom">
                            <option value="" disabled>Select Status...</option>
                            <option value="Complaint Logged">Complaint Logged</option>
                            <option value="Complaint Assigned">Complaint Assigned</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Complete">Complete</option>
                            <option value="Approval Pending">Approval Pending</option>
                            <option value="Not Repairable">Not Repairable</option>
                            <option value="Other">Other</option>                       
                        </select>
                      </div>   

                      <div class="form-group col-sm-12 col-md-12">
                        <label for="service_required">{{ $t("Choose Service Required") }}</label>
                        <select name="service_required" v-model="service_required" class="form-control form-control-custom">
                            <option value="" disabled>Select Service Required...</option>
                            <option value="On-Site">On-Site</option>
                            <option value="Pickup for Workshop">Pickup for Workshop</option>
                            <option value="Deliver by Customer">Deliver by Customer</option>                       
                        </select>
                        
                    </div>
                    <div class="form-group col-sm-12 col-md-12">
                        <label for="mode_of_complaint">{{ $t("Mode of Complaint") }}</label>
                        <select name="mode_of_complaint" v-model="mode_of_complaint" class="form-control form-control-custom">
                            <option value="" disabled selected>Select Mode of Complaint...</option>
                            <option value="Phone Call">Phone Call</option>
                            <option value="Whatsapp">Whatsapp</option>
                            <option value="Email">Email</option>
                            <option value="Others">Others</option>                           
                        </select>                        
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
            @click="assign_complaint_to_fieldtechnician"
          >            
            Continue
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
        v-if="assign_required_product == true"
        v-on:close="assign_required_product = false"
        :modal_width="'modal-container-xl'"
      >
        <template v-slot:modal-header> Add Require Products </template>
        <template v-slot:modal-body>
        <div class="form-row mb-2">
            <div class="form-group col-sm-12 col-md-6">
              <select class="form-control form-control-custom">
                <option value="" disabled selected>Select Type...</option>
              </select>
            </div>
        </div>
          <div class="form-row mb-2">
            <div class="form-group col-sm-12 col-md-6">
              <select
                name="category"
                class="form-control form-control-custom"
                v-model="category"
                @change="fetchCategoryProduct"
                placeholder="Choose Category.."
              >
                <option value="" disabled selected>Choose Category..</option>
  
                <option
                  v-for="(category, index) in categories"
                  :value="category.slack"
                  placeholder="Choose Category..."
                  :key="index"
                >
                  {{ category.label }} - {{ category.category_code }}
                </option>
              </select>
            </div>
  
            <div class="form-group col-sm-12 col-md-6">
              <select
                name="scategory"
                class="form-control form-control-custom"
                v-model="s_category"
                @change="fetchSubCategoryProduct"
                placeholder="Choose Sub Category.."
              >
                <option value="" disabled selected>Choose Sub Category..</option>
  
                <option
                  v-for="(scategory, index) in scategories"
                  :value="scategory.id"
                  placeholder="Choose Sub Category..."
                  :key="index"
                >
                  {{ scategory.sub_category_name }}
                </option>
              </select>
            </div>
  
            <div
              class="form-group col-sm-12 col-md-12 mx-auto"
              v-if="products.length > 0"
            >
              <table class="table">
                <tr>
                  <th>Product Code</th>
  
                  <th>Product Name</th>
  
                  <th>Product Category</th>
  
                  <th>Product Sub-Category</th>
  
                  <th>Assign</th>
                </tr>
  
                <tr v-for="(product, index) in products" :key="index">
                  <td>{{ product.product_code }}</td>
  
                  <th>{{ product.name }}</th>
  
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
  
            <div class="form-group col-sm-12 col-md-12 mx-auto">
              <label for="extend_date">{{ $t("Extend Date") }}</label>
  
              <input
                type="date"
                name="extend_date"
                v-model="extend_date"
                class="form-control form-control-custom"
                rows="5"
                :placeholder="$t('Extend date')"
              />
            </div>
  
            <div class="form-group col-sm-12 col-md-12 mx-auto">
              <label for="admin_again_remark">{{ $t("Add Remark") }}</label>
  
              <textarea
                name="admin_again_remark"
                v-model="admin_again_remark"
                v-validate="'required|max:65535'"
                class="form-control form-control-custom"
                rows="5"
                :placeholder="$t('Enter Remark')"
              ></textarea>
  
              <span v-bind:class="{ error: errors.has('admin_again_remark') }">{{
      
                              errors.first("admin_again_remark")
  
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
  
      <modalcomponent
        v-if="complaint_invoice == true"
        v-on:close="complaint_invoice = false"
        :modal_width="'modal-container-xl'"
      >
        <template v-slot:modal-header> Make Complaint Invoice </template>
        <template v-slot:modal-body>
          <div
            class="form-group col-sm-12 col-md-12 mx-auto"
            v-if="ComplaintProducts.length > 0"
          >
            <h5>Assign Products</h5>
  
            <table class="table">
              <tr v-for="(product, index) in ComplaintProducts" :key="index">
                <td>{{ product.product_code }}</td>
  
                <td>{{ product.name }}</td>
  
                <th>
                  {{ product.subcategory.category.label }}
                  ({{product.subcategory.category.category_code }})
                </th>
  
                <th>{{ product.subcategory.sub_category_name }}</th>
  
                <td>
                  {{ product.sale_amount_including_tax }}
                </td>
              </tr>
            </table>
          </div>
  
          <div class="form-group col-sm-12 col-md-12 mx-auto">
            <h5>Other Charges</h5>
  
            <div v-for="(charge, index) in charges" :key="index">
              <div class="form-row mt-2">
                <div class="form-group col-sm-6 col-md-6 mx-auto">
                  <label for="charge_label">{{ $t("Add Charge Label") }}</label>
  
                  <input
                    type="text"
                    name="charge_label"
                    class="form-control form-control-custom"
                    v-model="charge_label[index]"
                  />
                </div>
  
                <div class="form-group col-sm-6 col-md-6 mx-auto">
                  <label for="charge_price">{{ $t("Add Charge Price") }}</label>
  
                  <input
                    type="number"
                    name="charge_price"
                    class="form-control form-control-custom"
                    v-model="charge_price[index]"
                  />
                </div>
              </div>
            </div>
  
            <div class="d-flex justify-content-end">
              <button
                @click="addCharge"
                v-if="charges.length < 10"
                class="btn btn-primary"
              >
                Add Another Charge
              </button>
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
            @click="complaint_invoice_make"
          >
            Complaint Invoice
          </button>
        </template>
      </modalcomponent>
  
      <modalcomponent
        v-if="complaint_status_modal"
        v-on:close="complaint_status_modal = false"
        :modal_width="'modal-container-xl'"
      >
        <template v-slot:modal-header>
          {{ $t("Add Complaint Status") }}
        </template>
        <template v-slot:modal-body>
          <div class="form-row mb-2">
            <div class="form-group col-md-4">
              <label for="billable">{{ $t("BILLABLE") }}</label>
  
              <select
                name="billable"
                v-model="billable"
                v-validate="'required'"
                class="form-control form-control-custom custom-select"
              >
                <option value="" disabled>Choose Billable..</option>
  
                <option value="Yes">Yes</option>
  
                <option value="No">No</option>
              </select>
  
              <span
                v-bind:class="{ 'error' : errors.has('billable') }"
                >{{ errors.first('billable') }}</span
              >
            </div>
  
            <div class="form-group col-md-4">
              <label for="complaint_status">{{ $t("Complaint Status") }}</label>
  
              <select
                name="complaint_status"
                v-model="complaint_status"
                v-validate="'required'"
                class="form-control form-control-custom custom-select"
              >
                <option value="" disabled>Choose Complaint Status..</option>  
                <option value="Equipment">Equipment</option>  
                <option value="Remove for Workshop">Remove for Workshop</option>  
                <option value="Backup">Backup</option>  
                <option value="Repaired reinstalled">Repaired reinstalled</option>
                <option value="Not Repairable">Not Repairable</option>
                <option value="Replacement Required">Replacement Required</option>
              </select>
  
              <span
                v-bind:class="{ 'error' : errors.has('complaint_status') }"
                >{{ errors.first('complaint_status') }}</span
              >
            </div>


            <div class="form-group col-md-4">
              <label for="c_status">{{ $t("Complaint Customer Status") }}</label>  
              <select
                name="c_status"
                v-model="c_status"
                class="form-control form-control-custom custom-select"
              >
                <option value="" disabled>Choose Complaint Customer Status..</option>  
                <option value="Complaint Logged">Complaint Logged</option>
                <option value="Complaint Assigned">Complaint Assigned</option>
                <option value="In Progress">In Progress</option>
                <option value="Complaint Complete">Complaint Complete</option>
                <option value="Approval Pending">Approval Pending</option>
                <option value="Not Repairable">Not Repairable</option>                           
              </select>              
            </div>

            <div class="form-group col-md-4">
              <label for="status">{{ $t("Status") }}</label>  
              <select
                name="status"
                v-model="status"
                class="form-control form-control-custom custom-select"
              >
                <option value="" disabled>Choose Status..</option>  
                <option value="Ready">Ready</option>
                <option value="Engineer">Engineer</option>
                <option value="Delivered">Delivered</option>                        
              </select>              
            </div>
  
            <div class="form-group col-md-4">
              <label for="type_of_service">{{ $t("Type of Services") }}</label>
  
              <select
                name="type_of_service"
                v-model="type_of_service"
                v-validate="'required'"
                class="form-control form-control-custom custom-select"
              >
                <option value="" disabled>Choose Type of Services..</option>
  
                <option value="Warranty">Warranty</option>
                <option value="With Parts">SLA With Parts</option>
                <option value="Without Parts">SLA Without Parts</option>
                <option value="Per Call">Per Call</option>
                <option value="OAK Stock">OAK Stock</option>
  
  
  
              </select>
  
              <span
                v-bind:class="{ 'error' : errors.has('type_of_service') }"
                >{{ errors.first('type_of_service') }}</span
              >
            </div>
  
            <div class="form-group col-md-4">
              <label for="complaint_ok">{{ $t("Complaint Ok") }}</label>
  
              <select
                name="complaint_ok"
                v-model="complaint_ok"
                v-validate="'required'"
                class="form-control form-control-custom custom-select"
              >
                <option value="" disabled>Choose complaint_ok..</option>
  
                <option value="Yes">Yes</option>
  
                <option value="No">No</option>
              </select>
  
              <span
                v-bind:class="{ 'error' : errors.has('complaint_ok') }"
                >{{ errors.first('complaint_ok') }}</span
              >
            </div>
  
            <div class="form-group col-md-4">
              <label
                for="picked_for_workshop"
                >{{ $t("Picked for Workshop") }}</label
              >
  
              <select
                name="picked_for_workshop"
                v-model="picked_for_workshop"
                v-validate="'required'"
                class="form-control form-control-custom custom-select"
              >
                <option value="" disabled>Choose picked_for_workshop..</option>
  
                <option value="Yes">Yes</option>
  
                <option value="No">No</option>
              </select>
  
              <span
                v-bind:class="{ 'error' : errors.has('picked_for_workshop') }"
                >{{ errors.first('picked_for_workshop') }}</span
              >
            </div>


            <div class="form-group col-md-4">
              <label
                for="equipment_s_no"
                >{{ $t("Equipment S.No") }}</label
              >
  
              <input
                name="equipment_s_no"
                v-model="equipment_s_no"
                class="form-control form-control-custom"
              />
            </div>

            <div class="form-group col-md-4">
              <label
                for="equipment_specs"
                >{{ $t("Equipment Specs") }}</label
              >
  
              <input
                name="equipment_specs"
                v-model="equipment_specs"
                class="form-control form-control-custom"
              />
            </div>

            <div class="form-group col-md-4">
              <label
                for="accessories"
                >{{ $t("Accessories") }}</label
              >  
              <input
                name="accessories"
                v-model="accessories"
                class="form-control form-control-custom"
              />
            </div>

            <div class="form-group col-md-4">
              <label
                for="Invoice_number"
                >{{ $t("Invoice Number") }} <small>(In Case of Warranty)</small></label
              >  
              <input
                name="Invoice_number"
                v-model="Invoice_number"
                class="form-control form-control-custom"
              />
            </div>

            <div class="form-group col-md-4">
              <label
                for="po_number"
                >{{ $t("PO Number") }} <small>(In Case of Warranty)</small></label
              >  
              <input
                name="po_number"
                v-model="po_number"
                class="form-control form-control-custom"
              />
            </div>

            <div class="form-group col-md-4">
              <label
                for="condition"
                >{{ $t("Condition") }}</label
              >
  
              <select
                name="condition"
                v-model="condition"
                class="form-control form-control-custom custom-select"
              >
                <option value="" disabled>Choose Condition..</option>  
                <option value="Good Condition">Good Condition</option>  
                <option value="Normal Condition">Normal Condition</option>
                <option value="Damaged Condition">Damaged Condition</option>
              </select>
            </div>

            <div class="form-group col-md-4">
              <label
                for="equipment_part_serial_number"
                >{{ $t("Equipment Part") }} <small>(Serial Number)</small></label
              >  
              <input
                name="equipment_part_serial_number"
                v-model="equipment_part_serial_number"
                class="form-control form-control-custom"
              />
            </div>

            <div class="form-group col-md-4">
              <label
                for="outsource_date"
                >{{ $t("OutSource Date") }} </label
              >  
              <input
                type="date"
                name="outsource_date"
                v-model="outsource_date"
                class="form-control form-control-custom"
              />
            </div>
            <div class="form-group col-md-4">
              <label
                for="return_date"
                >{{ $t("Return Date") }} </label
              >  
              <input
                type="date"
                name="return_date"
                v-model="return_date"
                class="form-control form-control-custom"
              />
            </div>

            <div class="form-group col-md-4">
              <label
                for="delivery_date"
                >{{ $t("Delivery Date") }} </label
              >  
              <input
                type="date"
                name="delivery_date"
                v-model="delivery_date"
                class="form-control form-control-custom"
              />
            </div>

            <div class="form-group col-md-8">
              <label
                for="fault_report_by_customer"
                >{{ $t("Fault Report By Customer") }} </label
              >  
              <textarea
                name="fault_report_by_customer"
                v-model="fault_report_by_customer"
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
            @click="submit_complaint_status()"
          >
            Continue
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

            <div class="form-group col-md-4">
              <label for="outsource_item">{{ $t("OutSource Item") }}</label>  
              <select
                name="outsource_item"
                v-model="outsource_item"
                class="form-control form-control-custom custom-select"
              >
                <option value="" disabled>Choose Out-Source..</option>  
                <option v-for="(item, index) in out_source_items" :value="item" :key="index">{{ item }}</option>
              </select>
            </div>

            <div class="form-group col-md-4">
              <label
                for="ready_date"
                >{{ $t("Ready Date") }}</label
              >
  
              <input
                type="date"
                name="ready_date"
                v-model="ready_date"
                class="form-control form-control-custom"
              />
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
            @click="submit_complaint_remarks()"
          >
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

      <modalcomponent
        v-if="out_source_product_model"
        v-on:close="out_source_product_model = false"
        :modal_width="'modal-container-xl'"
      >
        <template v-slot:modal-header>
          {{ $t("OutSource Product") }}
        </template>
        <template v-slot:modal-body>
          <div class="form-row mb-2">
            <input type="hidden" name="request_id" v-model="request_id" />
            <input type="hidden" name="engineer_id" v-model="engineer_id" />
            <input type="hidden" name="complaint_id" v-model="complaint_id" />
            <input type="hidden" name="product_on_request_id" v-model="product_on_request_id" />
            <input type="hidden" name="request_to_store_id" v-model="request_to_store_id" />
            <input type="hidden" name="request_detail" v-model="request_detail" />
            <div class="form-group col-md-12">
              <input name="request_text" class="form-control" v-model="request_text" readonly />
            </div>
            <div class="form-group col-md-12">
              <label
                for="product_details"
                >{{ $t("OutSource Product Details") }} </label
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
            @click="submit_out_source_product()"
          >
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
            <input type="hidden" name="engineer_id" v-model="engineer_id" />
            <input type="hidden" name="complaint_id" v-model="complaint_id" />
            <input type="hidden" name="assign_complaint_lab_eng" v-model="assign_complaint_lab_eng" />

            <div class="form-group col-12">
              <label for="out_source_vendor">{{ $t("Out Source Vendor") }}</label>
              <select
                    name="transaction_type"
                    v-model="out_source_vendor"
                    v-validate="'required'"
                    class="form-control form-control-custom custom-select"
                  >
                    <option value="">Choose OutSource Vendor..</option>
  
                    <option
                      v-for="(vendor, index) in out_source_vendors"
                      v-bind:value="vendor.id"
                      v-bind:key="index"
                    >
                      {{vendor.fullname }} ({{ vendor.email }})
                    </option>
                  </select>
  
            </div>
           
            <div class="form-group col-md-12">
              <label
                for="product_details"
                >{{ $t("OutSource Product Details") }} </label
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
            @click="submit_out_source_complaint()"
          >
            Continue
          </button>
        </template>
      </modalcomponent>



      <modalcomponent
        v-if="edit_complaint_product"
        v-on:close="edit_complaint_product = false"
        :modal_width="'modal-container-xl'"
      >
        <template v-slot:modal-header>
          {{ $t("Edit Complaint Product") }}
        </template>
        <template v-slot:modal-body>
          <div class="form-row mb-2">
            <input type="hidden" name="complaint_product_id" v-model="complaint_product_id" />

            <div class="form-group col-12">
              <label for="complaint_product_name">{{ $t("Product Name") }}</label>
              <input
                  type="text"
                    name="complaint_product_name"
                    v-model="complaint_product_name"
                    v-validate="'required'"
                    class="form-control form-control-custom"
                  >
            </div>

            <div class="form-group col-12">
              <label for="complaint_product_name">{{ $t("Product Make") }}</label>
              <input
                  type="text"
                    name="complaint_product_make"
                    v-model="complaint_product_make"
                    v-validate="'required'"
                    class="form-control form-control-custom"
                  >
            </div>

            <div class="form-group col-12">
              <label for="complaint_product_model">{{ $t("Product Model") }}</label>
              <input
                    type="text"
                    name="complaint_product_model"
                    v-model="complaint_product_model"
                    v-validate="'required'"
                    class="form-control form-control-custom"
                  >
            </div>

            <div class="form-group col-12">
              <label for="complaint_product_serial_no">{{ $t("Product Serial No") }}</label>
              <input
                    type="text"
                    name="complaint_product_serial_no"
                    v-model="complaint_product_serial_no"
                    v-validate="'required'"
                    class="form-control form-control-custom"
                  >
            </div>
           
            
          </div>
        </template>
        <template v-slot:modal-footer>
          <button
            type="submit"
            class="btn btn-primary"
            @click="submit_complaint_product()"
             v-bind:disabled="processing == true"
          >
          <i class="fa fa-circle-notch fa-spin" v-if="processing == true"></i>

            Continue
          </button>
        </template>
      </modalcomponent>


      <modalcomponent
        v-if="re_assign_complaint_product"
        v-on:close="re_assign_complaint_product = false"
        :modal_width="'modal-container-xl'"
      >
        <template v-slot:modal-header>
          {{ $t("Re Assign Complaint Product") }}
        </template>
        <template v-slot:modal-body>
          <div class="form-row mb-2">
            <input type="hidden" name="re_assign_complaint_product_id" v-model="re_assign_complaint_product_id" />

            <div class="form-group col-12">
              <label for="select_complaint_product">{{ $t("Select Complaint") }}</label>
              <select
                 
                    name="select_complaint_product"
                    v-model="select_complaint_product"
                    v-validate="'required'"
                    class="form-control form-control-custom"
                  >
                  <option selected disabled>Choose Complaint..</option>
  
                <option
                  v-for="(re_assign_complaint, index) in re_assign_complaints"
                  v-bind:value="re_assign_complaint.slack"
                  v-bind:key="index"
                >
                  {{re_assign_complaint.ticket }}
                </option>
                  
            </select>  
            </div>

          
           
            
          </div>
        </template>
        <template v-slot:modal-footer>
          <button
            type="submit"
            class="btn btn-primary"
            @click="submit_re_assgin_complaint_product()"
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
            forms: [
        {
          complaint_ticket: (this.complaint.ticket) ? this.complaint.ticket : '',
          device_name: '',
          make: '',
          model: '',
          serial_no: '',
          labtechnician: ''
        },],




              field_engg: '',
              complaint_status: '',
              service_required: '',
              mode_of_complaint: '',

              complaint_ticket: (this.complaint.ticket) ? this.complaint.ticket : '',
              no_of_devices: (this.complaint.no_of_devices) ? this.complaint.no_of_devices : '',
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
              request_part_store: false,
              out_source_product_model: false,
              add_remark_modal: false,
              delete_processing: false,
              show_payment_modal: false,
              show_modal: false,
              show_assign_complaint: false,
              out_source_complaint: false,
              edit_complaint_product: false,
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

              out_source_complaint: '',
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
              formSubmitted: false,
              assign_field_engg: false,

              complaint_product_id: '',
              complaint_product_name: '',
              complaint_product_model: '',
              complaint_product_serial_no: '',
              complaint_product_make: '',
              select_complaint_product: '',
              re_assign_complaint_product_id: '',
              re_assign_complaint_product: false,
              isReadonly: true,
              previousValue: (this.complaint.complaint_assign_to_lab_enggs) ? this.complaint.complaint_assign_to_lab_enggs.length : 0,
          }
      },
      props: {
          labusers: Array,
          complaint: Array,
          assign_access: Boolean,
          requirement_request_access: Boolean,
          Customer_complaint_make_invoice: Boolean,
          delete_access: Boolean,
          is_lab_tech: Boolean,
          out_source_items: [Array, Object],
          is_customer: Boolean,
          out_source_vendors: [Array, Object],
          re_assign_complaints: [Array, Object]
      },
      mounted() {
          console.log('Category detail page loaded');
          event_bus.$on('cancel_complaint', this.cancel_complaint);
          this.fetchCategorySubcategoryMounted();
          this.fetchComplaintRecord();
      },
      computed: {
        isDisabled() {
          return this.forms.length >= this.no_of_devices;
        },
        isSubmitDisabled() {
          return !this.forms.every(form => form.model && form.labtechnician);
        }
      },
      methods: {
        toggleEdit() {
          if (this.isReadonly) {
            this.isReadonly = false;
            this.$nextTick(() => {
              this.$refs.noOfDevicesInput.focus();
            });
          } else {
            this.isReadonly = true;
            var formData = new FormData();
            formData.append("access_token", window.settings.access_token);
            formData.append("complaint_slack", this.complaint_slack);
            formData.append("no_of_devices", this.no_of_devices);

            console.log(...formData);

            axios.post('/api/update_no_of_devices', formData)
                  .then((response) => {
                      if (response.status == 200) {
                        
                          this.show_response_message(response.data.msg, 'Success');
                          location.reload();
                      } else {
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
                      if (error.response && error.response.status === 400) {
                          this.show_errors_response_message(error.response.data.msg, 'Error');
                      } else {
                          alert('Please fill all fields');
                      }
                  });
          }
        },
        updateNoOfDevices(event) {
          const value = event.target.value;

          // Prevent "e" or any non-numeric input
          if (isNaN(value) || value.includes('e')) {
            event.target.value = this.complaint.no_of_devices; // Revert to previous value
            return;
          }

          // Convert value to a number and check against previous value
          const numericValue = Number(value);
          if (numericValue < this.previousValue) {
            event.target.value = this.no_of_devices; // Revert to previous value
          } else {
            this.no_of_devices = numericValue;
          }
        },
        reAssign(product){
          this.re_assign_complaint_product_id = product.id
          this.re_assign_complaint_product = true;
        },
        editProduct(product){
          
          this.complaint_product_id = product.id;
          this.complaint_product_name = product.product_name;
          this.complaint_product_make = product.make;
          this.complaint_product_model = product.model;
          this.complaint_product_serial_no = product.serial_no;
          this.edit_complaint_product = true;
        },
        addFormRow() {
          if (this.forms.length < this.no_of_devices - this.previousValue) {
            this.forms.push({
              complaint_ticket: this.complaint_ticket,
              device_name: '',
              make: '',
              model: '',
              serial_no: '',
              labtechnician: ''
            });
          }
        },
        formatEngineerType(engineerType) {
          return engineerType.replace(/_/g, ' ');
        },
        showPartRequestModal(request){    
          this.request_id = request.id,     
          this.engineer_id = request.engineer_id;
          this.complaint_id = request.complaint_id;
          this.request_detail = request.request;
          this.request_text = 'Part Request for: ' + request.request;
          this.request_part_store = true;
        },
        OutSourceProduct(request){
          
          this.request_id = request.id,     
          this.engineer_id = request.engineer_id;
          this.complaint_id = request.complaint_id;
          this.request_to_store_id = request.request_to_store[0].id;
          this.product_on_request_id = request.request_to_store[0].store_assign_products_on_reqeusts[0].id;
          this.request_detail = request.request;
          this.request_text = 'Engineer Request for: ' + request.request;
          this.out_source_product_model = true;
        },
        submit_re_assgin_complaint_product(){
          var formData = new FormData();
          formData.append("access_token", window.settings.access_token);
          formData.append("re_assign_complaint_product_id", this.re_assign_complaint_product_id);
          formData.append("select_complaint_product", this.select_complaint_product);

          axios.post('/api/re_assign_complaint_product', formData)
                .then((response) => {
                    if (response.status == 200) {
                      
                        this.show_response_message(response.data.msg, 'Success');
                        location.reload();
                    } else {
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
                    if (error.response && error.response.status === 400) {
                        this.show_errors_response_message(error.response.data.msg, 'Error');
                    } else {
                        alert('Please fill all fields');
                    }
                });

        },
        submit_complaint_product() {
          this.processing = true;
            var formData = new FormData();
            formData.append("access_token", window.settings.access_token);
            formData.append("complaint_product_id", this.complaint_product_id);
            formData.append('complaint_product_name', this.complaint_product_name);
            formData.append('complaint_product_make', this.complaint_product_make);
            formData.append('complaint_product_model', this.complaint_product_model);
            formData.append('complaint_product_serial_no', this.complaint_product_serial_no);

            axios.post('/api/edit_complaint_product', formData)
                .then((response) => {
                    if (response.status == 200) {
                      
                        this.show_response_message(response.data.msg, 'Success');
                        location.reload();
                    } else {
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
                    if (error.response && error.response.status === 400) {
                        this.show_errors_response_message(error.response.data.msg, 'Error');
                    } else {
                        alert('Please fill all fields');
                    }
                });
        },

        submit_out_source_product(){
          var formData = new FormData();
          this.processing = true;
          formData.append("access_token", window.settings.access_token);
          formData.append('request_id', this.request_id);
          formData.append('engineer_id', this.engineer_id);
          formData.append('complaint_id', this.complaint_id);
          formData.append('product_on_request_id', this.product_on_request_id);
          formData.append('request_to_store_id', this.request_to_store_id);
          formData.append('request_detail', this.request_detail);
          formData.append('product_details', this.product_details);

          axios.post('/api/add_out_source_product', formData).then((response) => {
  
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
        submit_out_source_complaint(){
          var formData = new FormData();
          this.processing = true;
          formData.append("access_token", window.settings.access_token);
          formData.append('engineer_id', this.engineer_id);
          formData.append('complaint_id', this.complaint_id);
          formData.append('out_source_vendor', this.out_source_vendor);
          formData.append('product_details', this.product_details);
          formData.append('assign_complaint_lab_eng', this.assign_complaint_lab_eng);

          
          axios.post('/api/add_out_source_complaint', formData).then((response) => {
  
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
        submit_request_to_store(){
          this.processing = true;
          var formData = new FormData();
          formData.append("access_token", window.settings.access_token);
          formData.append('request_id', this.request_id);
          formData.append('engineer_id', this.engineer_id);
          formData.append('complaint_id', this.complaint_id);
          formData.append('request_detail', this.request_detail);
          formData.append('product_details', this.product_details);
          axios.post('/api/add_request_product_store', formData).then((response) => {  
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
            var formData = new FormData();
            formData.append("access_token", window.settings.access_token);
            formData.append('complaint_slack', this.complaint_slack);
            formData.append('parts_required', this.parts_required);
            formData.append('outsource', this.outsource);
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
                    this.formSubmitted = true;
                      if (this.isSubmitDisabled) {
                        alert('Please fill all required fields.');
                        return;
                      }
                    this.show_modal = true;
  
                      this.$on("submit", function() {
                          this.processing = true;
                          this.delete_processing = true;
  
                          var formData = new FormData();
                          formData.append("access_token", window.settings.access_token);
                          formData.append('complaint_slack', this.complaint_slack);
                          formData.append('details', JSON.stringify(this.forms));
  
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

              if(this.no_of_devices > this.previousValue){
                this.show_assign_complaint = true;
              }
              else{
                this.show_errors_response_message('To Add Product Please Increase No of Devices First.', 'Error');
              }
              

          },
          assign_to_field_Engg(){
            this.assign_field_engg = true;
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
            this.engineer_id = request.engg_id;
            this.complaint_id = request.complaint_id;
            this.assign_complaint_lab_eng = request.id
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
                  // this.processing = true;
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
          },
          assign_complaint_to_fieldtechnician() {
           
                
                    
                        this.processing = true;
                        const formData = new FormData();
                        formData.append("access_token", window.settings.access_token);
                        formData.append('complaint_slack', this.complaint_slack);
                        formData.append("service_required", this.service_required);
                        formData.append("assigned_to_field_enng", this.field_engg);
                        formData.append("complaint_status", this.complaint_status);
                        formData.append('mode_of_complaint', this.mode_of_complaint);
                        // formData.append("customer_feedback", this.customer_feedback);
                        console.log(...formData);
                        axios
                            .post('/api/complaint_assign_to_field_engg', formData)
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
                   
                
        },

      }
  }
  </script>

  
  