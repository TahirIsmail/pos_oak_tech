<template>
  <div class="row">
    <div class="col-md-12">

      <form @submit.prevent="submit_form" class="mb-3">
        <div class="d-flex flex-wrap mb-4">
          <div class="mr-auto">
            <span class="text-title" v-if="category_slack == ''">{{
              $t("Add Category")
            }}</span>
            <span class="text-title" v-else>{{ $t("Edit Category") }}</span>
          </div>
          <div class="">
            <button type="submit" class="btn btn-primary" v-bind:disabled="processing == true">
              <i class="fa fa-circle-notch fa-spin" v-if="processing == true"></i>
              {{ $t("Save") }}
            </button>
          </div>
        </div>

        <p v-html="server_errors" v-bind:class="[error_class]"></p>

        <div class="form-row mb-2">
          <div class="form-group col-sm-12 col-md-10 col-lg-4 mx-auto">
            <label for="category_name">{{ $t("Category Name") }}</label>
            <input type="text" name="category_name" v-model="category_name" v-validate="'required|max:250'"
              class="form-control form-control-custom" :placeholder="$t('Please enter category name')"
              autocomplete="off" />
            <span v-bind:class="{ error: errors.has('category_name') }">{{
              errors.first("category_name")
            }}</span>
          </div>
          <div class="form-group col-sm-12 col-md-10 col-lg-4 mx-auto">
            <label for="category_code">{{ $t("Category Code") }}</label>
            <input type="text" name="category_code" v-model="category_code" v-validate="'required|max:250'"
              class="form-control form-control-custom" :placeholder="$t('Please enter category code')"
              autocomplete="off" />
            <span v-bind:class="{ error: errors.has('category_code') }">{{
              errors.first("category_code")
            }}</span>
          </div>

          <div class="form-group col-sm-12 col-md-10 col-lg-4 mx-auto">
            <label for="category_code">{{ $t("Sub Categories") }}</label>
            <vue-tags-input v-model="tag" :tags="tags" @tags-changed="handleTagsChanged"
              placeholder="Add Sub Categories" />

          </div>


        </div>

        <div class="form-row mb-2">
          <div class="form-group col-sm-12 col-md-10 col-lg-4 mx-auto">
            <label for="display_on_qr_menu">{{ $t("Show on QR Menu") }}</label>
            <select name="display_on_qr_menu" v-model="display_on_qr_menu" v-validate="'required|numeric'"
              class="form-control form-control-custom custom-select">
              <option value="">Choose Show on QR Menu..</option>
              <option v-for="(
                  display_on_qr_menu_option, index
                ) in display_on_qr_menu_options" v-bind:value="index" v-bind:key="index">
                {{ display_on_qr_menu_option }}
              </option>
            </select>
            <span v-bind:class="{ error: errors.has('display_on_qr_menu') }">{{
              errors.first("display_on_qr_menu")
            }}</span>
          </div>
          <div class="form-group col-sm-12 col-md-10 col-lg-4 mx-auto">
            <label for="status">{{ $t("Status") }}</label>
            <select name="status" v-model="status" v-validate="'required|numeric'"
              class="form-control form-control-custom custom-select">
              <option value="">Choose Status..</option>
              <option v-for="(status, index) in statuses" v-bind:value="status.value" v-bind:key="index">
                {{ status.label }}
              </option>
            </select>
            <span v-bind:class="{ error: errors.has('status') }">{{
              errors.first("status")
            }}</span>
          </div>
          <div class="form-group col-sm-12 col-md-10 col-lg-4 mx-auto">
            <!-- <label for="display_on_pos_screen">{{
              $t("Show on Screen")
            }}</label>
            <select
              name="display_on_pos_screen"
              v-model="display_on_pos_screen"
              v-validate="'required|numeric'"
              class="form-control form-control-custom custom-select"
            >
              <option value="">Choose Show on Screen..</option>
              <option
                v-for="(
                  display_on_pos_screen_option, index
                ) in display_on_pos_screen_options"
                :value="index"
                v-bind:key="index"
              >
                {{ display_on_pos_screen_option }}
              </option>
            </select>
            <span
              v-bind:class="{ error: errors.has('display_on_pos_screen') }"
              >{{ errors.first("display_on_pos_screen") }}</span -->
            <!-- > -->


          </div>

          <div class="form-group col-sm-12 col-md-10 col-lg-12 mx-auto">
            <label for="description">{{ $t("Description") }}</label>
            <textarea name="description" v-model="description" v-validate="'max:65535'"
              class="form-control form-control-custom" rows="5" :placeholder="$t('Enter description')"></textarea>
            <span v-bind:class="{ error: errors.has('description') }">{{
              errors.first("description")
            }}</span>
          </div>

        </div>
      </form>


      <table class="table" v-if="category_code">
        <thead>
          <th>#</th>
          <th>Sub Category Name</th>
          <th>Status</th>
          <th>Action</th>
        </thead>
        <tbody>
          <tr>
          <tr v-for="(subcategory, index) in sub_categories" :key="subcategory.id">
            <td>{{ index + 1 }}</td>
            <td>{{ subcategory.sub_category_name }}</td>
            <td>Active</td> <!-- You can replace this with actual status logic -->
            <td>
              <button class="btn btn-success" @click="editSubcategory(subcategory)">Edit</button>
              <button class="btn btn-danger" @click="deleteSubcategory(subcategory.id)">Delete</button>
            </td>
          </tr>

        </tbody>
      </table>
    </div>

    <modalcomponent v-if="show_modal" v-on:close="show_modal = false">
      <template v-slot:modal-header>
        {{ $t("Confirm") }}
      </template>
      <template v-slot:modal-body>
        <p v-if="status == 0">
          If category is inactive all the products under this catgeory will get
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

    <!-- Modal for editing subcategory -->
    <!-- Modal for editing subcategory -->
    <div v-if="editModalVisible" class="modal-overlay">
      <div class="modal modal_style">
        <div class="modal-content">
          <h2>Edit Subcategory</h2>
          <input v-model="editedSubcategoryName" type="text" class="form-control" />
          <div class="button-container">
            <button @click="updateSubcategory" class="btn btn-success">Save</button>
            <button @click="cancelEdit" class="btn btn-secondary">Cancel</button>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
