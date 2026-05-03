<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head, Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'
import Pagination from '@/Components/Pagination.vue'

const props = defineProps({
    packages: Object,
    filters: Object
})

const search = ref(props.filters.search || '')
const sort = ref(props.filters.sort || 'id')
const direction = ref(props.filters.direction || 'desc')

const reload = () => {
    router.get(route('admin.tour-packages.index'), {
        search: search.value,
        sort: sort.value,
        direction: direction.value
    }, {
        preserveState: true,
        replace: true
    })
}
const toggleStatus = (item) => {
    router.patch(route('admin.tour-packages.update-status', item.id), {
        is_active: !item.is_active
    }, {
        preserveScroll: true,
        onSuccess: () => reload()
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

const confirmDelete = (id, title) => {
    if (!window.Swal) {
        if (confirm(`Yakin hapus Package ${title}?`)) {
            router.delete(route('admin.tour-packages.destroy', id))
        }
        return
    }

    window.Swal.fire({
        title: 'Yakin?',
        text: `Package "${title}" akan dihapus!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('admin.tour-packages.destroy', id))
        }
    })
}
</script>

<template>
    <Head title="Tour Packages" />

    <AdminLayout>

        <!-- TOOLBAR -->
        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="d-flex text-gray-900 fw-bold my-1 fs-3">Tour Packages</h1>

                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                        <li class="breadcrumb-item">
                            <Link :href="route('admin.dashboard')" class="text-gray-600 text-hover-primary">
                                Dashboard
                            </Link>
                        </li>
                        <li class="breadcrumb-item">Tour Packages</li>
                        <li class="breadcrumb-item">List</li>
                    </ul>
                </div>

                <div class="d-flex align-items-center py-2 py-md-1">
                    <div class="me-3">
                        <input
                            v-model="search"
                            @input="reload"
                            type="text"
                            placeholder="Search package..."
                            class="form-control"
                        />
                    </div>

                    <Link :href="route('admin.tour-packages.create')" class="btn btn-dark fw-bold">
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
                            <h3 class="fw-bold m-0">List Tour Packages</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive table-loading">

                            <table class="table table-striped table-rounded table-row-bordered border gs-5">
                                <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th>Thumbnail</th>
                                    <th @click="sortBy('title')" style="cursor:pointer">Title</th>
                                    <th>Duration</th>
                                    <th>Price</th>
                                    <th>Location</th>
                                    <th @click="sortBy('created_at')" style="cursor:pointer">Created</th>
                                    <th class="text-end">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr v-for="item in packages.data" :key="item.id">

                                    <!-- THUMB -->
                                    <td class="align-middle">
                                        <img
                                            :src="item.thumbnail_url"
                                            style="width:80px; height:60px; object-fit:cover; border-radius:6px;"
                                        />
                                    </td>

                                    <!-- TITLE -->
                                    <td class="align-middle">
                                        <div class="fw-bold">{{ item.title }}</div>

                                        <span
                                            v-if="item.is_featured"
                                            class="badge badge-light-warning mt-1"
                                        >
                                            Featured
                                        </span>
                                    </td>

                                    <!-- DURATION -->
                                    <td class="align-middle">
                                        {{ item.duration }} {{ item.duration_type }}
                                    </td>

                                    <!-- PRICE -->
                                    <td class="align-middle">
                                        <div class="fw-bold">
                                            {{ item.currency }} {{ Number(item.price).toLocaleString() }}
                                        </div>

                                        <div
                                            v-if="item.price_discount"
                                            class="text-muted text-decoration-line-through small"
                                        >
                                            {{ item.currency }} {{ Number(item.price_discount).toLocaleString() }}
                                        </div>
                                    </td>

                                    <!-- LOCATION -->
                                    <td class="align-middle">
                                        {{ item.location ?? '-' }}
                                    </td>

                                    <!-- CREATED -->
                                    <td class="align-middle">
                                        {{ item.created_at_formatted ?? item.created_at }}
                                    </td>

                                    <!-- ACTION -->
                                    <td class="align-middle text-end">
                                        <button
                                            @click="toggleStatus(item)"
                                            class="btn btn-icon btn-sm me-2"
                                            :title="item.is_active ? 'Nonaktifkan' : 'Aktifkan'"
                                        >
                                            <i
                                                class="bi fs-6"
                                                :class="item.is_active
                                                ? 'bi-eye-slash text-warning'
                                                : 'bi-check-circle text-success'"
                                            ></i>
                                        </button>
                                        <Link
                                            :href="route('admin.tour-packages.edit', item.id)"
                                            class="btn btn-icon btn-sm me-2"
                                        >
                                            <i class="bi bi-pencil-fill text-primary fs-6"></i>
                                        </Link>

                                        <button
                                            @click="confirmDelete(item.id, item.title)"
                                            class="btn btn-icon btn-sm"
                                        >
                                            <i class="bi bi-trash3-fill text-danger fs-6"></i>
                                        </button>

                                    </td>
                                </tr>

                                <tr v-if="packages.data.length === 0">
                                    <td colspan="7" class="text-center py-10 text-muted">
                                        No packages found
                                    </td>
                                </tr>

                                </tbody>
                            </table>

                        </div>

                        <Pagination :links="packages.links" />

                    </div>
                </div>
            </div>
        </div>

    </AdminLayout>
</template>
