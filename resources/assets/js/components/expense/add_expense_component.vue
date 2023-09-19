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
                        <option value="" disabled>Choose Expense Category..</option>
                        <option v-for="(expense_item, index) in expense_categories" v-bind:value="expense_item.id"
                            placeholder="Choose Expense Category.." v-bind:key="index">
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
                <div class="form-group col-md-3">
                    <label for="expense_date">{{ $t("Expense Date") }}</label>
                    <date-picker v-model="expense_date" name="expense_date" v-validate="'required|date_format:yyyy-MM-dd'"
                        input-class="form-control form-control-custom bg-white"
                        :placeholder="$t('Please enter Expense Date')" autocomplete="off"></date-picker>
                    <span v-bind:class="{ 'error': errors.has('Expense Date') }">{{ errors.first('Expense Date')
                    }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label for="receipt_upload">{{
                        $t("Expense Receipt Upload") + " (pdf, msword, vnd)"
                    }}</label>
                    <input type="file" class="form-control-file form-control form-control-custom file-input"
                        name="receipt_upload" ref="receipt_upload" accept="application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                        v-validate="'ext:jpg,jpeg,png,webp|size:1500'" multiple="multiple" />
                    <small class="form-text text-muted mb-1">Allowed file size per file is 1.5 MB</small>
                    <small class="form-text text-muted">Hold down CTRL or Command for choosing multiple files</small>
                    <span v-bind:class="{ error: errors.has('receipt_upload') }">{{
                        errors.first("receipt_upload")
                    }}</span>
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
"use strict";
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import moment from "moment";
export default {
    data() {
        return {
            max: 5,
            server_errors: "",
            processing: false,
            modal: false,
            show_modal: false,
            error_class: "",


            api_link: "",
            expense_slack: null,
            expense_name: "",
            expense_category: "",
            expense_amount: "",
            expense_date: "",
            notes: "",
        }
    },
    props: {
        expense_categories: Array,
        expense_data: Array,
        selected_expense_id: Array,
    }
}
</script>