<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import SubmitButton from "@/Components/SecondaryButton.vue";

const props = defineProps({
    categories: {
        type: Object,
        default: () => ({}),
    },
    task: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    name: props.task.name,
    detail: props.task.detail,
    category: props.task.m_category_id,

});

const submit = () => {
    form.put(route("task.update", props.task.id));
};

</script>

<template>

    <Head title="Edit Tasks" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit Tasks
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div class="mb-6">
                                <label
                                    for="Title"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                >Category</label
                                >
                                <select
                                    v-model="form.category"
                                    name="title"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                >   <option>Please select one category</option>
                                    <option v-for="(option, index) in categories" :key="index" :value="option.id">
                                        {{ option.name }}
                                    </option>
                                </select>
                                <div
                                    v-if="form.errors.category"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.category }}
                                </div>
                            </div>
                            <div class="mb-6">
                                <label
                                    for="Slug"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                >Task Name</label
                                >
                                <input
                                    type="text"
                                    v-model="form.name"
                                    name="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder=""
                                />
                                <div
                                    v-if="form.errors.name"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.name }}
                                </div>
                            </div>
                            <div class="mb-6">
                                <label
                                    for="slug"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                >Detail</label
                                >
                                <textarea
                                    type="text"
                                    v-model="form.detail"
                                    name="detail"
                                    id=""
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                ></textarea>

                                <div
                                    v-if="form.errors.detail"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.detail }}
                                </div>
                            </div>
                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-gray-800 border border-gray-300 rounded-md font-semibold text-xs text-gray-100 uppercase tracking-widest shadow-sm hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                            >
                                Submit
                            </button>

                            <button
                                type="reset"
                                class="inline-flex items-center px-4 py-2 bg-gray-600 dark:bg-gray-800 border border-gray-300 rounded-md font-semibold text-xs text-gray-100 uppercase tracking-widest shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                            >
                                Reset
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>
