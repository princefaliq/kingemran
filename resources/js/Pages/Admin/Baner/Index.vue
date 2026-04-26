<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, router } from "@inertiajs/vue3";
import { ref } from 'vue';
import Pagination from '@/Components/Pagination.vue'

const props = defineProps({
    banners: Object,
    filters: Object
})

const search = ref(props.filters.search || '')
const sort = ref(props.filters.sort || 'id')
const direction = ref(props.filters.direction || 'desc')
const status = ref(props.filters.status ?? '')
const reload = () => {
    router.get(route('admin.baner.index'), {
        search: search.value,
        sort: sort.value,
        direction: direction.value,
        status: status.value
    }, {
        preserveState: true,
        replace: true
    })
}

const sortBy = (field) => {
    if (sort.value === field) {
        direction.value = direction.value === 'asc' ? 'desc' : 'asc'
    } else {
        sort.value = field
        direction.value = 'asc'
    }

    reload()
}

const confirmDelete = (id, name) => {
    if (!window.Swal) {
        if (confirm(`Yakin hapus Baner ${name}?`)) {
            router.delete(route('admin.baner.destroy', id))
        }
        return
    }

    window.Swal.fire({
        title: 'Yakin?',
        text: `Baner "${name}" akan dihapus permanen!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('admin.baner.destroy', id))
        }
    })
}
</script>

<template>
    <Head title="Baner" />

    <AdminLayout>

        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="d-flex text-gray-900 fw-bold my-1 fs-3">Baner</h1>
                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                        <li class="breadcrumb-item text-gray-600">
                            <Link :href="route('admin.dashboard')" class="text-gray-600 text-hover-primary">
                                Dashboard
                            </Link>
                        </li>
                        <li class="breadcrumb-item text-gray-600">Baner</li>
                        <li class="breadcrumb-item text-gray-600">List</li>
                    </ul>
                </div>

                <div class="d-flex align-items-center py-2 py-md-1">
                    <div class="me-3">
                        <select v-model="status" @change="reload" class="form-select">
                            <option value="">All Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="me-3">
                        <input
                            v-model="search"
                            @input="reload"
                            type="text"
                            placeholder="Search..."
                            class="form-control"
                        />
                    </div>

                    <Link :href="route('admin.baner.create')" class="btn btn-dark fw-bold">
                        Create
                    </Link>
                </div>
            </div>
        </template>

        <div class="row g-5 g-lg-12">
            <div class="col-xl-12 mb-xl-10">
                <div class="card h-md-100">

                    <div class="card-header border-0 py-5">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">List Baner</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive table-loading">
                            <table class="table table-striped table-rounded table-row-bordered border gs-5">
                                <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th @click="sortBy('name')" style="cursor:pointer">Name</th>
                                    <th>Image</th>
                                    <th>Text</th>
                                    <th @click="sortBy('status')" style="cursor:pointer">Status</th>
                                    <th @click="sortBy('created_at')" style="cursor:pointer">Created</th>
                                    <th class="text-end">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr v-for="banner in banners.data" :key="banner.id">
                                    <td class="align-middle">{{ banner.name }}</td>

                                    <td class="align-middle">
                                        <img
                                            :src="banner.image_url"
                                            alt=""
                                            style="width: 80px; height: 50px; object-fit: cover; border-radius: 5px;"
                                        >
                                    </td>

                                    <td class="align-middle">
                                        {{ banner.text || '-' }}
                                    </td>

                                    <td class="align-middle">
                                        <span
                                            :class="[
                                                'badge',
                                                banner.status ? 'badge-light-success' : 'badge-light-danger'
                                            ]"
                                        >
                                            {{ banner.status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>

                                    <td class="align-middle">
                                        {{ banner.created_at_formatted }}
                                    </td>

                                    <td class="text-end">
                                        <Link
                                            :href="route('admin.baner.edit', banner.id)"
                                            class="btn btn-icon btn-sm me-2"
                                        >
                                            <i class="bi bi-pencil-fill text-primary fs-6"></i>
                                        </Link>

                                        <button
                                            @click="confirmDelete(banner.id, banner.name)"
                                            class="btn btn-icon btn-sm"
                                        >
                                            <i class="bi bi-trash3-fill text-danger fs-6"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="banners.data.length === 0">
                                    <td colspan="6" class="text-center py-10 text-muted">
                                        No baner found
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <Pagination :links="banners.links" />
                    </div>

                </div>
            </div>
        </div>

    </AdminLayout>
</template>

<style scoped>
</style>
