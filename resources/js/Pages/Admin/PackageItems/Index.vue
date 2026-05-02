<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head, Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'
import Pagination from '@/Components/Pagination.vue'

const props = defineProps({
    packageItems: Object,
    filters: Object,
    packages: Array // 🔥 untuk dropdown
})

const search = ref(props.filters.search || '')
const sort = ref(props.filters.sort || 'id')
const direction = ref(props.filters.direction || 'desc')
const packageFilter = ref(props.filters.package || '')

const reload = () => {
    router.get(route('admin.package-items.index'), {
        search: search.value,
        sort: sort.value,
        direction: direction.value,
        package: packageFilter.value // 🔥 penting
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
        if (confirm(`Yakin hapus item ${name}?`)) {
            router.delete(route('admin.package-items.destroy', id))
        }
        return
    }

    window.Swal.fire({
        title: 'Yakin?',
        text: `Item "${name}" akan dihapus!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('admin.package-items.destroy', id))
        }
    })
}
</script>

<template>
    <Head title="Package Items" />

    <AdminLayout>

        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="d-flex text-gray-900 fw-bold my-1 fs-3">Package Items</h1>

                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                        <li class="breadcrumb-item">
                            <Link :href="route('admin.dashboard')" class="text-gray-600 text-hover-primary">
                                Dashboard
                            </Link>
                        </li>
                        <li class="breadcrumb-item">Package Items</li>
                        <li class="breadcrumb-item">List</li>
                    </ul>
                </div>

                <div class="d-flex align-items-center py-2 py-md-1">

                    <!-- 🔥 FILTER PACKAGE -->
                    <div class="me-3">
                        <select
                            v-model="packageFilter"
                            @change="reload"
                            class="form-select"
                        >
                            <option value="">All Package</option>
                            <option
                                v-for="p in packages"
                                :key="p.id"
                                :value="p.id"
                            >
                                {{ p.title }}
                            </option>
                        </select>
                    </div>

                    <!-- SEARCH -->
                    <div class="me-3">
                        <input
                            v-model="search"
                            @input="reload"
                            type="text"
                            placeholder="Search..."
                            class="form-control"
                        />
                    </div>

                    <Link :href="route('admin.package-items.create')" class="btn btn-dark fw-bold">
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
                            <h3 class="fw-bold m-0">List Package Items</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive table-loading">

                            <table class="table table-striped table-rounded table-row-bordered border gs-5">
                                <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th @click="sortBy('name')" style="cursor:pointer">Name</th>
                                    <th>Type</th>
                                    <th>Tour Package</th>
                                    <th @click="sortBy('created_at')" style="cursor:pointer">Created</th>
                                    <th class="text-end">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr v-for="item in packageItems.data" :key="item.id">

                                    <td class="align-middle">{{ item.name }}</td>

                                    <td class="align-middle">
                                        <span
                                            class="badge"
                                            :class="item.type === 'include'
                                            ? 'badge-light-success'
                                            : 'badge-light-danger'"
                                        >
                                            {{ item.type }}
                                        </span>
                                    </td>

                                    <td class="align-middle">
                                        <span
                                            v-if="item.tour_package"
                                            class="badge badge-light-info"
                                        >
                                            {{ item.tour_package.title }}
                                        </span>

                                        <span v-else class="badge badge-light-secondary">
                                            -
                                        </span>
                                    </td>

                                    <td class="align-middle">
                                        {{ item.created_at_formatted ?? item.created_at }}
                                    </td>

                                    <td class="text-end">

                                        <Link
                                            :href="route('admin.package-items.edit', item.id)"
                                            class="btn btn-icon btn-sm me-2"
                                        >
                                            <i class="bi bi-pencil-fill text-primary fs-6"></i>
                                        </Link>

                                        <button
                                            @click="confirmDelete(item.id, item.name)"
                                            class="btn btn-icon btn-sm"
                                        >
                                            <i class="bi bi-trash3-fill text-danger fs-6"></i>
                                        </button>

                                    </td>
                                </tr>

                                <tr v-if="packageItems.data.length === 0">
                                    <td colspan="5" class="text-center py-10 text-muted">
                                        No data found
                                    </td>
                                </tr>

                                </tbody>
                            </table>

                        </div>

                        <Pagination :links="packageItems.links" />

                    </div>
                </div>
            </div>
        </div>

    </AdminLayout>
</template>
