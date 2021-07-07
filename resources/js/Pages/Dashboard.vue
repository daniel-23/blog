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
                    <div class="col-12 col-md-3 offset-md-9">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" v-model="form.search" :placeholder="__('Search')">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <post-item :posts="posts" />
                
                <div class="row" v-show="posts.data.length">
                    <div class="col-12 mb-3">
                        <pagination class="float-right" :links="posts.links" />
                    </div>
                    
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import pickBy from 'lodash/pickBy'
import PostItem from '@/Pages/PostItem'
import throttle from 'lodash/throttle'



export default {
    components: {
        AppLayout,
        Pagination,
        PostItem,
    },
    props: ['posts', 'filters'],
    data() {
        return {
            form: {
                search: this.filters.search,
            },
        }
    },

    watch: {
        form: {
            deep: true,
            handler: throttle(function() {
                this.$inertia.get(this.route('dashboard'), pickBy(this.form), { preserveState: true })
            }, 150),
        },
    },


}

</script>
