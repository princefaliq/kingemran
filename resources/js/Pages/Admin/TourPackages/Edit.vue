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
    currency: props.package?.currency ?? 'IDR',
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
    is_active: props.package.is_active ?? true,

    items: props.package.items?.length
        ? props.package.items
        : [{ type: 'include', name: '' }],

    itineraries: props.package.itineraries?.length
        ? props.package.itineraries
        : [{ day: 1, title: '', description: '' }]
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
SAVE UPDATE
========================= */
const save = () => {
    form
        .transform((data) => ({
            ...data,
            _method: 'put',
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

        form.thumbnail = new File([blob], 'thumbnail.jpg', {
            type: 'image/jpeg'
        })
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

        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="d-flex text-gray-900 fw-bold my-1 fs-3">Tour Package</h1>
                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                        <li class="breadcrumb-item">
                            <Link :href="route('admin.dashboard')" class="text-gray-600 text-hover-primary">
                                Dashboard
                            </Link>
                        </li>
                        <li class="breadcrumb-item text-gray-600">Tour Package</li>
                        <li class="breadcrumb-item text-gray-600">Edit</li>
                    </ul>
                </div>

                <div class="d-flex align-items-center">
                    <Link :href="route('admin.tour-packages.index')" class="btn btn-light me-3">
                        Back
                    </Link>

                    <button type="button" class="btn btn-dark" @click="save" :disabled="form.processing">
                        Update
                    </button>
                </div>
            </div>
        </template>

        <div class="card">
            <div class="card-body">
                <div v-if="Object.keys(form.errors).length" class="alert alert-danger mb-5">
                    <div class="fw-bold mb-2">Gagal menyimpan data:</div>
                    <ul class="mb-0 ps-5">
                        <li v-for="(error, key) in form.errors" :key="key">
                            {{ error }}
                        </li>
                    </ul>
                </div>
                <form @submit.prevent="save">

                    <div class="mb-5">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" v-model="form.title" />
                    </div>

                    <div class="mb-7">
                        <label class="form-label fw-semibold mb-3">Thumbnail</label>

                        <input type="file" ref="fileInput" class="d-none" accept="image/*" @change="openCropper" />

                        <div class="card shadow-sm border-0">
                            <div class="card-body text-center p-5">

                                <div v-if="!previewUrl" class="border border-2 border-dashed rounded p-10 cursor-pointer bg-light" @click="triggerFileInput">
                                    <i class="ki-duotone ki-add-item fs-3x"></i>
                                    <div class="mt-4">
                                        <div class="fw-bold">Upload Thumbnail</div>
                                        <div class="fs-7">Recommended size 1200 x 675 (16:9)</div>
                                    </div>
                                </div>

                                <div v-else class="position-relative">
                                    <div class="ratio ratio-16x9">
                                        <img :src="previewUrl" class="w-100 h-100" style="object-fit:cover" />
                                    </div>

                                    <div class="mt-3">
                                        <button type="button" class="btn btn-light btn-sm me-2" @click="triggerFileInput">Change</button>
                                        <button type="button" class="btn btn-danger btn-sm" @click="removeThumbnail">Remove</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

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

                    <div class="row mb-5">
                        <div class="col-md-4">
                            <label class="form-label">Price</label>
                            <input type="number" class="form-control" v-model="form.price" />
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Discount Price</label>
                            <input type="number" class="form-control" v-model="form.price_discount" />
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Currency</label>
                            <select class="form-select" v-model="form.currency">
                                <option value="IDR">IDR</option>
                                <option value="USD">USD</option>
                                <option value="SAR">SAR</option>
                            </select>
                        </div>
                    </div>

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

                    <div class="mb-5">
                        <label class="form-label">Short Description</label>
                        <textarea class="form-control" v-model="form.short_description"></textarea>
                    </div>

                    <div class="mb-5">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="5" v-model="form.description"></textarea>
                    </div>

                    <div class="mb-10">
                        <h4 class="fw-bold mb-3">Package Items</h4>
                        <div v-for="(item, index) in form.items" :key="index" class="row mb-3">
                            <div class="col-md-3">
                                <select class="form-select" v-model="item.type">
                                    <option value="include">Include</option>
                                    <option value="exclude">Exclude</option>
                                </select>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" v-model="item.name" placeholder="Item name" />
                            </div>
                            <div class="col-md-2 d-flex gap-2">
                                <button type="button" class="btn btn-light-danger" @click="form.items.splice(index, 1)">✕</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-light-primary" @click="form.items.push({ type: 'include', name: '' })">+ Add Item</button>
                    </div>

                    <div class="mb-10">
                        <h4 class="fw-bold mb-3">Itineraries</h4>
                        <div v-for="(itinerary, index) in form.itineraries" :key="index" class="card mb-3">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-2">
                                        <label>Day</label>
                                        <input type="number" class="form-control" v-model="itinerary.day" />
                                    </div>
                                    <div class="col-md-10">
                                        <label>Title</label>
                                        <input type="text" class="form-control" v-model="itinerary.title" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea class="form-control" v-model="itinerary.description"></textarea>
                                </div>
                                <button type="button" class="btn btn-light-danger" @click="form.itineraries.splice(index, 1)">Remove</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-light-primary" @click="form.itineraries.push({ day: form.itineraries.length + 1, title: '', description: '' })">+ Add Day</button>
                    </div>

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

        <div class="modal fade" ref="cropperModal" tabindex="-1">
            <div class="modal-dialog modal-fullscreen m-0">
                <div class="modal-content border-0">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Crop Thumbnail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-0 bg-dark d-flex justify-content-center align-items-center" style="overflow:hidden; height:100vh;">
                        <img ref="cropperImage" style="max-width:100%; max-height:100%;" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-dark" @click="cropImage">Crop & Use Image</button>
                    </div>
                </div>
            </div>
        </div>

    </AdminLayout>
</template>
