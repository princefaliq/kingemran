<script setup>
import { onMounted, nextTick, watch  } from 'vue';
import MenuItem from '@/Components/MenuItem.vue';
import { Head,Link, usePage  } from '@inertiajs/vue3';

onMounted(async () => {
    await nextTick()

    window.KTApp?.init()
    window.KTComponents?.init?.()
    window.KTThemeMode?.init?.()
})
const page = usePage()

// Set opsi toastr sekali saja
if (window.toastr) {
    window.toastr.options = {
        closeButton: false,
        debug: false,
        newestOnTop: false,
        progressBar: false,
        positionClass: "toastr-bottom-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    }
}
watch(
    () => page.props.flash,
    (flash) => {
        if (!window.toastr) return
        if (!flash) return

        if (flash.success) window.toastr.success(flash.success)
        if (flash.error) window.toastr.error(flash.error)
        if (flash.warning) window.toastr.warning(flash.warning)
        if (flash.info) window.toastr.info(flash.info)
    },
    { deep: true, immediate: true }
)
</script>

<template>
    <div class="d-flex flex-column flex-root min-vh-100">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--begin::Header-->
                <div id="kt_header" class="header">
                    <!--begin::Container-->
                    <div class="container-fluid d-flex flex-stack">
                        <!--begin::Brand-->
                        <div class="d-flex align-items-center me-5">
                            <!--begin::Aside toggle-->
                            <div class="d-lg-none btn btn-icon btn-active-color-white w-30px h-30px ms-n2 me-3" id="kt_aside_toggle">
                                <i class="ki-duotone ki-abstract-14 fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                            <!--end::Aside  toggle-->
                            <!--begin::Logo-->
                            <a href="">
                                <img alt="Logo" src="/favicon.png" class="h-25px h-lg-30px" />
                            </a>
                            <!--end::Logo-->

                        </div>
                        <!--end::Brand-->
                        <!--begin::Topbar-->
                        <div class="d-flex align-items-center flex-shrink-0">

                            <!--begin::Theme mode-->
                            <div class="d-flex align-items-center ms-1">
                                <!--begin::Menu toggle-->
                                <a href="#" class="btn btn-icon btn-color-white bg-hover-white bg-hover-opacity-10 w-30px h-30px h-40px w-40px" data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-night-day theme-light-show fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                        <span class="path7"></span>
                                        <span class="path8"></span>
                                        <span class="path9"></span>
                                        <span class="path10"></span>
                                    </i>
                                    <i class="ki-duotone ki-moon theme-dark-show fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </a>
                                <!--begin::Menu toggle-->
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 my-0">
                                        <a href="javascript:void(0)" @click.prevent class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
												<span class="menu-icon" data-kt-element="icon">
													<i class="ki-duotone ki-night-day fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
														<span class="path4"></span>
														<span class="path5"></span>
														<span class="path6"></span>
														<span class="path7"></span>
														<span class="path8"></span>
														<span class="path9"></span>
														<span class="path10"></span>
													</i>
												</span>
                                            <span class="menu-title">Light</span>
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 my-0">
                                        <a href="javascript:void(0)" @click.prevent class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
												<span class="menu-icon" data-kt-element="icon">
													<i class="ki-duotone ki-moon fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</span>
                                            <span class="menu-title">Dark</span>
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 my-0">
                                        <a href="javascript:void(0)" @click.prevent class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
												<span class="menu-icon" data-kt-element="icon">
													<i class="ki-duotone ki-screen fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
														<span class="path4"></span>
													</i>
												</span>
                                            <span class="menu-title">System</span>
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                            </div>
                            <!--end::Theme mode-->
                            <!--begin::User-->
                            <div class="d-flex align-items-center ms-1" id="kt_header_user_menu_toggle">
                                <!--begin::User info-->
                                <div class="btn btn-flex align-items-center bg-hover-white bg-hover-opacity-10 py-2 px-2 px-md-3" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                    <!--begin::Name-->
                                    <div class="d-none d-md-flex flex-column align-items-end justify-content-center me-2 me-md-4">
                                        <span class="text-muted fs-8 fw-semibold lh-1 mb-1">{{ $page.props.auth.user.name }}</span>
                                        <span class="text-white fs-8 fw-bold lh-1">{{ $page.props.auth.user.email }}</span>
                                    </div>
                                    <!--end::Name-->
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px symbol-md-40px">
                                        <img src="/assets/media/avatars/300-1.jpg" alt="image" />
                                    </div>
                                    <!--end::Symbol-->
                                </div>
                                <!--end::User info-->
                                <!--begin::User account menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content d-flex align-items-center px-3">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-50px me-5">
                                                <img alt="Logo" src="/assets/media/avatars/300-1.jpg" />
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Username-->
                                            <div class="d-flex flex-column">
                                                <div class="fw-bold d-flex align-items-center fs-5">{{ $page.props.auth.user.name }}
                                                    <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">{{ $page.props.auth.user.roles[0]?.name }}</span></div>
                                                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{ $page.props.auth.user.email }}</a>
                                            </div>
                                            <!--end::Username-->
                                        </div>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu separator-->
                                    <div class="separator my-2"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5">
                                        <Link href="" class="menu-link px-5">My Profile</Link>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu separator-->
                                    <div class="separator my-2"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5 my-1">
                                        <Link href="" class="menu-link px-5">Account Settings</Link>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5">
                                        <Link
                                            :href="route('admin.logout')"
                                            method="post"
                                            as="button"
                                            class="menu-link btn btn-reset w-100 text-start px-5"
                                        >
                                            Sign Out
                                        </Link>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::User account menu-->
                            </div>
                            <!--end::User -->
                        </div>
                        <!--end::Topbar-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->
                <!--begin::Content wrapper-->
                <div class="d-flex flex-column-fluid">
                    <!--begin::Aside-->
                    <div id="kt_aside" class="aside card" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
                        <!--begin::Aside menu-->
                        <div class="aside-menu flex-column-fluid px-4">
                            <!--begin::Aside Menu-->
                            <MenuItem />
                        </div>
                        <!--end::Aside menu-->
                        <!--begin::Footer-->
