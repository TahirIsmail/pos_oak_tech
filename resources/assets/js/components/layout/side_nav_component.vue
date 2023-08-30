<template>
  <div class="side-nav pl-sm-0 pl-lg-4 pl-xl-4">
    <ul class="list-unstyled modules">
      <li class="module">
        <a
          href="#menu0"
          data-toggle="collapse"
          aria-expanded="false"
          class="module-parent dropdown-toggle selected-parent-menu"
          ><span class="module-parent-text text-truncate"
            ><i class="main-menu-icon fas fa-chart-line"></i> Dashboard</span
          ></a
        >
        <ul
          id="menu0"
          aria-expanded="false"
          class="collapse list-unstyled show in"
        >
          <li class="module-child selected-menu">
            <a
              href="/dashboard"
              class="module-child-text text-truncate"
              >--> Dashboard</a
            >
          </li>
        </ul>
      </li>
      
      <li class="module">
        <a
          href="#menu2"
          data-toggle="collapse"
          aria-expanded="false"
          class="module-parent dropdown-toggle"
          ><span class="module-parent-text text-truncate"
            ><i class="main-menu-icon fas fa-user-astronaut"></i> User
            Management
          </span></a
        >
        <ul id="menu2" aria-expanded="false" class="collapse list-unstyled">
          <li class="module-child">
            <a
              href="/users"
              class="module-child-text text-truncate"
              >--> Users</a
            >
          </li>
          
          <li class="module-child">
            <a
              href="/roles"
              class="module-child-text text-truncate"
              >--> Roles</a
            >
          </li>
        </ul>
      </li>
      <li class="module">
        <a
          href="#menu101"
          data-toggle="collapse"
          aria-expanded="false"
          class="module-parent dropdown-toggle"
          ><span class="module-parent-text text-truncate"
            ><i class="main-menu-icon fas fa-user-astronaut"></i> Customer
            Management
          </span></a
        >
        <ul id="menu101" aria-expanded="false" class="collapse list-unstyled">
         
          <li class="module-child">
            <a
              href="/customers"
              class="module-child-text text-truncate"
              >--> Customers</a
            >
          </li>
          
        </ul>
      </li>
      <li class="module">
        <a
          href="#menu3"
          data-toggle="collapse"
          aria-expanded="false"
          class="module-parent dropdown-toggle"
          ><span class="module-parent-text text-truncate"
            ><i class="main-menu-icon fas fa-truck"></i> Supplier
            Management</span
          ></a
        >
        <ul id="menu3" aria-expanded="false" class="collapse list-unstyled">
          <li class="module-child">
            <a
              href="/suppliers"
              class="module-child-text text-truncate"
              > --> Suppliers</a
            >
          </li>
          <li class="module-child">
            <a
              href="/suppliers_performance"
              class="module-child-text text-truncate"
              > --> Suppliers Performance</a
            >
          </li>
        </ul>
      </li>
      <li class="module">
        <a href="#" data-toggle="" aria-expanded="false" class="module-parent"
          ><span class="module-parent-text text-truncate"
            ><i class="main-menu-icon fas fa-cubes"></i> HR Management</span
          ></a
        >
        <!---->
      </li>
      <li class="module">
        <a
          href="#menu4"
          data-toggle="collapse"
          aria-expanded="false"
          class="module-parent dropdown-toggle"
          ><span class="module-parent-text text-truncate"
            ><i class="main-menu-icon fas fa-cubes"></i> Stock Management</span
          ></a
        >
        <!-- <ul id="menu4" aria-expanded="false" class="collapse list-unstyled">
          <li class="module-child">
            <a
              href="/products"
              class="module-child-text text-truncate"
              >Products</a
            >
          </li>
          <li class="module-child">
            <a
              href="/categories"
              class="module-child-text text-truncate"
              >Categories</a
            >
          </li>
          <li class="module-child">
            <a
              href="/stock_transfers"
              class="module-child-text text-truncate"
              >Stock Transfer</a
            >
          </li>
          <li class="module-child">
            <a
              href="/stock_returns"
              class="module-child-text text-truncate"
              >Stock Return</a
            >
          </li>
          <li class="module-child">
            <a
              href="/generate_barcode"
              class="module-child-text text-truncate"
              >Product Label</a
            >
          </li>
          <li class="module-child">
            <a
              href="/addon_groups"
              class="module-child-text text-truncate"
              >Add-on Groups</a
            >
          </li>
        </ul> -->
      </li>
      <li class="module">
        <a
          href="#menu1"
          data-toggle="collapse"
          aria-expanded="false"
          class="module-parent dropdown-toggle"
          ><span class="module-parent-text text-truncate"
            ><i class="main-menu-icon fas fa-shopping-cart"></i> Sales &amp;
            Orders</span
          ></a
        >
        <!-- <ul id="menu1" aria-expanded="false" class="collapse list-unstyled">
          <li class="module-child">
            <a
              href="/purchase_orders"  
              class="module-child-text text-truncate"
              >Purchase Orders</a
            >  
          </li>
          <li class="module-child">
            <a
              href="/invoices"
              class="module-child-text text-truncate"
              >Invoices</a
            >
          </li>
          <li class="module-child">
            <a
              href="/orders"
              class="module-child-text text-truncate"
              >Orders</a
            >
          </li>
          <li class="module-child">
            <a
              href="/quotations"
              class="module-child-text text-truncate"
              >Quotations</a
            >
          </li>
          <li class="module-child">
            <a
              href="/transactions"
              class="module-child-text text-truncate"
              >Transactions</a
            >
          </li>
        </ul> -->
      </li>
      
      <li class="module">
        <a href="#" data-toggle="" aria-expanded="false" class="module-parent"
          ><span class="module-parent-text text-truncate"
            ><i class="main-menu-icon fas fa-cubes"></i> Complaint System</span
          ></a
        >
        <!---->
      </li>
      <li class="module">
        <a href="#" data-toggle="" aria-expanded="false" class="module-parent"
          ><span class="module-parent-text text-truncate"
            ><i class="main-menu-icon fas fa-cubes"></i>
            Workshop/Repairing</span
          ></a
        >
        <!---->
      </li>
      <li class="module">
        <a
          href="#menu8"
          data-toggle="collapse"
          aria-expanded="false"
          class="module-parent dropdown-toggle"
          ><span class="module-parent-text text-truncate"
            ><i class="main-menu-icon fas fa-calendar-alt"></i> Calendar</span
          ></a
        >
        <!-- <ul id="menu8" aria-expanded="false" class="collapse list-unstyled">
          <li class="module-child">
            <a
              href="/calendar"
              class="module-child-text text-truncate"
              >Calendar</a
            >
          </li>
        </ul> -->
      </li>
      <li class="module">
        <a
          href="#menu9"
          data-toggle="collapse"
          aria-expanded="false"
          class="module-parent dropdown-toggle"
          ><span class="module-parent-text text-truncate"
            ><i class="main-menu-icon fas fa-chart-pie"></i> Reports
            Management</span
          ></a
        >
        <!-- <ul id="menu9" aria-expanded="false" class="collapse list-unstyled">
          <li class="module-child">
            <a
              href="/download_reports"
              class="module-child-text text-truncate"
              >Download Reports</a
            >
          </li>
          <li class="module-child">
            <a
              href="/best_seller_report"
              class="module-child-text text-truncate"
              >Best Seller Report</a
            >
          </li>
          <li class="module-child">
            <a
              href="/day_wise_sale_report"
              class="module-child-text text-truncate"
              >Day Wise Sale Report</a
            >
          </li>
          <li class="module-child">
            <a
              href="/catgeory_report"
              class="module-child-text text-truncate"
              >Category Report</a
            >
          </li>
          <li class="module-child">
            <a
              href="/product_quantity_alert"
              class="module-child-text text-truncate"
              >Stock Quantity Alert</a
            >
          </li>
          <li class="module-child">
            <a
              href="/store_stock_chart"
              class="module-child-text text-truncate"
              >Store Stock Chart</a
            >
          </li>
        </ul> -->
      </li>
      <li class="module">
        <a
          href="#menu10"
          data-toggle="collapse"
          aria-expanded="false"
          class="module-parent dropdown-toggle"
          ><span class="module-parent-text text-truncate"
            ><i class="main-menu-icon fas fa-bell"></i> Notification</span
          ></a
        >
        <!-- <ul id="menu10" aria-expanded="false" class="collapse list-unstyled">
          <li class="module-child">
            <a
              href="/notifications"
              class="module-child-text text-truncate"
              >Notifications</a
            >
          </li>
        </ul> -->
      </li>
      <li class="module">
        <a
          href="#menu11"
          data-toggle="collapse"
          aria-expanded="false"
          class="module-parent dropdown-toggle"
          ><span class="module-parent-text text-truncate"
            ><i class="main-menu-icon fas fa-cloud-download-alt"></i> Import
            Data</span
          ></a
        >
        <!-- <ul id="menu11" aria-expanded="false" class="collapse list-unstyled">
          <li class="module-child">
            <a
              href="/import_data"
              class="module-child-text text-truncate"
              >Import Data</a
            >
          </li>
          <li class="module-child">
            <a
              href="/update_data"
              class="module-child-text text-truncate"
              >Upload &amp; Update Data</a
            >
          </li>
        </ul> -->
      </li>
      <li class="module">
        <a
          href="#menu12"
          data-toggle="collapse"
          aria-expanded="false"
          class="module-parent dropdown-toggle"
          ><span class="module-parent-text text-truncate"
            ><i class="main-menu-icon fas fa-cog"></i> Settings</span
          ></a
        >
        <!-- <ul id="menu12" aria-expanded="false" class="collapse list-unstyled">
          <li class="module-child">
            <a
              href="/stores"
              class="module-child-text text-truncate"
              >Stores</a
            >
          </li>
          <li class="module-child">
            <a
              href="/payment_methods"
              class="module-child-text text-truncate"
              >Payment Methods</a
            >
          </li>
          <li class="module-child">
            <a
              href="/billing_counters"
              class="module-child-text text-truncate"
              >Billing Counters</a
            >
          </li>
          <li class="module-child">
            <a
              href="/email_setting"
              class="module-child-text text-truncate"
              >Email Settings</a
            >
          </li>
          <li class="module-child">
            <a
              href="/sms_settings"
              class="module-child-text text-truncate"
              >SMS Settings</a
            >
          </li>
          <li class="module-child">
            <a
              href="/sms_templates"
              class="module-child-text text-truncate"
              >SMS Templates</a
            >
          </li>
          <li class="module-child">
            <a
              href="/variant_options"
              class="module-child-text text-truncate"
              >Variant Options</a
            >
          </li>
          <li class="module-child">
            <a
              href="/printers"
              class="module-child-text text-truncate"
              >Printers</a
            >
          </li>
          <li class="module-child">
            <a
              href="/app_setting"
              class="module-child-text text-truncate"
              >App Settings</a
            >
          </li>
        </ul> -->
      </li>
    </ul>
  </div>
</template>

<script>
  'use strict';
  
  export default {
      data(){
          return{

          }
      },
      props: {
          menus: [Array, Object],
          menu_key: String,
          sub_menu_key: String,
      },
      computed: {
          menu_sorted() {
              return _.orderBy(this.menus, o => +o.sort_order, ['asc']);
          },
      },
      methods: {
         
      }
  }
</script>