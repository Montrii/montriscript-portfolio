<template>
    <div style="background-color: rgb(21, 21, 21); z-index: 1001" class="absolute h-full w-full top-0 left-0">
        <div v-if="!repoContent" class="relative h-full w-full" style="text-align:center;background-color: rgba(0, 0, 0, 0.5)"
        >
            <hollow-dots-spinner
                :animation-duration="1500"
                :dot-size="15"
                :dots-num="3"
                color="grey"
                style="margin: 0 auto;
top: 50%;
position: relative"
            />
        </div>


        <!-- entire repo content --->
        <div v-else-if="repoContent" class="relative h-full w-full">
            <!-- files container --->
            <GithubRepoFileBrowser @fileSelected="onFileClicked" :selectedRepo="repoContent"></GithubRepoFileBrowser>

            <!-- file content container --->
            <GithubRepoContentViewer v-if="selectedFile" :currentFile="selectedFile" @fileClosed="onFileClose"></GithubRepoContentViewer>
        </div>


    </div>
</template>

<script>
import axios from "axios";
import GithubRepoFileBrowser from "@/components/github/GithubRepoFileBrowser.vue";
import GithubRepoContentViewer from "@/components/github/GithubRepoContentViewer.vue";
import {HollowDotsSpinner} from "epic-spinners";
export default {
    name: "GithubRepoContent",


    data()
    {
        return {
            repoContent: null,
            selectedFile: null,
        }
    },


    components:
        {
            HollowDotsSpinner,
            GithubRepoFileBrowser,
            GithubRepoContentViewer
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

</style>
