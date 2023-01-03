<template>
    <font-awesome-icon v-if="this.extension === 'html'" icon="fa-brands fa-html5"/>
    <font-awesome-icon v-else-if="this.extension === 'js' || this.extension === 'json'" style="color: #FFCA28" icon="fa-brands fa-js"/>
    <font-awesome-icon v-else-if="this.extension === 'css' || this.extension === 'scss'" icon="fa-brands fa-css3-alt"/>
    <font-awesome-icon v-else-if="this.extension === 'php'" style="color: #777BB3;" icon="fa-brands fa-php"/>
    <font-awesome-icon v-else-if="this.extension === 'py'" style="color: #3776AB;" icon="fa-brands fa-python"/>
    <font-awesome-icon v-else-if="this.extension === 'java'" style="color: #B07219;" icon="fa-brands fa-java"/>
    <font-awesome-icon v-else-if="this.extension === 'vue'" style="color: #41B883;" icon="fa-brands fa-vuejs"/>
    <font-awesome-icon v-else-if="this.extension === 'gitignore'" style="color: #E64A19" icon="fa-brands fa-git-alt" />
    <font-awesome-icon v-else-if="this.extension === 'txt'" style="color: white;" icon="fa-solid fa-file-lines" />
    <font-awesome-icon v-else-if="this.extension === 'ico' || this.extension === 'png' || this.extension === 'jpg' || this.extension === 'jpeg'" style="color: white;" icon="fa-solid fa-image" />
    <font-awesome-icon v-else-if="this.extension === 'ini' || this.extension === 'config' || this.extension === 'conf'"
                        icon="fa-solid fa-gear" />
    <font-awesome-icon v-else-if="this.extension === 'md'" style="color: #4078C0;" icon="fa-brands fa-markdown" />
    <font-awesome-icon v-else-if="this.extension === 'lua' || this.extension === 'luac'" style="color: #2C2D72;" icon="fa-solid fa-bowling-ball" />
    <font-awesome-icon v-else-if="this.extension === 'cpp' || this.extension === 'cs' || this.extension === 'csharp' || this.extension === 'c'"  icon="fa-solid fa-c" />
    <font-awesome-icon v-else icon="fa-regular fa-file-code"/>
</template>

<script>
export default {
    name: "GithubFileIcon",

    props:
        {
            extension: {
                type: String,
                required: true
            }
        }
}
</script>

<style scoped>

</style>
