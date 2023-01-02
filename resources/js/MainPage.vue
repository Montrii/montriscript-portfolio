<template>
    <div class="relative h-full">
        <Headbar></Headbar>
        <GithubRepoContent :repoName="repoName"></GithubRepoContent>
    </div>
</template>

<script>
import Headbar from "@/components/header/Headbar.vue";
import axios from "axios";
import GithubRepoContent from "@/components/github/GithubRepoContent.vue";
export default
{
    name: "MainPage.vue",

    data()
    {
        return {
            projects: [],
            repoName: "Borderlands1.Injector",
        }
    },

    components: {
        GithubRepoContent,
        Headbar,
    },


    mounted()
    {

        // axios.get('/api/SAMP-Luasole/getRepositoryFiles').then((response) =>
        // {
        //     console.log(response);
        // })
        // setInterval(() => {
        //     axios.get('/api/refreshProjectData')
        //         .then(response => {
        //             console.log(response);
        //             let tempProjects = [];
        //             response.data.projects.forEach(project =>
        //             {
        //                 tempProjects.push(project);
        //             });
        //             this.projects = tempProjects;
        //         })
        //         .catch(error => {
        //             console.log(error);
        //         });
        // }, 2000);

        // axios.get('/api/loadGithubRepositories')
        //     .then(({data}) => {
        //         console.log(data);
        //     })
        //     .catch(error => {
        //         console.log(error);
        //     });
    }
}
</script>

<style scoped>





</style>
