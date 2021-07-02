<template>
    <app-layout>
        <template #header>
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Permissions</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Starter Page</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <permissions-list :permissions="permissions" />
                    <edit-form :permission="permission" />
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import EditForm from './EditForm'
import PermissionsList from './PermissionsList'

export default {
    components: {
        AppLayout,
        EditForm,
        PermissionsList,
    },
    props: ['permissions', 'permission']
}

</script>
