<template>
    <jet-authentication-card>
        <template #logo>
            <jet-authentication-card-logo />
        </template>


        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">{{ __('Log in') }}</p>
                <jet-validation-errors />

                <div v-if="status" class="alert alert-success">
                    {{ status }}
                </div>
                
                <form @submit.prevent="submit">
                    <div class="input-group mb-3">                        
                        <jet-input id="email" type="email" v-model="form.email" required autofocus :placeholder="__('Email')" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <jet-input id="password" type="password" v-model="form.password" required autocomplete="current-password" :placeholder="__('Password')" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <div class="icheck-primary">
                                <jet-checkbox id="remember" name="remember" v-model:checked="form.remember" />
                                <label for="remember" class="text-sm">
                                    {{ __('Remember me') }}
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-5">
                            <jet-button class="btn-primary btn-block" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                {{ __('Log in') }}
                            </jet-button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <!--div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div-->
                <!-- /.social-auth-links -->
                <p class="mb-1">
                    <inertia-link v-if="canResetPassword" :href="route('password.request')">
                        {{ __('Forgot your password?') }}
                    </inertia-link>
                </p>
                <p class="mb-0">
                    <inertia-link :href="route('register')" class="text-center">
                        {{ __('Register') }}
                    </inertia-link>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </jet-authentication-card>
</template>

<script>
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetCheckbox from '@/Jetstream/Checkbox'
    import JetLabel from '@/Jetstream/Label'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'

    export default {
        components: {
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors
        },

        props: {
            canResetPassword: Boolean,
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                })
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    }
</script>
