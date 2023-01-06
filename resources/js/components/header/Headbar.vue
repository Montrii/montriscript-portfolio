<template>
    <header class="headerStyle">
        <div class="headerWrapper">
            <div class="headerWrapper2">
                <div class="headerWrapper3">
                    <!-- logo -->
                    <HeaderLogo></HeaderLogo>
                </div>
                <div class="navbarDiv">
                    <!-- menu -->
                    <nav class="site-navigation navbarStyle">
                        <ul class="ulStyle">
                            <HeaderItem :id="'aboutMe'">About Me</HeaderItem>
                            <HeaderItem :id="'projects'">Projects</HeaderItem>
                            <HeaderItem :id="'contacts'">Contact</HeaderItem>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
import HeaderItem from "@/components/header/HeaderItem.vue";
import HeaderLogo from "@/components/header/HeaderLogo.vue";
export default {
    name: "Headbar.vue",
    components: {
        HeaderItem,
        HeaderLogo,
    },


}
</script>

<style scoped>
.headerStyle
{
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 2;
    height: 15%;
    padding: 20px;
}

.headerWrapper
{
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;    max-width: 1140px;
}

.headerWrapper2
{
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;-webkit-box-align: center !important;
    -ms-flex-align: center !important;
    align-items: center !important; position: relative !important;
}

.headerWrapper3
{
    -webkit-box-flex: 0;
    -ms-flex: 0 0 25%;
    flex: 0 0 25%;
    max-width: 25%;
}



.navbarDiv
{
    -webkit-box-flex: 0;
    -ms-flex: 0 0 75%;
    flex: 0 0 75%;
    max-width: 75%; text-align: right;
}

.navbarStyle
{
    text-align: right; margin-left: auto;display: block !important;
}

.ulStyle
{
    margin: 0;
    padding: 0;
}



</style>
