<template>
    <div id="admin_form_update_resource" uk-modal>
        <form id="form_update_resource" @submit="gotoUpdate" class="uk-modal-dialog" method="POST">

            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Update a resource : {{ title }}</h2>
            </div>

            <div class="uk-modal-body">
                <div class="uk-margin">
                    <label>The tile of your resource</label>
                    <input id="txtTitle" class="uk-input" type="text" name="title" v-model="title" placeholder="title of the resource" required>
                </div>

                <div class="uk-margin">
                    <label>Select your resource</label>
                    <select id="typeSelect" name="type" class="uk-select" @change="type = this.value" v-model="type" required>
                        <option value="pdf">pdf</option>
                        <option value="html">html</option>
                        <option value="url">link</option>
                    </select>
                </div>

                <div class="uk-margin" v-if="type == 'pdf'">
                    <label>Upload your file</label>
                    <input id="txtpdf" class="uk-input" type="file" name="source">
                </div>

                <div class="uk-margin" v-if="type == 'url'">
                    <label>Your url</label>
                    <input id="txturl" class="uk-input" type="url" name="url" v-model="url" placeholder="insert your url here" autocomplete="off">
                </div>

                <div class="uk-margin" v-if="type == 'html'">
                    <label>Html snippet</label>
                    <textarea id="txthtml" name="content_value" class="uk-textarea" rows="6"  v-model="content" placeholder="insert your html code here"></textarea>
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
    export default {
        name: "form_update_resource",
        props: [
            'id',
            'title',
            'type',
            'url',
            'content'
        ],

        data(){
            source: null

            return {
                source : ''
            }
        },

        methods: {
            gotoUpdate: function(e){
                e.preventDefault();
                axios.patch("/api/v1/entity/update/" + this.id, {
                    title          : this.title,
                    type           : this.type,
                    url            : this.url,
                    source         : this.source,
                    content_value  : this.content_value,
                })
                    .then(function (response) {
                        if(response.data.type == 'success'){
                            
                        }

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