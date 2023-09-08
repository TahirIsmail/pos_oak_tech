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
                        <img width="90" height="160" class="imgprofile" :src="imagePath" alt="No Image" />
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
                          <th class="bozero">F</th>
                          <th class="bozero">H</th>
                          <th class="bozero">Le</th>
                          <th class="bozero">V</th>
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


            <form class="form-horizontal" action="" method="post" id="employeeform">
              <input type="hidden" name="this_month_pf" value="your_this_month_pf_value_here">
              <input type="hidden" name="pf_deduction" value="your_pf_value_here">
              <div class="box-header">
                <div class="roww d-flex">
                  <div class="col-md-4 col-sm-4">
                    <div class="d-flex justify-content-between">
                      <h3 class="box-title">Earning</h3>
                      <button type="button" onclick="add_more()" class="plusign"><i class="fa fa-plus"></i></button>
                    </div>
                    <div class="sameheight">
                      <div class="feebox">
                        <table class="table3" id="tableID">
                          <!-- Your PHP loop for payroll_previour_allowance goes here -->
                          <tr id="row0">
                            <td><input type="text" class="form-control" id="allowance_type" name="allowance_type[]"
                                placeholder="Type" value=""></td>
                            <td><input type="number" id="allowance_amount" name="allowance_amount[]" class="form-control"
                                value=""></td>
                          </tr>
                          <!-- End of your PHP loop -->
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <div class="d-flex justify-content-between">

                      <h3 class="box-title">Deduction</h3>
                      <button type="button" onclick="add_more_deduction()" class="plusign"><i
                          class="fa fa-plus"></i></button>
                    </div>
                    <div class="sameheight">
                      <div class="feebox">
                        <table class="table3" id="tableID2">
                          <tr id="deduction_row0">
                            <td><input type="text" id="deduction_type" name="deduction_type[]" class="form-control"
                                placeholder="Type" value="EOBI" readonly></td>
                            <td><input type="number" min="1" id="deduction_amount" name="deduction_amount[]"
                                class="form-control" value="250"></td>
                          </tr>
                          <tr id="deduction_row1">
                            <td><input type="text" id="deduction_type" name="deduction_type[]" class="form-control"
                                placeholder="Type" value="Provident Fund " readonly></td>
                            <td><input type="number" min="1" id="deduction_amount" name="deduction_amount[]"
                                class="form-control" value="your_pf_value_here" readonly></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <button type="button" onclick="add_allowance()" class="plusign"><i class="fas fa-calculator"></i>
                      Calculate</button>
                    <h3 class="box-title">Payroll Summary(Rs.)</h3>

                    <div class="sameheight">
                      <div class="payrollbox feebox">
                        <div class="form-group">
                          <label class="col-sm-5 control-label"><strong>Basic Salary</strong></label>

                          <div class="col-sm-8">
                            <input class="form-control" name="basic" value="0" id="basic" type="number" min="1" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-5 control-label"><strong>Earning</strong></label>
                          <div class="col-sm-8">
                            <input class="form-control" name="total_allowance" id="total_allowance" type="number" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-5 control-label"><strong>Deduction</strong></label>
                          <div class="col-sm-8 deductiondred">
                            <input class="form-control" name="total_deduction" id="total_deduction" type="number"
                              style="color:#f50000" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-5 control-label"> <strong>Gross Salary</strong> </label>
                          <div class="col-sm-8">
                            <input class="form-control" name="gross_salary" id="gross_salary" value="0" type="number" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-5 control-label"> <strong>Tax</strong> </label>
                          <div class="col-sm-8 deductiondred">
                            <input class="form-control" name="tax" id="tax" value="0" type="number" />
                          </div>
                        </div>
                        <hr />
                        <div class="form-group">
                          <label class="col-sm-5 control-label"><strong>Net Salary</strong> </label>
                          <div class="col-sm-8 net_green">
                            <input class="form-control greentest" name="net_salary" id="net_salary" type="number"
                              min="1" />
                            <span class="text-danger" id="err"></span>
                            <input class="form-control" name="staff_id" value="your_staff_id_here" type="hidden" />
                            <input class="form-control" name="month" value="your_month_here" type="hidden" />
                            <input class="form-control" name="year" value="your_year_here" type="hidden" />
                            <input class="form-control" name="status" value="generated" type="hidden" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <button type="submit" id="contact_submit" class="btn btn-info pull-right">Save</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
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
      api_link: "/api/fetch_staff_list",
    };
  },
  props: {
    staff_with_attendance: [Array, Object],
    profile_image: [Array, Object],
    attendance_records: [Array, Object],
  },
  mounted() { },
  created() { },
  methods: {
    formatDate(date) {
      const parts = date.split('-');
      const year = parts[2];
      const month = parseInt(parts[1], 10) - 1; // Subtract 1 to adjust for JavaScript's 0-based month
      const formattedMonth = new Date(year, month, parts[0]).toLocaleDateString('en-US', { month: 'long' });
      return `${formattedMonth}`;
    },
  },
};
</script>

<style scoped>


.table {
    font-size: 13px;
    color: var(--base-font-color) !important;
    border: 1px solid var(--table-border-color) !important; 
    -webkit-box-shadow: none !important; 
    box-shadow: none !important; 
}

.table[data-v-5e3c20fc] {
    font-size: 13px;
    color: var(--base-font-color) !important;
    border: none !important; 
    box-shadow: none !important; 
}
hr {
  margin-left: -0px;
  margin-right: -0px;
  border-top: 0.5px solid rgba(0, 0, 0, 0.1);

}

.col-sm-8 {

  max-width: 100%;
}

.table td[data-v-5e3c20fc],
.table th[data-v-5e3c20fc] {
  padding: 0.2rem;
  padding-left: 10px;
  vertical-align: top;
  border-top: 1px solid #dee2e6;
  border-bottom: 1px solid #dee2e6;
}


.imgprofile {
  vertical-align: middle;
  border-style: none;
  width: 90px;
  height: 125px;
  overflow: hidden;
  object-fit: cover;
}


.table th {
  font-size: 12px;
  padding: 0.20rem;
  vertical-align: top;
  border-top: none !important;
  font-weight: bold;
}

.table td,
.table th {
  padding: 0.20rem;
  padding-left: 10px;
  vertical-align: top;
  border-top: 1px solid #dee2e6;
}

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
}</style>
