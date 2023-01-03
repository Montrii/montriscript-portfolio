<template>
    <transition name="successful">
        <div v-if="this.show" class="fixed right-3 text-white py-2 px-4 rounded-xl bottom-10"
             style="background-color: rgba(0, 255, 64, 0.3); border: 1px solid rgba(0, 255, 64, 0.8)">
            <slot></slot>
        </div>
    </transition>
</template>

<script>
export default {
    name: "SuccessfulPopup.vue",

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
.successful-enter-active {
    transition: all .3s ease;
}
.successful-leave-active {
    transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.successful-enter-from , .successful-leave-to
    /* .slide-fade-leave-active below version 2.1.8 */ {
    transform: translateX(10px);
    opacity: 0;
}
</style>
