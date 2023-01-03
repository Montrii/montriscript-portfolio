<template>
    <transition name="error">
        <div v-if="show" class="fixed right-3 py-2 px-4 rounded-xl bottom-10"
        style="color: white; background-color: rgba(255, 0, 0, 0.3); border: 1px solid rgba(255, 0, 0, 0.8)">
            <slot></slot>
        </div>
    </transition>
</template>

<script>
export default {
    name: "ErrorPopup.vue",


    data()
    {
        return {
            show: false,
        }
    },

    mounted()
    {
        this.show = true;

        setTimeout(() => {
            this.show = false;
        }, 5000);
    }
}
</script>

<style scoped>
.error-enter-active {
    transition: all .3s ease;
}
.error-leave-active {
    transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.error-enter-from , .error-leave-to
    /* .slide-fade-leave-active below version 2.1.8 */ {
    transform: translateX(10px);
    opacity: 0;
}
</style>
