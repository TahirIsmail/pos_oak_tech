/* __placeholder__ */
'use strict';
export default (await import('vue')).defineComponent({
data() {
return {
category: this.category_data,
display_on_pos_screen: (this.category_data.display_on_pos_screen == 1) ? 'Yes' : 'No',
display_on_qr_menu: (this.category_data.display_on_qr_menu == 1) ? 'Yes' : 'No',
category_id: this.category_data.id,
sub_category_id: '',
child_category_id: '',
category_product_name: '',
child_categories: [],
CategorySpecifications: [],
category_specification_id: '',
show_modal_add_category: false,
category_name: this.category_data.label,
child_category_name: '',
processing: false,
delete_processing: false,
add_child_category_processing: false,
add_category_specification_details_processing: false,
add_category_specifications_processing: false,
show_modal: false,
show_modal_specification_values: false,
show_modal_category_specification: false,
server_errors: '',
tag: '',
tags: [],
SpecificationValue: '',
SpecificationValues: [],
delete_category_api_link: '/api/delete_category/' + this.category_data.slack,
category_specification: '/api/categorySpecifications',

subCategoryId: '',
childCategoryId: '',
categorySpecificationId: '',
specificationValueId: '',

ViewChildCategory: [],
ViewCategorySpecification: [],
ViewSpecificationValues: [],

ViewSpecificationValuesStatus: false,
ViewChildCategoryStatus: false,
ViewCategorySpecificationStatus: false,
mainTable: true,
};
},
props: {
category_data: [Array, Object],
delete_access: Boolean,
},
mounted() {
console.log('Category detail page loaded');
},
methods: {
handleTagsChanged(newTags) {
this.tags = newTags.map(tag => tag.text);
},


handleTagsSpecificationValues(newTags) {
this.SpecificationValues = newTags.map(SpecificationValue => SpecificationValue.text);
},


add_category_specifications() {
this.show_modal_category_specification = true;
this.child_categories = [];
this.CategorySpecifications = [];
this.sub_category_id = '';
},

add_child_category() {

this.show_modal_add_category = true;
this.child_categories = [];
this.CategorySpecifications = [];
this.sub_category_id = '';

},
add_category_specification_details() {
this.show_modal_specification_values = true;
this.child_categories = [];
this.CategorySpecifications = [];
this.sub_category_id = '';
},

fetchChildCategories() {
this.child_categories = [];
this.CategorySpecifications = [];
var formData = new FormData();
formData.append("access_token", window.settings.access_token);
formData.append("sub_category_id", this.sub_category_id);
axios.post('/api/fetch_child_categories', formData).then((response) => {

if (response.data.status_code == 200) {
console.log(response.data.data);
this.child_categories = response.data.data.child_categories;
this.CategorySpecifications = response.data.data.category_specifications;
}
})
.catch((error) => {
console.log(error);
});

},

fetchCategoriesSpecifications() {
this.CategorySpecifications = [];
var formData = new FormData();
formData.append("access_token", window.settings.access_token);
formData.append("child_category_id", this.child_category_id);
axios.post('/api/fetch_category_specifications', formData).then((response) => {

if (response.data.status_code == 200) {
this.CategorySpecifications = response.data.data.category_specifications;
}
})
.catch((error) => {
console.log(error);
});
},

delete_category() {
this.$off("submit");
this.$off("close");
this.show_modal = true;

this.$on("submit", function () {
this.processing = true;
this.delete_processing = true;

var formData = new FormData();
formData.append("access_token", window.settings.access_token);

axios.post(this.delete_category_api_link, formData).then((response) => {

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
submit_child_category() {
this.$validator.validateAll().then((result) => {
if (result) {
this.$off("submit");
this.$off("close");
this.show_modal = true;
this.$on("submit", function () {

var formData = new FormData();
formData.append("access_token", window.settings.access_token);
formData.append("category_id", this.category_id);
formData.append("sub_category_id", (this.sub_category_id ? this.sub_category_id : null));
formData.append("child_category_name", this.child_category_name);

console.log(...formData);

axios.post('/api/submit_child_category', formData).then((response) => {

if (response.data.status_code == 200) {
this.show_response_message(response.data.msg, 'Success');
location.reload();

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
});
this.$on("close", function () {
this.show_modal = false;
});
}
});
},
submit_specification_values() {
this.$validator.validateAll().then((result) => {
if (result) {
this.$off("submit");
this.$off("close");
this.show_modal = true;
this.$on("submit", function () {
var formData = new FormData();
formData.append("access_token", window.settings.access_token);
formData.append("category_specification_id", this.category_specification_id);
formData.append("SpecificationValues[]", this.SpecificationValues);
axios.post('/api/submit_specification_values', formData).then((response) => {

if (response.data.status_code == 200) {
this.show_response_message(response.data.msg, 'Success');
location.reload();

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
});
this.$on("close", function () {
this.show_modal = false;
});
}
});
},



submit_categorSpecifications() {
this.$validator.validateAll().then((result) => {
if (result) {
this.$off("submit");
this.$off("close");
this.show_modal = true;
this.$on("submit", function () {

var formData = new FormData();
formData.append("access_token", window.settings.access_token);
formData.append("category_id", this.category_id);
formData.append("sub_category_id", (this.sub_category_id ? this.sub_category_id : null));
formData.append("child_category_id", (this.child_category_id ? this.child_category_id : null));
formData.append("category_specification[]", this.tags);

axios.post('/api/categorySpecifications', formData).then((response) => {

if (response.data.status_code == 200) {
this.show_response_message(response.data.msg, 'Success');
location.reload();

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
});
this.$on("close", function () {
this.show_modal = false;
});
}
});
},




ViewChildCategoryF() {
this.categorySpecificationId = '';
this.specificationValueId = '';
var formData = new FormData();
formData.append("access_token", window.settings.access_token);
formData.append("subCategoryId", this.subCategoryId);
axios.post('/api/view_child_or_specifications_categories', formData).then((response) => {

if (response.data.status_code == 200) {
if (response.data.data.child_categories && response.data.data.child_categories.length > 0) {
this.ViewChildCategory = response.data.data.child_categories;
this.ViewChildCategoryStatus = true;
this.mainTable = false;
this.ViewCategorySpecificationStatus = false;
}
if (response.data.data.category_specifications && response.data.data.category_specifications.length > 0) {
this.ViewCategorySpecification = response.data.data.category_specifications;
this.ViewCategorySpecificationStatus = true;
this.ViewSpecificationValuesStatus = false;
this.mainTable = false;
this.ViewChildCategoryStatus = false;
}

}
})
.catch((error) => {
console.log(error);
});
},


ViewCategorySpecificationF() {
this.specificationValueId = '';
var formData = new FormData();
formData.append("access_token", window.settings.access_token);
formData.append("childCategoryId", this.childCategoryId);
axios.post('/api/view_specifications_categories', formData).then((response) => {

if (response.data.status_code == 200) {
if (response.data.data.specifications && response.data.data.specifications.length > 0) {
this.ViewCategorySpecification = response.data.data.specifications;
this.ViewCategorySpecificationStatus = true;
this.ViewSpecificationValuesStatus = false;
this.mainTable = false;
this.ViewChildCategoryStatus = false;
}
}
})
.catch((error) => {
console.log(error);
});
},


ViewSpecificationValuesF() {
var formData = new FormData();
formData.append("access_token", window.settings.access_token);
formData.append("categorySpecificationId", this.categorySpecificationId);
axios.post('/api/view_specifications_values', formData).then((response) => {

if (response.data.status_code == 200) {
if (response.data.data.specifications_values && response.data.data.specifications_values.length > 0) {
this.ViewSpecificationValues = response.data.data.specifications_values;
this.ViewSpecificationValuesStatus = true;
this.ViewCategorySpecificationStatus = false;
this.mainTable = false;
this.ViewChildCategoryStatus = false;
}
}
})
.catch((error) => {
console.log(error);
});
},


EditValue(id, text) {
var formData = new FormData();
formData.append("access_token", window.settings.access_token);
formData.append("condition_id", id);
formData.append("condition_text", text);
axios.post('/api/edit_categories_portion', formData).then((response) => {

if (response.data.status_code == 200) {
if (response.data.data.specifications_values && response.data.data.specifications_values.length > 0) {
}
}
})
.catch((error) => {
console.log(error);
});
},


toggleEdit(child_category) {
this.$set(child_category, 'isEditable', !child_category.isEditable);
},
onEditInput(child_category) {
alert('onEditInput');
child_category.child_category = event.target.innerText;
},
onEditBlur(child_category) {
alert('onEditBlur');
// Handle the blur event (when the element loses focus)
// You can perform additional actions here, if needed
console.log(`Value after editing: ${child_category.child_category}`);
},
}
});
