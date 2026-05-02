<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3'
import { ref, nextTick, onBeforeUnmount } from 'vue'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import Cropper from 'cropperjs/dist/cropper.js'

/* =========================
PROPS
========================= */
const props = defineProps({
    package: Object
})

/* =========================
FORM
========================= */
const form = useForm({
    title: props.package.title ?? '',
    duration: props.package.duration ?? '',
    duration_type: props.package.duration_type ?? 'days',
    price: props.package.price ?? '',
    price_discount: props.package.price_discount ?? '',
    location: props.package.location ?? '',
    departure_city: props.package.departure_city ?? '',
    departure_date: props.package.departure_date ?? '',
    airline: props.package.airline ?? '',
    hotel: props.package.hotel ?? '',
    quota: props.package.quota ?? '',
    short_description: props.package.short_description ?? '',
    description: props.package.description ?? '',
    thumbnail: null,
    is_featured: props.package.is_featured ?? false,
    is_active: props.package.is_active ?? true
})

/* =========================
REFS
========================= */
const previewUrl = ref(props.package.thumbnail_url ?? null)
const fileInput = ref(null)
const cropperImage = ref(null)
const cropperModal = ref(null)

let cropper = null

/* =========================
SAVE (UPDATE)
========================= */
const save = () => {
    form
        .transform((data) => ({
            ...data,
            _method: 'put', // 🔥 INI KUNCI NYA
            is_featured: data.is_featured ? 1 : 0,
            is_active: data.is_active ? 1 : 0
        }))
        .post(route('admin.tour-packages.update', props.package.id), {
            forceFormData: true
        })
}

/* =========================
THUMBNAIL CROPPER
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
    const canvas = cropper.getCroppedCanvas({
        width: 1200,
        height: 675
    })

    previewUrl.value = canvas.toDataURL()

    canvas.toBlob((blob) => {
        if (!blob) return

        form.thumbnail = new File(
            [blob],
            'thumbnail.jpg',
            { type: 'image/jpeg' } // 🔥 WAJIB
        )
    })

    cropper.destroy()
    bootstrap.Modal.getInstance(cropperModal.value).hide()
}

const removeThumbnail = () => {
    previewUrl.value = null
    form.thumbnail = null

    if (fileInput.value) {
        fileInput.value.value = ''
    }
}

onBeforeUnmount(() => {
    cropper?.destroy()
})
</script>

<template>
    <Head title="Edit Tour Package" />

    <AdminLayout>

        <!-- TOOLBAR -->
        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="d-flex text-gray-900 fw-bold my-1 fs-3">Tour Package</h1>
                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                        <li class="breadcrumb-item">
                            <Link :href="route('admin.dashboard')">
                                Dashboard
                            </Link>
                        </li>
                        <li class="breadcrumb-item">Tour Package</li>
                        <li class="breadcrumb-item">Edit</li>
                    </ul>
                </div>

                <div class="d-flex align-items-center">
                    <Link :href="route('admin.tour-packages.index')" class="btn btn-light me-3">
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

        <!-- 🔥 FORM BODY SAMA PERSIS DENGAN CREATE -->
        <div class="card">
            <div class="card-body">
                <div v-if="form.errors.title" class="text-danger">
                    {{ form.errors.title }}
                </div>
                <form @submit.prevent="save">

                    <!-- TITLE -->
                    <div class="mb-5">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" v-model="form.title" />
                    </div>

                    <!-- THUMBNAIL -->
                    <div class="mb-7">
                        <label class="form-label fw-semibold mb-3">
                            Thumbnail
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
                                    class="border border-2 border-dashed rounded p-10 cursor-pointer bg-light"
                                    @click="triggerFileInput"
                                >
                                    Upload Thumbnail
                                </div>

                                <div v-else class="position-relative">
                                    <div class="ratio ratio-16x9">
                                        <img :src="previewUrl" class="w-100 h-100" style="object-fit:cover" />
                                    </div>

                                    <div class="mt-3">
                                        <button class="btn btn-light btn-sm me-2" @click="triggerFileInput">
                                            Change
                                        </button>
                                        <button class="btn btn-danger btn-sm" @click="removeThumbnail">
                                            Remove
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- ROW 1 -->
                    <div class="row mb-5">
                        <div class="col-md-4">
                            <label class="form-label">Duration</label>
                            <input type="number" class="form-control" v-model="form.duration" />
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Type</label>
                            <select class="form-select" v-model="form.duration_type">
                                <option value="days">Days</option>
                                <option value="nights">Nights</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Quota</label>
                            <input type="number" class="form-control" v-model="form.quota" />
                        </div>
                    </div>

                    <!-- ROW 2 -->
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="form-label">Price</label>
                            <input type="number" class="form-control" v-model="form.price" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Discount Price</label>
                            <input type="number" class="form-control" v-model="form.price_discount" />
                        </div>
                    </div>

                    <!-- ROW 3 -->
                    <div class="row mb-5">
                        <div class="col-md-4">
                            <label class="form-label">Location</label>
                            <input type="text" class="form-control" v-model="form.location" />
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Departure City</label>
                            <input type="text" class="form-control" v-model="form.departure_city" />
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Departure Date</label>
                            <input type="date" class="form-control" v-model="form.departure_date" />
                        </div>
                    </div>

                    <!-- ROW 4 -->
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="form-label">Airline</label>
                            <input type="text" class="form-control" v-model="form.airline" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Hotel</label>
                            <input type="text" class="form-control" v-model="form.hotel" />
                        </div>
                    </div>

                    <!-- DESCRIPTION -->
                    <div class="mb-5">
                        <label class="form-label">Short Description</label>
                        <textarea class="form-control" v-model="form.short_description"></textarea>
                    </div>

                    <div class="mb-5">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="5" v-model="form.description"></textarea>
                    </div>

                    <!-- STATUS -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" v-model="form.is_featured">
                                <label class="form-check-label">Featured</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" v-model="form.is_active">
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <!-- MODAL -->
        <div class="modal fade" ref="cropperModal" tabindex="-1">
            <div class="modal-dialog modal-fullscreen m-0">
                <div class="modal-content border-0">
                    <div class="modal-header">
                        <h5 class="modal-title">Crop Thumbnail</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body p-0 bg-dark d-flex justify-content-center align-items-center">
                        <img ref="cropperImage" style="max-width:100%; max-height:100%;" />
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-dark" @click="cropImage">Crop</button>
                    </div>
                </div>
            </div>
        </div>

    </AdminLayout>
</template>
