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
            <div class="form-row mb-2">
                <p v-html="server_errors" v-bind:class="[error_class]"></p>
                <div class="form-group col-md-4">
                    <button type="submit" class="btn btn-info mr-1 w-100" v-on:click="add_child_category()" v-bind:disabled="add_child_category_processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="add_child_category_processing == true"></i> {{ $t("Add Child Category") }}</button>
                </div>
                <div class="form-group col-md-4">
                    <button type="submit" class="btn btn-info mr-1 w-100" v-on:click="add_category_specifications()" v-bind:disabled="add_category_specifications_processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="add_category_specifications_processing == true"></i> {{ $t("Add Category Specifications") }}</button>
                </div>
                <div class="form-group col-md-4">
                    <button type="submit" class="btn btn-info mr-1 w-100" v-on:click="add_category_specification_details()" v-bind:disabled="add_category_specification_details_processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="add_category_specification_details_processing == true"></i> {{ $t("Add Specification Values") }}</button>
                </div>
            </div>
            <hr>

            <div class="mb-2">
                <span class="text-subhead">{{ $t("Basic Information") }}</span>
            </div>
            <div class="form-row mb-2">
                <div class="form-group col-md-2">
                    <label for="category_code">{{ $t("Category Code") }}</label>
                    <p>{{ category.category_code  }}</p>
                </div>
                <div class="form-group col-md-2">
                    <label for="label">{{ $t("Category Name") }}</label>
                    <p>{{ category.label }}</p>
                </div>

                <div class="form-group col-md-2">
                    <label for="label">{{ $t("Sub Category Name") }}</label>
                    <p style="font-weight: 600;" v-for="cate in category.subcategories" :key="cate.id">{{ cate.sub_category_name }}</p>
                </div>

                <div class="form-group col-md-2">
                    <label for="created_on">{{ $t("Created On") }}</label>
                    <p>{{ category.created_at }}</p>
                </div>
                <div class="form-group col-md-2">
                    <label for="updated_on">{{ $t("Updated On") }}</label>
                    <p>{{ category.updated_at }}</p>
                </div>
            
                <div class="form-group col-md-6">
                    <label for="description">{{ $t("Description") }}</label>
                    <p>{{ (category.description)?category.description:'-' }}</p>
                </div>
            </div>
            <div class="form-row mb-2">
                <div class="form-group col-md-3">
                    <select id="subCategoryId" v-validate="'required'" name="Sub Category" v-model="subCategoryId" class="form-control" @change="ViewChildCategoryF()">
                        <option value="" disabled>Select Sub Category</option>
                        <option v-for="s_category in category.subcategories" :key="s_category.id" :value="s_category.id">{{ s_category.sub_category_name }}</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <select id="childCategoryId" v-validate="'required'" name="Sub Category" v-model="childCategoryId" class="form-control" @change="ViewCategorySpecificationF()">
                        <option value="" disabled>Select Child Category</option>
                        <option v-for="c_category in ViewChildCategory" :key="c_category.id" :value="c_category.id">{{ c_category.child_category }}</option>

                    </select>
                </div>
                <div class="form-group col-md-3">
                    <select id="categorySpecificationId" v-validate="'required'" name="Sub Category" v-model="categorySpecificationId" class="form-control" @change="ViewSpecificationValuesF() ">
                        <option value="" disabled>Select Category Specifications</option>
                        <option v-for="c_specification in ViewCategorySpecification" :key="c_specification.id" :value="c_specification.id">{{ c_specification.category_specification_label }}</option>

                    </select>
                </div>
               
            </div>
            <div class="form-row mb-2">
                <div class="col-12" v-if="mainTable">
                    <table class="table">
                        <thead class="" style="background:#17a2b8;color:white;">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Category</th>
                            <th scope="col">Sub Category</th>
                            <th scope="col">Child Category</th>
                            <th scope="col">Category Specifications</th>
                            <th scope="col">Specification Values</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th colspan="7" class="text-center">Select From Option To View</th>                            
                            </tr>
                           
                        </tbody>
                    </table>

                </div>


                <div class="col-12" v-if="ViewChildCategoryStatus">
                    <table class="table">
                        <thead class="" style="background:#17a2b8;color:white;">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Child Category</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="child_category in ViewChildCategory" :key="child_category.id">
                                <td>{{ child_category.id }}</td>
                                <td 
                                :contenteditable="child_category.isEditable ? 'true' : 'false'"  
                                @input="onEditInput(child_category)"
                                @blur="save_in_table(child_category, child_category.id, 'child_category')"
                                >{{ child_category.child_category }}</td>
                                <td>Active</td>
                                <td><button class="btn" @click="toggleEdit(child_category)" >
                                    <i :class="{'fas fa-edit': !child_category.isEditable, 'fas fa-check': child_category.isEditable}"  style="color:green">
                                </i></button></td>
                            </tr>
                        </tbody>
                    </table>

                </div>


                <div class="col-12" v-if="ViewCategorySpecificationStatus">
                    <table class="table">
                        <thead class="" style="background:#17a2b8;color:white;">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Category Specification</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="spec in ViewCategorySpecification" :key="spec.id">
                                <td>{{ spec.id }}</td>
                                <td
                                :contenteditable="spec.isEditable ? 'true' : 'false'"
                                @input="onEditInput(spec)"
                                @blur="save_in_table(spec, spec.id, 'category_specification')"
                                >{{ spec.category_specification_label }}</td>
                                <td>Active</td>
                                <td><button class="btn" @click="toggleEdit(spec)" >
                                    <i :class="{'fas fa-edit': !spec.isEditable, 'fas fa-check': spec.isEditable}"  style="color:green">
                                </i></button></td>
                            </tr>
                        </tbody>
                    </table>

                </div>



                <div class="col-12" v-if="ViewSpecificationValuesStatus">
                    <table class="table">
                        <thead class="" style="background:#17a2b8;color:white;">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Specification Value</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="value in ViewSpecificationValues" :key="value.id">
                                <td>{{ value.id }}</td>
                                <td
                                :contenteditable="value.isEditable ? 'true' : 'false'"
                                @input="onEditInput(value)"
                                @blur="save_in_table(value, value.id, 'specification_value')"
                                
                                >{{ value.values }}</td>
                                <td>Active</td>
                                <td><button class="btn" @click="toggleEdit(value)" >
                                    <i :class="{'fas fa-edit': !value.isEditable, 'fas fa-check': value.isEditable}"  style="color:green">
                                </i></button></td>
                            </tr>
                        </tbody>
                    </table>

                </div>


            </div>

        </div>

        <modalcomponent v-if="show_modal_add_category" v-on:close="show_modal_add_category = false" :modal_width="'modal-container-md'">
            <template v-slot:modal-header>
                {{ $t("Add Child Category") }}
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
                                    <select id="sub_category_id" v-validate="'required'" name="Sub Category" v-model="sub_category_id" class="form-control">
                                        <option value="" disabled>Select Sub Category</option>
                                        <option v-for="s_category in category.subcategories" :key="s_category.id" :value="s_category.id">{{ s_category.sub_category_name }}</option>
                                    </select>
                                    <span v-bind:class="{ 'error' : errors.has('Sub Category') }">{{ errors.first('Sub Category') }}</span>
                                </div>
                                <div class="form-group col-md-10 mx-auto">
                                    <input type="text" id="child_category_name" v-validate="'required|min:3'" name="Child Category" v-model="child_category_name" class="form-control" placeholder="Enter Child Category">
                                     <span v-bind:class="{ 'error' : errors.has('Child Category') }">{{ errors.first('Child Category') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
               <!-- </form> -->
            </template>
            <template v-slot:modal-footer>
                <!-- <button type="button" class="btn btn-light" @click="$emit('close')">Cancel</button> -->
                <button type="button" @click="submit_child_category" class="btn btn-primary" v-bind:disabled="processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="processing == true"></i> Add Child Category</button>
            </template>
        </modalcomponent>


        <modalcomponent v-if="show_modal_specification_values" v-on:close="show_modal_specification_values = false" :modal_width="'modal-container-md'">
            <template v-slot:modal-header>
                {{ $t("Add Category Specification Values") }}
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
                                    <select id="sub_category_id" v-model="sub_category_id" class="form-control" @change="fetchChildCategories()">
                                        <option value="" disabled>Select Sub Category</option>
                                        <option v-for="s_category in category.subcategories" :key="s_category.id" :value="s_category.id">{{ s_category.sub_category_name }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-10 mx-auto">
                                    <select id="sub_category_id" v-model="child_category_id" class="form-control" @change="fetchCategoriesSpecifications()">
                                        <option value="" disabled>Select Child Category</option>
                                        <option v-for="c_category in child_categories" :key="c_category.id" :value="c_category.id">{{ c_category.child_category }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-10 mx-auto">
                                    <select id="sub_category_id" v-model="category_specification_id" class="form-control" name="Category Specification" v-validate="'required'">
                                        <option value="" disabled>Select Category Specifications</option>
                                        <option v-for="c_specification in CategorySpecifications" :key="c_specification.id" :value="c_specification.id">{{ c_specification.category_specification_label }}</option>
                                    </select>
                                    <span v-bind:class="{ 'error' : errors.has('Category Specification') }">{{ errors.first('Category Specification') }}</span>
                                </div>
                                <div class="form-group col-md-10 mx-auto">
                                    <vue-tags-input v-model="SpecificationValue" :SpecificationValues="SpecificationValues" @tags-changed="handleTagsSpecificationValues" placeholder="Add Category Specifications Values"/>                             
                                </div>
                            </div>
                        </div>
                    </div>
               <!-- </form> -->
            </template>
            <template v-slot:modal-footer>
                <!-- <button type="button" class="btn btn-light" @click="$emit('close')">Cancel</button> -->
                <button type="button" @click="submit_specification_values" class="btn btn-primary" v-bind:disabled="processing == true" > <i class='fa fa-circle-notch fa-spin'  v-if="processing == true"></i> Add Specification Vales</button>
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
                                    <select id="sub_category_id" v-model="sub_category_id" v-validate="'required'" name="Sub Category" class="form-control" @change="fetchChildCategories()">
                                        <option value="" disabled>Select Sub Category</option>
                                        <option v-for="s_category in category.subcategories" :key="s_category.id" :value="s_category.id">{{ s_category.sub_category_name }}</option>
                                    </select>
                                    <span v-bind:class="{ 'error' : errors.has('Sub Category') }">{{ errors.first('Sub Category') }}</span>
                                </div>

                                <div class="form-group col-md-10 mx-auto">
                                    <select id="sub_category_id" v-model="child_category_id" class="form-control">
                                        <option value="" disabled>Select Child Category</option>
                                        <option v-for="c_category in child_categories" :key="c_category.id" :value="c_category.id">{{ c_category.child_category }}</option>
                                    </select>
                                </div>


                                <div class="form-group col-md-10 mx-auto">
                                    <vue-tags-input v-model="tag" :tags="tags" @tags-changed="handleTagsChanged" placeholder="Add Category Specifications"/>  
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
                child_category_id: '',
                category_product_name: '',
                child_categories: [],
                CategorySpecifications: [],
                category_specification_id: '',
                show_modal_add_category:false,
                category_name: this.category_data.label,
                child_category_name: '',
                processing: false,
                delete_processing: false,
                add_child_category_processing: false,
                add_category_specification_details_processing: false,
                add_category_specifications_processing: false,
                show_modal: false,
                show_modal_specification_values:false,
                show_modal_category_specification:false,
                server_errors:'',
                tag: '',
                tags: [],
                SpecificationValue: '',
                SpecificationValues: [],
                delete_category_api_link: '/api/delete_category/'+this.category_data.slack,
                category_specification: '/api/categorySpecifications',

                subCategoryId: '',
                childCategoryId: '',
                categorySpecificationId: '',
                specificationValueId: '',

                ViewChildCategory: [],
                ViewCategorySpecification: [],
                ViewSpecificationValues: [],

                ViewSpecificationValuesStatus: false,
                ViewChildCategoryStatus: false,
                ViewCategorySpecificationStatus: false,
                mainTable: true,

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


            handleTagsSpecificationValues(newTags) {
                this.SpecificationValues = newTags.map(SpecificationValue => SpecificationValue.text);
            },


            add_category_specifications(){
                this.show_modal_category_specification = true;
                this.child_categories = [];
                this.CategorySpecifications = [];
                this.sub_category_id = '';
            },
            
            add_child_category(){
               
                this.show_modal_add_category = true;
                this.child_categories = [];
                this.CategorySpecifications = [];
                this.sub_category_id = '';

            },
            add_category_specification_details(){
                this.show_modal_specification_values = true;
                this.child_categories = [];
                this.CategorySpecifications = [];
                this.sub_category_id = '';
            },

            fetchChildCategories(){
                this.child_categories = [];
                this.CategorySpecifications = [];
                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);
                formData.append("sub_category_id", this.sub_category_id);
                axios.post('/api/fetch_child_categories', formData).then((response) => {

                    if(response.data.status_code == 200) {
                        console.log(response.data.data);
                        this.child_categories = response.data.data.child_categories;
                        this.CategorySpecifications = response.data.data.category_specifications;
                    }
                    })
                    .catch((error) => {
                    console.log(error);
                    });
                                    
            },

            fetchCategoriesSpecifications(){
                this.CategorySpecifications = [];
                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);
                formData.append("child_category_id", this.child_category_id);
                axios.post('/api/fetch_category_specifications', formData).then((response) => {

                    if(response.data.status_code == 200) {
                        this.CategorySpecifications = response.data.data.category_specifications;
                    }
                    })
                    .catch((error) => {
                    console.log(error);
                    });
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
            submit_child_category(){
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
                    formData.append("child_category_name", this.child_category_name);

                    console.log(...formData);

                    axios.post('/api/submit_child_category', formData).then((response) => {

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
            submit_specification_values(){
                this.$validator.validateAll().then((result) => {
                if (result) {
                this.$off("submit");
                this.$off("close");
                this.show_modal = true;
                this.$on("submit",function () {      
                    var formData = new FormData();
                    formData.append("access_token", window.settings.access_token);
                    formData.append("category_specification_id", this.category_specification_id);
                    formData.append("SpecificationValues[]", this.SpecificationValues);
                    axios.post('/api/submit_specification_values', formData).then((response) => {

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
                    formData.append("child_category_id", (this.child_category_id ? this.child_category_id : null));
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
            }
        });
            },




            ViewChildCategoryF(){
                this.categorySpecificationId = '';
                this.specificationValueId = '';
                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);
                formData.append("subCategoryId", this.subCategoryId);
                axios.post('/api/view_child_or_specifications_categories', formData).then((response) => {

                if(response.data.status_code == 200) {
                    if (response.data.data.child_categories && response.data.data.child_categories.length > 0) {
                        this.ViewChildCategory = response.data.data.child_categories;
                        this.ViewChildCategoryStatus = true;
                        this.mainTable = false;
                        this.ViewCategorySpecificationStatus = false;
                    }
                    if (response.data.data.category_specifications && response.data.data.category_specifications.length > 0) {
                        this.ViewCategorySpecification = response.data.data.category_specifications;
                        this.ViewCategorySpecificationStatus = true;
                        this.ViewSpecificationValuesStatus = false;
                        this.mainTable = false;
                        this.ViewChildCategoryStatus = false;
                    }

                }
                })
                .catch((error) => {
                console.log(error);
                });
            },


            ViewCategorySpecificationF(){
                this.specificationValueId = '';
                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);
                formData.append("childCategoryId", this.childCategoryId);
                axios.post('/api/view_specifications_categories', formData).then((response) => {

                if(response.data.status_code == 200) {
                    if (response.data.data.specifications && response.data.data.specifications.length > 0) {                        
                        this.ViewCategorySpecification = response.data.data.specifications;
                        this.ViewCategorySpecificationStatus = true;
                        this.ViewSpecificationValuesStatus = false;
                        this.mainTable = false;
                        this.ViewChildCategoryStatus = false;
                    }
                }
                })
                .catch((error) => {
                console.log(error);
                });
            },


            ViewSpecificationValuesF(){
                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);
                formData.append("categorySpecificationId", this.categorySpecificationId);
                axios.post('/api/view_specifications_values', formData).then((response) => {

                if(response.data.status_code == 200) {
                    if (response.data.data.specifications_values && response.data.data.specifications_values.length > 0) {                        
                        this.ViewSpecificationValues = response.data.data.specifications_values;
                        this.ViewSpecificationValuesStatus = true;
                        this.ViewCategorySpecificationStatus = false;
                        this.mainTable = false;
                        this.ViewChildCategoryStatus = false;
                    }
                }
                })
                .catch((error) => {
                console.log(error);
                });
            },


    toggleEdit(child_category) {
      this.$set(child_category, 'isEditable', !child_category.isEditable);
    },
    onEditInput(child_category) {
      child_category.child_category = event.target.innerText;
      this.moveCursorToEnd(event.target);
    },
    save_in_table(child_category, id, tablename) {
                console.log(child_category);
                console.log(`Value after editing: ${child_category.child_category} id: ${id} TableName: ${tablename}`);
                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);
                formData.append("new_value", child_category.child_category);
                formData.append("updated_value_id", id);
                formData.append("table_name", tablename);
                axios.post('/api/update_category_portion', formData).then((response) => {
                if(response.data.status_code == 200) {
                    this.show_response_message(response.data.msg, 'Success');
                }

                })
                .catch((error) => {
                console.log(error);
                });
    },
    moveCursorToEnd(element) {
      const range = document.createRange();
      const selection = window.getSelection();
      range.selectNodeContents(element);
      range.collapse(false);
      selection.removeAllRanges();
      selection.addRange(range);
    },

    }
    }
</script>
<style>
  [contenteditable="true"] {
    border: 1px solid rgb(168, 207, 194);
    background:white;
    padding: 5px;
  }
</style>