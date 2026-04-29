<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head, Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'
import Pagination from '@/Components/Pagination.vue'

const props = defineProps({
    partners: Object,
    filters: Object
})

const search = ref(props.filters.search || '')
const sort = ref(props.filters.sort || 'id')
const direction = ref(props.filters.direction || 'desc')

const reload = () => {
    router.get(route('admin.partners.index'), {
        search: search.value,
        sort: sort.value,
        direction: direction.value
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

const toggleStatus = (item) => {
    router.patch(route('admin.partners.update-status', item.id), {
        is_active: !item.is_active
    }, {
        preserveScroll: true
    })
}

const confirmDelete = (id, name) => {
    if (!window.Swal) {
        if (confirm(`Yakin hapus partner ${name}?`)) {
            router.delete(route('admin.partners.destroy', id))
        }
        return
    }

    window.Swal.fire({
        title: 'Yakin?',
        text: `Partner "${name}" akan dihapus!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('admin.partners.destroy', id))
        }
    })
}
</script>

<template>
    <Head title="Partners" />

    <AdminLayout>
        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="d-flex text-gray-900 fw-bold my-1 fs-3">Partners</h1>

                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                        <li class="breadcrumb-item">
                            <Link :href="route('admin.dashboard')" class="text-gray-600 text-hover-primary">
                                Dashboard
                            </Link>
                        </li>
                        <li class="breadcrumb-item">Partners</li>
                        <li class="breadcrumb-item">List</li>
                    </ul>
                </div>

                <div class="d-flex align-items-center py-2 py-md-1">
                    <div class="me-3">
                        <input
                            v-model="search"
                            @input="reload"
                            type="text"
                            placeholder="Search partner..."
                            class="form-control"
                        />
                    </div>

                    <Link :href="route('admin.partners.create')" class="btn btn-dark fw-bold">
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
                            <h3 class="fw-bold m-0">List Partners</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive table-loading">
                            <table class="table table-striped table-rounded table-row-bordered border gs-5">
                                <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th>Logo</th>
                                    <th @click="sortBy('name')" style="cursor:pointer">Name</th>
                                    <th>URL</th>
                                    <th @click="sortBy('is_active')" style="cursor:pointer">Status</th>
                                    <th @click="sortBy('created_at')" style="cursor:pointer">Created</th>
                                    <th class="text-end">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr v-for="item in partners.data" :key="item.id">
                                    <td class="align-middle">
                                        <img
                                            v-if="item.logo_url"
                                            :src="item.logo_url"
                                            alt="logo"
                                            style="width:50px;height:50px;object-fit:contain;"
                                        />
                                        <span v-else class="text-muted">-</span>
                                    </td>

                                    <td class="align-middle">{{ item.name }}</td>

                                    <td class="align-middle">
                                        <a
                                            v-if="item.url"
                                            :href="item.url"
                                            target="_blank"
                                            class="text-primary"
                                        >
                                            {{ item.url }}
                                        </a>
                                        <span v-else>-</span>
                                    </td>

                                    <td class="align-middle">
                                        <span
                                            class="badge"
                                            :class="item.is_active ? 'badge-light-success' : 'badge-light-danger'"
                                        >
                                            {{ item.is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>

                                    <td class="align-middle">
                                        {{ item.created_at_formatted ?? item.created_at }}
                                    </td>

                                    <td class="text-end">
                                        <button
                                            @click="toggleStatus(item)"
                                            class="btn btn-icon btn-sm me-2"
                                            :title="item.is_active ? 'Nonaktifkan' : 'Aktifkan'"
                                        >
                                            <i
                                                class="bi fs-6"
                                                :class="item.is_active ? 'bi-eye-slash text-warning' : 'bi-check-circle text-success'"
                                            ></i>
                                        </button>

                                        <Link
                                            :href="route('admin.partners.edit', item.id)"
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

                                <tr v-if="partners.data.length === 0">
                                    <td colspan="6" class="text-center py-10 text-muted">
                                        No partners found
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <Pagination :links="partners.links" />
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<style scoped>
</style>
