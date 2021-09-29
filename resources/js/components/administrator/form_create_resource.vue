<template>
    <div id="admin_form_create_resource" uk-modal>
        <form id="form_create_resource" @submit="gotoSuccess" class="uk-modal-dialog" method="POST">

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
                    <select id="typeSelect" name="type" class="uk-select" @change="type = this.value" v-model="type" required>
                        <option value="pdf">pdf</option>
                        <option value="html">html</option>
                        <option value="url">link</option>
                    </select>
                </div>

                <div class="uk-margin" v-if="type=='pdf'">
                    <label>Upload your file</label>
                    <input id="txtpdf" class="uk-input" type="file" name="source" v-if="type=='pdf' ? 'required' : ''">
                </div>

                <div class="uk-margin" v-if="type=='url'">
                    <label>Your url</label>
                    <input id="txturl" v-model="url" class="uk-input" type="url" name="url" placeholder="insert your url here" v-if="type=='url' ? 'required' : ''" autocomplete="off">
                </div>

                <div class="uk-margin" v-if="type=='html'">
                    <label>Html snippet</label>
                    <textarea id="txthtml" v-model="content_value" name="content_value" class="uk-textarea" rows="6" placeholder="insert your html code here" v-if="type=='html' ? 'required' : ''"></textarea>
                </div>

            </div>

            <div class="uk-modal-footer uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                <button class="uk-button uk-button-primary" type="submit">Save resource</button>
            </div>
        </form>
    </div>
</template>

<script>
    const Swal = require('sweetalert2');
    export default {
        name: "form_create_resource",
        data(){
            type: null;
            title: null;
            content_value: null;
            url: null;
            source: null;

            return {
                type: 'pdf',
                title: '',
                content_value: '',
                url: '',
                source: ''
            }
        },

        methods: {

           gotoSuccess: function(e){
               e.preventDefault();
               axios.post("/api/v1/entity/create", {
                   title          : this.title,
                   type           : this.type,
                   url            : this.url,
                   source         : this.source,
                   content_value  : this.content_value,
               })
                   .then(function (response) {
                       Swal.fire({
                           position: 'center',
                           icon: response.data.type,
                           title: response.data.message,
                           showConfirmButton: false,
                           timer: 2000,
                           willClose: () => {
                               $("#admin_form_create_resource .uk-modal-close").trigger('click');
                           }
                       });
                   })
                   .catch();
           }
        }
    }
</script>

<style scoped>

</style>