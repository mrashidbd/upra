<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? "block w-full px-8 py-4 text-gray-800 transition duration-150 ease-in-out bg-gray-100 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-900 dark:focus:bg-gray-900"
        : "block w-full px-8 py-4 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-200 focus:bg-gray-200 focus:outline-none dark:text-gray-300 dark:hover:bg-gray-900 dark:focus:bg-gray-900",
);
</script>

<template>
    <Link :class="classes" :href="href">
        <slot />
    </Link>
</template>
