<template>
    <div class="col-12 col-md-6">
        <jet-action-section>
            <template #title>
                Permissions
            </template>
            <template #description>
            </template>
            <template #content>
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(permission, key) in permissions" :key="key">
                            <td>{{ key + 1}}.</td>
                            <td>{{ permission.name }}</td>
                            <td>
                                <inertia-link :href="route('permissions.edit', permission)" class="btn btn-primary btn-sm">Edit</inertia-link>
                            </td>
                            
                        </tr>
                    </tbody>
                </table>
            </template>
        </jet-action-section>
    </div>
</template>
<script>
import JetActionSection from '@/Jetstream/ActionSection'
export default {
    components: {
        JetActionSection,

    },
    props: ['permissions']
}

</script>
