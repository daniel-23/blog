<template>
	<div class="login-box">
		<div class="login-logo">
			<a href="../../index2.html"><b>Admin</b>LTE</a>
		</div>
		<slot></slot>
	</div>
</template>
<script>
    export default {
        mounted(){
            $('body').attr('class','hold-transition login-page');
        },
    }
</script>