<tr id="resource"{{ $resource.id }}>
    <th>{{ resource.id }}</th>
    <th>{{ resource.title }}</th>
    <th><strong>{{ resource.type }}</strong></th>

    <th><a :href="resource.source" target="_blank">{{ resource.source ? 'click to download'  : 'NO DOCUMENT'  }}</a></th>
    <th><a :href="resource.url" target="_blank">{{ resource.url ? resource.url : 'NO URL' }}</a></th>
    <th><a href="#">{{ resource.content ? 'View code'  : 'NO HTML'  }}</a></th>

    <th>{{ resource.created_at }}</th>
    <th>{{ resource.updated_at }}</th>
    <th>
        <ul class="uk-iconnav">
            <li><a class="uk-icon-button uk-margin-small-right uk-text-primary" uk-icon="icon: file-edit" @click="resource_update = resource" href="#admin_form_update_resource" uk-toggle></a></li>
            <li><a class="uk-icon-button uk-margin-small-right uk-text-danger" uk-icon="icon: trash" @click="deleteElement(resource.id)"></a></li>
        </ul>
    </th>
</tr>