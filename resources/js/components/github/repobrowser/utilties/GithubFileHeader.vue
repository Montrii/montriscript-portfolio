<template>
    <div class="h-full italic ml-5 pl-5 pr-5"
         draggable="true" style="border-left: 1px solid rgb(52, 52, 52); border-right : 1px solid rgb(52, 52, 52); display: inline-block; z-index: 1; position: relative"
         @click="setFileClose()">
        <GithubFileIcon class="pr-3" :extension="this.extension"></GithubFileIcon>
        <span class="font-bold">{{ this.currentFile.name }}</span>
        <font-awesome-icon class="pl-7 pt-1" icon="fa-solid fa-xmark"/>
    </div>
</template>

<script>
import GithubFileIcon from "@/components/github/repobrowser/utilties/GithubFileIcon.vue";
export default {
    name: "GithubFileHeader",
    components: {
        GithubFileIcon
    },
    props:
        {
            currentFile: {
                type: Object,
                required: true
            }
        },
    data()
    {
        return {
            extension: ''
        }
    },

    methods:
        {
            setFileClose()
            {
                this.$emit('fileClosed');
            }
        },

    mounted()
    {
        if(this.currentFile.name.split('.')[1] !== undefined)
        {
            this.extension = this.currentFile.name.split('.')[1];
        }
    }
}
</script>

<style scoped>

</style>
