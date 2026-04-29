<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3'
import { ref, nextTick, onMounted, onBeforeUnmount, watch } from 'vue'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import Cropper from 'cropperjs/dist/cropper.js'

/* =========================
PROPS
========================= */
const props = defineProps({
    settings: Object
})

/* =========================
REFS
========================= */
const editorRef = ref(null)
const cropperImage = ref(null)
const cropperModal = ref(null)
const previewUrls = ref({
    foto_spa_1: props.settings.foto_spa_1 ? `/storage/${props.settings.foto_spa_1}` : null,
    foto_spa_2: props.settings.foto_spa_2 ? `/storage/${props.settings.foto_spa_2}` : null,
})

const currentPhotoKey = ref(null)
const fileInput = ref(null)

let quill = null
let cropper = null

/* =========================
FORM
========================= */
const form = useForm({
    motto: props.settings.motto || '',
    about: props.settings.about || '',
    foto_spa_1: null,
    foto_spa_2: null,
    remove_foto_spa_1: false,
    remove_foto_spa_2: false,

    kontak_telepon: props.settings.kontak_telepon || '',
    kontak_email: props.settings.kontak_email || '',
    kontak_alamat: props.settings.kontak_alamat || '',

    sosmed_facebook: props.settings.sosmed_facebook || '',
    sosmed_instagram: props.settings.sosmed_instagram || '',
    sosmed_youtube: props.settings.sosmed_youtube || '',
    sosmed_tiktok: props.settings.sosmed_tiktok || '',

    jam_kerja: props.settings.jam_kerja || '',
})

/* =========================
SAVE
========================= */
const save = () => {
    form.about = quill.root.innerHTML

    if (!form.foto_spa_1 && !form.remove_foto_spa_1) {
        delete form.foto_spa_1
    }

    if (!form.foto_spa_2 && !form.remove_foto_spa_2) {
        delete form.foto_spa_2
    }

    form
        .transform((data) => ({
            ...data,
            _method: 'put'
        }))
        .post(route('admin.settings.update'), {
            forceFormData: true
        })
}

/* =========================
QUILL
========================= */

onMounted(async () => {
    await nextTick()

    quill = new window.Quill(editorRef.value, {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, false] }],
                ['bold', 'italic', 'underline'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                ['link'],
                ['clean']
            ]
        }
    })

    // SET INITIAL VALUE
    quill.root.innerHTML = form.about || ''

    // 🔥 WAJIB: sync ke form
    quill.on('text-change', () => {
        form.about = quill.root.innerHTML
    })
})

/* =========================
IMAGE HANDLER
========================= */
const triggerFileInput = (photoKey) => {
    currentPhotoKey.value = photoKey
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
                aspectRatio: 3/4,
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
        width: 500,
        height: 500
    })

    previewUrls.value[currentPhotoKey.value] = canvas.toDataURL('image/jpeg')

    canvas.toBlob((blob) => {
        form[currentPhotoKey.value] = new File(
            [blob],
            `${currentPhotoKey.value}.jpg`,
            { type: 'image/jpeg' }
        )
    })

    cropper.destroy()

    const modal = bootstrap.Modal.getInstance(cropperModal.value)
    modal.hide()
}

