<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3'
import { ref, nextTick, onBeforeUnmount } from 'vue'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import Cropper from 'cropperjs/dist/cropper.js'

/* =========================
FORM
========================= */

const form = useForm({
    name: '',
    url: '',
    logo: null,
    is_active: true
})

/* =========================
REFS
========================= */

const previewUrl = ref(null)
const fileInput = ref(null)
const cropperImage = ref(null)
const cropperModal = ref(null)

let cropper = null

/* =========================
TRIGGER FILE
========================= */

const triggerFileInput = () => {
    fileInput.value?.click()
}

/* =========================
OPEN CROPPER
========================= */

const openCropper = (e) => {
    const file = e.target.files[0]
    if (!file) return

    const reader = new FileReader()

    reader.onload = () => {
        cropperImage.value.src = reader.result

        const modal = new bootstrap.Modal(cropperModal.value)
        modal.show()

        nextTick(() => {
            cropper?.destroy()

            cropper = new Cropper(cropperImage.value, {
                aspectRatio: 1,
                viewMode: 1,
                autoCropArea: 1,
                responsive: true,
                background: false,
                zoomOnWheel: true,
                minContainerWidth: window.innerWidth,
                minContainerHeight: window.innerHeight * 0.8
            })
        })
    }

    reader.readAsDataURL(file)
}

/* =========================
CROP IMAGE
========================= */

const cropImage = () => {
    if (!cropper) return

    const canvas = cropper.getCroppedCanvas({
        width: 500,
        height: 500
    })

    previewUrl.value = canvas.toDataURL('image/png')

    canvas.toBlob((blob) => {
        form.logo = new File([blob], 'partner-logo.png', {
            type: 'image/png'
        })
    }, 'image/png')

    cropper.destroy()

    const modal = bootstrap.Modal.getInstance(cropperModal.value)
    modal.hide()
}

/* =========================
REMOVE IMAGE
========================= */

const removeImage = () => {
    previewUrl.value = null
    form.logo = null

    if (fileInput.value) {
        fileInput.value.value = ''
    }
}

/* =========================
SAVE
========================= */

const save = () => {
    form.post(route('admin.partners.store'), {
        forceFormData: true
    })
}

/* =========================
CLEANUP
========================= */

onBeforeUnmount(() => {
    cropper?.destroy()
})
</script>

<template>
    <Head title="Create Partner" />

    <AdminLayout>
        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="d-flex text-gray-900 fw-bold my-1 fs-3">Partners</h1>

                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                        <li class="breadcrumb-item">
                            <Link :href="route('admin.dashboard')" class="text-gray-600 text-hover-primary">
                                Dashboard
                            </Link>
                        </li>
                        <li class="breadcrumb-item text-gray-600">Partners</li>
                        <li class="breadcrumb-item text-gray-600">Create</li>
                    </ul>
                </div>

                <div>
                    <Link :href="route('admin.partners.index')" class="btn btn-light me-3">
                        Back
                    </Link>

                    <button class="btn btn-dark" @click="save">
                        Save
                    </button>
                </div>
            </div>
        </template>

        <div class="card">
            <div class="card-body">

                <div v-if="Object.keys(form.errors).length" class="alert alert-danger mb-5">
                    <ul class="mb-0">
                        <li v-for="(error, key) in form.errors" :key="key">
                            {{ error }}
                        </li>
                    </ul>
                </div>

                <form @submit.prevent="save">

                    <div class="mb-5">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" v-model="form.name" />
                        <div v-if="form.errors.name" class="text-danger mt-2">
                            {{ form.errors.name }}
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="form-label">URL</label>
                        <input type="text" class="form-control" v-model="form.url" placeholder="https://example.com" />
                        <div v-if="form.errors.url" class="text-danger mt-2">
                            {{ form.errors.url }}
                        </div>
                    </div>

                    <div class="mb-7">
                        <label class="form-label fw-semibold mb-3">
                            Logo (1:1)
                        </label>

                        <input
                            type="file"
                            ref="fileInput"
                            class="d-none"
                            accept="image/*"
                            @change="openCropper"
                        />

                        <div class="card shadow-sm border-0">
                            <div class="card-body text-center p-5">

                                <div
                                    v-if="!previewUrl"
                                    class="border border-2 border-dashed rounded p-10 cursor-pointer bg-gray-600"
                                    @click="triggerFileInput"
                                >
                                    <i class="ki-duotone ki-add-item fs-3x text-gray-100"></i>
                                    <div class="mt-4">
                                        <div class="fw-bold">Upload Logo</div>
                                        <div class="fs-7">Recommended 1:1</div>
                                    </div>
                                </div>

                                <div v-else class="position-relative">
                                    <img
                                        :src="previewUrl"
                                        class="rounded"
                                        style="width:150px;height:150px;object-fit:contain"
                                    />

                                    <div class="mt-3">
                                        <button class="btn btn-light btn-sm me-2" @click="triggerFileInput">
                                            Change
                                        </button>
                                        <button class="btn btn-danger btn-sm" @click="removeImage">
                                            Remove
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div v-if="form.errors.logo" class="text-danger mt-3">
                            {{ form.errors.logo }}
                        </div>
                    </div>

                    <div class="mb-5">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" v-model="form.is_active">
                            <label class="form-check-label">Active</label>
                        </div>
                        <div v-if="form.errors.is_active" class="text-danger mt-2">
                            {{ form.errors.is_active }}
                        </div>
                    </div>

                </form>

            </div>
        </div>

        <div class="modal fade" ref="cropperModal" tabindex="-1">
            <div class="modal-dialog modal-fullscreen m-0">
                <div class="modal-content border-0">

                    <div class="modal-header">
                        <h5 class="modal-title">Crop Logo</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div
                        class="modal-body p-0 bg-dark d-flex justify-content-center align-items-center"
                        style="height:100vh;"
                    >
                        <img ref="cropperImage" style="max-width:100%; max-height:100%;" />
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-light" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button class="btn btn-dark" @click="cropImage">
                            Crop & Use
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </AdminLayout>
</template>
