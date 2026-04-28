<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, router } from "@inertiajs/vue3";
import { ref } from 'vue';
import Pagination from '@/Components/Pagination.vue'

const props = defineProps({
    spaPrograms: Object,
    filters: Object
})

const search = ref(props.filters.search || '')
const sort = ref(props.filters.sort || 'id')
const direction = ref(props.filters.direction || 'desc')

const reload = () => {
    router.get(route('admin.spa-programs.index'), {
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

const confirmDelete = (id, name) => {
    if (!window.Swal) {
        if (confirm(`Yakin hapus paket ${name}?`)) {
            router.delete(route('admin.spa-programs.destroy', id))
        }
        return
    }

    window.Swal.fire({
        title: 'Yakin?',
        text: `Paket "${name}" akan dihapus!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('admin.spa-programs.destroy', id))
        }
    })
}

const formatHarga = (value) => {
    if (!value) return '-'
    return new Intl.NumberFormat('id-ID').format(value)
}
</script>

<template>
    <Head title="SPA Programs" />

    <AdminLayout>

        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="d-flex text-gray-900 fw-bold my-1 fs-3">SPA Programs</h1>
                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                        <li class="breadcrumb-item text-gray-600">
                            <Link :href="route('admin.dashboard')" class="text-gray-600 text-hover-primary">
                                Dashboard
                            </Link>
                        </li>
                        <li class="breadcrumb-item text-gray-600">SPA Programs</li>
                        <li class="breadcrumb-item text-gray-600">List</li>
                    </ul>
                </div>

                <div class="d-flex align-items-center py-2 py-md-1">
                    <div class="me-3">
                        <input
                            v-model="search"
                            @input="reload"
                            type="text"
                            placeholder="Search paket..."
                            class="form-control"
                        />
                    </div>

                    <Link :href="route('admin.spa-programs.create')" class="btn btn-dark fw-bold">
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
                            <h3 class="fw-bold m-0">List SPA Programs</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive table-loading">
                            <table class="table table-striped table-rounded table-row-bordered border gs-5">
                                <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th>Image</th>
                                    <th @click="sortBy('nama_paket')" style="cursor:pointer">Nama Paket</th>
                                    <th>Deskripsi</th>
                                    <th @click="sortBy('harga')" style="cursor:pointer">Harga</th>
                                    <th>Status</th>
                                    <th @click="sortBy('created_at')" style="cursor:pointer">Created</th>
                                    <th class="text-end">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr v-for="item in spaPrograms.data" :key="item.id">

                                    <!-- GAMBAR -->
                                    <td class="align-middle">
                                        <img
                                            v-if="item.gambar"
                                            :src="item.gambar_url"
                                            alt="gambar"
                                            style="width:40px;height:40px;object-fit:cover;border-radius:50%;"
                                        />
                                        <span v-else class="text-muted">-</span>
                                    </td>

                                    <!-- NAMA -->
                                    <td class="align-middle">{{ item.nama_paket }}</td>

                                    <!-- DESKRIPSI -->
                                    <td class="align-middle">
                                        {{ item.deskripsi || '-' }}
                                    </td>

                                    <!-- HARGA -->
                                    <td class="align-middle">
                                        Rp {{ formatHarga(item.harga) }}
                                    </td>

                                    <!-- STATUS -->
                                    <td class="align-middle">
                                        <span
                                            :class="item.is_active ? 'badge badge-light-success' : 'badge badge-light-danger'">
                                            {{ item.is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>

                                    <!-- CREATED -->
                                    <td class="align-middle">
                                        {{ item.created_at_formatted }}
                                    </td>

                                    <!-- ACTION -->
                                    <td class="text-end">
                                        <Link
                                            :href="route('admin.spa-programs.edit', item.id)"
                                            class="btn btn-icon btn-sm me-2"
                                        >
                                            <i class="bi bi-pencil-fill text-primary fs-6"></i>
                                        </Link>

                                        <button
                                            @click="confirmDelete(item.id, item.nama_paket)"
                                            class="btn btn-icon btn-sm"
                                        >
                                            <i class="bi bi-trash3-fill text-danger fs-6"></i>
                                        </button>
                                    </td>
                                </tr>

                                <tr v-if="spaPrograms.data.length === 0">
                                    <td colspan="7" class="text-center py-10 text-muted">
                                        No data found
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <Pagination :links="spaPrograms.links" />
                    </div>
                </div>
            </div>
        </div>

    </AdminLayout>
</template>

<style scoped>
</style>
