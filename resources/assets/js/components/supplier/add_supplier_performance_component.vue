<template>
  <div>
    <div class="card">
      <form @submit.prevent="submit_form" class="mb-3">
        <div class="card-header d-flex flex-wrap mb-4">
          <div class="mr-auto">
            <span class="text-title" v-if="supplier_slack == null">{{
              $t("Add Supplier Performance")
            }}</span>
            <span class="text-title" v-else>{{ $t("Edit Supplier Performance") }}
            </span>
          </div>
          <div class="">
            <button v-if="supplier_slack == null" type="submit" class="btn btn-primary"
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
            <label for="name">{{ $t("Supplier Name") }}</label>
            <select name="name" v-model="name" class="form-control form-control-custom custom-select">
              <option value="" selected disabled>Choose Supplier..</option>
              <option v-for="supplier in suppliers" v-bind:key="supplier.id" :value="supplier.id">
                {{ supplier.name }}
              </option>
            </select>
            <span v-bind:class="{ error: errors.has('name') }">{{
              errors.first("name")
            }}</span>
          </div>
          <div class="form-group col-sm-12 col-md-4">
            <label for="address">{{ $t("Address") }}</label>
            <input type="text" name="address" v-model="address" v-validate="'max:65535'"
              class="form-control form-control-custom" rows="5" :placeholder="$t('Enter Address')" />
            <span v-bind:class="{ error: errors.has('address') }">{{
              errors.first("address")
            }}</span>
          </div>

          <div class="form-group col-sm-12 col-md-4">
            <label for="status">{{ $t("Status") }}</label>
            <select name="status" v-model="status" class="form-control form-control-custom custom-select"
              v-validate="'required'">
              <option value="" selected disabled>Choose Status..</option>
              <option value="Active">Active</option>
              <option value="InActive">InActive</option>
            </select>
            <span v-bind:class="{ error: errors.has('status') }">{{
              errors.first("status")
            }}</span>
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
              <span v-for="star in max" v-bind:key="star" @click="delivery_timeline(star)">
                {{ star <= DeliveryTimeline ? "★" : "☆" }} </span>
            </div>
            <textarea name="delivery_timeline" v-model="TDeliveryTimeline" v-validate="'required'"
              class="form-control form-control-custom" rows="5"
              :placeholder="$t('Delivery Timeline Feedback')"></textarea>

            <span v-bind:class="{ error: errors.has('delivery_timeline') }">{{
              errors.first("delivery_timeline")
            }}</span>
          </div>
          <div class="form-group col-sm-12 col-md-4">
            <label for="product_quality">{{ $t("Product Quality") }}</label>
            <div class="rating">
              <span v-for="star in max" :key="star" @click="product_quality(star)">
                {{ star <= ProductQuality ? "★" : "☆" }} </span>
            </div>
            <textarea name="product_quality" v-model="TProductQuality" v-validate="'required|max:65535'"
              class="form-control form-control-custom" rows="5" :placeholder="$t('Product Quality Feedback')"></textarea>

            <span v-bind:class="{ error: errors.has('product_quality') }">{{
              errors.first("product_quality")
            }}</span>
          </div>
          <div class="form-group col-sm-12 col-md-4">
            <label for="responsiveness">{{ $t("Responsiveness") }}</label>
            <div class="rating">
              <span v-for="star in max" :key="star" @click="responsiveness(star)">
                {{ star <= Responsiveness ? "★" : "☆" }} </span>
            </div>
            <textarea name="responsiveness" v-model="TResponsiveness" v-validate="'required|max:65535'"
              class="form-control form-control-custom" rows="5" :placeholder="$t('Responsiveness Feedback')"></textarea>

            <span v-bind:class="{ error: errors.has('responsiveness') }">{{
              errors.first("responsiveness")
            }}</span>
          </div>
        </div>
      </form>

      <modalcomponent v-if="show_modal" v-on:close="show_modal = false">
        <template v-slot:modal-header>
          {{ $t("Confirm") }}
        </template>
        <template v-slot:modal-body>
          <p v-if="status == 0">
            If supplier is inactive all the products with this supplier will get
            affected.
          </p>
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
  </div>
</template>

<script>
"use strict";

export default {
  data() {
    return {
      max: 5,
      server_errors: "",
      processing: false,
      modal: false,
      show_modal: false,
      error_class: "",
      api_link: this.supplier_data == null ? "/api/submit_supplier_performance" : "/api/update_supplier_performance/" + this.supplier_data.slack,
      DeliveryTimeline: this.supplier_data && this.supplier_data.rating_delivery_timeline !== null ? this.supplier_data.rating_delivery_timeline : 0,
      TDeliveryTimeline: this.supplier_data && this.supplier_data.delivery_timeline !== null ? this.supplier_data.delivery_timeline : "",

      TProductQuality: this.supplier_data && this.supplier_data.product_quality !== null ? this.supplier_data.product_quality : "",

      TResponsiveness: this.supplier_data && this.supplier_data.responsiveness !== null ? this.supplier_data.responsiveness : "",

      ProductQuality: this.supplier_data && this.supplier_data.rating_product_quality !== null ? this.supplier_data.rating_product_quality : 0,

      Responsiveness: this.supplier_data && this.supplier_data.rating_responsiveness !== null ? this.supplier_data.rating_responsiveness : 0,

      supplier_slack: this.supplier_data && this.supplier_data.slack !== null ? this.supplier_data.slack : null,

      status: this.supplier_data && this.supplier_data.status !== null ? this.supplier_data.status || "" : "",

      name: typeof this.selectedSupplierId !== "undefined" && this.selectedSupplierId !== null ? this.selectedSupplierId.toString() : "",

      address: this.supplier_data && this.supplier_data.address !== null ? this.supplier_data.address : "",
    };
  },
  props: {
    statuses: Array,
    selectedSupplierId: Number,
    suppliers: Array,
    supplier_data: Array,
  },
  methods: {
    delivery_timeline(rating) {
      this.DeliveryTimeline = rating;
    },
    product_quality(rating) {
      this.ProductQuality = rating;
    },
    responsiveness(rating) {
      this.Responsiveness = rating;
    },
    submit_form() {
      this.$validator.validateAll().then((result) => {
        if (result) {
          this.show_modal = true;
          this.$on("submit", function () {
            this.processing = true;

            const formData = new FormData();
            formData.append("access_token", window.settings.access_token);
            formData.append("name", this.name);
            formData.append("status", this.status);
            formData.append("address", this.address);
            formData.append("DeliveryTimeline", this.TDeliveryTimeline);
            formData.append("ProductQuality", this.TProductQuality);
            formData.append("Responsiveness", this.TResponsiveness);
            formData.append("Rating_DeliveryTimeline", this.DeliveryTimeline);
            formData.append("Rating_ProductQuality", this.ProductQuality);
            formData.append("Rating_Responsiveness", this.Responsiveness);
            // console.log(...formData);

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
  },
};
</script>
<style>
.rating {
  margin-top: 10px;
}

.rating span {
  cursor: pointer;
  font-size: 24px;
  margin-right: 5px;
}
</style>

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

.mb-2,
.my-2 {
  margin-bottom: 0.5rem !important;
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

.text-subhead {
  color: var(--label-sub-head);
  font-weight: 500;
  font-size: 15px;
  margin-left: 10px;
}
</style>
