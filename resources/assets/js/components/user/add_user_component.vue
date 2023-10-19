<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
            <form @submit.prevent="submit_form" class="mb-3">

                <div class="card-header d-flex flex-wrap mb-4">
                    <div class="mr-auto">
                        <span class="text-title" v-if="user_slack == ''">{{ $t("Add User") }}</span>
                        <span class="text-title" v-else>{{ $t("Edit User") }}</span>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary"  v-bind:disabled="processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="processing == true"></i> {{ $t("Save User") }}</button>
                    </div>
                </div>
                    
                <p v-html="server_errors" v-bind:class="[error_class]"></p>

                <div class="mb-2 background_set">
                    <span class="text-subhead">{{ $t("Basic Information") }}</span>
                </div>
                <div class="form-row mb-2">
                    <div class="form-group col-md-4">
                        <label for="firstname">{{ $t("Fullname") }}</label><span style="color:red">*</span>
                        <input type="text" name="fullname" v-model="fullname" v-validate="'required|max:250'" class="form-control form-control-custom" :placeholder="$t('Please enter fullname')"  autocomplete="off">
                        <span v-bind:class="{ 'error' : errors.has('fullname') }">{{ errors.first('fullname') }}</span> 
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email">{{ $t("Email") }}</label><span style="color:red">*</span>
                        <input type="text" name="email" v-model="email" v-validate="'required|email|max:150'" class="form-control form-control-custom" :placeholder="$t('Please enter email')"  autocomplete="off">
                        <span v-bind:class="{ 'error' : errors.has('email') }">{{ errors.first('email') }}</span> 
                    </div>        
                    <div class="form-group col-md-4">
                        <label for="fatherName">{{ $t("Father Name") }}</label>
                        <input type="text" name="fatherName" v-model="fatherName" class="form-control form-control-custom" :placeholder="$t('Please Enter Father Name')" autocomplete="off">
                        <span v-bind:class="{ 'error' : errors.has('fatherName') }">{{ errors.first('fatherName') }}</span> 
                    </div>            
                    <div class="form-group col-md-4">
                        <label for="phone">{{ $t("Contact No.") }}</label><span style="color:red">*</span>
                        <input type="number" name="phone" v-model="phone" v-validate="'required|min:10|max:11'" class="form-control form-control-custom" :placeholder="$t('Please enter Contact Number')" autocomplete="off">
                        <span v-bind:class="{ 'error' : errors.has('phone') }">{{ errors.first('phone') }}</span> 
                    </div>
                    <div class="form-group col-md-4">
                        <label for="emergency_number">{{ $t("Emergency No.") }}</label><span style="color:red">*</span>
                        <input type="number" name="emergency_number" v-model="emergency_number" v-validate="'required|min:10|max:11'" class="form-control form-control-custom" :placeholder="$t('Please enter Emergency Number')" autocomplete="off">
                        <span v-bind:class="{ 'error' : errors.has('emergency_number') }">{{ errors.first('emergency_number') }}</span> 
                    </div>

                    <div class="form-group col-md-4">
                        <label for="cnic">{{ $t("CNIC NUMBER") }}</label><span style="color:red">*</span>
                        <input type="text" name="cnic" v-model="cnic" v-validate="'required|min:13|max:15'" class="form-control form-control-custom" :placeholder="$t('Please enter Contact Number')" autocomplete="off">
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
                        <input type="date" name="dob" v-model="dob" class="form-control form-control-custom" :placeholder="$t('Please Enter Date of Birth')" autocomplete="off">
                        <span v-bind:class="{ 'error' : errors.has('dob') }">{{ errors.first('dob') }}</span> 
                    </div>
                    <div class="form-group col-md-4">
                        <label for="doj">{{ $t("Date of Joining") }}</label>
                        <input type="date" name="doj" v-model="doj" class="form-control form-control-custom" :placeholder="$t('Please Enter Date of Joining')" autocomplete="off">
                        <span v-bind:class="{ 'error' : errors.has('doj') }">{{ errors.first('doj') }}</span> 
                    </div> 
                    
                    <div class="form-group col-md-4">
                        <label for="reference">{{ $t("Reference") }}</label>
                        <input type="text" name="reference" v-model="reference" class="form-control form-control-custom" :placeholder="$t('Please Enter Reference')" autocomplete="off">
                        <span v-bind:class="{ 'error' : errors.has('reference') }">{{ errors.first('reference') }}</span> 
                    </div> 

                </div>               

                <div class="mb-2 background_set">
                    <span class="text-subhead">{{ $t("Address Information") }}</span>
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


                <div class="mb-2 background_set">
                    <span class="text-subhead">{{ $t("Manager Information") }}</span>
                </div>
                <div class="form-row mb-2">
                    <div class="form-group col-md-4">
                        <label for="line_manager">{{ $t("Line Manager") }}</label><span style="color:red">*</span>
                        <select name="line_manager" v-model="line_manager" v-validate="'required'" class="form-control form-control-custom custom-select">
                            <option value="" selected disabled>Choose Line Manager..</option>
                            <option v-for="(user, index) in users" v-bind:value="user.id" v-bind:key="index">
                                {{ user.fullname }} ({{ user.user_code }})
                            </option>
                        </select>
                        <span v-bind:class="{ 'error' : errors.has('role') }">{{ errors.first('role') }}</span> 
                    </div>
                </div>


                <div class="mb-2 background_set">
                    <span class="text-subhead">{{ $t("Bank Account Information") }}</span>
                </div>

                <div class="form-row mb-2">
                    <div class="form-group col-md-4">
                            <label for="bank_name">{{ $t("Bank Name") }}</label>
                            <input type="text" name="bank_name" v-model="bank_name"
                                class="form-control form-control-custom" :placeholder="$t('Enter Bank Name')">
                            <span v-bind:class="{ 'error': errors.has('bank_name') }">{{ errors.first('bank_name') }}</span>                           
                    </div>
                    <div class="form-group col-md-4">
                            <label for="bank_code">{{ $t("Bank Branch Code") }}</label>
                            <input type="text" name="bank_code" v-model="bank_code"
                                class="form-control form-control-custom" :placeholder="$t('Enter Bank Branch Code')">
                            <span v-bind:class="{ 'error': errors.has('bank_code') }">{{ errors.first('bank_code') }}</span>                           
                    </div>
                    <div class="form-group col-md-4">
                            <label for="account_title">{{ $t("Account Title") }}</label>
                            <input type="text" name="account_title" v-model="account_title"
                                class="form-control form-control-custom" :placeholder="$t('Enter Account Title')">
                            <span v-bind:class="{ 'error': errors.has('account_title') }">{{ errors.first('account_title') }}</span>                           
                    </div>
                    <div class="form-group col-md-4">
                            <label for="account_number">{{ $t("Account Number") }}</label>
                            <input type="text" name="account_number" v-model="account_number"
                                class="form-control form-control-custom" :placeholder="$t('Enter Account Number')">
                            <span v-bind:class="{ 'error': errors.has('account_number') }">{{ errors.first('account_number') }}</span>                           
                    </div>
                    <div class="form-group col-md-4">
                            <label for="iban_number">{{ $t("IBAN Number") }}</label>
                            <input type="text" name="iban_number" v-model="iban_number"
                                class="form-control form-control-custom" :placeholder="$t('Enter IBAN Number')">
                            <span v-bind:class="{ 'error': errors.has('iban_number') }">{{ errors.first('iban_number') }}</span>                           
                    </div>
                </div>

                <div class="mb-2 background_set">
                    <span class="text-subhead">{{ $t("Role Information") }}</span>
                </div>
                <div class="form-row mb-2">
                    <div class="form-group col-md-3">
                        <label for="lastname">{{ $t("Role") }}</label><span style="color:red">*</span>
                        <select name="role" v-model="role" v-validate="'required'" class="form-control form-control-custom custom-select">
                            <option value="">Choose Role..</option>
                            <option v-for="(role, index) in roles" v-bind:value="role.slack" v-bind:key="index">
                                {{ role.label }}
                            </option>
                        </select>
                        <span v-bind:class="{ 'error' : errors.has('role') }">{{ errors.first('role') }}</span> 
                    </div>
                    <div class="form-group col-md-3">
                        <label for="status">{{ $t("Status") }}</label><span style="color:red">*</span>
                        <select name="status" v-model="status" v-validate="'required|numeric'" class="form-control form-control-custom custom-select">
                            <option value="">Choose Status..</option>
                            <option v-for="(status, index) in statuses" v-bind:value="status.value" v-bind:key="index">
                                {{ status.label }}
                            </option>
                        </select>
                        <span v-bind:class="{ 'error' : errors.has('status') }">{{ errors.first('status') }}</span> 
                    </div>
                </div>

                <div class="mb-2" v-show="is_super_admin == true && user_slack != ''">
                    <div class="mb-2">
                        <span class="text-subhead">{{ $t("Password Reset") }}</span>
                    </div>
                    <div class="mb-2">
                        <button type="button" class="btn btn-outline-primary" v-bind:disabled="reset_password_form.processing == true" v-on:click="reset_password"> <i class='fa fa-circle-notch fa-spin'  v-if="reset_password_form.processing == true"></i> {{ $t("Reset Current Password") }}</button>
                    </div>
                </div>

                <div class="mb-2 background_set">
                    <span class="text-subhead">{{ $t("Store Access") }}</span>
                </div>

                <div class="mb-2">
                    <div class="custom-control custom-checkbox mb-1" v-for="(store, index) in stores" v-bind:key="index">
                        <input class="custom-control-input" type="checkbox" v-model="stores_selected" v-bind:value="store.slack" v-bind:id="store.slack">
                        <label class="custom-control-label" v-bind:for="store.slack">
                            <span class="text-bold">{{ store.store_code }}</span>, {{ store.name }}, {{ store.address }}
                        </label>
                    </div>
                </div>

            </form>
                
        </div>

        <modalcomponent v-if="show_modal" v-on:close="show_modal = false">
            <template v-slot:modal-header>
                {{ $t("Confirm") }}
            </template>
            <template v-slot:modal-body>
                <p v-if="status == 0">You are making the user inactive.</p>
                {{ $t("Are you sure you want to proceed?") }}
            </template>
            <template v-slot:modal-footer>
                <button type="button" class="btn btn-light" @click="$emit('close')">Cancel</button>
                <button type="button" class="btn btn-primary" @click="$emit('submit')" v-bind:disabled="processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="processing == true"></i> Continue</button>
            </template>
        </modalcomponent>

        <modalcomponent v-if="show_password_reset_confirm" v-on:close="show_password_reset_confirm = false">
            <template v-slot:modal-header>
                {{ $t("Confirm") }}
            </template>
            <template v-slot:modal-body>
                Are you sure you want to reset the password?
            </template>
            <template v-slot:modal-footer>
                <button type="button" class="btn btn-light" @click="$emit('close')">Cancel</button>
                <button type="button" class="btn btn-primary" @click="$emit('submit')" v-bind:disabled="processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="processing == true"></i> Continue</button>
            </template>
        </modalcomponent>

        <modalcomponent v-if="show_new_password" v-on:close="show_new_password = false">
            <template v-slot:modal-header>
                New Password
            </template>
            <template v-slot:modal-body>
               New password for the user : <code>{{ new_password }}</code>
            </template>
            <template v-slot:modal-footer>
                <button type="button" class="btn btn-primary" @click="$emit('close')">Ok</button>
            </template>
        </modalcomponent>
    </div>
