<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { onMounted, nextTick, ref } from 'vue'

const props = defineProps({
    user: Object,
    permissions: Array,
})

const permissionSelect = ref(null)

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: '',
    password_confirmation: '',
    permissions: props.user.permissions.map(p => p.name),
})

const submit = () => {
    form.put(route('admin.users.update', props.user.id))
}

onMounted(async () => {
    await nextTick()

    // init Metronic components
    window.KTComponents?.init?.()

    // init Select2
    if (permissionSelect.value && window.$) {
        window.$(permissionSelect.value).select2({
            placeholder: "Select permissions",
            width: '100%',
            allowClear: true,
        })

        // set default value saat edit
        window.$(permissionSelect.value).val(form.permissions).trigger('change')

        // sync ke v-model
        window.$(permissionSelect.value).on('change', function () {
            form.permissions = window.$(permissionSelect.value).val() || []
        })
    }
})

</script>

<template>
    <Head title="Edit User" />
    <AdminLayout>
        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="d-flex text-gray-900 fw-bold my-1 fs-3">Users</h1>
                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                        <li class="breadcrumb-item text-gray-600">
                            <Link :href="route('admin.dashboard')" class="text-gray-600 text-hover-primary">Dashboard</Link>
                        </li>
                        <li class="breadcrumb-item text-gray-600">Users</li>
                        <li class="breadcrumb-item text-gray-500">Edit</li>
                    </ul>
                </div>

                <div class="d-flex align-items-center py-2 py-md-1">
                    <Link :href="route('admin.users.index')" class="btn btn-light fw-bold me-3">
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

        <!-- Content -->
        <div class="row g-5 g-lg-12">
            <div class="col-xl-12 mb-xl-10">
                <div class="card h-md-100">
                    <div class="card-header border-0 py-5">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Edit User</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <form @submit.prevent="submit">
                            <!-- Name -->
                            <div class="mb-5">
                                <label class="form-label required">Name</label>
                                <input v-model="form.name" type="text" class="form-control" />
                                <div v-if="form.errors.name" class="text-danger mt-1">
                                    {{ form.errors.name }}
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="mb-5">
                                <label class="form-label required">Email</label>
                                <input v-model="form.email" type="email" class="form-control" />
                                <div v-if="form.errors.email" class="text-danger mt-1">
                                    {{ form.errors.email }}
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="mb-5">
                                <label class="form-label">Password (kosongkan jika tidak ganti)</label>
                                <input v-model="form.password" type="password" class="form-control" />
                                <div v-if="form.errors.password" class="text-danger mt-1">
                                    {{ form.errors.password }}
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-5">
                                <label class="form-label">Confirm Password</label>
                                <input v-model="form.password_confirmation" type="password" class="form-control" />
                            </div>

                            <!-- Permissions -->
                            <div class="mb-5">
                                <label class="form-label">Permissions</label>
                                <select
                                    ref="permissionSelect"
                                    class="form-select"
                                    data-control="select2"
                                    data-close-on-select="false"
                                    data-placeholder="Select permissions"
                                    data-allow-clear="true"
                                    multiple
                                >
                                    <option></option>
                                    <option
                                        v-for="permission in permissions"
                                        :key="permission.id"
                                        :value="permission.name"
                                    >
                                        {{ permission.name }}
                                    </option>
                                </select>
                                <div v-if="form.errors.permissions" class="text-danger mt-1">
                                    {{ form.errors.permissions }}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<style scoped>

</style>
