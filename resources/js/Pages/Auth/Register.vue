<template>
    <jet-authentication-card>
        <template #logo>
            <jet-authentication-card-logo />
        </template>
        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">{{ __('Register') }}</p>
                <jet-validation-errors />
                <form @submit.prevent="submit">
                    <div class="input-group mb-3">
                        <jet-input id="name" type="text" v-model="form.name" required autofocus autocomplete="name" :placeholder="__('Name')" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">                        
                        <jet-input id="email" type="email" v-model="form.email" required :placeholder="__('Email')" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">                        
                        <jet-input id="password" type="password" v-model="form.password" required autocomplete="new-password" :placeholder="__('Password')" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <jet-input id="password_confirmation" type="password" v-model="form.password_confirmation" required autocomplete="new-password" :placeholder="__('Confirm Password')" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <div class="icheck-primary" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                                
                                <jet-checkbox name="terms" id="terms" v-model:checked="form.terms" />


                                <label for="terms">
                                    I agree to the <a target="_blank" :href="route('terms.show')">Terms of Service</a> and <a target="_blank" :href="route('policy.show')">Privacy Policy</a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-5">
                            <jet-button class="btn-primary btn-block" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                {{ __('Register') }}
                            </jet-button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <!--div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i>
                        Sign up using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i>
                        Sign up using Google+
                    </a>
                </div-->
                
                <inertia-link :href="route('login')" class="text-center">
                    {{ __('Already registered?') }}
                </inertia-link>
            </div>
            <!-- /.form-box -->
        </div>
        
        
    </jet-authentication-card>
</template>
<script>
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import JetCheckbox from "@/Jetstream/Checkbox";
import JetLabel from '@/Jetstream/Label'
import JetValidationErrors from '@/Jetstream/ValidationErrors'

export default {
    components: {
        JetAuthenticationCard,
        JetAuthenticationCardLogo,
        JetButton,
        JetInput,
        JetCheckbox,
        JetLabel,
        JetValidationErrors
    },

    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                terms: false,
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        }
    }
}

</script>
