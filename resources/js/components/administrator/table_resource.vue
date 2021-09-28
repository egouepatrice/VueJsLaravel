<template>
    <table class="uk-table uk-table-hover uk-table-divider uk-table-striped">
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
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="resource in resources.elements.data" :key="resource.id">
            <th>{{ resource.id }}</th>
            <th>{{ resource.title }}</th>
            <th><strong>{{ resource.type }}</strong></th>

            <th><a :href="resource.source" target="_blank">{{ resource.source ? 'click to download'  : 'NO DOCUMENT'  }}</a></th>
            <th><a :href="resource.url" target="_blank">{{ resource.url ? resource.url : 'NO URL' }}</a></th>
            <th><a href="#">{{ resource.content ? 'View code'  : 'NO HTML'  }}</a></th>

            <th>{{ resource.created_at }}</th>
            <th>{{ resource.updated_at }}</th>
            <th>
                <ul class="uk-iconnav">
                    <li><a href="#" class="uk-icon-button uk-margin-small-right uk-text-primary" uk-icon="icon: file-edit"></a></li>
                    <li><a href="#" class="uk-icon-button uk-margin-small-right uk-text-danger" uk-icon="icon: trash"></a></li>
                </ul>
            </th>
        </tr>
        </tbody>
    </table>
    <!--pagination :data="resources" @pagination-change-page="getResults()" class="mt-5"></pagination-->
</template>

<script>
    export default {
        name: "table_resource",
        data(){
            return {
                resources: {}
            }
        },
        created(){
            axios.get("/public/api/v1/entity/list")
                .then(response => (this.resources = response.data))
                .catch(error => console.log(error));
        },

        methods: {
            getResults(page = 1) {
                axios.get('/public/api/v1/entity/list?page=' + page)
                    .then(response => (this.resources = response.data));
            }
        },
    }
</script>

<style scoped>

</style>