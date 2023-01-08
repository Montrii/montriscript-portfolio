<template>
    <div class="w-full h-full" id="introduction">

<!--         background image - -->
        <div style="height: 100%; width: 100%; position: relative">
            <img style="height: 100%; width: 100%; object-fit:cover;
   object-position:50% 50%; filter: brightness(50%); " src="../../../public/wall-2.jpg" alt="hi">
        </div>



        <!-- overlapping div -->
        <div style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; text-align: center">
            <!-- text content -->
            <div style="margin: 0 auto;
    top: 50%; right: 20%;
    position: relative;" class="introText">
                <p>Hi, I'm</p>
                <span>Montri or also called Justin</span>
            </div>
        </div>

<!--        <Waypoint @change="onChange">-->
<!--            &lt;!&ndash; anything you want here &ndash;&gt;asd-->
<!--        </Waypoint>-->
    </div>
</template>

<script>
import axios from "axios";
import { Waypoint } from "vue-waypoint";
export default {
    name: "Introduction.vue",

    components: {
        Waypoint
    },

    mounted()
    {
        axios.get("/api/loadGithubRepositories").then(response => {
            console.log(response.data);
        });
    },

    methods:
        {
            onChange(viewChanged)
            {
                console.log(viewChanged);
            }
        }
}
</script>

<style scoped>


.introText
{
    text-align: right;
}

.introText p
{
    font-size: 3em;
    color: white;
    margin: 0;
    padding: 0;
}

.introText span
{
    font-size: 300%;
}
</style>
