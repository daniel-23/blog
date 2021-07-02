<template>
    <span>
        <span @click="startConfirmingPassword">
            <slot />
        </span>

        <jet-dialog-modal :show="confirmingPassword" @close="closeModal" :idModal="idModal">
            <template #title>
                {{ __(title) }}
            </template>

            <template #content>
                {{ __(content) }}

                <div class="form-group">
                    <jet-input type="password"
                               placeholder="Password"
                               :class="{ 'is-invalid': form.error }"
                               ref="password"
                               v-model="form.password"
                               @keyup.enter="confirmPassword" />

                    <jet-input-error :message="form.error" class="mt-2" />
                </div>
            </template>

            <template #footer>
                <jet-secondary-button @click="closeModal">
                    {{ __('Cancel') }}
                </jet-secondary-button>

                <jet-button class="btn-primary float-right" @click="confirmPassword" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    {{ __(button) }}
                </jet-button>
            </template>
        </jet-dialog-modal>
    </span>
</template>

<script>
    import JetButton from './Button'
    import JetDialogModal from './DialogModal'
    import JetInput from './Input'
    import JetInputError from './InputError'
    import JetSecondaryButton from './SecondaryButton'

    export default {
        emits: ['confirmed'],

        props: {
            title: {
                default: 'Confirm Password',
            },
            content: {
                default: 'For your security, please confirm your password to continue.',
            },
            button: {
                default: 'Confirm',
            },
            idModal: {
                default: 'modal-password-confirm'
            }
        },

        components: {
            JetButton,
            JetDialogModal,
            JetInput,
            JetInputError,
            JetSecondaryButton,
        },

        data() {
            return {
                confirmingPassword: false,
                form: {
                    password: '',
                    error: '',
                },
            }
        },

        methods: {
            startConfirmingPassword() {
                axios.get(route('password.confirmation')).then(response => {
                    if (response.data.confirmed) {
                        this.$emit('confirmed');
                    } else {
                        this.confirmingPassword = true;
                        $('#'+this.idModal).modal('show');

                        setTimeout(() => this.$refs.password.focus(), 250)
                    }
                })
            },

            confirmPassword() {
                this.form.processing = true;

                axios.post(route('password.confirm'), {
                    password: this.form.password,
                }).then(() => {
                    this.form.processing = false;
                    this.closeModal()
                    this.$nextTick(() => this.$emit('confirmed'));
                }).catch(error => {
                    this.form.processing = false;
                    this.form.error = error.response.data.errors.password[0];
                    this.$refs.password.focus()
                });
            },

            closeModal() {
                this.confirmingPassword = false
                this.form.password = '';
                this.form.error = '';
                $('#'+this.idModal).modal('hide');
            },
        }
    }
</script>
