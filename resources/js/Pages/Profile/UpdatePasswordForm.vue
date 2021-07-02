<template>
    <div class="col-12">
        <jet-form-section @submitted="updatePassword">
            <template #title>
                {{ __('Update Password') }}
            </template>

            <template #description>
                 &nbsp; {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </template>

            <template #form>

                <div class="form-group row">
                    <jet-label for="current_password" value="Current Password" class="col-sm-2 col-form-label" />
                    <div class="col-sm-10">
                        <jet-input id="current_password" type="password" :class="{ 'is-invalid': form.errors.current_password }" v-model="form.current_password" ref="current_password" autocomplete="current-password" />
                        <jet-input-error :message="form.errors.current_password" />
                    </div>
                </div>

                <div class="form-group row">
                    <jet-label for="password" value="New Password" class="col-sm-2 col-form-label" />
                    <div class="col-sm-10">
                        <jet-input id="password" type="password" :class="{ 'is-invalid': form.errors.password }" v-model="form.password" ref="password" autocomplete="new-password" />
                        <jet-input-error :message="form.errors.password" />
                    </div>
                </div>

                <div class="form-group row">
                    <jet-label for="password_confirmation" value="Confirm Password" class="col-sm-2 col-form-label" />
                    <div class="col-sm-10">
                        <jet-input id="password_confirmation" type="password" :class="{ 'is-invalid': form.errors.password_confirmation }" v-model="form.password_confirmation" autocomplete="new-password" />
                        <jet-input-error :message="form.errors.password_confirmation" class="mt-2" />
                    </div>
                </div>
            </template>

            <template #actions>
                <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                    {{ __('Saved.') }}
                </jet-action-message>

                <jet-button class="btn-primary float-right" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    {{ __('Save') }}
                </jet-button>
            </template>
        </jet-form-section>
    </div>
        
</template>

<script>
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'

    export default {
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
        },

        data() {
            return {
                form: this.$inertia.form({
                    current_password: '',
                    password: '',
                    password_confirmation: '',
                }),
            }
        },

        methods: {
            updatePassword() {
                this.form.put(route('user-password.update'), {
                    errorBag: 'updatePassword',
                    preserveScroll: true,
                    onSuccess: () => this.form.reset(),
                    onError: () => {
                        if (this.form.errors.password) {
                            this.form.reset('password', 'password_confirmation')
                            this.$refs.password.focus()
                        }

                        if (this.form.errors.current_password) {
                            this.form.reset('current_password')
                            this.$refs.current_password.focus()
                        }
                    }
                })
            },
        },
    }
</script>
