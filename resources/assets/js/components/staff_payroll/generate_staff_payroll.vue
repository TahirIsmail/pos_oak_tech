<template>
  <div class="content-wrapper" style="min-height: 393px">
    <div class="container-fluid card">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="box box-primary p-2">
            <div class="box-header">
              <div class="row">
                <div class="col-md-4 p-2">
                  <h4 class="text-title">Staff Details</h4>
                </div>
              </div>
            </div>

            <div class="box-body" style="padding-top: 0">
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="sfborder row">
                    <div class="col-md-2">
                      <div class="row">
                        <img
                          width="90"
                          height="160"
                          style="object-fit: cover"
                          class="round5"
                          :src="imagePath"
                          alt="No Image"
                        />
                      </div>
                    </div>

                    <div class="col-md-10">
                      <div class="">
                        <table class="table mb0 font12">
                          <tbody>
                            <tr>
                              <th class="bozero">Name</th>
                              <td class="bozero">
                                {{ staff_with_attendance[0].fullname }}
                              </td>
                              <th class="bozero">Staff ID</th>
                              <td class="bozero">
                                {{ staff_with_attendance[0].user_code }}
                              </td>
                            </tr>
                            <tr>
                              <th>Phone</th>
                              <td>{{ staff_with_attendance[0].phone }}</td>
                              <th>Email</th>
                              <td>{{ staff_with_attendance[0].email }}</td>
                            </tr>
                            <tr>
                              <th>Role</th>
                              <td>{{ staff_with_attendance[0].role.label }}</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <!--./col-md-8-->
                <div class="col-md-6 col-sm-12">
                  <div class="sfborder relative overvisible">
                    <div class="letest">
                      <div class="rotatetest"><strong>Attendance</strong> </div>
                    </div>
                    <div class="padd-en-rtl33">
                      <table class="table mb0 font13">
                        <tr>
                          <th class="bozero">Month</th>
                          <th class="bozero">P</th>
                          <th class="bozero">L</th>
                          <th class="bozero">A</th>
                          <th class="bozero">Half Day</th>
                          <th class="bozero">Holiday</th>
                          <th class="bozero">Approved Leave</th>
                        </tr>
                        <tr v-for="(record, key) in attendance_records" :key="key">
                          <td>{{ formatDate(key) }}</td>
                          <td>{{ record.present }}</td>
                          <td>{{ record.late }}</td>
                          <td>{{ record.absent }}</td>
                          <td>{{ record.half_day }}</td>
                          <td>{{ record.holiday }}</td>
                          <td>{{ record.leave }}</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
                <!--./col-md-8-->
                <div class="col-md-12">
                  <div style="
                      background: #dadada;
                      height: 1px;
                      width: 100%;
                      clear: both;
                      margin-bottom: 10px;
                    "></div>
                </div>
              </div>
            </div>

            <form @submit.prevent="submitForm" v-if="already_payroll_generated">
              <input
                type="hidden"
                name="this_month_pf"
                value="your_this_month_pf_value_here"
              />
              <input
                type="hidden"
                name="pf_deduction"
                value="your_pf_value_here"
              />
              <div class="box-header">
                <div class="roww d-flex">
                  <div class="col-md-4 col-sm-12">
                    <div class="d-flex justify-content-between">
                      <h3 class="box-title">Earning</h3>
                      <button type="button" @click="addRow" class="plusign">
                        <i class="fa fa-plus"></i>
                      </button>
                    </div>
                    <div class="sameheight">
                      <div class="feebox">
                        <table class="table3" id="tableID">
                          <!-- Your PHP loop for payroll_previour_allowance goes here -->
                          <tr v-for="(row, index) in earnings" :key="index">
                            <td>
                              <input
                                type="text"
                                class="form-control"
                                v-model="row.allowance_type"
                                placeholder="Type"
                              />
                            </td>
                            <td>
                              <input
                                type="text"
                                class="form-control"
                                v-model="row.allowance_amount"
                                value="0"
                              />
                            </td>
                            <td>
                              <button
                                type="button"
                                @click="deleteRow(index)"
                                class="closebtn"
                              >
                                <span style="color: red">X</span>
                              </button>
                            </td>
                          </tr>
                          <!-- End of your PHP loop -->
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-12">
                    <div class="d-flex justify-content-between">
                      <h3 class="box-title">Deduction</h3>
                      <button
                        type="button"
                        @click="addDeduction"
                        class="plusign"
                      >
                        <i class="fa fa-plus"></i>
                      </button>
                    </div>
                    <div class="sameheight">
                      <div class="feebox">
                        <table class="table3" id="tableID2">
                          <tr
                            v-for="(deduction, index) in deductions"
                            :key="index"
                          >
                            <td>
                              <input
                                type="text"
                                :id="'deduction_type' + index"
                                :name="'deduction_type[' + index + ']'"
                                class="form-control"
                                placeholder="Type"
                                v-model="deduction.deduction_type"
                              />
                            </td>
                            <td>
                              <input
                                type="number"
                                min="1"
                                :id="'deduction_amount' + index"
                                :name="'deduction_amount[' + index + ']'"
                                class="form-control"
                                v-model="deduction.deduction_amount"
                              />
                            </td>
                            <td>
                              <button
                                type="button"
                                @click="deleteDeduction(index)"
                                class="closebtn"
                              >
                                <span style="color: red">X</span>
                              </button>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-12">
                    <button type="button" @click="addAllowance" class="plusign">
                      <i class="fas fa-calculator"></i> Calculate
                    </button>
                    <h3 class="box-title">Payroll Summary(Rs.)</h3>

                    <div class="sameheight">
                      <div class="payrollbox feebox">
                        <div class="form-group row">
                          <label class="col-sm-4 control-label"
                            >Basic Salary</label
                          >
                          <div class="col-sm-8">
                            <input
                              class="form-control"
                              name="basic"
                              v-model="basic_salary"
                              id="basic"
                              type="number"
                              style="
                                border: none;
                                border-bottom: 1px solid grey;
                              "
                              min="1"
                            />
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 control-label">Earning</label>
                          <div class="col-sm-8">
                            <input
                              class="form-control"
                              name="total_allowance"
                              id="total_allowance"
                              v-model="total_earnings"
                              style="
                                border: none;
                                border-bottom: 1px solid grey;
                              "
                              type="number"
                            />
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 control-label"
                            >Deduction</label
                          >
                          <div class="col-sm-8 deductiondred">
                            <input
                              class="form-control"
                              name="total_deduction"
                              id="total_deduction"
                              type="number"
                              v-model="total_deductions"
                              style="
                                color: #f50000;
                                border: none;
                                border-bottom: 1px solid grey;
                              "
                            />
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 control-label"
                            >Gross Salary</label
                          >
                          <div class="col-sm-8">
                            <input
                              class="form-control"
                              name="gross_salary"
                              id="gross_salary"
                              v-model="gross_salary"
                              type="number"
                              style="
                                border: none;
                                border-bottom: 1px solid grey;
                              "
                            />
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 control-label">Tax</label>
                          <div class="col-sm-8 deductiondred">
                            <input
                              class="form-control"
                              name="tax"
                              id="tax"
                              v-model="tax"
                              type="number"
                              style="
                                border: none;
                                border-bottom: 1px solid grey;
                              "
                            />
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-4 control-label"
                            >Net Salary</label
                          >
                          <div class="col-sm-8 net_green">
                            <input
                              class="form-control greentest"
                              name="net_salary"
                              id="net_salary"
                              v-model="net_salary"
                              type="number"
                              min="1"
                              style="
                                border: none;
                                border-bottom: 1px solid grey;
                              "
                            />
                            <span class="text-danger" id="err"></span>
                            <input
                              class="form-control"
                              name="staff_id"
                              value="your_staff_id_here"
                              type="hidden"
                            />
                            <input
                              class="form-control"
                              name="month"
                              value="your_month_here"
                              type="hidden"
                            />
                            <input
                              class="form-control"
                              name="year"
                              value="your_year_here"
                              type="hidden"
                            />
                            <input
                              class="form-control"
                              name="status"
                              value="generated"
                              type="hidden"
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                 

                  <div class="col-md-12 col-sm-12">
                    <button
                      type="submit"
                      id="contact_submit"
                      class="btn btn-primary pull-right"
                    >
                      Save
                    </button>
                  </div>
                </div>
              
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

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
</template>

