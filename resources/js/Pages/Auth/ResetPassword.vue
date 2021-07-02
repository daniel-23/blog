<template>
    <jet-authentication-card>
        <template #logo>
            <jet-authentication-card-logo />
        </template>

        <div class="card">
            <div class="card-body login-card-body">

                <jet-validation-errors class="mb-4" />

                <form @submit.prevent="submit">
                    <div class="form-group">
                        <jet-label for="email" value="Email" />
                        <jet-input id="email" type="email" v-model="form.email" required readonly />
                    </div>

                    <div class="form-group">
                        <jet-label for="password" value="Password" />
                        <jet-input id="password" type="password" v-model="form.password" required autofocus autocomplete="new-password" />
                    </div>

                    <div class="form-group">
                        <jet-label for="password_confirmation" value="Confirm Password" />
                        <jet-input id="password_confirmation" type="password" v-model="form.password_confirmation" required autocomplete="new-password" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <jet-button class="btn-primary btn-block" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            {{ __('Reset Password') }}
                        </jet-button>
                    </div>
                </form>
            </div>
        </div>
    </jet-authentication-card>
</template>

<script>
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetLabel from '@/Jetstream/Label'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'

    export default {
        components: {
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetLabel,
            JetValidationErrors
        },

        props: {
            email: String,
            token: String,
        },

        data() {
            return {
                form: this.$inertia.form({
                    token: this.token,
                    email: this.email,
                    password: '',
                    password_confirmation: '',
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('password.update'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    }
</script>
