<template>
    <div id="block_welcome">
        Welcome
        <div class="uk-section uk-padding-remove">
            <h3>List of all resources create</h3>
            <div class="uk-grid-match uk-child-width-1-1@m" uk-grid>
                <div>
                    <table_resource></table_resource>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import table_resource from './visitor/table_resource';
    export default {
        name: "home",
        components: {table_resource}
    }
</script>

<style scoped>

</style>