<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";
import SortArrowUp from "@/Components/Custom/SortArrowUp.vue";
import SortArrowDown from "@/Components/Custom/SortArrowDown.vue";
import { reactive, watch } from "vue";
// import { usePage } from "@inertiajs/vue3";
// import Modal from "@/Components/Modal.vue";
// import SecondaryButton from "@/Components/SecondaryButton.vue";
// import DangerButton from "@/Components/DangerButton.vue";

const props = defineProps({
    users: {
        type: Object,
        default: () => ({}),
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
});

// const searchInput = ref(null);

// const form = useForm();

const params = reactive({
    search: props.filters.search,
    field: props.filters.field,
    direction: props.filters.direction,
});

watch(params, () => {
    let p = params;

    Object.keys(p).forEach((key) => {
        if (p[key] === "") {
            delete p[key];
        }
    });

    router.get(route("admin.userslist"), p, {
        preserveState: true,
        preserveScroll: true,
    });
});

function sort(field) {
    params.field = field;
    params.direction = params.direction === "asc" ? "desc" : "asc";
}

// function destroy(id) {
//     if (confirm("Are you sure you want to Delete")) {
//         form.delete(route("posts.destroy", id));
//     }
// }

function determineSortDirection(field, direction) {
    return params.field === field && params.direction === direction;
}

function publish(post, is_active) {
    router.put(
        route("admin.userslist", post),
        {
            is_active: is_active,
        },
        {
            preserveState: true,
            preserveScroll: true,
        },
    );
}

function setSearchInput(input, event) {
    params.search = input;
}
</script>

<template>
    <Head title="Admin Dashboard" />

    <AdminLayout>
        <template #header>
            <h2 class="app-heading">List of Users</h2>
        </template>
        <template #default>
            <!-- Add your admin dashboard content here -->

            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table
                    class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm"
                >
                    <thead class="text-left">
                        <tr>
                            <th
                                class="px-6 py-3"
                                scope="col"
                                @click="sort('name')"
                            >
                                <span
                                    class="inline-flex w-full justify-between px-6 py-3"
                                >
                                    Name
                                    <SortArrowUp
                                        v-if="
                                            determineSortDirection(
                                                'name',
                                                'asc',
                                            )
                                        "
                                    >
                                    </SortArrowUp>
                                    <SortArrowDown
                                        v-if="
                                            determineSortDirection(
                                                'name',
                                                'desc',
                                            )
                                        "
                                    >
                                    </SortArrowDown>
                                </span>
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                Email Address
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                Phone
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                Email Verified?
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        <tr v-for="user in users.data" :key="user.id">
                            <td
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                {{ user.user_name }}
                            </td>
                            <td
                                class="whitespace-nowrap px-4 py-2 text-gray-700"
                            >
                                {{ user.email }}
                            </td>
                            <td
                                class="whitespace-nowrap px-4 py-2 text-gray-700"
                            >
                                {{ user.phone }}
                            </td>
                            <td
                                class="whitespace-nowrap px-4 py-2 text-gray-700"
                            >
                                {{ user.created_at_humanized }}
                            </td>
                            <td
                                class="whitespace-nowrap px-4 py-2 text-gray-700"
                            >
                                <!--                                <DangerButton @click="confirmUserDeletion"-->
                                <!--                                    >Delete Account</DangerButton-->
                                <!--                                >-->
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mx-auto max-w-4xl p-6">
                <Pagination :links="users.links" class="mt-6" />
            </div>

            <!--            <Modal :show="confirmingUserDeletion" @close="closeModal">-->
            <!--                <div class="p-6">-->
            <!--                    <h2 class="text-lg font-medium text-gray-900">-->
            <!--                        Are you sure you want to delete your account?-->
            <!--                    </h2>-->

            <!--                    <p class="mt-1 text-sm text-gray-600">-->
            <!--                        Once your account is deleted, all of its resources and-->
            <!--                        data will be permanently deleted. Please enter your-->
            <!--                        password to confirm you would like to permanently delete-->
            <!--                        your account.-->
            <!--                    </p>-->

            <!--                    <div class="mt-6 flex justify-end">-->
            <!--                        <SecondaryButton @click="closeModal">-->
            <!--                            Cancel-->
            <!--                        </SecondaryButton>-->

            <!--                        <DangerButton-->
            <!--                            class="ms-3"-->
            <!--                            :class="{ 'opacity-25': form.processing }"-->
            <!--                            :disabled="form.processing"-->
            <!--                            @click="deleteUser"-->
            <!--                        >-->
            <!--                            Delete User-->
            <!--                        </DangerButton>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </Modal>-->
        </template>
    </AdminLayout>
</template>
