<template>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('My posts') }}</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <pre>{{ posts }}</pre>
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Content') }}</th>
                            <th style="width: 40px">Label</th>
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
            </div>
        </div>
    </div>

</template>
<script>
export default {
    
    props: ['posts'],
}

</script>
