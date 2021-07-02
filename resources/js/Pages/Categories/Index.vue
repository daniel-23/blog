<template>
    <app-layout>
        <template #header>
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ __('Categories') }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><inertia-link :href="route('dashboard')">{{ __('Dashboard') }}</inertia-link></li>
                                <li class="breadcrumb-item active">{{ __('Categories') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <categories-list :categories="categories" />
                    <create-form />
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import CreateForm from './CreateForm'
import CategoriesList from './CategoriesList'

export default {
    components: {
        AppLayout,
        CreateForm,
        CategoriesList,
    },
    props: ['categories']
}

</script>