"use strict";
import VueTagsInput from "@johmun/vue-tags-input";

export default {
  //   components: {
  //   VueTagsInput,
  // },
  data() {
    return {
      server_errors: "",
      error_class: "",
      processing: false,
      modal: false,
      show_modal: false,
      editModalVisible: false,
      editedSubcategoryName: '',
      editingSubcategory: null,
      tag: '',
      tags: [],
      sub_categories: (this.category_data && this.category_data.subcategories) ? this.category_data.subcategories : [],
      api_link:
        this.category_data == null
          ? "/api/add_category"
          : "/api/update_category/" + this.category_data.slack,

      // display_on_pos_screen_options: {
      //   1: "Yes",
      //   0: "No",
      // },

      display_on_qr_menu_options: {
        1: "Yes",
        0: "No",
      },
      category_code:
        this.category_data && this.category_data.category_code !== null
          ? this.category_data.category_code
          : "",
      category_slack:
        this.category_data == null ? "" : this.category_data.slack,
      category_name: this.category_data == null ? "" : this.category_data.label,
      description:
        this.category_data == null ? "" : this.category_data.description,
      display_on_pos_screen:
        this.category_data && this.category_data.display_on_pos_screen !== null
          ? this.category_data.display_on_pos_screen
          : "",
      display_on_qr_menu:
        this.category_data == null
          ? ""
          : this.category_data.display_on_qr_menu == null
            ? ""
            : this.category_data.display_on_qr_menu,
      status:
        this.category_data == null
          ? ""
          : this.category_data.status == null
            ? ""
            : this.category_data.status.value,
    };
  },

  props: {
    statuses: Array,
    category_data: [Array, Object],

  },
  mounted() {
    console.log("Add category page loaded");
  },

  methods: {
    handleTagsChanged(newTags) {
      this.tags = newTags.map(tag => tag.text); // Extract the 'text' property
    },
    editSubcategory(subcategory) {
      this.editingSubcategory = subcategory;
      this.editedSubcategoryName = subcategory.sub_category_name;
      this.editModalVisible = true;
    },
    updateSubcategory() {
      // Assuming you have the edited subcategory name and subcategory ID     
            var formData = new FormData();
            formData.append("access_token", window.settings.access_token);
            formData.append(
              "id",
              this.editingSubcategory.id
            );
            formData.append("sub_category_name", this.editedSubcategoryName);

      axios
        .post('/api/update_subcategory', formData)
        .then(response => {
          if (response.data.status_code == 200) {
                  this.show_response_message(response.data.msg, "Success");
                  this.editModalVisible = false;
                  setTimeout(function () {
                    location.reload();
                  }, 1000);
                } else {
                  this.editModalVisible = false;
                  try {
                    var error_json = JSON.parse(response.data.msg);
                    this.loop_api_errors(error_json);
                  } catch (err) {
                    this.server_errors = response.data.msg;
                  }
                  this.error_class = "error";
                }
          // Handle success
          // Refresh data or update UI as needed
         
        })
        .catch(error => {
          console.error('Error updating subcategory:', error);
        });
    },
    cancelEdit() {
      this.editModalVisible = false;
      this.editingSubcategory = null;
      this.editedSubcategoryName = '';
    },
    submit_form() {
      this.$off("submit");
      this.$off("close");

      this.$validator.validateAll().then((result) => {
        if (result) {
          this.show_modal = true;
          this.$on("submit", function () {
            this.processing = true;
            var formData = new FormData();
            console.log(this.tags.join(","));
            formData.append("access_token", window.settings.access_token);
            formData.append(
              "category_name",
              this.category_name == null ? "" : this.category_name
            );
            formData.append("sub_categories[]", this.tags);
            formData.append(
              "category_code",
              this.category_code == null ? "" : this.category_code
            );
            formData.append(
              "description",
              this.description == null ? "" : this.description
            );
            formData.append(
              "display_on_qr_menu",
              this.display_on_qr_menu == null ? "" : this.display_on_qr_menu
            );

            formData.append("status", this.status == null ? "" : this.status);

            console.log(...formData);

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
                console.log(error);
              });
          });

          this.$on("close", function () {
            this.show_modal = false;
          });
        }
      });
    },
    deleteSubcategory(id) {
      this.show_modal = true;

      this.show_modal = true;
      this.$on("submit", function () {
        this.processing = true;
        var formData = new FormData();
        formData.append("access_token", window.settings.access_token);
        formData.append("id", id);

        axios
          .post('/api/delete_subcategory', formData)
          .then((response) => {
            
            if (response.data.status_code == 200) {
              this.show_response_message(response.data.msg, "Success");
              this.show_modal = false;
              this.processing = false;
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
            alert('kashif');
            console.log(error);
          });
      });
    }
  },
};
</script>
<style>
/* Overlay background */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

/* Actual modal */
.modal_style {
  background-color: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
  width: 50%;
  margin-left: auto;
    margin-right: auto;
    height: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top:10%;
}
.modal-content {
  border:none!important;
}

/* Centering and spacing for buttons */
.button-container {
  display: flex;
  justify-content: flex-end;
  margin-top: 10px;
}

/* Bootstrap-like button styles */
.btn {
  margin-left: 10px;
  padding: 8px 16px;
  border: none;
  cursor: pointer;
  border-radius: 4px;
}

.btn-success {
  background-color: #28a745;
  color: white;
}

.btn-secondary {
  background-color: #6c757d;
  color: white;
}
</style>


