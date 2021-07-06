<template>
    <app-layout>
        <template #header>
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ __('Dashboard') }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">{{ __('Dashboard')}}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6" v-for="(post, key) in posts.data" :key="key">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="m-0">{{ post.title }}</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ post.content }}</p>
                                <inertia-link class="btn btn-outline-primary" :href="route('posts.show',post)">{{ __('Read more') }}</inertia-link>
                                <inertia-link v-if="post.canEdit" class="btn btn-primary float-right" :href="route('posts.show',post)"><i class="fas fa-pencil-alt"></i></inertia-link>
                                
                            </div>
                        </div>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col-12">
                        <pagination class="float-right" :links="posts.links" />
                    </div>
                    
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import Pagination from '@/Shared/Pagination'
import Welcome from '@/Jetstream/Welcome'

export default {
    components: {
        AppLayout,
        Pagination,
        Welcome,
    },
    props: ['posts']
}

</script>
