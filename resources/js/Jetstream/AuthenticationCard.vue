<template>
    <div class="login-box">
        <slot name="logo" />
        <slot />
    </div>
</template>
<script>
    export default {
        mounted(){
            $('body').attr('class','hold-transition login-page');
        },
    }
</script>