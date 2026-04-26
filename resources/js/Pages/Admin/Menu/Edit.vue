<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head, useForm, Link } from '@inertiajs/vue3'
import { computed, watch } from 'vue'

const props = defineProps({
    menu: Object,
    pages: Array,
    parents: Array
})

const form = useForm({
    name: props.menu.name,
    type: props.menu.type,
    link: props.menu.link ?? '',
    page_id: props.menu.page_id ?? '',
    parent_id: props.menu.parent_id ?? '',
})

const submit = () => {
    form.put(route('admin.menu.update', props.menu.id))
}

const showPageSelect = computed(() => form.type === 'page')
const showUrlInput = computed(() => form.type === 'url')
const showRouteInput = computed(() => form.type === 'route')
const isGroup = computed(() => form.type === 'group')
watch(() => form.type, (newType) => {
    form.link = ''
    form.page_id = ''
})
</script>


<template>
    <Head title="Edit Menu" />
    <AdminLayout>
        <!-- Toolbar -->
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
                        <li class="breadcrumb-item text-gray-600">Edit</li>
                    </ul>
                </div>

                <div class="d-flex align-items-center py-2 py-md-1">
                    <Link :href="route('admin.menu.index')" class="btn btn-light fw-bold me-3">
                        Back
                    </Link>

                    <button
                        type="button"
                        class="btn btn-dark fw-bold"
                        :disabled="form.processing"
                        @click="submit"
                    >
                        Save
                    </button>
                </div>
            </div>
        </template>
        <div class="card">
            <div class="card-header border-0 py-5">
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Create Menu</h3>
                </div>
            </div>

            <div class="card-body">

                <!-- NAME -->
                <div class="mb-5">
                    <label class="form-label">Menu Name</label>
                    <input v-model="form.name" type="text" class="form-control" />
                    <div v-if="form.errors.name" class="text-danger">
                        {{ form.errors.name }}
                    </div>
                </div>

                <!-- TYPE -->
                <div class="mb-5">
                    <label class="form-label">Type</label>
                    <select v-model="form.type" class="form-select">
                        <option value="page">Page</option>
                        <option value="url">External URL</option>
                        <option value="route">Internal Route</option>
                        <option value="group">Dropdown / Group</option>
                    </select>
                </div>

                <!-- PAGE SELECT -->
                <div v-if="showPageSelect" class="mb-5">
                    <label class="form-label">Select Page</label>
                    <select v-model="form.page_id" class="form-select">
                        <option value="">-- Select Page --</option>
                        <option v-for="page in pages" :key="page.id" :value="page.id">
                            {{ page.title }}
                        </option>
                    </select>
                </div>

                <!-- EXTERNAL URL -->
                <div v-if="showUrlInput" class="mb-5">
                    <label class="form-label">External URL</label>
                    <input v-model="form.link" type="text" class="form-control" placeholder="https://example.com" />
                </div>

                <!-- INTERNAL ROUTE -->
                <div v-if="showRouteInput" class="mb-5">
                    <label class="form-label">Route Name</label>
                    <input v-model="form.link" type="text" class="form-control" placeholder="home.index" />
                </div>

                <!-- PARENT -->
                <div class="mb-5">
                    <label class="form-label">Parent Menu</label>
                    <select v-model="form.parent_id" class="form-select">
                        <option value="">-- No Parent --</option>
                        <option v-for="parent in parents" :key="parent.id" :value="parent.id">
                            {{ parent.name }}
                        </option>
                    </select>
                </div>

            </div>
        </div>
    </AdminLayout>
</template>

<style scoped>

</style>
