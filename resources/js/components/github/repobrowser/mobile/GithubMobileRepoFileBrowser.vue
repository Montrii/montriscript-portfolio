<template>
    <!-- button to be able to be clicked --->
    <div class="w-full h-full relative">
        <div class="mobileFileBrowserButton"
             :class="{'mobileButtonClicked': this.mobileButtonClicked}"
             @click="onMobileButtonClicked">

            <div class="mobileFileBrowserIcon text-center">
                <font-awesome-icon class="inline-block" icon="fa-solid fa-bars" />
            </div>
        </div>

        <!-- "blurry background -->
        <transition name="mobileFileBrowserAppear">
            <div v-if="this.mobileButtonClicked" class="w-full transitionHeight" style="height: 95%; position: relative; background-color: rgba(57, 57, 57, 0.2);">
                <div class="transitionHeightResult" style="width: 75%; height: 95%; position: relative; background-color: rgb(21, 21, 21); margin: 0 auto;
border-radius: 10px; box-shadow: 2px 2px rgba(0,0,0,0.3), -2px 0 0 rgba(0,0,0,0.3)">
                    <div class="w-full h-full relative" style="overflow: auto">
                        <GithubRepoFolder @fileSelected="onFileClickedChild" :entireFile="folder" :allItems="this.selectedRepo" :key="folder.size" v-for="folder in this.startingFolders" :folderName="folder.name" :childItems="getChildItemsForStartingFolders(folder)">{{folder.name}}</GithubRepoFolder>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>

import GithubRepoFolder from "@/components/github/GithubRepoFolder.vue";
export default {
    name: "GithubMobileRepoFileBrowser",
    components: {GithubRepoFolder},
    data()
    {
        return {
            mobileButtonClicked: false,
            startingFolders: [],
        }
    },

    props: {
        selectedRepo : {
            type: Array,
            required: true
        }
    },

    mounted()
    {
        let temp = this.selectedRepo.filter((file) => !file.path.includes("/"));
        this.startingFolders = temp.sort((a, b) => {
            if (a.type === "dir") {
                return -1;
            }
            if (a.type !== "dir") {
                return 1;
            }
        });
    },
    methods:
        {
            onMobileButtonClicked()
            {
                this.mobileButtonClicked = !this.mobileButtonClicked;
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
                this.mobileButtonClicked = false;
                this.$emit('fileSelected', file);
            }
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
