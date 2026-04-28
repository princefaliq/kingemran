<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3'
import { ref, nextTick, onBeforeUnmount } from 'vue'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import Cropper from 'cropperjs/dist/cropper.js'

/* =========================
REFS
========================= */

const imageInput = ref(null)
const iconInput = ref(null)

const cropperImage = ref(null)
const cropperModal = ref(null)

const previewImage = ref(null)
const previewIcon = ref(null)

let cropper = null
let currentField = null // image / icon

/* =========================
FORM
========================= */

const form = useForm({
    title: '',
    subtitle: '',
    image: null,
    icon: null,
    is_active: true
})

/* =========================
SAVE
========================= */

const save = () => {
    form.post(route('admin.services.store'), {
        forceFormData: true
    })
}

/* =========================
UPLOAD HANDLER
========================= */

const triggerFile = (type) => {
    if (type === 'image') imageInput.value.click()
    if (type === 'icon') iconInput.value.click()
}

const openCropper = (e, type) => {
    const file = e.target.files[0]
    if (!file) return

    currentField = type

    const reader = new FileReader()
    reader.onload = () => {
        cropperImage.value.src = reader.result

        const modal = new bootstrap.Modal(cropperModal.value)
        modal.show()

        nextTick(() => {
            cropper?.destroy()

            cropper = new Cropper(cropperImage.value, {
                aspectRatio: type === 'image' ? 4/3 : 1,
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
CROP
========================= */

const cropImage = () => {
    if (!cropper) return

    const canvas = cropper.getCroppedCanvas({
        width: currentField === 'image' ? 800 : 200,
        height: currentField === 'image' ? 600 : 200
    })

    const preview = canvas.toDataURL('image/jpeg')

    canvas.toBlob((blob) => {

        if (currentField === 'image') {
            const file = new File([blob], 'image.jpg', {
                type: 'image/jpeg'
            })

            form.image = file
            form.remove_image = false
            previewImage.value = URL.createObjectURL(blob)

        } else {
            const file = new File([blob], 'icon.png', {
                type: 'image/png'
            })

            form.icon = file
            form.remove_icon = false
            previewIcon.value = URL.createObjectURL(blob)
        }

    }, currentField === 'icon' ? 'image/png' : 'image/jpeg')

    cropper.destroy()
    bootstrap.Modal.getInstance(cropperModal.value).hide()
}

/* =========================
REMOVE
========================= */

const removeImage = () => {
    form.image = null
    previewImage.value = null
    if (imageInput.value) imageInput.value.value = ''
}

const removeIcon = () => {
    form.icon = null
    previewIcon.value = null
    if (iconInput.value) iconInput.value.value = ''
}

onBeforeUnmount(() => {
    cropper?.destroy()
})
</script>

<template>
    <Head title="Create Service" />

    <AdminLayout>

        <!-- TOOLBAR -->
        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="fw-bold fs-3">Services</h1>

                    <ul class="breadcrumb breadcrumb-dot fs-7">
                        <li class="breadcrumb-item">
                            <Link :href="route('admin.dashboard')" class="text-gray-600 text-hover-primary">Dashboard</Link>
                        </li>
                        <li class="breadcrumb-item text-gray-600">Services</li>
                        <li class="breadcrumb-item text-gray-600">Create</li>
                    </ul>
                </div>

                <div>
                    <Link :href="route('admin.services.index')" class="btn btn-light me-3">
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

                <!-- TITLE -->
                <div class="mb-5">
                    <label class="form-label">Title</label>
                    <input v-model="form.title" class="form-control"/>
                </div>

                <!-- SUBTITLE -->
                <div class="mb-5">
                    <label class="form-label">Subtitle</label>
                    <input v-model="form.subtitle" class="form-control"/>
                </div>

                <!-- IMAGE -->
                <div class="mb-7">
                    <label class="form-label fw-semibold mb-3">Image</label>

                    <input
                        type="file"
                        ref="imageInput"
                        class="d-none"
                        accept="image/*"
                        @change="e => openCropper(e, 'image')"
                    />

                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center p-5">

                            <!-- EMPTY -->
                            <div
                                v-if="!previewImage"
                                class="border border-2 border-dashed rounded p-10 cursor-pointer bg-gray-600"
                                @click="triggerFile('image')"
                            >
                                <i class="ki-duotone ki-add-item fs-3x text-gray-100"></i>

                                <div class="mt-4">
                                    <div class="fw-bold">Upload Image</div>
                                    <div class="fs-7">Recommended 800 x 600</div>
                                </div>
                            </div>

                            <!-- PREVIEW -->
                            <div v-else class="position-relative w-100">

                                <div class="ratio ratio-4x3 rounded overflow-hidden shadow-sm">

                                    <img
                                        :src="previewImage"
                                        class="w-100 h-100"
                                        style="object-fit: cover;"
                                    />

                                    <!-- OVERLAY -->
                                    <div
                                        class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                                        style="background:rgba(0,0,0,0.45); opacity:0; transition:0.3s;"
                                        @mouseenter="$event.currentTarget.style.opacity = 1"
                                        @mouseleave="$event.currentTarget.style.opacity = 0"
                                    >
                                        <button class="btn btn-light btn-sm me-2" @click="triggerFile('image')">
                                            ✏ Edit
                                        </button>

                                        <button class="btn btn-danger btn-sm" @click="removeImage">
                                            ✕ Remove
                                        </button>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <!-- ICON -->
                <div class="mb-7">
                    <label class="form-label fw-semibold mb-3">Icon</label>

                    <input
                        type="file"
                        ref="iconInput"
                        class="d-none"
                        accept="image/*"
                        @change="e => openCropper(e, 'icon')"
                    />

                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center p-5">

                            <!-- EMPTY -->
                            <div
                                v-if="!previewIcon"
                                class="border border-2 border-dashed rounded p-10 cursor-pointer bg-gray-600"
                                @click="triggerFile('icon')"
                            >
                                <i class="ki-duotone ki-add-item fs-3x text-gray-100"></i>

                                <div class="mt-4">
                                    <div class="fw-bold">Upload Icon</div>
                                    <div class="fs-7">Recommended 200 x 200 (PNG)</div>
                                </div>
                            </div>

                            <!-- PREVIEW -->
                            <div v-else class="position-relative d-inline-block">

                                <img
                                    :src="previewIcon"
                                    class="rounded shadow-sm"
                                    style="width:120px; height:120px; object-fit:contain;"
                                />

                                <!-- OVERLAY -->
                                <div
                                    class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                                    style="background:rgba(0,0,0,0.45); opacity:0; transition:0.3s;"
                                    @mouseenter="$event.currentTarget.style.opacity = 1"
                                    @mouseleave="$event.currentTarget.style.opacity = 0"
                                >
                                    <button class="btn btn-light btn-sm me-2" @click="triggerFile('icon')">
                                        ✏
                                    </button>

                                    <button class="btn btn-danger btn-sm" @click="removeIcon">
                                        ✕
                                    </button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <!-- STATUS -->
                <div class="form-check">
                    <input type="checkbox" v-model="form.is_active" class="form-check-input"/>
                    <label class="form-check-label">Active</label>
                </div>

            </div>
        </div>

        <div class="modal fade" ref="cropperModal" tabindex="-1">
            <div class="modal-dialog modal-fullscreen m-0">
                <div class="modal-content border-0">

                    <!-- HEADER -->
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">
                            Crop {{ currentField === 'icon' ? 'Icon' : 'Image' }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- BODY -->
                    <div
                        class="modal-body p-0 bg-dark d-flex justify-content-center align-items-center"
                        style="overflow:hidden; height:100vh;"
                    >
                        <img ref="cropperImage" style="max-width:100%; max-height:100%;" />
                    </div>

                    <!-- FOOTER -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="button" class="btn btn-dark" @click="cropImage">
                            Crop & Use Image
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </AdminLayout>
</template>
