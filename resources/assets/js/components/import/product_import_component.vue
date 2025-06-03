<template>
    <div class="product-import-section p-3" v-if="visible">
        <div class="form-row mb-2">
            <!-- Category Selection -->
            <div class="form-group col-md-3">
                <label>{{ $t("Category") }}</label>
                <select 
                    v-model="selectedCategory" 
                    class="form-control"
                    @change="loadSubcategories"
                    v-validate="'required'"
                    name="category"
                >
                    <option value="">Select Category</option>
                    <option 
                        v-for="category in categories" 
                        :key="category.id" 
                        :value="category.slack"
                    >
                        {{ category.label }}
                    </option>
                </select>
                <span v-bind:class="{ 'error' : errors.has('category') }">
                    {{ errors.first('category') }}
                </span>
            </div>

            <!-- Supplier Selection -->
            <div class="form-group col-md-3">
                <label>{{ $t("Supplier") }}</label>
                <select 
                    v-model="selectedSupplier" 
                    class="form-control"
                    v-validate="'required'"
                    name="supplier"
                >
                    <option value="">Select Supplier</option>
                    <option 
                        v-for="supplier in suppliers" 
                        :key="supplier.id" 
                        :value="supplier.slack"
                    >
                        {{ supplier.name }}
                    </option>
                </select>
                <span v-bind:class="{ 'error' : errors.has('supplier') }">
                    {{ errors.first('supplier') }}
                </span>
            </div>

            <!-- Tax Code Selection -->
            <div class="form-group col-md-3">
                <label>{{ $t("Tax Code") }}</label>
                <select 
                    v-model="selectedTaxCode" 
                    class="form-control"
                >
                    <option value="">Select Tax Code</option>
                    <option 
                        v-for="taxCode in taxCodes" 
                        :key="taxCode.id" 
                        :value="taxCode.slack"
                    >
                        {{ taxCode.label }}
                    </option>
                </select>
            </div>
        </div>

        <!-- Category Specifications -->
        <div v-if="specifications.length > 0" class="specifications-section mt-3">
            <label class="mb-2">{{ $t("Category Specifications") }}</label>
            <div class="row">
                <div 
                    v-for="spec in specifications" 
                    :key="spec.id"
                    class="col-md-3 mb-3"
                >
                    <label>{{ spec.specification_label }}</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        v-model="specificationValues[spec.id]"
                        :placeholder="spec.specification_label"
                    >
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ProductImportComponent',
    
    data() {
        return {
            categories: [],
            suppliers: [],
            taxCodes: [],
            specifications: [],
            selectedCategory: '',
            selectedSupplier: '',
            selectedTaxCode: '',
            specificationValues: {},
            loading: false
        }
    },

    props: {
        visible: {
            type: Boolean,
            default: false
        }
    },

    watch: {
        visible: {
            immediate: true,
            handler(newVal) {
                if (newVal) {
                    this.loadDependencies()
                }
            }
        }
    },

    methods: {
        async loadDependencies() {
            this.loading = true
            try {
                const [categoriesRes, suppliersRes, taxCodesRes] = await Promise.all([
                    axios.post('/api/category_list'),
                    axios.post('/api/supplier_list'),
                    axios.post('/api/tax_code_list')
                ])

                this.categories = categoriesRes.data
                this.suppliers = suppliersRes.data
                this.taxCodes = taxCodesRes.data
            } catch (error) {
                this.$emit('error', 'Error loading dependencies')
            } finally {
                this.loading = false
            }
        },

        async loadSubcategories() {
            if (!this.selectedCategory) return

            try {
                const response = await axios.post('/api/category_specifications', {
                    category_id: this.selectedCategory
                })
                this.specifications = response.data
                this.initializeSpecificationValues()
            } catch (error) {
                this.$emit('error', 'Error loading specifications')
            }
        },

        initializeSpecificationValues() {
            this.specificationValues = {}
            this.specifications.forEach(spec => {
                this.specificationValues[spec.id] = ''
            })
        },

        getFormData() {
            return {
                category_slack: this.selectedCategory,
                supplier_slack: this.selectedSupplier,
                tax_code_slack: this.selectedTaxCode,
                specifications: this.specificationValues
            }
        },

        reset() {
            this.selectedCategory = ''
            this.selectedSupplier = ''
            this.selectedTaxCode = ''
            this.specifications = []
            this.specificationValues = {}
        }
    }
}
</script>

<style scoped>
.product-import-section {
    background-color: #f8f9fa;
    border-radius: 4px;
}

.specifications-section {
    background-color: white;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    padding: 1rem;
}

.error {
    color: #dc3545;
    font-size: 0.875rem;
}
</style>