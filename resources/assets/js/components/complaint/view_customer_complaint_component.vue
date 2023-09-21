<template>
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex flex-wrap mb-4">
                <div class="mr-auto">
                   <div class="d-flex">
                        <div>
                            <span class="text-title"> <span class='text-muted'>{{ $t("Complaint") }}</span> </span>
                        </div>
                    </div>
                </div>
                <div class="">
                    <span></span>
                </div>
            </div>
            
            <div class="d-flex flex-wrap mb-4">
                <p v-html="server_errors" v-bind:class="[error_class]"></p>                
                <div class="ml-auto d-flex">
                    <div v-if="assign_access">
                        <button type="submit" class="btn btn-success mr-1" v-if="complaint.assign_to_lab_staff_id == null" v-on:click="assigncomplaint_to_labtachnician()" v-bind:disabled="assign_processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="assign_processing == true"></i> {{ $t("Assin Complaint") }}</button>
                    </div>
                    <div>
                    <button type="submit" class="alert alert-success mr-1" v-if="complaint.assign_to_lab_staff_id != null"> {{ $t("Complaint Assigned") }}</button>
                    </div>
                    <div>
                    <button type="submit" class="btn btn-success mr-1" v-if="complaint.assign_to_lab_staff_id != null" v-on:click="request_for_product()"> {{ $t("Add Required Product") }}</button>
                    </div>
                    <div v-if="delete_access">
                        <button type="submit" class="btn btn-danger mr-1" v-if="delete_access == true" v-on:click="delete_category()" v-bind:disabled="delete_processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="delete_processing == true"></i> {{ $t("Delete Complaint") }}</button>
                    </div>
                </div>
            </div>
            <hr>
            <div class="mb-2">
                <span class="text-subhead">{{ $t("Basic Information") }}</span>
            </div>
            <div class="form-row mb-2">
                <div class="form-group col-md-3">
                    <label for="category_code">{{ $t("Complaint Code") }}</label>
                    <p>{{ complaint.complaint_ref }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="label">{{ $t("Order#") }}</label>
                    <p>Order#{{ complaint.order.order_number }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="label">{{ $t("Product Name") }}</label>
                    <p>{{ complaint.product.name }} ({{ complaint.product.product_code }})</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="label">{{ $t("Customer Name") }}</label>
                    <p>{{ complaint.customer.name }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="label">{{ $t("Complaint Status") }}</label>
                    <p class="alert alert-success w-50">{{ complaint.complaint_status }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="created_by">{{ $t("Assign to LabTechnician") }}</label>
                    <p>{{ (complaint.assign_to_lab_staff_id) ? complaint.user.fullname  : '-' }}</p>
                </div>
                <div class="form-group col-md-3 " v-if="complaint.due_date">
                    <label for="created_by">{{ $t("due Date") }}</label>
                    <p class="alert alert-danger w-50">{{ (complaint.due_date) ? complaint.due_date : '-' }}</p>
                </div>    
                <div class="form-group col-md-3" v-if="complaint.admin_remark">
                    <label for="created_by">{{ $t("Manager Remark to Lab Technician") }}</label>
                    <p>{{ (complaint.admin_remark) ? complaint.admin_remark : '-' }}</p>
                </div>                
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label for="description">{{ $t("Description") }}</label>
                    <p>{{ (complaint.description) ? complaint.description : '-' }}</p>
                </div>
            </div>

        </div>

        <modalcomponent v-if="show_assign_complaint == true" v-on:close="show_assign_complaint = false" :modal_width="'modal-container-md'">
            <template v-slot:modal-header>
                Assign Complaint To Available Lab Technician
            </template>
            <template v-slot:modal-body>
                <div class="form-row mb-2">
                    <div class="form-group col-sm-12 col-md-10 mx-auto">
                    <label for="labtechnician">{{ $t("Choose Available Lab Technician") }}</label>
                    <select v-model="labtechnician" name="labtechnician" v-validate="'required'"
                        class="form-control form-control-custom" placeholder="Choose Customers..">
                        <option value="" disabled>Choose Lab Technician..</option>
                        <option v-for="(technician, index) in labusers" v-bind:value="technician.slack"
                            placeholder="Choose Customers.." v-bind:key="index">
                            {{ technician.fullname }} - {{ technician.email }} - ({{ technician.assign_complaints_count }})
                        </option>
                    </select>
                    <span v-bind:class="{ 'error': errors.has('labtechnician') }">{{ errors.first('labtechnician')
                    }}</span>
                </div>
                <div class="form-group col-sm-12 col-md-10 mx-auto">
                    <label for="due_date">{{ $t("Due Date") }}</label>
                    <input type="date" name="due_date" v-model="due_date" v-validate="'required'"
                        class="form-control form-control-custom" rows="5" :placeholder="$t('Enter Complaint Reference')" />
                    <span v-bind:class="{ error: errors.has('due_date') }">{{
                        errors.first("due_date")
                    }}</span>
                </div>
                <div class="form-group col-sm-12 col-md-10 mx-auto">
                    <label for="name">{{ $t("Admin Remark") }}</label>
                    <textarea name="admin_remark" v-model="admin_remark" v-validate="'required|max:65535'"
                        class="form-control form-control-custom" rows="5"
                        :placeholder="$t('Enter Remark')"></textarea>

                    <span v-bind:class="{ error: errors.has('admin_remark') }">{{
                        errors.first("admin_remark")
                    }}</span>
                    
                </div>

                </div>
            </template>
            <template v-slot:modal-footer>
                <button type="button" class="btn btn-light" @click="cancel_complaint">Cancel</button>
                <button type="button" class="btn btn-primary" @click="assign_complaint_to_labtechnician" v-show="show_assign_complaint" > <i class='fa fa-circle-notch fa-spin' v-if="submit_complaint_technician"></i> Continue</button>
            </template>
        </modalcomponent>


        <modalcomponent v-if="required_product == true" v-on:close="required_product = false" :modal_width="'modal-container-md'">
            <template v-slot:modal-header>
                Add Request For Required Product
            </template>
            <template v-slot:modal-body>
                <div class="form-row mb-2">
                                 
                <div class="form-group col-sm-12 col-md-10 mx-auto">
                    <label for="lab_staff_remark">{{ $t("Add Request") }}</label>
                    <textarea name="lab_staff_remark" v-model="lab_staff_remark" v-validate="'required|max:65535'"
                        class="form-control form-control-custom" rows="5"
                        :placeholder="$t('Enter Remark')"></textarea>

                    <span v-bind:class="{ error: errors.has('lab_staff_remark') }">{{
                        errors.first("lab_staff_remark")
                    }}</span>
                    
                </div>

                </div>
            </template>
            <template v-slot:modal-footer>
                <button type="button" class="btn btn-light" @click="cancel_complaint">Cancel</button>
                <button type="button" class="btn btn-primary" @click="requested_for_required_product" > Requested</button>
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
                <button type="button" class="btn btn-light" @click="$emit('close')">Cancel</button>
                <button type="button" class="btn btn-primary" @click="$emit('submit')" v-bind:disabled="processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="processing == true"></i> Continue</button>
            </template>
        </modalcomponent>
        
    </div>
</template>  

<script>
    'use strict';
    import {event_bus} from '../../event_bus.js';
    export default {
        data(){
            return{
                processing: false,
                delete_processing: false,
                show_modal: false,
                show_assign_complaint:false,
                delete_access:true,
                assign_processing:false,
                required_product:false,
                server_errors:'',
                submit_complaint_technician:false,
                labtechnician: '',
                due_date: '',
                admin_remark: '',
                lab_staff_remark: '',
                complaint_slack:this.complaint.slack,
                delete_category_api_link: '/api/delete_complaint/'+ this.complaint.slack,
            }
        },
        props: {
            labusers:Array,            
            complaint: Array,
            assign_access: Boolean,
            delete_access: Boolean,
        },
        mounted() {
            console.log('Category detail page loaded');
            event_bus.$on('cancel_complaint', this.cancel_complaint);
        },
        methods: {
            assign_complaint_to_labtechnician(){
                this.$validator.validateAll().then((result) => {
                if (result) {
                this.$off("submit");
                this.$off("close");
                this.show_modal = true;

                this.$on("submit",function () {       
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

                        if(response.data.status_code == 200) {
                            this.show_response_message(response.data.msg, 'Success');
                            
                                location.reload();
                           
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
                        this.delete_processing = false;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
                });

                this.$on("close",function () {
                    this.show_modal = false;
                });
            }
        });
            },
            assigncomplaint_to_labtachnician(){                         
                this.show_assign_complaint = true;                
            },
            cancel_complaint(){
                this.$off("cancel_complaint");
                this.show_assign_complaint = false;
                this.required_product = false;
            },
            request_for_product(){
                this.required_product = true;
            },
            
            delete_category(){
                this.$off("submit");
                this.$off("close");
                this.show_modal = true;

                this.$on("submit",function () {       
                    this.processing = true;
                    this.delete_processing = true;

                    var formData = new FormData();
                    formData.append("access_token", window.settings.access_token);

                    axios.post(this.delete_category_api_link, formData).then((response) => {

                        if(response.data.status_code == 200) {
                            this.show_response_message(response.data.msg, 'Success');
                            if(response.data.link != ""){
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
                        this.delete_processing = false;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
                });

                this.$on("close",function () {
                    this.show_modal = false;
                });
            },
            requested_for_required_product(){
                alert('kashif');
            }
        }
    }
</script>