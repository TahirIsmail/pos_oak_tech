<template>
    <div class="row">
        <div class="col-md-12">

            <div class="d-flex flex-wrap mb-4">
                <div class="mr-auto">
                   <div class="d-flex">
                        <div>
                            <span class="text-title"> <span class='text-muted'>{{ $t("Staff Leave") }} </span> </span>
                        </div>
                    </div>
                </div>
                <div class="">
                    
                </div>
            </div>

            <div class="d-flex flex-wrap mb-4">

                <p v-html="server_errors" v-bind:class="[error_class]"></p>
                
                <div class="ml-auto">
                    <button type="submit" class="btn btn-danger mr-1" v-if="delete_access == true" v-on:click="delete_leave()" v-bind:disabled="delete_processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="delete_processing == true"></i> {{ $t("Delete Leave") }}</button>
                </div>

            </div>
            <hr>
            
            <div class="mb-2">
                <span class="text-subhead">{{ $t("Basic Information") }}</span>
            </div>
            <div class="form-row mb-2">
                <div class="form-group col-md-3">
                    <label for="product_code">{{ $t("Name") }}</label>
                    <p>{{ this.staff_leave_data.staff.fullname  }}( {{ this.staff_leave_data.staff.user_code }} )</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="name">{{ $t("Line Manager") }}</label>
                    <p>{{ this.staff_leave_data.line_manager.fullname }} ({{ this.staff_leave_data.line_manager.user_code }})</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="email">{{ $t("Leave Type") }}</label>
                    <p>{{ this.staff_leave_data.leave_type.type }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="phone">{{ $t("Leave From Date") }}</label>
                    <p>{{ this.staff_leave_data.leave_from }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="created_by">{{ $t("Leave To Date") }}</label>
                    <p>{{ this.staff_leave_data.leave_to }}</p>

                </div>
                <div class="form-group col-md-3">
                    <label for="updated_by">{{ $t("Leave Days") }}</label>
                    <p>{{ this.staff_leave_data.leave_days }}</p>

                </div>
                <div class="form-group col-md-3">
                    <label for="created_on">{{ $t("Status") }}</label>
                    <p>{{ this.staff_leave_data.leave_status }}</p>

                </div>
               
            </div>
            
            <hr>



            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label for="description">{{ $t("Reason") }}</label>
                    <p>{{ this.staff_leave_data.employee_remarks }}</p>
                </div>
                <div class="form-group col-md-6">
                    <label for="description">{{ $t("Line Manager Remark") }}</label>
                    <p>{{ this.staff_leave_data.admin_remarks }}</p>
                </div>
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
</template>  

<script>
    'use strict';
    
    export default {
        data(){
            return{
                staff_leave_data: staff_leave_data,
                processing: false,
                delete_processing: false,
                show_modal: false,
                delete_product_api_link: '/api/delete_staff_leave/'+this.staff_leave_data.slack,
            }
        },
        props: {
            staff_leave_data: [Array, Object],
            delete_access: Boolean,
        },
        mounted() {
            console.log('View Leave page loaded');
        },
        methods: {                  
            
            delete_leave(){
                this.$off("submit");
                this.$off("close");
                this.show_modal = true;
                this.$on("submit",function () {       
                    this.processing = true;
                    this.delete_processing = true;
                    var formData = new FormData();
                    formData.append("access_token", window.settings.access_token);

                    axios.post(this.delete_product_api_link, formData).then((response) => {

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
            }
        }
    }
</script>