<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
            
            <form @submit.prevent="submit_form" class="mb-3">

                <div class="card-header d-flex flex-wrap mb-4">
                    <div class="mr-auto">
                        <span class="text-title">{{ $t("Product Import Data") }}</span>
                    </div>
                    <div class="d-flex">
                        
                        <button class="btn btn-outline-primary mr-1" type="button" v-on:click="download_reference_sheet()" v-bind:disabled="reference_processing == true"> 
                            <i class='fa fa-circle-notch fa-spin'  v-if="reference_processing == true"></i>
                            {{ $t("Download Reference Sheet") }}
                        </button>

                        <div class="dropdown mr-1" v-if="fixed_category">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $t("Download Template") }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown">
                                <a
                                    class="dropdown-item"
                                    @click.prevent="downloadCategoryTemplate"
                                >
                                    {{ getCategoryLabel(fixed_category) }} {{ $t("Template") }}
                                </a>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" v-bind:disabled="processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="processing == true"></i> {{ $t("Upload & Save") }}</button>
                    </div>
                </div>
                    
                <p v-html="server_errors" v-bind:class="[error_class]"></p>

                <div class="form-row mb-2">
                    <div class="form-group col-md-3">
                        <label for="upload_type">{{ $t("Type of Upload") }}</label>
                         <select name="upload_type" v-model="upload_type" v-validate="'required'" class="form-control form-control-custom custom-select">
                            <option value="">Choose Type of Upload..</option>
                            <option v-for="(upload_option, index) in upload_options" v-bind:value="upload_option.key" v-bind:key="index">
                                {{ upload_option.value }}
                            </option>
                        </select>
                        <span v-bind:class="{ 'error' : errors.has('upload_type') }">{{ errors.first('upload_type') }}</span> 
                    </div>
                    
                </div>

                 <div v-if="upload_type === 'PRODUCT'" class="form-row mb-2">
                        <div class="form-group col-md-3">
                            <label>{{ $t("Supplier") }}</label>
                            <select v-model="fixed_supplier" class="form-control form-control-custom custom-select" required>
                                <option value="">Choose Supplier..</option>
                                <option v-for="(supplier, index) in suppliers" :value="supplier.slack" :key="index">
                                    {{ supplier.name }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>{{ $t("Category") }}</label>
                            <select v-model="fixed_category" class="form-control form-control-custom custom-select" required>
                                <option value="">Select Category...</option>
                                <option v-for="(category, index) in categories" :value="category.id" :key="index">
                                    {{ category.label }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>{{ $t("Sub Category") }}</label>
                            <select v-model="fixed_sub_category" class="form-control form-control-custom custom-select" required>
                                <option value="">Select Sub Category...</option>
                                <option v-for="(sub, index) in filteredSubCategories" :value="sub.id" :key="index">
                                    {{ sub.sub_category_name }}
                                </option>
                            </select>
                        </div>

                        <div class="form-group col-md-3" v-if="childCategories.length > 0">
                        <label for="child_category_id">{{ $t("Child Category") }}</label>
                        <select name="Child Category" v-model="child_category_id" class="form-control form-control-custom custom-select">
                            <option value="" disabled>Select Child Category...</option>
                            <option v-for="childcategory in childCategories" :key="childcategory.id" :value="childcategory.id">
                            {{ childcategory.child_category }}
                            </option>
                        </select>
                        </div>
                       
                        <div class="form-row mb-2" v-if="category_specifications.length > 0">
                            <div class="form-group col-md-3" v-for="spec in category_specifications" :key="spec.id">
                            <label :for="spec.category_specification_label">{{ spec.category_specification_label }}</label>
                            <input :type="(spec.category_specification_label == 'Quantity') ? 'number' : 'text'"
                                v-if="spec.category_specification_details.length == 0"
                                v-model="input_type[spec.category_specification_label]" class="form-control"
                                @change="add_product_name()">
                            <select v-else v-model="input_type[spec.category_specification_label]"
                                class="form-control form-control-custom custom-select" @change="add_product_name()">
                                <option selected disabled>Please Select {{ spec.category_specification_label }}</option>
                                <option v-for="details in spec.category_specification_details" :key="details.id" :value="details.id">{{
                                details.values }}</option>
                            </select>
                            </div>
                        </div>
                         <div class="form-group col-md-3">
                            <label for="upload_file">{{ $t("Product Import File") }}</label>
                            <input type="file" name="upload_file" ref="upload_file" v-on:change="on_file_select" class="form-control-file" v-validate="'required|ext:xls,xlsx,csv'">
                            <span v-bind:class="{ 'error' : errors.has('upload_file') }">{{ errors.first('upload_file') }}</span> 
                        </div>
                        <!-- Add more dependency fields as needed -->
                </div>
            </form>

            <div v-if="import_errors.length!=0">
                <p class="error">There are some errors in the file. Please correct the following errors and upload the file again.</p>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Row Number</th>
                            <th scope="col">Errors</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(import_error, index) in import_errors" :key="index">
                            <th scope="row">{{ index }}</th>
                            <td class="table-danger">
                                <div class="" v-for="(error, index) in import_error" :key="index">{{ error }}</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
                <button type="button" class="btn btn-light" @click="$emit('close')">Cancel</button>
                <button type="button" class="btn btn-primary" @click="$emit('submit')" v-bind:disabled="processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="processing == true"></i> Continue</button>
            </template>
        </modalcomponent>
    </div>
    </div>
</template>

<script>
    'use strict';
    import { CoolSelect } from "vue-cool-select";
import "vue-cool-select/dist/themes/bootstrap.css";

import Multiselect from "vue-multiselect";
import "vue-multiselect/dist/vue-multiselect.min.css";
    export default {
    components: { Multiselect },
        data(){
            return{
                server_errors   : '',
                error_class     : '',
                processing      : false,
                modal           : false,
                show_modal      : false,
                reference_processing : false,
                api_link        : '/api/update_data',
                reference_sheet_api_link : 'api/download_reference_sheet',

                upload_type     : '',
                upload_file     : '',

                import_errors   : [],
                fixed_supplier: '',
                fixed_category: '',
                fixed_sub_category: '',
                suppliers: [], // Load these from API or props
                categories: [],
                subCategories: [],
                childCategories: [],
                child_category_id: '',
                category_specifications: [],
                companies_name: [],
                product_names: [],
                categoryLabel: '',
                companyNameLabel: '',
                input_type: {},
                quantity_from_spec: false,
                quantity: '',
                product_name: '',
            }
        },
        props: {
            upload_options: Array,
            templates: Array,
            categories: Array,
            suppliers: Array,
        },
        computed: {
    filteredSubCategories() {
        return this.subCategories.filter(sub => sub.sub_category_name !== 'Accessories');
    }
    },
        watch: {
        fixed_category(newVal) {
      // ...existing code for subCategories...
      const selectedCategory = this.categories.find(cat => cat.id === newVal);
      if (selectedCategory && selectedCategory.subcategories) {
        this.subCategories = selectedCategory.subcategories;
      } else {
        this.subCategories = [];
      }
      this.fixed_sub_category = '';
      this.childCategories = [];
      this.child_category_id = '';
      this.category_specifications = [];
      
    },
    fixed_sub_category(newVal) {
      // Fetch child categories and specifications when subcategory changes
      if (newVal) {
        this.fetchChildCategoriesAndSpecs(newVal);
      } else {
        this.childCategories = [];
        this.child_category_id = '';
        this.category_specifications = [];
      }
    },
    child_category_id(newVal) {
      // Fetch specifications when child category changes
      if (newVal) {
        this.fetchCategorySpecifications(newVal);
      } else {
        this.category_specifications = [];
      }
    }
        },
        mounted() {
            console.log('Upload data page loaded');
        },
        methods: {
            on_file_select(){
                this.upload_file = this.$refs.upload_file.files[0];
            },
            fetchChildCategoriesAndSpecs(sub_category_id) {
      // Fetch child categories and specifications for the selected subcategory
      var formData = new FormData();
      formData.append("access_token", window.settings.access_token);
      formData.append("sub_category_id", sub_category_id);
      axios
        .post("/api/fetchCompanies", formData)
        .then((response) => {
          if (response.data.status_code == 200) {
            this.childCategories = response.data.data.child_categories || [];
            this.category_specifications = response.data.data.specifications || [];
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    fetchCategorySpecifications(child_category_id) {
      // Fetch specifications for the selected child category
      var formData = new FormData();
      formData.append("access_token", window.settings.access_token);
      formData.append("child_category_id", child_category_id);
      axios
        .post("/api/fetchCategorySpecifications", formData)
        .then((response) => {
          if (response.data.status_code == 200) {
            this.category_specifications = response.data.data.specifications || [];
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    setProductName() {

      const selectedCompany = this.companies_name.find(company => company.id === this.company_id);
      if (selectedCompany) {
        this.companyNameLabel = selectedCompany.category_company_name;
      }

      if (this.categoryLabel != null && this.companyNameLabel != null && this.product_names.length === 0) {
        this.product_name = this.companyNameLabel + ',' + this.categoryLabel;
      };
    },

    add_product_name() {
      if (this.input_type["Product Name"]) {
        this.product_name = this.input_type["Product Name"];
      }
      if (this.input_type["Quantity"]) {

        this.quantity_from_spec = true;
        this.quantity = this.input_type["Quantity"];
      }
    },
    getCategoryLabel(categoryId) {
        const cat = this.categories.find(c => c.id === categoryId);
        return cat ? cat.label : '';
    },
    downloadCategoryTemplate() {
        // You can use a mapping or API endpoint that returns the template for the selected category
        // Example: /api/download_template?category_id=...
        const categoryId = this.fixed_category;
        if (!categoryId) return;
        this.reference_processing = true;
        var formData = new FormData();
        formData.append("access_token", window.settings.access_token);
        formData.append("category_id", categoryId);
        axios.post('/api/download_category_template', formData)
            .then((response) => {
                if (response.data.status_code == 200 && response.data.link) {
                    window.open(response.data.link, '_blank');
                } else {
                    this.server_errors = response.data.msg;
                    this.error_class = 'error';
                }
                this.reference_processing = false;
            })
            .catch((error) => {
                this.reference_processing = false;
                console.log(error);
            });
    },
            submit_form(){

                this.$off("submit");
                this.$off("close");

                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.show_modal = true;
                        this.$on("submit",function () {
                            
                            this.processing = true;
                            var formData = new FormData();

                            formData.append("access_token", window.settings.access_token);
                            formData.append("upload_type", this.upload_type);
                            formData.append("upload_file", this.upload_file);

                            axios.post(this.api_link, formData).then((response) => {
                                if(response.data.status_code == 200) {
                                    if(response.data.data.import_status){
                                        this.show_response_message(response.data.msg, 'Success');
                                
                                        setTimeout(function(){
                                            location.reload();
                                        }, 1000);
                                    }else{
                                        this.import_errors = response.data.data.errors;
                                        this.show_modal = false;
                                        this.processing = false;
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

            download_reference_sheet(){

                this.reference_processing = true; 

                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);

                axios.post(this.reference_sheet_api_link, formData).then((response) => {

                    if(response.data.status_code == 200) {
                        if(typeof response.data.link != 'undefined' && response.data.link != ""){
                            window.open(response.data.link, '_blank');
                        }else{
                            location.reload();
                        }
                    }else{
                        try{
                            var error_json = JSON.parse(response.data.msg);
                            this.loop_api_errors(error_json);
                        }catch(err){
                            this.server_errors = response.data.msg;
                        }
                        this.error_class = 'error';
                    }
                    this.reference_processing = false;
                })
                .catch((error) => {
                    console.log(error);
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
    border-radius: 0.25rem;
}

.form-row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -5px;
    margin-left: 15px;
}</style>