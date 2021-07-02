<template>
    <div class="col-12 col-md-6">
        <jet-action-section>
            <template #title>
                {{ __('Categories') }}
            </template>
            <template #description>
            </template>
            <template #content>
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Description') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(category, key) in categories" :key="key">
                            <td>{{ key + 1}}.</td>
                            <td>{{ category.name }}</td>
                            <td>{{ category.description }}</td>
                            <td>
                                <inertia-link :href="route('categories.edit', category)" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></inertia-link>
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
    props: ['categories']
}

</script>
