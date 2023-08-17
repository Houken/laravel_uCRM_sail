<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import FlashMessage from '@/Components/FlashMessage.vue';
import Pagination from '@/Components/Pagination.vue';
import { ref } from 'vue';

defineProps({
    customers: Object
})

const search = ref('')

const searchCustomers = () => {
    router.get(route('customers.index', {
        search: search.value
    }))
}
</script>

<template>
    <Head title="顧客一覧" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">顧客一覧</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-2 mx-auto">
                            <FlashMessage />
                            <div class="flex w-full p-4 mx-auto mt-4 lg:w-2/3">
                                <div>
                                    <input type="text" name="search" v-model="search">
                                    <button class="p-2 text-white bg-blue-300" @click="searchCustomers">検索</button>
                                </div>
                                <Link as="button" :href="route('customers.create')"
                                    class="flex px-6 py-2 ml-auto text-white bg-indigo-500 border-0 rounded focus:outline-none hover:bg-indigo-600">
                                顧客登録</Link>
                            </div>
                            <div class="w-full mx-auto overflow-auto lg:w-2/3">
                                <table class="w-full text-left whitespace-no-wrap table-auto">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-4 py-2 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 rounded-tl rounded-bl title-font">
                                                id</th>
                                            <th
                                                class="px-4 py-2 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                                                氏名</th>
                                            <th
                                                class="px-4 py-2 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                                                カナ</th>
                                            <th
                                                class="px-4 py-2 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                                                電話</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="customer in customers.data" :key="customer.id">
                                            <td class="px-4 py-1 text-sm border-b-2 border-gray-200">
                                                <Link :href="route('customers.show', { customer: customer.id })">{{ customer.id }}</Link>
                                            </td>
                                            <td class="px-4 py-1 text-sm border-b-2 border-gray-200">{{ customer.name }}
                                            </td>
                                            <td class="px-4 py-1 text-sm border-b-2 border-gray-200">{{ customer.kana }}
                                            </td>
                                            <td class="px-4 py-1 text-sm border-b-2 border-gray-200">{{ customer.tel }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <Pagination class="mt-6" :links="customers.links"></Pagination>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
