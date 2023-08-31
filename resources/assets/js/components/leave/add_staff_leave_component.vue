<template>
    <div class="row">
      <div class="col-md-12">
        <form @submit.prevent="submit_form" class="mb-3">
          <div class="d-flex flex-wrap mb-4">
            <div class="mr-auto">
              <div>
                <span class="text-title" v-if="product_slack == ''">{{
                  $t("Add Leave")
                }}</span>
                <span class="text-title" v-else>{{ $t("Edit Leave") }}</span>
              </div>
      
            </div>
            <div class="">
              <button
                type="submit"
                class="btn btn-primary"
                v-bind:disabled="processing == true"
              >
                <i
                  class="fa fa-circle-notch fa-spin"
                  v-if="processing == true"
                ></i>
                {{ $t("Save") }}
              </button>
            </div>
          </div>
  
          <p v-html="server_errors" v-bind:class="[error_class]"></p>
  
          <div class="d-flex flex-wrap mb-1">
            <div class="mr-auto">
              <span class="text-subhead">{{ $t("Leave Information") }}</span>
            </div>
            <div class=""></div>
          </div>
  
          <div class="form-row mb-2">
            <div class="form-group col-md-3">
              <label for="apply_date">{{ $t("Apply Date") }}</label>
              <input
                type="date"
                name="apply_date"
                v-model="apply_date"
                v-validate="'required'"
                class="form-control form-control-custom"
                :placeholder="$t('Please enter product code')"
                autocomplete="off"
              />
              <span v-bind:class="{ error: errors.has('apply_date') }">{{
                errors.first("apply_date")
              }}</span>
            </div>
            <div class="form-group col-md-3">
              <label for="leave_types">{{ $t("Available Leaves") }}</label>
              <select
                name="leave_type"
                v-model="leave_type"
                v-validate="'required'"
                class="form-control form-control-custom custom-select"
              >
                <option value="">Choose Leave Type..</option>
                <option
                  v-for="(leave_type, index) in leaveTypes"
                  v-bind:value="leave_type.id"
                  v-bind:key="index"
                >
                  {{ leave_type.type }}
                </option>
              </select>
              <span v-bind:class="{ error: errors.has('leave_type') }">{{
                errors.first("leave_type")
              }}</span>
            </div>
            <div class="form-group col-md-3">
              <label for="supplier">{{ $t("Supplier") }}</label>
              <select
                name="supplier"
                v-model="supplier"
                v-validate="'required'"
                class="form-control form-control-custom custom-select"
              >
                <option value="">Choose Supplier..</option>
                <option
                  v-for="(supplier, index) in suppliers"
                  v-bind:value="supplier.slack"
                  v-bind:key="index"
                >
                  {{ supplier.name }}
                </option>
              </select>
              <span v-bind:class="{ error: errors.has('supplier') }">{{
                errors.first("supplier")
              }}</span>
            </div>
            <div class="form-group col-md-3">
              <label for="category">{{ $t("Category") }}</label>
              <select
                name="category"
                v-model="category"
                v-validate="'required'"
                class="form-control form-control-custom custom-select"
              >
                <option selected disabled>Select a Category...</option>
                <optgroup
                  v-for="(cat, index) in categories"
                  :label="cat.label"
                  :key="index"
                  :disabled="false"
                >
                  <option
                    v-for="subcategory in cat.subcategories"
                    :value="subcategory.id"
                    :key="subcategory.id"
                  >
                    {{ subcategory.sub_category_name }}
                  </option>
                </optgroup>
              </select>
              <span v-bind:class="{ error: errors.has('category') }">{{
                errors.first("category")
              }}</span>
            </div>
          </div>
  
          <div class="form-row mb-2">
            <div class="form-group col-md-3">
              <label for="status">{{ $t("Status") }}</label>
              <select
                name="status"
                v-model="status"
                v-validate="'required|numeric'"
                class="form-control form-control-custom custom-select"
              >
                <option value="">Choose Status..</option>
                <option
                  v-for="(status, index) in statuses"
                  v-bind:value="status.value"
                  v-bind:key="index"
                >
                  {{ status.label }}
                </option>
              </select>
              <span v-bind:class="{ error: errors.has('status') }">{{
                errors.first("status")
              }}</span>
            </div>
          </div>
  
          <hr />
  
          <div class="d-flex flex-wrap mb-1">
            <div class="mr-auto">
              <span class="text-subhead">{{
                $t("Tax & Discount Information")
              }}</span>
            </div>
            <div class=""></div>
          </div>
  
          <div class="form-row mb-2">
            <div class="form-group col-md-3">
              <label for="tax_code">{{ $t("Tax Code") }}</label>
              <select
                name="tax_code"
                v-model="tax_code"
                v-validate="'required'"
                class="form-control form-control-custom custom-select"
                v-on:change="check_tax_type($event)"
              >
                <option value="">Choose Tax Code..</option>
                <option
                  v-for="(taxcode, index) in taxcodes"
                  v-bind:value="taxcode.slack"
                  v-bind:key="index"
                  v-bind:data-tax_type="taxcode.tax_type"
                  v-bind:data-tax_percentage="taxcode.total_tax_percentage"
                >
                  {{ taxcode.tax_code }} - {{ taxcode.label }} [Tax%:
                  {{ taxcode.total_tax_percentage }}] ({{ taxcode.tax_type }})
                </option>
              </select>
              <span v-bind:class="{ error: errors.has('tax_code') }">{{
                errors.first("tax_code")
              }}</span>
            </div>
            <div class="form-group col-md-3">
              <label for="discount_code">{{ $t("Discount Code") }}</label>
              <select
                name="discount_code"
                v-model="discount_code"
                v-validate="''"
                class="form-control form-control-custom custom-select"
              >
                <option value="">Choose Discount Code..</option>
                <option
                  v-for="(discount_code, index) in discount_codes"
                  v-bind:value="discount_code.slack"
                  v-bind:key="index"
                >
                  {{ discount_code.discount_code }} - {{ discount_code.label }}
                </option>
              </select>
              <span v-bind:class="{ error: errors.has('discount_code') }">{{
                errors.first("discount_code")
              }}</span>
            </div>
          </div>
  
          <hr />
  
          <div class="d-flex flex-wrap mb-1">
            <div class="mr-auto">
              <span class="text-subhead">{{
                $t("Price & Quantity Information")
              }}</span>
            </div>
            <div class=""></div>
          </div>
          <div class="form-row mb-2">
            <div class="form-group col-md-3">
              <label for="purchase_price"
                >{{ $t("Purchase Price Excluding Tax") }} ({{
                  currency_code
                }})</label
              >
              <input
                type="number"
                name="purchase_price"
                v-model="purchase_price"
                v-validate="'required|decimal'"
                class="form-control form-control-custom"
                :placeholder="$t('Please enter purchase price excluding tax')"
                autocomplete="off"
                step="0.01"
                min="0"
              />
              <span v-bind:class="{ error: errors.has('purchase_price') }">{{
                errors.first("purchase_price")
              }}</span>
            </div>
            <div class="form-group col-md-3">
              <label for="sale_price"
                >{{ $t("Sale Price Excluding Tax") }} ({{ currency_code }})</label
              >
              <input
                type="number"
                name="sale_price"
                v-model="sale_price"
                v-validate="'required|decimal'"
                class="form-control form-control-custom"
                :placeholder="$t('Please enter sale price excluding tax')"
                autocomplete="off"
                step="0.01"
                min="0"
                v-on:input="calculate_sale_prices"
                :readonly="is_taxcode_inclusive == true"
              />
              <span v-bind:class="{ error: errors.has('sale_price') }">{{
                errors.first("sale_price")
              }}</span>
            </div>
            <div class="form-group col-md-3">
              <label for="sale_price"
                >{{ $t("Sale Price Including Tax") }} ({{ currency_code }})</label
              >
              <input
                type="number"
                name="sale_price_including_tax"
                v-model="sale_price_including_tax"
                v-validate="{ required: is_taxcode_inclusive, decimal: true }"
                class="form-control form-control-custom"
                :placeholder="$t('Please enter sale price including tax')"
                autocomplete="off"
                step="0.01"
                min="0"
                v-on:input="calculate_sale_prices"
                :readonly="is_taxcode_inclusive == false"
              />
              <span
                v-bind:class="{ error: errors.has('sale_price_including_tax') }"
                >{{ errors.first("sale_price_including_tax") }}</span
              >
            </div>
          </div>
          <div class="form-row mb-2">
            <div class="form-group col-md-3">
              <label for="status">{{ $t("Quantity") }}</label>
              <input
                type="number"
                name="quantity"
                v-model="quantity"
                v-validate="quantity_validate"
                class="form-control form-control-custom"
                :placeholder="$t('Please enter quantity')"
                autocomplete="off"
                step="0.01"
                min="0"
              />
              <span v-bind:class="{ error: errors.has('quantity') }">{{
                errors.first("quantity")
              }}</span>
            </div>
            <div class="form-group col-md-3">
              <label for="status">{{ $t("Stock Alert Quantity") }}</label>
              <input
                type="number"
                name="alert_quantity"
                v-model="alert_quantity"
                v-validate="'decimal'"
                class="form-control form-control-custom"
                :placeholder="$t('Please enter stock alert quantity')"
                autocomplete="off"
                step="0.01"
                min="0"
              />
              <span v-bind:class="{ error: errors.has('alert_quantity') }">{{
                errors.first("alert_quantity")
              }}</span>
            </div>
          </div>
          <div class="form-row mb-2">
            <div class="form-group col-md-3">
              <label for="description">{{ $t("Description") }}</label>
              <textarea
                name="description"
                v-model="description"
                v-validate="'max:65535'"
                class="form-control form-control-custom"
                rows="5"
                :placeholder="$t('Enter description')"
              ></textarea>
              <span v-bind:class="{ error: errors.has('description') }">{{
                errors.first("description")
              }}</span>
            </div>
          </div>
          <div class="form-row mb-2">
            <div class="form-group col-md-3">
              <label for="product_image">{{
                $t("Product Image") + " (jpeg, jpg, png, webp)"
              }}</label>
              <input
                type="file"
                class="form-control-file form-control form-control-custom file-input"
                name="product_image"
                ref="product_image"
                accept="image/x-png,image/jpeg,image/webp"
                v-validate="'ext:jpg,jpeg,png,webp|size:1500'"
                multiple="multiple"
              />
              <small class="form-text text-muted mb-1"
                >Allowed file size per file is 1.5 MB</small
              >
              <small class="form-text text-muted"
                >Hold down CTRL or Command for choosing multiple files</small
              >
              <span v-bind:class="{ error: errors.has('product_image') }">{{
                errors.first("product_image")
              }}</span>
            </div>
          </div>
  
          <div class="mb-2">
            <div class="d-flex flex-row flex-wrap">
              <div
                class=""
                v-for="(image, index) in images"
                v-bind:value="image.slack"
                v-bind:key="index"
              >
                <div v-if="image.filename != ''">
                  <button
                    type="button"
                    aria-label="Close"
                    class="close bg-light image-remove"
                    v-on:click="remove_image(image.slack)"
                  >
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <img
                    :src="image.thumbnail"
                    alt=""
                    class="rounded mr-3 mb-3"
                    v-on:click="open_image(image.filename)"
                  />
                </div>
              </div>
            </div>
          </div>
  
          <hr />
  
          <div v-if="is_addon_product == 0 && is_ingredient == 0">
            <div class="form-row mb-2" v-if="variants.length != 0">
              <div class="form-group col-md-3">
                <label for="tax_code">{{
                  $t("Variant Option for Current Product")
                }}</label>
                <select
                  name="parent_variant_option"
                  v-model="parent_variant_option"
                  v-validate="'required'"
                  class="form-control form-control-custom custom-select"
                  data-vv-as="Variant Option"
                >
                  <option value="">Choose Variant Option..</option>
                  <option
                    v-for="(variant_option, index) in variant_options"
                    v-bind:value="variant_option.slack"
                    v-bind:key="index"
                  >
                    {{ variant_option.label }}
                  </option>
                </select>
                <span
                  v-bind:class="{ error: errors.has('parent_variant_option') }"
                  >{{ errors.first("parent_variant_option") }}</span
                >
              </div>
            </div>
  
            <div class="d-flex flex-wrap mb-1">
              <div class="mr-auto">
                <span class="text-subhead">{{ $t("Product Variants") }}</span>
              </div>
              <div class=""></div>
            </div>
  
            <div>
              <div class="form-row mb-2">
                <div class="form-group col-md-4">
                  <label for="variants">{{
                    $t("Search and Add Variant Products")
                  }}</label>
                  <cool-select
                    type="text"
                    v-model="search_variants"
                    autocomplete="off"
                    inputForTextClass="form-control form-control-custom"
                    :items="variant_list"
                    item-text="name"
                    itemValue="name"
                    :resetSearchOnBlur="false"
                    disable-filtering-by-search
                    @search="load_variants"
                    @select="add_variant_to_list"
                    :placeholder="$t('Start Typing..')"
                  >
                    <template #item="{ item }">
                      <div class="d-flex justify-content-start">
                        <div>{{ item.product_code }} - {{ item.name }}</div>
                      </div>
                    </template>
                  </cool-select>
                </div>
              </div>
  
              <div v-if="variants.length != 0">
                <div class="form-row">
                  <div class="form-group col-md-3 mb-1">
                    <label for="name">{{ $t("Variant Option") }}</label>
                  </div>
                  <div class="form-group col-md-6 mb-1">
                    <label for="name">{{ $t("Name & Description") }}</label>
                  </div>
                  <div class="form-group col-md-2 mb-1">
                    <label for="sale_price"
                      >{{ $t("Sale Price") }} ({{ currency_code }})</label
                    >
                  </div>
                </div>
                <div
                  class="form-row mb-1"
                  v-for="(variant, index) in variants"
                  :key="index"
                >
                  <div class="form-group col-md-3">
                    <select
                      v-bind:name="'variant.variant_option_' + index"
                      v-model="variant.variant_option_slack"
                      v-validate="'required'"
                      class="form-control form-control-custom custom-select"
                      data-vv-as="Variant Option"
                    >
                      <option value="">Choose Variant Option..</option>
                      <option
                        v-for="(variant_option, index) in variant_options"
                        v-bind:value="variant_option.slack"
                        v-bind:key="index"
                      >
                        {{ variant_option.label }}
                      </option>
                    </select>
                    <span
                      v-bind:class="{
                        error: errors.has('variant.variant_option_' + index),
                      }"
                      >{{ errors.first("variant.variant_option_" + index) }}</span
                    >
                  </div>
                  <div class="form-group col-md-6">
                    <input
                      type="text"
                      v-bind:name="'variant.name_' + index"
                      v-model="variant.product_code + '-' + variant.name"
                      v-validate="'max:250'"
                      data-vv-as="Name"
                      class="form-control form-control-custom"
                      autocomplete="off"
                      readonly="true"
                    />
                    <span
                      v-bind:class="{
                        error: errors.has('variant.name_' + index),
                      }"
                      >{{ errors.first("variant.name_" + index) }}</span
                    >
                  </div>
                  <div class="form-group col-md-2">
                    <input
                      type="number"
                      v-bind:name="'variant.sale_price_' + index"
                      v-model="variant.sale_price"
                      v-validate="
                        variant.name != ''
                          ? 'required|decimal|min_value:0.01'
                          : ''
                      "
                      data-vv-as="Sale Price"
                      class="form-control form-control-custom"
                      autocomplete="off"
                      step="0.01"
                      min="0"
                      readonly="true"
                    />
                    <span
                      v-bind:class="{
                        error: errors.has('variant.sale_price_' + index),
                      }"
                      >{{ errors.first("variant.sale_price_" + index) }}</span
                    >
                  </div>
                  <div
                    class="form-group col-md-1"
                    v-if="variant.variant_slack != product_slack"
                  >
                    <button
                      type="button"
                      class="btn btn-outline-danger"
                      @click="
                        remove_variant(index, variant.product_variant_slack)
                      "
                    >
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
              </div>
              <div v-if="variants.length == 0">
                <span class="text-muted">No variants selected!</span>
              </div>
            </div>
  
            <hr />
          </div>
  
          <div v-if="is_addon_product == 0 && is_ingredient == 0">
            <div class="d-flex flex-wrap mb-1">
              <div class="mr-auto">
                <span class="text-subhead">{{ $t("Choose Add-on Groups") }}</span>
              </div>
              <div class=""></div>
            </div>
  
            <div class="form-row mb-2">
              <div class="form-group col-md-3">
                <label for="description">{{ $t("Add-on Groups") }}</label>
                <multiselect
                  v-model="addon_group_values"
                  :options="addon_groups"
                  :multiple="true"
                  :close-on-select="false"
                  :clear-on-select="false"
                  :preserve-search="true"
                  placeholder="Choose Add-on Groups"
                  label="label"
                  track-by="slack"
                  :preselect-first="false"
                >
                  <template
                    slot="selection"
                    class="form-control"
                    slot-scope="{ values, isOpen }"
                    ><span
                      class="multiselect__single"
                      v-if="values.length &amp;&amp; !isOpen"
                      >{{ values.length }} options selected</span
                    ></template
                  >
                </multiselect>
              </div>
            </div>
            <hr />
          </div>
  
          <div
            v-if="
              restaurant_mode == 1 && is_ingredient == 0 && is_addon_product == 0
            "
          >
            <div class="d-flex flex-wrap mb-1">
              <div class="mr-auto">
                <span class="text-subhead">{{
                  $t("Ingredient Information")
                }}</span>
              </div>
              <div class=""></div>
            </div>
  
            <div>
              <div class="form-row mb-2">
                <div class="form-group col-md-4">
                  <label for="ingredients">{{
                    $t("Search and Add Ingredients")
                  }}</label>
                  <cool-select
                    type="text"
                    v-model="search_ingredients"
                    autocomplete="off"
                    inputForTextClass="form-control form-control-custom"
                    :items="ingredient_list"
                    item-text="name"
                    itemValue="name"
                    :resetSearchOnBlur="false"
                    disable-filtering-by-search
                    @search="load_ingredients"
                    @select="add_ingredient_to_list"
                    :placeholder="$t('Start Typing..')"
                  >
                    <template #item="{ item }">
                      <div class="d-flex justify-content-start">
                        <div>{{ item.product_code }} - {{ item.name }}</div>
                      </div>
                    </template>
                  </cool-select>
                  <small class="form-text text-muted"
                    >Choose ingredients for preparing 1 Unit or Quantity of the
                    product</small
                  >
                </div>
              </div>
  
              <div class="form-row">
                <div class="form-group col-md-4 mb-1">
                  <label for="name">{{ $t("Name & Description") }}</label>
                </div>
                <div class="form-group col-md-2 mb-1">
                  <label for="purchase_price">{{
                    $t("Purchase Price of 1 Unit")
                  }}</label>
                </div>
                <div class="form-group col-md-2 mb-1">
                  <label for="sale_price">{{ $t("Sale Price of 1 Unit") }}</label>
                </div>
                <div class="form-group col-md-1 mb-1">
                  <label for="quantity">{{ $t("Quantity") }}</label>
                </div>
                <div class="form-group col-md-2 mb-1">
                  <label for="measurement_unit">{{ $t("Measuring Unit") }}</label>
                </div>
              </div>
  
              <div
                class="form-row mb-2"
                v-for="(ingredient, index) in ingredients"
                :key="index"
              >
                <div class="form-group col-md-4">
                  <input
                    type="text"
                    v-bind:name="'ingredient.name_' + index"
                    v-model="ingredient.name"
                    v-validate="'max:250'"
                    data-vv-as="Name"
                    class="form-control form-control-custom"
                    autocomplete="off"
                    readonly="true"
                  />
                  <span
                    v-bind:class="{
                      error: errors.has('ingredient.name_' + index),
                    }"
                    >{{ errors.first("ingredient.name_" + index) }}</span
                  >
                </div>
                <div class="form-group col-md-2">
                  <input
                    type="number"
                    v-bind:name="'ingredient.purchase_price_' + index"
                    v-model="ingredient.purchase_price"
                    v-validate="
                      ingredient.name != ''
                        ? 'required|decimal|min_value:0.01'
                        : ''
                    "
                    data-vv-as="Purchase Price"
                    class="form-control form-control-custom"
                    autocomplete="off"
                    step="0.01"
                    min="0"
                    readonly="true"
                  />
                  <span
                    v-bind:class="{
                      error: errors.has('ingredient.purchase_price_' + index),
                    }"
                    >{{
                      errors.first("ingredient.purchase_price_" + index)
                    }}</span
                  >
                </div>
                <div class="form-group col-md-2">
                  <input
                    type="number"
                    v-bind:name="'ingredient.sale_price_' + index"
                    v-model="ingredient.sale_price"
                    v-validate="
                      ingredient.name != ''
                        ? 'required|decimal|min_value:0.01'
                        : ''
                    "
                    data-vv-as="Sale Price"
                    class="form-control form-control-custom"
                    autocomplete="off"
                    step="0.01"
                    min="0"
                    readonly="true"
                  />
                  <span
                    v-bind:class="{
                      error: errors.has('ingredient.sale_price_' + index),
                    }"
                    >{{ errors.first("ingredient.sale_price_" + index) }}</span
                  >
                </div>
                <div class="form-group col-md-1">
                  <input
                    type="number"
                    v-bind:name="'ingredient.quantity_' + index"
                    v-model="ingredient.quantity"
                    v-validate="
                      ingredient.name != ''
                        ? 'required|decimal|min_value:0.01'
                        : ''
                    "
                    data-vv-as="Quantity"
                    class="form-control form-control-custom"
                    autocomplete="off"
                    step="0.01"
                    min="0"
                    v-on:change="update_ingredient_prices"
                  />
                  <span
                    v-bind:class="{
                      error: errors.has('ingredient.quantity_' + index),
                    }"
                    >{{ errors.first("ingredient.quantity_" + index) }}</span
                  >
                </div>
                <div class="form-group col-md-2">
                  <select
                    v-bind:name="'ingredient.unit_' + index"
                    v-model="ingredient.unit_slack"
                    v-validate="''"
                    class="form-control form-control-custom custom-select"
                  >
                    <option value="">Choose Measurement Unit..</option>
                    <option
                      v-for="(measurement_unit, index) in measurement_units"
                      v-bind:value="measurement_unit.slack"
                      v-bind:key="index"
                    >
                      {{ measurement_unit.unit_code }} -
                      {{ measurement_unit.label }}
                    </option>
                  </select>
                  <span
                    v-bind:class="{
                      error: errors.has('ingredient.unit_' + index),
                    }"
                    >{{ errors.first("ingredient.unit_" + index) }}</span
                  >
                </div>
                <div class="form-group col-md-1">
                  <button
                    type="button"
                    class="btn btn-outline-danger"
                    @click="remove_ingredient(index)"
                  >
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
  
              <div class="form-row mb-2">
                <div class="form-group col-md-3">
                  <label for="description">{{
                    $t("Total Ingredient Purchase Price")
                  }}</label>
                  <p>{{ currency_code }} {{ ingredient_purchase_price }}</p>
                </div>
                <div class="form-group col-md-3">
                  <label for="description">{{
                    $t("Total Ingredient Selling Price Excluding Tax")
                  }}</label>
                  <p>{{ currency_code }} {{ ingredient_selling_price }}</p>
                </div>
              </div>
              <div class="form-row mb-2">
                <div class="form-group col-md-6">
                  <div class="custom-control custom-switch">
                    <input
                      type="checkbox"
                      class="custom-control-input"
                      id="is_ingredient_price"
                      v-model="is_ingredient_price"
                      @change="update_product_prices()"
                      :disabled="is_taxcode_inclusive == true"
                    />
                    <label
                      class="custom-control-label"
                      for="is_ingredient_price"
                      >{{ $t("Set Product Price as Ingredient Cost") }}</label
                    >
                    <small
                      class="form-text text-muted"
                      v-show="is_taxcode_inclusive == false"
                      >{{
                        $t(
                          "If this option is enabled, product sale price and purchase price will be replaced with ingredient cost"
                        )
                      }}</small
                    >
                    <small
                      class="form-text text-muted"
                      v-show="is_taxcode_inclusive == true"
                      ><i class="fas fa-info-circle text-warning"></i>
                      {{
                        $t("Option not available if the tax is INCLUSIVE")
                      }}</small
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
  
      <modalcomponent v-if="show_modal" v-on:close="show_modal = false">
        <template v-slot:modal-header>
          {{ $t("Confirm") }}
        </template>
        <template v-slot:modal-body>
          <p v-if="status == 0">Product status is inactive.</p>
          {{ $t("Are you sure you want to proceed?") }}
        </template>
        <template v-slot:modal-footer>
          <button type="button" class="btn btn-light" @click="$emit('close')">
            Cancel
          </button>
          <button
            type="button"
            class="btn btn-primary"
            @click="$emit('submit')"
            v-bind:disabled="processing == true"
          >
            <i class="fa fa-circle-notch fa-spin" v-if="processing == true"></i>
            Continue
          </button>
        </template>
      </modalcomponent>
    </div>
  </template>
  
  <script>
  "use strict";
  
  import { CoolSelect } from "vue-cool-select";
  import "vue-cool-select/dist/themes/bootstrap.css";
  
  import Multiselect from "vue-multiselect";
  import "vue-multiselect/dist/vue-multiselect.min.css";
  
  export default {
    components: { Multiselect },
    data() {
      return {
        leaveTypes: this.leave_types,
        subcategory: this.product_data,
        server_errors: "",
        error_class: "",
        processing: false,
        modal: false,
        show_modal: false,
        leave_types: '',
        apply_date: this.getCurrentDate(),
        api_link:
          this.product_data == null
            ? "/api/add_product"
            : "/api/update_product/" + this.product_data.slack,
  
        product_slack: this.product_data == null ? "" : this.product_data.slack,
        product_name: this.product_data == null ? "" : this.product_data.name,
        product_code:
          this.product_data == null ? "" : this.product_data.product_code,
        description:
          this.product_data == null ? "" : this.product_data.description,
        supplier:
          this.product_data == null
            ? ""
            : this.product_data.supplier == null
            ? ""
            : this.product_data.supplier.slack,
        category:
          this.product_data == null
            ? ""
            : this.product_data.category == null
            ? ""
            : this.product_data.category.id,
        tax_code:
          this.product_data == null
            ? ""
            : this.product_data.tax_code == null
            ? ""
            : this.product_data.tax_code.slack,
        discount_code:
          this.product_data == null
            ? ""
            : this.product_data.discount_code == null
            ? ""
            : this.product_data.discount_code.slack,
        quantity: this.product_data == null ? "" : this.product_data.quantity,
        alert_quantity:
          this.product_data == null ? "" : this.product_data.alert_quantity,
        sale_price:
          this.product_data == null
            ? ""
            : this.product_data.sale_amount_excluding_tax,
        sale_price_including_tax:
          this.product_data == null
            ? ""
            : this.product_data.sale_amount_including_tax,
        purchase_price:
          this.product_data == null
            ? ""
            : this.product_data.purchase_amount_excluding_tax,
        status: this.product_data == null ? "" : this.product_data.status.value,
        images: this.product_data == null ? "" : this.product_data.images,
        currency_code: window.settings.currency_code,
  
        stock_transfer_max_quantity:
          this.stock_transfer_data == null
            ? ""
            : this.stock_transfer_product_data.quantity,
        stock_transfer_product_slack:
          this.stock_transfer_data == null
            ? ""
            : this.stock_transfer_product_data.slack,
        stock_transfer:
          this.stock_transfer_data == null ? "" : this.stock_transfer_data,
        stock_transfer_product:
          this.stock_transfer_product_data == null
            ? ""
            : this.stock_transfer_product_data,
  
        quantity_validate: {
          required: true,
          decimal: true,
        },
  
        is_ingredient:
          this.product_data == null
            ? false
            : this.product_data.is_ingredient != null
            ? this.product_data.is_ingredient == 1
              ? true
              : false
            : false,
  
        ingredient_list: [],
        search_ingredients: "",
        ingredient_template: {
          ingredient_slack: "",
          name: "",
          sale_price: "",
          purchase_price: "",
          quantity: "",
          unit_slack: "",
        },
  
        product_ingredient_list:
          this.product_data != null ? this.product_data.ingredients : [],
  
        ingredients: [],
  
        restaurant_mode: window.settings.restaurant_mode,
        ingredient_purchase_price: 0,
        ingredient_selling_price: 0,
  
        is_ingredient_price:
          this.product_data == null
            ? false
            : this.product_data.is_ingredient_price != null
            ? this.product_data.is_ingredient_price == 1
              ? true
              : false
            : false,
  
        is_addon_product:
          this.product_data == null
            ? false
            : this.product_data.is_addon_product != null
            ? this.product_data.is_addon_product == 1
              ? true
              : false
            : false,
  
        addon_group_values: [],
  
        variant_list: [],
        search_variants: "",
        variant_template: {
          product_variant_slack: "",
          variant_option_slack: "",
          variant_slack: "",
          name: "",
          product_code: "",
          sale_price: "",
        },
  
        product_variant_list:
          this.product_data != null ? this.product_data.variants : [],
  
        variants: [],
  
        parent_variant_option:
          this.product_data == null
            ? ""
            : this.product_data.parent_variant_option,
  
        is_taxcode_inclusive:
          typeof this.taxcode_inclusive != "undefined"
            ? this.taxcode_inclusive
            : false,
  
        selected_tax_percentage:
          typeof this.taxcode_percentage != "undefined"
            ? this.taxcode_percentage
            : 0,
      };
    },
    props: {
      users: [Array, Object],
      leave_types: [Array, Object],
      
    },
    mounted() {
      console.log("Add product page loaded");
    },
    created() {
    
    },
    methods: {
      
      getCurrentDate() {
      const now = new Date();
      const year = now.getFullYear();
      const month = (now.getMonth() + 1).toString().padStart(2, '0'); // Adding 1 since January is 0
      const day = now.getDate().toString().padStart(2, '0');
      return `${year}-${month}-${day}`;
    },
    },
  };
  </script>
  