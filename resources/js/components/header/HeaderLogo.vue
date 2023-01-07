<template>
    <div class="logoDiv" @click="returnToHomepage">
        <font-awesome-icon icon="fa-solid fa-code" style="height: 30px;"/>
    </div>
</template>

<script>
export default {
    name: "HeaderLogo.vue",

    methods:
        {
            returnToHomepage()
            {
                document.getElementById("introduction").scrollIntoView({behavior: "smooth"});
            }
        }
}
</script>

<style scoped>
.logoDiv
{
    margin: 0;
    padding: 0;
    font-size: 1rem;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    cursor: pointer;
}
</style>
