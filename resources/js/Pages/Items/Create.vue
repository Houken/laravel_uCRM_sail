<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputError from  '@/Components/InputError.vue';

const form = useForm({
    name: null,
    memo: null,
    price: null,
})

const storeItem = () => {
    form.post('/items')
}
</script>

<template>
    <Head title="商品登録" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">商品登録</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <section class="relative text-gray-600 body-font">
                        <div class="container px-5 py-24 mx-auto">
                            <form @submit.prevent="storeItem">
                                <div class="mx-auto lg:w-1/2 md:w-2/3">
                                    <div class="flex flex-wrap -m-2">
                                        <div class="w-full p-2">
                                            <div class="relative">
                                                <label for="name" class="text-sm leading-7 text-gray-600">商品名</label>
                                                <input type="text" id="name" name="name" v-model="form.name"
                                                    class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                                                <InputError class="mt-2" :message="form.errors.name" />
                                            </div>
                                        </div>
                                        <div class="w-full p-2">
                                            <div class="relative">
                                                <label for="price" class="text-sm leading-7 text-gray-600">価格</label>
                                                <input type="number" id="price" name="price" v-model="form.price"
                                                    class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                                                <InputError class="mt-2" :message="form.errors.price" />
                                            </div>
                                        </div>
                                        <div class="w-full p-2">
                                            <div class="relative">
                                                <label for="memo" class="text-sm leading-7 text-gray-600">メモ</label>
                                                <textarea id="memo" name="memo" v-model="form.memo"
                                                    class="w-full h-32 px-3 py-1 text-base leading-6 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none resize-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"></textarea>
                                                <InputError class="mt-2" :message="form.errors.memo" />
                                            </div>
                                        </div>
                                        <div class="w-full p-2">
                                            <button
                                                class="flex px-8 py-2 mx-auto text-lg text-white bg-indigo-500 border-0 rounded focus:outline-none hover:bg-indigo-600">登録する</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