const removeImage = (photoKey) => {
    previewUrls.value[photoKey] = null
    form[photoKey] = null
    form[`remove_${photoKey}`] = true

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
    <Head title="Settings" />

    <AdminLayout>

        <!-- TOOLBAR -->
        <template #Toolbar>
            <div class="toolbar mb-5">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="d-flex text-gray-900 fw-bold my-1 fs-3">Settings</h1>
                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                        <li class="breadcrumb-item">
                            <Link :href="route('admin.dashboard')" class="text-gray-600 text-hover-primary">
                                Dashboard
                            </Link>
                        </li>
                        <li class="breadcrumb-item text-gray-600">Settings</li>
                        <li class="breadcrumb-item text-gray-600">Edit</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center">
                    <Link :href="route('admin.settings.index')" class="btn btn-light me-2">
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

                <!-- PIMPINAN -->
                <h4 class="mb-5">About</h4>

                <div class="mb-5">
                    <label>Motto</label>
                    <input class="form-control" v-model="form.motto" />
                </div>

                <!-- FOTO -->
                <div class="row">
                    <!-- FOTO 1 -->
                    <div class="col-md-6 mb-7">
                        <label>Foto Spa 1</label>

                        <input type="file" ref="fileInput" class="d-none" @change="openCropper" />

                        <div class="card p-5 text-center">
                            <div v-if="!previewUrls.foto_spa_1" @click="triggerFileInput('foto_spa_1')" class="border p-5 cursor-pointer">
                                Upload Foto
                            </div>

                            <div v-else>
                                <img :src="previewUrls.foto_spa_1" style="width:150px;border-radius:10px" />
                                <div class="mt-3">
                                    <button class="btn btn-light btn-sm me-2" @click="triggerFileInput('foto_spa_1')">Edit</button>
                                    <button class="btn btn-danger btn-sm" @click="removeImage('foto_spa_1')">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FOTO 2 -->
                    <div class="col-md-6 mb-7">
                        <label>Foto Spa 2</label>

                        <div class="card p-5 text-center">
                            <div v-if="!previewUrls.foto_spa_2" @click="triggerFileInput('foto_spa_2')" class="border p-5 cursor-pointer">
                                Upload Foto
                            </div>

                            <div v-else>
                                <img :src="previewUrls.foto_spa_2" style="width:150px;border-radius:10px" />
                                <div class="mt-3">
                                    <button class="btn btn-light btn-sm me-2" @click="triggerFileInput('foto_spa_2')">Edit</button>
                                    <button class="btn btn-danger btn-sm" @click="removeImage('foto_spa_2')">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SAMBUTAN -->
                <div class="mb-5">
                    <label>Kata Sambutan</label>
                    <div ref="editorRef" style="min-height:200px;"></div>
                </div>

                <hr class="my-10" />

                <!-- KONTAK -->
                <h4 class="mb-5">Kontak</h4>

                <div class="mb-5">
                    <label>Telepon</label>
                    <input class="form-control" v-model="form.kontak_telepon" />
                </div>

                <div class="mb-5">
                    <label>Email</label>
                    <input class="form-control" v-model="form.kontak_email" />
                </div>

                <div class="mb-5">
                    <label>Alamat</label>
                    <textarea class="form-control" v-model="form.kontak_alamat"></textarea>
                </div>

                <hr class="my-10" />

                <!-- SOSMED -->
                <h4 class="mb-5">Sosial Media</h4>

                <div class="mb-5">
                    <label>Facebook</label>
                    <input class="form-control" v-model="form.sosmed_facebook" />
                </div>

                <div class="mb-5">
                    <label>Instagram</label>
                    <input class="form-control" v-model="form.sosmed_instagram" />
                </div>

                <div class="mb-5">
                    <label>YouTube</label>
                    <input class="form-control" v-model="form.sosmed_youtube" />
                </div>
                <div class="mb-5">
                    <label>TikTok</label>
                    <input class="form-control" v-model="form.sosmed_tiktok" />
                </div>
                <hr class="my-10" />

                <h4 class="mb-5">Jam Kerja</h4>

                <div class="mb-5">
                    <label>Jam Kerja</label>
                    <textarea
                        class="form-control"
                        v-model="form.jam_kerja"
                        rows="3"
                        placeholder="Contoh: Setiap hari 09:00 - 21:00"
                    ></textarea>
                </div>
            </div>
        </div>

        <!-- MODAL CROPPER -->
        <div class="modal fade" ref="cropperModal">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Crop Foto</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body bg-dark text-center">
                        <img ref="cropperImage" style="max-width:100%" />
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
