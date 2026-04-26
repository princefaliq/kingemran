<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref, onMounted, nextTick, watch  } from "vue";

const form = useForm({
    name: '',
    title: '',
    slug: '',
    content_type: 'editor',
    content: '',
    pdf: null
})

const submit = () => {
    form.post(route('admin.pages.store'))
}

const handleFile = (e) => {
    form.pdf = e.target.files[0]
}
//quill
const editorRef = ref(null)
let quillInstance = null

onMounted(async () => {
    await nextTick()

    if (!editorRef.value || !window.Quill) return

    quillInstance = new window.Quill(editorRef.value, {
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

    quillInstance.on('text-change', () => {
        form.content = quillInstance.root.innerHTML
    })
})
</script>

<template>
    <Head title="Create Page" />

    <AdminLayout>
        <!-- Toolbar -->
        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="d-flex text-gray-900 fw-bold my-1 fs-3">Pages</h1>
                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                        <li class="breadcrumb-item text-gray-600">
                            <Link :href="route('admin.dashboard')" class="text-gray-600 text-hover-primary">
                                Dashboard
                            </Link>
                        </li>
                        <li class="breadcrumb-item text-gray-600">
                            <Link :href="route('admin.pages.index')" class="text-gray-600">Pages</Link>
                        </li>
                        <li class="breadcrumb-item text-gray-600">Create</li>
                    </ul>
                </div>

                <div class="d-flex align-items-center py-2 py-md-1">
                    <Link :href="route('admin.pages.index')" class="btn btn-light fw-bold me-3">
                        Back
                    </Link>

                    <button
                        type="button"
                        class="btn btn-dark fw-bold"
                        :disabled="form.processing"
                        @click="submit"
                    >
                        Save
                    </button>
                </div>
            </div>
        </template>

        <!-- Content -->
        <div class="row g-5 g-lg-12">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0 py-5">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Create Page</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <form @submit.prevent="submit">

                            <!-- Name -->
                            <div class="mb-5">
                                <label class="form-label required">Name</label>
                                <input v-model="form.name" type="text" class="form-control" />
                                <div v-if="form.errors.name" class="text-danger mt-1">
                                    {{ form.errors.name }}
                                </div>
                            </div>

                            <!-- Title -->
                            <div class="mb-5">
                                <label class="form-label required">Title</label>
                                <input v-model="form.title" type="text" class="form-control" />
                                <div v-if="form.errors.title" class="text-danger mt-1">
                                    {{ form.errors.title }}
                                </div>
                            </div>

                            <!-- Slug (Optional) -->
<!--                            <div class="mb-5">
                                <label class="form-label">Slug (optional)</label>
                                <input v-model="form.slug" type="text" class="form-control" />
                                <small class="text-muted">
                                    Kosongkan untuk auto generate
                                </small>
                            </div>-->

                            <!-- Content Type -->
                            <div class="mb-5">
                                <label class="form-label required">Content Type</label>
                                <select v-model="form.content_type" class="form-select">
                                    <option value="editor">Text Editor</option>
                                    <option value="pdf">Preview PDF</option>
                                    <option value="editor_pdf">Editor + PDF</option>
                                </select>
                            </div>

                            <!-- Content -->
                            <div
                                v-show="form.content_type === 'editor' || form.content_type === 'editor_pdf'"
                                class="mb-5"
                            >
                                <label class="form-label">Content</label>
                                <div ref="editorRef" style="min-height:300px;"></div>

                                <div v-if="form.errors.content" class="text-danger mt-1">
                                    {{ form.errors.content }}
                                </div>
                            </div>

                            <!-- PDF Upload -->
                            <div
                                v-show="form.content_type === 'pdf' || form.content_type === 'editor_pdf'"
                                class="mb-5"
                            >
                                <label class="form-label">Upload PDF</label>
                                <input
                                    type="file"
                                    class="form-control"
                                    accept="application/pdf"
                                    @change="handleFile"
                                />
                                <div v-if="form.errors.pdf" class="text-danger mt-1">
                                    {{ form.errors.pdf }}
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </AdminLayout>
</template>

<style scoped>

</style>
