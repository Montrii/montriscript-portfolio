<template>
    <nav class="navbar navbar-default navbar-static-top" style="background-color: #111; border-color: #111; height: 5em">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">
                    <span>Montri</span>
                </a>
            </div>
            <div class="navbar">
                <ul class="nav navbar-nav navbar-right social">
                    <li>
                        <font-awesome-icon icon="fa-brands fa-twitter" />
                    </li>
                    <li>
                        <font-awesome-icon icon="fa-brands fa-linkedin" />
                    </li>
                    <li>
                        <font-awesome-icon icon="fa-brands fa-github" />
                    </li>
                    <li>
                        <font-awesome-icon icon="fab fa-itch-io" />
                    </li>
                    <li>
                        <font-awesome-icon icon="fa-brands fa-unity" />
                    </li>
                    <li>
                        <font-awesome-icon icon="fa-brands fa-discord" />
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="active">
                        <a href="#">
                            <font-awesome-icon icon="fa-brands fa-unity" />
                            <span> Home </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <font-awesome-icon icon="fa-brands fa-unity" />
                            <span> About </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <font-awesome-icon icon="fa-brands fa-unity" />
                            <span> Contact </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: "Headbar.vue"
}
</script>

<style scoped>

</style>
