<template>
    <div class="uk-section uk-padding-remove">
        <h3>List resources  : {{ title_page }}</h3>
        <div class="uk-grid-match uk-child-width-1-1@m" uk-grid>
            <div>
                <table_resource></table_resource>
            </div>
        </div>
    </div>
</template>

<script>
    import table_resource from '../administrator/table_resource';
    export default {
        name: "page",
        components: {table_resource},
        data(){
            return {
                title_page: "PDF",
            }
        },
        created(){

        },
    }
</script>

<style scoped>

</style>