</div>
</template>

<script>
    'use strict';
    
    export default {
        data(){
            return{
                server_errors   : '',
                error_class     : '',
                processing      : false,
                modal           : false,
                show_modal      : false,

                reset_password_form : {
                    processing : false,
                },
                show_password_reset_confirm : false,
                show_new_password : false,
                new_password    : '',

                api_link        : (this.user_data == null)?'/api/add_user':'/api/update_user/'+this.user_data.slack,
                password_reset_api_link : (this.user_data == null)?'':'/api/reset_user_password/'+this.user_data.slack,

                user_slack      : (this.user_data == null)?'':this.user_data.slack,
                email           : (this.user_data == null)?'':this.user_data.email,
                fullname        : (this.user_data == null)?'':this.user_data.fullname,
                fatherName      : (this.user_data == null)?'':this.user_data.father_name,
                cnic            : (this.user_data == null)?'':this.user_data.cnic,
                phone           : (this.user_data == null)?'':this.user_data.phone,
                country         : (this.user_data == null)?'':this.user_data.country,
                city            : (this.user_data == null)?'':this.user_data.city,
                address         : (this.user_data == null)?'':this.user_data.address,
                dob             : (this.user_data == null)?'':this.user_data.dob,
                doj             : (this.user_data == null)?'':this.user_data.doj,
                emergency_number: (this.user_data == null)?'':this.user_data.emergency_number,
                reference       : (this.user_data == null)?'':this.user_data.reference,


                // account variables 
                bank_name           : (this.user_data == null)?'':this.user_data.bank_name,
                bank_code           : (this.user_data == null)?'':this.user_data.bank_code,
                account_title       : (this.user_data == null)?'':this.user_data.account_title,
                account_number      : (this.user_data == null)?'':this.user_data.account_number,
                iban_number         : (this.user_data == null)?'':this.user_data.iban_number,


                role            : (this.user_data == null)?'':(this.user_data.role == null)?'':this.user_data.role.slack,
                line_manager    : (this.user_data == null)?'':(this.user_data.line_manager == null)?'':this.user_data.line_manager.id,
                status          : (this.user_data == null)?'':(this.user_data.status == null)?'':this.user_data.status.value,
                gender          : (this.user_data == null)?'':(this.user_data.gender == null)?'':this.user_data.gender,
                stores_selected : (this.user_data == null)?[]:(this.user_data.selected_stores == null)?[]:this.user_data.selected_stores,
            }
        },
        props: {
            users: Array,
            roles: Array,
            statuses: Array,
            stores: Array,
            user_data: [Array, Object],
            is_super_admin : Boolean
        },
        mounted() {
            console.log('Add user page loaded');
        },
        methods: {
            submit_form(){

                this.$off("submit");
                this.$off("close");

                this.$validator.validateAll().then((result) => {
                    
                    if (result) {

                        this.show_modal = true;

                        this.$on("submit",function () {

                            // this.processing = true;
                            var formData = new FormData();

                            formData.append("access_token", window.settings.access_token);
                            formData.append("fullname", (this.fullname == null)?'':this.fullname);
                            formData.append("fatherName", (this.fatherName == null)?'':this.fatherName);
                            formData.append("dob", (this.dob == null)?'':this.dob);
                            formData.append("doj", (this.doj == null)?'':this.doj);
                            formData.append("cnic", (this.cnic == null)?'':this.cnic);
                            formData.append("email", (this.email == null)?'':this.email);
                            formData.append("phone", (this.phone == null)?'':this.phone);
                            formData.append("emergency_number", (this.emergency_number == null)?'':this.emergency_number);
                            formData.append("country", (this.country == null)?'':this.country);
                            formData.append("city", (this.city == null)?'':this.city);
                            formData.append("address", (this.address == null)?'':this.address);
                            formData.append("reference", (this.reference == null)?'':this.reference);
                            formData.append("role", (this.role == null)?'':this.role);
                            formData.append("line_manager", (this.line_manager == null)?'':this.line_manager);
                            formData.append("status", (this.status == null)?'':this.status);
                            formData.append("gender", (this.gender == null)?'':this.gender);
                            formData.append("user_stores", (this.stores_selected == null)?'':this.stores_selected);

                            // account variable load in formData 
                            formData.append('bank_name', (this.bank_name == null)?'':this.bank_name);
                            formData.append('bank_code', (this.bank_code == null)?'':this.bank_code);
                            formData.append('account_title', (this.account_title == null)?'':this.account_title);
                            formData.append('account_number', (this.account_number == null)?'':this.account_number);
                            formData.append('iban_number', (this.iban_number == null)?'':this.iban_number);
                            

                            axios.post(this.api_link, formData).then((response) => {
                        
                                if(response.data.status_code == 200) {
                                    this.show_response_message(response.data.msg, 'Success');
                                
                                    setTimeout(function(){
                                        location.reload();
                                    }, 1000);
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

            reset_password(){

                this.$off("submit");
                this.$off("close");

                this.show_password_reset_confirm = true;

                this.$on("submit",function () {

                    this.reset_password_form.processing = true;
                    var formData = new FormData();

                    formData.append("access_token", window.settings.access_token);

                    axios.post(this.password_reset_api_link, formData).then((response) => {
                
                        if(response.data.status_code == 200) {
                            
                            this.show_response_message(response.data.msg, 'Success');
                            this.reset_password_form.processing = false;
                            this.show_password_reset_confirm = false;

                            this.new_password = response.data.data['secret'];
                            this.show_new_password = true;
                        
                        }else{
                            this.show_password_reset_confirm = false;
                            this.reset_password_form.processing = false;
                            try{
                                var error_json = JSON.parse(response.data.msg);
                                this.loop_api_errors(error_json);
                            }catch(err){
                                this.server_errors = response.data.msg;
                            }
                            this.error_class = 'error';
                        }

                    })
                    .catch((error) => {
                        console.log(error);
                    });
                });
                
                this.$on("close",function () {
                    this.show_password_reset_confirm = false;
                    this.show_new_password = false;
                });
            }
        }
    }
</script>

<style scoped>
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


.mb-2,
.my-2 {
    margin-left: 10px;
    margin-right: 10px;
    margin-bottom: 0.5rem !important;
}
.mb-1, .my-1 {
    margin-bottom: 0.25rem!important;
    margin-left: 10px;
}
.form-row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: 10px;
    margin-left: 10px;
}
.background_set{
    background: #f2f2f2;
    padding:10px;
}
</style>
