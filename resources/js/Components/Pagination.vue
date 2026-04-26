<script setup>
    import { Link } from '@inertiajs/vue3'

    defineProps({
    links: Array
})
</script>

<template>
    <ul class="pagination pagination-circle pagination-outline">
        <li
            v-for="(link, index) in links"
            :key="index"
            class="page-item m-1"
            :class="{
                active: link.active,
                disabled: !link.url,
                previous: link.label.includes('Previous'),
                next: link.label.includes('Next')
            }"
        >
            <Link
                v-if="link.url"
                :href="link.url"
                class="page-link"
            >
                <!-- Previous Icon -->
                <i
                    v-if="link.label.includes('Previous')"
                    class="previous"
                ></i>

                <!-- Next Icon -->
                <i
                    v-else-if="link.label.includes('Next')"
                    class="next"
                ></i>

                <!-- Number -->
                <span v-else v-html="link.label"></span>
            </Link>

            <!-- Disabled -->
            <span
                v-else
                class="page-link"
            >
                <i
                    v-if="link.label.includes('Previous')"
                    class="previous"
                ></i>

                <i
                    v-else-if="link.label.includes('Next')"
                    class="next"
                ></i>

                <span v-else v-html="link.label"></span>
            </span>
        </li>
    </ul>
</template>

<style scoped>

</style>
