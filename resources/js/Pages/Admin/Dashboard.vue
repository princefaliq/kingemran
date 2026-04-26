<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import {Head, Link} from '@inertiajs/vue3'
import { onMounted, onBeforeUnmount } from 'vue'


const scripts = [
    '/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js',
    'https://cdn.amcharts.com/lib/5/index.js',
    'https://cdn.amcharts.com/lib/5/xy.js',
    'https://cdn.amcharts.com/lib/5/percent.js',
    'https://cdn.amcharts.com/lib/5/radar.js',
    'https://cdn.amcharts.com/lib/5/themes/Animated.js',
    'https://cdn.amcharts.com/lib/5/map.js',
    'https://cdn.amcharts.com/lib/5/geodata/worldLow.js',
    'https://cdn.amcharts.com/lib/5/geodata/continentsLow.js',
    'https://cdn.amcharts.com/lib/5/geodata/usaLow.js',
    'https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js',
    'https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js',
    '/assets/plugins/custom/datatables/datatables.bundle.js',
    '/assets/js/widgets.bundle.js',
    '/assets/js/custom/widgets.js',
    '/assets/js/custom/apps/chat/chat.js'
]

let loadedScripts = []

onMounted(() => {
    scripts.forEach(src => {
        const s = document.createElement('script')
        s.src = src
        s.async = false
        document.body.appendChild(s)
        loadedScripts.push(s)
    })
})
onBeforeUnmount(() => {
    loadedScripts.forEach(s => s.remove())
})


const styles = [
    '/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css',
    '/assets/plugins/custom/datatables/datatables.bundle.css'
]

let loadedStyles = []

onMounted(() => {
    styles.forEach(href => {
        const link = document.createElement('link')
        link.rel = 'stylesheet'
        link.href = href
        document.head.appendChild(link)
        loadedStyles.push(link)
    })
})

onBeforeUnmount(() => {
    loadedStyles.forEach(link => link.remove())
})

defineOptions({
    layout: AdminLayout,
})

</script>

<template>
    <Head title="Dashboard" />
    <!--begin::Row-->
    <div class="row g-5 g-lg-10">

        <!--begin::Col-->
        <div class="col-xl-12">

            <!--begin::Tiles Widget 2-->
            <div class="card h-175px bgi-no-repeat bgi-size-contain h-200px mb-5 mb-lg-10" style="background-color: #1B283F; background-position: right; background-image:url('assets/media/svg/misc/taieri.svg')">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column justify-content-between">
                    <!--begin::Title-->
                    <h2 class="text-white fw-bold mb-5">
                        <span class="lh-lg">Selamat Datang
                        <br />{{ $page.props.auth.user.name }}</span>
                    </h2>
                    <!--end::Title-->
                    <!--begin::Action-->
                    <div class="m-0">
                        <Link
                            :href="route('admin.logout')"
                            method="post"
                            as="button"
                            class="btn btn-danger fw-semibold px-6 py-3"
                        >
                            Sign Out
                        </Link>

                    </div>
                    <!--begin::Action-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Tiles Widget 2-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

</template>
