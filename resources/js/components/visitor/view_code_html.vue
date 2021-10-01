<template>
    <div id="resource_view_html_code" uk-modal>
        <div class="uk-modal-dialog">

            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">View html code resource</h2>
            </div>

            <div class="uk-modal-body">
                <div class="uk-margin">
                    <h5 class="uk-heading-divider">title</h5>
                    <label>{{ resource.title }}</label>
                </div>

                <div class="uk-margin">
                    <h5 class="uk-heading-divider">Description resource</h5>
                    <p>{{ resource.description }}</p>

                    <hr class="uk-margin-medium-top">
                    <label>Html code</label>
                    <textarea id="txthtml" v-model="resource.content" class="uk-textarea" rows="7" placeholder="insert your html code here" readonly disabled></textarea>


                    <a class="uk-link-toggle uk-align-right uk-text-bold mt-2" v-clipboard:copy="resource.content" v-clipboard:success="onCopy" v-clipboard:error="onError">
                        <h5>
                            <span class="uk-link-heading"> Copy to clipboard</span>
                        </h5>
                    </a>
                </div>

            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "view_code_html",
        props: [
            'resource'
        ],

        methods : {
            onCopy: function (e) {
                UIkit.notification("<span uk-icon='icon: check'></span> copied", {stauts:'success'});
            },

            onError: function (e) {
                UIkit.notification("<span uk-icon='icon: error'></span> Failed to copy the text to the clipboard");
                console.log(e);
            }
        }
    }
</script>

<style scoped>

</style>