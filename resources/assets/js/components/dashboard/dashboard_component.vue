
<style>
.jumbotron {
  background-color: #f8f8f8;
  padding: 30px;
  border-radius: 10px;
  margin: 20px 0;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  color: #333;
  /* Text color */
}

.dashboard_row {
  width: 100%;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
.dashboard_row:hover {
  cursor: pointer;
  box-shadow: 0 8px 16px 0 rgba(0, 5, 0, 0.2);
}

.Vendors {
  width: 100%;
  background: linear-gradient(to right, #70bfff, #6080e0);
  color: #ffffff;
  text-align: center;
}

.Customers {
  width: 100%;
  background: linear-gradient(to right, #70bfff, #6080e0);
  color: #ffffff;
  text-align: center;
}




.staff {
  width: 100%;
  background: linear-gradient(to right, #70bfff, #6080e0);
  color: #ffffff;
  text-align: center;
}




.total_purchase {
  width: 100%;
  background: linear-gradient(to right, #70bfff, #6080e0);
  color: #ffffff;
  text-align: center;
}



.chart_container {
  width: 100%;
  max-width: 600px;
  /* Adjust the maximum width as needed */
  margin: 0 auto;
  /* Center the container horizontally */
  padding: 10px;
  background-color: #FEFEFE;
  border-bottom: 1px solid #fdfdfd;
  border-left: 1px solid #f8f8f8;
  border-right: 1px solid #f8f8f8;
  border-bottom-right-radius: 5px;
  border-bottom-left-radius: 5px;

  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.chart_title {
  font-size: 15px;
  font-weight: 400;
  padding: 5px;
  border-top: 1px solid #f8f8f8;
  border-left: 1px solid #f8f8f8;
  border-right: 1px solid #f8f8f8;
  background-color: #FEFEFE;
  border-top-right-radius: 5px;
  border-top-left-radius: 5px;

}

#sale_purchase_chart {
  width: 100%;
  height: 300px;
}
</style>
<template>
  <div class="row">
    <div class="col-md-12">
      <div class="d-flex flex-wrap mb-4">
        <div class="mr-auto">
          <div class="d-flex">
            <div>
              <span class="text-title"> {{ $t("Dashboard") }} </span>
            </div>
          </div>
        </div>
        <div class="">
          <date-picker type="month" :lang="date.lang" :format="date.format" v-model="dashboard_month"
            @change="dashboard_month_change" input-class="form-control bg-white"></date-picker>
        </div>
      </div>

      <!--  ====================== total customer vendors and staff start ==========   -->

      <div class="d-flex flex-wrap mb-4">
        <div class="mr-auto">
          <div class="d-flex mb-2">
            <div>
              <!-- <span class="text-subhead-bold"> {{ $t("Today") }} </span> -->
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="row">
            <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3 box" :title="todays_order_count.raw">
              <div class="dashboard_row col-14  bg-white rounded custom-border-light"
              style="width: 100% ;">
                <div class="d-flex align-items-center flex-column box-content ">
                  <div class="Vendors  text-subhead p-2 " id="Vendors/Suppliers">
                    {{ $t("Vendors/Suppliers") }}
                  </div>

                  <div class="mt-auto p-4">
                    <span>
                      <i class="fa fa-circle-notch fa-spin" v-if="stats_processing == true"></i>
                      <div class="d-flex flex-column align-items-center" v-else>
                        <!-- <span class="text-headline d-block mb-1">{{ todays_order_count.raw }}</span> -->
                        <input v-knob class="knob" type="text" value="500" />
                        <span :class="{
                          'text-success':
                            Math.sign(todays_order_count.difference) == 1,
                          'text-danger':
                            Math.sign(todays_order_count.difference) == -1,
                        }" v-show="todays_order_count.difference !== 0">
                          <span v-show="Math.sign(todays_order_count.difference) == 1
                            "><i class="fas fa-long-arrow-alt-up"></i></span>
                          <span v-show="Math.sign(todays_order_count.difference) == -1
                            "><i class="fas fa-long-arrow-alt-down"></i></span>
                          {{ todays_order_count.difference }}%
                        </span>
                      </div>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3 box" :title="todays_order_count.raw">
              <div class="dashboard_row col-14  bg-white rounded custom-border-light">
                <div class="d-flex align-items-center flex-column box-content">
                  <div class="Customers text-subhead p-2">
                    {{ $t("Users / Customers") }}
                  </div>


                  <div class="mt-auto p-4">
                    <span>
                      <i class="fa fa-circle-notch fa-spin" v-if="stats_processing == true"></i>
                      <div class="d-flex flex-column align-items-center" v-else>
                        <!-- <span class="text-headline d-block mb-1">{{ todays_order_count.raw }}</span> -->
                        <input v-knob class="knob" type="text" value="3498" />
                        <span :class="{
                          'text-success':
                            Math.sign(todays_order_count.difference) == 1,
                          'text-danger':
                            Math.sign(todays_order_count.difference) == -1,
                        }" v-show="todays_order_count.difference !== 0">
                          <span v-show="Math.sign(todays_order_count.difference) == 1
                            "><i class="fas fa-long-arrow-alt-up"></i></span>
                          <span v-show="Math.sign(todays_order_count.difference) == -1
                            "><i class="fas fa-long-arrow-alt-down"></i></span>
                          {{ todays_order_count.difference }}%
                        </span>
                      </div>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3 box" :title="todays_order_count.raw">
              <div class="dashboard_row col-14  bg-white rounded custom-border-light">
                <div class="d-flex align-items-center flex-column box-content">
                  <div class="staff text-subhead p-2">{{ $t("Staff") }}</div>

                  <div class="mt-auto p-4">
                    <span>
                      <i class="fa fa-circle-notch fa-spin" v-if="stats_processing == true"></i>
                      <div class="d-flex flex-column align-items-center" v-else>
                        <!-- <span class="text-headline d-block mb-1">{{ todays_order_count.raw }}</span> -->
                        <input v-knob class="knob" type="text" value="1934" />
                        <span :class="{
                          'text-success':
                            Math.sign(todays_order_count.difference) == 1,
                          'text-danger':
                            Math.sign(todays_order_count.difference) == -1,
                        }" v-show="todays_order_count.difference !== 0">
                          <span v-show="Math.sign(todays_order_count.difference) == 1
                            "><i class="fas fa-long-arrow-alt-up"></i></span>
                          <span v-show="Math.sign(todays_order_count.difference) == -1
                            "><i class="fas fa-long-arrow-alt-down"></i></span>
                          {{ todays_order_count.difference }}%
                        </span>
                      </div>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3 box" :title="todays_order_count.raw">
              <div class="dashboard_row col-14 bg-white rounded custom-border-light"
                >
                <div class="d-flex align-items-center flex-column box-content">
                  <div class="total_purchase text-subhead p-2">
                    {{ $t("Total Purchase Orders") }}
                  </div>

                  <div class="mt-auto p-4">
                    <span>
                      <i class="fa fa-circle-notch fa-spin" v-if="stats_processing == true"></i>
                      <div class="d-flex flex-column align-items-center" v-else>
                        <!-- <span class="text-headline d-block mb-1">{{ todays_order_count.raw }}</span> -->
                        <input v-knob class="knob" type="text" value="398" />
                        <span :class="{
                          'text-success':
                            Math.sign(todays_order_count.difference) == 1,
                          'text-danger':
                            Math.sign(todays_order_count.difference) == -1,
                        }" v-show="todays_order_count.difference !== 0">
                          <span v-show="Math.sign(todays_order_count.difference) == 1
                            "><i class="fas fa-long-arrow-alt-up"></i></span>
                          <span v-show="Math.sign(todays_order_count.difference) == -1
                            "><i class="fas fa-long-arrow-alt-down"></i></span>
                          {{ todays_order_count.difference }}%
                        </span>
                      </div>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--  ====================== total customer vendors and staff start ==========   -->

      <!-- total income and expense graphics respresentation  start  -->
      <div class="d-flex flex-wrap mb-4">
        <div class="mr-auto">
          <div class="d-flex mb-2">
            <div>
              <span class="text-subhead-bold">
                {{ $t("INCOME & EXPENSE") }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="row">
            <!-- <div class="container">
              <div class="jumbotron" style="max-width: 920px; margin: 20px auto;">
                <div id="chartContainer" style="height: 370px;"></div>
              </div>
            </div> -->

            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4" style="border-radius: 20px">
              <div class="rounded custom-border-light">
                <div class="chart_title width-100% ">
                  <strong class="p-4">

                    {{ $t("Total Income") }}
                  </strong>
                </div>
                <div class="chart_container">
                  <canvas id="income_expense_chart" class=""></canvas>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4" style="border-radius: 20px">
              <div class="rounded custom-border-light">
                <div class="chart_title width-100% ">
                  <strong class="p-4">
                    {{ $t("Total Expense") }}
                  </strong>
                </div>
                <div class="chart_container">
                  <canvas id="income_expense_chart1" class=""></canvas>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4" style="border-radius: 20px">
              <div class="rounded custom-border-light">
                <div class="chart_title width-100% ">
                  <strong class="p-4">
                    {{ $t("Total Net Profits") }}
                  </strong>
                </div>
                <div class="chart_container">
                  <canvas id="income_expense_chart2" class=""></canvas>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- total income and expense graphics respresentation  end  -->

      <!-- total sales and PURCHASE graphics respresentation  start  -->
      <div class="d-flex flex-wrap mb-4">
        <div class="mr-auto">
          <div class="d-flex mb-2">
            <div>
              <span class="text-subhead-bold">
                {{ $t("TOTAL SALE AND PURCHASE") }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
              <div class="rounded custom-border-light">
                <div class="chart_title width-100% ">
                  <strong class="p-4">
                    {{ $t("Total Sales ") }}
                  </strong>
                </div>

                <div class="chart_container">
                  <canvas id="sale_purchase_chart" class=""></canvas>
                </div>


              </div>

            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6" style="border-radius: 20px">
              <div class="rounded custom-border-light">
                <div class="chart_title width-100% ">
                  <strong class="p-4">
                    {{ $t("Total Purchase") }}
                  </strong>
                </div>
                <div class="chart_container">
                  <canvas id="sale_purchase_chart1" class=""></canvas>
                </div>
              </div>
            </div>
            <!-- <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 " style="border-radius:20px;">
                <div class="rounded custom-border-light">
                  <strong class="p-4">
                        {{ $t("Total Net Profits") }}
                  </strong>
                  <div class="chart_container">
                    <canvas id="sale_purchase_chart2" class=""></canvas>
                  </div>
                </div>
            </div>         -->
          </div>
        </div>
      </div>

      <!-- total sale and puraches graphics respresentation  end  -->



      <!-- total stock in and stock out   start -->
      <div class="d-flex flex-wrap mb-4">
        <div class="mr-auto">
          <div class="d-flex mb-2">
            <div>
              <span class="text-subhead-bold">
                {{ $t("TOTAL STOCK IN AND STOCK OUT") }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6" style="border-radius: 20px">
              <div class="rounded custom-border-light">
                <div class="chart_title width-100% ">
                  <strong class="p-4">
                    {{ $t("Total Stock In") }}
                  </strong>
                </div>
                <div class="chart_container">
                  <canvas id="sale_stock_in_chart" class=""></canvas>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6" style="border-radius: 20px">
              <div class="rounded custom-border-light">
                <div class="chart_title width-100% ">
                  <strong class="p-4">
                    {{ $t("Total Stock Out") }}
                  </strong>
                </div>
                <div class="chart_container">
                  <canvas id="sale_stock_out_chart" class=""></canvas>
                </div>
              </div>
            </div>
            <!-- <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 " style="border-radius:20px;">
                <div class="rounded custom-border-light">
                  <strong class="p-4">
                        {{ $t("Total Net Profits") }}
                  </strong>
                  <div class="chart_container">
                    <canvas id="sale_purchase_chart2" class=""></canvas>
                  </div>
                </div>
            </div>         -->
          </div>
        </div>
      </div>


      <!-- total stock in and stock out   end -->

      <div class="d-flex flex-wrap mb-4">
        <div class="mr-auto">
          <div class="d-flex mb-2">
            <div>
              <span class="text-subhead-bold"> {{ $t("Month") }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="row">
            <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3 box" :title="order_count.raw">
              <div class="col-12 p-3 bg-white rounded custom-border-light">
                <div class="d-flex align-items-center flex-column box-content">
                  <div class="text-subhead p-2">{{ $t("Total Sales") }}</div>

                  <div class="mt-auto p-2">
                    <span class="text-headline">
                      <input v-knob class="knob" type="text" value="2423" />
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3 box" :title="order_value.raw">
              <div class="col-12 p-3 bg-white rounded custom-border-light">
                <div class="d-flex align-items-center flex-column box-content">
                  <div class="text-subhead p-2">
                    {{ $t("Total Sale Value") }}
                  </div>

                  <div class="mt-auto p-2">
                    <span class="text-headline">
                      <input v-knob class="knob" type="text" value="2324" />
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3 box" :title="revenue_value.raw">
              <div class="col-12 p-3 bg-white rounded custom-border-light">
                <div class="d-flex align-items-center flex-column box-content">
                  <div class="text-subhead p-2">
                    {{ $t("Total Revenue") }}
                  </div>

                  <div class="mt-auto p-2">
                    <span class="text-headline">
                      <input v-knob class="knob" type="text" value="223" />
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3 box" :title="invoices_count.raw">
              <div class="col-12 p-3 bg-white rounded custom-border-light">
                <div class="d-flex align-items-center flex-column box-content">
                  <div class="text-subhead p-2">{{ $t("Total Invoices") }}</div>

                  <div class="mt-auto p-2">
                    <span class="text-headline">
                      <input v-knob class="knob" type="text" value="523" />
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3 box" :title="expense.raw">
              <div class="col-12 p-3 bg-white rounded custom-border-light">
                <div class="d-flex align-items-center flex-column box-content">
                  <div class="text-subhead p-2">
                    {{ $t("Total Expense") }}
                  </div>

                  <div class="mt-auto p-2">
                    <span class="text-headline">
                      <input v-knob class="knob" type="text" value="123" />
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3 box" :title="net_profit_value.raw">
              <div class="col-12 p-3 bg-white rounded custom-border-light">
                <div class="d-flex align-items-center flex-column box-content">
                  <div class="text-subhead p-2">
                    {{ $t("Net Profit") }}
                  </div>

                  <div class="mt-auto p-2">
                    <span class="text-headline">
                      <input v-knob class="knob" type="text" value="232" />
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3 box" :title="customer_count.raw">
              <div class="col-12 p-3 bg-white rounded custom-border-light">
                <div class="d-flex align-items-center flex-column box-content">
                  <div class="text-subhead p-2">
                    {{ $t("Total Customers") }}
                  </div>

                  <div class="mt-auto p-2">
                    <span class="text-headline">
                      <input v-knob class="knob" type="text" value="465" />
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3 box" :title="purchase_order_count.raw">
              <div class="col-12 p-3 bg-white rounded custom-border-light">
                <div class="d-flex align-items-center flex-column box-content">
                  <div class="text-subhead p-2">
                    {{ $t("Total Purchase Orders") }}
                  </div>

                  <div class="mt-auto p-2">
                    <span class="text-headline">
                      <input v-knob class="knob" type="text" value="23" />
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="d-flex flex-wrap mb-4" style="display: none !important">
        <div class="col-md-12">
          <div class="row">
            <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-6 box">
              <div class="col-12 rounded custom-border-light">
                <div class="d-flex flex-wrap box-content">
                  <div class="d-flex col-sm-12 col-md-12 col-lg-12 col-xl-12 p-1">
                    <div class="chart_container">
                      <canvas id="pos_sales_count_activity_chart" class=""></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-6 box">
              <div class="col-12 rounded custom-border-light">
                <div class="d-flex flex-wrap box-content">
                  <div class="d-flex col-sm-12 col-md-12 col-lg-12 col-xl-12 p-1">
                    <div class="chart_container d-flex align-items-center">
                      <canvas id="horizontal_chart"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex flex-wrap mb-4" style="display: none !important">
        <div class="mr-auto">
          <div class="d-flex mb-2">
            <div>
              <span class="text-subhead-bold"> {{ $t("Today") }} </span>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="row">
            <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3 box" :title="todays_order_count.raw">
              <div class="col-12 p-3 bg-white rounded custom-border-light">
                <div class="d-flex align-items-center flex-column box-content">
                  <div class="text-subhead p-2">{{ $t("Sales") }}</div>

                  <div class="mt-auto p-2">
                    <span>
                      <i class="fa fa-circle-notch fa-spin" v-if="stats_processing == true"></i>
                      <div class="d-flex flex-column align-items-center" v-else>
                        <input v-knob class="knob" type="text" :value="todays_order_count.raw" />
                        <span :class="{
                          'text-success':
                            Math.sign(todays_order_count.difference) == 1,
                          'text-danger':
                            Math.sign(todays_order_count.difference) == -1,
                        }" v-show="todays_order_count.difference !== 0">
                          <span v-show="Math.sign(todays_order_count.difference) == 1
                            "><i class="fas fa-long-arrow-alt-up"></i></span>
                          <span v-show="Math.sign(todays_order_count.difference) == -1
                            "><i class="fas fa-long-arrow-alt-down"></i></span>
                          {{ todays_order_count.difference }}%
                        </span>
                      </div>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3 box">
              <div class="col-12 rounded custom-border-light">
                <div class="d-flex p-3 flex-wrap box-content">
                  <div class="d-flex col-sm-12 col-md-12 col-lg-12 col-xl-12 p-0">
                    <div class="stat_chart_container">
                      <canvas id="today_sales_count_chart" class=""></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3 box" :title="todays_order_value.raw">
              <div class="col-12 p-3 bg-white rounded custom-border-light">
                <div class="d-flex align-items-center flex-column box-content">
                  <div class="text-subhead p-2">{{ $t("Sale Value") }}</div>

                  <div class="mt-auto p-2">
                    <span>
                      <i class="fa fa-circle-notch fa-spin" v-if="stats_processing == true"></i>
                      <div class="d-flex flex-column align-items-center" v-else>
                        <input v-knob class="knob" type="text" :value="todays_order_value.raw" />

                        <span :class="{
                          'text-success':
                            Math.sign(todays_order_value.difference) == 1,
                          'text-danger':
                            Math.sign(todays_order_value.difference) == -1,
                        }" v-show="todays_order_value.difference !== 0">
                          <span v-show="Math.sign(todays_order_value.difference) == 1
                            "><i class="fas fa-long-arrow-alt-up"></i></span>
                          <span v-show="Math.sign(todays_order_value.difference) == -1
                            "><i class="fas fa-long-arrow-alt-down"></i></span>
                          {{ todays_order_value.difference }}%
                        </span>
                      </div>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3 box">
              <div class="col-12 p-3 bg-white rounded custom-border-light">
                <div class="d-flex flex-wrap box-content">
                  <div class="d-flex col-sm-12 col-md-12 col-lg-12 col-xl-12 p-0">
                    <div class="stat_chart_container">
                      <canvas id="today_sales_value_chart" class=""></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- <div class="d-flex flex-wrap">
        <div class="mr-auto">
          <div class="d-flex mb-2">
            <div>
              <span class="text-subhead-bold"> {{ $t("Targets") }} </span>
            </div>
          </div>
        </div>
      </div> -->

      <!-- <div class="d-flex flex-wrap mb-4">
        <div class="col-md-12">
          <div class="row">
            <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3">
              <div class="col-12 p-3 bg-white rounded custom-border-light">
                <div class="d-flex align-items-center flex-column box-content">
                  <div class="text-subhead p-2">
                    {{ $t("Income") }}
                  </div>

                  <div class="mt-auto p-2">
                    <span class="dashboard-target-label">
                      <canvas id="myChart"></canvas>
                    </span>
                  </div>

                 
                </div>
              </div>
            </div>

            <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3">
              <div class="col-12 p-3 bg-white rounded custom-border-light">
                <div class="d-flex align-items-center flex-column box-content">
                  <div class="text-subhead p-2">
                    {{ $t("Expense") }} 
                  </div>

                  <div class="mt-auto p-2">
                    <span class="dashboard-target-label">
                      <canvas id="myChart1"></canvas>
                    </span>
                  </div>

                  <div class="progress mt-2 w-100 progress-height">
                    <div
                      class="progress-bar"
                      role="progressbar"
                      v-bind:style="{ width: target.expense_width }"
                      v-bind:aria-valuenow="expense.raw"
                      aria-valuemin="0"
                      v-bind:aria-valuemax="target.expense"
                    ></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3">
              <div class="col-12 p-3 bg-white rounded custom-border-light">
                <div class="d-flex align-items-center flex-column box-content">
                  <div class="text-subhead p-2">
                    {{ $t("Sales") }} 
                  </div>

                  <div class="mt-auto p-2">
                    <span class="dashboard-target-label">
                      <canvas id="myChart2"></canvas>
                    </span>
                  </div>

                  <div class="progress mt-2 w-100 progress-height">
                    <div
                      class="progress-bar"
                      role="progressbar"
                      v-bind:style="{ width: target.sales_width }"
                      v-bind:aria-valuenow="order_value.raw"
                      aria-valuemin="0"
                      v-bind:aria-valuemax="target.sales"
                    ></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3">
              <div class="col-12 p-3 bg-white rounded custom-border-light">
                <div class="d-flex align-items-center flex-column box-content">
                  <div class="text-subhead p-2">
                    {{ $t("Net Profit") }}
                  </div>

                  <div class="mt-auto p-2">
                    <span class="dashboard-target-label">
                      <canvas id="myChart3"></canvas>
                    </span>
                  </div>

                  <div class="progress mt-2 w-100 progress-height">
                    <div
                      class="progress-bar"
                      role="progressbar"
                      v-bind:style="{ width: target.net_profit_width }"
                      v-bind:aria-valuenow="net_profit_value.raw"
                      aria-valuemin="0"
                      v-bind:aria-valuemax="target.net_profit"
                    ></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> -->

      <div class="d-flex flex-wrap mb-4">

        <!-- <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8 pl-sm-0 pl-md-3 pr-4">
          <div class="mr-auto">
            <div class="d-flex mb-2">
              <div>
                <span class="text-subhead-bold">
                  {{ $t("Recent Transactions") }}
                </span>
              </div>
            </div>
          </div>
          <div class="">
            <div class="table-container">
              <div class="table-responsive mb-2" v-if="transactions.length > 0">
                <table class="table display nowrap text-nowrap w-100">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">{{ $t("Transaction Code") }}</th>
                      <th scope="col">{{ $t("Transaction Date") }}</th>
                      <th scope="col">{{ $t("Transaction Type") }}</th>
                      <th scope="col">{{ $t("Payment Method") }}</th>
                      <th scope="col" class="text-right">{{ $t("Amount") }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(transaction, key, index) in transactions"
                      v-bind:value="transactions.slack"
                      v-bind:key="index"
                    >
                      <th scope="col">{{ key + 1 }}</th>
                      <td>{{ transaction.transaction_code }}</td>
                      <td>{{ transaction.transaction_date }}</td>
                      <td>{{ transaction.label }}</td>
                      <td>{{ transaction.payment_method }}</td>
                      <td class="text-right">{{ transaction.amount }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div v-else>Transactions not found</div>
            </div>
          </div>
        </div> -->
      </div>


      <!-- <div class="container">
        <h1>Chart Integration Example</h1>
        <div id="app">
          <chart-component></chart-component>
        </div>
      </div> -->



    </div>

  </div>
</template>
<script>


</script>




<script>
"use strict";
import "jquery";
import "jquery-knob";
import DatePicker from "vue2-datepicker";
import moment from "moment";
import Chart from "chart.js/auto";

export default {
  data() {
    return {
      date: {
        lang: "en",
        format: "YYYY-MM",
      },

      dashboard_month: new Date(moment().format("YYYY-MM")),
      dashboard_month_formatted: new Date(moment().format("YYYY-MM")),
      store_currency: this.store.currency_code,

      stats_processing: false,
      todays_order_count: {
        raw: "-",
        formatted: "-",
        difference: "",
      },
      todays_order_value: {
        raw: "-",
        formatted: "-",
        difference: "",
      },
      order_count: {
        raw: "-",
        formatted: "-",
      },
      order_value: {
        raw: "-",
        formatted: "-",
      },
      revenue_value: {
        raw: "-",
        formatted: "-",
      },
      customer_count: {
        raw: "-",
        formatted: "-",
      },
      expense: {
        raw: "-",
        formatted: "-",
      },
      net_profit_value: {
        raw: "-",
        formatted: "-",
      },
      purchase_order_count: {
        raw: "-",
        formatted: "-",
      },
      invoices_count: {
        raw: "-",
        formatted: "-",
      },

      target: {
        income: "-",
        income_width: 0,

        expense: "-",
        expense_width: 0,

        sales: "-",
        sales_width: 0,

        net_profit: "-",
        net_profit_width: 0,
      },

      transactions: [],

      todays_sales_count_chart_color: "#1F6EEB",
      todays_sales_value_chart_color: "#FF6283",

      pos_sales_count_activity_chart_fill_color: "#4BC0C0",
      pos_sales_value_activity_chart_fill_color: "#FF9E40",

      income_chart_fill_color: "#059BFF",
      expense_chart_fill_color: "#FFC233",

      todays_sales_count_chart_config: {
        type: "line",
        data: {
          datasets: [],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            title: {
              display: true,
              text: "Sale Count",
            },
            legend: {
              display: false,
            },
          },
          scales: {
            x: {
              grid: {
                display: false,
              },
              display: true,
              ticks: {
                font: {
                  size: 8,
                  weight: 500,
                },
                minRotation: 0,
                align: "inner",
                padding: 0,
              },
            },
            y: {
              display: false,
            },
          },
        },
      },

      todays_sales_value_chart_config: {
        type: "line",
        data: {
          datasets: [],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            title: {
              display: true,
              text: "Sale Value",
            },
            legend: {
              display: false,
            },
          },
          scales: {
            x: {
              grid: {
                display: false,
              },
              display: true,
              ticks: {
                font: {
                  size: 8,
                  weight: 500,
                },
                minRotation: 0,
                align: "inner",
                padding: 0,
              },
            },
            y: {
              display: false,
            },
          },
        },
      },

      pos_sales_count_activity_chart_config: {
        type: "line",
        data: {
          datasets: [],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            title: {
              display: true,
              text: "Order Count Day Wise",
            },
            legend: {
              display: false,
            },
          },
          scales: {
            x: {
              grid: {
                display: false,
              },
              title: {
                display: true,
                text: "Day of the month",
              },
              display: true,
              ticks: {
                font: {
                  size: 8,
                  weight: 400,
                },
                minRotation: 0,
                align: "inner",
                padding: 0,
              },
            },
            y: {
              grid: {
                display: true,
                lineWidth: 0.4,
              },
              title: {
                display: true,
                text: "Count",
              },
              ticks: {
                font: {
                  size: 8,
                  weight: 400,
                },
              },
            },
          },
        },
      },

      pos_sales_value_activity_chart_config: {
        type: "line",
        data: {
          datasets: [],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            title: {
              display: true,
              text: "Order Value Day Wise",
            },
            legend: {
              display: false,
            },
          },
          scales: {
            x: {
              grid: {
                display: false,
              },
              title: {
                display: true,
                text: "Day of the month",
              },
              display: true,
              ticks: {
                font: {
                  size: 8,
                  weight: 400,
                },
                minRotation: 0,
                align: "inner",
                padding: 0,
              },
            },
            y: {
              grid: {
                display: true,
                lineWidth: 0.4,
              },
              title: {
                display: true,
                text: "Order Value",
              },
              ticks: {
                font: {
                  size: 8,
                  weight: 400,
                },
              },
            },
          },
        },
      },

      income_expense_chart: {
        type: "pie",
        // type: "doughnut",
        data: {
          datasets: [],
          labels: ["LAPTOPS", "PC", "MOUSE", "CABLES"],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            display: false,
          },
          title: {
            display: false,
            text: "",
          },
          animation: {
            animateScale: true,
            animateRotate: true,
          },
          layout: {
            padding: {
              top: 40,
              bottom: 40,
              left: 40,
              right: 40,
            },
          },
        },
      },
      income_expense_chart1: {
        type: "pie",
        // type: "doughnut",
        data: {
          datasets: [],
          labels: ["KEYBOARDS", "MOUSES"],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            display: false,
          },
          title: {
            display: false,
            text: "",
          },
          animation: {
            animateScale: true,
            animateRotate: true,
          },
          layout: {
            padding: {
              top: 40,
              bottom: 40,
              left: 40,
              right: 40,
            },
          },
        },
      },

      income_expense_chart2: {
        type: "pie",
        // type: "doughnut",
        data: {
          datasets: [],
          labels: ["NET PROFITS"],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            display: false,
          },
          title: {
            display: false,
            text: "",
          },
          animation: {
            animateScale: true,
            animateRotate: true,
          },
          layout: {
            padding: {
              top: 40,
              bottom: 40,
              left: 40,
              right: 40,
            },
          },
        },
      },
    };
  },
  props: {
    store: [Array, Object],
    value: Number,
  },
  directives: {
    knob: {
      inserted(el) {
        const availableColors = ["#FF5733", "#C70039", "#900C3F", "#FFC300", "#3366FF", "#00CC66", "#8B008B", "#FF6347", "#9933CC", "#FF9900"];
        const randomColor = availableColors[Math.floor(Math.random() * availableColors.length)];
        $(el).knob({
          min: 0,
          max: 9999,
          readOnly: true,
          width: 100,
          height: 100,
          fgColor: randomColor,
        });
      },
      unbind(el) {
        $(el).trigger("remove");
      },
    },
  },
  mounted() {
    console.log("Dashboard loaded");
    this.fire_requests();
    this.renderChart();
    this.renderChartForTotalSales();
    this.renderChartForTotalStockIn();
    this.renderChartForTotalStockOut();
    this.renderChartForTotalPurchase();
    // console.log(this.getRandomColor);

    this.targetAchieveGraph();
    this.targetAchieveGraph1();
    this.targetAchieveGraph2();
    this.targetAchieveGraph3();
  },
  methods: {
    convert_date_format(date) {
      return date != "" ? moment(date).format("YYYY-MM") : "";
    },



    renderChart() {
      const ctx = document.getElementById("horizontal_chart").getContext("2d");

      new Chart(ctx, {
        type: "bar",
        data: {
          labels: ["Label 1", "Label 2", "Label 3", "Label 4"],
          datasets: [
            {
              label: "Dataset Label",
              backgroundColor: "rgba(75, 192, 192, 0.6)",
              borderColor: "rgba(75, 192, 192, 1)",
              borderWidth: 1,
              data: [10, 20, 15, 30],
            },
          ],
        },
        options: {
          scales: {
            xAxes: [
              {
                ticks: {
                  beginAtZero: true,
                },
              },
            ],
            yAxes: [
              {
                ticks: {
                  reverse: true,
                },
              },
            ],
          },
        },
      });
    },

    renderChartForTotalStockOut() {
      const ctx = document
        .getElementById("sale_stock_out_chart")
        .getContext("2d");

      new Chart(ctx, {
        type: "bar",
        data: {
          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'], // Add the labels for each month
          datasets: [
            {
              label: "Dataset Label",
              backgroundColor: "rgba(75, 192, 192, 0.6)",
              borderColor: "rgba(75, 192, 192, 1)",
              borderWidth: 1,
              data: [10, 20, 15, 30, 10, 20, 15, 30, 10, 20, 15, 30],
            },
          ],
        },
        options: {
          scales: {
            xAxes: [
              {
                ticks: {
                  beginAtZero: true,
                },
              },
            ],
            yAxes: [
              {
                ticks: {
                  reverse: true,
                },
              },
            ],
          },
        },
      });
    },

    renderChartForTotalStockIn() {
      const ctx = document
        .getElementById("sale_stock_in_chart")
        .getContext("2d");

      new Chart(ctx, {
        type: "line",
        data: {
          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'], // Add the labels for each month
          datasets: [
            {
              label: "Dataset Label",
              backgroundColor: "rgba(75, 192, 192, 0.6)",
              borderColor: "rgba(75, 192, 192, 1)",
              borderWidth: 1,
              data: [10, 20, 15, 30, 10, 20, 15, 30, 10, 20, 15, 30],
            },
          ],
        },
        options: {
          scales: {
            xAxes: [
              {
                ticks: {
                  beginAtZero: true,
                },
              },
            ],
            yAxes: [
              {
                ticks: {
                  reverse: true,
                },
              },
            ],
          },
        },
      });
    },

    renderChartForTotalSales() {
      const ctx = document
        .getElementById("sale_purchase_chart")
        .getContext("2d");

      new Chart(ctx, {
        type: "line",
        data: {
          labels: ['January', 'February', 'March', 'April'], // Add the labels for each month
          datasets: [
            {
              label: "Dataset Label",
              backgroundColor: "rgba(75, 192, 192, 0.6)",
              borderColor: "rgba(75, 192, 192, 1)",
              borderWidth: 1,
              data: [10, 20, 15, 30],
            },
          ],
        },
        options: {
          scales: {
            xAxes: [
              {
                ticks: {
                  beginAtZero: true,
                },
              },
            ],
            yAxes: [
              {
                ticks: {
                  reverse: true,
                },
              },
            ],
          },
        },
      });
    },


    renderChartForTotalPurchase() {
      const ctx = document
        .getElementById("sale_purchase_chart1")
        .getContext("2d");

      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['January', 'February', 'March', 'April'], // Add the labels for each month
          datasets: [
            {
              label: 'Dataset Label',
              backgroundColor: 'rgba(75, 192, 192, 0.6)',
              borderColor: 'rgba(75, 192, 192, 1)',
              borderWidth: 1,
              data: [10, 20, 15, 30],
            },
          ],
        },
        options: {
          scales: {
            xAxes: [
              {
                ticks: {
                  beginAtZero: true,
                },
                position: 'top', // Change the x-axis position to 'top'
              },
            ],
            yAxes: [
              {
                ticks: {
                  reverse: true,
                },
                position: 'right', // Change the y-axis position to 'right'
              },
            ],
          },
        },
      });

    },

    targetAchieveGraph1() {
      const targetValues = [200, 300, 400]; // Replace with your target values
      const achievedValues = [10, 200, 320]; // Replace with your achieved values
      const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May']; // Replace with your labels
      const ctx1 = document.getElementById('myChart1').getContext('2d');
      const myChart1 = new Chart(ctx1, {
        type: 'line',
        data: {
          labels: labels,
          datasets: [{
            label: 'Target',
            borderColor: 'rgba(255, 99, 132, 1)',
            data: targetValues,
            fill: true,
          }, {
            label: 'Achieved',
            borderColor: 'rgba(54, 162, 235, 1)',
            data: achievedValues,
            fill: true,
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          },
          plugins: {
            annotation: {
              annotations: [
                {
                  type: 'bar',
                  mode: 'vertical',
                  scaleID: 'x',
                  value: 'Feb', // Change to the appropriate label where you want to add an arrow
                  borderColor: 'gray',
                  borderWidth: 2,
                  label: {
                    enabled: true,
                    content: 'Arrow',
                    position: 'top'
                  }
                }
              ]
            }
          }
        }
      });
    },
    targetAchieveGraph() {
      const targetValues = [100, 200, 300]; // Replace with your target values
      const achievedValues = [20, 100, 120]; // Replace with your achieved values
      const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May']; // Replace with your labels

      const ctx = document.getElementById('myChart').getContext('2d');
      const myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: labels,
          datasets: [{
            label: 'Target',
            borderColor: 'rgba(255, 99, 132, 1)',
            data: targetValues,
            fill: true,
          }, {
            label: 'Achieved',
            borderColor: 'rgba(54, 162, 235, 1)',
            data: achievedValues,
            fill: true,
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          },
          plugins: {
            annotation: {
              annotations: [
                {
                  type: 'bar',
                  mode: 'vertical',
                  scaleID: 'x',
                  value: 'Feb', // Change to the appropriate label where you want to add an arrow
                  borderColor: 'gray',
                  borderWidth: 2,
                  label: {
                    enabled: true,
                    content: 'Arrow',
                    position: 'top'
                  }
                }
              ]
            }
          }
        }
      });


    },
    targetAchieveGraph2() {
      const targetValues = [200, 300, 400]; // Replace with your target values
      const achievedValues = [110, 290, 390]; // Replace with your achieved values
      const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May']; // Replace with your labels
      const ctx1 = document.getElementById('myChart2').getContext('2d');
      const myChart1 = new Chart(ctx1, {
        type: 'line',
        data: {
          labels: labels,
          datasets: [{
            label: 'Target',
            borderColor: 'rgba(255, 99, 132, 1)',
            data: targetValues,
            fill: true,
          }, {
            label: 'Achieved',
            borderColor: 'rgba(54, 162, 235, 1)',
            data: achievedValues,
            fill: true,
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          },
          plugins: {
            annotation: {
              annotations: [
                {
                  type: 'bar',
                  mode: 'vertical',
                  scaleID: 'x',
                  value: 'Feb', // Change to the appropriate label where you want to add an arrow
                  borderColor: 'gray',
                  borderWidth: 2,
                  label: {
                    enabled: true,
                    content: 'Arrow',
                    position: 'top'
                  }
                }
              ]
            }
          }
        }
      });
    },

    targetAchieveGraph3() {
      const targetValues = [200, 300, 400]; // Replace with your target values
      const achievedValues = [110, 290, 390]; // Replace with your achieved values
      const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May']; // Replace with your labels
      const ctx1 = document.getElementById('myChart3').getContext('2d');
      const myChart1 = new Chart(ctx1, {
        type: 'line',
        data: {
          labels: labels,
          datasets: [{
            label: 'Target',
            borderColor: 'rgba(255, 99, 132, 1)',
            data: targetValues,
            fill: true,
          }, {
            label: 'Achieved',
            borderColor: 'rgba(54, 162, 235, 1)',
            data: achievedValues,
            fill: true,
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          },
          plugins: {
            annotation: {
              annotations: [
                {
                  type: 'bar',
                  mode: 'vertical',
                  scaleID: 'x',
                  value: 'Feb', // Change to the appropriate label where you want to add an arrow
                  borderColor: 'gray',
                  borderWidth: 2,
                  label: {
                    enabled: true,
                    content: 'Arrow',
                    position: 'top'
                  }
                }
              ]
            }
          }
        }
      });
    },



    dashboard_month_change() {
      this.dashboard_month_formatted = this.convert_date_format(
        this.dashboard_month
      );
      this.fire_requests();
    },

    set_form_data() {
      var formData = new FormData();
      formData.append("access_token", window.settings.access_token);
      formData.append(
        "date",
        this.convert_date_format(this.dashboard_month_formatted)
      );
      return formData;
    },

    fire_requests() {
      this.get_dashboard_stats();

      this.order_count_activity_chart();

      this.get_recent_trasactions();

      //this.trending_products();
    },

    get_dashboard_stats() {
      var formData = this.set_form_data();

      this.stats_processing = true;

      axios
        .post("/api/get_dashboard_stats", formData)
        .then((response) => {
          this.stats_processing = false;
          if (response.data.status_code == 200) {
            this.todays_order_count.raw =
              response.data.data.todays_order_count.count_raw;
            this.todays_order_count.formatted =
              response.data.data.todays_order_count.count_formatted;
            this.todays_order_count.difference =
              response.data.data.todays_order_count.difference;

            this.todays_order_value.raw =
              response.data.data.todays_order_value.count_raw;
            this.todays_order_value.formatted =
              response.data.data.todays_order_value.count_formatted;
            this.todays_order_value.difference =
              response.data.data.todays_order_value.difference;

            this.order_count.raw = response.data.data.order_count.count_raw;
            this.order_count.formatted =
              response.data.data.order_count.count_formatted;

            this.order_value.raw = response.data.data.order_value.count_raw;
            this.order_value.formatted =
              response.data.data.order_value.count_formatted;

            this.order_count.raw = response.data.data.order_count.count_raw;
            this.order_count.formatted =
              response.data.data.order_count.count_formatted;

            this.revenue_value.raw = response.data.data.revenue_value.count_raw;
            this.revenue_value.formatted =
              response.data.data.revenue_value.count_formatted;

            this.customer_count.raw =
              response.data.data.customer_count.count_raw;
            this.customer_count.formatted =
              response.data.data.customer_count.count_formatted;

            this.expense.raw = response.data.data.expense.count_raw;
            this.expense.formatted = response.data.data.expense.count_formatted;

            this.net_profit_value.raw =
              response.data.data.net_profit_value.count_raw;
            this.net_profit_value.formatted =
              response.data.data.net_profit_value.count_formatted;

            this.purchase_order_count.raw =
              response.data.data.purchase_order_count.count_raw;
            this.purchase_order_count.formatted =
              response.data.data.purchase_order_count.count_formatted;

            this.invoices_count.raw =
              response.data.data.invoices_count.count_raw;
            this.invoices_count.formatted =
              response.data.data.invoices_count.count_formatted;

            //stats
            this.target.income = response.data.data.targets.income;
            this.target.income_width =
              (response.data.data.revenue_value.count_raw /
                response.data.data.targets.income) *
              100 +
              "%";

            this.target.expense = response.data.data.targets.expense;
            this.target.expense_width =
              (response.data.data.expense.count_raw /
                response.data.data.targets.expense) *
              100 +
              "%";

            this.target.sales = response.data.data.targets.sales;
            this.target.sales_width =
              (response.data.data.order_value.count_raw /
                response.data.data.targets.sales) *
              100 +
              "%";

            this.target.net_profit = response.data.data.targets.net_profit;
            this.target.net_profit_width =
              (response.data.data.net_profit_value.count_raw /
                response.data.data.targets.net_profit) *
              100 +
              "%";

            var today_sales_count_chart = this.create_chart(
              "today_sales_count_chart",
              this.todays_sales_count_chart_config
            );
            today_sales_count_chart.data.datasets = [];
            today_sales_count_chart.data.labels =
              response.data.data.todays_order_count.chart.x_axis;
            today_sales_count_chart.data.datasets.push({
              data: response.data.data.todays_order_count.chart.y_axis,
              fill: true,
              pointStyle: "circle",
              pointRadius: 1,
              pointHoverRadius: 5,
              pointBackgroundColor: "#3E3F42",
              showLine: false,
              backgroundColor: this.todays_sales_count_chart_color,
            });
            today_sales_count_chart.update();

            var today_sales_value_chart = this.create_chart(
              "today_sales_value_chart",
              this.todays_sales_value_chart_config
            );
            today_sales_value_chart.data.datasets = [];
            today_sales_value_chart.data.labels =
              response.data.data.todays_order_value.chart.x_axis;
            today_sales_value_chart.data.datasets.push({
              data: response.data.data.todays_order_value.chart.y_axis,
              fill: true,
              pointStyle: "circle",
              pointRadius: 1,
              pointHoverRadius: 5,
              pointBackgroundColor: "#3E3F42",
              showLine: false,
              backgroundColor: this.todays_sales_value_chart_color,
            });
            today_sales_value_chart.update();

            var income_expense_chart = this.create_chart(
              "income_expense_chart",
              this.income_expense_chart
            );

            var income_expense_chart1 = this.create_chart(
              "income_expense_chart1",
              this.income_expense_chart1
            );

            var income_expense_chart2 = this.create_chart(
              "income_expense_chart2",
              this.income_expense_chart2
            );

            income_expense_chart.data.datasets = [];
            income_expense_chart.data.datasets.push({
              backgroundColor: ["#FF5733", "#3366FF", "#900C3F", "#FFC300",],
              borderColor: "#FFF",
              data: [4, 5, 54, 34],
            });
            income_expense_chart.update();

            income_expense_chart1.data.datasets = [];
            income_expense_chart1.data.datasets.push({
              backgroundColor: ["#3366FF", "#FF5733", "#FFC300", "#900C3F"],
              borderColor: "#FFF",
              data: [43, 3, 4, 34],
            });
            income_expense_chart1.update();

            income_expense_chart2.data.datasets = [];
            income_expense_chart2.data.datasets.push({
              backgroundColor: [this.income_chart_fill_color],
              borderColor: "#FFF",
              data: [2030500],
            });
            income_expense_chart2.update();
          } else {
            this.todays_order_count.raw = "-";
            this.todays_order_count.formatted = "-";

            this.todays_order_value.raw = "-";
            this.todays_order_value.formatted = "-";

            this.order_count.raw = "-";
            this.order_count.formatted = "-";

            this.order_value.raw = "-";
            this.order_value.formatted = "-";

            this.order_count.raw = "-";
            this.order_count.formatted = "-";

            this.revenue_value.raw = "-";
            this.revenue_value.formatted = "-";

            this.customer_count.raw = "-";
            this.customer_count.formatted = "-";

            this.expense.raw = "-";
            this.expense.formatted = "-";

            this.net_profit_value.raw = "-";
            this.net_profit_value.formatted = "-";

            this.purchase_order_count.raw = "-";
            this.purchase_order_count.formatted = "-";

            this.invoices_count.raw = "-";
            this.invoices_count.formatted = "-";
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    create_chart(canvas_id, chart_data) {
      var chart_exist = Chart.getChart(canvas_id);
      if (chart_exist != undefined) chart_exist.destroy();

      var ctx = document.getElementById(canvas_id);
      var chart = new Chart(ctx, {
        type: chart_data.type,
        data: chart_data.data,
        options: chart_data.options,
      });
      return chart;
    },

    order_count_activity_chart() {
      var formData = this.set_form_data();
      axios
        .post("/api/get_order_chart_stats", formData)
        .then((response) => {
          if (response.data.status_code == 200) {
            var pos_sales_count_activity_chart = this.create_chart(
              "pos_sales_count_activity_chart",
              this.pos_sales_count_activity_chart_config
            );
            var pos_sales_value_activity_chart = this.create_chart(
              "pos_sales_value_activity_chart",
              this.pos_sales_value_activity_chart_config
            );

            var pos_sales_value_activity_chart1 = this.create_chart(
              "pos_sales_value_activity_chart1",
              this.pos_sales_value_activity_chart_config
            );

            pos_sales_count_activity_chart.data.datasets = [];
            pos_sales_count_activity_chart.data.labels =
              response.data.data.x_axis;
            pos_sales_count_activity_chart.data.datasets.push({
              label: "Order Count",
              data: response.data.data.y_axis.order_count,
              fill: true,
              pointStyle: "circle",
              pointRadius: 1,
              pointHoverRadius: 5,
              pointBackgroundColor: "#3E3F42",
              showLine: false,
              backgroundColor: this.pos_sales_count_activity_chart_fill_color,
            });
            pos_sales_count_activity_chart.update();

            pos_sales_value_activity_chart.data.datasets = [];
            pos_sales_value_activity_chart.data.labels =
              response.data.data.x_axis;
            pos_sales_value_activity_chart.data.datasets.push({
              label: "Order Value (" + this.store_currency + ")",
              data: response.data.data.y_axis.order_value,
              fill: true,
              pointStyle: "circle",
              pointRadius: 1,
              pointHoverRadius: 5,
              pointBackgroundColor: "#3E3F42",
              showLine: false,
              backgroundColor: this.pos_sales_value_activity_chart_fill_color,
            });
            pos_sales_value_activity_chart.update();

            pos_sales_value_activity_chart1.data.datasets = [];
            pos_sales_value_activity_chart1.data.labels =
              response.data.data.x_axis;
            pos_sales_value_activity_chart1.data.datasets.push({
              label: "Order Value (" + this.store_currency + ")",
              data: response.data.data.y_axis.order_value,
              fill: true,
              pointStyle: "circle",
              pointRadius: 1,
              pointHoverRadius: 5,
              pointBackgroundColor: "#3E3F42",
              showLine: false,
              backgroundColor: this.pos_sales_value_activity_chart_fill_color,
            });
            pos_sales_value_activity_chart1.update();
          } else {
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    get_recent_trasactions() {
      var formData = this.set_form_data();

      axios
        .post("/api/get_recent_trasactions", formData)
        .then((response) => {
          if (response.data.status_code == 200) {
            this.transactions = response.data.data;
          } else {
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
