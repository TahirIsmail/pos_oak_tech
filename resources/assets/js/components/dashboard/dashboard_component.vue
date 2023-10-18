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
/* 
.dashboard_title {
  width: 100%;
  background: linear-gradient(to right, #70bfff, #6080e0);
  color: #ffffff;
  text-align: center;
} */
.dashboard_title {
  width: 100%;
  background: linear-gradient(to right, #1488cc, #5691c8);
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
  background-color: #fefefe;
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
  background-color: #fefefe;
  border-top-right-radius: 5px;
  border-top-left-radius: 5px;
}

#sale_purchase_chart {
  width: 100%;
  height: 300px;
}
</style>
<template>
  <div class="row" style="margin-left: -29px !important">
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
          <date-picker
            type="month"
            :lang="date.lang"
            :format="date.format"
            v-model="dashboard_month"
            @change="dashboard_month_change"
            input-class="form-control bg-white"
          ></date-picker>
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
            <div
              class="col-sm-12 col-md-12 col-lg-6   mb-5"
              style="margin-bottom: 30px"
            >
              <div
                class="row1 ap-po-details ap-po-details--2 radius-xl bg-white d-flex "
                style="padding: 25px"
              >
                <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="overview-content">
                    <h1>7,461</h1>
                    <p>Vendors/Suppliers</p>
                    <div class="ap-po-details-time">
                      <span class="color-success"
                        ><i class="las la-arrow-up"></i>
                        <strong>25%</strong></span
                      >
                      <small>Since last week</small>
                    </div>
                  </div>
                </div>
                <div class="ap-po-timeChart col-sm-12 col-md-4 col-lg-6">
                  <div class="overview-single__chart d-md-flex align-items-end">
                    <div class="parentContainer">
                      <div>
                        <canvas ref="myChart"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Card 4 End  -->
            </div>

            <div
              class="col-sm-12 col-md-12 col-lg-6  mb-5"
              style="margin-bottom: 30px"
            >
              <div
                class=" row1 ap-po-details ap-po-details--2 p-25 radius-xl bg-white d-flex justify-content-between"
                style="padding: 25px"
              >
              <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="overview-content">
                    <h1>7,461</h1>
                    <p>Users/Customers</p>
                    <div class="ap-po-details-time">
                      <span class="color-success"
                        ><i class="las la-arrow-up"></i>
                        <strong>25%</strong></span
                      >
                      <small>Since last week</small>
                    </div>
                  </div>
                </div>
                <div class="ap-po-timeChart col-sm-12 col-md-4 col-lg-6">
                  <div class="overview-single__chart d-md-flex align-items-end">
                    <div class="parentContainer">
                      <div>
                        <canvas ref="myChart13"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Card 2 End  -->
            </div>

            <div class="col-sm-12 col-md-12 col-lg-6  mb-5" style="margin-bottom: 30px">
              <div
                class="row1  ap-po-details ap-po-details--2 p-25 radius-xl bg-white d-flex justify-content-between"
                style="padding: 25px"
              >
              <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="overview-content">
                    <h1>7,461</h1>
                    <p>Staff</p>
                    <div class="ap-po-details-time">
                      <span class="color-success"
                        ><i class="las la-arrow-up"></i>
                        <strong>25%</strong></span
                      >
                      <small>Since last week</small>
                    </div>
                  </div>
                </div>
                <div class="ap-po-timeChart col-sm-12 col-md-4 col-lg-6">
                  <div class="overview-single__chart d-md-flex align-items-end">
                    <div class="parentContainer">
                      <div>
                        <canvas ref="myChart14Ref"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Card 3 End  -->
            </div>

            <div class="col-sm-12 col-md-12 col-lg-6  mb-5" style="margin-bottom: 30px">
              <div
                class="row1 ap-po-details ap-po-details--2 p-25 radius-xl bg-white d-flex justify-content-between"
                style="padding: 25px"
              >
              <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="overview-content">
                    <h1>7,461</h1>
                    <p>Purchase Order</p>
                    <div class="ap-po-details-time">
                      <span class="color-success"
                        ><i class="las la-arrow-up"></i>
                        <strong>25%</strong></span
                      >
                      <small>Since last week</small>
                    </div>
                  </div>
                </div>
                <div class="ap-po-timeChart col-sm-12 col-md-4 col-lg-6">
                  <div class="overview-single__chart d-md-flex align-items-end">
                    <div class="parentContainer">
                      <div>
                        <canvas ref="myChart15Canvas"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Card 4 End  -->
            </div>
          </div>
        </div>
      </div>

      <!--  ====================== total customer vendors and staff start ==========   -->

      <div class="col-md-12">
        <div class="row">
          <!-- <div
            class="col-sm-12 col-md-12 col-lg-6 col-xl-4"
            style="border-radius: 20px"
          > -->
          <div class="col-sm-12 col-md-12 col-lg-6" style="border-radius: 20px">
            <div class="cardd">
              <div class="card-header-revenu">
                <h6>
                  INCOME & EXPENSE
                  <span>Nov 23, 2019 - Nov 29, 2019</span>
                </h6>
                <div class="card-extra">
                  <ul class="card-tab-links mr-3 nav-tabs nav" role="tablist">
                    <li>
                      <a
                        href="#t_revenue-week"
                        data-toggle="tab"
                        id="t_revenue-week-tab"
                        role="tab"
                        aria-selected="true"
                        >Week</a
                      >
                    </li>
                    <li>
                      <a
                        href="#t_revenue-month"
                        data-toggle="tab"
                        id="t_revenue-month-tab"
                        role="tab"
                        aria-selected="false"
                        >Month</a
                      >
                    </li>
                    <li>
                      <a
                        class="active"
                        href="#t_revenue-year"
                        data-toggle="tab"
                        id="t_revenue-year-tab"
                        role="tab"
                        aria-selected="false"
                        >Year</a
                      >
                    </li>
                  </ul>
                  <div class="dropdown dropleft">
                    <a
                      href="#"
                      role="button"
                      id="cash"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="la la-ellipsis-h"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="cash">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- ends: .card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div
                    class="tab-pane fade"
                    id="t_revenue-week"
                    role="tabpanel"
                    aria-labelledby="t_revenue-week-tab"
                  >
                    <div class="cashflow-display d-flex">
                      <div class="cashflow-display__single">
                        <span class="cashflow-display__title"
                          >Total Net Profit</span
                        >
                        <h2 class="cashflow-display__amount color-primary">
                          $2,784
                        </h2>
                      </div>
                      <!-- ends: .cashflow-display__single -->
                      <div class="cashflow-display__single">
                        <span class="cashflow-display__title"
                          >Total Income</span
                        >
                        <h2 class="cashflow-display__amount">$4,240</h2>
                      </div>
                      <!-- ends: .cashflow-display__single -->
                      <div class="cashflow-display__single">
                        <span class="cashflow-display__title"
                          >Total Expense</span
                        >
                        <h2 class="cashflow-display__amount">$2,470</h2>
                      </div>
                      <!-- ends: .cashflow-display__single -->
                    </div>

                    <div class="cashflow-chart">
                      <div class="parentContainer">
                        <div>
                          <canvas
                            class="canvasdispaly"
                            ref="barChartCashflow_W"
                          ></canvas>
                        </div>
                      </div>
                      <ul class="legend-static">
                        <li class="custom-label">
                          <span
                            style="background-color: rgb(95, 99, 242)"
                          ></span
                          >Total Income
                        </li>
                        <li class="custom-label">
                          <span
                            style="background-color: rgb(255, 77, 79)"
                          ></span
                          >Total Expense
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div
                    class="tab-pane fade"
                    id="t_revenue-month"
                    role="tabpanel"
                    aria-labelledby="t_revenue-month-tab"
                  >
                    <div class="cashflow-display d-flex">
                      <div class="cashflow-display__single">
                        <span class="cashflow-display__title"
                          >Total Net Profit</span
                        >
                        <h2 class="cashflow-display__amount color-primary">
                          $52,784
                        </h2>
                      </div>
                      <!-- ends: .cashflow-display__single -->
                      <div class="cashflow-display__single">
                        <span class="cashflow-display__title"
                          >Total Income</span
                        >
                        <h2 class="cashflow-display__amount">$74,240</h2>
                      </div>
                      <!-- ends: .cashflow-display__single -->
                      <div class="cashflow-display__single">
                        <span class="cashflow-display__title"
                          >Total Expense</span
                        >
                        <h2 class="cashflow-display__amount">$22,470</h2>
                      </div>
                      <!-- ends: .cashflow-display__single -->
                    </div>

                    <div class="cashflow-chart">
                      <div class="parentContainer">
                        <div>
                          <canvas
                            class="canvasdispaly"
                            ref="cashflowChartCanvas"
                          ></canvas>
                        </div>
                      </div>
                      <ul class="legend-static">
                        <li class="custom-label">
                          <span
                            style="background-color: rgb(95, 99, 242)"
                          ></span
                          >Total Income
                        </li>
                        <li class="custom-label">
                          <span
                            style="background-color: rgb(255, 77, 79)"
                          ></span
                          >Total Expense
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div
                    class="tab-pane fade active show"
                    id="t_revenue-year"
                    role="tabpanel"
                    aria-labelledby="t_revenue-year-tab"
                  >
                    <div class="cashflow-display d-flex">
                      <div class="cashflow-display__single">
                        <span class="cashflow-display__title"
                          >Total Net Profit</span
                        >
                        <h2 class="cashflow-display__amount color-primary">
                          $92,784
                        </h2>
                      </div>
                      <!-- ends: .cashflow-display__single -->
                      <div class="cashflow-display__single">
                        <span class="cashflow-display__title"
                          >Total Income</span
                        >
                        <h2 class="cashflow-display__amount">$104,240</h2>
                      </div>
                      <!-- ends: .cashflow-display__single -->
                      <div class="cashflow-display__single">
                        <span class="cashflow-display__title"
                          >Total Expense</span
                        >
                        <h2 class="cashflow-display__amount">$872,470</h2>
                      </div>
                      <!-- ends: .cashflow-display__single -->
                    </div>

                    <div class="cashflow-chart">
                      <div class="parentContainer">
                        <div>
                          <canvas
                            class="canvasdispaly"
                            id="barChartCashflow_Y"
                          ></canvas>
                        </div>
                      </div>
                      <ul class="legend-static">
                        <li class="custom-label">
                          <span style="background-color: #2c99ff"></span>Total
                          Income
                        </li>
                        <li class="custom-label">
                          <span style="background-color: #ff69a5"></span>Total
                          Expense
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <!-- ends: .card-body -->
            </div>
          </div>
          <!--  ====================== total sale purcahe ========== ////  -->

          <div class="col-sm-12 col-md-12 col-lg-6" style="border-radius: 20px">
            <div class="cardd revenueChartTwo broder-0">
              <div class="card-header-revenu">
                <h6>TOTAL SALE AND PURCHASE</h6>
                <div class="card-extra">
                  <ul class="card-tab-links mr-3 nav-tabs nav" role="tablist">
                    <li>
                      <a
                        class="active"
                        href="#tl_revenue-today"
                        data-toggle="tab"
                        id="tl_revenue-today-tab"
                        role="tab"
                        aria-selected="false"
                        >Today</a
                      >
                    </li>
                    <li>
                      <a
                        href="#tl_revenue-week"
                        data-toggle="tab"
                        id="tl_revenue-week-tab"
                        role="tab"
                        aria-selected="false"
                        >Week</a
                      >
                    </li>
                    <li>
                      <a
                        href="#tl_revenue-month"
                        data-toggle="tab"
                        id="tl_revenue-month-tab"
                        role="tab"
                        aria-selected="false"
                        >Month</a
                      >
                    </li>
                    <li>
                      <a
                        href="#tl_revenue-year"
                        data-toggle="tab"
                        id="tl_revenue-year-tab"
                        role="tab"
                        aria-selected="true"
                        >Year</a
                      >
                    </li>
                  </ul>
                  <div class="dropdown dropleft">
                    <a
                      href="#"
                      role="button"
                      id="revenue3"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <span data-feather="more-horizontal"></span>
                    </a>
                  </div>
                </div>
              </div>
              <!-- ends: .card-header -->
              <div class="card-body pt-0">
                <div class="tab-content">
                  <div
                    class="tab-pane fade active show"
                    id="tl_revenue-today"
                    role="tabpanel"
                    aria-labelledby="tl_revenue-today-tab"
                  >
                    <div class="revenue-labels">
                      <div class="current">
                        <strong class="text-third">$72,784</strong>
                        <span>Total Sale</span>
                      </div>
                      <div>
                        <strong>$52,240</strong>
                        <span style="color: #868eae !important"
                          >Total Purchase</span
                        >
                      </div>
                    </div>
                    <!-- ends: .performance-stats -->

                    <div class="wp-chart">
                      <div class="parentContainer">
                        <div>
                          <canvas
                            class="canvasdispaly"
                            ref="myChart6TExtra"
                          ></canvas>
                        </div>
                      </div>
                      <ul class="legend-static" style="margin-top: 7px">
                        <li class="custom-label">
                          <span
                            style="background-color: rgb(95, 99, 242)"
                          ></span
                          >Total Sale
                        </li>
                        <li class="custom-label">
                          <span
                            style="
                              background-color: rgb(134, 142, 174) !important;
                            "
                          ></span
                          >Total Purchase
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div
                    class="tab-pane fade"
                    id="tl_revenue-week"
                    role="tabpanel"
                    aria-labelledby="tl_revenue-week-tab"
                  >
                    <div class="revenue-labels">
                      <div class="current">
                        <strong class="text-third">$72,784</strong>
                        <span>Total Sale</span>
                      </div>
                      <div>
                        <strong>$52,240</strong>
                        <span style="color: #868eae !important"
                          >Total Purchase</span
                        >
                      </div>
                    </div>
                    <!-- ends: .performance-stats -->

                    <div class="wp-chart">
                      <div class="parentContainer">
                        <div>
                          <canvas
                            class="canvasdispaly"
                            ref="myChart6WExtra"
                          ></canvas>
                        </div>
                      </div>
                      <ul class="legend-static" style="margin-top: 7px">
                        <li class="custom-label">
                          <span
                            style="background-color: rgb(95, 99, 242)"
                          ></span
                          >Total Sale
                        </li>
                        <li class="custom-label">
                          <span
                            style="
                              background-color: rgb(134, 142, 174) !important;
                            "
                          ></span
                          >Total Purchase
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div
                    class="tab-pane fade"
                    id="tl_revenue-month"
                    role="tabpanel"
                    aria-labelledby="tl_revenue-month-tab"
                  >
                    <div class="revenue-labels">
                      <div class="current">
                        <strong class="text-third">$72,784</strong>
                        <span>Total Sale</span>
                      </div>
                      <div>
                        <strong>$52,240</strong>
                        <span style="color: #868eae !important"
                          >Total Purchase</span
                        >
                      </div>
                    </div>
                    <!-- ends: .performance-stats -->

                    <div class="wp-chart">
                      <div class="parentContainer">
                        <div>
                          <canvas
                            class="canvasdispaly"
                            ref="myChart6MExtra"
                          ></canvas>
                        </div>
                      </div>
                      <ul class="legend-static" style="margin-top: 7px">
                        <li class="custom-label">
                          <span
                            style="background-color: rgb(95, 99, 242)"
                          ></span
                          >Total Sale
                        </li>
                        <li class="custom-label">
                          <span
                            style="
                              background-color: rgb(134, 142, 174) !important;
                            "
                          ></span
                          >Total Purchase
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div
                    class="tab-pane fade"
                    id="tl_revenue-year"
                    role="tabpanel"
                    aria-labelledby="tl_revenue-year-tab"
                  >
                    <div class="revenue-labels">
                      <div class="current">
                        <strong class="text-third">$72,784</strong>
                        <span>Total Sale</span>
                      </div>
                      <div>
                        <strong>$52,240</strong>
                        <span style="color: #868eae !important"
                          >Total Purchase</span
                        >
                      </div>
                    </div>
                    <!-- ends: .performance-stats -->

                    <div class="wp-chart">
                      <div class="parentContainer">
                        <div>
                          <canvas
                            class="canvasdispaly"
                            ref="myChart6Extra"
                          ></canvas>
                        </div>
                      </div>
                      <ul class="legend-static" style="margin-top: 7px">
                        <li class="custom-label">
                          <span
                            style="background-color: rgb(95, 99, 242)"
                          ></span
                          >Total Sale
                        </li>
                        <li class="custom-label">
                          <span
                            style="
                              background-color: rgb(134, 142, 174) !important;
                            "
                          ></span
                          >Total Purchase
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <!-- ends: .card-body -->
            </div>
          </div>

          <!--  ====================== TOTAL STOCK IN AND STOCK OUT ========== ////  -->

          <div
            class="col-sm-12 col-md-12 col-lg-12"
            style="border-radius: 20px; margin-top: 30px"
          >
            <div class="cardd revenueChartTwo broder-0">
              <div class="card-header-revenu">
                <h6>TOTAL STOCK-IN AND STOCK-OUT</h6>
                <div class="card-extra">
                  <ul class="card-tab-links mr-3 nav-tabs nav" role="tablist">
                    <li>
                      <a
                        class="active"
                        href="#tl_stock-today"
                        data-toggle="tab"
                        id="tl_stock-today-tab"
                        role="tab"
                        aria-selected="false"
                        >Today</a
                      >
                    </li>
                    <li>
                      <a
                        href="#tl_stock-week"
                        data-toggle="tab"
                        id="tl_stock-week-tab"
                        role="tab"
                        aria-selected="false"
                        >Week</a
                      >
                    </li>
                    <li>
                      <a
                        href="#tl_stock-month"
                        data-toggle="tab"
                        id="tl_stock-month-tab"
                        role="tab"
                        aria-selected="false"
                        >Month</a
                      >
                    </li>
                    <li>
                      <a
                        href="#tl_stock-year"
                        data-toggle="tab"
                        id="tl_stock-year-tab"
                        role="tab"
                        aria-selected="true"
                        >Year</a
                      >
                    </li>
                  </ul>
                  <div class="dropdown dropleft">
                    <a
                      href="#"
                      role="button"
                      id="stock3"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <span data-feather="more-horizontal"></span>
                    </a>
                  </div>
                </div>
              </div>
              <!-- ends: .card-header -->
              <div class="card-body pt-0">
                <div class="tab-content">
                  <div
                    class="tab-pane fade active show"
                    id="tl_stock-today"
                    role="tabpanel"
                    aria-labelledby="tl_stock-today-tab"
                  >
                    <div class="revenue-labels">
                      <div class="current">
                        <strong class="text-third">$72,784</strong>
                        <span>Total Stock-In</span>
                      </div>
                      <div>
                        <strong>$52,240</strong>
                        <span style="color: #868eae !important"
                          >Total Stock-Out</span
                        >
                      </div>
                    </div>
                    <!-- ends: .performance-stats -->

                    <div class="wp-chart">
                      <div class="parentContainer">
                        <div>
                          <canvas
                            class="canvasdispaly"
                            ref="myChart6TodayExtra"
                          ></canvas>
                        </div>
                      </div>
                      <ul class="legend-static">
                        <li class="custom-label">
                          <span
                            style="background-color: rgb(95, 99, 242)"
                          ></span
                          >Total Stock-In
                        </li>
                        <li class="custom-label">
                          <span
                            style="
                              background-color: rgb(134, 142, 174) !important;
                            "
                          ></span
                          >Total Stock-Out
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div
                    class="tab-pane fade"
                    id="tl_stock-week"
                    role="tabpanel"
                    aria-labelledby="tl_stock-week-tab"
                  >
                    <div class="revenue-labels">
                      <div class="current">
                        <strong class="text-third">$72,784</strong>
                        <span>Total Stock-In</span>
                      </div>
                      <div>
                        <strong>$52,240</strong>
                        <span style="color: #868eae !important"
                          >Total Stock-Out</span
                        >
                      </div>
                    </div>
                    <!-- ends: .performance-stats -->

                    <div class="wp-chart">
                      <div class="parentContainer">
                        <div>
                          <canvas
                            class="canvasdispaly"
                            ref="myChart6WeekExtra"
                          ></canvas>
                        </div>
                      </div>
                      <ul class="legend-static">
                        <li class="custom-label">
                          <span
                            style="background-color: rgb(95, 99, 242)"
                          ></span
                          >Total Stock-In
                        </li>
                        <li class="custom-label">
                          <span
                            style="
                              background-color: rgb(134, 142, 174) !important;
                            "
                          ></span
                          >Total Stock-Out
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div
                    class="tab-pane fade"
                    id="tl_stock-month"
                    role="tabpanel"
                    aria-labelledby="tl_stock-month-tab"
                  >
                    <div class="revenue-labels">
                      <div class="current">
                        <strong class="text-third">$72,784</strong>
                        <span>Total Stock-In</span>
                      </div>
                      <div>
                        <strong>$52,240</strong>
                        <span style="color: #868eae !important"
                          >Total Stock-Out</span
                        >
                      </div>
                    </div>
                    <!-- ends: .performance-stats -->

                    <div class="wp-chart">
                      <div class="parentContainer">
                        <div>
                          <canvas
                            class="canvasdispaly"
                            ref="myChart6MonthExtra"
                          ></canvas>
                        </div>
                      </div>
                      <ul class="legend-static">
                        <li class="custom-label">
                          <span
                            style="background-color: rgb(95, 99, 242)"
                          ></span
                          >Total Stock-In
                        </li>
                        <li class="custom-label">
                          <span
                            style="
                              background-color: rgb(134, 142, 174) !important;
                            "
                          ></span
                          >Total Stock-Out
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div
                    class="tab-pane fade"
                    id="tl_stock-year"
                    role="tabpanel"
                    aria-labelledby="tl_stock-year-tab"
                  >
                    <div class="revenue-labels">
                      <div class="current">
                        <strong class="text-third">$72,784</strong>
                        <span>Total Stock-In</span>
                      </div>
                      <div>
                        <strong>$52,240</strong>
                        <span style="color: #868eae !important"
                          >Total Stock-Out</span
                        >
                      </div>
                    </div>
                    <!-- ends: .performance-stats -->

                    <div class="wp-chart">
                      <div class="parentContainer">
                        <div>
                          <canvas
                            class="canvasdispaly"
                            ref="myChart6yearExtra"
                          ></canvas>
                        </div>
                      </div>
                      <ul class="legend-static">
                        <li class="custom-label">
                          <span
                            style="background-color: rgb(95, 99, 242)"
                          ></span
                          >Total Stock-In
                        </li>
                        <li class="custom-label">
                          <span
                            style="
                              background-color: rgb(134, 142, 174) !important;
                            "
                          ></span
                          >Total Stock-Out
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <!-- ends: .card-body -->
            </div>
          </div>

          <!--  ====================== Total detail per month ========== ////  -->

          <div class="col-md-12" style="margin-top: 30px">
            <div class="row">
              <div
                class="col-sm-12 col-md-12 col-lg-3"
                style="
                  border-radius: 20px;
                  margin-top: 10px;
                  margin-bottom: 10px;
                "
              >
                <div class="forcast-cardbox">
                  <h6 class="forcast-title">Net Profit</h6>
                  <div class="forcast-details">
                    <h1 class="forcast-value">$42.5k</h1>
                    <p class="forcast-status">
                      <span class="percentage color-success">
                        <span data-feather="arrow-up"></span>
                        <span>25%</span>
                      </span>
                      <span class="forcast-text">Since last month</span>
                    </p>
                  </div>
                  <div class="forcast__chart">
                    <div class="parentContainer">
                      <div>
                        <canvas class=" forcart_canvas" ref="lineChartCanvas"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- ends: .forcast-cardbox -->
              </div>

              <div
                class="col-sm-12 col-md-12 col-lg-3"
                style="
                  border-radius: 20px;
                  margin-top: 10px;
                  margin-bottom: 10px;
                "
              >
                <div class="forcast-cardbox">
                  <h6 class="forcast-title">Total Sale Value</h6>
                  <div class="forcast-details">
                    <h1 class="forcast-value">$42.5k</h1>
                    <p class="forcast-status">
                      <span class="percentage color-success">
                        <span data-feather="arrow-up"></span>
                        <span>25%</span>
                      </span>
                      <span class="forcast-text">Since last month</span>
                    </p>
                  </div>
                  <div class="forcast__chart">
                    <div class="parentContainer">
                      <div>
                        <canvas class=" forcart_canvas" ref="lineChartCanvastvalue"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- ends: .forcast-cardbox -->
              </div>

              <div
                class="col-sm-12 col-md-12 col-lg-3"
                style="
                  border-radius: 20px;
                  margin-top: 10px;
                  margin-bottom: 10px;
                "
              >
                <div class="forcast-cardbox">
                  <h6 class="forcast-title">Total Revenue</h6>
                  <div class="forcast-details">
                    <h1 class="forcast-value">$42.5k</h1>
                    <p class="forcast-status">
                      <span class="percentage color-success">
                        <span data-feather="arrow-up"></span>
                        <span>25%</span>
                      </span>
                      <span class="forcast-text">Since last month</span>
                    </p>
                  </div>
                  <div class="forcast__chart">
                    <div class="parentContainer">
                      <div>
                        <canvas class=" forcart_canvas" ref="lineChartCanvastRevenue"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- ends: .forcast-cardbox -->
              </div>

              <div
                class="col-sm-12 col-md-12 col-lg-3"
                style="
                  border-radius: 20px;
                  margin-top: 10px;
                  margin-bottom: 10px;
                "
              >
                <div class="forcast-cardbox">
                  <h6 class="forcast-title">Total Invoices</h6>
                  <div class="forcast-details">
                    <h1 class="forcast-value">$42.5k</h1>
                    <p class="forcast-status">
                      <span class="percentage color-success">
                        <span data-feather="arrow-up"></span>
                        <span>25%</span>
                      </span>
                      <span class="forcast-text">Since last month</span>
                    </p>
                  </div>
                  <div class="forcast__chart">
                    <div class="parentContainer">
                      <div>
                        <canvas class=" forcart_canvas" ref="lineChartCanvastInvoices"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- ends: .forcast-cardbox -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
