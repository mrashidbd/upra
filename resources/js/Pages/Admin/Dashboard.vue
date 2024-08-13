<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Admin Dashboard" />

    <AdminLayout>
        <template #header>
            <h2 class="app-heading">Welcome Admin!</h2>
        </template>
        <template #default>
            <h1 class="text-2xl font-semibold">
                Welcome to the Admin Dashboard
            </h1>
            <!-- Add your admin dashboard content here -->
        </template>
    </AdminLayout>
</template>
