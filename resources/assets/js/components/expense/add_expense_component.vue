<template>
    <div>
        <form @submit.prevent="submit_form">
            <div class="d-flex flex-wrap mb-4">
                <div class="mr-auto">
                    <span class="text-title" v-if="expense_slack == null">{{
                        $t("Add Expense")
                    }}</span>
                    <span class="text-title" v-else>{{ $t("Edit Expense") }}
                    </span>
                </div>
                <div class="">
                    <button v-if="expense_slack == null" type="submit" class="btn btn-primary"
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
                    <label for="name">{{ $t("Expense Name") }}</label>
                    <input type="text" name="expense_name" v-model="expense_name" v-validate="'max:65535'"
                        class="form-control form-control-custom" rows="5" :placeholder="$t('Enter Expense Name')" />
                    <span v-bind:class="{ error: errors.has('expense_name') }">{{
                        errors.first("expense_name")
                    }}</span>
                </div>
                <div class="form-group col-sm-12 col-md-4">
                    <label for="name">{{ $t("Expense Amount") }}</label>
                    <input type="text" name="amount" v-model="expense_amount" v-validate="'max:65535'"
                        class="form-control form-control-custom" rows="5" :placeholder="$t('Enter Expense Amount')" />
                    <span v-bind:class="{ error: errors.has('amount') }">{{
                        errors.first("amount")
                    }}</span>
                </div>
                <div class="form-group col-sm-12 col-md-4">
                    <label for="expense_category">{{ $t("Choose Expense Category") }}</label>
                    <select v-model="expense_category" v-validate="'required'" class="form-control form-control-custom"
                        placeholder="Choose Expense Category..">
                        <option value="" selected disabled>Choose Expense Categories..</option>
                        <option v-for="(expense_item, index) in expense_categories" v-bind:value="expense_item.id"
                            placeholder="Choose Expense Category.." v-bind:key="expense_item.slack">
                            placeholder="Choose Expense Category.." v-bind:key="expense_item.slack">
                            {{ expense_item.id }} - {{ expense_item.name }}
                        </option>
                    </select>
                    <span v-bind:class="{ 'error': errors.has('expense_category') }">{{ errors.first('expense_category')
                    }}</span>
                </div>
            </div>
            <div class="form-row mb-2">
                <div class="form-group col-md-3">
                    <label for="name">{{ $t("Notes") }}</label>
                    <textarea name="notes" v-model="notes" v-validate="'required|max:65535'"
                        class="form-control form-control-custom" rows="5"
                        :placeholder="$t('Notes on this Current Expense')"></textarea>

                    <span v-bind:class="{ error: errors.has('notes') }">{{
                        errors.first("notes")
                    }}</span>

                </div>


            </div>
            <div class="form-row mb-2">
                <div class="form-group col-md-4">
                <div class="form-group col-md-4">
                    <label for="expense_date">{{ $t("Expense Date") }}</label>
                    <input type="date"  v-model="expense_date" name="expense_date" 
                        v-validate="'required|date_format:yyyy-MM-dd'"
                        input-class="form-control form-control-custom bg-white"
                        :placeholder="$t('Please enter Expense Date')" autocomplete="off"/>
                        :placeholder="$t('Please enter Expense Date')" autocomplete="off"/>
                    <span v-bind:class="{ 'error': errors.has('Expense Date') }">{{ errors.first('Expense Date')
                    }}</span>
                </div>
                <div class="form-group col-md-4">
                <div class="form-group col-md-4">
                    <label for="receipt_upload">{{
                        $t("Expense Receipt Upload") + "(pdf, msword, vnd)"
                        $t("Expense Receipt Upload") + "(pdf, msword, vnd)"
                    }}</label>
                    <input type="file" class="form-control-file form-control form-control-custom file-input"
                        name="receipt_upload" ref="receipt_upload"
                        accept="application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                        v-validate="'ext:pdf,msword,vnd|size:1500'" />
                        name="receipt_upload" ref="receipt_upload"
                        accept="application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                        v-validate="'ext:pdf,msword,vnd|size:1500'" />
                    <small class="form-text text-muted mb-1">Allowed file size per file is 1.5 MB</small>
                    <small class="form-text text-muted">Hold down CTRL or Command for choosing multiple files</small>
                    <span v-bind:class="{ error: errors.has('receipt_upload') }">{{
                        errors.first("receipt_upload")
                    }}</span>
                </div>
                
                    <div class="form-group col-sm-12 col-md-10 col-lg-4 mx-auto" v-if="expense_transaction == null">
                        <label for="status">{{ $t("Status") }}</label>
                        <select name="status" v-model="status" v-validate="'required|numeric'"
                            class="form-control form-control-custom custom-select">
                            <option value="">Choose Status..</option>
                            <option v-for="(status, index) in statuses" v-bind:value="status.value" v-bind:key="index">
                                {{ status.label }}
                            </option>
                        </select>
                        <span v-bind:class="{ 'error': errors.has('status') }">{{ errors.first('status') }}</span>
                    </div>
                


                
                    <div class="form-group col-sm-12 col-md-10 col-lg-4 mx-auto" v-if="expense_transaction == null">
                        <label for="status">{{ $t("Status") }}</label>
                        <select name="status" v-model="status" v-validate="'required|numeric'"
                            class="form-control form-control-custom custom-select">
                            <option value="">Choose Status..</option>
                            <option v-for="(status, index) in statuses" v-bind:value="status.value" v-bind:key="index">
                                {{ status.label }}
                            </option>
                        </select>
                        <span v-bind:class="{ 'error': errors.has('status') }">{{ errors.first('status') }}</span>
                    </div>
                


            </div>





        </form>
        <modalcomponent v-if="show_modal" v-on:close="show_modal = false">
            <template v-slot:modal-header>
                {{ $t("Confirm") }}
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
</template>
<script>

