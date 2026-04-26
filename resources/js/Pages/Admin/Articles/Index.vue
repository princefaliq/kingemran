<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head, Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'
import Pagination from '@/Components/Pagination.vue'

const props = defineProps({
    articles: Object,
    filters: Object
})

const search = ref(props.filters.search || '')
const sort = ref(props.filters.sort || 'id')
const direction = ref(props.filters.direction || 'desc')

const reload = () => {
    router.get(route('admin.articles.index'), {
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
        if (confirm(`Yakin hapus Article ${title}?`)) {
            router.delete(route('admin.articles.destroy', id))
        }
        return
    }

    window.Swal.fire({
        title: 'Yakin?',
        text: `Article "${title}" akan dihapus!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('admin.articles.destroy', id))
        }
    })
}

</script>

<template>
    <Head title="Articles" />

    <AdminLayout>

        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="d-flex text-gray-900 fw-bold my-1 fs-3">Articles</h1>

                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                        <li class="breadcrumb-item">
                            <Link :href="route('admin.dashboard')" class="text-gray-600 text-hover-primary">
                                Dashboard
                            </Link>
                        </li>
                        <li class="breadcrumb-item">Articles</li>
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

                    <Link :href="route('admin.articles.create')" class="btn btn-dark fw-bold">
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
                            <h3 class="fw-bold m-0">List Articles</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive table-loading">

                            <table class="table table-striped table-rounded table-row-bordered border gs-5">
                                <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th @click="sortBy('title')" style="cursor:pointer" class="align-middle">Title</th>
                                    <th class="align-middle">Category</th>
                                    <th class="align-middle">Author</th>
                                    <th class="align-middle">Status</th>
                                    <th class="align-middle" @click="sortBy('created_at')" style="cursor:pointer">Created</th>
                                    <th class="text-end">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr v-for="article in articles.data" :key="article.id">

                                    <td class="align-middle">{{ article.title }}</td>

                                    <td class="align-middle">{{ article.category?.name ?? '-' }}</td>

                                    <td class="align-middle">{{ article.user?.name ?? '-' }}</td>

                                    <td class="align-middle">
                                          <span
                                              class="badge"
                                              :class="article.status === 'published'
                                              ? 'badge-light-success'
                                              : 'badge-light-warning'"
                                          >
                                            {{ article.status }}
                                          </span>
                                    </td>

                                    <td class="align-middle">
                                        {{ article.created_at_formatted ?? article.created_at }}
                                    </td>

                                    <td class="text-end">

                                        <Link
                                            :href="route('admin.articles.edit', article.id)"
                                            class="btn btn-icon btn-sm me-2"
                                        >
                                            <i class="bi bi-pencil-fill text-primary fs-6"></i>
                                        </Link>

                                        <button
                                            @click="confirmDelete(article.id, article.title)"
                                            class="btn btn-icon btn-sm"
                                        >
                                            <i class="bi bi-trash3-fill text-danger fs-6"></i>
                                        </button>

                                    </td>
                                </tr>

                                <tr v-if="articles.data.length === 0">
                                    <td colspan="6" class="text-center py-10 text-muted">
                                        No articles found
                                    </td>
                                </tr>

                                </tbody>
                            </table>

                        </div>

                        <Pagination :links="articles.links" />

                    </div>
                </div>
            </div>
        </div>

    </AdminLayout>
</template>

<style scoped>

</style>
