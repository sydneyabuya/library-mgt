<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from 'vue';
import Dropdown from "@/Components/Dropdown.vue";

const date = ref(new Date());

const props = defineProps({
    book: {
        type: Object,
        default: () => ({}),
    },
    authors: { Object },
});

const form = useForm({
    id: props.book.id,
    title: props.book.title,
    publication_yr: props.book.publication_yr,
    author_id: props.book.author.id,
});


const submit = () => {
    form.put(route("book.update", props.book.id));
};
</script>

<template>
    <Head title="Book Edit" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Book Edit
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="title" value="Title" />

                                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required
                                    autofocus autocomplete="username" />

                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>

                            <div class="my-6">
                                <InputLabel for="author" value="Author" />

                                <select id="author" type="text" class="mt-1 block w-full" v-model="form.author" required
                                    autofocus autocomplete="" >
                                    <option value="">Select an author</option>
                                    <option v-for="author in authors" :key="author.id" :value="author.id">{{ author.name }}</option>
                                </select>

                                <InputError class="mt-2" :message="form.errors.author" />
                            </div>
                            <div class="my-6">
                                <label for="slug"
                                    class="block mb-2 text-sm font-medium text-gray-900">Publication Year</label>

                                <!-- <VueDatePicker v-model="date" month-name-format="long" /> -->
                                <input type="date" v-model="form.publication_yr" name="publication_yr" id=""
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                                <div v-if="form.errors.content" class="text-sm text-red-600">
                                    {{ form.errors.publication_yr }}
                                </div>
                            </div>
                            <PrimaryButton type="submit" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Submit
                            </PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
