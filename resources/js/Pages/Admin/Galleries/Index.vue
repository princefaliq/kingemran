<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head, Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'
import Pagination from '@/Components/Pagination.vue'

const props = defineProps({
    galleries: Object,
    filters: Object
})

const search = ref(props.filters.search || '')
const sort = ref(props.filters.sort || 'id')
const direction = ref(props.filters.direction || 'desc')

const reload = () => {
    router.get(route('admin.galleries.index'), {
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

const confirmDelete = (id, title) => {
    if (!window.Swal) {
        if (confirm(`Yakin hapus Galeri ${title}?`)) {
            router.delete(route('admin.galleries.destroy', id))
        }
        return
    }

    window.Swal.fire({
        title: 'Yakin?',
        text: `Galeri "${title}" akan dihapus!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('admin.galleries.destroy', id))
        }
    })
}
</script>

<template>
    <Head title="Galleries" />

    <AdminLayout>

        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="d-flex text-gray-900 fw-bold my-1 fs-3">Galleries</h1>

                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                        <li class="breadcrumb-item">
                            <Link :href="route('admin.dashboard')" class="text-gray-600 text-hover-primary">
                                Dashboard
                            </Link>
                        </li>
                        <li class="breadcrumb-item">Galleries</li>
                        <li class="breadcrumb-item">List</li>
                    </ul>
                </div>

                <div class="d-flex align-items-center py-2 py-md-1">
                    <div class="me-3">
                        <input
                            v-model="search"
                            @input="reload"
                            type="text"
                            placeholder="Search..."
                            class="form-control"
                        />
                    </div>

                    <Link :href="route('admin.galleries.create')" class="btn btn-dark fw-bold">
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
                            <h3 class="fw-bold m-0">List Galleries</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive table-loading">

                            <table class="table table-striped table-rounded table-row-bordered border gs-5">
                                <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th @click="sortBy('title')" style="cursor:pointer">Title</th>
                                    <th>Type</th>
                                    <th>Preview</th>
                                    <th>Status</th>
                                    <th @click="sortBy('created_at')" style="cursor:pointer">Created</th>
                                    <th class="text-end">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr v-for="gallery in galleries.data" :key="gallery.id">

                                    <!-- Title -->
                                    <td class="align-middle">
                                        {{ gallery.title ?? '-' }}
                                    </td>

                                    <!-- Type -->
                                    <td class="align-middle">
                                        <span
                                            class="badge"
                                            :class="gallery.type === 'image'
                                            ? 'badge-light-primary'
                                            : 'badge-light-danger'"
                                        >
                                            {{ gallery.type }}
                                        </span>
                                    </td>

                                    <!-- Preview -->
                                    <td class="align-middle">

                                        <div style="width:100px;">

                                            <!-- IMAGE -->
                                            <div v-if="gallery.type === 'image'" class="ratio ratio-16x9">
                                                <img
                                                    :src="gallery.image_url"
                                                    class="w-100 h-100 rounded"
                                                    style="object-fit: cover;"
                                                />
                                            </div>

                                            <!-- YOUTUBE -->
                                            <a
                                                v-else-if="gallery.type === 'youtube'"
                                                :href="gallery.youtube_url"
                                                target="_blank"
                                            >
                                                <div class="ratio ratio-16x9 position-relative overflow-hidden rounded">

                                                    <!-- THUMB -->
                                                    <img
                                                        :src="gallery.youtube_thumbnail"
                                                        class="w-100 h-100"
                                                        style="object-fit: cover;"
                                                    />

                                                    <!-- OVERLAY FLEX CENTER -->
                                                    <div
                                                        class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center"
                                                    >
                                                        <span
                                                            style="
                                                                background: rgba(0,0,0,0.5);
                                                                width:40px;
                                                                height:40px;
                                                                border-radius:50%;
                                                                display:flex;
                                                                justify-content:center;
                                                                align-items:center;
                                                                color:white;
                                                                font-size:18px;
                                                            "
                                                        >
                                                            ▶
                                                        </span>
                                                    </div>

                                                </div>
                                            </a>

                                        </div>

                                    </td>

                                    <!-- Status -->
                                    <td class="align-middle">
                                        <span
                                            class="badge"
                                            :class="gallery.is_active
                                            ? 'badge-light-success'
                                            : 'badge-light-secondary'"
                                        >
                                            {{ gallery.is_active ? 'Active' : 'Hidden' }}
                                        </span>
                                    </td>

                                    <!-- Created -->
                                    <td class="align-middle">
                                        {{ gallery.created_at_formatted ?? gallery.created_at }}
                                    </td>

                                    <!-- Action -->
                                    <td class="text-end">

                                        <Link
                                            :href="route('admin.galleries.edit', gallery.id)"
                                            class="btn btn-icon btn-sm me-2"
                                        >
                                            <i class="bi bi-pencil-fill text-primary fs-6"></i>
                                        </Link>

                                        <button
                                            @click="confirmDelete(gallery.id, gallery.title)"
                                            class="btn btn-icon btn-sm"
                                        >
                                            <i class="bi bi-trash3-fill text-danger fs-6"></i>
                                        </button>

                                    </td>
                                </tr>

                                <tr v-if="galleries.data.length === 0">
                                    <td colspan="6" class="text-center py-10 text-muted">
                                        No galleries found
                                    </td>
                                </tr>

                                </tbody>
                            </table>

                        </div>

                        <Pagination :links="galleries.links" />

                    </div>
                </div>
            </div>
        </div>

    </AdminLayout>
</template>

<style scoped>
</style>
