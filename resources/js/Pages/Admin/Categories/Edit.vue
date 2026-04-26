<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
import { ref } from 'vue'
import Form from './Form.vue'

const props = defineProps({
    category: Object,
    parents: Array
})

const formRef = ref(null)

const update = () => {
    formRef.value.submit()
}
</script>

<template>
    <Head title="Edit Category" />

    <AdminLayout>
        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="fw-bold fs-3">Edit Category</h1>

                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                        <li class="breadcrumb-item">
                            <Link :href="route('admin.dashboard')" class="text-gray-600 text-hover-primary">
                                Dashboard
                            </Link>
                        </li>
                        <li class="breadcrumb-item">Categories</li>
                        <li class="breadcrumb-item">Edit</li>
                    </ul>
                </div>

                <div class="d-flex align-items-center">
                    <Link :href="route('admin.categories.index')" class="btn btn-light fw-bold me-3">
                        Back
                    </Link>

                    <button
                        type="button"
                        class="btn btn-primary fw-bold"
                        @click="update"
                    >
                        Update
                    </button>
                </div>
            </div>
        </template>

        <div class="card">
            <div class="card-header border-0 py-5">
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Edit Category</h3>
                </div>
            </div>

            <div class="card-body">
                <Form
                    ref="formRef"
                    :category="category"
                    :parents="parents"
                />
            </div>
        </div>
    </AdminLayout>
</template>

<style scoped>

</style>
