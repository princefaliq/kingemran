<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head, Link, router } from '@inertiajs/vue3'
import Draggable from 'vuedraggable'
import { ref } from 'vue'

const props = defineProps({
    menus: Array
})

// clone supaya tidak modify props langsung
const menus = ref(JSON.parse(JSON.stringify(props.menus)))

const updateOrder = () => {
    router.post(route('admin.menu.saveOrder'), {
        menus: menus.value
    }, {
        preserveScroll: true
    })
}
</script>

<template>
    <Head title="Reorder Menu" />

    <AdminLayout>
        <!-- Toolbar -->
        <template #Toolbar>
            <div class="toolbar mb-5 mb-lg-7">
                <div class="page-title d-flex flex-column me-3">
                    <h1 class="d-flex text-gray-900 fw-bold my-1 fs-3">
                        Menu Manager
                    </h1>

                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                        <li class="breadcrumb-item text-gray-600">
                            <Link :href="route('admin.dashboard')" class="text-gray-600 text-hover-primary">
                                Dashboard
                            </Link>
                        </li>
                        <li class="breadcrumb-item text-gray-600">
                            Menu Manager
                        </li>
                        <li class="breadcrumb-item text-gray-600">
                            Reorder
                        </li>
                    </ul>
                </div>

                <div class="d-flex align-items-center py-2 py-md-1">
                    <Link :href="route('admin.menu.index')" class="btn btn-light fw-bold me-2">
                        Back
                    </Link>

                    <button class="btn btn-dark fw-bold" @click="updateOrder">
                        Save
                    </button>
                </div>
            </div>
        </template>

        <!-- Card -->
        <div class="card">
            <div class="card-header border-0 py-5">
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">
                        Drag & Drop Menu Order
                    </h3>
                </div>
            </div>

            <div class="card-body">

                <!-- PARENT DRAG -->
                <Draggable
                    v-model="menus"
                    group="menus"
                    item-key="id"
                    animation="200"
                >
                    <template #item="{ element }">

                        <div class="mb-4 border rounded p-4 bg-light draggable-item">

                            <!-- Parent Title -->
                            <div class="fw-bold mb-0">
                                ☰ {{ element.name }}
                            </div>

                            <!-- CHILD DRAG -->
                            <Draggable
                                v-model="element.children"
                                group="menus"
                                item-key="id"
                                animation="200"
                                class="ms-5"
                            >
                                <template #item="{ element: child }">
                                    <div class="border rounded p-3 bg-white mb-2 draggable-item mt-3">
                                        ☰ {{ child.name }}
                                    </div>
                                </template>
                            </Draggable>

                        </div>

                    </template>
                </Draggable>

            </div>
        </div>
    </AdminLayout>
</template>

<style scoped>
.draggable-item {
    cursor: grab;
}

.sortable-chosen {
    cursor: grabbing !important;
}

.sortable-ghost {
    opacity: 0.5;
}
</style>
