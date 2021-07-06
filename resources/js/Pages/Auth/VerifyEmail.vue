<template>
    <jet-authentication-card>
        <template #logo>
            <jet-authentication-card-logo />
        </template>
        <div class="card">
            <div class="card-body login-card-body">

                <div class="alert alert-info" role="alert">
                    {{ __("Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.") }}
                </div>

                <div class="alert alert-success" v-show="verificationLinkSent" >
                    {{ __("A new verification link has been sent to the email address you provided during registration.") }}
                </div>

                <form @submit.prevent="submit">
                    <div class="mt-4 flex items-center justify-between">
                        <jet-button class="btn-primary btn-block" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            {{ __('Resend Verification Email') }}
                        </jet-button>

                        <inertia-link :href="route('logout')" method="post" as="button" class="btn btn-danger btn-block mt-2">{{ __('Log Out') }}</inertia-link>
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

    export default {
        components: {
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
        },

        props: {
            status: String
        },

        data() {
            return {
                form: this.$inertia.form()
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('verification.send'))
            },
        },

        computed: {
            verificationLinkSent() {
                return this.status === 'verification-link-sent';
            }
        }
    }
</script>
