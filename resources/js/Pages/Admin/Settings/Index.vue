<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from "@inertiajs/vue3";
import { ref, computed } from 'vue';

const props = defineProps({
    settings: Array
})

const search = ref('')

const filteredSettings = computed(() => {
    if (!search.value) return props.settings

    return props.settings.filter(s =>
        s.key.toLowerCase().includes(search.value.toLowerCase()) ||
        (s.value ?? '').toLowerCase().includes(search.value.toLowerCase())
    )
})
const stripHtml = (html) => {
    if (!html) return ''
    return html.replace(/<[^>]*>/g, '')
}
</script>

<template>
    <Head title="Settings" />

    <AdminLayout>

        <!-- TOOLBAR -->
        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="d-flex text-gray-900 fw-bold my-1 fs-3">Settings</h1>
                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                        <li class="breadcrumb-item text-gray-600">
                            <Link :href="route('admin.dashboard')" class="text-gray-600 text-hover-primary">
                                Dashboard
                            </Link>
                        </li>
                        <li class="breadcrumb-item text-gray-600">Settings</li>
                        <li class="breadcrumb-item text-gray-600">List</li>
                    </ul>
                </div>

                <div class="d-flex align-items-center py-2 py-md-1">
                    <div class="me-3">
                        <input
                            v-model="search"
                            type="text"
                            placeholder="Search setting..."
                            class="form-control"
                        />
                    </div>

                    <!-- langsung ke halaman edit -->
                    <Link :href="route('admin.settings.edit')" class="btn btn-dark fw-bold">
                        Edit Settings
                    </Link>
                </div>
            </div>
        </template>

        <!-- CONTENT -->
        <div class="row g-5 g-lg-12">
            <div class="col-xl-12">
                <div class="card h-md-100">

                    <div class="card-header border-0 py-5">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">List Settings</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-rounded table-row-bordered border gs-5">

                                <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th style="width: 30%">Key</th>
                                    <th>Value</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr v-for="item in filteredSettings" :key="item.key">

                                    <!-- KEY -->
                                    <td class="align-middle">
                                        <code>{{ item.key }}</code>
                                    </td>

                                    <!-- VALUE -->
                                    <td class="align-middle">

                                        <!-- FOTO -->
                                        <img
                                            v-if="item.key.includes('foto') && item.value"
                                            :src="`/storage/${item.value}`"
                                            style="width: 50px; height: 80px; object-fit: cover; border-radius: 5px;"
                                        />

                                        <!-- TEXT / HTML -->
                                        <span v-else>
                                            {{
                                                item.value
                                                ? stripHtml(item.value).substring(0, 100) + (stripHtml(item.value).length > 100 ? '...' : '')
                                                : '-'
                                            }}
                                        </span>

                                    </td>

                                </tr>

                                <tr v-if="filteredSettings.length === 0">
                                    <td colspan="2" class="text-center py-10 text-muted">
                                        No settings found
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </AdminLayout>
</template>
