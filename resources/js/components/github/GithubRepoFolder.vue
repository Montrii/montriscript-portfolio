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
                    <font-awesome-icon v-if="this.extension === 'html'" style="margin-right: 8px" icon="fa-brands fa-html5"/>
                    <font-awesome-icon v-else-if="this.extension === 'js'" style="margin-right: 8px" icon="fa-brands fa-js"/>
                    <font-awesome-icon v-else-if="this.extension === 'css' || this.extension === 'scss'" style="margin-right: 8px" icon="fa-brands fa-css3-alt"/>
                    <font-awesome-icon v-else-if="this.extension === 'php'" style="margin-right: 8px" icon="fa-brands fa-php"/>
                    <font-awesome-icon v-else style="margin-right: 8px" icon="fa-regular fa-file-code"/>
                </div>
                <div v-else-if="!this.isFile" style="display: inline-block">
                    <font-awesome-icon style="margin-right: 8px" icon="fa-solid fa-folder" />
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
export default {
    name: "GithubRepoFolder",

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
