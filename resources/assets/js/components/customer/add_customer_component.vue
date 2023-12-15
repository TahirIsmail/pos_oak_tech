<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <form @submit.prevent="submit_form" class="mb-3">

                    <div class="card-header d-flex flex-wrap mb-4">
                        <div class="mr-auto">
                            <span class="text-title" v-if="customer_slack == ''">{{ $t("Add Customer") }}</span>
                            <span class="text-title" v-else>{{ $t("Edit Customer") }}</span>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-primary" v-bind:disabled="processing == true"> <i
                                    class='fa fa-circle-notch fa-spin' v-if="processing == true"></i> {{ $t("Save Customer")
                                    }}</button>
                        </div>
                    </div>

                    <p v-html="server_errors" v-bind:class="[error_class]"></p>

                    <div class="mb-2 background_set">
                        <span class="text-subhead">Basic Information</span>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col-md-4">
                            <label for="customer_id">{{ $t("Customer ID") }}</label><span style="color:red">*</span>
                            <input type="text" name="Customer ID" v-model="customer_id" v-validate="'required|max:250'"
                                class="form-control form-control-custom" :placeholder="$t('Please enter Customer ID')"
                                autocomplete="off">
                            <span v-bind:class="{ 'error': errors.has('Customer ID') }">{{ errors.first('Customer ID') }}</span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="name">{{ $t("Fullname") }}</label><span style="color:red">*</span>
                            <input type="text" name="name" v-model="name" v-validate="'required|max:250'"
                                class="form-control form-control-custom" :placeholder="$t('Please enter fullname')"
                                autocomplete="off">
                            <span v-bind:class="{ 'error': errors.has('name') }">{{ errors.first('name') }}</span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email">{{ $t("Email") }}</label><span style="color:red">*</span>
                            <input type="text" name="email" v-model="email"
                                v-validate="{ required: this.email_required, email: true, max: 150 }"
                                class="form-control form-control-custom" :placeholder="$t('Please enter email')"
                                autocomplete="off">
                            <span v-bind:class="{ 'error': errors.has('email') }">{{ errors.first('email') }}</span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="father_name">{{ $t("Father Name") }}</label>
                            <input type="text" name="father_name" v-model="father_name"
                                class="form-control form-control-custom" :placeholder="$t('Please Enter Father Name')"
                                autocomplete="off">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="phone">{{ $t("Contact No.") }}&nbsp;<small class="text-muted">(With Country
                                    Code)</small></label><span style="color:red">*</span>
                            <input type="text" name="phone" v-model="phone"
                                v-validate="{ required: this.phone_required, min: 10, max: 15 }"
                                class="form-control form-control-custom" :placeholder="$t('Please enter Contact Number')"
                                autocomplete="off">
                            <span v-bind:class="{ 'error': errors.has('phone') }">{{ errors.first('phone') }}</span>
                        </div>    
                    <div class="form-group col-md-4">
                        <label for="cnic">{{ $t("CNIC NUMBER") }}</label>
                        <input type="text" name="cnic" v-model="cnic"  class="form-control form-control-custom" :placeholder="$t('Please enter Contact Number')" autocomplete="off">
                        <span v-bind:class="{ 'error' : errors.has('cnic') }">{{ errors.first('cnic') }}</span> 
                    </div>
                    <div class="form-group col-md-4">
                        <label for="gender">{{ $t("Gender") }}</label><span style="color:red">*</span>
                        <select name="status" v-model="gender" v-validate="'required'" class="form-control form-control-custom custom-select">
                            <option value="">Choose Gender..</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <span v-bind:class="{ 'error' : errors.has('gender') }">{{ errors.first('gender') }}</span> 
                    </div>
                    <div class="form-group col-md-4">
                            <label for="dob">{{ $t("Date of Birth") }}</label>
                            <date-picker :format="date.format" :lang='date.lang' v-model="dob"
                                v-validate="'date_format:yyyy-MM-dd'"
                                input-class="form-control form-control-custom bg-white" ref="dob" name="dob"
                                :placeholder="$t('Please enter Date of Birth')" autocomplete="off"></date-picker>
                            <span v-bind:class="{ 'error': errors.has('dob') }">{{ errors.first('dob') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                            <label for="status">{{ $t("Status") }}</label><span style="color:red">*</span>
                            <select name="status" v-model="status" v-validate="'required|numeric'"
                                class="form-control form-control-custom custom-select">
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
                            <label for="country">{{ $t("Country") }}</label><span style="color:red">*</span>
                            <input type="text" name="country" v-model="country" v-validate="'required'"
                                class="form-control form-control-custom"
                                :placeholder="$t('Enter Country')">
                            <span v-bind:class="{ 'error': errors.has('country') }">{{ errors.first('country') }}</span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="city">{{ $t("City") }}</label>
                            <input type="text" name="city" v-model="city"
                                class="form-control form-control-custom" :placeholder="$t('Enter City')">
                            <span v-bind:class="{ 'error': errors.has('city') }">{{ errors.first('city') }}</span>
                           
                        </div>
                        <div class="form-group col-md-4">
                            <label for="address">{{ $t("Address") }}</label><span style="color:red">*</span>
                            <textarea name="address" v-model="address" v-validate="'max:65535'"
                                class="form-control form-control-custom" rows="1"
                                :placeholder="$t('Enter Address')"></textarea>
                            <span v-bind:class="{ 'error': errors.has('address') }">{{ errors.first('address') }}</span>
                        </div>
                        
                    </div>
                    

                </form>

            </div>

            <modalcomponent v-if="show_modal" v-on:close="show_modal = false">
                <template v-slot:modal-header>
                    {{ $t("Confirm") }}
                </template>
                <template v-slot:modal-body>
                    <p v-if="status == 0">You are making the customer inactive.</p>
                    {{ $t("Are you sure you want to proceed?") }}
                </template>
                <template v-slot:modal-footer>
                    <button type="button" class="btn btn-light" @click="$emit('close')">Cancel</button>
                    <button type="button" class="btn btn-primary" @click="$emit('submit')"
                        v-bind:disabled="processing == true"> <i class='fa fa-circle-notch fa-spin'
                            v-if="processing == true"></i> Continue</button>
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
            server_errors: '',
            error_class: '',
            processing: false,
            modal: false,
            show_modal: false,
            api_link: (this.customer_data == null) ? '/api/add_customer' : '/api/update_customer/' + this.customer_data.slack,

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
        }
    },
    props: {
        statuses: Array,
        customer_data: [Array, Object]
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

        submit_form() {

            this.$off("submit");
            this.$off("close");

            this.$validator.validateAll().then((result) => {

                if (result) {

                    this.show_modal = true;

                    this.$on("submit", function () {

                        this.processing = true;
                        var formData = new FormData();

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

                        axios.post(this.api_link, formData).then((response) => {

                            if (response.data.status_code == 200) {
                                this.show_response_message(response.data.msg, 'Success');
                                setTimeout(function () {
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

                    this.$on("close", function () {
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
    border-radius:10px !important;
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
.background_set{
    background: #f2f2f2;
    padding:10px;
}
</style>