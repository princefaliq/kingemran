<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

const props = defineProps({
    itinerary: Object,
    tourPackages: Array
})

const form = useForm({
    tour_package_id: props.itinerary.tour_package_id,
    day: props.itinerary.day,
    title: props.itinerary.title,
    description: props.itinerary.description ?? ''
})

const save = () => {
    form.put(route('admin.itineraries.update', props.itinerary.id))
}
</script>

<template>
    <Head title="Edit Itinerary" />

    <AdminLayout>

        <!-- TOOLBAR -->
        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="fw-bold fs-3">Itineraries</h1>

                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                        <li class="breadcrumb-item">
                            <Link :href="route('admin.dashboard')">Dashboard</Link>
                        </li>
                        <li class="breadcrumb-item">Itineraries</li>
                        <li class="breadcrumb-item">Edit</li>
                    </ul>
                </div>

                <div class="d-flex align-items-center">
                    <Link :href="route('admin.itineraries.index')" class="btn btn-light me-3">
                        Back
                    </Link>

                    <button
                        type="button"
                        class="btn btn-dark"
                        @click="save"
                        :disabled="form.processing"
                    >
                        Update
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

                    <!-- DAY -->
                    <div class="mb-5">
                        <label class="form-label">Day</label>

                        <input
                            type="number"
                            min="1"
                            class="form-control"
                            v-model="form.day"
                        />

                        <div v-if="form.errors.day" class="text-danger mt-1">
                            {{ form.errors.day }}
                        </div>
                    </div>

                    <!-- TITLE -->
                    <div class="mb-5">
                        <label class="form-label">Title</label>

                        <input
                            type="text"
                            class="form-control"
                            v-model="form.title"
                        />

                        <div v-if="form.errors.title" class="text-danger mt-1">
                            {{ form.errors.title }}
                        </div>
                    </div>

                    <!-- DESCRIPTION -->
                    <div class="mb-5">
                        <label class="form-label">Description</label>

                        <textarea
                            class="form-control"
                            rows="4"
                            v-model="form.description"
                        ></textarea>

                        <div v-if="form.errors.description" class="text-danger mt-1">
                            {{ form.errors.description }}
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </AdminLayout>
</template>
