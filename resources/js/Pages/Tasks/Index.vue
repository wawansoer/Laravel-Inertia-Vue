<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import BreezeButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    tasks: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({});

function destroy(id, name) {
    if (confirm(`Are you sure you want to Delete ${name}`)) {
        form.delete(route('task.destroy', id));
    }
}
</script>

<template>

    <Head title="Tasks" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Tasks List
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    v-if="$page.props.flash.message"
                    class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                    role="alert"
                >
                    <span class="font-medium">
                        {{ $page.props.flash.message }}
                    </span>
                </div>
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-2 object-left-top">
                            <Link :href="route('task.create')">
                                <BreezeButton>Add Task</BreezeButton>
                            </Link>
                        </div>
                        <div
                            class="relative overflow-x-auto shadow-md sm:rounded-lg"
                        >
                            <table
                                class="w-full text-sm text-center text-gray-500 dark:text-gray-400"
                            >
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                                >
                                <tr>
                                    <th scope="col" class="px-6 py-3">#</th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Description
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr
                                    v-for="(task, index) in tasks.data"
                                    :key="task.id"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                >
                                    <td
                                        class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                                    >
                                        {{ (tasks.current_page - 1) * 10 + index + 1 }}
                                    </td>

                                    <td
                                        class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                                    >
                                        {{ task.name }}
                                    </td>

                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        {{ task.category.name }}
                                    </td>

                                    <td class="px-6 py-4 ">
                                        {{ task.detail }}
                                    </td>


                                    <td class="px-6 py-4">
                                        <Link
                                            :href="
                                                    route(
                                                        'task.edit',
                                                        task.id
                                                    )
                                                "
                                            class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-400"
                                        >
                                            Edit
                                        </Link>

                                        <BreezeButton
                                            class="px-4 py-2 ml-2 bg-red-700"
                                            @click="destroy(task.id, task.name)"
                                        >
                                            Delete
                                        </BreezeButton>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            <ul class="flex justify-center space-x-2">
                                <li
                                    v-for="page in tasks.last_page"
                                    :key="page"
                                    :class="{ active: tasks.current_page === page }"
                                >
                                    <a
                                        @click.prevent="$inertia.visit(`http://localhost:8000/task?page=${page}`)"
                                        href="#"
                                        class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300"
                                    >
                                        {{ page }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
