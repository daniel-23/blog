<template>
    <jet-authentication-card>
        <template #logo>
            <jet-authentication-card-logo />
        </template>

        <div class="card">
            <div class="card-body login-card-body">
                <jet-validation-errors  />

                <div class="mb-4 text-sm">
                    <template v-if="! recovery">
                        {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
                    </template>

                    <template v-else>
                        {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
                    </template>
                </div>

                

                <form @submit.prevent="submit">
                    <div v-if="! recovery">
                        <jet-label for="code" value="Code" />
                        <jet-input ref="code" id="code" type="text" inputmode="numeric" v-model="form.code" autofocus autocomplete="one-time-code" />
                    </div>

                    <div v-else>
                        <jet-label for="recovery_code" value="Recovery Code" />
                        <jet-input ref="recovery_code" id="recovery_code" type="text" v-model="form.recovery_code" autocomplete="one-time-code" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="button" class="btn btn-outline-dark mb-2 btn-block" @click.prevent="toggleRecovery">
                            <template v-if="! recovery">
                                {{ __('Use a recovery code') }}
                            </template>

                            <template v-else>
                                {{ __('Use an authentication code') }}
                            </template>
                        </button>

                        <jet-button class="btn-primary btn-block" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            {{ __('Log in') }}
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
            JetValidationErrors,
        },

        data() {
            return {
                recovery: false,
                form: this.$inertia.form({
                    code: '',
                    recovery_code: '',
                })
            }
        },

        methods: {
            toggleRecovery() {
                this.recovery ^= true

                this.$nextTick(() => {
                    if (this.recovery) {
                        this.$refs.recovery_code.focus()
                        this.form.code = '';
                    } else {
                        this.$refs.code.focus()
                        this.form.recovery_code = ''
                    }
                })
            },

            submit() {
                this.form.post(this.route('two-factor.login'))
            }
        }
    }
</script>
