<template>
    <div class="row">
        <div class="col-md-12">
            
            <div class="d-flex flex-wrap mb-4">
                <div class="mr-auto">
                    <div class="d-flex">
                        <div>
                            <span class="text-title"> <span class='text-muted'>{{ $t("Expense") }}</span> {{
                                expense_detail.expense_name }} ({{ expense_detail.expense_category.label }}) </span>
                        </div>
                    </div>
                </div>
                <div class="">
                    <span v-bind:class="expense_detail.status.color">{{ expense_detail.status.label }}</span>
                </div>
            </div>

            <div class="d-flex flex-wrap mb-4">

                <p v-html="server_errors" v-bind:class="[error_class]"></p>

                <div class="ml-auto">
                    <button type="submit" class="btn btn-danger mr-1" v-if="delete_access == true"
                        v-on:click="delete_expense()" v-bind:disabled="delete_processing == true"> <i
                            class='fa fa-circle-notch fa-spin' v-if="delete_processing == true">
                        </i> {{ $t("Delete Expense") }}</button>
                </div>
                <div v-if="expense_detail.transaction_id == null">
                    <div>
                        <button type="submit" class="btn btn-primary mr-1" v-if="expense_detail.value == 1"
                            v-on:click="add_transaction()" v-bind:disabled="transaction_processing == true"> <i
                                class='fa fa-circle-notch fa-spin' v-if="transaction_processing == true">
                            </i> {{ $t("Add Transaction") }}</button>
                    </div>
                </div>


            </div>
            <hr>

            <div class="mb-2">
                <span class="text-subhead">{{ $t("Basic Information") }}</span>
            </div>
            <div class="form-row mb-2">

                <div class="form-group col-md-3">
                    <label for="name">{{ $t("Expense Name") }}</label>
                    <p>{{ expense_detail.expense_name }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="category">{{ $t("Expense Category") }}</label>
                    <p>{{ expense_detail.expense_category.name }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="phone">{{ $t("Amount") }}</label>
                    <p>{{ expense_detail.amount }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="created_by">{{ $t("Created By") }}</label>

                    <p>{{ (expense_detail.created_by == null) ? '-' : expense_detail.created_user.fullname +
                        '(' + expense_detail.created_user.user_code + ')' }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="updated_by">{{ $t("Updated By") }}</label>
                    <p>{{ (expense_detail.updated_by == null) ? '-' : expense_detail.updated_user.fullname +
                        '(' + expense_detail.created_user.user_code + ')' }}</p>
                </div>

            </div>
            <hr>

            <div class="form-row mb-2">
                <div class="form-group col-md-3">
                    <label for="pincode">{{ $t("Expense Date") }}</label>
                    <p>{{ expense_detail.expense_date }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="pincode">{{ $t("Status") }}</label>
                    <p>{{ expense_detail.label }}</p>
                </div>
            </div>


        </div>

        <modalcomponent v-if="show_modal" v-on:close="show_modal = false">
            <template v-slot:modal-header>
                {{ $t("Confirm") }}
            </template>
            <template v-slot:modal-body>
                {{ $t("Are you sure you want to proceed?") }}
            </template>
            <template v-slot:modal-footer>
                <button type="button" class="btn btn-light" @click="$emit('close')">Cancel</button>
                <button type="button" class="btn btn-primary" @click="$emit('submit')" v-bind:disabled="processing == true">
                    <i class='fa fa-circle-notch fa-spin' v-if="processing == true"></i> Continue</button>
            </template>
        </modalcomponent>
        <modalcomponent v-if="show_transaction_modal" v-on:close="show_transaction_modal = false">
            <template v-slot:modal-header>
                {{ $t("Confirm") }}
            </template>
            <template v-slot:modal-body>
                {{ $t("Are you sure you want to proceed?") }}
            </template>
            <template v-slot:modal-footer>
                <button type="button" class="btn btn-light" @click="$emit('close')">Cancel</button>
                <button type="button" class="btn btn-primary" @click="$emit('transaction_submit')"
                    v-bind:disabled="transaction_processing == true"> <i class='fa fa-circle-notch fa-spin'
                        v-if="transaction_processing == true"></i> Continue</button>
            </template>
        </modalcomponent>

    </div>
</template>
<script>
'use strict';
import moment from "moment";
export default {
    data() {
        return {
            expense_detail: this.expense[0],

            processing: false,
            delete_processing: false,
            show_modal: false,
            server_errors: '',
            error_class: '',
            show_transaction_modal: false,
            transaction_processing: false,
            delete_expense_api_link: '/api/delete_expense/' + this.expense.slack,
            add_transaction_expense_api_link:'/api/add_expense_transaction',
        }
    },
    props: {
        expense: [Array, Object],
        delete_access: Boolean,
    },
    mounted() {
        console.log('Expense detail page loaded');
    },
    methods: {
        delete_expense() {
            this.$off("submit");
            this.$off("close");
            this.show_modal = true;

            this.$on("submit", function () {
                this.processing = true;
                this.delete_processing = true;

                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);

                axios.post(this.delete_expense_api_link, formData).then((response) => {

                    if (response.data.status_code == 200) {
                        this.show_response_message(response.data.msg, 'Success');
                        if (response.data.link != "") {
                            window.location.href = response.data.link;
                        } else {
                            location.reload();
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
                        this.error_class = 'error';
                    }
                    this.delete_processing = false;
                })
                    .catch((error) => {
                        console.log(error);
                    });
            });

            this.$on("close", function () {
                this.show_modal = false;
            });
        },
        add_transaction() {
            this.$off("transaction_submit");
            this.$off("close");
            this.show_transaction_modal = true;

            this.$on("transaction_submit", function () {
                this.processing = true;
                this.transaction_processing = true;

                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);
                formData.append("bill_to", this.expense_detail.expense_category.label);

                formData.append("transaction_date", this.get_current_date());
                formData.append("account", 1);
                formData.append("transaction_type", 2);
                formData.append("amount", (this.expense_detail.amount == null) ? '' : this.expense_detail.amount);
                formData.append("payment_method", 'CASH');
                formData.append("notes", (this.expense_detail.notes == null) ? '' : this.expense_detail.notes);
                formData.append("expense_slack",this.expense_detail.slack);
                
                axios.post(this.add_transaction_expense_api_link, formData).then((response) => {

                    if (response.data.status_code == 200) {
                        this.show_response_message(response.data.msg, 'Success');
                        setTimeout(function () {
                                        location.reload();
                                    }, 1000);
                    } else {
                        this.show_transaction_modal = false;
                        this.processing = false;
                        try {
                            var error_json = JSON.parse(response.data.msg);
                            this.loop_api_errors(error_json);
                        } catch (err) {
                            this.server_errors = response.data.msg;
                        }
                        this.error_class = 'error';
                    }
                    this.transaction_processing = false;
                })
                    .catch((error) => {
                        console.log(error);
                    });
            });

            this.$on("close", function () {
                this.show_transaction_modal = false;
            });

        },
        get_current_date() {
            const currentDate = moment();

            return currentDate.format('YYYY-MM-DD');
        }
    }
}
</script>