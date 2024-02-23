<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <form @submit.prevent="submit_form" class="mb-3">

                    <div class="card-header d-flex flex-wrap mb-4">
                        <div class="mr-auto">
                            <span class="text-title" v-if="supplier_slack == ''">{{ $t("Add Supplier") }}</span>
                            <span class="text-title" v-else>{{ $t("Edit Supplier") }}</span>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-primary" v-bind:disabled="processing == true"> <i
                                    class='fa fa-circle-notch fa-spin' v-if="processing == true"></i> {{ $t("Save Supplier")
                                    }}</button>
                        </div>
                    </div>

                    <p v-html="server_errors" v-bind:class="[error_class]"></p>
                    <div class="mb-2 background_set">
                        <span class="text-subhead">Basic Information</span>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col-sm-12 col-md-10 col-lg-4">
                            <label for="supplier_id">{{ $t("Supplier/Vendor ID") }}</label><span style="color:red">*</span>
                            <input type="text" name="Supplier/Vendor ID" v-model="supplier_id" v-validate="'required|max:250'"
                                class="form-control form-control-custom" :placeholder="$t('Please Enter Supplier/Vendor ID')"
                                autocomplete="off">
                            <span v-bind:class="{ 'error': errors.has('Supplier/Vendor ID') }">{{ errors.first('Supplier/Vendor ID')
                            }}</span>
                        </div>
                        <div class="form-group col-sm-12 col-md-10 col-lg-4">
                            <label for="supplier_name">{{ $t("Supplier Name") }}</label><span style="color:red">*</span>
                            <input type="text" name="supplier_name" v-model="supplier_name" v-validate="'required|max:250'"
                                class="form-control form-control-custom" :placeholder="$t('Please enter supplier name')"
                                autocomplete="off">
                            <span v-bind:class="{ 'error': errors.has('supplier_name') }">{{ errors.first('supplier_name')
                            }}</span>
                        </div>
                        <div class="form-group col-sm-12 col-md-10 col-lg-4">
                            <label for="email">{{ $t("Email") }}</label><span style="color:red">*</span>
                            <input type="text" name="email" v-model="email" v-validate="'email'"
                                class="form-control form-control-custom" :placeholder="$t('Please enter contact email')"
                                autocomplete="off">
                            <span v-bind:class="{ 'error': errors.has('email') }">{{ errors.first('email') }}</span>
                        </div>
                        <div class="form-group col-sm-12 col-md-10 col-lg-4">
                            <label for="phone">{{ $t("Contact No.") }}</label><span style="color:red">*</span>
                            <input type="text" name="phone" v-model="phone" v-validate="'min:10|max:15'"
                                class="form-control form-control-custom" :placeholder="$t('Please enter contact number')"
                                autocomplete="off">
                            <span v-bind:class="{ 'error': errors.has('phone') }">{{ errors.first('phone') }}</span>
                        </div>

                        <!-- <div class="form-group col-md-4">
                        <label for="gender">{{ $t("Gender") }}</label><span style="color:red">*</span>
                        <select name="status" v-model="gender" v-validate="'required'" class="form-control form-control-custom custom-select">
                            <option value="" selected disabled>Choose Gender..</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <span v-bind:class="{ 'error' : errors.has('gender') }">{{ errors.first('gender') }}</span> 
                        </div> -->
                        <!-- <div class="form-group col-sm-12 col-md-10 col-lg-4">
                            <label for="pincode">{{ $t("Pincode") }}</label><span style="color:red">*</span>
                            <input type="text" name="pincode" v-model="pincode" v-validate="'max:15'"
                                class="form-control form-control-custom" :placeholder="$t('Enter Pincode')">
                            <span v-bind:class="{ 'error': errors.has('pincode') }">{{ errors.first('pincode') }}</span>
                        </div> -->
                        <div class="form-group col-sm-12 col-md-10 col-lg-4">
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
                        <div class="form-group col-sm-12 col-md-10 col-lg-4">
                            <label for="supplier_description">{{ $t("Supplier Descriptions") }}</label>
                            <textarea row="1" name="supplier_description" v-model="supplier_description" 
                                class="form-control form-control-custom" :placeholder="$t('Please Enter Supplier Description')"></textarea>
                        </div>
                        <div class="form-group col-sm-12 col-md-10 col-lg-4">
                            <label for="supplier_strn">{{ $t("Supplier STRN") }}</label>
                            <input type="text" name="supplier_strn" v-model="supplier_strn" 
                                class="form-control form-control-custom" :placeholder="$t('Please Enter Supplier STRN')" />
                        </div>
                        <div class="form-group col-sm-12 col-md-10 col-lg-4">
                            <label for="supplier_ntn">{{ $t("Supplier NTN") }}</label>
                            <input type="text" name="supplier_ntn" v-model="supplier_ntn" 
                                class="form-control form-control-custom" :placeholder="$t('Please Enter Supplier NTN')" />
                        </div>
                        <div class="form-group col-sm-12 col-md-10 col-lg-6">
                            <label>{{ $t("Supplier Business Type") }}</label>
                            <div>
                            <input type="checkbox" id="Manufacturer" value="Manufacturer" v-model="businessTypes">
                            <label for="Manufacturer">Manufacturer</label>
                            </div>
                            <div>
                            <input type="checkbox" id="Distributor" value="Distributor" v-model="businessTypes">
                            <label for="Distributor">Distributor</label>
                            </div>
                            <div>
                            <input type="checkbox" id="Reseller" value="Reseller" v-model="businessTypes">
                            <label for="Reseller">Reseller</label>
                            </div>
                            <div>
                            <input type="checkbox" id="Partner" value="Partner" v-model="businessTypes">
                            <label for="Partner">Partner</label>
                            </div>
                            <div>
                            <input type="checkbox" id="Importer" value="Importer" v-model="businessTypes">
                            <label for="Importer">Importer</label>
                            </div>
                            <div>
                            <input type="checkbox" id="Shop" value="Shop" v-model="businessTypes">
                            <label for="Shop">Shop</label>
                            </div>
                            <div>
                            <input type="checkbox" id="Online Store" value="Online Store" v-model="businessTypes">
                            <label for="Online Store">Online Store</label>
                            </div>
                            <div>
                            <input type="checkbox" id="Other" value="Other" v-model="businessTypes">
                            <label for="Other">Other</label>
                            </div>
                        </div>
                       
                    </div>
                    <div class="mb-2 background_set">
                        <span class="text-subhead">Address Information</span>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col-sm-12 col-md-10 col-lg-4">
                            <label for="country">{{ $t("Country") }}</label>
                            <input type="text" name="country" v-model="country"
                                class="form-control form-control-custom" :placeholder="$t('Enter Country')">
                            <span v-bind:class="{ 'error': errors.has('country') }">{{ errors.first('country') }}</span>
                        </div>
                        <div class="form-group col-sm-12 col-md-10 col-lg-4">
                            <label for="city">{{ $t("City") }}</label>
                            <input type="text" name="city" v-model="city"
                                class="form-control form-control-custom" :placeholder="$t('Enter City')">
                            <span v-bind:class="{ 'error': errors.has('city') }">{{ errors.first('city') }}</span>
                        </div>
                        <div class="form-group col-sm-12 col-md-10 col-lg-4">
                            <label for="address">{{ $t("Address") }}</label><span style="color:red">*</span>
                            <textarea name="address" v-model="address" v-validate="'max:65535'"
                                class="form-control form-control-custom" rows="1"
                                :placeholder="$t('Enter Address')"></textarea>
                            <span v-bind:class="{ 'error': errors.has('address') }">{{ errors.first('address') }}</span>
                        </div>                        
                    </div>

                    <div class="mb-2 background_set">
                        <span class="text-subhead">Bank Details</span>
                    </div>
                    <div id="main_dev">
                    <div v-for="(bank, index) in banks" :key="index" class="form-row mb-2">
                    <div class="form-group col-sm-12 col-md-10 col-lg-4">
                        <label :for="`Bank Name ${index}`">{{ $t("Bank Name") }}</label>
                        <input
                        :name="`Bank Name ${index}`"
                        v-model="bank.bank_name"
                        class="form-control form-control-custom"
                        :placeholder="$t('Enter Bank Name')"
                        />
                        <span :class="{ 'error': errors.has(`Bank Name ${index}`) }">{{ errors.first(`Bank Name ${index}`) }}</span>
                    </div>
                    <div class="form-group col-sm-12 col-md-10 col-lg-4">
                        <label :for="`Account Title ${index}`">{{ $t("Account Title") }}</label>
                        <input
                        :name="`Account Title ${index}`"
                        v-model="bank.account_title"
                        class="form-control form-control-custom"
                        :placeholder="$t('Enter Account Title')"
                        />
                        <span :class="{ 'error': errors.has(`Account Title ${index}`) }">{{ errors.first(`Account Title ${index}`) }}</span>
                    </div>
                    <div class="form-group col-sm-12 col-md-10 col-lg-4">
                        <label :for="`Account Number ${index}`">{{ $t("Account Number") }}</label>
                        <input
                        :name="`Account Number ${index}`"
                        v-model="bank.account_number"
                        class="form-control form-control-custom"
                        :placeholder="$t('Enter Account Number')"
                        />
                        <span :class="{ 'error': errors.has(`Account Number ${index}`) }">{{ errors.first(`Account Number ${index}`) }}</span>
                    </div>
                    <div class="form-group col-sm-12 col-md-10 col-lg-4">
                        <label :for="`IBAN Number ${index}`">{{ $t("IBAN Number") }}</label>
                        <input
                        :name="`IBAN Number ${index}`"
                        v-model="bank.iban_number"
                        class="form-control form-control-custom"
                        :placeholder="$t('Enter IBAN Number')"
                        />
                        <span :class="{ 'error': errors.has(`IBAN Number ${index}`) }">{{ errors.first(`IBAN Number ${index}`) }}</span>
                    </div>
                    <div class="form-group col-sm-12 col-md-10 col-lg-4">
                        <label :for="`Branch Code ${index}`">{{ $t("Branch Code") }}</label>
                        <input
                        :name="`Branch Code ${index}`"
                        v-model="bank.branch_code"
                        class="form-control form-control-custom"
                        :placeholder="$t('Enter Branch Code')"
                        />
                        <span :class="{ 'error': errors.has(`Branch Code ${index}`) }">{{ errors.first(`Branch Code ${index}`) }}</span>
                    </div>
                    
                    </div>
                    <div class="w-100 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary mr-5 mb-2" @click="addFormRow">Add More Accounts</button>
                    </div>
                </div>

                <div class="mb-2 background_set">
                    <span class="text-subhead">Contact Persons</span>
                </div>
                <div id="main_2dev">
                    <div v-for="(person, index) in contact_persons" :key="index" class="form-row mb-2">
                        <div class="form-group col-sm-12 col-md-10 col-lg-4">
                        <label :for="`position ${index}`">{{ $t("Job Post") }}</label>
                        <select :name="`position ${index}`" v-model="person.position"
                                class="form-control form-control-custom custom-select">
                                <option selected disabled>Choose Employer Post..</option>
                                <option value="Sales Person">Sales Person</option>
                                <option value="Accountant">Accountant</option>
                                <option value="Point of Content">Point of Contact</option>
                                <option value="Other">Other</option>                                
                            </select>
                        <span :class="{ 'error': errors.has(`position ${index}`) }">{{ errors.first(`position ${index}`) }}</span>
                      </div>

                      <div class="form-group col-sm-12 col-md-10 col-lg-4">
                        <label :for="`Name ${index}`">{{ $t("Name") }}</label>
                        <input
                        :name="`Name ${index}`"
                        v-model="person.name"
                        class="form-control form-control-custom"
                        :placeholder="$t('Enter Name')"
                        />
                        <span :class="{ 'error': errors.has(`Name ${index}`) }">{{ errors.first(`Name ${index}`) }}</span>
                      </div>
                      <div class="form-group col-sm-12 col-md-10 col-lg-4">
                        <label :for="`Email ${index}`">{{ $t("Email") }}</label>
                        <input
                        :name="`Email ${index}`"
                        v-model="person.email"
                        class="form-control form-control-custom"
                        :placeholder="$t('Enter Email')"
                        />
                        <span :class="{ 'error': errors.has(`Email ${index}`) }">{{ errors.first(`Email ${index}`) }}</span>
                      </div>
                      <div class="form-group col-sm-12 col-md-10 col-lg-4">
                        <label :for="`Mobile ${index}`">{{ $t("Mobile") }}</label>
                        <input
                        :name="`Mobile ${index}`"
                        v-model="person.mobile"
                        class="form-control form-control-custom"
                        :placeholder="$t('Enter Mobile')"
                        />
                        <span :class="{ 'error': errors.has(`Mobile ${index}`) }">{{ errors.first(`Mobile ${index}`) }}</span>
                      </div>
                    </div>
                    <div class="w-100 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary mr-5 mb-2" @click="addContactPerson">Add More Persons</button>
                    </div>
                </div>

                </form>

            </div>

            <modalcomponent v-if="show_modal" v-on:close="show_modal = false">
                <template v-slot:modal-header>
                    {{ $t("Confirm") }}
                </template>
                <template v-slot:modal-body>
                    <p v-if="status == 0">If supplier is inactive all the products with this supplier will get affected.</p>
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

