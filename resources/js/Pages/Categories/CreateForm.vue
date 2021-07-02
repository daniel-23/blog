<template>
    <div class="col-12 col-md-6">
        <jet-form-section @submitted="createCategory">
            <template #title>
                {{ __('Create category') }}
            </template>

            <template #form>
                <!-- Name -->
                <div class="form-group">
                    <label for="name">{{ __('Name') }}</label>
                    <jet-input id="name" type="text" :class="{ 'is-invalid' : form.errors.name}" v-model="form.name" autocomplete="name" />
                    <jet-input-error :message="form.errors.name" />
                </div>

                <div class="form-group">
                    <label>{{ __('Description') }}</label>
                    <textarea class="form-control" :class="{ 'is-invalid' : form.errors.description}" rows="3" :placeholder="__('Description')" style="resize: none;" v-model="form.description"></textarea>
                    <jet-input-error :message="form.errors.description" />
                </div>

                <div class="form-check">
                    <jet-checkbox id="active" name="active" v-model:checked="form.active" class="form-check-input" />
                    <label class="form-check-label" for="active">{{ __('Active') }}</label>
                </div>
            </template>

            <template #actions>
                <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                    {{ __('Categori created successfully!') }}
                </jet-action-message>

                <jet-button class="btn-primary float-right" v-show="!form.recentlySuccessful" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" >
                    {{ __('Save') }}
                </jet-button>
            </template>
        </jet-form-section>
    </div>
        
</template>

<script>
    import JetButton from '@/Jetstream/Button'
    import JetCheckbox from '@/Jetstream/Checkbox'
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
            JetCheckbox,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },

        data() {
            return {
                form: this.$inertia.form({                    
                    name: '',
                    description: '',
                    active: true,
                }),
            }
        },

        methods: {
            createCategory() {
                this.form.post(route('categories.store'), {
                    //errorBag: 'updateProfileInformation',
                    preserveScroll: true,
                    onSuccess: () => this.form.reset(),
                });
            },
        },
    }
</script>
