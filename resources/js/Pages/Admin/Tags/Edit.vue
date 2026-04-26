<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from "@inertiajs/vue3";
import Form from './Form.vue';

const props = defineProps({
    tag: Object
})

const form = useForm({
    name: props.tag.name
})

const submit = () => {
    form.put(route('admin.tags.update', props.tag.id))
}
</script>

<template>
    <Head title="Edit Tag" />

    <AdminLayout>

        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="text-gray-900 fw-bold fs-3">Edit Tag</h1>
                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                        <li class="breadcrumb-item">
                            <Link :href="route('admin.dashboard')">Dashboard</Link>
                        </li>
                        <li class="breadcrumb-item">
                            <Link :href="route('admin.tags.index')">Tags</Link>
                        </li>
                        <li class="breadcrumb-item">Edit</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center py-2 py-md-1">
                    <Link :href="route('admin.tags.index')" class="btn btn-light fw-bold me-3">
                        Back
                    </Link>

                    <button
                        type="button"
                        class="btn btn-dark fw-bold"
                        :disabled="form.processing"
                        @click="submit"
                    >
                        Update
                    </button>
                </div>
            </div>
        </template>

        <Form :form="form" />

    </AdminLayout>
</template>

<style scoped>

</style>
