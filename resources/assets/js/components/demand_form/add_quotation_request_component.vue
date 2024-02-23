<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form @submit.prevent="submit_form" class="mb-3">

                    <div class="card-header d-flex flex-wrap mb-4">
                        
                        <div class="w-100 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" > <i
                                    class='fa fa-circle-notch fa-spin' v-if="processing == true"></i> {{ $t("Save")
                                    }}</button>
                        </div>
                    </div>

                    <p v-html="server_errors" v-bind:class="[error_class]"></p>

                    <div class="form-row mb-2">
                        
                      
                    </div>

                    <div>
                        <div class="form-row" v-for="(item, index) in items" :key="index">    
                                    
                            <div class="form-group col-sm-12 col-md-3">
                                <label for="Item Details">{{ $t("Item Details") }}</label>
                                <textarea name="item_details" v-model="item.item_details"
                                    class="form-control form-control-custom" rows="1" columns="5"
                                    :placeholder="$t('Enter Item Details')"></textarea>
                            </div>
                            <div class="form-group col-sm-12 col-md-3">
                                <label for="quantity">{{ $t("Quantity") }}</label>
                                <input type="number" min="1" name="quantity" v-model="item.quantity"
                                    class="form-control form-control-custom"
                                    :placeholder="$t('Enter Quantity')" />
                            </div>
                            <div class="form-group col-sm-12 col-md-3">
                                <label for="payment_terms">{{ $t("Payment Terms") }}</label>
                                <textarea name="payment_terms" v-model="item.payment_terms"
                                    class="form-control form-control-custom" rows="1" columns="5"
                                    :placeholder="$t('Enter Payment Terms')"></textarea>
                            </div>
                            <div class="form-group col-sm-12 col-md-3">
                                <label for="delivery_terms">{{ $t("Delivery Terms") }}</label>
                                <textarea name="delivery_terms" v-model="item.delivery_terms"
                                    class="form-control form-control-custom" rows="1" columns="5"
                                    :placeholder="$t('Enter Delivery Terms')"></textarea>
                            </div>
                        </div>
                        <div class="w-100 d-flex justify-content-end">
                            <button class="btn btn-primary" @click="addItem">+</button>
                        </div>
                        
                    </div>                   
                </form>

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
                    <button type="button" class="btn btn-primary" @click="$emit('submit')"
                        v-bind:disabled="processing == true"> <i class='fa fa-circle-notch fa-spin'
                            v-if="processing == true"></i> Continue</button>
                </template>
            </modalcomponent>
        </div>
    </div>
</template>

<script>
'use strict';

import 'choices.js/public/assets/styles/choices.min.css';
import Choices from 'choices.js';

export default {
    
    data() {
        return {
            items: [
        { item_details: "", quantity: 0, payment_terms: "", delivery_terms: "" }
      ],
      
      server_errors: "",
      error_class: "",
      processing: false,
      modal: false,
      show_modal: false,
        }
    },

    props: {
      
    },

    watch: {
       
    },

    mounted() {
       
      
      
    },

    created() {},

    methods: {
        addItem() {
      this.items.push({
        item_details: "",
        quantity: 0,
        payment_terms: "",
        delivery_terms: ""
      });
    },




    submit_form() {
            this.$validator.validateAll().then((result) => {
                if (result) {
                    this.show_modal = true;
                    this.$on("submit", function () {


                        this.processing = true;

                        const items = JSON.stringify(this.items);
                        const suppliers = JSON.stringify(this.suppliers);

                        var formData = new FormData();

                        formData.append("access_token", window.settings.access_token);
                       
                        formData.append("items", items);

                        axios.post('/api/add_quotation_request', formData).then((response) => {

                            if (response.data.status_code == 200) {
                                this.show_response_message(response.data.msg, 'Success');

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
                                this.error_class = 'error';
                            }
                        })
                            .catch((error) => {
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
        }
        
        
    }
}
</script>

<style scoped>.card-header {
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


.mb-2,
.my-2 {
    margin-left: 10px;
    margin-bottom: 0.5rem !important;
}

.mb-1,
.my-1 {
    margin-bottom: 0.25rem !important;
    margin-left: 10px;
}

.form-row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: 10px;
    margin-left: 10px;
}

.col-md-6 {
  
    max-width: 30%;
}



.mb-1, .my-1 {
    margin-bottom: 0.25rem !important;
     margin-left: 0px; 
}
</style>
