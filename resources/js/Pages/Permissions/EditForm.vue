<template>
    <div class="col-12 col-md-6">
        <jet-form-section @submitted="createPermission">
            <template #title>
                Edit permission
            </template>

            <template #description></template>

            <template #form>
                <!-- Name -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <jet-input id="name" type="text" :class="{ 'is-invalid' : form.errors.name}" v-model="form.name" autocomplete="name" />
                    <jet-input-error :message="form.errors.name" />
                </div>
            </template>

            <template #actions>
                <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                    Permission created successfully!
                </jet-action-message>

                <inertia-link :href="route('permissions.index')" class="btn btn-secondary">Cancel</inertia-link>

                <jet-button class="btn-primary float-right" v-show="!form.recentlySuccessful" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" >
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

        props: ['permission'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'PUT',
                    name: this.permission.name,
                }),
            }
        },

        methods: {
            createPermission() {
                this.form.post(route('permissions.update',this.permission), {
                    //errorBag: 'updateProfileInformation',
                    preserveScroll: true,
                    onSuccess: () => this.form.reset(),
                });
            },
        },
    }
</script>
