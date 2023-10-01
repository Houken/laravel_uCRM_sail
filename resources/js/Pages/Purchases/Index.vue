<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { onMounted } from 'vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import FlashMessage from '@/Components/FlashMessage.vue';
import { ref } from 'vue';
import dayjs from 'dayjs';

const props = defineProps({
    orders: Object
})

onMounted(() => {
    console.log(props.orders.data)
})
</script>

<template>
    <Head title="顧客一覧" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">購買履歴</h2>
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
                                                顧客名</th>
                                            <th
                                                class="px-4 py-2 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                                                合計金額</th>
                                            <th
                                                class="px-4 py-2 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                                                ステータス</th>
                                            <th
                                                class="px-4 py-2 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                                                購入日</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="order in props.orders.data" :key="order.id">
                                            <td class="px-4 py-1 text-sm border-b-2 border-gray-200"><Link class="text-blue-400" :href="route('purchases.show', { purchase: order.id })"> {{ order.id }}</Link>
                                            </td>
                                            <td class="px-4 py-1 text-sm border-b-2 border-gray-200">{{ order.customer_name }}
                                            </td>
                                            <td class="px-4 py-1 text-sm border-b-2 border-gray-200">{{ order.total }}
                                            </td>
                                            <td class="px-4 py-1 text-sm border-b-2 border-gray-200">{{ order.status }}</td>
                                            <td class="px-4 py-1 text-sm border-b-2 border-gray-200">{{ dayjs(order.created_at).format('YYYY-MM-DD HH:mm:ss') }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <Pagination class="mt-6" :links="props.orders.links"></Pagination>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
