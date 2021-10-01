<template>
    <div id="block_list_of_resources">
        <table id="list_of_resources" class="uk-table uk-table-small uk-table-hover uk-table-divider uk-table-striped uk-margin-remove-bottom">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Type</th>
                <th>Download</th>
                <th>Url</th>
                <th>Html</th>
                <th>Created at</th>
                <th>Updated at</th>
            </tr>
            </thead>
            <tbody>
            <tr :id="'resource' + resource.id" v-for="resource in resources.data.data" :key="resource.id">
                <th>{{ resource.id }}</th>
                <th>{{ resource.title }}</th>
                <th><strong>{{ resource.type }}</strong></th>
                <th><a :href="'/' + resource.source" v-if="resource.source" target="_blank">{{ resource.source ? 'click to download'  : 'NO DOCUMENT'  }}</a></th>
                <th><a :href="resource.url" :target="resource.target ? '_blank' : ''" v-if="resource.url" v-else="">{{ resource.url ? resource.url : 'NO URL' }}</a></th>
                <th><a href="#resource_view_html_code" uk-toggle v-if="resource.content" @click='resource_update = resource' v-else="">{{ resource.content != null ? 'View code'  : "NO HTML"  }}</a></th>
                <th>{{ resource.created_at }}</th>
                <th>{{ resource.updated_at }}</th>
            </tr>
            </tbody>
        </table>

        <view_code v-bind:resource="resource_update"></view_code>
        <pagination :data="resources.data" @pagination-change-page="getResults" class="mt-5 uk-align-right"></pagination>
    </div>
    
</template>

<script>
    import pagination from "laravel-vue-pagination";
    import view_code from "./view_code_html";
    const Swal = require('sweetalert2');

    export default {
        name: "table_resource",
        components: {pagination, view_code},
        data(){
            return {
                resources: { 'data': {}},
                resource_update: {
                    title: '',
                    type: '',
                    url: '',
                    content: '',
                }
            }
        },
        created(){
            axios.get("/api/v1/entity/list")
                .then(response => (this.resources = response.data))
                .catch(error => console.log(error));
        },

        methods: {
            getResults(page = 1) {
                axios.get('/api/v1/entity/list?page=' + page)
                    .then(response => (this.resources = response.data))
                    .catch(error => console.log(error));
            },
        },
    }
</script>

<style scoped>
</style>