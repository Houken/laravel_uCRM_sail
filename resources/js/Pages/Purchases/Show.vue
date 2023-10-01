<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import { onMounted, ref, computed } from 'vue';
import dayjs from 'dayjs';


const props = defineProps({
    'items': Array,
    'order': Array,
})

const form = useForm({
    date: null,
    customer_id: null,
    status: true,
    items: [],
})

onMounted(() => {
    console.log(props.items)
    console.log(props.order)
})
</script>

<template>
    <Head title="購買履歴 詳細" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">購買履歴 詳細</h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <section class="relative text-gray-600 body-font">
                        <div class="container px-5 py-16 mx-auto">
                            <form @submit.prevent="storePurchase">
                                <div class="mx-auto">
                                    <div class="mb-4">
                                        <div class="p-2 full">
                                            <label for="date" class="ml-4 mr-2 text-sm leading-7 text-gray-600">日付</label>
                                            <div type="date" name="date" id="date"
                                                class="w-1/2 px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                                                {{ dayjs(props.order[0].created_at).format('YYYY/MM/DD') }}</div>
                                        </div>
                                        <div class="p-2 full">
                                            <div class="relative">
                                                <label for="customer"
                                                    class="ml-4 mr-2 text-sm leading-7 text-gray-600">顧客名</label>
                                                <div name="customer"
                                                    class="w-1/2 px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                                                    {{ props.order[0].customer_name }}</div>
                                                <InputError class="mt-2" :message="form.errors.cutomer" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap m-2">
                                        <table class="w-full text-left whitespace-no-wrap table-auto">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="px-4 py-3 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                                                        id
                                                    </th>
                                                    <th
                                                        class="px-4 py-3 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                                                        商品名
                                                    </th>
                                                    <th
                                                        class="px-4 py-3 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                                                        単価
                                                    </th>
                                                    <th
                                                        class="px-4 py-3 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                                                        数量
                                                    </th>
                                                    <th
                                                        class="px-4 py-3 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                                                        小計
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="item in props.items" class="border-b-2">
                                                    <td class="px-4 py-3">{{ item.item_id }}</td>
                                                    <td class="px-4 py-3">{{ item.item_name }}</td>
                                                    <td class="px-4 py-3">{{ item.item_price }}</td>
                                                    <td class="px-4 py-3">
                                                        {{ item.quantity }}
                                                    </td>
                                                    <td class="px-4 py-3">{{ item.subtotal }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-2">
                                        <label class="mr-2">合計:</label>
                                        <p
                                            class="px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-end">
                                            {{ props.order[0].total }} 円</p>
                                    </div>
                                    <div>
                                        <label>ステータス:</label>
                                        <div v-if="props.order[0].status == true" class="mt-2 text-end">
                                            <p
                                                class="px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-end">
                                                有効</p>
                                        </div>
                                        <div v-if="props.order[0].status == false" class="mt-2 text-end">
                                            <p
                                                class="px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-end">
                                                キャンセルされています</p>
                                        </div>
                                    </div>
                                    <div v-if="props.order[0].status == false" class="mt-2">
                                        <label class="mr-2">キャンセル日</label>
                                        <p
                                            class="px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-end">
                                            {{ dayjs(props.order[0].updated_at).format('YYYY/MM/DD') }}</p>
                                    </div>
                                    <div v-if="props.order[0].status == true" class="w-full p-2 mt-8">
                                        <Link as="button" :href="route('purchases.edit', { purchase: props.order[0].id })" class="flex px-8 py-2 mx-auto text-lg text-white bg-indigo-500 border-0 rounded focus:outline-none hover:bg-indigo-600">編集する</Link>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
            </div>
        </div>
    </div>
</AuthenticatedLayout></template>
