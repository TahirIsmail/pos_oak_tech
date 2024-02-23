<template>
    <div class="row">
        <div class="col-md-12">
    
            <div class="card shadow" v-if="customer_type == 'corporate'">
    
                <form @submit.prevent="submit_form" class="mb-3">
    
    
    
                    <div class="card-header d-flex flex-wrap mb-4">
    
                        <div class="mr-auto">
    
                            <span class="text-title" v-if="customer_slack == ''">{{ $t("Add Customer") }}</span>
    
                            <span class="text-title" v-else>{{ $t("Edit Customer") }}</span>
    
                        </div>
    
                        <div class="">
    
                            <button type="submit" class="btn btn-primary" v-bind:disabled="processing == true"> <i class='fa fa-circle-notch fa-spin' v-if="processing == true"></i> 
                            {{ $t("Save Customer")}}
                            </button>
    
                        </div>
    
                    </div>
    
    
    
                    <p v-html="server_errors" v-bind:class="[error_class]"></p>
    
    
    
                    <div class="mb-2 background_set">
    
                        <span class="text-subhead">Basic Information</span>
    
                    </div>
    
                    <div class="form-row mb-2">
    
    
    
                        <div class="form-group col-md-4">
    
                            <label for="name">{{ $t("Fullname") }}</label><span style="color:red">*</span>
    
                            <input type="text" name="name" v-model="name" v-validate="'required|max:250'" class="form-control form-control-custom" :placeholder="$t('Please enter fullname')" autocomplete="off">
    
                            <span v-bind:class="{ 'error': errors.has('name') }">{{ errors.first('name') }}</span>
    
                        </div>
    
                        <div class="form-group col-md-4">
    
                            <label for="email">{{ $t("Email") }}</label><span style="color:red">*</span>
    
                            <input type="text" name="email" v-model="email" v-validate="{ required: this.email_required, email: true, max: 150 }" class="form-control form-control-custom" :placeholder="$t('Please enter email')" autocomplete="off">
    
                            <span v-bind:class="{ 'error': errors.has('email') }">{{ errors.first('email') }}</span>
    
                        </div>
    
    
    
                        <div class="form-group col-md-4">
    
                            <label for="phone">{{ $t("Landline Contact No.") }}&nbsp;<small class="text-muted">(With Country
    
                                    Code)</small></label><span style="color:red">*</span>
    
                            <input type="text" name="phone" v-model="phone" v-validate="{ required: this.phone_required, min: 10, max: 15 }" class="form-control form-control-custom" :placeholder="$t('Please enter Contact Number')" autocomplete="off">
    
                            <span v-bind:class="{ 'error': errors.has('phone') }">{{ errors.first('phone') }}</span>
    
                        </div>
    
    
    
                        <div class="form-group col-md-4">
    
                            <label for="account_opening_date">{{ $t("Account Opening Date") }}</label>
    
                            <input type="date" name="account_opening_date" v-model="account_opening_date" id="account_opening_date" class="form-control">
    
                        </div>
    
    
    
                        <div class="form-group col-md-4">
    
                            <label for="customer_strn">{{ $t("Customer STRN") }}</label>
    
                            <input type="text" name="customer_strn" v-model="customer_strn" id="customer_strn" class="form-control">
    
                        </div>
    
                        <div class="form-group col-md-4">
    
                            <label for="customer_ntn">{{ $t("Customer NTN") }}</label>
    
                            <input type="text" name="customer_ntn" v-model="customer_ntn" id="customer_ntn" class="form-control">
    
                        </div>
    
                        <div class="form-group col-md-4">
    
                            <label for="employer">{{ $t("Customer Account Manager") }}</label>
    
                            <select name="employer" v-model="employer" class="form-control form-control-custom custom-select">
    
                                <option value="">Choose Account Manager...</option>
    
                                <option v-for="(employer, index) in employers" v-bind:value="employer.fullname" v-bind:key="index">
    
                                    {{ employer.fullname }} ({{ employer.email }})
    
                                </option>
    
                            </select>
    
                        </div>
    
    
    
                        <div class="form-group col-md-4">
    
                            <label for="status">{{ $t("Status") }}</label><span style="color:red">*</span>
    
                            <select name="status" v-model="status" v-validate="'required|numeric'" class="form-control form-control-custom custom-select">
    
                                <option value="">Choose Status..</option>
    
                                <option v-for="(status, index) in statuses" v-bind:value="status.value" v-bind:key="index">
    
                                    {{ status.label }}
    
                                </option>
    
                            </select>
    
                            <span v-bind:class="{ 'error': errors.has('status') }">{{ errors.first('status') }}</span>
    
                        </div>
    
    
    
                    </div>
    
    
    
                    <div class="mb-2 background_set">
    
                        <span class="text-subhead">Address Information</span>
    
                    </div>
    
                    <div class="form-row mb-2">
    
                        <div class="form-group col-md-4">
    
                            <label for="address">{{ $t("Address") }}</label><span style="color:red">*</span>
    
                            <textarea name="address" v-model="address" v-validate="'max:65535'" class="form-control form-control-custom" rows="1" :placeholder="$t('Enter Address')"></textarea>
    
                            <span v-bind:class="{ 'error': errors.has('address') }">{{ errors.first('address') }}</span>
    
                        </div>
    
                        <div class="form-group col-md-4">
    
                            <label for="city">{{ $t("City") }}</label>
    
                            <input type="text" name="city" v-model="city" class="form-control form-control-custom" :placeholder="$t('Enter City')">
    
                            <span v-bind:class="{ 'error': errors.has('city') }">{{ errors.first('city') }}</span>
    
                        </div>
    
                        <div class="form-group col-md-4">
    
                            <label for="country">{{ $t("Country") }}</label><span style="color:red">*</span>
    
                            <input type="text" name="country" v-model="country" v-validate="'required'" class="form-control form-control-custom" :placeholder="$t('Enter Country')">
    
                            <span v-bind:class="{ 'error': errors.has('country') }">{{ errors.first('country') }}</span>
    
                        </div>
    
    
    
                    </div>
    
    
    
                    <div class="mb-2 background_set">
    
                        <span class="text-subhead">Contact Persons</span>
    
                    </div>
    
                    <div id="main_2dev">
    
                        <div v-for="(person, index) in contact_persons" :key="index" class="form-row mb-2">
    
                            <div class="form-group col-sm-12 col-md-10 col-lg-4">
    
                                <label :for="`position ${index}`">{{ $t("Job Post") }}</label>
    
                                <select :name="`position ${index}`" v-model="person.position" class="form-control form-control-custom custom-select">
    
                                    <option selected disabled>Choose Employer Post..</option>
    
                                    <option value="Procurement Officer">Procurement Officer</option>
    
                                    <option value="Procurement Manager">Procurement Manager</option>
    
                                    <option value="Admin Officer/Manager">Admin Officer/Manager</option>
    
                                    <option value="IT Administrator/Manager">IT Administrator/Manager</option>
    
                                    <option value="Director/CEO">Director/CEO</option>
    
                                    <option value="Account Officer/Manager">Account Officer/Manager</option>
    
                                </select>
    
                                <span :class="{ 'error': errors.has(`position ${index}`) }">{{ errors.first(`position ${index}`) }}</span>
    
                            </div>
    
                            <div class="form-group col-sm-12 col-md-10 col-lg-4">
    
                                <label v-bind:for="`customer_department ${index}`">{{ $t("Customer Department") }}</label>
    
                                <select :name="`customer_department ${index}`" v-model="person.customer_department" id="customer_department" class="form-control">
    
                                    <option selected disabled>Choose Customer Department..</option>
    
                                    <option value="IT Department">IT Department</option>
    
                                    <option value="Procurement">Procurement</option>
    
                                    <option value="Admin">Admin</option>
    
                                    <option value="Accounts">Accounts</option>
    
                                    <option value="N/A">N/A</option>
    
                                </select>
    
                            </div>

                            <div class="form-group col-sm-12 col-md-10 col-lg-4">
    
                            <label v-bind:for="`customer_person_role ${index}`">{{ $t("Role") }}</label>

                            <select :name="`customer_person_role ${index}`" v-model="person.customer_person_role" id="customer_person_role" class="form-control">
                                <option selected disabled>Choose Role...</option>
                                <option v-for="(role, index) in customer_roles" :key="index" :value="role.id">{{role.label}}</option>                              
                            </select>
                        </div>
    
    
    
                            <div class="form-group col-sm-12 col-md-10 col-lg-4">
    
                                <label :for="`Name ${index}`">{{ $t("Name") }}</label>
    
                                <input :name="`Name ${index}`" v-model="person.name" class="form-control form-control-custom" :placeholder="$t('Enter Name')" />
    
                                <span :class="{ 'error': errors.has(`Name ${index}`) }">{{ errors.first(`Name ${index}`) }}</span>
    
                            </div>
    
                            <div class="form-group col-sm-12 col-md-10 col-lg-4">
    
                                <label :for="`Email ${index}`">{{ $t("Email") }}</label>
    
                                <input :name="`Email ${index}`" v-model="person.email" class="form-control form-control-custom" :placeholder="$t('Enter Email')" />
    
                                <span :class="{ 'error': errors.has(`Email ${index}`) }">{{ errors.first(`Email ${index}`) }}</span>
    
                            </div>
    
                            <div class="form-group col-sm-12 col-md-10 col-lg-4">
    
                                <label :for="`Mobile ${index}`">{{ $t("Mobile") }}</label>
    
                                <input :name="`Mobile ${index}`" v-model="person.mobile" class="form-control form-control-custom" :placeholder="$t('Enter Mobile')" />
    
                                <span :class="{ 'error': errors.has(`Mobile ${index}`) }">{{ errors.first(`Mobile ${index}`) }}</span>

                            </div>    



                        </div>
    
                        <div class="w-100 d-flex justify-content-end">
    
                            <button type="button" class="btn btn-primary mr-5 mb-2" @click="addContactPerson">Add More Persons</button>
    
                        </div>
    
                    </div>
    
                </form>
    
    
    
            </div>
    
    
    
            <div class="card shadow" v-if="customer_type == 'walkin'">
    
                <form @submit.prevent="submit_form" class="mb-3" enctype="multipart/form-data">
    
    
    
                    <div class="card-header d-flex flex-wrap mb-4">
    
                        <div class="mr-auto">
    
                            <span class="text-title" v-if="customer_slack == ''">{{ $t("Add Customer") }}</span>
    
                            <span class="text-title" v-else>{{ $t("Edit Customer") }}</span>
    
                        </div>
    
                        <div class="">
    
                            <button type="submit" class="btn btn-primary" v-bind:disabled="processing == true"> <i class='fa fa-circle-notch fa-spin' v-if="processing == true"></i> {{ $t("Save Customer")
    
                                        }}</button>
    
                        </div>
    
                    </div>
    
    
    
                    <p v-html="server_errors" v-bind:class="[error_class]"></p>
    
    
    
                    <div class="mb-2 background_set">
    
                        <span class="text-subhead">Basic Information</span>
    
                    </div>
    
                    <div class="form-row mb-2">
    
                        <div class="form-group col-md-4">
    
                            <label for="name">{{ $t("Fullname") }}</label><span style="color:red">*</span>
    
                            <input type="text" name="name" v-model="name" v-validate="'required|max:250'" class="form-control form-control-custom" :placeholder="$t('Please enter fullname')" autocomplete="off">
    
                            <span v-bind:class="{ 'error': errors.has('name') }">{{ errors.first('name') }}</span>
    
                        </div>
    
                        <div class="form-group col-md-4">
    
                            <label for="email">{{ $t("Email") }}</label><span style="color:red">*</span>
    
                            <input type="text" name="email" v-model="email" v-validate="{ required: this.email_required, email: true, max: 150 }" class="form-control form-control-custom" :placeholder="$t('Please enter email')" autocomplete="off">
    
                            <span v-bind:class="{ 'error': errors.has('email') }">{{ errors.first('email') }}</span>
    
                        </div>
    
                        <div class="form-group col-md-4">
    
                            <label for="phone">{{ $t("Landline Contact No.") }}&nbsp;<small class="text-muted">(With Country
    
                                    Code)</small></label><span style="color:red">*</span>
    
                            <input type="text" name="phone" v-model="phone" v-validate="{ required: this.phone_required, min: 10, max: 15 }" class="form-control form-control-custom" :placeholder="$t('Please enter Contact Number')" autocomplete="off">
    
                            <span v-bind:class="{ 'error': errors.has('phone') }">{{ errors.first('phone') }}</span>
    
                        </div>
    
                        <div class="form-group col-md-4">
    
                            <label for="phone">{{ $t("Mobile Number") }}&nbsp;<small class="text-muted">(With Country
    
                                    Code)</small></label>
    
                            <input type="text" name="mobile_number" v-model="mobile_number" class="form-control form-control-custom" :placeholder="$t('Please Enter Mobile Number')" autocomplete="off">
    
                        </div>
    
                        <div class="form-group col-md-4">
    
                            <label for="cnic">{{ $t("CNIC NUMBER") }}</label>
    
                            <input type="text" name="cnic" v-model="cnic" class="form-control form-control-custom" :placeholder="$t('Please enter Contact Number')" autocomplete="off">
    
                            <span v-bind:class="{ 'error' : errors.has('cnic') }">{{ errors.first('cnic') }}</span>
    
                        </div>
    
                        <div class="form-group col-md-4">
    
                            <label for="customer_cnic_img">{{
    
                                $t("Upload Customer CNIC") + " (jpeg, jpg, png, webp)"
    
                                }}</label>
    
                            <input type="file" class="form-control-file form-control form-control-custom file-input" name="customer_cnic_img" ref="customer_cnic_img" accept="image/x-png,image/jpeg,image/webp" v-validate="'ext:jpg,jpeg,png,webp|size:1500'" />
    
                            <small class="form-text text-muted mb-1">Allowed file size per file is 1.5 MB</small>
    
    
    
                            <span v-bind:class="{ error: errors.has('customer_cnic_img') }">{{
    
                                errors.first("customer_cnic_img")
    
                                }}</span>
    
                        </div>
    
    
    
                        <div class="form-group col-md-4">
    
                            <label for="account_opening_date">{{ $t("Account Opening Date") }}</label>
    
                            <input type="date" name="account_opening_date" v-model="account_opening_date" id="account_opening_date" class="form-control">
    
                        </div>
    
    
    
                        <div class="form-group col-md-4">
    
                            <label for="employer">{{ $t("Customer Account Manager") }}</label>
    
                            <select name="employer" v-model="employer" class="form-control form-control-custom custom-select">
    
                                <option value="">Choose Account Manager...</option>
    
                                <option v-for="(employer, index) in employers" v-bind:value="employer.fullname" v-bind:key="index">
    
                                    {{ employer.fullname }} ({{ employer.email }})
    
                                </option>
    
                            </select>
    
                        </div>
    
    
    
                        <div class="form-group col-md-4">
    
                            <label for="status">{{ $t("Status") }}</label><span style="color:red">*</span>
    
                            <select name="status" v-model="status" v-validate="'required|numeric'" class="form-control form-control-custom custom-select">
    
                                <option value="">Choose Status..</option>
    
                                <option v-for="(status, index) in statuses" v-bind:value="status.value" v-bind:key="index">
    
                                    {{ status.label }}
    
                                </option>
    
                            </select>
    
                            <span v-bind:class="{ 'error': errors.has('status') }">{{ errors.first('status') }}</span>
    
                        </div>
    
    
    
                    </div>
    
    
    
                    <div class="mb-2 background_set">
    
                        <span class="text-subhead">Address Information</span>
    
                    </div>
    
                    <div class="form-row mb-2">
    
                        <div class="form-group col-md-4">
    
                            <label for="address">{{ $t("Address") }}</label><span style="color:red">*</span>
    
                            <textarea name="address" v-model="address" v-validate="'max:65535'" class="form-control form-control-custom" rows="1" :placeholder="$t('Enter Address')"></textarea>
    
                            <span v-bind:class="{ 'error': errors.has('address') }">{{ errors.first('address') }}</span>
    
                        </div>
    
                        <div class="form-group col-md-4">
    
                            <label for="city">{{ $t("City") }}</label>
    
                            <input type="text" name="city" v-model="city" class="form-control form-control-custom" :placeholder="$t('Enter City')">
    
                            <span v-bind:class="{ 'error': errors.has('city') }">{{ errors.first('city') }}</span>
    
                        </div>
    
                        <div class="form-group col-md-4">
    
                            <label for="country">{{ $t("Country") }}</label><span style="color:red">*</span>
    
                            <input type="text" name="country" v-model="country" v-validate="'required'" class="form-control form-control-custom" :placeholder="$t('Enter Country')">
    
                            <span v-bind:class="{ 'error': errors.has('country') }">{{ errors.first('country') }}</span>
    
                        </div>
    
    
    
                    </div>
    
                    <div class="mb-2 background_set">
    
                        <span class="text-subhead">Cheque Information</span>
    
                    </div>
    
                    <div class="form-row mb-2">
    
                        <div class="form-group col-md-4">
    
                            <label for="upload_cheque">{{
    
                                $t("Upload Cheque") + " (jpeg, jpg, png, webp)"
    
                                }}</label>
    
                            <input type="file" class="form-control-file form-control form-control-custom file-input" name="upload_cheque" ref="upload_cheque" accept="image/x-png,image/jpeg,image/webp" v-validate="'ext:jpg,jpeg,png,webp|size:1500'" />
    
                            <small class="form-text text-muted mb-1">Allowed file size per file is 1.5 MB</small>
    
    
    
                            <span v-bind:class="{ error: errors.has('upload_cheque') }">{{
    
                                errors.first("upload_cheque")
    
                                }}</span>
    
                        </div>
    
                        <div class="form-group col-md-4">
    
                            <label for="cheque_limit">{{ $t("Cheque Limit") }}</label>
    
                            <input type="text" name="cheque_limit" v-model="cheque_limit" class="form-control form-control-custom" :placeholder="$t('Please Cheque Limit')" autocomplete="off">
    
                        </div>
    
                        <div class="form-group col-md-4">
    
                            <label for="cheque_due_time">{{ $t("Time") }}</label>
    
                            <input type="date" name="cheque_due_time" v-model="cheque_due_time" class="form-control form-control-custom" :placeholder="$t('Please Cheque Limit')" autocomplete="off">
    
                        </div>
    
                    </div>
    
    
    
                    <div class="mb-2 background_set">
    
                        <span class="text-subhead">Reference Person</span>
    
                    </div>
    
                    <div id="main_2dev">
    
                        <div class="form-row mb-2">
    
    
    
                            <div class="form-group col-sm-12 col-md-10 col-lg-4">
    
                                <label for="Name">{{ $t("Reference Name") }}</label>
    
                                <input name="Name" v-model="reference_name" class="form-control form-control-custom" :placeholder="$t('Enter Reference Name')" />
    
                            </div>
    
    
    
                            <div class="form-group col-sm-12 col-md-10 col-lg-4">
    
                                <label for="Mobile">{{ $t("Reference Mobile") }}</label>
    
                                <input :name="`Mobile`" v-model="reference_mobile" class="form-control form-control-custom" :placeholder="$t('Enter Reference Mobile')" />
    
                            </div>
    
    
    
                            <div class="form-group col-md-4">
    
                                <label for="cnic">{{ $t("Reference CNIC NUMBER") }}</label>
    
                                <input type="text" name="cnic" v-model="reference_cnic" class="form-control form-control-custom" :placeholder="$t('Please Enter Reference Contact Number')" autocomplete="off">
    
                            </div>
    
                        </div>
    
    
    
                    </div>    
                </form>
    
    
    
            </div>
    
    
    
            <modalcomponent v-if="show_modal" v-on:close="show_modal = false">
    
                <template v-slot:modal-header>
    
                    {{ $t("Confirm") }}
