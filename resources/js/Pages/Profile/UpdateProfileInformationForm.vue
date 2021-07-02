<template>
    <div class="col-12">
        <jet-form-section @submitted="updateProfileInformation">
            <template #title>
                {{ __('Profile Information') }}
            </template>

            <template #description>
                &nbsp; {{ __("Update your account's profile information and email address.") }}
            </template>

            <template #form formClass="form-horizontal">
                <!-- Profile Photo -->

                <div class="form-group text-center" v-if="$page.props.jetstream.managesProfilePhotos">
                    <!-- Profile Photo File Input -->
                    <input type="file" class="d-none"
                                ref="photo"
                                @change="updatePhotoPreview">

                    <jet-label for="photo" value="Photo" />

                     <!-- Current Profile Photo -->
                    <div class="mb-2" v-show="! photoPreview">
                        <img :src="user.profile_photo_url" :alt="user.name" class="img-circle img-thumbnail" style="max-height: 100px;">
                    </div>

                    <!-- New Profile Photo Preview -->
                    <div class="mb-2" v-show="photoPreview">
                        <img :src="photoPreview" :alt="user.name" class="img-circle img-thumbnail" style="height: 100px;">
                    </div>




                    <jet-secondary-button type="button" @click.prevent="selectNewPhoto">
                        {{ __('Select A New Photo') }}
                    </jet-secondary-button>
                    <br>

                    <jet-secondary-button type="button" class="mt-2" @click.prevent="deletePhoto" v-if="user.profile_photo_path">
                        {{ __('Remove Photo') }}
                    </jet-secondary-button>

                    <jet-input-error :message="form.errors.photo" />


                </div>

                <!-- Name -->
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                    <div class="col-sm-10">
                        <jet-input id="name" type="text" :class="{ 'is-invalid' : form.errors.name}" v-model="form.name" autocomplete="name" />
                        <jet-input-error :message="form.errors.name" />
                    </div>
                    
                </div>

                <!-- Email -->
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                    <div class="col-sm-10">
                        <jet-input id="email" type="email" :class="{ 'is-invalid' : form.errors.email }" v-model="form.email" />
                        <jet-input-error :message="form.errors.email" />
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

        props: ['user'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'PUT',
                    name: this.user.name,
                    email: this.user.email,
                    photo: null,
                }),

                photoPreview: null,
            }
        },

        methods: {
            updateProfileInformation() {
                if (this.$refs.photo) {
                    this.form.photo = this.$refs.photo.files[0]
                }

                this.form.post(route('user-profile-information.update'), {
                    errorBag: 'updateProfileInformation',
                    preserveScroll: true,
                    onSuccess: () => (this.clearPhotoFileInput()),
                });
            },

            selectNewPhoto() {
                this.$refs.photo.click();
            },

            updatePhotoPreview() {
                const photo = this.$refs.photo.files[0];

                if (! photo) return;

                const reader = new FileReader();

                reader.onload = (e) => {
                    this.photoPreview = e.target.result;
                };

                reader.readAsDataURL(photo);
            },

            deletePhoto() {
                this.$inertia.delete(route('current-user-photo.destroy'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.photoPreview = null;
                        this.clearPhotoFileInput();
                    },
                });
            },

            clearPhotoFileInput() {
                if (this.$refs.photo?.value) {
                    this.$refs.photo.value = null;
                }
            },
        },
    }
</script>
