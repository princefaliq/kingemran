<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3'
import { ref, onMounted, nextTick, onBeforeUnmount, watch } from 'vue'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import Cropper from 'cropperjs/dist/cropper.js'

const props = defineProps({
    categories: Array,
    tags: Array
})

/* =========================
REFS
========================= */

const tagSelect = ref(null)
const editorRef = ref(null)
const cropperImage = ref(null)
const cropperModal = ref(null)
const previewUrl = ref(null)
const fileInput = ref(null)

let quill = null
let cropper = null

/* =========================
FORM
========================= */

const form = useForm({
    title: '',
    category_id: null,
    content: '',
    tag_ids: [],
    thumbnail: null,
    status: 'draft',
    published_at: null,
    is_featured: false
})

/* =========================
AUTO SLUG
========================= */

watch(() => form.title, (val) => {
    form.slug = val
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/(^-|-$)/g, '')
})

/* =========================
SAVE
========================= */

const save = () => {
    form.post(route('admin.articles.store'), {
        forceFormData: true
    })
}

/* =========================
SELECT2 + QUILL
========================= */

onMounted(async () => {
    await nextTick()

    // SELECT2
    window.$(tagSelect.value).select2({
        placeholder: 'Select Tags',
        width: '100%',
        closeOnSelect: false
    })

    window.$(tagSelect.value).on('change', function () {
        form.tag_ids = window.$(this).val() ?? []
    })

    // QUILL
    quill = new window.Quill(editorRef.value, {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ font: [] }],
                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                [{ size: ['small', false, 'large', 'huge'] }],

                ['bold', 'italic', 'underline', 'strike'],
                [{ color: [] }, { background: [] }],

                [{ script: 'sub' }, { script: 'super' }],

                [{ list: 'ordered' }, { list: 'bullet' }, { indent: '-1' }, { indent: '+1' }],

                [{ direction: 'rtl' }, { align: [] }],

                ['blockquote', 'code-block'],

                ['link', 'image', 'video', 'formula'],

                ['clean']
            ]
        }
    })

    quill.on('text-change', () => {
        form.content = quill.root.innerHTML
    })
})

/* =========================
THUMBNAIL
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
        form.thumbnail = new File(
            [blob],
            'thumbnail.jpg',
            { type: 'image/jpeg' }
        )
    })

    cropper.destroy()

    const modal =
        bootstrap.Modal.getInstance(cropperModal.value)

    modal.hide()
}

const removeThumbnail = () => {
    previewUrl.value = null
    form.thumbnail = null

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
watch(() => form.status, (val) => {
    if (val === 'published' && !form.published_at) {
        const today = new Date().toISOString().split('T')[0]
        form.published_at = today
    }
})
</script>

<template>
    <Head title="Create Article" />

    <AdminLayout>

        <!-- TOOLBAR -->
        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="d-flex text-gray-900 fw-bold my-1 fs-3">Articles</h1>
                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                        <li class="breadcrumb-item">
                            <Link :href="route('admin.dashboard')" class="text-gray-600 text-hover-primary">
                                Dashboard
                            </Link>
                        </li>
                        <li class="breadcrumb-item text-gray-600">Articles</li>
                        <li class="breadcrumb-item text-gray-600">Create</li>
                    </ul>
                </div>

                <div class="d-flex align-items-center">
                    <Link :href="route('admin.articles.index')" class="btn btn-light me-3">
                        Back
                    </Link>

                    <button
                        type="button"
                        class="btn btn-dark"
                        @click="save"
                        :disabled="form.processing"
                    >
                        Save
                    </button>
                </div>
            </div>
        </template>

        <div class="card">
            <div class="card-body">

                <form @submit.prevent="save">
                    <!-- TITLE -->
                    <div class="mb-5">
                        <label class="form-label">Title</label>

                        <input
                            type="text"
                            class="form-control"
                            v-model="form.title"
                        />
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

                        <!-- CARD CONTAINER -->
                        <div class="card shadow-sm border-0">

                            <div class="card-body text-center p-5">

                                <!-- EMPTY STATE -->
                                <div
                                    v-if="!previewUrl"
                                    class="border border-2 border-dashed rounded p-10 cursor-pointer hover-opacity bg-light"
                                    @click="triggerFileInput"
                                >
                                    <i class="ki-duotone ki-add-item fs-3x">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>

                                    <div class="mt-4">
                                        <div class="fw-bold">
                                            Upload Thumbnail
                                        </div>
                                        <div class="fs-7">
                                            Recommended size 1200 x 675 (16:9)
                                        </div>
                                    </div>
                                </div>

                                <!-- PREVIEW STATE -->
                                <!-- PREVIEW STATE -->
                                <div v-else class="position-relative w-100">

                                    <!-- RATIO BOX -->
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
                                                @click="removeThumbnail"
                                            >
                                                ✕ Remove
                                            </button>
                                        </div>

                                    </div>

                                </div>

                                <div v-if="form.errors.thumbnail" class="text-danger mt-3">
                                    {{ form.errors.thumbnail }}
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- CATEGORY -->
                    <div class="mb-5">
                        <label class="form-label">Category</label>
                        <select class="form-select" v-model="form.category_id">
                            <option :value="null">-</option>
                            <option v-for="c in categories" :key="c.id" :value="c.id">
                                {{ c.name }}
                            </option>
                        </select>
                    </div>

                    <!-- TAGS -->
                    <div class="mb-5">
                        <label class="form-label">Tags</label>
                        <select ref="tagSelect" class="form-select" multiple>
                            <option v-for="tag in tags" :key="tag.id" :value="tag.id">
                                {{ tag.name }}
                            </option>
                        </select>
                    </div>

                    <!-- CONTENT -->
                    <div class="mb-5">
                        <label class="form-label">Content</label>
                        <div ref="editorRef" style="min-height:300px;"></div>
                    </div>
                    <div class="row mb-5">

                        <div class="col-md-4">

                            <label class="form-label">
                                Status
                            </label>

                            <select
                                class="form-select"
                                v-model="form.status"
                            >
                                <option value="draft">
                                    Draft
                                </option>

                                <option value="published">
                                    Published
                                </option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">
                                Published At
                            </label>
                            <input
                                type="date"
                                class="form-control"
                                v-model="form.published_at"
                            />
                        </div>
                        <div class="col-md-4 d-flex align-items-end">

                            <div class="form-check">

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    v-model="form.is_featured"
                                >

                                <label class="form-check-label">
                                    Featured
                                </label>

                            </div>

                        </div>

                    </div>
                </form>
            </div>
        </div>

        <!-- CROP MODAL FULLSCREEN CLEAN -->
        <div
            class="modal fade"
            ref="cropperModal"
            tabindex="-1"
        >
            <div class="modal-dialog modal-fullscreen m-0">
                <div class="modal-content border-0">

                    <!-- HEADER -->
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Crop Thumbnail</h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                        ></button>
                    </div>

                    <!-- BODY (NO SCROLL) -->
                    <div
                        class="modal-body p-0 bg-dark d-flex justify-content-center align-items-center"
                        style="overflow:hidden; height:100vh;"
                    >
                        <img
                            ref="cropperImage"
                            style="max-width:100%; max-height:100%;"
                        />
                    </div>

                    <!-- FOOTER -->
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal"
                        >
                            Cancel
                        </button>

                        <button
                            type="button"
                            class="btn btn-dark"
                            @click="cropImage"
                        >
                            Crop & Use Image
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </AdminLayout>
</template>
