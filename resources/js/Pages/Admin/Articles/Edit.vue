<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3'
import { ref, onMounted, nextTick, onBeforeUnmount, watch } from 'vue'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import Cropper from 'cropperjs/dist/cropper.js'

/* =========================
PROPS
========================= */

const props = defineProps({
    article: Object,
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
const previewUrl = ref(
    props.article.thumbnail
        ? `/storage/${props.article.thumbnail}`
        : null
)
const fileInput = ref(null)

let quill = null
let cropper = null

/* =========================
FORM
========================= */
const formatDate = (datetime) => {
    if (!datetime) return null
    return datetime.split(' ')[0] // ambil tanggal saja
}
const form = useForm({
    title: props.article.title,
    slug: props.article.slug,
    category_id: props.article.category_id,
    content: props.article.content,
    tag_ids: props.article.tags?.map(t => t.id) ?? [],
    thumbnail: null,
    remove_thumbnail: false,
    status: props.article.status,
    published_at: formatDate(props.article.published_at), // FIX
    is_featured: !!props.article.is_featured
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
    // ✅ WAJIB: sync Quill ke form
    form.content = quill.root.innerHTML

    // optional: handle thumbnail
    if (!form.thumbnail && !form.remove_thumbnail) {
        delete form.thumbnail
    }

    form
        .transform((data) => ({
            ...data,
            _method: 'put',
            is_featured: data.is_featured ? 1 : 0,
            tag_ids: data.tag_ids ?? []
        }))
        .post(route('admin.articles.update', props.article.id), {
            forceFormData: true,
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

    window.$(tagSelect.value)
        .val(form.tag_ids)
        .trigger('change')

    window.$(tagSelect.value).on('change', function () {
        form.tag_ids = window.$(this).val() ?? []
    })

    // QUILL
    quill = new window.Quill(editorRef.value, {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, false] }],
                ['bold', 'italic', 'underline'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                ['link', 'image'],
                ['clean']
            ]
        }
    })

    quill.root.innerHTML = form.content || ''

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

    const modal = bootstrap.Modal.getInstance(cropperModal.value)
    modal.hide()
}

const removeThumbnail = () => {
    previewUrl.value = null
    form.thumbnail = null
    form.remove_thumbnail = true

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
    <Head title="Edit Article" />

    <AdminLayout>

        <!-- TOOLBAR -->
        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="fw-bold fs-3">Articles</h1>

                    <ul class="breadcrumb breadcrumb-dot fs-7">
                        <li class="breadcrumb-item">
                            <Link :href="route('admin.dashboard')" class="text-gray-600 text-hover-primary">Dashboard</Link>
                        </li>
                        <li class="breadcrumb-item text-gray-600">Articles</li>
                        <li class="breadcrumb-item text-gray-600">Edit</li>
                    </ul>
                </div>

                <div>
                    <Link :href="route('admin.articles.index')" class="btn btn-light me-3">
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

        <div class="card">
            <div class="card-header border-0 py-5">
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Edit Articles</h3>
                </div>
            </div>
            <div class="card-body">
                <div v-if="Object.keys(form.errors).length" class="alert alert-danger">
                    <ul>
                        <li v-for="(error, key) in form.errors" :key="key">
                            {{ error }}
                        </li>
                    </ul>
                </div>
                <form @submit.prevent="save">

                    <!-- TITLE -->
                    <div class="mb-5">
                        <label class="form-label">Title</label>
                        <input class="form-control" v-model="form.title" />
                    </div>

                    <!-- THUMBNAIL -->
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

                                <!-- EMPTY -->
                                <div
                                    v-if="!previewUrl"
                                    class="border border-2 border-dashed rounded p-10 cursor-pointer"
                                    style="background:#f8f9fa; transition:0.3s"
                                    @click="triggerFileInput"
                                >
                                    <i class="ki-duotone ki-picture fs-3x text-gray-400"></i>

                                    <div class="mt-4">
                                        <div class="fw-bold text-gray-700">
                                            Upload Thumbnail
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
                        <label>Category</label>
                        <select class="form-select" v-model="form.category_id">
                            <option :value="null">-</option>
                            <option v-for="c in categories" :key="c.id" :value="c.id">
                                {{ c.name }}
                            </option>
                        </select>
                    </div>

                    <!-- TAGS -->
                    <div class="mb-5">
                        <label>Tags</label>
                        <select ref="tagSelect" class="form-select" multiple>
                            <option v-for="t in tags" :key="t.id" :value="t.id">
                                {{ t.name }}
                            </option>
                        </select>
                    </div>

                    <!-- CONTENT -->
                    <div class="mb-5">
                        <label>Content</label>
                        <div ref="editorRef" style="min-height:300px;"></div>
                    </div>

                    <!-- STATUS -->
                    <div class="row">
                        <div class="col-md-4">
                            <label>Status</label>
                            <select v-model="form.status" class="form-select">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Published At</label>
                            <input type="date" v-model="form.published_at" class="form-control" />
                        </div>

                        <div class="col-md-4 d-flex align-items-end">
                            <div class="form-check">
                                <input type="checkbox" v-model="form.is_featured" class="form-check-input">
                                <label class="form-check-label">Featured</label>
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

                    <div
                        class="modal-body p-0 bg-dark d-flex justify-content-center align-items-center"
                        style="overflow:hidden; height:100vh;"
                    >
                        <img ref="cropperImage" style="max-width:100%; max-height:100%;" />
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-dark" @click="cropImage">Crop & Use Image</button>
                    </div>

                </div>
            </div>
        </div>

    </AdminLayout>
</template>
