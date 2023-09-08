<template>
  <div>
    <div class="card">
      <form @submit.prevent="submit_form" class="mb-3">
        <div class="card-header d-flex flex-wrap mb-4">
          <div class="mr-auto">
            <span class="text-title" v-if="leave_type_slack == null">{{
              $t("Add Leave Type")
            }}</span>
            <span class="text-title" v-else>{{ $t("Edit Leave Type") }}
            </span>
          </div>
          <div class="">
            <button v-if="leave_type_slack == null" type="submit" class="btn btn-primary"
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
            <label for="address">{{ $t("Leave Type") }}</label>
            <input type="text" name="leave_type" v-model="leave_type" v-validate="'required|max:65535'"
              class="form-control form-control-custom" :placeholder="$t('Enter Leave Type')" />
            <span v-bind:class="{ error: errors.has('leave_type') }">{{
              errors.first("leave_type")
            }}</span>
          </div>

          <div class="form-group col-sm-12 col-md-4">
            <label for="status">{{ $t("Status") }}</label>
            <select name="status" v-model="status" class="form-control form-control-custom custom-select"
              v-validate="'required'">
              <option value="" selected disabled>Choose Status..</option>
              <option value="Active">Active</option>
              <option value="InActive">InActive</option>
            </select>
            <span v-bind:class="{ error: errors.has('status') }">{{
              errors.first("status")
            }}</span>
          </div>
        </div>


      </form>

      <modalcomponent v-if="show_modal" v-on:close="show_modal = false">
        <template v-slot:modal-header>
          {{ $t("Confirm") }}
        </template>
        <template v-slot:modal-body>
          <p v-if="status == 0">
            If supplier is inactive all the products with this supplier will get
            affected.
          </p>
          {{ $t("Are you sure you want to proceed?") }}
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
  </div>
</template>

<script>
export default {
  data() {
    return {

      server_errors: "",
      processing: false,
      modal: false,
      show_modal: false,
      error_class: "",
      leave_type_slack: this.leave_type_data && this.leave_type_data.slack !== null ? this.leave_type_data.slack : null,
      api_link: this.leave_type_data == null ? "/api/add_leave_type" : "/api/update_leave_type/" + this.leave_type_data.slack,


      status: this.leave_type_data && this.leave_type_data.status !== null ? this.leave_type_data.status || "" : "",
      leave_type: this.leave_type_data && this.leave_type_data.type !== null ? this.leave_type_data.type : '',


    };
  },
  props: {
    statuses: Array,
    leave_type_data: Array,

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
            formData.append("leave_type", this.leave_type);
            formData.append("status", this.status);

            // console.log(...formData);

            axios
              .post(this.api_link, formData)
              .then((response) => {
                if (response.data.status_code == 200) {
                  console.log(response.data);
                  this.show_response_message(response.data.msg, "Success");


                  setTimeout(function () {
                    location.reload();
                  }, 1000);

                } else {
                  this.show_modal = false;
                  this.processing = false;
                  try {
                    var error_json = JSON.parse(response.data.msg);
                    console.log(response.data);
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

  },
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
}
</style>