</template>
<template v-slot:modal-body>
    <p v-if="status == 0">
    
        You are making the customer inactive.</p>
    
    {{ $t("Are you sure you want to proceed?") }}
</template>
<template v-slot:modal-footer>
    <button type="button" class="btn btn-light" @click="$emit('close')">Cancel</button>
    
    <button type="button" class="btn btn-primary" @click="$emit('submit')" v-bind:disabled="processing == true"> <i class='fa fa-circle-notch fa-spin' v-if="processing == true"></i> Continue</button>
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

export default {
    data() {
        return {
            date: {
                lang: 'en',
                format: "YYYY-MM-DD",
            },
            contact_persons: (this.customer_data == null) ? [{
                position: "",
                customer_department: "",
                customer_person_role: "",
                name: "",
                email: "",
                mobile: "",
            }] : this.child_customers,
            server_errors: '',
            error_class: '',
            processing: false,
            modal: false,
            show_modal: false,
            customer_type: this.customer_type,

            api_link: (this.customer_data == null) ? '/api/add_customer' : '/api/update_customer/' + this.customer_data.slack,
            employer: (this.customer_data == null) ? '' : this.customer_data.account_manager,
            customer_slack: (this.customer_data == null) ? '' : this.customer_data.slack,
            customer_id: (this.customer_data == null) ? '' : this.customer_data.customer_id,
            email: (this.customer_data == null) ? '' : this.customer_data.email,
            name: (this.customer_data == null) ? '' : this.customer_data.name,
            phone: (this.customer_data == null) ? '' : this.customer_data.phone,
            address: (this.customer_data == null) ? '' : this.customer_data.address,
            city: (this.customer_data == null) ? '' : this.customer_data.city,
            country: (this.customer_data == null) ? '' : this.customer_data.country,
            gender: (this.customer_data == null) ? '' : this.customer_data.gender,
            father_name: (this.customer_data == null) ? '' : this.customer_data.father_name,
            cnic: (this.customer_data == null) ? '' : this.customer_data.cnic,
            dob: (this.customer_data == null) ? '' : (this.customer_data.dob_raw != null) ? new Date(this.customer_data.dob_raw) : '',
            status: (this.customer_data == null) ? '' : (this.customer_data.status == null) ? '' : this.customer_data.status.value,

            mobile_number: (this.customer_data == null) ? '' : this.customer_data.mobile_number,
            account_opening_date: (this.customer_data == null) ? '' : this.customer_data.account_opening_date,
            customer_strn: (this.customer_data == null) ? '' : this.customer_data.customer_strn,
            customer_ntn: (this.customer_data == null) ? '' : this.customer_data.customer_ntn,

            reference_name: (this.customer_data == null) ? '' : this.customer_data.reference_name,
            reference_mobile: (this.customer_data == null) ? '' : this.customer_data.reference_mobile,
            reference_cnic: (this.customer_data == null) ? '' : this.customer_data.reference_cnic,
            cheque_due_time: (this.customer_data == null) ? '' : this.customer_data.cheque_due_date,
            cheque_limit: (this.customer_data == null) ? '' : this.customer_data.cheque_limit,
        }
    },
    props: {
        statuses: Array,
        customer_data: [Array, Object],
        employers: [Array, Object],
        customer_type: String,
        customer_roles: Array,
        child_customers: [Array, Object]
    },
    mounted() {
        console.log('Add customer page loaded');
    },
    computed: {

        email_required() {
            if (this.phone === '')
                return true;
            return false;
        },
        phone_required() {
            if (this.email === '')
                return true;
            return false;
        }
    },
    methods: {
        convert_date_format(date) {
            return (date != '') ? moment(date).format("YYYY-MM-DD") : '';
        },

        addContactPerson() {
            this.contact_persons.push({
                position: "",
                customer_department: "",
                customer_person_role: "",
                name: "",
                email: "",
                mobile: ""
            });
        },
        submit_form() {

            this.$off("submit");
            this.$off("close");

            this.$validator.validateAll().then((result) => {

                if (result) {

                    this.show_modal = true;

                    this.$on("submit", function() {

                        // this.processing = true;
                        const persons = JSON.stringify(this.contact_persons);
                        var formData = new FormData();

                    
                        // Loop for customer_cnic_img
                        if (this.$refs.customer_cnic_img) {
                            for (let i = 0; i < this.$refs.customer_cnic_img.files.length; i++) {
                                let file = this.$refs.customer_cnic_img.files[i];
                                if (file) {
                                    formData.append("cnic_image[" + i + "]", file);
                                }
                            }
                        }

                        // Loop for upload_cheque
                        if (this.$refs.upload_cheque) {
                            for (let i = 0; i < this.$refs.upload_cheque.files.length; i++) {
                                let file = this.$refs.upload_cheque.files[i];
                                if (file) {
                                    formData.append("cheque_image[" + i + "]", file);
                                }
                            }
                        }

                        formData.append("access_token", window.settings.access_token);
                        formData.append("customer_id", (this.customer_id == null) ? '' : this.customer_id);
                        formData.append("name", (this.name == null) ? '' : this.name);
                        formData.append("email", (this.email == null) ? '' : this.email);
                        formData.append("phone", (this.phone == null) ? '' : this.phone);
                        formData.append("address", (this.address == null) ? '' : this.address);
                        formData.append("city", (this.city == null) ? '' : this.city);
                        formData.append("country", (this.country == null) ? '' : this.country);
                        formData.append("father_name", (this.father_name == null) ? '' : this.father_name);
                        formData.append("gender", (this.gender == null) ? '' : this.gender);
                        formData.append("cnic", (this.cnic == null) ? '' : this.cnic);
                        formData.append("dob", (this.dob == null) ? '' : this.convert_date_format(this.dob));
                        formData.append("status", (this.status == null) ? '' : this.status);

                        formData.append("mobile_number", (this.mobile_number == null) ? '' : this.mobile_number);
                        formData.append("account_opening_date", (this.account_opening_date == null) ? '' : this.account_opening_date);
                        formData.append("customer_strn", (this.customer_strn == null) ? '' : this.customer_strn);
                        formData.append("customer_ntn", (this.customer_ntn == null) ? '' : this.customer_ntn);

                        formData.append("employer", (this.employer == null) ? '' : this.employer);
                        formData.append('contact_people', persons);
                        formData.append('customer_type', this.customer_type);

                        formData.append('reference_name', this.reference_name);
                        formData.append('reference_mobile', this.reference_mobile);
                        formData.append('reference_cnic', this.reference_cnic);
                        formData.append('cheque_due_time', this.cheque_due_time);
                        formData.append('cheque_limit', this.cheque_limit);


                        axios.post(this.api_link, formData).then((response) => {

                                if (response.data.status_code == 200) {
                                    this.show_response_message(response.data.msg, 'Success');
                                    setTimeout(function() {
                                        location.reload();
                                    }, 1000);
                                } else {
                                    this.processing = false;
                                    this.show_modal = false;
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
        }
    }
}
</script>

<style scoped>
.form-row {
    display: flex;
    flex-wrap: wrap;
    margin-right: 20px;
    margin-left: 20px;
}

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
    border-radius: 10px !important;
    margin-bottom: 30px !important;
}

.page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
    margin-left: 18px;
}

.mb-2,
.my-2 {
    margin-bottom: 0.5rem !important;
    margin-left: 10px;
    margin-right: 10px;
}

.form-row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: 10px !important;
    margin-left: 10px !important;
}

.background_set {
    background: #f2f2f2;
    padding: 10px;
}
</style>
