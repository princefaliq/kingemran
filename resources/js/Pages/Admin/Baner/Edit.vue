<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3'
import { ref, nextTick, onBeforeUnmount } from 'vue'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import Cropper from 'cropperjs/dist/cropper.js'

/* =========================
PROPS
========================= */
const props = defineProps({
    banner: Object
})

/* =========================
REFS
========================= */

const cropperImage = ref(null)
const cropperModal = ref(null)
const previewUrl = ref(
    props.banner.image
        ? `/storage/${props.banner.image}`
        : null
)
const fileInput = ref(null)

let cropper = null

/* =========================
FORM
========================= */

const form = useForm({
    name: props.banner.name,
    text: props.banner.text,
    image: null,
    remove_image: false,
    status: props.banner.status ? 1 : 0
})

/* =========================
SAVE
========================= */

const save = () => {
    if (!form.image && !form.remove_image) {
        delete form.image
    }

    form
        .transform((data) => ({
            ...data,
            _method: 'put'
        }))
        .post(route('admin.baner.update', props.banner.id), {
            forceFormData: true
        })
}

/* =========================
IMAGE HANDLER
========================= */

const triggerFileInput = () => {
    fileInput.value?.click()
}

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

const cropImage = () => {
    if (!cropper) return

    const canvas = cropper.getCroppedCanvas({
        width: 1200,
        height: 675
    })

    previewUrl.value = canvas.toDataURL('image/jpeg')

    canvas.toBlob((blob) => {
        form.image = new File(
            [blob],
            'banner.jpg',
            { type: 'image/jpeg' }
        )
    })

    cropper.destroy()

    const modal = bootstrap.Modal.getInstance(cropperModal.value)
    modal.hide()
}

const removeImage = () => {
    previewUrl.value = null
    form.image = null
    form.remove_image = true

    if (fileInput.value) {
        fileInput.value.value = ''
    }
}

/* =========================
CLEANUP
========================= */

onBeforeUnmount(() => {
    cropper?.destroy()
})
</script>

<template>
    <Head title="Edit Baner" />

    <AdminLayout>

        <!-- TOOLBAR -->
        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="fw-bold fs-3">Baner</h1>
                    <ul class="breadcrumb breadcrumb-dot fs-7">
                        <li class="breadcrumb-item">
                            <Link :href="route('admin.dashboard')" class="text-gray-600 text-hover-primary">Dashboard</Link>
                        </li>
                        <li class="breadcrumb-item text-gray-600">Baner</li>
                        <li class="breadcrumb-item text-gray-600">Edit</li>
                    </ul>
                </div>

                <div>
                    <Link :href="route('admin.baner.index')" class="btn btn-light me-2">
                        Back
                    </Link>

                    <button
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

                    <!-- NAME -->
                    <div class="mb-5">
                        <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                        <input type="text" class="form-control" v-model="form.name" />

                        <div v-if="form.errors.name" class="text-danger mt-1">
                            {{ form.errors.name }}
                        </div>
                    </div>

                    <!-- IMAGE -->
                    <div class="mb-7">
                        <label class="form-label">Image<span class="text-danger ms-1">*</span></label>

                        <input
                            type="file"
                            ref="fileInput"
                            class="d-none"
                            accept="image/*"
                            @change="openCropper"
                        />

                        <div class="card p-5 text-center">

                            <!-- EMPTY -->
                            <div
                                v-if="!previewUrl"
                                class="border border-2 border-dashed rounded p-10 cursor-pointer hover-opacity"
                                style="background:#f8f9fa; transition:0.3s"
                                @click="triggerFileInput"
                            >
                                <i class="ki-duotone ki-picture fs-3x text-gray-400"></i>

                                <div class="mt-4">
                                    <div class="fw-bold text-gray-700">
                                        Upload Banner Image
                                    </div>
                                    <div class="text-muted fs-7">
                                        Recommended size 1200 x 675 (16:9)
                                    </div>
                                </div>
                            </div>

                            <!-- PREVIEW -->
                            <div v-else class="position-relative w-100">

                                <div class="ratio ratio-16x9 rounded overflow-hidden shadow-sm">

                                    <img
                                        :src="previewUrl"
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
                                        <button
                                            type="button"
                                            class="btn btn-light btn-sm me-2"
                                            @click="triggerFileInput"
                                        >
                                            ✏ Edit
                                        </button>

                                        <button
                                            type="button"
                                            class="btn btn-danger btn-sm"
                                            @click="removeImage"
                                        >
                                            ✕ Remove
                                        </button>
                                    </div>

                                </div>

                            </div>

                            <div v-if="form.errors.image" class="text-danger mt-2">
                                {{ form.errors.image }}
                            </div>
                        </div>
                    </div>

                    <!-- TEXT -->
                    <div class="mb-5">
                        <label class="form-label">Text</label>

                        <textarea
                            class="form-control"
                            rows="3"
                            v-model="form.text"
                        ></textarea>

                        <div class="form-text">
                            Kosongi jika tidak ingin menampilkan teks di depan gambar banner.
                        </div>
                    </div>

                    <!-- STATUS -->
                    <div class="mb-5">
                        <label class="form-label">Status</label>

                        <select class="form-select" v-model="form.status">
                            <option :value="1">Active</option>
                            <option :value="0">Inactive</option>
                        </select>
                    </div>

                </form>
            </div>
        </div>

        <!-- MODAL CROPPER -->
        <div class="modal fade" ref="cropperModal">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5>Crop Image</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div
                        class="modal-body p-0 bg-dark d-flex justify-content-center align-items-center"
                        style="overflow:hidden; height:100vh;"
                    >
                        <img ref="cropperImage" style="max-width:100%; max-height:100%;" />
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-light" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button class="btn btn-dark" @click="cropImage">
                            Crop & Save
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </AdminLayout>
</template>
