<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Admin Dashboard" />

    <AdminLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ $page.props.title }}
            </h2>
        </template>
        <template #default>
            <h1 class="text-2xl font-semibold text-gray-900">
                Welcome to the Admin Dashboard
            </h1>
            <!-- Add your admin dashboard content here -->
        </template>
    </AdminLayout>
</template>
