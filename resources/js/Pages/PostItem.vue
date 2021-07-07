<template>
	<div class="row" v-if="posts.data.length">
		<div class="col-lg-6" v-for="(post, key) in posts.data" :key="key">
	        <div class="card">
	            <div class="card-header">
	                <h5 class="m-0">{{ post.title }} <small class="float-right">{{ post.created_at }}</small></h5>
	            </div>
	            <div class="card-body">
	                <p class="card-text">{{ post.content }}</p>
	                <p class="card-text text-right text-info">Author: {{ post.author }}</p>

	                <inertia-link class="btn btn-outline-primary" :href="route('posts.show',post)">{{ __('Read more') }}</inertia-link>
	                <inertia-link v-if="post.canEdit" class="btn btn-primary float-right" :href="route('posts.edit',post)"><i class="fas fa-pencil-alt"></i></inertia-link>
	                
	            </div>
	        </div>
	    </div>
	</div>
</template>

<script>
export default {
	props: ['posts'],
}

</script>
