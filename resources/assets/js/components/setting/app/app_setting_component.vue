<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-header d-flex flex-wrap mb-4">
                    <div class="mr-auto">
                        <span class="text-title">{{ $t("App Settings") }}</span>
                    </div>
                    <div class="">
                        <a v-bind:href="'/edit_app_setting'" class="btn btn-primary"> {{ $t("Edit") }}</a>
                    </div>
                </div>

                <div class="form-row mb-2">
                    <div class="form-group col-md-3">
                        <label for="company_name">{{ $t("Company Name") }}</label>
                        <p>{{ company_name }}</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="app_title">{{ $t("App Title") }}</label>
                        <p>{{ app_title }}</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="app_title">{{ $t("App Timezone") }}</label>
                        <p>{{ app_timezone }}</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="app_date_format">{{ $t("App Date Time Format") }}</label>
                        <p>{{ app_date_time_format }}</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="app_date_format">{{ $t("App Date Format") }}</label>
                        <p>{{ app_date_format }}</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="updated_by">{{ $t("Updated By") }}</label>
                        <p>{{ (updated_by == null) ? '-' : updated_by['fullname'] + ' (' + updated_by['user_code'] + ')' }}</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="updated_on">{{ $t("Updated On") }}</label>
                        <p>{{ updated_at_label }}</p>
                    </div>
                </div>
                <hr>
                <div class="form-row mb-2">
                    <div class="form-group col-md-3">
                        <label for="updated_on">{{ $t("Company Logo") }}</label>
                        <p><img :src="company_logo" class="company-logo-image"></p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="updated_on">{{ $t("Invoice Print Logo") }}</label>
                        <p><img :src="invoice_print_logo" class="company-logo-image"></p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="updated_on">{{ $t("Top Navbar Logo") }}</label>
                        <p><img :src="navbar_logo" class="company-logo-image"></p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="updated_on">{{ $t("Favicon") }}</label>
                        <p><img :src="favicon" class="company-logo-image"></p>
                    </div>
                </div>
                <hr>
                <div class="mb-2">
                    <span class="text-subhead">{{ $t("Contact Person Information") }}</span>
                </div>
                <div class="form-row mb-2">
                    <div class="form-group col-md-3">
                        <label for="updated_on">{{ $t("Name") }}</label>
                        <p>{{ contact_person[0].fullname }}</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="updated_on">{{ $t("Email") }}</label>
                        <p>{{ contact_person[0].email }}</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="updated_on">{{ $t("Phone") }}</label>
                        <p>{{ contact_person[0].phone }}</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="updated_on">{{ $t("Job Post") }}</label>
                        <p>{{ contact_person[0].role.label }}</p>
                    </div>
                </div>
                <!-- <div class="mb-2">
                    <span class="text-subhead">{{ $t("Default Customer Details") }}</span>
                </div>
                <div class="form-row mb-2">
                    <div class="form-group col-md-3">
                        <label for="updated_on">{{ $t("Name") }}</label>
                        <p>{{ name }}</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="updated_on">{{ $t("Email") }}</label>
                        <p>{{ email }}</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="updated_on">{{ $t("Phone") }}</label>
                        <p>{{ phone }}</p>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</template>  

<script>
'use strict';

export default {
    data() {
        return {
            edit_link: '/edit_app_setting',
            server_errors: '',
            error_class: '',
            processing: false,

            company_name: (this.app_setting.length == 0) ? '-' : this.app_setting.company_name,
            app_title: (this.app_setting.length == 0) ? '-' : this.app_setting.app_title,
            app_timezone: (this.app_setting.length == 0) ? '-' : this.app_setting.timezone,
            app_date_time_format: (this.app_setting.length == 0) ? '-' : this.app_setting.app_date_time_format,
            app_date_format: (this.app_setting.length == 0) ? '-' : this.app_setting.app_date_format,
            updated_by: (this.app_setting.length == 0) ? null : this.app_setting.updated_by,
            updated_at_label: (this.app_setting.length == 0) ? '-' : this.app_setting.updated_at_label,
            company_logo: (this.app_setting.length == 0) ? '-' : this.app_setting.company_logo_path,
            invoice_print_logo: (this.app_setting.length == 0) ? '-' : this.app_setting.invoice_print_logo_path,
            navbar_logo: (this.app_setting.length == 0) ? '-' : this.app_setting.navbar_logo_path,
            favicon: (this.app_setting.length == 0) ? '-' : this.app_setting.favicon_path,
            // name: (this.customer.length == 0) ? '-' : this.customer.name,
            // email: (this.customer.length == 0) ? '-' : this.customer.email,
            // phone: (this.customer.length == 0) ? '-' : this.customer.phone,
        }
    },
    props: {
        app_setting: Array,
        contact_person: [Array, Object],
        // customer: [Array, Object],
    },
    mounted() {
        console.log('App setting page loaded');
    },
    methods: {

    }
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

.page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
    margin-left: 18px;
}

.form-row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -5px;
    margin-left: 10px;
}
.mb-2, .my-2 {
    margin-bottom: 0.5rem!important;
    margin-left: 10px;
}
</style>