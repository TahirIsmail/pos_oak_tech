<template>
    <div>
        <form @submit.prevent="submit_form">
          
            <div class="card-header d-flex flex-wrap mb-4">
                <div class="mr-auto">
                    <span class="text-title" v-if="complaint_slack == null">{{
                        $t("Add Customer Complaint")
                    }}</span>
                    <span class="text-title" v-else>{{ $t("Edit Customer Complaint") }}
                    </span>
                </div>
                <div class="">
                    <button v-if="complaint_slack == null" type="submit" class="btn btn-primary"
                        v-bind:disabled="processing == true">
                        <i class="fa fa-circle-notch fa-spin" v-if="processing == true"></i>
                        {{ $t("Save") }}
                    </button>
                    <button v-else type="submit" class="btn btn-primary" v-bind:disabled="processing == true">
                        <i class="fa fa-circle-notch fa-spin" v-if="processing == true"></i>
                        {{ $t("Update") }}
                    </button>
                </div>
            </div>
            <p v-html="server_errors" v-bind:class="[error_class]"></p>

            <div class="form-row mb-2">
                <div class="form-group col-sm-12 col-md-4">
                    <label for="name">{{ $t("Complaint Reference No") }}</label>
                    <input type="text" name="complaint_ref" v-model="complaint_ref" v-validate="'max:65535'"
                        class="form-control form-control-custom" rows="5" :placeholder="$t('Enter Complaint Reference')" />
                    <span v-bind:class="{ error: errors.has('complaint_ref') }">{{
                        errors.first("complaint_ref")
                    }}</span>
                </div>
                <div class="form-group col-sm-12 col-md-4">
                    <label for="complaint_status">{{ $t("Complaint Status") }}</label>
                    <input type="text" name="complaint_status" v-model="complaint_status" v-validate="'max:65535'"
                        class="form-control form-control-custom" rows="5" :placeholder="$t('Enter Complaint Status')" />
                    <span v-bind:class="{ error: errors.has('complaint_status') }">{{
                        errors.first("complaint_status")
                    }}</span>
                </div>
                <div class="form-group col-sm-12 col-md-4">
                    <label for="name">{{ $t("Description") }}</label>
                    <textarea name="descriptions" v-model="description" v-validate="'required|max:65535'"
                        class="form-control form-control-custom" rows="1"
                        :placeholder="$t('Complaint Description')"></textarea>

                    <span v-bind:class="{ error: errors.has('descriptions') }">{{
                        errors.first("descriptions")
                    }}</span>
                    <span v-bind:class="{ error: errors.has('descriptions') }">{{
                        errors.first("descriptions")
                    }}</span>
                </div>
            </div>
            <div class="form-row mb-2">
                <div class="form-group col-sm-12 col-md-4">
                    <label for="complaint_by">{{ $t("Choose Customer") }}</label>
                    <select v-model="complaint_by" v-validate="'required'"
                        class="form-control form-control-custom" placeholder="Choose Customers..">
                        <option value="" disabled>Choose Customers..</option>
                        <option v-for="(customer_item, index) in customer_list" v-bind:value="customer_item.id" placeholder="Choose Customers.."
                            v-bind:key="index">
                            {{ customer_item.id }} - {{ customer_item.name }}
                        </option>
                    </select>
                    <span v-bind:class="{ 'error': errors.has('complaint_by') }">{{ errors.first('complaint_by')
                    }}</span>
                </div>
                <div class="form-group col-sm-12 col-md-4">
                    <label for="assigned_to">{{ $t("Choose Staff") }}</label>
                    <select v-model="assigned_to" v-validate="'required'" :placeholder="assigned_to"
                        class="form-control form-control-custom">
                        <option value="" disabled >Choose Staff..</option>
                        <option v-for="(user_item, index) in user_list" v-bind:value="user_item.id" v-bind:key="index">
                            {{ user_item.id }} - {{ user_item.fullname }}
                        </option>
                    </select>
                    <span v-bind:class="{ 'error': errors.has('assigned_to') }">{{ errors.first('assigned_to')
                    }}</span>
                </div>
            </div>
        </form>
        <modalcomponent v-if="show_modal" v-on:close="show_modal = false">
            <template v-slot:modal-header>
                {{ $t("Confirm") }}
            </template>
            
            <template v-slot:modal-footer>
                <button type="button" class="btn btn-light" @click="$emit('close')">
                    Cancel
                </button>
                <button type="button" class="btn btn-primary" @click="$emit('submit')" v-bind:disabled="processing == true">
                    <i class="fa fa-circle-notch fa-spin" v-if="processing == true"></i>
                    Continue
                </button>
            </template>
        </modalcomponent>
    </div>
    
</template>
<script>
"use strict";

export default {

    data() {

        return {
            max: 5,
            server_errors: "",
            processing: false,
            modal: false,
            show_modal: false,
            error_class: "",


            api_link: this.complaint_data == null ? "/api/submit_customer_complaint" : "/api/update_customer_complaint/" + this.complaint_data.slack,
            complaint_slack: this.complaint_data && this.complaint_data.slack !== null ? this.complaint_data.slack : null,
            complaint_ref: this.complaint_data && this.complaint_data.complaint_ref !== null ? this.complaint_data.complaint_ref : null,
            complaint_status: this.complaint_data && this.complaint_data.complaint_status !== null ? this.complaint_data.complaint_status : null,
            description: this.complaint_data && this.complaint_data.descriptions !== null ? this.complaint_data.descriptions : null,

            complaint_by: this.complaint_data && this.complaint_data.complaint_by.id !== null ? this.complaint_data.complaint_by.id || "" : "",

            // complaint_by: this.complaint_data && this.complaint_data.complaint_by.name !== null ? this.complaint_data.complaint_by.value : '',
            assigned_to: this.complaint_data && this.complaint_data.assigned_to.id !== null ? this.complaint_data.assigned_to.id : '',
        };

    },
    props: {
        selectedComplaintId: Number,
        complaint_data: Array,
        customer_list: Array,
        user_list: Array,
    },
    methods: {
        submit_form() {
      this.$validator.validateAll().then((result) => {
        if (result) {
          this.show_modal = true;
          this.$on("submit", function () {
            this.processing = true;

            const formData = new FormData();
            formData.append("access_token", window.settings.access_token);
            formData.append("complaint_ref", this.complaint_ref);
            formData.append("complaint_status", this.complaint_status);
            formData.append("descriptions", this.description);
            formData.append("complaint_by", this.complaint_by);
            formData.append("assigned_to", this.assigned_to);
            
        

            axios
              .post(this.api_link, formData)
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
            this.$off("submit");
          });

          this.$on("close", function () {
            this.show_modal = false;
            this.$off("close");
          });
        }
      });
    },
    }
}
</script>
<style></style>