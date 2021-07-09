<template>
    <app-layout>
        <template #header>
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ __('Edit post') }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><inertia-link :href="route('dashboard')">{{ __('Dashboard') }}</inertia-link></li>
                                <li class="breadcrumb-item"><inertia-link :href="route('posts.index')">{{ __('Posts') }}</inertia-link></li>
                                <li class="breadcrumb-item active">{{ __('Edit') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <jet-form-section @submitted="updatePost">
                            <template #title>
                                {{ __('Edit post') }}
                            </template>

                            <template #form>
                                <!-- title -->
                                <div class="form-group">
                                    <label for="title">{{ __('Title') }}</label>
                                    <jet-input id="title" type="text" :class="{ 'is-invalid' : form.errors.title}" v-model="form.title" autocomplete="title" />
                                    <jet-input-error :message="form.errors.title" />
                                </div>

                                <div class="form-group">
                                    <label>{{__('Categories')}}</label>
                                    <select class="select2" multiple="multiple" data-placeholder="Select categories" style="width: 100%;" v-model="form.categories">
                                        <option v-for="(category, key) in categories" :key="key" :value="category.id">{{ category.name }}</option>
                                    </select>
                                    <jet-input-error style="display: block;" :message="form.errors.categories" />
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Content') }}</label>

                                    <textarea class="textarea" id="text-content" :class="{ 'is-invalid' : form.errors.content}" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" v-model="form.content"></textarea>
                                    <jet-input-error :message="form.errors.content" />
                                </div>

                                <div class="form-check">
                                    <jet-checkbox id="is_public" name="is_public" v-model:checked="form.is_public" class="form-check-input" />
                                    <label class="form-check-label" for="is_public">{{ __('Is public') }}</label>
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
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
    import AppLayout from '@/Layouts/AppLayout'
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
            AppLayout,
            JetActionMessage,
            JetButton,
            JetCheckbox,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },

        props: ['categories', 'post'],

        data() {
            return {
                form: this.$inertia.form({ 
                    _method: 'PUT',                   
                    title: this.post.title,
                    categories: this.post.categories.map(function(x) { return x.id; }),
                    content: this.post.content,
                    is_public: this.post.is_public == 1,
                }),
            }
        },

        methods: {
            updatePost() {
                this.form.categories = $('.select2').val();
                console.log(this.form);
                let content = $('.note-editable').text().trim();
                if (content != '') {
                    this.form.content = $('.note-editable').html();
                }
                
                
                this.form.post(route('posts.update', this.post), {
                    //errorBag: 'updateProfileInformation',
                    preserveScroll: true,
                    onSuccess: () => this.form.reset(),
                });
            },
        },

        mounted(){
            //let a = this.post.categories.map(function(x) { return x.id; });
            //console.log("a", a);
            $('.select2').select2();
            $('#text-content').summernote({
                callbacks: {
                    onImageUpload: function(image) {                        
                        var img = image[0];
                        
                        console.log("img", img);
                        var datos = new FormData();
                        datos.append("img", img);
                        console.log("datos", datos);
                        
                        axios.post(route('post.uploadFiles'),datos,{
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }).then(resp => {
                            console.log("resp", resp.data);
                            let nodeImg = document.createElement('img');
                            nodeImg.src= resp.data.url;
                            $('#text-content').summernote("insertNode", nodeImg);
                        });
                        
                    }
                }
            });
        }
    }
</script>
