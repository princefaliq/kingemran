<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3'
import { ref, nextTick, onBeforeUnmount, onMounted } from 'vue'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import Cropper from 'cropperjs/dist/cropper.js'

/* =========================
PROPS
========================= */

const props = defineProps({
    spaProgram: Object
})

/* =========================
FORM
========================= */

const form = useForm({
    nama_paket: props.spaProgram.nama_paket,
    deskripsi: props.spaProgram.deskripsi,
    harga: props.spaProgram.harga,
    gambar: null,
    is_active: props.spaProgram.is_active,
    _method: 'put'
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
INIT PREVIEW (gambar lama)
========================= */

onMounted(() => {
    if (props.spaProgram.gambar) {
        previewUrl.value = `/storage/${props.spaProgram.gambar}`
    }
})

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

    previewUrl.value = canvas.toDataURL('image/jpeg')

    canvas.toBlob((blob) => {
        form.gambar = new File([blob], 'spa.jpg', {
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
    form.gambar = null

    if (fileInput.value) {
        fileInput.value.value = ''
    }
}

/* =========================
UPDATE
========================= */

const update = () => {
    form.post(route('admin.spa-programs.update', props.spaProgram.id), {
        forceFormData: true,

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
    <Head title="Edit SPA Program" />

    <AdminLayout>

        <!-- TOOLBAR -->
        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="d-flex text-gray-900 fw-bold my-1 fs-3">SPA Programs</h1>

                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                        <li class="breadcrumb-item">
                            <Link :href="route('admin.dashboard')" class="text-gray-600 text-hover-primary">
                                Dashboard
                            </Link>
                        </li>
                        <li class="breadcrumb-item text-gray-600">SPA Programs</li>
                        <li class="breadcrumb-item text-gray-600">Edit</li>
                    </ul>
                </div>

                <div>
                    <Link :href="route('admin.spa-programs.index')" class="btn btn-light me-3">
                        Back
                    </Link>

                    <button class="btn btn-dark" @click="update">
                        Update
                    </button>
                </div>
            </div>
        </template>

        <div class="card">
            <div class="card-body">

                <!-- ERROR -->
                <div v-if="Object.keys(form.errors).length" class="alert alert-danger mb-5">
                    <ul class="mb-0">
                        <li v-for="(error, key) in form.errors" :key="key">
                            {{ error }}
                        </li>
                    </ul>
                </div>

                <form @submit.prevent="update">

                    <!-- NAMA -->
                    <div class="mb-5">
                        <label class="form-label">Nama Paket</label>
                        <input type="text" class="form-control" v-model="form.nama_paket" />
                    </div>

                    <!-- DESKRIPSI -->
                    <div class="mb-5">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" v-model="form.deskripsi"></textarea>
                    </div>

                    <!-- HARGA -->
                    <div class="mb-5">
                        <label class="form-label">Harga</label>
                        <input type="number" class="form-control" v-model="form.harga" />
                    </div>

                    <!-- GAMBAR -->
                    <div class="mb-7">
                        <label class="form-label fw-semibold mb-3">Gambar (1:1)</label>

                        <input
                            type="file"
                            ref="fileInput"
                            class="d-none"
                            accept="image/*"
                            @change="openCropper"
                        />

                        <div class="card shadow-sm border-0">
                            <div class="card-body text-center p-5">

                                <div v-if="!previewUrl"
                                     class="border border-2 border-dashed rounded p-10 cursor-pointer bg-gray-600"
                                     @click="triggerFileInput">
                                    <div class="fw-bold">Upload Gambar</div>
                                </div>

                                <div v-else class="position-relative">
                                    <img :src="previewUrl"
                                         class="rounded-circle"
                                         style="width:150px;height:150px;object-fit:cover" />

                                    <div class="mt-3">
                                        <button type="button" class="btn btn-light btn-sm me-2" @click="triggerFileInput">
                                            Change
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" @click="removeImage">
                                            Remove
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- STATUS -->
                    <div class="mb-5">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" v-model="form.is_active">
                            <label class="form-check-label">Active</label>
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
                        <h5 class="modal-title">Crop Gambar</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body p-0 bg-dark d-flex justify-content-center align-items-center"
                         style="height:100vh;">
                        <img ref="cropperImage" style="max-width:100%; max-height:100%;" />
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-dark" @click="cropImage">Crop & Use</button>
                    </div>

                </div>
            </div>
        </div>

    </AdminLayout>
</template>
