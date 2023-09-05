<template>
    <div class="container pt-3 entry_form">
        <div class="d-flex justify-content-center pt-5">
            <div class="container1 col-sm-12 col-md-6 col-lg-4 col-lg-4">
                <img :src="company_logo" class="d-block mb-4 entry_logo ml-auto mr-auto" alt="OAK">
                <span class="text-display-0 d-block mb-3 text-center">Customer Sign in</span>
                <p v-html="server_errors" v-bind:class="[error_class]"></p>
                {{ message }}
                <form @submit.prevent="submit_form" class="mb-3">
                    <div class="form-group">
                        <label for="email">{{ $t("Email") }}</label>
                        <input type="email" name="email" v-model="email" v-validate="'required|email'"
                            class="form-control form-control-lg" :placeholder="$t('Please enter your registered email')"
                            autocomplete="off">
                        <span v-bind:class="{ 'error': errors.has('email') }">{{ errors.first('email') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="password">{{ $t("Password") }}</label>
                        <input type="password" name="password" v-model="password" v-validate="'required'"
                            class="form-control form-control-lg" :placeholder="$t('Please enter your password')">
                        <span v-bind:class="{ 'error': errors.has('password') }">{{ errors.first('password') }}</span>
                    </div>
                    <div class="form-group">
                        <a href="/forgot_password" class="btn-label">Forgot Password</a>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg" v-bind:disabled="processing == true"> <i
                            class='fa fa-circle-notch fa-spin' v-if="processing == true"></i> Sign in</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
'use strict';
export default {
    data() {
        return {
            server_errors: '',
            error_class: '',
            processing: false,
            email: (this.is_demo == true && this.preview_mode == true) ? 'customer@OAK.com' : '',
            password: (this.is_demo == true && this.preview_mode == true) ? 'Customer' : '',
            message: this.prop_message
        }
    },

    props: {
            prop_message: String,
            is_demo: Boolean,
            preview_mode: Boolean,
            company_logo: String
        },
    mounted() {
        console.log('Customer Sign in page loaded');
        
    },

}


</script>
<style scoped>
.container1 {
    
    box-shadow: 0 4px 6px rgba(79, 49, 202, 0.1), 
                0 0 10px rgba(0, 0, 0, 0.2), 
                0 0 20px rgba(0, 0, 0, 0.3);
    border-radius: 10px;
}

.container1:hover {
   
   background-color: #fcfcfc;
}

.container1 .btn {
    margin-left: 0;
   
}
</style>