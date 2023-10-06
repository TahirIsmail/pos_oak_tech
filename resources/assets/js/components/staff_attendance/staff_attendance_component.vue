<template>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form @submit.prevent="submit_form" class=" mb-3">
          <div class="card-header d-flex flex-wrap mb-4">
            <div class="mr-auto">
              <span class="text-title">{{ $t("Staff Attendance") }}</span>
            </div>
            <div class="">
              <button type="submit" class="btn btn-primary" v-bind:disabled="processing == true">
                <i class="fa fa-circle-notch fa-spin" v-if="processing == true"></i>{{ $t("Search Staff List") }}
              </button>
            </div>
          </div>

          <p v-html="server_errors" v-bind:class="[error_class]"></p>

          <div class="form-row mb-2">
            <div class="form-group col-md-6">
              <label for="role">{{ $t("Choose Staff") }}</label>
              <select v-model="staff_role" class="form-control form-control-custom">
                <option value="">Choose Staff..</option>
                <option v-for="(staff_role, index) in roles_data" :value="staff_role.id" :key="index">
                  {{ staff_role.label }}
                </option>
              </select>
            </div>
            <div class="form-group col-md-5">
              <label for="barcode">{{ $t("Date") }}</label>
              <input type="date" v-model="attendance_date" class="form-control form-control-custom" />
            </div>
          </div>
        </form>
      </div>

      <div class="col-md-12" v-if="show_attendance_table" style="overflow: scroll">
        <form ref="attendanceForm" @submit.prevent="submitAttendance" class="mb-3">
          <div class="w-100 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Save Attendance</button>
          </div>
        </form>
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Staff Name</th>
              <th>Staff Role</th>
              <th>Attendance</th>
              <th>Note</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(staff, index) in staffList" :key="staff.id">
              <td>{{ index + 1 }}</td>
              <td>{{ staff.fullname }} ({{ staff.user_code }})</td>
              <td>{{ staff.role.label }}</td>
              <td class="d-flex">
                <input type="hidden" :v-model="staffAttendanceData[index].staff_id" :value="staff.id" />
                <div v-for="(type, typeIndex) in staffAttendanceTypes" :key="type.id"
                  class="radio radio-info radio-inline mx-4">
                  <input :id="'staff_attendance_type_' + staff.id + '_' + type.id"
                    :name="'staff_attendance_type_' + staff.id" :value="type.id"
                    v-model="staffAttendanceData[index].attendance_type_id" type="radio" />
                  <label :for="'staff_attendance_type_' + staff.id + '_' + type.id">{{ type.type }}</label>
                </div>
              </td>
              <td>
                <input type="text" v-model="staffAttendanceData[index].note" />
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div id="staff_list_append" v-html="staffListHtml"></div>

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
"use strict";

export default {
  data() {
    return {
      staffList: [],
      staffAttendanceTypes: [],
      staffAttendanceData: [],
      already_mark_staff_attendance: [],
      staffListHtml: "",
      staff_role: "",
      server_errors: "",
      error_class: "",
      processing: false,
      modal: false,
      show_modal: false,
      show_attendance_table: false,
      api_link: "/api/fetch_staff_list",
      attendance_date: new Date().toISOString().substr(0, 10),
      staffAttendanceData: [],
      note: "",
    };
  },
  props: {
    roles_data: [Array, Object],
  },
  mounted() {
    console.log("Roles:", this.roles_data);

    this.roles = this.roles_data;
  },
  created() { },
  methods: {
    submit_form() {
      this.$validator.validateAll().then((result) => {
        if (result) {
          this.show_modal = true;

          // Handle the submit event
          const handleSubmit = () => {
            // this.processing = true;
            var formData = new FormData();

            formData.append("access_token", window.settings.access_token);
            formData.append(
              "attendance_date",
              JSON.stringify(this.attendance_date)
            );
            formData.append("staff_role", JSON.stringify(this.staff_role));

            axios
              .post(this.api_link, formData)
              .then((response) => {
                this.show_modal = false;
                this.show_attendance_table = true;
                this.processing = false;
                if (response.data.data.already_mark_staff_attendance) {
                  this.staffList = response.data.data.staff_list;

                  this.staffAttendanceData = this.staffList.map((staff) => ({
                    staff_id: staff.id,
                    staff_attendance_id: null,
                    attendance_type_id: null,
                    note: "",
                  }));

                  // Update staffAttendanceData with existing attendance data
                  this.staffAttendanceData.forEach((attendanceData) => {
                    const existingAttendance =
                      response.data.data.already_mark_staff_attendance.find(
                        (attendance) => {
                          return (
                            String(attendance.staff_id) ===
                            String(attendanceData.staff_id)
                          );
                        }
                      );

                    if (existingAttendance) {
                      attendanceData.staff_attendance_id =
                        existingAttendance.id;
                      attendanceData.attendance_type_id =
                        existingAttendance.staff_attendance_type_id;
                      attendanceData.note = existingAttendance.remark;
                    }
                  });
                  this.staffAttendanceTypes =
                    response.data.data.staff_attendance_types;
                  //   this.staffListHtml = response.data.data;
                  console.log(response.data.data.staff_list);
                } else {
                  this.staffList = response.data.data.staff_list;
                  // Initialize staffAttendanceData based on staffList
                  this.staffAttendanceData = this.staffList.map((staff) => ({
                    staff_id: staff.id,
                    attendance_type_id: null,
                    note: "",
                  }));
                  this.staffAttendanceTypes =
                    response.data.data.staff_attendance_types;
                  //   this.staffListHtml = response.data.data;
                  console.log(response.data.data.staff_list);
                }
              })
              .catch((error) => {
                console.log(error);
              });
          };

          // Listen for the submit event
          this.$on("submit", handleSubmit);

          // Listen for the close event
          this.$on("close", () => {
            this.show_modal = false;
            // Remove the submit and close event listeners
            this.$off("submit", handleSubmit);
          });
        }
      });
    },

    submitAttendance() {
      this.$validator.validateAll().then((result) => {
        if (result) {
          this.show_modal = true;

          // Handle the submit event
          const handleSubmit = () => {
            this.processing = true;
            var formData = new FormData();

            formData.append("access_token", window.settings.access_token);
            formData.append(
              "staffAttendanceData",
              JSON.stringify(this.staffAttendanceData)
            );
            formData.append(
              "attendance_date",
              JSON.stringify(this.attendance_date)
            );
            console.log(...formData);
            axios
              .post("/api/store_staff_attendance", formData)
              .then((response) => {
                this.show_modal = false;
                this.processing = false;
                if (response.data.status_code == 200) {
                  this.show_response_message(response.data.msg, "Success");
                  this.show_attendance_table = false;

                  if (
                    typeof response.data.link != "undefined" &&
                    response.data.link != ""
                  ) {
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
          };

          // Listen for the submit event
          this.$on("submit", handleSubmit);

          // Listen for the close event
          this.$on("close", () => {
            this.show_modal = false;
            // Remove the submit and close event listeners
            this.$off("submit", handleSubmit);
          });
        }
      });
    },
  },
};
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
    /* margin-right: -5px; */
    margin-left: 14px;
}
</style>