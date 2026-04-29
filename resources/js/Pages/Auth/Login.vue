<script setup>
import { onMounted, onUnmounted, ref } from 'vue'
import { Head, useForm, usePage } from '@inertiajs/vue3'

/**
 * ❗ Login TIDAK pakai AppLayout
 */
defineOptions({ layout: null })
let recaptchaScript = null
/**
 * Form Inertia
 */
const captchaError = ref(false)
const captchaMessage = ref('')

const form = useForm({
    email: '',
    password: '',
    'g-recaptcha-response': '',
})
const { appName, site_key } = usePage().props

const resetCaptchaState = (message = '') => {
    form['g-recaptcha-response'] = ''
    captchaError.value = !!message
    captchaMessage.value = message
}

const reloadCaptcha = () => {
    resetCaptchaState('')

    if (window.grecaptcha) {
        window.grecaptcha.reset()
    }
}

const refreshPage = () => {
    window.location.reload()
}

window.onSubmit = function(token) {
    captchaError.value = false
    captchaMessage.value = ''
    form['g-recaptcha-response'] = token
    form.post(route('admin.login'))
}

/**
 * Init Metronic JS
 */
onMounted(() => {
    recaptchaScript = document.createElement('script')
    recaptchaScript.src = `https://www.google.com/recaptcha/api.js`
    recaptchaScript.async = true
    recaptchaScript.defer = true
    window.onError = function() {
        resetCaptchaState('Google reCAPTCHA gagal dimuat. Silakan muat ulang captcha atau refresh halaman.')
    }
    window.onExpired = function() {
        resetCaptchaState('Google reCAPTCHA sudah kedaluwarsa karena halaman terlalu lama terbuka. Silakan muat ulang captcha atau refresh halaman.')
    }
    document.head.appendChild(recaptchaScript)
    if (window.KTApp) {
        window.KTApp.init()
    }
})
onUnmounted(() => {

    if (recaptchaScript) {
        document.head.removeChild(recaptchaScript)
    }


})

</script>

<template>
    <Head title="Log In" />

    <div class="d-flex flex-column flex-root">
        <!--begin::Page bg image-->

        <!--end::Page bg image-->
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-column-fluid flex-lg-row">
            <!--begin::Aside-->
            <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
                <!--begin::Aside-->
                <div class="d-flex flex-center flex-lg-start flex-column">
                    <!--begin::Logo-->
                    <a href="/" class="mb-7">
                        <img alt="Logo" src="/favicon.png" style="max-width:20%"/>
                    </a>
                    <!--end::Logo-->
                    <!--begin::Title-->
                    <h2 class="text-white fw-normal m-0">Sistem Informasi dan Manajemen Konten Website Resmi {{ appName }}</h2>
                    <!--end::Title-->
                </div>
                <!--begin::Aside-->
            </div>
            <!--begin::Aside-->
            <!--begin::Body-->
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
                <!--begin::Card-->
                <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 h-800px w-md-600px p-20">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                        <!--begin::Form-->
                        <form class="form w-100" novalidate="novalidate" @submit.prevent>
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <!--begin::Title-->
                                <h1 class="text-gray-900 fw-bolder mb-3">Sign In</h1>
                                <!--end::Title-->
                                <!--begin::Subtitle-->
                                <div class="text-gray-500 fw-semibold fs-6">Use your Email and Password</div>
                                <div v-if="form.errors.email" class="alert alert-danger d-flex align-items-center p-5 mt-2">
                                    <i class="ki-duotone ki-shield-cross fs-2hx text-danger me-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                    <div class="d-flex flex-column">
                                        <!--begin::Title-->
                                        <h4 class="mb-1 text-danger">Error</h4>
                                        <!--end::Title-->

                                        <!--begin::Content-->
                                        <span>{{ form.errors.email }}</span>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Wrapper-->

                                </div>
                                <div v-if="captchaError" class="alert alert-danger d-flex flex-column gap-3 mt-2">
                                    <span>{{ captchaMessage }}</span>
                                    <div class="d-flex flex-wrap gap-2">
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-light-primary"
                                            @click="reloadCaptcha"
                                        >
                                            Reload Captcha
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-light"
                                            @click="refreshPage"
                                        >
                                            Refresh Halaman
                                        </button>
                                    </div>
                                </div>
                                <!--end::Subtitle=-->
                            </div>
                            <!--begin::Heading-->
                            <!--begin::Login options-->
                            <div class="row g-3 mb-9">
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <!--begin::Google link=-->
<!--                                    <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                        <img alt="Logo" src="assets/media/svg/brand-logos/google-icon.svg" class="h-15px me-3" />Sign in with Google</a>-->
                                    <!--end::Google link=-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <!--begin::Google link=-->