export default {
    data() {
        return {
            banks: (this.supplier_data == null) ? 
            [
        {
          bank_name: "",
          account_title: "",
          account_number: "",
          iban_number: "",
          branch_code: ""         
        },
      ]
            : this.supplier_data.banks,
            contact_persons: (this.supplier_data == null) ? [
                {
                    position: "",
                    name: "",
                    email: "",
                    mobile: "",
                }
            ] : this.supplier_data.contact_people,
            businessTypes: [],
            businessTypesOptions: [],
            server_errors: "",
            error_class: "",
            processing: false,
            modal: false,
            show_modal: false,
            api_link: (this.supplier_data == null) ? '/api/add_supplier' : '/api/update_supplier/' + this.supplier_data.slack,

            supplier_slack: (this.supplier_data == null) ? "" : this.supplier_data.slack,
            supplier_id: (this.supplier_data == null) ? "" : this.supplier_data.supplier_code,
            supplier_name: (this.supplier_data == null) ? "" : this.supplier_data.name,
            status: (this.supplier_data == null) ? "" : (this.supplier_data.status == null) ? '' : this.supplier_data.status.value,
            address: (this.supplier_data == null) ? [] : this.supplier_data.address,
            city: (this.supplier_data == null) ? [] : this.supplier_data.city,
            country: (this.supplier_data == null) ? [] : this.supplier_data.country,
            gender: '',
            phone: (this.supplier_data == null) ? [] : this.supplier_data.phone,
            email: (this.supplier_data == null) ? [] : this.supplier_data.email,
            pincode: (this.supplier_data == null) ? [] : this.supplier_data.pincode,
            supplier_description: (this.supplier_data == null) ? '' : this.supplier_data.supplier_description,
            supplier_strn: (this.supplier_data == null) ? '': this.supplier_data.supplier_strn,
            supplier_ntn: (this.supplier_data == null) ? '' : this.supplier_data.supplier_ntn,
        }
    },
    props: {
        statuses: Array,
        supplier_data: [Array, Object]
    },
    mounted() {
        console.log('Add supplier page loaded');
        if(this.supplier_data != null && this.supplier_data.business_type.length > 0){
           // Assuming this.supplier_data is the array of business types fetched from the server
            this.businessTypesOptions = this.supplier_data.business_type.map(item => item.business_type);

            // Set initial selected values based on the received data
            this.businessTypes = this.supplier_data.business_type.map(item => item.business_type);
        }
    },
    methods: {
        addFormRow() {
      this.banks.push({
        bank_name: "",
        account_title: "",
        account_number: "",
        iban_number: "",
         branch_code: ""       
      });
    },
    addContactPerson(){
        this.contact_persons.push({
            position: "",
            name: "",
            email: "",
            mobile: ""
        });
    },
        submit_form() {
            this.$validator.validateAll().then((result) => {
                if (result) {
                    this.show_modal = true;
                    this.$on("submit", function () {


                        // this.processing = true;

                        const banks = JSON.stringify(this.banks);
                        const persons = JSON.stringify(this.contact_persons);

                        var formData = new FormData();

                        formData.append("access_token", window.settings.access_token);
                        formData.append("supplier_name", (this.supplier_name == null) ? '' : this.supplier_name);
                        formData.append("supplier_id", (this.supplier_id == null) ? '' : this.supplier_id);
                        formData.append("address", (this.address == null) ? '' : this.address);
                        formData.append("country", (this.address == null) ? '' : this.country);
                        formData.append("city", (this.address == null) ? '' : this.city);
                        formData.append("gender", (this.address == null) ? '' : this.gender);
                        formData.append("phone", (this.phone == null) ? '' : this.phone);
                        formData.append("email", (this.email == null) ? '' : this.email);
                        formData.append("pincode", (this.pincode == null) ? '' : this.pincode);
                        formData.append("status", (this.status == null) ? '' : this.status);
                        formData.append("supplier_description", (this.supplier_description == null) ? '' : this.supplier_description);
                        formData.append("supplier_strn", (this.supplier_strn == null) ? '' : this.supplier_strn);
                        formData.append("supplier_ntn", (this.supplier_ntn == null) ? '' : this.supplier_ntn);
                        formData.append("banks", banks);
                        formData.append('businessTypes', JSON.stringify(this.businessTypes));
                        formData.append('contact_people', persons);


                        axios.post(this.api_link, formData).then((response) => {

                            if (response.data.status_code == 200) {
                                this.show_response_message(response.data.msg, 'Success');

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
                                this.error_class = 'error';
                            }
                        })
                            .catch((error) => {
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
        }
    }
}
</script>

<style scoped>
.mb-2, .my-2{
    margin-bottom: 0.5rem!important;
    margin-right: 10px;
    margin-left: 10px;
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