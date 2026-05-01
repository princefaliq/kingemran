<script setup>
import { Head,Link, usePage } from '@inertiajs/vue3';
const page = usePage()

/*const isActive = (url) => {
    return page.url.startsWith(url)
}*/
const isRouteActive = (routes) => {
    return routes.some(r => route().current(r))
}
</script>

<template>
    <div class="hover-scroll-overlay-y mh-100 my-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="{default: '#kt_aside_footer', lg: '#kt_header, #kt_aside_footer'}" data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu" data-kt-scroll-offset="{default: '5px', lg: '75px'}">
        <!--begin::Menu-->
        <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_aside_menu" data-kt-menu="true">
            <!--begin:Menu item-->
            <div data-kt-menu-trigger="click" class="menu-item">
                <!--begin:Menu link-->
                <Link
                    class="menu-link"
                    :href = "route('admin.dashboard')"
                    :class="{ active: route().current('admin.dashboard') }"
                >
                    <span class="menu-icon">
                        <i class="ki-duotone ki-element-11 fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                        </i>
                    </span>
                    <span class="menu-title">Dashboards</span>
                </Link>
                <!--end:Menu link-->
            </div>

            <div data-kt-menu-trigger="click" class="menu-item">
                <!--begin:Menu link-->
                <Link
                    :href="route('admin.menu.index')"
                    class="menu-link"
                    :class="{ active: route().current('admin.menu.*') }"
                    v-if="$page.props.auth.permissions.includes('menu')"
                >
                    <span class="menu-icon">
                        <i class="ki-duotone ki-menu fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                        </i>
                    </span>
                    <span class="menu-title">Menu</span>
                </Link>
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->
            <div data-kt-menu-trigger="click" class="menu-item">
                <!--begin:Menu link-->
                <Link
                    :href="route('admin.pages.index')"
                    class="menu-link"
                    :class="{ active: route().current('admin.pages.*') }"
                    v-if="$page.props.auth.permissions.includes('pages')"
                >
                    <span class="menu-icon">
                        <i class="ki-duotone ki-book-square fs-2">
                         <span class="path1"></span>
                         <span class="path2"></span>
                         <span class="path3"></span>
                        </i>
                    </span>
                    <span class="menu-title">Page</span>
                </Link>
                <!--end:Menu link-->
            </div>
            <div data-kt-menu-trigger="click" :class="[
                'menu-item menu-accordion',
                    {
                      here: isRouteActive(['admin.tags.*', 'admin.articles.*', 'admin.categories.*']),
                      show: isRouteActive(['admin.tags.*', 'admin.articles.*', 'admin.categories.*'])
                    }
                ]"
                v-if="$page.props.auth.permissions.includes('news')"
            >
                <!--begin:Menu link-->
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-notepad-edit fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">News</span>
                    <span class="menu-arrow"></span>
                </span>
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <Link
                            :href="route('admin.articles.index')"
                            class="menu-link"
                            :class="{ active: route().current('admin.articles.*') }"
                            v-if="$page.props.auth.permissions.includes('news')"
                        >
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Article</span>
                        </Link>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <Link
                            :href="route('admin.categories.index')"
                            class="menu-link"
                            :class="{ active: route().current('admin.categories.*') }"
                            v-if="$page.props.auth.permissions.includes('news')"
                        >
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Categories</span>
                        </Link>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <Link
                            :href="route('admin.tags.index')"
                            class="menu-link"
                            :class="{ active: route().current('admin.tags.*') }"
                            v-if="$page.props.auth.permissions.includes('news')"
                        >
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Tags</span>
                        </Link>
                        <!--end:Menu link-->
                    </div>
                </div>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item">
                <!--begin:Menu link-->
                <Link
                    :href="route('admin.baner.index')"
                    class="menu-link"
                    :class="{ active: route().current('admin.baner.*') }"
                    v-if="$page.props.auth.permissions.includes('baner')"
                >
                    <span class="menu-icon">
                        <i class="ki-duotone ki-note fs-2">
                         <span class="path1"></span>
                         <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">Baner</span>
                </Link>
                <!--end:Menu link-->
            </div>
            <div data-kt-menu-trigger="click" class="menu-item">
                <!--begin:Menu link-->
                <Link
                    :href="route('admin.galleries.index')"
                    class="menu-link"
                    :class="{ active: route().current('admin.galleries.*') }"
                    v-if="$page.props.auth.permissions.includes('galleries')"
                >
                    <span class="menu-icon">
                        <i class="ki-duotone ki-bucket fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                        </i>
                    </span>
                    <span class="menu-title">Galleries</span>
                </Link>
                <!--end:Menu link-->
            </div>
            <div data-kt-menu-trigger="click" class="menu-item">
                <!--begin:Menu link-->
                <Link
                    :href="route('admin.employees.index')"
                    class="menu-link"
                    :class="{ active: route().current('admin.employees.*') }"
                    v-if="$page.props.auth.permissions.includes('employees')"
                >
                    <span class="menu-icon">
                        <i class="ki-duotone ki-people fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                        </i>
                    </span>
                    <span class="menu-title">Employee</span>
                </Link>
                <!--end:Menu link-->
            </div>
            <div data-kt-menu-trigger="click" class="menu-item">
                <!--begin:Menu link-->
                <Link
                    :href="route('admin.testimonials.index')"
                    class="menu-link"
                    :class="{ active: route().current('admin.testimonials.*') }"
                    v-if="$page.props.auth.permissions.includes('testimonials')"
                >
                    <span class="menu-icon">
                        <i class="ki-duotone ki-abstract-6 fs-2">

                        </i>
                    </span>
                    <span class="menu-title">Testimonials</span>
                </Link>
                <!--end:Menu link-->
            </div>
            <div data-kt-menu-trigger="click" class="menu-item">
                <!--begin:Menu link-->
                <Link
                    :href="route('admin.partners.index')"
                    class="menu-link"
                    :class="{ active: route().current('admin.partners.*') }"
                    v-if="$page.props.auth.permissions.includes('partners')"
                >
                    <span class="menu-icon">
                        <i class="ki-duotone ki-people fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                        </i>
                    </span>
                    <span class="menu-title">Partners</span>
                </Link>
                <!--end:Menu link-->
            </div>
            <div data-kt-menu-trigger="click" class="menu-item">
                <!--begin:Menu link-->
                <Link
                    :href="route('admin.settings.index')"
                    class="menu-link"
                    :class="{ active: route().current('admin.settings.*') }"
                    v-if="$page.props.auth.permissions.includes('settings')"
                >
                    <span class="menu-icon">
                        <i class="ki-duotone ki-setting-3 fs-2">
                         <span class="path1"></span>
                         <span class="path2"></span>
                         <span class="path3"></span>
                         <span class="path4"></span>
                         <span class="path5"></span>
                        </i>
                    </span>
                    <span class="menu-title">Settings</span>
                </Link>
                <!--end:Menu link-->
            </div>
            <!--begin:Menu item-->
            <div data-kt-menu-trigger="click" class="menu-item">
                <!--begin:Menu link-->
                <Link
                    :href="route('admin.users.index')"
                    class="menu-link"
                    :class="{ active: route().current('admin.users.*') }"
                    v-if="$page.props.auth.permissions.includes('user')"
                >
                    <span class="menu-icon">
                        <i class="ki-duotone ki-user fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">User</span>
                </Link>
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->
        </div>
        <!--end::Menu-->
    </div>
</template>

<style scoped>

</style>
