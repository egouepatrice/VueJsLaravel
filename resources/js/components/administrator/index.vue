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

    </div>
</template>

<script>
    import table_resource from './table_resource';

    export default {
        name: "index",
        components: {table_resource},
    }
</script>

<style scoped>

</style>