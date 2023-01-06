<template>
    <div class="relative h-full">
        <Headbar></Headbar>
        <Introduction></Introduction>
        <AboutMe></AboutMe>
        <Footer></Footer>
    </div>
</template>

<script>
import axios from "axios";
import GithubRepoContent from "@/components/github/repobrowser/GithubRepoContent.vue";
import Footer from "@/components/footer/Footer.vue";
import Headbar from "@/components/header/Headbar.vue";
import Introduction from "@/components/Introduction.vue";
import AboutMe from "@/components/AboutMe.vue";
export default
{
    name: "MainPage.vue",

    data()
    {
        return {
            projects: [],
            repoName: "montriscript-portfolio",
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
        Introduction,
        Headbar,
        Footer,
        AboutMe
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
