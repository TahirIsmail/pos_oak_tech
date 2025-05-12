<!-- Create a new file: ToastNotification.vue -->
<template>
    <transition name="fade">
        <div v-if="show" class="toast-notification" :class="type">
            {{ message }}
        </div>
    </transition>
</template>

<script>
export default {
    name: 'ToastNotification',
    props: {
        message: String,
        type: String
    },
    data() {
        return {
            show: false
        }
    },
    mounted() {
        this.show = true;
        setTimeout(() => {
            this.show = false;
        }, 3000);
    }
}
</script>

<style scoped>
.toast-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 10px 20px;
    border-radius: 4px;
    color: white;
    z-index: 9999;
}

.SUCCESS {
    background-color: #4caf50;
}

.ERROR {
    background-color: #f44336;
}

.fade-enter-active, .fade-leave-active {
    transition: opacity .5s;
}
.fade-enter, .fade-leave-to {
    opacity: 0;
}
</style>