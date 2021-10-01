<template>
    <div id="block_list_of_resources">
        <form_create_resource @resource_create_refresh_list="refresh_list"></form_create_resource>
        <table id="list_of_resources" class="uk-table uk-table-small uk-table-hover table-divider table-striped uk-margin-remove-bottom">
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
                <tr :id="'resource' + resource.id" v-for="resource in resources.data.data" :key="resource.id">
                    <th>{{ resource.id }}</th>
                    <th>{{ resource.title }}</th>
                    <th><strong>{{ resource.type }}</strong></th>
                    <th><a :href="'/' + resource.source" v-if="resource.source" target="_blank">{{ resource.source ? 'click to download'  : 'NO DOCUMENT'  }}</a></th>
                    <th><a :href="resource.url" :target="resource.target ? '_blank' : ''" v-if="resource.url">{{ resource.url ? resource.url : 'NO URL' }}</a></th>
                    <th><a href="#resource_view_html_code" uk-toggle v-if="resource.content" @click='resource_update = resource'>{{ resource.content != null ? 'View code'  : "NO HTML"  }}</a></th>
                    <th>{{ resource.created_at }}</th>
                    <th>{{ resource.updated_at }}</th>
                    <th>
                        <ul class="uk-iconnav">
                            <li><a class="uk-icon-button uk-margin-small-right uk-text-primary" uk-icon="icon: file-edit" @click="resource_update = resource" href="#admin_form_update_resource" uk-toggle></a></li>
                            <li><a class="uk-icon-button uk-margin-small-right uk-text-danger" uk-icon="icon: trash" @click="deleteElement(resource.id)"></a></li>
                        </ul>
                    </th>
                </tr>
            </tbody>
        </table>

        <view_code v-bind:resource="resource_update"></view_code>
        <form_update_resource v-bind:resource="resource_update" @resource_create_refresh_list="refresh_list"></form_update_resource>
        <pagination :data="resources.data" @pagination-change-page="getResults" class="mt-5 uk-align-right"></pagination>
    </div>
    
</template>

<script>
    import form_create_resource from './form_create_resource';
    import form_update_resource from "./form_update_resource";
    import pagination from "laravel-vue-pagination";
    import view_code from "../visitor/view_code_html";
    const Swal = require('sweetalert2');

    export default {
        name: "table_resource",
        components: {form_create_resource, form_update_resource, pagination, view_code},
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

            getResource(id_resource){
                axios.get('/api/v1/entity/list/' + id_resource)
                    .then(response => this.resource_update = response.data.data)
                    .catch(error => console.log(error));
            },

            refresh_list(resources){
                this.resources = resources;
            },

            deleteElement(idElement){
                //Confirm delete element
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to delete this resource ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        // Deleting element
                        Swal.fire({
                            title: 'Deleting in progress',
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                //Axios request to delete resource
                                axios.get('/api/v1/entity/delete/' + idElement)
                                    .then(function (response) {
                                        if(response.data.type == "success") $("#resource" + idElement).remove();
                                        Swal.fire({
                                            position: 'center',
                                            icon: response.data.type,
                                            title: response.data.message,
                                            showConfirmButton: false,
                                            timer: 1000
                                        });
                                    })
                                    .catch(error => console.log(error));;
                            }
                        });
                    }
                })
            }
        },
    }
</script>

<style scoped>

</style>