<!--                        <div class="aside-footer flex-column-auto pt-5 pb-7 px-7" id="kt_aside_footer">
                            <a href="https://preview.keenthemes.com/html/metronic/docs" class="btn btn-bg-light btn-color-gray-500 btn-active-color-gray-900 text-nowrap w-100" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click" title="200+ in-house components and 3rd-party plugins">
                                <span class="btn-label">Docs & Components</span>
                                <i class="ki-duotone ki-document btn-icon fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </a>
                        </div>-->
                        <!--end::Footer-->
                    </div>
                    <!--end::Aside-->
                    <!--begin::Container-->
                    <div class="d-flex flex-column flex-column-fluid container-fluid">
                        <slot name="Toolbar" />
                        <!--begin::Post-->
                        <div class="content flex-column-fluid" id="kt_content">
                            <slot />
                        </div>
                        <!--end::Post-->
                        <!--begin::Footer-->
                        <div class="footer py-4 d-flex flex-column flex-md-row flex-stack" id="kt_footer">
                            <!--begin::Copyright-->
                            <div class="text-gray-900 order-2 order-md-1">
                                <span class="text-muted fw-semibold me-1">2026&copy;</span>
                                <a href="/" target="_blank" class="text-gray-800 text-hover-primary">A. F. I.</a>
                            </div>
                            <!--end::Copyright-->
                            <!--begin::Menu-->
                            <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                                <li class="menu-item">
                                    <a href="#" class="menu-link px-2" data-bs-toggle="modal" data-bs-target="#aboutModal">
                                        About
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="https://wa.me/6282335596664?text=Hallo%20saya%20dari%20website%20chantika" target="_blank" class="menu-link px-2">Contact Us</a>
                                </li>
                                <li class="menu-item">
                                    <a href="https://wa.me/6282335596664?text=Hallo%20saya%20mau%20beli%20aplikasi%20website" target="_blank" class="menu-link px-2">Purchase</a>
                                </li>
                            </ul>
                            <!--end::Menu-->
                        </div>
                        <!--end::Footer-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Content wrapper-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>
    <!--end::Scrolltop-->
    <div class="modal fade" id="aboutModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">About Developer</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center p-5">

                    <!-- FOTO -->
                    <img
                        src="/images/programmer.png"
                        class="rounded-circle mb-4"
                        style="width:100px;height:100px;object-fit:cover"
                    />

                    <!-- NAMA -->
                    <h4 class="fw-bold mb-1">Achmad Faliqul Isbah, S.Tr.Kom.</h4>

                    <!-- ROLE -->
                    <div class="text-muted mb-3">
                        Fullstack Developer
                    </div>

                    <!-- DESKRIPSI -->
                    <p class="text-gray-600">
                        Aplikasi ini dibuat menggunakan Laravel, Inertia, dan Vue untuk efisiensi sistem.
                    </p>

                    <!-- TECH -->
                    <div class="mt-3">
                        <span class="badge badge-light-primary me-2">Laravel</span>
                        <span class="badge badge-light-info me-2">Vue</span>
                        <span class="badge badge-light-success">Inertia</span>
                    </div>

                </div>

            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
