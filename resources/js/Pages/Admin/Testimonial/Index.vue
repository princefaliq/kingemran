<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head, Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'
import Pagination from '@/Components/Pagination.vue'

const props = defineProps({
    testimonials: Object,
    filters: Object
})

const search = ref(props.filters.search || '')
const sort = ref(props.filters.sort || 'id')
const direction = ref(props.filters.direction || 'desc')

const reload = () => {
    router.get(route('admin.testimonials.index'), {
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
    router.patch(route('admin.testimonials.update-status', item.id), {
        is_active: !item.is_active
    }, {
        preserveScroll: true
    })
}

const confirmDelete = (id, name) => {
    if (!window.Swal) {
        if (confirm(`Yakin hapus testimoni dari ${name}?`)) {
            router.delete(route('admin.testimonials.destroy', id))
        }
        return
    }

    window.Swal.fire({
        title: 'Yakin?',
        text: `Testimoni dari "${name}" akan dihapus!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('admin.testimonials.destroy', id))
        }
    })
}
</script>

<template>
    <Head title="Testimonials" />

    <AdminLayout>
        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="d-flex text-gray-900 fw-bold my-1 fs-3">Testimonials</h1>

                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                        <li class="breadcrumb-item">
                            <Link :href="route('admin.dashboard')" class="text-gray-600 text-hover-primary">
                                Dashboard
                            </Link>
                        </li>
                        <li class="breadcrumb-item">Testimonials</li>
                        <li class="breadcrumb-item">List</li>
                    </ul>
                </div>

                <div class="d-flex align-items-center py-2 py-md-1">
                    <div class="me-3">
                        <input
                            v-model="search"
                            @input="reload"
                            type="text"
                            placeholder="Search testimonial..."
                            class="form-control"
                        />
                    </div>
                </div>
            </div>
        </template>

        <div class="row g-5 g-lg-12">
            <div class="col-xl-12 mb-xl-10">
                <div class="card h-md-100">
                    <div class="card-header border-0 py-5">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">List Testimonials</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive table-loading">
                            <table class="table table-striped table-rounded table-row-bordered border gs-5">
                                <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th @click="sortBy('name')" style="cursor:pointer">Nama</th>
                                    <th>Program</th>
                                    <th>Testimoni</th>
                                    <th @click="sortBy('is_active')" style="cursor:pointer">Status</th>
                                    <th @click="sortBy('created_at')" style="cursor:pointer">Created</th>
                                    <th class="text-end">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr v-for="item in testimonials.data" :key="item.id">
                                    <td class="align-middle">{{ item.name }}</td>

                                    <td class="align-middle">
                                        {{ item.spa_program?.nama_paket ?? '-' }}
                                    </td>

                                    <td class="align-middle">
                                        {{ item.content.length > 100 ? item.content.substring(0, 100) + '...' : item.content }}
                                    </td>

                                    <td class="align-middle">
                                        <span
                                            class="badge"
                                            :class="item.is_active ? 'badge-light-success' : 'badge-light-warning'"
                                        >
                                            {{ item.is_active ? 'Active' : 'Pending' }}
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

                                        <button
                                            @click="confirmDelete(item.id, item.name)"
                                            class="btn btn-icon btn-sm"
                                        >
                                            <i class="bi bi-trash3-fill text-danger fs-6"></i>
                                        </button>
                                    </td>
                                </tr>

                                <tr v-if="testimonials.data.length === 0">
                                    <td colspan="6" class="text-center py-10 text-muted">
                                        No testimonials found
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <Pagination :links="testimonials.links" />
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<style scoped>
</style>
