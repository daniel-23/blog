<template>
    <div class="alert alert-danger text-sm" v-if="hasErrors">
        <h6><i class="icon fas fa-ban"></i> {{ __('Whoops! Something went wrong.') }}</h6>
        <ul>
            <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        computed: {
            errors() {
                return this.$page.props.errors
            },

            hasErrors() {
                return Object.keys(this.errors).length > 0;
            },
        }
    }
</script>
