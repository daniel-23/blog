<template>
    <div class="col-12 col-md-6">
        <jet-action-section>
            <template #title>
                Roles
            </template>
            <template #description>
            </template>
            <template #content>
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(role, key) in roles" :key="key">
                            <td>{{ key + 1}}.</td>
                            <td>{{ role.name }}</td>
                            <td>{{ role.created_at }}</td>
                            <td>
                                <inertia-link :href="route('roles.edit', role)" class="btn btn-primary btn-sm">Edit</inertia-link>
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
    props: ['roles']
}

</script>
