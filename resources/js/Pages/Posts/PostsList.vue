<template>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('My posts') }}</h3>
                <div class="card-tools">
                    <inertia-link :href="route('posts.create')" class="btn btn-success btn-sm">{{ __('Create') }}</inertia-link>
                </div>
            </div>

            <div class="card-body" :class="{'p-0': posts.data.length > 0}">
                <table class="table" v-show="posts.data.length > 0">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Content') }}</th>
                            <th style="width: 40px">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(post, key) in posts.data" :key="key">
                            <td>{{ post.id }}</td>
                            <td>{{ post.title }}</td>
                            <td>{{ post.content }}</td>
                            <td><inertia-link :href="route('posts.edit', post)" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></inertia-link></td>
                        </tr>
                    </tbody>
                </table>
                <p class="text-center" v-show="posts.data.length == 0">{{ __('You have no posts to show.') }}</p>
            </div>
            <div class="card-footer clearfix" v-if="posts.links.length > 3">
                <pagination class="pagination-sm float-right" :links="posts.links" />
            </div>
        </div>
    </div>

</template>
<script>
    import Pagination from '@/Shared/Pagination'
    export default {
        components: {
            Pagination,
        },
        props: ['posts'],
}

</script>
