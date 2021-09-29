<template>
    <div id="admin_form_update_resource" uk-modal>
        <form id="form_update_resource" @submit="gotoUpdate" class="uk-modal-dialog">

            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title uk-margin-remove-bottom">Update a resource :</h2>
                <a class="uk-link-toggle"><span class="uk-text-warning uk-link-heading">{{ resource.title }}</span></a>
            </div>

            <div class="uk-modal-body">
                <div class="uk-margin">
                    <label>The tile of your resource</label>
                    <input id="txtTitle" class="uk-input" type="text" name="title" v-model="resource.title" placeholder="title of the resource" required>
                </div>

                <div class="uk-margin">
                    <label>Select your resource</label>
                    <select id="typeSelect" name="type" class="uk-select" @change="resource.type == this.value" v-model="resource.type" required>
                        <option value="pdf">pdf</option>
                        <option value="html">html</option>
                        <option value="link">link</option>
                    </select>
                </div>

                <div class="uk-margin" v-if="resource.type == 'pdf'">
                    <label>Upload your file</label>
                    <input id="txtpdf" class="uk-input" type="file" name="source">
                </div>

                <div class="uk-margin" v-if="resource.type == 'link'">
                    <label>Your url</label>
                    <input id="txturl" class="uk-input" type="url" name="url" v-model="resource.url" placeholder="insert your url here" autocomplete="off">
                </div>

                <div class="uk-margin" v-if="resource.type == 'html'">
                    <label>Html snippet</label>
                    <textarea id="txthtml" name="content_value" class="uk-textarea" rows="6"  v-model="resource.content" placeholder="insert your html code here"></textarea>
                </div>

            </div>

            <div class="uk-modal-footer uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                <button class="uk-button uk-button-primary" type="submit">Update resource</button>
            </div>
        </form>
    </div>
</template>

<script>
    const Swal = require('sweetalert2');
    export default {
        name: "form_update_resource",
        props: [
            'resource'
        ],

        methods: {
            gotoUpdate: function(e){
                e.preventDefault();

                Swal.fire({
                    title: 'Updating in progress',
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();

                        //Axios request to delete resource
                        axios.patch("/api/v1/entity/update/" + this.resource.id, {
                            title          : this.resource.title,
                            type           : this.resource.type,
                            url            : this.resource.url,
                            source         : this.resource.source,
                            content_value  : this.resource.content,
                        })
                            .then(function (response) {
                                Swal.fire({
                                    position: 'center',
                                    icon: response.data.type,
                                    title: response.data.message,
                                    showConfirmButton: false,
                                    timer: 2000,
                                    willClose: () => {
                                        $("#admin_form_update_resource .uk-modal-close").trigger('click');
                                    }
                                });
                            })
                            .catch(error => console.log(error));
                    }
                });
            },
        }
    }
</script>

<style scoped>

</style>