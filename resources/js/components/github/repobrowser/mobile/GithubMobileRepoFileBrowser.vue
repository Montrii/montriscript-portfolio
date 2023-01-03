<template>
    <!-- button to be able to be clicked --->
    <div class="mobileFileBrowserButton"
    :class="{'mobileButtonClicked': this.mobileButtonClicked}"
    @click="onMobileButtonClicked">

        <div class="mobileFileBrowserIcon text-center">
            <font-awesome-icon class="inline-block" icon="fa-solid fa-bars" />
        </div>
    </div>

    <!-- "blurry background -->
    <transition name="mobileFileBrowserAppear">
        <div v-if="this.mobileButtonClicked" class="w-full h-full transitionHeight" style="position: relative; background-color: rgba(57, 57, 57, 0.2);">
            <div class="transitionHeightResult" style="width: 75%; height: 95%; position: relative; background-color: rgb(21, 21, 21); margin: 0 auto;
border-radius: 10px; box-shadow: 2px 2px rgba(0,0,0,0.3), -2px 0 0 rgba(0,0,0,0.3)"></div>
        </div>
    </transition>
</template>

<script>
export default {
    name: "GithubMobileRepoFileBrowser",

    // test

    data()
    {
        return {
            mobileButtonClicked: false,
        }
    },
    methods:
        {
            onMobileButtonClicked()
            {
                this.mobileButtonClicked = !this.mobileButtonClicked;
            },
        }
}
</script>

<style scoped>

.mobileFileBrowserAppear-enter-active,
.mobileFileBrowserAppear-leave-active {
    transition: opacity 0.5s ease;
}

.mobileFileBrowserAppear-enter-from,
.mobileFileBrowserAppear-leave-to {
    opacity: 0;
}

.mobileButtonClicked
{
    background-color: rgb(97, 97, 97);
    color: white;
}
.mobileFileBrowserButton
{
    margin: 0 auto;
    border: 1px solid rgb(52, 52, 52);
    width: 10%;
}

.mobileFileBrowserIcon
{
    position: relative;
    width: 20px;
    margin: 0 auto;
}
</style>
