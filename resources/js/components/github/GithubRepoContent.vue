<template>
    <div style="background-color: rgb(21, 21, 21); z-index: 1001" class="absolute h-full w-full top-0 left-0">
        <div v-if="!repoContent" class="relative h-full w-full loading-screen"
        >
            <hollow-dots-spinner
                :animation-duration="1500"
                :dot-size="15"
                :dots-num="3"
                color="grey"
                class="loadingscreen-dots"
            />
        </div>


        <!-- entire repo content --->
        <div v-else-if="repoContent" class="relative h-full w-full">
            <!-- mobile view --->
            <div v-if="!this.bigForFileBrowser" class="h-full w-full relative">
                <GithubMobileRepoFileBrowser @fileSelected="onFileClicked" :selectedRepo="repoContent"></GithubMobileRepoFileBrowser>
                <GithubMobileContentViewer v-if="selectedFile" :currentFile="selectedFile" @fileClosed="onFileClicked" style="z-index: 0; position: absolute; top: 0px; left: 0px;"></GithubMobileContentViewer>
            </div>


            <!-- normal view--->
            <div v-else-if="this.bigForFileBrowser" class="h-full w-full relative">
                <GithubRepoFileBrowser @fileSelected="onFileClicked" :selectedRepo="repoContent"></GithubRepoFileBrowser>
                <GithubRepoContentViewer v-if="selectedFile" :currentFile="selectedFile" @fileClosed="onFileClose"></GithubRepoContentViewer>
            </div>


        </div>


    </div>
</template>

<script>
import axios from "axios";
import GithubRepoFileBrowser from "@/components/github/GithubRepoFileBrowser.vue";
import GithubRepoContentViewer from "@/components/github/GithubRepoContentViewer.vue";
import {HollowDotsSpinner} from "epic-spinners";
import GithubMobileRepoFileBrowser from "@/components/github/repobrowser/mobile/GithubMobileRepoFileBrowser.vue";
import GithubMobileContentViewer from "@/components/github/repobrowser/mobile/GithubMobileContentViewer.vue";
export default {
    name: "GithubRepoContent",

    data()
    {
        return {
            repoContent: null,
            selectedFile: null,

            bigForFileBrowser: null,
        }
    },



    computed:
        {
            shouldDisplayMobileFileBrowser : function()
            {
                return this.bigForFileBrowser === null;
            }
        },
    components:
        {
            GithubMobileContentViewer,
            GithubMobileRepoFileBrowser,
            HollowDotsSpinner,
            GithubRepoFileBrowser,
            GithubRepoContentViewer,
        },

    props: {
        repoName: {
            type: String,
            required: true,
        }
    },
    mounted()
    {

// adjusted
        axios.get('/api/' + this.repoName  +  '/getRepositoryFiles').then(({data}) =>
        {
            this.repoContent = data.repositoryFiles;
        })


        this.bigForFileBrowser = window.innerWidth > 900;
        window.addEventListener('resize', () =>
        {
            this.bigForFileBrowser = window.innerWidth > 900;
        })

    },
    methods:
        {
            onFileClicked(file)
            {
                // update file if not same file passed
                if(this.selectedFile !== file && this.selectedFile !== null)
                {
                    // set to 0 to rerender component
                    this.selectedFile = null;

                    // after 10 ms set to new file
                    setTimeout(() =>
                    {
                        this.selectedFile = file;
                    }, 1);
                }
                else
                {
                    this.selectedFile = file;
                }

            },
            onFileClose()
            {
                this.selectedFile = null;
            }
        }
}
</script>

<style scoped>
.loadingscreen
{
    text-align:center;
    background-color: rgba(0, 0, 0, 0.5);
}

.loadingscreen-dots
{
    margin: 0 auto;
    top: 50%;
    position: relative;
}
</style>
