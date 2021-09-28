<template>
    <table class="uk-table uk-table-hover uk-table-divider uk-table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Type</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="resource in resources.elements.data" :key="resource.id">
            <th>{{ resource.id }}</th>
            <th>{{ resource.title }}</th>
            <th>{{ resource.type }}</th>
            <th>{{ resource.created_at }}</th>
            <th>{{ resource.updated_at }}</th>
            <th>
                <ul class="uk-iconnav">
                    <li><a href="#" uk-icon="icon: plus"></a></li>
                    <li><a href="#" uk-icon="icon: file-edit"></a></li>
                    <li><a href="#" uk-icon="icon: copy"></a></li>
                    <li><a href="#"><span uk-icon="icon: bag"></span></a></li>
                </ul>
            </th>
        </tr>
        </tbody>
    </table>
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
    }
</script>

<style scoped>

</style>