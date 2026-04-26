<script setup>
const props = defineProps({
    form: Object
})
</script>

<template>
    <div class="card">
        <div class="card-header border-0 py-5">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Create Tags</h3>
            </div>
        </div>
        <div class="card-body">

            <div class="mb-5">
                <label class="form-label fw-bold">Tag Name</label>
                <input
                    v-model="form.name"
                    type="text"
                    class="form-control"
                    placeholder="Enter tag name"
                />
                <div v-if="form.errors.name" class="text-danger mt-2">
                    {{ form.errors.name }}
                </div>
            </div>

        </div>
    </div>
</template>

<style scoped>

</style>
