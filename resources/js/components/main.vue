<template>
    <nav class="uk-navbar-container uk-margin" uk-navbar>
        <div class="uk-navbar-left">

            <a class="uk-navbar-item uk-logo" href="#">Test Assignment</a>

            <ul class="uk-navbar-nav">
                <li>
                    <router-link to="/" class="uk-icon uk-margin-small-right">ALL RESOURCES</router-link>
                </li>
            </ul>

            <div class="uk-navbar-item">
                <router-link to="/page?type=pdf">PDF DOWNLOAD</router-link>
            </div>

            <div class="uk-navbar-item">
                <router-link to="/page?type=html">HTML SNIPPET</router-link>
            </div>

            <div class="uk-navbar-item">
                <router-link to="/page?type=link">LINK</router-link>
            </div>

        </div>
    </nav>
</template>

<script>
    export default {
        name: "main_element"
    }
</script>

<style scoped>

</style>