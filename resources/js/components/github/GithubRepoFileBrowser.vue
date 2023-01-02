<template>
    <div class="h-full filesUnselectable" style=" overflow: auto; width: 12.5%; float: left; border-right: 1px solid rgb(52, 52, 52);; border-bottom: 1px solid rgb(52, 52, 52);">
        <!-- files header -->
        <div class="w-full h-5" style="min-height: 30px; padding-left: 12px; padding-right: 12px; border-bottom: 1px solid rgb(52, 52, 52);
                border-top-color: rgb(52, 52, 52);
                border-right-color: rgb(52, 52, 52);
                border-left-color: rgb(52, 52, 52);
                cursor: pointer; box-sizing: border-box;
                padding-top: 3px;"
        @mouseleave="headerHovered = false"
             @mouseenter="headerHovered = true"
             @click="toggleHeader"
        :class="{'buttonHovered' : headerHovered}">
            <font-awesome-icon style="margin-right: 8px" icon="fa-solid fa-caret-down"/>
                        <span style="margin-right: 8px; font-weight: bold">Files</span>
        </div>
        <div class="w-full" v-if="headerOpen">
            <GithubRepoFolder @fileSelected="onFileClickedChild" :entireFile="folder" :allItems="this.selectedRepo" :key="folder.size" v-for="folder in this.startingFolders" :folderName="folder.name" :childItems="getChildItemsForStartingFolders(folder)">{{folder.name}}</GithubRepoFolder>
        </div>
    </div>
</template>

<script>
import GithubRepoFolder from "@/components/github/GithubRepoFolder.vue";
export default {
    name: "GithubRepoFileBrowser.vue",
    components: {GithubRepoFolder},
    data()
    {
        return {
            headerHovered: false,
            headerOpen: true,

            startingFolders: [],
        }
    },
    props: {
        selectedRepo : {
            type: Array,
            required: true
        }
    },

    methods:
        {
            toggleHeader()
            {
                this.headerOpen = !this.headerOpen;
            },

            getChildItemsForStartingFolders(folder)
            {
                return this.selectedRepo.filter((child) =>
                {
                    return child.path.includes(folder.name) && child.path.split("/").length === 2;
                });
            },


            onFileClickedChild(file)
            {
                this.$emit('fileSelected', file);
            }


        },


    mounted()
    {
        this.startingFolders = this.selectedRepo.filter((file) => file.type === 'dir' && !file.path.includes("/"));
    }

}
</script>

<style scoped>


.filesUnselectable
{
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.buttonHovered
{
    background-color: rgb(97, 97, 97);
    color: white;
}


/* SCROLLBAR STYLES */
::-webkit-scrollbar {
    width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
    background: transparent;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: rgb(52, 52, 52);
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555;
}

</style>
