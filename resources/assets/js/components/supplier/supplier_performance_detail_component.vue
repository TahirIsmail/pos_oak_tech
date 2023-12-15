<template>
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex flex-wrap mb-4">
                <div class="mr-auto">
                    <div class="d-flex">
                        <div>
                            <span class="text-title">
                                <span class="text-muted">{{ $t("Supplier") }}</span>
                                {{ supplier.supplier.name }} ({{
                                    supplier.supplier.supplier_code
                                }})
                            </span>
                        </div>
                    </div>
                </div>
                <div class="">
                    <span class="label green-label">{{
                        supplier.status
                    }}</span>
                </div>
            </div>

            <div class="d-flex flex-wrap mb-4">
                <p v-html="server_errors" v-bind:class="[error_class]"></p>

                <div class="ml-auto">
                    <button type="submit" class="btn btn-danger mr-1" v-if="delete_access == true"
                        v-on:click="delete_supplier()" v-bind:disabled="delete_processing == true">
                        <i class="fa fa-circle-notch fa-spin" v-if="delete_processing == true"></i>
                        {{ $t("Delete Supplier") }}
                    </button>
                </div>
            </div>
            <hr />

            <div class="mb-2">
                <span class="text-subhead">{{ $t("Basic Information") }}</span>
            </div>
            <div class="form-row mb-2">
                <div class="form-group col-md-3">
                    <label for="supplier_code">{{ $t("supplier Code") }}</label>
                    <p>{{ supplier.supplier.supplier_code }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="name">{{ $t("Name") }}</label>
                    <p>{{ supplier.supplier.name }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="email">{{ $t("Email") }}</label>
                    <p>{{ supplier.supplier.email }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="phone">{{ $t("Contact No") }}</label>
                    <p>{{ supplier.supplier.phone }}</p>
                </div>
              
                <div class="form-group col-md-3">
                    <label for="created_on">{{ $t("Created On") }}</label>
                    <p>{{ created_at_date }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="updated_on">{{ $t("Updated On") }}</label>
                    <p>{{ updated_at_date }}</p>
                </div>
            </div>
            <hr />

            <div class="form-row mb-2">
                <div class="form-group col-md-3">
                    <label for="address">{{ $t("Address") }}</label>
                    <p>{{ supplier.address }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="pincode">{{ $t("Pincode") }}</label>
                    <p>{{ supplier.supplier.pincode }}</p>
                </div>
            </div>

            <div class="d-flex flex-wrap mb-1">
        <div class="mr-auto">
          <span class="text-subhead">{{ $t("Supplier Feedback") }}</span>
        </div>
        <div class=""></div>
      </div>
      <div class="form-row mb-2">
        <div class="form-group col-sm-12 col-md-4">
          <label for="delivery_timeline">{{ $t("Delivery Timeline") }}</label>
          <div class="rating">
            <span
              v-for="star in 5"
              v-bind:key="star"             
            >
              {{ star <= supplier.rating_delivery_timeline ? "★" : "☆" }}
            </span>
          </div>
          <textarea           
            class="form-control form-control-custom"
            rows="5"
            disabled
          > {{ supplier.delivery_timeline }} </textarea>

        </div>
        <div class="form-group col-sm-12 col-md-4">
          <label for="product_quality">{{ $t("Product Quality") }}</label>
          <div class="rating">
            <span
              v-for="star in 5"
              :key="star"             
            >
              {{ star <= supplier.rating_product_quality ? "★" : "☆" }}
            </span>
          </div>
          <textarea
           
           
            class="form-control form-control-custom"
            rows="5"
            disabled
            
          >{{ supplier.product_quality }}</textarea>

          
        </div>
        <div class="form-group col-sm-12 col-md-4">
          <label for="responsiveness">{{ $t("Responsiveness") }}</label>
          <div class="rating">
            <span v-for="star in 5" :key="star">
              {{ star <= supplier.rating_responsiveness ? "★" : "☆" }}
            </span>
          </div>
          <textarea
           
            class="form-control form-control-custom"
            rows="5"
           disabled
          >{{ supplier.responsiveness }}</textarea>

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
'use strict';

export default {
    data() {
        return {
            supplier: this.supplier_data,

            processing: false,
            delete_processing: false,
            show_modal: false,
            server_errors: '',
            error_class: '',
            delete_supplier_api_link: '/api/delete_supplier_performance/' + this.supplier_data.slack,
        }
    },
    
      props: {
        supplier_data: [Array, Object],
        delete_access: Boolean,
    },
    mounted() {
        console.log('Supplier detail page loaded');
    },
    computed: {
        created_at_date() {
            if (this.supplier_data.created_at) {
        const date = new Date(this.supplier_data.created_at);
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return date.toLocaleDateString('en-US', options);
      }
      return '';
        },

        updated_at_date() {
            if (this.supplier_data.updated_at) {
        const date = new Date(this.supplier_data.created_at);
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return date.toLocaleDateString('en-US', options);
      }
      return '';
        }
    },
    methods: {
        delete_supplier() {
            this.$off("submit");
            this.$off("close");
            this.show_modal = true;

            this.$on("submit", function () {
                this.processing = true;
                this.delete_processing = true;

                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);

                axios.post(this.delete_supplier_api_link, formData).then((response) => {

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
        }
    }
}
</script>
