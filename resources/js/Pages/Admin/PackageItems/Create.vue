<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

const props = defineProps({
    tourPackages: Array
})

const form = useForm({
    tour_package_id: null,
    type: 'include',
    name: ''
})

const save = () => {
    form.post(route('admin.package-items.store'))
}
</script>

<template>
    <Head title="Create Package Item" />

    <AdminLayout>

        <!-- TOOLBAR -->
        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="fw-bold fs-3">Package Items</h1>

                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                        <li class="breadcrumb-item">
                            <Link :href="route('admin.dashboard')">Dashboard</Link>
                        </li>
                        <li class="breadcrumb-item">Package Items</li>
                        <li class="breadcrumb-item">Create</li>
                    </ul>
                </div>

                <div class="d-flex align-items-center">
                    <Link :href="route('admin.package-items.index')" class="btn btn-light me-3">
                        Back
                    </Link>

                    <button
                        type="button"
                        class="btn btn-dark"
                        @click="save"
                        :disabled="form.processing"
                    >
                        Save
                    </button>
                </div>
            </div>
        </template>

        <!-- FORM -->
        <div class="card">
            <div class="card-body">

                <form @submit.prevent="save">

                    <!-- TOUR PACKAGE -->
                    <div class="mb-5">
                        <label class="form-label">Tour Package</label>

                        <select class="form-select" v-model="form.tour_package_id">
                            <option :value="null">Select Package</option>
                            <option v-for="p in tourPackages" :key="p.id" :value="p.id">
                                {{ p.title }}
                            </option>
                        </select>

                        <div v-if="form.errors.tour_package_id" class="text-danger mt-1">
                            {{ form.errors.tour_package_id }}
                        </div>
                    </div>

                    <!-- TYPE -->
                    <div class="mb-5">
                        <label class="form-label">Type</label>

                        <select class="form-select" v-model="form.type">
                            <option value="include">Include</option>
                            <option value="exclude">Exclude</option>
                        </select>

                        <div v-if="form.errors.type" class="text-danger mt-1">
                            {{ form.errors.type }}
                        </div>
                    </div>

                    <!-- NAME -->
                    <div class="mb-5">
                        <label class="form-label">Item Name</label>

                        <input
                            type="text"
                            class="form-control"
                            v-model="form.name"
                        />

                        <div v-if="form.errors.name" class="text-danger mt-1">
                            {{ form.errors.name }}
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </AdminLayout>
</template>
