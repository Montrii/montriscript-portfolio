<template>
    <div class="relative h-full">
        <GithubRepoContent :repoName="repoName"></GithubRepoContent>
    </div>
</template>

<script>
import axios from "axios";
import GithubRepoContent from "@/components/github/repobrowser/GithubRepoContent.vue";
export default
{
    name: "MainPage.vue",

    data()
    {
        return {
            projects: [],
            repoName: "Borderlands1.Injector",
            browserInformation: {
                'browserInfo': {
                    'browserVersion':
                        {
                            'isBot': null,
                            'isFirefox': null,
                            'isChrome': null,
                            'isSafari': null,
                            'isIE': null,
                            'isInApp': null,
                            'isEdge': null,
                            'isOpera': null
                        },
                    'browserOS':
                        {
                            'isWindows': null,
                            'isMacOriOS': null,
                            'isLinux': null,
                            'isAndroid': null
                        }
                }
            }
        }
    },

    components: {
        GithubRepoContent,
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

        axios.get('/api/getBrowserInformation')
            .then((result) =>
            {
                this.browserInformation = result.data;
            })
            .catch(error =>
            {
                console.log(error);
            })
    }
}
</script>

<style scoped>





</style>
