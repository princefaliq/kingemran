<script setup>
    import { Head, Link, useForm } from '@inertiajs/vue3'
    import { onMounted, ref, watch } from 'vue'
    import AdminLayout from '@/Layouts/AdminLayout.vue'


    const props = defineProps({
        page: Object
    })

    const editorRef = ref(null)
    let quill = null

    const form = useForm({
        name: props.page.name,
        title: props.page.title,
        content_type: props.page.content_type,
        content: props.page.content,
        pdf: null
    })

    const initQuill = () => {
        if (!editorRef.value || quill) return

        if (!window.Quill) {
            console.error('Quill not loaded from Metronic')
            return
        }

        quill = new window.Quill(editorRef.value, {
            theme: 'snow'
        })

        quill.root.innerHTML = form.content ?? ''

        quill.on('text-change', () => {
            form.content = quill.root.innerHTML
        })
    }


    onMounted(() => {
        if (
            form.content_type === 'editor' ||
            form.content_type === 'editor_pdf'
        ) {
            initQuill()
        }
    })

    watch(() => form.content_type, (val) => {
        if ((val === 'editor' || val === 'editor_pdf') && !quill) {
            initQuill()
        }
    })

    const handleFile = (e) => {
        form.pdf = e.target.files[0]
    }

    const submit = () => {
        form.transform((data) => ({
            ...data,
            _method: 'put'
        })).post(route('admin.pages.update', props.page.id))
    }

</script>

<template>
    <Head title="Edit Page" />

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
                        <li class="breadcrumb-item text-gray-600">Pages</li>
                        <li class="breadcrumb-item text-gray-600">Edit</li>
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
                        Update
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
                            <h3 class="fw-bold m-0">Edit Page</h3>
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

                                <!-- Show existing file -->
                                <div v-if="props.page.pdf_path" class="mb-3">
                                    <a
                                        :href="`/storage/${props.page.pdf_path}`"
                                        target="_blank"
                                        class="btn btn-light-primary btn-sm"
                                    > <i class="ki-duotone ki-click fs-5 me-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                        View Current PDF
                                    </a>
                                </div>

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