<script>
export default {
  data() {
    return {
      server_errors: "",
      imagePath: this.profile_image,
      error_class: "",
      processing: false,
      modal: false,
      show_modal: false,
      already_payroll_generated:true,
      staff_id: this.staff_with_attendance[0].id,
      status: "generated",
      month: this.month,
      year: this.year,
      api_link: "/api/staff/payroll_payslip",
      earnings: [{ allowance_type: "", allowance_amount: "0" }],
      deductions: [{ deduction_type: "", deduction_amount: "0" }],
      total_earnings: 0,
      total_deductions: 0,
      basic_salary: 0,
      gross_salary: 0,
      net_salary: 0,
      tax: 0,
    
    };
  },
  props: {
    staff_with_attendance: [Array, Object],
    profile_image: [Array, Object],
    attendance_records: [Array, Object],
    month: [Array, Object],
    year: [Array, Object],
    accounts: Array,
    payment_methods : Array,
  },
  mounted() { },
  created() { },
  methods: {
    formatDate(date) {
      const parts = date.split("-");
      const year = parts[2];
      const month = parseInt(parts[1], 10) - 1; // Subtract 1 to adjust for JavaScript's 0-based month
      const formattedMonth = new Date(year, month, parts[0]).toLocaleDateString(
        "en-US",
        { month: "long" }
      );
      return `${formattedMonth}`;
    },
    addRow() {
      this.earnings.push({ allowance_type: "", allowance_amount: "0" });
    },
    deleteRow(index) {
      this.earnings.splice(index, 1);
    },
    addDeduction() {
      this.deductions.push({ deduction_type: "", deduction_amount: 0 });
    },
    deleteDeduction(index) {
      this.deductions.splice(index, 1);
    },

    submitForm() {
      this.$validator.validateAll().then((result) => {
        if (result) {
          this.show_modal = true;
          this.$on("submit", function () {
            this.processing = true;

            const formData = new FormData();
            formData.append("access_token", window.settings.access_token);
            this.deductions.forEach((deduction, index) => {
              formData.append(
                `deductions[${index}][deduction_type]`,
                deduction.deduction_type
              );
              formData.append(
                `deductions[${index}][deduction_amount]`,
                deduction.deduction_amount
              );
            });

            this.earnings.forEach((earning, index) => {
              formData.append(
                `earnings[${index}][allowance_type]`,
                earning.allowance_type
              );
              formData.append(
                `earnings[${index}][allowance_amount]`,
                earning.allowance_amount
              );
            });

            formData.append("staff_id", this.staff_id);
            formData.append("month", this.month);
            formData.append("year", this.year);
            formData.append("status", this.status);
            formData.append("total_earnings", this.total_earnings);
            formData.append("total_deductions", this.total_deductions);
            formData.append("basic_salary", this.basic_salary);
            formData.append("gross_salary", this.gross_salary);
            formData.append("net_salary", this.net_salary);
            formData.append("tax", this.tax);
           

            axios
              .post(this.api_link, formData)
              .then((response) => {
                if (response.data.status_code == 200) {
                  console.log(response.data);
                  this.show_response_message(response.data.msg, "Success");
                  this.show_modal = false;
                  this.processing = false;
                  this.already_payroll_generated = false;
                  // setTimeout(function () {
                  //   location.reload();
                  // }, 1000);
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

    addAllowance() {
      const basicPay = parseFloat(this.basic_salary) || 0;
      const tax = parseFloat(this.tax) || 0;
      let totalAllowance = 0;
      let totalDeduction = 0;
      this.deductions.forEach((deduction, index) => {
        totalDeduction += parseFloat(deduction.deduction_amount) || 0;
      });
      this.earnings.forEach((earnings, index) => {
        totalAllowance += parseFloat(earnings.allowance_amount) || 0;
      });
      const grossSalary = basicPay + totalAllowance - totalDeduction;
      const netSalary = basicPay + totalAllowance - totalDeduction - tax;
      this.total_earnings = totalAllowance.toFixed(2);
      this.total_deductions = totalDeduction.toFixed(2);
      this.gross_salary = grossSalary.toFixed(2);
      this.net_salary = netSalary.toFixed(2);
    },
  },
};
</script>

<style scoped>
.btn {
  margin-left: 10px;
  margin-top: 20px;
  float: right;
}

.roww {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  margin-right: -15px;
  margin-left: -30px;
}
.box-title {
  font-size: 17px;
  padding: 2px;
}
.letest {
  position: absolute;
  left: -45px;
  top: 43px;
  bottom: 0;
  font-size: 14px;
  letter-spacing: 2px;
  text-align: center;
}

.rotatetest {
  text-transform: uppercase;
  -moz-transform: rotate(-90deg);
  -o-transform: rotate(-90deg);
  -webkit-transform: rotate(-90deg);
  position: absolute;
  padding: 4px 3px 3px 4px;
  border-bottom: 1px solid #dadada;
}

.padd-en-rtl33 {
  padding-right: 33px;
}

.staffprofile .icon {
  position: absolute;
  top: 0px;
  left: 10px;
  z-index: 0;
  font-size: 46px;
  color: rgb(169, 166, 166);
  right: auto;
}

.relative {
  position: relative;
}

.overvisible {
  overflow: visible !important;
}

.sibbtnposition {
  position: absolute;
  right: 2px;
  top: 2px;
}

.sfborder {
  border: 1px solid #dadada;
  border-radius: 2px;
  margin-bottom: 10px;
  overflow: hidden;
}

.bozero {
  border-top: 0 !important;

}

.font12 {
  font-size: 12px !important;
}

.font13 {
  font-size: 13px !important;
}

.padd-en-rtl33 {
  padding-left: 33px;
}

.printInv {
  border-radius: 3px !important;
}

.mb0 {
  margin-bottom: 0 !important;
}

.mb10 {
  margin-bottom: 10px !important;
}

.mt30 {
  margin-top: 30px;
}

.pb0 {
  padding-bottom: 0;
}

.pt0 {
  padding-top: 0 !important;
}

.pt10 {
  padding-top: 0 !important;
}

.pb10 {
  padding-bottom: 10px;
}

.pt25 {
  padding-top: 25px;
}

.pt20 {
  padding-top: 20px;
}

.pt4 {
  padding-top: 4px;
}

.pt6 {
  padding-top: 6px;
}

.pr0 {
  padding-right: 0 !important;
}

.plr10 {
  padding-left: 10px;
  padding-right: 10px;
}

.pl25 {
  padding-left: 25px;
}

.ltextright {
  text-align: center;
}

.bolds {
  font-family: "Roboto-Bold";
}

.bmedium {
  font-family: "Roboto-Medium";
}

.dates {
  font-family: "Roboto-Bold";
  position: absolute;
  padding-top: 5px;
}

.plusign {
  background: #1f6feb;
  border: 1px solid #525252;
  border-radius: 3px;
  float: right;
  color: #fff;
  outline: 0;
  transition: all 0.5s ease;
  padding: 0px 6px 25px;
  height: 1.9rem;
}

.sameheight {
  border: 1px solid #dadada;
  height: 500px;
}
.feebox {
  margin-top: 10px;
  padding: 10px 10px 0;
  position: relative;
}

.plusign:hover {
  background: #faa21c;
}
.closebtn {
  color: #d9534f;
  background: transparent;
  border: 0;
  outline: 0;
  vertical-align: text-bottom;
  font-size: 16px;
  float: right;
}
</style>