"use strict";
import "jquery";
import "jquery-knob";
import DatePicker from "vue2-datepicker";
import moment from "moment";
import Chart from "chart.js/auto";

// import Chart from 'chart.js';
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

      transactions: [],
      chartData: [45, 35, 50, 20, 70, 40, 15],

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
    };
  },
  props: {
    store: [Array, Object],
    value: Number,
  },

  mounted() {
    this.renderLineChart_tInvoices();
    this.renderLineChart_tRevenue();
    this.renderLineChart_tvalue();

    this.renderLineChart();
    this.Chart6MonthExtra();
    this.Chart6WeekExtra();
    this.Chart6yearExtra();
    this.Chart6TodayExtra();
    this.initializeChart();
    this.initializeChartM();
    this.initializeChartw();
    this.Chart6TExtra();
    this.createChart_Y();
    this.createChart_W();
    this.initializeCashflowChart();

    this.chartData = [45, 35, 50, 20, 40, 15];
    this.staff();

    this.chartData = [45, 35, 20, 70, 40, 15];
    this.totalPurchase();
    // this.chartData = [45, 35, 50, 20, 70, 40, 15];
    this.createChart();

    this.createBarChart();

    this.targetAchieveGraph();
    this.targetAchieveGraph1();
    this.targetAchieveGraph2();
    this.targetAchieveGraph3();
  },
  methods: {
    convert_date_format(date) {
      return date != "" ? moment(date).format("YYYY-MM") : "";
    },

  
   

    createChart() {
      const ctx = this.$refs.myChart;

      if (ctx) {
        const chart = new Chart(ctx, {
          type: "bar",
          data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
            datasets: [
              {
                label: "New Contact",
                data: this.chartData,
                backgroundColor: "#FF69A520",
                hoverBackgroundColor: "#FF69A5",
              },
            ],
          },
          options: {
            maintainAspectRatio: true,
            responsive: true,
            legend: {
              display: false,
              labels: {
                display: false,
              },
            },
            tooltips: {
              mode: "label",
              intersect: false,
              position: "average",
              enabled: false,
              custom: this.customTooltips,
              callbacks: {
                label: (tooltipItem, data) => {
                  const dataset = data.datasets[tooltipItem.datasetIndex];
                  const yLabel = tooltipItem.yLabel;
                  return `<span class="chart-data">${yLabel}</span> <span class="data-label">${dataset.label}</span>`;
                },
                labelColor: (tooltipItem, chart) => {
                  const dataset =
                    chart.config.data.datasets[tooltipItem.datasetIndex];
                  return {
                    backgroundColor: dataset.hoverBackgroundColor,
                    borderColor: "transparent",
                    usePointStyle: true,
                  };
                },
              },
            },
            scales: {
              yAxes: [
                {
                  display: false,
                  stacked: true,
                  gridLines: {
                    display: false, // Hide the y-axis grid lines
                  },
                  ticks: {
                    display: false,
                  },
                },
              ],
              xAxes: [
                {
                  display: false,
                  stacked: true,
                  barPercentage: 1,

                  ticks: {
                    display: false,
                  },
                },
              ],
            },
            plugins: {
          legend: {
            display: false,
          },
        },
          },
        });
      }
    },

    createBarChart() {
      const selector = "myChart13";
      const bgColor = "#5F63F220";
      const hBgColor = "#5F63F2";
      const label = "New Deals";

      const ctx = this.$refs.myChart13;
      if (ctx) {
        const chart = new Chart(ctx, {
          type: "bar",
          data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
            datasets: [
              {
                label: label,
                data: [45, 35, 50, 20, 70, 40, 15],
                backgroundColor: bgColor,
                hoverBackgroundColor: hBgColor,
              },
            ],
          },
          options: {
            maintainAspectRatio: true,
            responsive: true,
            legend: {
              display: false,
              labels: {
                display: false,
              },
            },
            tooltips: {
              mode: "label",
              intersect: false,
              position: "average",
              enabled: false,
              custom: this.customTooltips,
              callbacks: {
                label: (tooltipItem, data) => {
                  const dstLabel =
                    data.datasets[tooltipItem.datasetIndex].label;
                  const { yLabel } = tooltipItem;
                  return `<span class="chart-data">${yLabel}</span> <span class="data-label">${dstLabel}</span>`;
                },
                labelColor: (tooltipItem, chart) => {
                  const dataset =
                    chart.config.data.datasets[tooltipItem.datasetIndex];
                  return {
                    backgroundColor: dataset.hoverBackgroundColor,
                    borderColor: "transparent",
                    usePointStyle: true,
                  };
                },
              },
            },
            scales: {
              yAxes: [
                {
                  stacked: true,
                  gridLines: {
                    display: false,
                  },
                  ticks: {
                    display: false,
                  },
                },
              ],
              xAxes: [
                {
                  stacked: true,
                  barPercentage: 1,
                  gridLines: {
                    display: false,
                  },
                  ticks: {
                    display: false,
                  },
                },
              ],
            },
            plugins: {
          legend: {
            display: false,
          },
        },
          },
        });
      }
    },

    staff() {
      const selector = "myChart14";
      const bgColor = "#20C99720";
      const hBgColor = "#20C997";
      const label = "New Leads";

      const ctx = this.$refs.myChart14Ref;
      if (ctx) {
        const chart = new Chart(ctx, {
          type: "bar",
          data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
            datasets: [
              {
                label: label,
                data: this.chartData,
                backgroundColor: bgColor,
                hoverBackgroundColor: hBgColor,
              },
            ],
          },
          options: {
            maintainAspectRatio: true,
            responsive: true,
            legend: {
              display: false,
              labels: {
                display: false,
              },
            },
            tooltips: {
              mode: "label",
              intersect: false,
              position: "average",
              enabled: false,
              custom: this.customTooltips,
              callbacks: {
                label: (tooltipItem, data) => {
                  const dstLabel =
                    data.datasets[tooltipItem.datasetIndex].label;
                  const { yLabel } = tooltipItem;
                  return `<span class="chart-data">${yLabel}</span> <span class="data-label">${dstLabel}</span>`;
                },
                labelColor: (tooltipItem, chart) => {
                  const dataset =
                    chart.config.data.datasets[tooltipItem.datasetIndex];
                  return {
                    backgroundColor: dataset.hoverBackgroundColor,
                    borderColor: "transparent",
                    usePointStyle: true,
                  };
                },
              },
            },
            scales: {
              yAxes: [
                {
                  stacked: true,
                  gridLines: {
                    display: false,
                  },
                  ticks: {
                    display: false,
                  },
                },
              ],
              xAxes: [
                {
                  stacked: true,
                  barPercentage: 1,
                  gridLines: {
                    display: false,
                  },
                  ticks: {
                    display: false,
                  },
                },
              ],
            },
            plugins: {
          legend: {
            display: false,
          },
        },
          },
        });
      }
    },

    totalPurchase() {
  const selector = "myChart15Canvas";
  const bgColor = "#2C99FF20";
  const hBgColor = "#2C99FF";
  const label = "Total";

  const canvas = this.$refs.myChart15Canvas;
  if (canvas) {
    const chart = new Chart(canvas, {
      type: "bar",
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
        datasets: [
          {
            label: label,
            data: this.chartData,
            backgroundColor: bgColor,
            hoverBackgroundColor: hBgColor,
          },
        ],
      },
      options: {
        maintainAspectRatio: true,
        responsive: true,
        legend: {
          display: false,
          labels: {
            display: false,
          },
        },
        tooltips: {
          mode: "label",
          intersect: false,
          position: "average",
          enabled: false,
          custom: this.customTooltips,
          callbacks: {
            label: (tooltipItem, data) => {
              const dstLabel = data.datasets[tooltipItem.datasetIndex].label;
              const { yLabel } = tooltipItem;
              return `<span class="chart-data">${yLabel}</span> <span class="data-label">${dstLabel}</span>`;
            },
            labelColor: (tooltipItem, chart) => {
              const dataset = chart.config.data.datasets[tooltipItem.datasetIndex];
              return {
                backgroundColor: dataset.hoverBackgroundColor,
                borderColor: "transparent",
                usePointStyle: true,
              };
            },
          },
        },
        scales: {
          yAxes: [
            {
              stacked: true,
              gridLines: {
                display: false, // Remove y-axis grid lines
              },
              ticks: {
                display: false,
              },
            },
          ],
          xAxes: [
            {
              stacked: true,
              barPercentage: 1,
              gridLines: {
                
                display: false, // Remove x-axis grid lines
              },
              ticks: {
                display: false,
              },
            },
          ],
        },
        plugins: {
          legend: {
            display: false,
          },
        },
      },
    });
  }
},


    initializeCashflowChart() {
      const ctx = this.$refs.cashflowChartCanvas;
      if (ctx) {
        const data1 = [20, 60, 50, 45, 50, 60, 70, 40, 45, 35, 25, 30];
        const data2 = [10, 40, 30, 40, 60, 55, 45, 35, 30, 20, 15, 20];
        const labels = ["1-5", "6-10", "11-15", "16-20", "21-25", "26-30"];

        new Chart(ctx, {
          type: "bar",
          data: {
            labels: labels,
            datasets: [
              {
                label: "Dataset 1",
                data: data1,
                backgroundColor: "#2C99FF20",
                borderColor: "#2C99FF25",
                borderWidth: 1,
                hoverBackgroundColor: "#2C99FF",
              },
              {
                label: "Dataset 2",
                data: data2,
                backgroundColor: "#FF69A520",
                borderColor: "#FF69A525",

                borderWidth: 1,
                hoverBackgroundColor: "#FF69A5",
              },
            ],
          },
          options: {
            scales: {
              yAxes: [
                {
                  ticks: {
                    beginAtZero: true,
                  },
                },
              ],
            },
            plugins: {
              legend: {
                display: false,
              },
            },
          },
        });
      }
    },

    createChart_W() {
      const ctx = this.$refs.barChartCashflow_W;
      if (ctx) {
        const data1 = [20, 60, 50, 45, 50, 60, 70];
        const data2 = [10, 40, 30, 40, 60, 55, 45];
        const labels = [
          "Sunday",
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
        ];

        new Chart(ctx, {
          type: "bar",
          data: {
            labels: labels,
            datasets: [
              {
                label: "Dataset 1",
                data: data1,
                backgroundColor: "#2C99FF20",
                borderColor: "#2C99FF25",
                borderWidth: 1,
                hoverBackgroundColor: "#2C99FF",
              },
              {
                label: "Dataset 2",
                data: data2,
                backgroundColor: "#FF69A520",
                borderColor: "#FF69A525",
                borderWidth: 1,
                hoverBackgroundColor: "#FF69A5",
              },
            ],
          },
          options: {
            scales: {
              yAxes: [
                {
                  ticks: {
                    beginAtZero: true,
                  },
                },
              ],
            },
            plugins: {
              legend: {
                display: false,
              },
            },
          },
        });
      }
    },

    createChart_Y() {
      const ctx = document.getElementById("barChartCashflow_Y");
      if (ctx) {
        const data1 = [35, 55, 25, 72, 45, 58, 35, 45, 65, 38, 45, 48];
        const data2 = [15, 35, 10, 16, 25, 44, 10, 5, 24, 18, 7, 36];
        const labels = [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ];
        new Chart(ctx, {
          type: "bar",
          data: {
            labels: labels,
            datasets: [
              {
                label: "Dataset 1",
                data: data1,
                backgroundColor: "#2C99FF20",
                borderColor: "#2C99FF25",
                borderWidth: 1,
                hoverBackgroundColor: "#2C99FF",
              },
              {
                label: "Dataset 2",
                data: data2,
                backgroundColor: "#FF69A520",
                borderColor: "#FF69A525",

                borderWidth: 1,
                hoverBackgroundColor: "#FF69A5",
              },
            ],
          },
          options: {
            scales: {
              yAxes: [
                {
                  ticks: {
                    beginAtZero: true,
                  },
                },
              ],
            },
            plugins: {
              legend: {
                display: false,
              },
            },
          },
        });
      }
    },

    Chart6TExtra() {
      const ctx = this.$refs.myChart6TExtra;
      if (ctx) {
        const data1 = [20, 38, 30, 45, 40, 50, 25, 70, 35, 40, 26, 58];
        const data2 = [38, 55, 42, 36, 60, 65, 50, 30, 25, 40, 45, 25];
        const labels = [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ];

        new Chart(ctx, {
          type: "line",
          data: {
            labels: labels,
            datasets: [
              {
                label: "Combined Dataset",
                data: data1,
                borderColor: "#5f63f2",
                backgroundColor: "rgba(44, 153, 255, 0.1)", // Fade blue background color for data1
                borderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
                cubicInterpolationMode: "monotone", // Smooth curve for data1
                fill: "origin", // Fill the area below data1 with red color
                pointHoverBackgroundColor: "#5f63f2", // Point fill color on hover
              },
              {
                data: data2,
                borderColor: "#A9A9A9",
                backgroundColor: "transparent",
                borderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
                borderDash: [5, 5], // Dashed line for data2
                cubicInterpolationMode: "monotone",
              },
            ],
          },
          options: {
            scales: {
              x: {
                type: "category",
                labels: labels,
              },
              y: {
                beginAtZero: true,
              },
            },
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: false,
              },
              tooltip: {
                mode: "index",
                callbacks: {
                  label: (context) => {
                    const datasetLabel = context.dataset.label || "";
                    return `${datasetLabel}: ${context.parsed.y}`;
                  },
                },
              },
            },
          },
        });
      }
    },
    initializeChartM() {
      const ctx = this.$refs.myChart6MExtra;
      if (ctx) {
        const data1 = [55, 25, 45, 42, 40, 45, 42, 45, 35, 55, 40, 30];
        const data2 = [45, 30, 35, 32, 35, 50, 32, 35, 25, 40, 30, 25];
        const labels = ["1-5", "6-10", "11-15", "16-20", "21-25", "26-30"];

        new Chart(ctx, {
          type: "line",
          data: {
            labels: labels,
            datasets: [
              {
                label: "Combined Dataset",
                data: data1,
                borderColor: "#5f63f2",
                backgroundColor: "rgba(44, 153, 255, 0.1)", // Fade blue background color for data1
                borderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
                cubicInterpolationMode: "monotone", // Smooth curve for data1
                fill: "origin", // Fill the area below data1 with red color
                pointHoverBackgroundColor: "#5f63f2", // Point fill color on hover
              },
              {
                data: data2,
                borderColor: "#A9A9A9",
                backgroundColor: "transparent",
                borderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
                borderDash: [5, 5], // Dashed line for data2
                cubicInterpolationMode: "monotone",
              },
            ],
          },
          options: {
            scales: {
              x: {
                type: "category",
                labels: labels,
              },
              y: {
                beginAtZero: true,
              },
            },
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: false,
              },
              tooltip: {
                mode: "index",
                callbacks: {
                  label: (context) => {
                    const datasetLabel = context.dataset.label || "";
                    return `${datasetLabel}: ${context.parsed.y}`;
                  },
                },
              },
            },
          },
        });
      }
    },
    initializeChartw() {
      const ctx = this.$refs.myChart6WExtra;
      if (ctx) {
        const data1 = [20, 38, 30, 45, 40, 50, 25, 70, 35, 40, 26, 58];
        const data2 = [38, 55, 42, 36, 60, 65, 50, 30, 25, 40, 45, 25];
        const labels = [
          "Sunday",
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
        ];

        new Chart(ctx, {
          type: "line",
          data: {
            labels: labels,
            datasets: [
              {
                label: "Combined Dataset",
                data: data1,
                borderColor: "#5f63f2",
                backgroundColor: "rgba(44, 153, 255, 0.1)", // Fade blue background color for data1
                borderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
                cubicInterpolationMode: "monotone", // Smooth curve for data1
                fill: "origin", // Fill the area below data1 with red color
                pointHoverBackgroundColor: "#5f63f2", // Point fill color on hover
              },
              {
                data: data2,
                borderColor: "#A9A9A9",
                backgroundColor: "transparent",
                borderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
                borderDash: [5, 5], // Dashed line for data2
                cubicInterpolationMode: "monotone",
              },
            ],
          },
          options: {
            scales: {
              x: {
                type: "category",
                labels: labels,
              },
              y: {
                beginAtZero: true,
              },
            },
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: false,
              },
              tooltip: {
                mode: "index",
                callbacks: {
                  label: (context) => {
                    const datasetLabel = context.dataset.label || "";
                    return `${datasetLabel}: ${context.parsed.y}`;
                  },
                },
              },
            },
          },
        });
      }
    },
    initializeChart() {
      const ctx = this.$refs.myChart6Extra;
      if (ctx) {
        const data1 = [65, 35, 45, 42, 65, 60, 42, 45, 35, 55, 40, 65];
        const data2 = [45, 20, 35, 32, 50, 45, 32, 35, 25, 40, 30, 55];
        const labels = [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ];

        new Chart(ctx, {
          type: "line",
          data: {
            labels: labels,
            datasets: [
              {
                label: "Combined Dataset",
                data: data1,
                borderColor: "#5f63f2",
                backgroundColor: "rgba(44, 153, 255, 0.1)",
                borderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
                cubicInterpolationMode: "monotone",
                fill: "origin",
                pointHoverBackgroundColor: "#5f63f2",
              },
              {
                data: data2,
                borderColor: "#A9A9A9",
                backgroundColor: "transparent",
                borderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
                borderDash: [5, 5],
                cubicInterpolationMode: "monotone",
              },
            ],
          },
          options: {
            scales: {
              x: {
                type: "category",
                labels: labels,
              },
              y: {
                beginAtZero: true,
              },
            },
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: false,
              },
              tooltip: {
                mode: "index",
                callbacks: {
                  label: (context) => {
                    const datasetLabel = context.dataset.label || "";
                    return `${datasetLabel}: ${context.parsed.y}`;
                  },
                },
              },
            },
          },
        });
      }
    },
    Chart6TodayExtra() {
      const ctx = this.$refs.myChart6TodayExtra;
      if (ctx) {
        const data1 = [20, 38, 30, 45, 40, 50, 25, 70, 35, 40, 26, 58];
        const data2 = [38, 55, 42, 36, 60, 65, 50, 30, 25, 40, 45, 25];
        const labels = [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ];

        new Chart(ctx, {
          type: "bar", // Set the main chart type to bar
          data: {
            labels: labels,
            datasets: [
              {
                label: "Data1 (Bar)",
                data: data1,
                backgroundColor: "#2C99FF20",
                borderColor: "#2C99FF25",

                hoverBackgroundColor: "rgba(44, 133, 230, 0.8)",
              },
              {
                label: "Data2 (Line)",
                data: data2,
                type: "line", // Set the chart type for this dataset to line
                borderColor: "#A9A9A9",
                borderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
                cubicInterpolationMode: "monotone",
              },
            ],
          },
          options: {
            scales: {
              x: {
                type: "category",
                labels: labels,
              },
              y: {
                beginAtZero: true,
              },
            },
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: false,
              },
              tooltip: {
                mode: "index",
                callbacks: {
                  label: (context) => {
                    const datasetLabel = context.dataset.label || "";
                    return `${datasetLabel}: ${context.parsed.y}`;
                  },
                },
              },
            },
          },
        });
      }
    },
    Chart6WeekExtra() {
      const ctx = this.$refs.myChart6WeekExtra;
      if (ctx) {
        const data1 = [20, 38, 30, 45, 40, 50, 25, 70, 35, 40, 26, 58];
        const data2 = [38, 55, 42, 36, 60, 65, 50, 30, 25, 40, 45, 25];
        const labels = [
          "Sunday",
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
        ];

        new Chart(ctx, {
          type: "bar", // Set the main chart type to bar
          data: {
            labels: labels,
            datasets: [
              {
                label: "Data1 (Bar)",
                data: data1,
                backgroundColor: "#2C99FF20",
                borderColor: "#2C99FF25",

                hoverBackgroundColor: "rgba(44, 133, 230, 0.8)",
              },
              {
                label: "Data2 (Line)",
                data: data2,
                type: "line", // Set the chart type for this dataset to line
                borderColor: "#A9A9A9",
                borderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
                cubicInterpolationMode: "monotone",
              },
            ],
          },
          options: {
            scales: {
              x: {
                type: "category",
                labels: labels,
              },
              y: {
                beginAtZero: true,
              },
            },
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: false,
              },
              tooltip: {
                mode: "index",
                callbacks: {
                  label: (context) => {
                    const datasetLabel = context.dataset.label || "";
                    return `${datasetLabel}: ${context.parsed.y}`;
                  },
                },
              },
            },
          },
        });
      }
    },
    Chart6MonthExtra() {
      const ctx = this.$refs.myChart6MonthExtra;
      if (ctx) {
        const data1 = [55, 25, 45, 42, 40, 45, 42, 45, 35, 55, 40, 30];
        const data2 = [45, 30, 35, 32, 35, 50, 32, 35, 25, 40, 30, 25];
        const labels = ["1-5", "6-10", "11-15", "16-20", "21-25", "26-30"];

        new Chart(ctx, {
          type: "bar", // Set the main chart type to bar
          data: {
            labels: labels,
            datasets: [
              {
                label: "Data1 (Bar)",
                data: data1,
                backgroundColor: "#2C99FF20",
                borderColor: "#2C99FF25",

                hoverBackgroundColor: "rgba(44, 133, 230, 0.8)",
              },
              {
                label: "Data2 (Line)",
                data: data2,
                type: "line", // Set the chart type for this dataset to line
                borderColor: "#A9A9A9",
                borderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
                cubicInterpolationMode: "monotone",
              },
            ],
          },
          options: {
            scales: {
              x: {
                type: "category",
                labels: labels,
              },
              y: {
                beginAtZero: true,
              },
            },
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: false,
              },
              tooltip: {
                mode: "index",
                callbacks: {
                  label: (context) => {
                    const datasetLabel = context.dataset.label || "";
                    return `${datasetLabel}: ${context.parsed.y}`;
                  },
                },
              },
            },
          },
        });
      }
    },

    Chart6yearExtra() {
      const ctx = this.$refs.myChart6yearExtra;
      if (ctx) {
        const data1 = [20, 38, 30, 45, 40, 50, 25, 70, 35, 40, 26, 58];
        const data2 = [38, 55, 42, 36, 60, 65, 50, 30, 25, 40, 45, 25];
        const labels = [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ];

        new Chart(ctx, {
          type: "bar", // Set the main chart type to bar
          data: {
            labels: labels,
            datasets: [
              {
                label: "Data1 (Bar)",
                data: data1,
                backgroundColor: "#2C99FF20",
                borderColor: "#2C99FF25",

                hoverBackgroundColor: "rgba(44, 133, 230, 0.8)",
              },
              {
                label: "Data2 (Line)",
                data: data2,
                type: "line", // Set the chart type for this dataset to line
                borderColor: "#A9A9A9",
                borderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
                cubicInterpolationMode: "monotone",
              },
            ],
          },
          options: {
            scales: {
              x: {
                type: "category",
                labels: labels,
              },
              y: {
                beginAtZero: true,
              },
            },
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: false,
              },
              tooltip: {
                mode: "index",
                callbacks: {
                  label: (context) => {
                    const datasetLabel = context.dataset.label || "";
                    return `${datasetLabel}: ${context.parsed.y}`;
                  },
                },
                backgroundColor: "#000000", // Tooltip body background color
              },
            },
          },
        });
      }
    },

    renderLineChart() {
      const canvas = this.$refs.lineChartCanvas;
      const chartData = {
        labels: [
          "Label 1",
          "Label 2",
          "Label 3",
          "Label 4",
          "Label 5",
          "Label 6",
          "Label 7",
          "Label 8",
          "Label 9",
          "Label 10",
        ],
        datasets: [
          {
            borderColor: "#5F63F2",
            fill: true,
            backgroundColor: "rgba(95, 99, 242, 0.09)",
            data: [30, 10, 20, 25, 20, 30, 15, 25, 15, 10],
            tension: 0.4,
            label: "Line Chart dataset",
          },
        ],
      };

      const chartOptions = {
        scales: {
          x: {
            display: false,
          },
          y: {
            display: false,
            beginAtZero: true,
          },
        },
        plugins: {
          legend: {
            display: false,
          },
          interaction: {
            mode: "index",
          },
        },
      };
      new Chart(canvas, {
        type: "line",
        data: chartData,
        options: chartOptions,
      });
    },
    renderLineChart_tvalue() {
      const canvas = this.$refs.lineChartCanvastvalue;
      const chartData = {
        labels: [
          "Label 1",
          "Label 2",
          "Label 3",
          "Label 4",
          "Label 5",
          "Label 6",
          "Label 7",
          "Label 8",
          "Label 9",
          "Label 10",
        ],
        datasets: [
          {
            borderColor: "#FFA500",
            fill: true,
            backgroundColor: "rgba(255, 165, 0, 0.09)",
            data: [30, 10, 20, 25, 20, 30, 15, 25, 15, 10],
            tension: 0.4,
            label: "Line Chart dataset",
          },
        ],
      };

      const chartOptions = {
        scales: {
          x: {
            display: false,
          },
          y: {
            display: false,
            beginAtZero: true,
          },
        },
        plugins: {
          legend: {
            display: false,
          },
          interaction: {
            mode: "index",
          },
        },
      };
      new Chart(canvas, {
        type: "line",
        data: chartData,
        options: chartOptions,
      });
    },
    renderLineChart_tRevenue() {
      const canvas = this.$refs.lineChartCanvastRevenue;
      const chartData = {
        labels: [
          "Label 1",
          "Label 2",
          "Label 3",
          "Label 4",
          "Label 5",
          "Label 6",
          "Label 7",
          "Label 8",
          "Label 9",
          "Label 10",
        ],
        datasets: [
          {
            borderColor: " #006400",
            fill: true,
            backgroundColor: "rgba(0, 100, 0, 0.09)",
            data: [30, 10, 20, 25, 20, 30, 15, 25, 15, 10],
            tension: 0.4,
            label: "Line Chart dataset",
          },
        ],
      };

      const chartOptions = {
        scales: {
          x: {
            display: false,
          },
          y: {
            display: false,
            beginAtZero: true,
          },
        },
        plugins: {
          legend: {
            display: false,
          },
          interaction: {
            mode: "index",
          },
        },
      };
      new Chart(canvas, {
        type: "line",
        data: chartData,
        options: chartOptions,
      });
    },
    renderLineChart_tInvoices() {
      const canvas = this.$refs.lineChartCanvastInvoices;
      const chartData = {
        labels: [
          "Label 1",
          "Label 2",
          "Label 3",
          "Label 4",
          "Label 5",
          "Label 6",
          "Label 7",
          "Label 8",
          "Label 9",
          "Label 10",
        ],
        datasets: [
          {
            borderColor: " #8B0000",
            fill: true,
            backgroundColor: "rgba(139, 0, 0, 0.09)",
            data: [30, 10, 20, 25, 20, 30, 15, 25, 15, 10],
            tension: 0.4,
            label: "Line Chart dataset",
          },
        ],
      };

      const chartOptions = {
        scales: {
          x: {
            display: false,
          },
          y: {
            display: false,
            beginAtZero: true,
          },
        },
        plugins: {
          legend: {
            display: false,
          },
          interaction: {
            mode: "index",
          },
        },
      };
      new Chart(canvas, {
        type: "line",
        data: chartData,
        options: chartOptions,
      });
    },
  },
};
</script>
