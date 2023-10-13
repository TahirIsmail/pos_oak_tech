<template>
    <div class="row">
        
        <div class="col-md-12">
            <div class="d-flex flex-wrap mb-4">
                <div class="mr-auto">
                   <div class="d-flex">
                        <div>
                            <span class="text-title"> <span class='text-muted'>{{ $t("Category") }}</span> {{ category.label }} ({{ category.category_code }}) </span>
                        </div>
                    </div>
                </div>
                <div class="">
                    <span v-bind:class="category.status.color">{{ category.status.label }}</span>
                </div>
            </div>            
            <div class="d-flex flex-wrap mb-4">
                <p v-html="server_errors" v-bind:class="[error_class]"></p>
                <div class="ml-auto">
                    <button type="submit" class="btn btn-info mr-1" v-on:click="add_category_company()" v-bind:disabled="add_category_company_processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="add_category_company_processing == true"></i> {{ $t("Add Category Company") }}</button>
                    <button type="submit" class="btn btn-info mr-1" v-on:click="add_product_name()" v-bind:disabled="add_product_name_processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="add_product_name_processing == true"></i> {{ $t("Add Product Name") }}</button>
                    <button type="submit" class="btn btn-info mr-1" v-on:click="add_category_specifications()" v-bind:disabled="add_category_specifications_processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="add_category_specifications_processing == true"></i> {{ $t("Add Category Specifications") }}</button>
                    <button type="submit" class="btn btn-danger mr-1" v-if="delete_access == true" v-on:click="delete_category()" v-bind:disabled="delete_processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="delete_processing == true"></i> {{ $t("Delete Category") }}</button>
                </div>
            </div>
            <hr>

            <div class="mb-2">
                <span class="text-subhead">{{ $t("Basic Information") }}</span>
            </div>
            <div class="form-row mb-2">
                <div class="form-group col-md-4">
                    <label for="category_code">{{ $t("Category Code") }}</label>
                    <p>{{ category.category_code  }}</p>
                </div>
                <div class="form-group col-md-4">
                    <label for="label">{{ $t("Category Name") }}</label>
                    <p>{{ category.label }}</p>
                </div>

                <div class="form-group col-md-4">
                    <label for="label">{{ $t("Sub Category Name") }}</label>
                    <p style="font-weight: 600;" v-for="cate in category.subcategories" :key="cate.id">{{ cate.sub_category_name }}</p>
                </div>

                <div class="form-group col-md-11" v-if="category.subcategories.length > 1">
                    <label for="label" style="font-weight: 800;font-size:18px;">{{ $t("Companies Name") }}</label>
                    <div class="">
                        <div v-for="category in category.subcategories" :key="category.id">
                            <div style="list-style: none;"><span style="font-weight: bold;">{{ category.sub_category_name }}</span>
                            <div class="d-flex flex-wrap justify-content-between w-100">
                            <div v-for="(companies, index) in category.category_companies" :key="companies.id">
                            {{ companies.category_company_name }}
                            {{ index < category.category_companies.length - 1 ? ',' : '' }}
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-11" v-else>
                    <label for="label">{{ $t("Companies Name") }}</label>
                    <div class="d-flex flex-wrap justify-content-between w-100">
                        <div v-for="(company, index) in category.category_companies" :key="company.id">
                            {{ company.category_company_name }}

                            {{ index < category.category_companies.length - 1 ? ',' : '' }}
                        </div>

                    </div>
                </div>


                <br />


                <div class="form-group col-md-11" v-if="category.subcategories.length > 1">
                    <label for="label" style="font-weight: 800;font-size:18px;">{{ $t("Product Name") }}</label>
                    <div class="">
                        <div v-for="category in category.subcategories" :key="category.id">
                            <div style="list-style: none;"><span style="font-weight: bold;">{{ category.sub_category_name }}</span>
                            <div class="d-flex flex-wrap justify-content-between w-100">
                            <div v-for="(product_name, index) in category.product_names" :key="product_name.id">
                                {{ product_name.product_name }}
                                {{ index < category.product_names.length - 1 ? ', ' : '' }}
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-11" v-else>
                    <label for="label">{{ $t("Product Name") }}</label>
                    <div class="d-flex flex-wrap justify-content-between w-75">
                        <div v-for="(product_name) in category.product_names" :key="product_name.id">
                                {{ product_name.product_name }}
                            </div>

                    </div>
                </div>


                <br />


                <div class="form-group col-md-3">
                    <label for="created_on">{{ $t("Created On") }}</label>
                    <p>{{ category.created_at }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="updated_on">{{ $t("Updated On") }}</label>
                    <p>{{ category.updated_at }}</p>
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label for="description">{{ $t("Description") }}</label>
                    <p>{{ (category.description)?category.description:'-' }}</p>
                </div>
            </div>

        </div>

        <modalcomponent v-if="show_modal_add_category" v-on:close="show_modal_add_category = false" :modal_width="'modal-container-md'">
            <template v-slot:modal-header>
                {{ $t("Add Category Company Name") }}
            </template>
            <template v-slot:modal-body>
                <!-- <form @submit.prevent="" class="mb-3"> -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-row mb-2">
                                <div class="form-group col-md-10 mx-auto">
                                    <input type="text" v-model="category_name" class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-10 mx-auto">
                                    <select id="sub_category_id" v-model="sub_category_id" class="form-control">
                                        <option value="" disabled>Select Sub Category</option>
                                        <option v-for="s_category in category.subcategories" :key="s_category.id" :value="s_category.id">{{ s_category.sub_category_name }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-10 mx-auto">
                                    <input type="text" id="category_company_name" name="Company Name" v-model="category_company_name" v-validate="'required'" class="form-control" placeholder="Enter Company Name">
                                     <span v-bind:class="{ 'error' : errors.has('Company Name') }">{{ errors.first('Company Name') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
               <!-- </form> -->
            </template>
            <template v-slot:modal-footer>
                <!-- <button type="button" class="btn btn-light" @click="$emit('close')">Cancel</button> -->
                <button type="button" @click="submit_category_company" class="btn btn-primary" v-bind:disabled="processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="processing == true"></i> Add Company Name</button>
            </template>
        </modalcomponent>


        <modalcomponent v-if="show_modal_product_name" v-on:close="show_modal_product_name = false" :modal_width="'modal-container-md'">
            <template v-slot:modal-header>
                {{ $t("Add Category Company Name") }}
            </template>
            <template v-slot:modal-body>
                <!-- <form @submit.prevent="" class="mb-3"> -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-row mb-2">
                                <div class="form-group col-md-10 mx-auto">
                                    <input type="text" v-model="category_name" class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-10 mx-auto">
                                    <select id="sub_category_id" v-model="sub_category_id" class="form-control">
                                        <option value="" disabled>Select Sub Category</option>
                                        <option v-for="s_category in category.subcategories" :key="s_category.id" :value="s_category.id">{{ s_category.sub_category_name }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-10 mx-auto">
                                    <input type="text" id="category_product_name" name="Product Name" v-model="category_product_name" v-validate="'required'" class="form-control" placeholder="Enter Product Name">
                                     <span v-bind:class="{ 'error' : errors.has('Product Name') }">{{ errors.first('Product Name') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
               <!-- </form> -->
            </template>
            <template v-slot:modal-footer>
                <!-- <button type="button" class="btn btn-light" @click="$emit('close')">Cancel</button> -->
                <button type="button" @click="submit_product_name" class="btn btn-primary" v-bind:disabled="processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="processing == true"></i> Add Company Name</button>
            </template>
        </modalcomponent>



        <modalcomponent v-if="show_modal_category_specification" v-on:close="show_modal_category_specification = false" :modal_width="'modal-container-md'">
            <template v-slot:modal-header>
                {{ $t("Add Category Specifications Name") }}
            </template>
            <template v-slot:modal-body>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-row mb-2">
                                <div class="form-group col-md-10 mx-auto">
                                    <input type="text" v-model="category_name" class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-10 mx-auto">
                                    <select id="sub_category_id" v-model="sub_category_id" class="form-control">
                                        <option value="" disabled>Select Sub Category</option>
                                        <option v-for="s_category in category.subcategories" :key="s_category.id" :value="s_category.id">{{ s_category.sub_category_name }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-10 mx-auto">
                                    <vue-tags-input v-model="tag" :tags="tags" @tags-changed="handleTagsChanged" placeholder="Add Category Specifications" />
                                    
                                </div>
                            </div>
                        </div>
                    </div>
            </template>
            <template v-slot:modal-footer>
                <button type="button" @click="submit_categorSpecifications" class="btn btn-primary" v-bind:disabled="processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="processing == true"></i> Add Category Specifications</button>
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
    import VueTagsInput from "@johmun/vue-tags-input";
    
    export default {
        data(){
            return{
                category : this.category_data,
                display_on_pos_screen : (this.category_data.display_on_pos_screen == 1)?'Yes':'No',
                display_on_qr_menu : (this.category_data.display_on_qr_menu == 1)?'Yes':'No',
                category_id: this.category_data.id,
                sub_category_id: '',
                category_product_name: '',
                show_modal_add_category:false,
                category_name: this.category_data.label,
                processing: false,
                delete_processing: false,
                add_category_company_processing: false,
                add_product_name_processing: false,
                add_category_specifications_processing: false,
                show_modal: false,
                show_modal_product_name:false,
                show_modal_category_specification:false,
                server_errors:'',
                tag: '',
                tags: [],
                delete_category_api_link: '/api/delete_category/'+this.category_data.slack,
                category_specification: '/api/categorySpecifications'
            }
        },
        props: {
            category_data: [Array, Object],
            delete_access: Boolean,
        },
        mounted() {
            console.log('Category detail page loaded');
        },
        methods: {
            handleTagsChanged(newTags) {
      this.tags = newTags.map(tag => tag.text);
    },
            add_category_specifications(){
                this.show_modal_category_specification = true;
            },

            
            add_category_company(){
               
                this.show_modal_add_category = true;
            },
            add_product_name(){
                this.show_modal_product_name = true;
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
            submit_category_company(){
                this.$validator.validateAll().then((result) => {
                if (result) {
                this.$off("submit");
                this.$off("close");
                this.show_modal = true;
                this.$on("submit",function () {      

                    var formData = new FormData();
                    formData.append("access_token", window.settings.access_token);
                    formData.append("category_id", this.category_id);
                    formData.append("sub_category_id", (this.sub_category_id ? this.sub_category_id : null));
                    formData.append("category_company_name", this.category_company_name);

                    console.log(...formData);

                    axios.post('/api/submit_category_company', formData).then((response) => {

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
            submit_product_name(){
                this.$validator.validateAll().then((result) => {
                if (result) {
                this.$off("submit");
                this.$off("close");
                this.show_modal = true;
                this.$on("submit",function () {      

                    var formData = new FormData();
                    formData.append("access_token", window.settings.access_token);
                    formData.append("category_id", this.category_id);
                    formData.append("sub_category_id", (this.sub_category_id ? this.sub_category_id : null));
                    formData.append("category_product_name", this.category_product_name);


                    axios.post('/api/submit_product_name', formData).then((response) => {

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



            submit_categorSpecifications(){
               
                this.$off("submit");
                this.$off("close");
                this.show_modal = true;
                this.$on("submit",function () {      

                    var formData = new FormData();
                    formData.append("access_token", window.settings.access_token);
                    formData.append("category_id", this.category_id);
                    formData.append("sub_category_id", (this.sub_category_id ? this.sub_category_id : null));
                    formData.append("category_specification[]", this.tags);

                    axios.post('/api/categorySpecifications', formData).then((response) => {

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

                            })
                            .catch((error) => {
                            console.log(error);
                            });
                });
                this.$on("close",function () {
                    this.show_modal = false;
                });
            
            },


            


        }
    }
</script>
