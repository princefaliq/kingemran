<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    category: Object,
    parents: Array
})

const form = useForm({
    name: props.category?.name || '',
    parent_id: props.category?.parent_id || null,
})

// fungsi submit
const submit = () => {
    if (props.category) {
        form.put(route('admin.categories.update', props.category.id))
    } else {
        form.post(route('admin.categories.store'))
    }
}

// expose ke parent supaya bisa dipanggil via ref
defineExpose({
    submit
})
</script>

<template>
    <div class="row">
        <!-- hanya name dan parent -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Name</label>
            <input
                type="text"
                class="form-control"
                v-model="form.name"
                :class="{ 'is-invalid': form.errors.name }"
            />
            <div class="invalid-feedback">{{ form.errors.name }}</div>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Parent</label>
            <select
                class="form-select"
                v-model="form.parent_id"
                :class="{ 'is-invalid': form.errors.parent_id }"
            >
                <option :value="null">-</option>
                <option v-for="parent in parents" :key="parent.id" :value="parent.id">
                    {{ parent.name }}
                </option>
            </select>
            <div class="invalid-feedback">{{ form.errors.parent_id }}</div>
        </div>
    </div>
</template>

<style scoped>

</style>