import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import moment from "moment";
export default {
    data() {
        return {
            date: {
                lang: 'en',
                format:'YYYY-MM-DD',
            },
            time: {
                lang: 'en',
                format: 'hh:mm A'
            },
            max: 5,
            server_errors: '',
            processing: false,
            modal: false,
            show_modal: false,

            error_class: '',

            
            api_link: (this.expense_data == null)
                ? "/api/add_expense"
                : "/api/update_expense/" + this.expense_data.slack,
            expense_slack: this.expense_data && this.expense_data.slack !== null ? this.expense_data.slack : null,
            expense_name: this.expense_data && this.expense_data.expense_name !== null ? this.expense_data.expense_name : null,
            status: (this.expense_data && this.expense_data.status !== null) ? this.expense_data.status : 0,
            expense_category: typeof this.selected_expense_cat_id !== "undefined" && this.selected_expense_cat_id !== null ? this.selected_expense_cat_id.toString() : null,
            expense_amount: this.expense_data && this.expense_data.amount !== null ? this.expense_data.amount : null,
            expense_date: (this.expense_data && this.expense_data.expense_name !== null) ? new Date(this.expense_data.expense_date) :  new Date(),
            notes: this.expense_data && this.expense_data.notes !== null ? this.expense_data.notes : null,
            expense_transaction : (this.expense_data && this.expense_data.transaction_id !== null) ? this.expense_data.transaction_id :  null,
        }
    },
    mounted() {
        // Set the initial selected value from props
        console.log("Expense Component Loaded");
    },
    mounted() {
        // Set the initial selected value from props
        console.log("Expense Component Loaded");
    },
    props: {
        expense_categories: Array,
        expense_data: [Array, Object],
        selected_expense_cat_id: Number,
        statuses: Array
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
                        formData.append("expense_name", this.expense_name);
                        formData.append("expense_category", this.expense_category);
                        formData.append("amount", this.expense_amount);
                        formData.append("expense_date", this.convert_date_format(this.expense_date));
                        formData.append("status", this.status);
                        formData.append("notes", this.notes);
                        for (var i = 0; i < this.$refs.receipt_upload.files.length; i++) {
                            let file = this.$refs.receipt_upload.files[i];
                            formData.append("receipt_upload[" + i + "]", file);
                        }


                        axios
                            .post(this.api_link, formData)
                            .then((response) => {
                                if (response.data.status_code == 200) {
                                    this.show_response_message(response.data.msg, "Success");

                                    setTimeout(function () {
                                        location.reload();
                                    }, 1000);
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
        convert_date_format(date) {

            return (date != '') ? moment(date).format("YYYY-MM-DD") : '';
        },


    },
}
</script>