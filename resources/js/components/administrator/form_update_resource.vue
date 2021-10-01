<template>
    <div id="admin_form_update_resource" uk-modal>
        <form id="form_update_resource" @submit="gotoUpdate" class="uk-modal-dialog" enctype="multipart/form-data">

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
                    <select id="typeSelect" name="type" class="uk-select" v-on:change="updateType" v-model="resource.type" required>
                        <option value="pdf">pdf</option>
                        <option value="html">html</option>
                        <option value="link">link</option>
                    </select>
                </div>

                <div class="uk-margin" v-if="resource.type == 'pdf'">
                    <label>Upload your file</label>
                    <input id="txtpdf" class="uk-input" type="file" name="source" v-on:change="onFileChange" accept="application/pdf">
                </div>

                <div class="uk-grid-small" uk-grid v-if="resource.type=='link'">
                    <div class="uk-width-1-1">
                        <label>Your url</label>
                        <input id="txturl" v-model="resource.url" class="uk-input" type="url" name="url" placeholder="insert your link here" autocomplete="off">
                    </div>

                    <div class="uk-width-1-1">
                        <label>Redirect to new windown frame ? </label>
                        <input id="txttarget" v-model="resource.target" class="uk-checkbox" type="checkbox" name="target">
                    </div>
                </div>

                <div class="uk-grid-small" uk-grid v-if="resource.type == 'html'">
                    <div class="uk-width-1-1">
                        <label>Html description</label>
                        <textarea id="txthtmldesc" v-model="resource.description" name="description" class="uk-textarea" rows="2" placeholder="insert your html description here"></textarea>
                    </div>

                    <div class="uk-width-1-1">
                        <label>Html snippet</label>
                        <textarea id="txthtml" v-model="resource.content" name="content_value" class="uk-textarea" rows="7" placeholder="insert your html code here"></textarea>
                    </div>
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
            onFileChange(e){
                console.log(e.target.files[0]);
                this.file = e.target.files[0];
            },

            gotoUpdate: function(e){
                e.preventDefault();

                let currentObj = this;
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                };

                let formData = new FormData();
                formData.append('type', this.resource.type);
                formData.append('title', this.resource.title);
                formData.append('description', this.resource.description);
                formData.append('content_value', this.resource.content);
                formData.append('source', this.resource.source);
                formData.append('url', this.resource.url);
                formData.append('target', this.resource.target);
                formData.append('file', this.file);

                Swal.fire({
                    title: 'Updating in progress',
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();

                        //Axios request to delete resource
                        axios.post("/api/v1/entity/update/" + this.resource.id, formData, config)
                            .then(function (response) {
                                Swal.fire({
                                    position: 'center',
                                    icon: response.data.type,
                                    title: response.data.message,
                                    showConfirmButton: true,
                                    //timer: 2000,
                                    willClose: () => {
                                        $("#admin_form_update_resource .uk-modal-close").trigger('click');
                                    }
                                });
                            })
                            .catch(error => console.log(error));
                    }
                });
            },

            updateType(){
                this.type = $("#typeSelect").val();
            }
        }
    }
</script>

<style scoped>

</style>