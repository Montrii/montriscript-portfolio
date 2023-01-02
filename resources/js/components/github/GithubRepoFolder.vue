<template>
    <div>
        <div class="w-full" style="min-height: 30px; padding-left: 12px; padding-right: 12px;
                box-sizing: border-box;
                padding-top: 3px;"
             >


            <!-- clickable folder --->
            <div style="cursor: pointer; " @click="clickFolder"
                 @mouseleave="fileHovered = false"
                 @mouseenter="fileHovered = true"
                 :class="{'fileHovered' : fileHovered}">

                <!-- determine icon --->
                <div v-if="this.isFile" style="display: inline-block">
                    <GithubFileIcon :extension="this.extension"></GithubFileIcon>
                </div>
                <div v-else-if="!this.isFile" style="display: inline-block">
                    <font-awesome-icon v-if="this.folderOpen" style="margin-right: 8px; color: #64D2FF;" icon="fa-solid fa-folder-open" />
                    <font-awesome-icon v-else-if="!this.folderOpen" style="margin-right: 8px; color: #64D2FF;" icon="fa-solid fa-folder" />
                </div>
                <span style="margin-right: 8px; font-weight: bold; display: inline-block;">{{this.folderName}}</span>
            </div>

            <div v-if="folderOpen" style="margin-right: 8px;">
                <GithubRepoFolder @fileSelected="onFileClickedTwo" :entireFile="folder" :allItems="this.allItems" :key="folder.size" v-for="folder in this.childItems" :folderName="folder.name" :childItems="getChildItems(folder)">{{folder.name}}</GithubRepoFolder>
            </div>

        </div>

    </div>
</template>

<script>
import GithubFileIcon from "@/components/github/GithubFileIcon.vue";
export default {
    name: "GithubRepoFolder",
    components: {GithubFileIcon},
    data()
    {
        return {
            folderOpen: false,
            isFile: false,
            extension: "",
            fileHovered: false,
        }
    },

    props: {
        childItems: {
            type: Array,
            required: true
        },
        folderName: {
            type: String,
            required: true
        },
        allItems: {
            type: Array,
            required: true
        },
        entireFile: {
            type: Object,
            required: true,
        },
    },



    mounted()
    {
        this.isFile = this.childItems.length === 0;
        if(this.isFile)
        {
            this.extension = this.folderName.split(".")[1];
        }
    },
    methods:
        {
            clickFolder()
            {
                this.folderOpen = !this.folderOpen;

                if(this.isFile)
                {
                    this.onFileClickedTwo(this.entireFile);
                }
            },
            getChildItems(folder)
            {
                return this.allItems.filter((items) =>
                {
                    return items.path.includes(folder.name) && items.path.split("/").indexOf(folder.name) === items.path.split("/").length-2;
                });
            },

            onFileClickedTwo(file)
            {
                this.$emit("fileSelected", file);
            }
        }
}
</script>

<style scoped>


.fileHovered
{
    background-color: rgb(97, 97, 97);
    color: white;
}
</style>
