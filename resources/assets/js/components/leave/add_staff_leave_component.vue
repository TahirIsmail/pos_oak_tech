<template>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
        <form @submit.prevent="submit_form" class="mb-3">
       
          <div class="card-header d-flex flex-wrap mb-4">
            <div class="mr-auto">
              <div>
                <span class="text-title" v-if="leave_slack == '' ">{{
                  $t("Add Staff Leave")
                }}</span>
                <span class="text-title" v-else>{{
                  $t("Edit Staff Leave")
                }}</span>
               
              </div>
      
            </div>
            <div class="">
              <button
                type="submit"
                class="btn btn-primary"
                v-bind:disabled="processing == true"
                v-if="leave_slack == ''"
              >
                <i
                  class="fa fa-circle-notch fa-spin"
                  v-if="processing == true"
                ></i>
                {{ $t("Save") }}
              </button>
              <button
                type="submit"
                class="btn btn-primary"
                v-bind:disabled="processing == true"
                v-else
              >
                <i
                  class="fa fa-circle-notch fa-spin"
                  v-if="processing == true"
                ></i>
                {{ $t("Update") }}
              </button>
            </div>
          </div>
  
          <p v-html="server_errors" v-bind:class="[error_class]"></p>
  
          <div class="d-flex flex-wrap mb-1">
            <div class="mr-auto">
              <span class="text-subhead">{{ $t("Leave Information") }}</span>
            </div>
            <div class=""></div>
          </div>
  
          <div class="form-row mb-2">
            <div class="form-group col-md-5">
              <label for="apply_date">{{ $t("Apply Date") }}</label>
              <input
                type="date"
                name="apply_date"
                v-model="apply_date"
                v-validate="'required'"
                class="form-control form-control-custom"
                :placeholder="$t('Please enter product code')"
                autocomplete="off"
              />
              <span v-bind:class="{ error: errors.has('apply_date') }">{{
                errors.first("apply_date")
              }}</span>
            </div>
            <div class="form-group col-md-5">
              <label for="leave_types">{{ $t("Available Leaves") }}</label>
              <select
                name="leave_type"
                v-model="leave_type"
                v-validate="'required'"
                class="form-control form-control-custom custom-select"
              >
                <option value="">Choose Leave Type..</option>
                <option
                  v-for="(leave_type, index) in leaveTypes"
                  v-bind:value="leave_type.id"
                  v-bind:key="index"
                >
                  {{ leave_type.type }}
                </option>
              </select>
              <span v-bind:class="{ error: errors.has('leave_type') }">{{
                errors.first("leave_type")
              }}</span>
            </div>
            <div class="form-group col-md-5">
              <label for="from_date">{{ $t("Leave From Date") }}</label>
              <input
                type="date"
                name="from_date"
                v-model="from_date"
                v-validate="'required'"
                class="form-control form-control-custom"
                :placeholder="$t('Leave From Date')"
                autocomplete="off"
              />
              <span v-bind:class="{ error: errors.has('from_date') }">{{
                errors.first("from_date")
              }}</span>
            </div>
            <div class="form-group col-md-5">
              <label for="from_to">{{ $t("Leave to Date") }}</label>
              <input
                type="date"
                name="from_to"
                v-model="from_to"
                v-validate="'required'"               
                class="form-control form-control-custom"
                :placeholder="$t('Leave to Date')"
                autocomplete="off"
              />
              <span v-bind:class="{ error: errors.has('from_to') }">{{
                errors.first("from_to")
              }}
              </span>
            </div>

            
          </div>
  
          <div class="form-row mb-2">
            <div class="form-group col-md-10">
              <label for="reason">{{ $t("Reason") }}</label>
              <textarea
                name="reason"
                v-model="reason"
                v-validate="'max:65535'"
                class="form-control form-control-custom"
                rows="2"
                :placeholder="$t('Enter Reason')"
              ></textarea>
              <span v-bind:class="{ error: errors.has('reason') }">{{
                errors.first("reason")
              }}</span>
            </div>
          </div>
          <!-- <div class="form-row mb-2">
            <div class="form-group col-md-3">
              <label for="product_image">{{
                $t("Attach Document") + " (jpeg, jpg, png, webp)"
              }}</label>
              <input
                type="file"
                class="form-control-file form-control form-control-custom file-input"
                name="product_image"
                ref="product_image"
                accept="image/x-png,image/jpeg,image/webp"
                v-validate="'ext:jpg,jpeg,png,webp|size:1500'"
                multiple="multiple"
              />
              <small class="form-text text-muted mb-1"
                >Allowed file size per file is 1.5 MB</small
              >
              <small class="form-text text-muted"
                >Hold down CTRL or Command for choosing multiple files</small
              >
              <span v-bind:class="{ error: errors.has('product_image') }">{{
                errors.first("product_image")
              }}</span>
            </div>
          </div> -->
  

        </form>
      </div>
  
      <modalcomponent v-if="show_modal" v-on:close="show_modal = false">
        <template v-slot:modal-header>
          {{ $t("Confirm") }}
        </template>
        <template v-slot:modal-body>
          {{ $t("Are you sure you want to proceed?") }}
        </template>
        <template v-slot:modal-footer>
          <button type="button" class="btn btn-light" @click="$emit('close')">
            Cancel
          </button>
          <button
            type="button"
            class="btn btn-primary"
            @click="$emit('submit')"
            v-bind:disabled="processing == true"
          >
            <i class="fa fa-circle-notch fa-spin" v-if="processing == true"></i>
            Continue
          </button>
        </template>
      </modalcomponent>
    </div>
  </div>
  </template>
  
  <script>
  "use strict";
  
  import { CoolSelect } from "vue-cool-select";
  import "vue-cool-select/dist/themes/bootstrap.css";
  
  import Multiselect from "vue-multiselect";
  import "vue-multiselect/dist/vue-multiselect.min.css";
  
  export default {
    components: { Multiselect },
    data() {
      return {
        leave_slack: this.staff_leave == null ? "" : this.staff_leave.slack,
        leaveTypes: this.leave_types,
        server_errors: "",
        error_class: "",
        processing: false,
        modal: false,
        show_modal: false,
        leave_type: (this.staff_leave == null) ? "" : this.staff_leave.leave_type.id,
        apply_date: (this.staff_leave == null) ?  this.getCurrentDate() : this.staff_leave.apply_date,
        from_date: (this.staff_leave == null) ? "" : this.staff_leave.leave_from,
        from_to: (this.staff_leave == null) ? "" : this.staff_leave.leave_to,
        reason : (this.staff_leave ==null ) ? "" : this.staff_leave.employee_remarks,

        api_link:
          this.staff_leave == null
            ? "/api/add_staff_leave"
            : "/api/update_staff_leave/" + this.staff_leave.slack,
  
      
      }
    },
    props: {
      users: [Array, Object],
      leave_types: [Array, Object],
      staff_leave: [Array, Object],
      
    },
    mounted() {
      console.log("Add staff leave page loaded");
    },
    created() {
    
    },
    methods: {

      
      
      getCurrentDate() {
      const now = new Date();
      const year = now.getFullYear();
      const month = (now.getMonth() + 1).toString().padStart(2, '0'); // Adding 1 since January is 0
      const day = now.getDate().toString().padStart(2, '0');
      return `${year}-${month}-${day}`;
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
            formData.append(
              "apply_date",
              this.apply_date == null ? "" : this.apply_date
            );
            formData.append(
              "from_date",
              this.from_date == null ? "" : this.from_date
            );
            formData.append(
              "from_to",
              this.from_to == null ? "" : this.from_to
            );
            formData.append(
              "leave_type",
              this.leave_type == null ? "" : this.leave_type
            );
           
           
            formData.append(
              "reason",
              this.reason == null ? "" : this.reason
            );


            console.log(...formData);
           
           

            axios
              .post(this.api_link, formData)
              .then((response) => {
                if (response.data.status_code == 200) {
                  this.show_response_message(response.data.msg, "Success");
                  if (
                    typeof response.data.link != "undefined" &&
                    response.data.link != ""
                  )
                   {
                    if (response.data.new_tab == true) {
                      window.open(response.data.link, "_blank");
                    } else {
                      window.location.href = response.data.link;
                    }
                    setTimeout(function () {
                      location.reload();
                    }, 1000);
                  } else {
                    setTimeout(function () {
                      location.reload();
                    }, 1000);
                  }
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
                console.log(error);
              });
          });
          this.$on("close", function () {
            this.show_modal = false;
          });
        }
      });
    },





    },
  };
  </script>
  <style scoped>
  .text-subhead {
    color: var(--label-sub-head);
    font-weight: 500;
    font-size: 15px;
    margin-left: 15px;
}
  </style>