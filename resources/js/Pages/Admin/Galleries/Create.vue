<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3'
import { ref, watch, nextTick, onBeforeUnmount } from 'vue'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import Cropper from 'cropperjs/dist/cropper.js'

/* =========================
FORM
========================= */

const form = useForm({
    title: '',
    type: 'image',
    image: null,
    youtube_url: '',
    tour_package_id: '', // ✅ tambahkan ini
    is_active: true
})
const props = defineProps({
    packages: Array
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
OPEN CROPPER (16:9)
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
                aspectRatio: 16 / 9,
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
        width: 1200,
        height: 675
    })

    previewUrl.value = canvas.toDataURL('image/jpeg')

    canvas.toBlob((blob) => {
        form.image = new File([blob], 'gallery.jpg', {
            type: 'image/jpeg'
        })
    })

    cropper.destroy()

    const modal = bootstrap.Modal.getInstance(cropperModal.value)
    modal.hide()
}

/* =========================
REMOVE IMAGE
========================= */

const removeImage = () => {
    previewUrl.value = null
    form.image = null

    if (fileInput.value) {
        fileInput.value.value = ''
    }
}

/* =========================
SAVE
========================= */

const save = () => {
    form
        .transform((data) => ({
            ...data,
            tour_package_id: data.tour_package_id || null, // 🔥 penting
            is_active: data.is_active ? 1 : 0
        }))
        .post(route('admin.galleries.store'), {
            forceFormData: true
        })
}

/* =========================
WATCH TYPE
========================= */

watch(() => form.type, (val) => {
    if (val === 'image') {
        form.youtube_url = ''
    } else {
        removeImage()
    }
})

/* =========================
CLEANUP
========================= */

onBeforeUnmount(() => {
    cropper?.destroy()
})
</script>

<template>
    <Head title="Create Gallery" />

    <AdminLayout>

        <!-- TOOLBAR -->
        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="d-flex text-gray-900 fw-bold my-1 fs-3">Galleries</h1>

                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                        <li class="breadcrumb-item">
                            <Link :href="route('admin.dashboard')" class="text-gray-600 text-hover-primary">
                                Dashboard
                            </Link>
                        </li>
                        <li class="breadcrumb-item text-gray-600">Galleries</li>
                        <li class="breadcrumb-item text-gray-600">Create</li>
                    </ul>
                </div>

                <div>
                    <Link :href="route('admin.galleries.index')" class="btn btn-light me-3">
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

                    <!-- TITLE -->
                    <div class="mb-5">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" v-model="form.title" />
                        <div v-if="form.errors.title" class="text-danger mt-2">
                            {{ form.errors.title }}
                        </div>
                    </div>
                    <!-- PACKAGE -->
                    <div class="mb-5">
                        <label class="form-label">Package (Optional)</label>

                        <select v-model="form.tour_package_id" class="form-select">
                            <option value="">Global</option>
                            <option
                                v-for="pkg in props.packages"
                                :key="pkg.id"
                                :value="pkg.id"
                            >
                                {{ pkg.title }}
                            </option>
                        </select>

                        <div class="form-text">
                            Kosongkan jika ini galeri umum (homepage / gallery page)
                        </div>
                        <div v-if="!form.tour_package_id" class="text-muted mt-2">
                            → Akan tampil sebagai galeri umum
                        </div>
                        <div v-if="form.errors.tour_package_id" class="text-danger mt-2">
                            {{ form.errors.tour_package_id }}
                        </div>
                    </div>
                    <!-- TYPE -->
                    <div class="mb-5">
                        <label class="form-label">Type</label>
                        <select class="form-select" v-model="form.type">
                            <option value="image">Image</option>
                            <option value="youtube">YouTube</option>
                        </select>
                        <div v-if="form.errors.type" class="text-danger mt-2">
                            {{ form.errors.type }}
                        </div>
                    </div>

                    <!-- IMAGE -->
                    <div v-if="form.type === 'image'" class="mb-7">

                        <label class="form-label fw-semibold mb-3">
                            Image (16:9)
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

                                <!-- EMPTY -->
                                <div
                                    v-if="!previewUrl"
                                    class="border border-2 border-dashed rounded p-10 cursor-pointer bg-light"
                                    @click="triggerFileInput"
                                >
                                    Upload Image
                                </div>

                                <!-- PREVIEW -->
                                <div v-else class="position-relative">

                                    <div class="ratio ratio-16x9">
                                        <img
                                            :src="previewUrl"
                                            class="w-100 h-100"
                                            style="object-fit:cover"
                                        />
                                    </div>

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
                        <div v-if="form.errors.image" class="text-danger mt-3">
                            {{ form.errors.image }}
                        </div>
                    </div>

                    <!-- YOUTUBE -->
                    <div v-if="form.type === 'youtube'" class="mb-5">
                        <label class="form-label">YouTube URL</label>

                        <input
                            type="text"
                            class="form-control"
                            v-model="form.youtube_url"
                        />

                        <div v-if="form.errors.youtube_url" class="text-danger mt-2">
                            {{ form.errors.youtube_url }}
                        </div>
                    </div>

                    <!-- STATUS -->
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

        <!-- MODAL CROPPER -->
        <div class="modal fade" ref="cropperModal" tabindex="-1">
            <div class="modal-dialog modal-fullscreen m-0">
                <div class="modal-content border-0">

                    <div class="modal-header">
                        <h5 class="modal-title">Crop Image</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body p-0 bg-dark d-flex justify-content-center align-items-center"
                         style="height:100vh;">
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
