<template>
    <div class="col-12 col-md-6">
        <jet-form-section @submitted="createRole">
            <template #title>
                Create Role
            </template>

            <template #form>
                <!-- Name -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <jet-input id="name" type="text" :class="{ 'is-invalid' : form.errors.name}" v-model="form.name" autocomplete="name" />
                    <jet-input-error :message="form.errors.name" />
                </div>
                <table class="table table-bordered table-sm">
                    <tr>
                        <th></th>
                        <th>Permissions</th>
                    </tr>
                    <tr v-for="(permission, key) in permissions" :key="key">
                        <td>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" :id="`check-${key}`" :value="permission.id" v-model="form.permissions">
                            </div>
                        </td>
                        <td>
                            <label class="form-check-label" :for="`check-${key}`">{{ permission.name }}</label>
                        </td>
                    </tr>
                </table>
            </template>

            <template #actions>
                <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                    Saved.
                </jet-action-message>

                <jet-button
                    v-show="!form.recentlySuccessful"
                    class="btn-primary float-right"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                    Save
                </jet-button>
            </template>
        </jet-form-section>
    </div>
        
</template>

<script>
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'

    export default {
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },

        props: ['permissions'],

        data() {
            return {
                form: this.$inertia.form({                    
                    name: '',
                    permissions: [],
                }),
            }
        },

        methods: {
            createRole() {
                this.form.post(route('roles.store'), {
                    //errorBag: 'updateProfileInformation',
                    preserveScroll: true,
                    //onSuccess: () => (this.clearPhotoFileInput()),
                });
            },
        },
    }
</script>
