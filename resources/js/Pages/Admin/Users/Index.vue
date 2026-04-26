<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import {Head, Link, router} from "@inertiajs/vue3";
import { ref } from 'vue';
import Pagination from '@/Components/Pagination.vue'
const props = defineProps({
    users: Object,
    filters: Object
})

const search = ref(props.filters.search || '')
const sort = ref(props.filters.sort || 'id')
const direction = ref(props.filters.direction || 'desc')

const reload = () => {
    router.get(route('admin.users.index'), {
        search: search.value,
        sort: sort.value,
        direction: direction.value
    }, {
        preserveState: true,
        replace: true
    })
}
const confirmDelete = (id, name) => {
    if (!window.Swal) {
        // fallback kalau SweetAlert belum ke-load
        if (confirm(`Yakin hapus user ${name}?`)) {
            router.delete(route('admin.users.destroy', id))
        }
        return
    }

    window.Swal.fire({
        title: 'Yakin?',
        text: `User "${name}" akan dihapus permanen!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('admin.users.destroy', id))
        }
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
</script>

<template>
    <Head title="Users" />
    <AdminLayout>
        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column me-3">
                    <!--begin::Title-->
                    <h1 class="d-flex text-gray-900 fw-bold my-1 fs-3">Users</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-gray-600">
                            <Link :href="route('admin.dashboard')" class="text-gray-600 text-hover-primary">Dashboard</Link>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-gray-600">Users</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-gray-500">List</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center py-2 py-md-1">
                    <!--begin::Wrapper-->
                    <div class="me-3">
                        <!--begin::Menu-->
                        <input
                            v-model="search"
                            @input="reload"
                            type="text"
                            placeholder="Search..."
                            class="form-control form-control"
                        />
                        <!--end::Menu 1-->
                        <!--end::Menu-->
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Button-->
                    <Link :href="route('admin.users.create')" class="btn btn-dark fw-bold">Create</Link>
                    <!--end::Button-->
                </div>
                <!--end::Actions-->
            </div>
        </template>
        <!--begin::Row-->
        <div class="row g-5 g-lg-12">
            <!--begin::Col-->
            <div class="col-xl-12 mb-xl-10">
                <!--begin::Mixed Widget 18-->
                <div class="card h-md-100">
                    <!--begin::Beader-->
                    <div class="card-header border-0 py-5">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">List Users</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-loading">
                            <table class="table table-striped table-rounded table-row-bordered border gs-5">
                                <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th @click="sortBy('name')" style="cursor:pointer">
                                        Name
                                    </th>
                                    <th @click="sortBy('email')" style="cursor:pointer">
                                        Email
                                    </th>
                                    <th>
                                        Permissions
                                    </th>
                                    <th class="text-end">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr v-for="user in users.data" :key="user.id" class="fs-6">
                                    <td class="align-middle">{{ user.name }}</td>
                                    <td class="align-middle">{{ user.email }}</td>
                                    <td class="align-middle">
                                        <span
                                            v-for="p in user.permissions"
                                            :key="p.id"
                                            class="badge badge-light-primary me-1"
                                        >
                                          {{ p.name }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <!-- Edit -->
                                        <Link
                                            :href="route('admin.users.edit', user.id)"
                                            class="btn btn-icon btn-sm me-2"
                                        >
                                            <i class="bi bi-pencil-fill text-primary fs-6"></i>
                                        </Link>

                                        <!-- Delete -->
                                        <button
                                            @click="confirmDelete(user.id, user.name)"
                                            class="btn btn-icon btn-sm"
                                        >
                                            <i class="bi bi-trash3-fill text-danger fs-6"></i>
                                        </button>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="text-right">
                            <Pagination :links="users.links" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<style scoped>

</style>
