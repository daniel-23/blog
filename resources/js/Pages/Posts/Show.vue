<template>
    <app-layout>
        <template #header>
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ __('Post') }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><inertia-link :href="route('dashboard')">{{ __('Dashboard') }}</inertia-link></li>
                                <li class="breadcrumb-item active">{{ __('Posts') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">{{ post.title }}</h2>
                            </div>
                            <div class="card-body" v-html="post.content"></div>
                            <div class="card-footer" v-if="canEdit">
                                <inertia-link class="btn btn-primary float-right" :href="route('posts.edit',post)"><i class="fas fa-pencil-alt"></i></inertia-link>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    components: {
        AppLayout,
    },
    props: ['post', 'canEdit'],
}

</script>
