<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import { getToday } from '@/common';
import { onMounted, ref, computed } from 'vue';
import MicroModal from '@/Components/MicroModal.vue';

const itemList = ref([])

const props = defineProps({
    'customers': Array,
    'items': Array,
})

const form = useForm({
    date: null,
    customer_id: null,
    status: true,
    items: [],
})

onMounted(() => {
    form.date = getToday()
    // forEach(callbakFn) itemはitemsの中の要素の宣言
    props.items.forEach(item => {
        itemList.value.push({
            id: item.id,
            name: item.name,
            price: item.price,
            quantity: 0,
        })
    })
})

const quantity = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"]

const totalPrice = computed(() => {
    let total = 0
    itemList.value.forEach(item => {
        total += item.price * item.quantity
    })
    return total
})

const storePurchase = () => {
    itemList.value.forEach(item => {
        if (item.quantity > 0) {
            form.items.push({
                id: item.id,
                quantity: item.quantity,
            })
        }
    })

    form.post(route('purchases.store'))
}
</script>

<template>
    <Head title="購入登録" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">購入登録</h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <section class="relative text-gray-600 body-font">
                        <div class="container px-5 py-16 mx-auto">
                            <form @submit.prevent="storePurchase">
                                <div class="mx-auto">
                                    <div class="mb-4">
                                        <div>
                                            <label for="date" class="ml-4 mr-2 text-sm leading-7 text-gray-600">日付</label>
                                            <input type="date" name="date" id="date" v-model="form.date">
                                        </div>
                                        <div class="p-2 full">
                                            <div class="relative">
                                                <MicroModal />
                                                <label for="customer"
                                                    class="ml-4 mr-2 text-sm leading-7 text-gray-600">会員名</label>
                                                <select name="customer" id="customer" v-model="form.customer_id">
                                                    <option v-for="customer in customers" :value="customer.id"
                                                        :key="customer.id">
                                                        {{ customer.id }} : {{ customer.name }}
                                                    </option>
                                                </select>
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
                                                <tr v-for="item in itemList" class="border-b-2">
                                                    <td class="px-4 py-3">{{ item.id }}</td>
                                                    <td class="px-4 py-3">{{ item.name }}</td>
                                                    <td class="px-4 py-3">{{ item.price }}</td>
                                                    <td class="px-4 py-3">
                                                        <select name="quantity" id="quantity" v-model="item.quantity">
                                                            <option v-for="q in quantity" :value="q">{{ q }}</option>
                                                        </select>
                                                    </td>
                                                    <td class="px-4 py-3">{{ item.price * item.quantity }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-2">
                                        合計: <p
                                            class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                                            {{ totalPrice.toLocaleString() }} 円</p>
                                    </div>
                                    <div class="w-full p-2 mt-8">
                                        <button
                                            class="flex px-8 py-2 mx-auto text-lg text-white bg-indigo-500 border-0 rounded focus:outline-none hover:bg-indigo-600">登録する</button>
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
