<template>
    <div>
        Welcome to your backend.
        <div class="uk-section uk-padding-remove">
            <h3>
                Manage your resources <br>
                Create, Update or Delete resources
            </h3>
            <div class="uk-grid-match uk-child-width-1-1@m" uk-grid>
                <div>
                    <nav class="uk-navbar-container uk-margin uk-padding-small" uk-navbar>
                        <div class="uk-navbar-left">

                            <ul class="uk-navbar-nav">
                                <li>
                                    <button class="uk-button uk-button-primary uk-text-bold" href="#admin_form_create_resource" uk-toggle>
                                        Create a resource (pdf download, html snippet and link)
                                    </button>
                                </li>
                            </ul>

                        </div>
                    </nav>
                </div>

                <div>
                    <table_resource></table_resource>
                </div>
            </div>
        </div>

        <!-- Add actions -->
        <form_create_resource></form_create_resource>
        <form_update_resource></form_update_resource>
    </div>
</template>

<script>
    import table_resource from '../inc/table_resource';
    import form_create_resource from '../administrator/form_create_resource';
    import form_update_resource from '../administrator/form_update_resource';

    export default {
        name: "index",
        components: {table_resource, form_create_resource, form_update_resource},
    }
</script>

<style scoped>

</style>