<!--                                    <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                        <img alt="Logo" src="assets/media/svg/brand-logos/apple-black.svg" class="theme-light-show h-15px me-3" />
                                        <img alt="Logo" src="assets/media/svg/brand-logos/apple-black-dark.svg" class="theme-dark-show h-15px me-3" />Sign in with Apple</a>-->
                                    <!--end::Google link=-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Login options-->
                            <!--begin::Separator-->
                            <div class="separator separator-content my-14">
                                <span class="w-125px text-gray-500 fw-semibold fs-7">_</span>

                            </div>
                            <!--end::Separator-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <input
                                    type="email"
                                    placeholder="Email"
                                    class="form-control bg-transparent"
                                    v-model="form.email"
                                />

                                <!--end::Email-->
                            </div>
                            <!--end::Input group=-->
                            <div class="fv-row mb-3">
                                <!--begin::Password-->
                                <input
                                    type="password"
                                    placeholder="Password"
                                    class="form-control bg-transparent"
                                    v-model="form.password"
                                />
                                <div v-if="form.errors.password" class="text-danger fs-7 mt-2">
                                    {{ form.errors.password }}
                                </div>
                                <!--end::Password-->
                            </div>
                            <!--end::Input group=-->

                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                <div></div>
                                <!--begin::Link-->
<!--                                <a href="authentication/layouts/creative/reset-password.html" class="link-primary">Forgot Password ?</a>-->
                                <!--end::Link-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Submit button-->
                            <div class="d-grid mb-10">
                                <button
                                    class="g-recaptcha btn btn-primary"
                                    :disabled="form.processing"
                                    :data-kt-indicator="form.processing ? 'on' : null"
                                    :data-sitekey="site_key"
                                    data-callback="onSubmit"
                                    data-error-callback="onError"
                                    data-expired-callback="onExpired"
                                    data-action="submit"
                                >
                                    <span class="indicator-label">Sign In</span>
                                    <span class="indicator-progress">
                                        Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>

                            </div>
                            <!--end::Submit button-->
                            <!--begin::Sign up-->
<!--                            <div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet?
                                <a href="authentication/layouts/creative/sign-up.html" class="link-primary">Sign up</a></div>-->
                            <!--end::Sign up-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Footer-->
                    <div class="d-flex flex-stack px-lg-10">
                        <!--begin::Languages-->
                        <div class="me-0">
                            <!--begin::Toggle-->
<!--                            <button class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, 0px">
                                <img data-kt-element="current-lang-flag" class="w-20px h-20px rounded me-3" src="assets/media/flags/united-states.svg" alt="" />
                                <span data-kt-element="current-lang-name" class="me-1">English</span>
                                <i class="ki-duotone ki-down fs-5 text-muted rotate-180 m-0"></i>
                            </button>-->
                            <!--end::Toggle-->

                        </div>
                        <!--end::Languages-->
                        <!--begin::Links-->
                        <div class="d-flex fw-semibold text-primary fs-base gap-5">
                            <a href="/" target="_blank">Home</a>
                            <a href="/" target="_blank">Plans</a>
                            <a href="https://wa.me/6282335596664?text=Hallo%20saya%20dari%20aplikasi%20Bahtera%20Lupa%20pasword" target="_blank">Contact Us</a>
                        </div>
                        <!--end::Links-->
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>


</template>
