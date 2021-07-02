<template>
    <span class="error invalid-feedback" v-show="message">{{ message }}</span>
</template>

<script>
    export default {
        props: ['message']
    }
</script>
