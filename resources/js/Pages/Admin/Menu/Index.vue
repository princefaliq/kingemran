<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, router } from "@inertiajs/vue3";
import { ref } from 'vue';
import Pagination from '@/Components/Pagination.vue'

const props = defineProps({
    menus: Object,
    filters: Object
})

const search = ref(props.filters.search || '')
const sort = ref(props.filters.sort || 'id')
const direction = ref(props.filters.direction || 'desc')

const reload = () => {
    router.get(route('admin.menu.index'), {
        search: search.value,
        sort: sort.value,
        direction: direction.value,
        type: type.value,
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
        if (confirm(`Yakin hapus menu ${name}?`)) {
            router.delete(route('admin.menu.destroy', id))
        }
        return
    }

    window.Swal.fire({
        title: 'Yakin?',
        text: `Menu "${name}" dan seluruh sub-menu di bawahnya akan dihapus!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('admin.menu.destroy', id))
        }
    })
}
const type = ref(props.filters.type || '')

const renderChildren = (items, level = 1) => {
    if (!items || !items.length) return []

    let rows = []

    items.forEach(item => {
        rows.push({ ...item, _level: level })

        if (item.children && item.children.length) {
            rows = rows.concat(renderChildren(item.children, level + 1))
        }
    })

    return rows
}
</script>

<template>
    <Head title="Menu Manager" />
    <AdminLayout>
        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="d-flex text-gray-900 fw-bold my-1 fs-3">Menu Manager</h1>
                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                        <li class="breadcrumb-item text-gray-600">
                            <Link :href="route('admin.dashboard')" class="text-gray-600 text-hover-primary">
                                Dashboard
                            </Link>
                        </li>
                        <li class="breadcrumb-item text-gray-600">Menu Manager</li>
                        <li class="breadcrumb-item text-gray-600">List</li>
                    </ul>
                </div>

                <div class="d-flex align-items-center py-2 py-md-1">
                    <div class="me-3">
                        <select v-model="type" @change="reload" class="form-select" aria-label="Select example">
                            <option value="">All Type</option>
                            <option value="page">Page</option>
                            <option value="url">External URL</option>
                            <option value="route">Internal Route</option>
                            <option value="group">Dropdown / Group</option>
                        </select>
                    </div>
                    <div class="me-3">
                        <input
                            v-model="search"
                            @input="reload"
                            type="text"
                            placeholder="Search menu..."
                            class="form-control"
                        />
                    </div>
                    <Link :href="route('admin.menu.reorder')" class="btn btn-primary fw-bold me-2">
                        Reorder
                    </Link>
                    <Link :href="route('admin.menu.create')" class="btn btn-dark fw-bold">
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
                            <h3 class="fw-bold m-0">List Menu</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-rounded table-row-bordered border gs-5">
                                <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th @click="sortBy('name')" style="cursor:pointer">Name</th>
                                    <th @click="sortBy('link')" style="cursor:pointer">Link</th>
                                    <th @click="sortBy('parent_id')" style="cursor:pointer">Parent</th>
                                    <th>Type</th>
                                    <th @click="sortBy('created_at')" style="cursor:pointer">Created</th>
                                    <th class="text-end">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <template v-for="menu in menus.data" :key="menu.id">

                                    <!-- ================= PARENT ================= -->
                                    <tr class="align-middle fw-bold">
                                        <td>{{ menu.name }}</td>
                                        <td>{{ menu.link ?? '-' }}</td>
                                        <td>-</td>

                                        <td>
                                            <span
                                                class="badge badge-outline"
                                                :class="{
                                                    'badge-primary': menu.type === 'page',
                                                    'badge-success': menu.type === 'route',
                                                    'badge-warning': menu.type === 'url',
                                                    'badge-info': menu.type === 'group'
                                                }"
                                            >
                                                {{ menu.type_label }}
                                            </span>
                                        </td>


                                        <td>
                                            {{ menu.created_at_formatted ?? menu.created_at }}
                                        </td>

                                        <td class="text-end">
                                            <!-- EDIT -->
                                            <Link
                                                :href="route('admin.menu.edit', menu.id)"
                                                class="btn btn-icon btn-sm me-2"
                                            >
                                                <i class="bi bi-pencil-fill text-primary fs-6"></i>
                                            </Link>

                                            <!-- DELETE -->
                                            <button
                                                class="btn btn-icon btn-sm"
                                                @click="confirmDelete(menu.id, menu.name)"
                                            >
                                                <i class="bi bi-trash3-fill text-danger fs-6"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- ================= CHILD ================= -->
                                    <tr
                                        v-for="child in renderChildren(menu.children)"
                                        :key="child.id"
                                        class="align-middle text-gray-600"
                                    >
                                        <td :class="'ps-' + (child._level * 5)">
                                            <i class="bi bi-arrow-return-right me-2"></i>
                                            {{ child.name }}
                                        </td>

                                        <td>
                                            {{ child.link ?? '-' }}
                                        </td>

                                        <td>
                                            {{ menu.name }}
                                        </td>

                                        <td>
                                            <span
                                                class="badge badge-outline "
                                                :class="{
                                                    'badge-primary': child.type === 'page',
                                                    'badge-success': child.type === 'route',
                                                    'badge-warning': child.type === 'url',
                                                    'badge-info': child.type === 'group'
                                                }"
                                            >
                                                {{ child.type_label }}
                                            </span>
                                        </td>


                                        <td>
                                            {{ child.created_at_formatted ?? child.created_at }}
                                        </td>

                                        <td class="text-end">
                                            <!-- EDIT -->
                                            <Link
                                                :href="route('admin.menu.edit', child.id)"
                                                class="btn btn-icon btn-sm me-2"
                                            >
                                                <i class="bi bi-pencil-fill text-primary fs-6"></i>
                                            </Link>

                                            <!-- DELETE -->
                                            <button
                                                class="btn btn-icon t btn-sm"
                                                @click="confirmDelete(child.id, child.name)"
                                            >
                                                <i class="bi bi-trash3-fill text-danger fs-6"></i>
                                            </button>
                                        </td>
                                    </tr>

                                </template>
                                <tr v-if="menus.data.length === 0">
                                    <td colspan="6" class="text-center py-10 text-muted">
                                        Data Not Found
                                    </td>
                                </tr>
                                </tbody>

                            </table>
                        </div>

                        <Pagination :links="menus.links" />
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<style scoped>

</style>
