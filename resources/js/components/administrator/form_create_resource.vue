<template>
    <div>
        <button class="uk-button uk-button-primary uk-text-bold" href="#admin_form_create_resource" uk-toggle>
            Create a resource (pdf download, html snippet and link)
        </button>

        <div id="admin_form_create_resource" uk-modal>
            <form id="form_create_resource" @submit="gotoSuccess" class="uk-modal-dialog" enctype="multipart/form-data">

                <button class="uk-modal-close-default" type="button" uk-close></button>
                <div class="uk-modal-header">
                    <h2 class="uk-modal-title">Create a new resource</h2>
                </div>

                <div class="uk-modal-body">
                    <div class="uk-margin">
                        <label>The tile of your resource</label>
                        <input id="txtTitle" class="uk-input" type="text" name="title" v-model="title" placeholder="title of the resource" autocomplete="off" required>
                    </div>

                    <div class="uk-margin">
                        <label>Select your resource</label>
                        <select id="typeSelect" name="type" class="uk-select" v-on:change="updateType" v-model="type" required>
                            <option value="pdf">pdf</option>
                            <option value="html">html</option>
                            <option value="link">link</option>
                        </select>
                    </div>

                    <div class="uk-margin" v-if="type=='pdf'">
                        <label>Upload your file</label>
                        <input id="txtpdf" class="uk-input" type="file" name="source" v-on:change="onFileChange" accept="application/pdf">
                    </div>

                    <div class="uk-grid-small" uk-grid v-if="type=='link'">
                        <div class="uk-width-1-1">
                            <label>Your url</label>
                            <input id="txturl" v-model="url" class="uk-input" type="url" name="url" placeholder="insert your link here" autocomplete="off">
                        </div>

                        <div class="uk-width-1-1">
                            <label>Redirect to new windown frame ? </label>
                            <input id="txttarget" v-model="target" class="uk-checkbox" type="checkbox" name="target">
                        </div>
                    </div>

                    <div class="uk-grid-small" uk-grid v-if="type == 'html'">
                        <div class="uk-width-1-1">
                            <label>Html description</label>
                            <textarea id="txthtmldesc" v-model="description" name="description" class="uk-textarea" rows="2" placeholder="insert your html description here"></textarea>
                        </div>

                        <div class="uk-width-1-1">
                            <label>Html snippet</label>
                            <textarea id="txthtml" v-model="content_value" name="content_value" class="uk-textarea" rows="7" placeholder="insert your html code here"></textarea>
                        </div>
                    </div>

                </div>

                <div class="uk-modal-footer uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                    <button class="uk-button uk-button-primary" type="submit">Save resource</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    const Swal = require('sweetalert2');
    export default {
        name: "form_create_resource",
        data(){

            type: 'pdf';
            title: '';
            content_value: '';
            url: '';
            source: '';
            description: '';
            target: '';

            return {
                type: 'pdf',
                title: '',
                description: '',
                content_value: '',
                source: '',
                url: '',
                target: '',
            }
        },

        methods: {
            onFileChange(e){
                this.file = e.target.files[0];
            },

           gotoSuccess: function(e){
               e.preventDefault();
               let currentObj = this;
               const config = {
                   headers: { 'content-type': 'multipart/form-data' }
               };

               let formData = new FormData();
               formData.append('type', this.type);
               formData.append('title', this.title);
               formData.append('description', this.description);
               formData.append('content_value', this.content_value);
               formData.append('source', this.source);
               formData.append('url', this.url);
               formData.append('target', this.target);
               formData.append('file', this.file);

               axios.post("/api/v1/entity/create", formData, config)
                   .then(response => this.$emit('resource_create_refresh_list', response.data))
                   .catch(error => console.log(error));

               /*
               Swal.fire({
                   title: 'Creating resource',
                   timerProgressBar: true,
                   didOpen: () => {
                       Swal.showLoading();

                   }
               });
               */
           },

            updateType(){
               this.type = $("#typeSelect").val();
            }
        }
    }
</script>

<style scoped>

</style>