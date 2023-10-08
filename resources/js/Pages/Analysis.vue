<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { getToday } from '@/common';
import { Head, useForm, Link } from '@inertiajs/vue3';
import axios from 'axios';
import { reactive, onMounted } from 'vue';
import Chart from '@/Components/Chart.vue';

onMounted(() => {
    form.startDate = getToday()
    form.endDate = getToday()
})

const form = useForm({
    startDate: null,
    endDate: null,
    type: 'perDay',
})

const data = reactive({})

const getData = async () => {
    try {
        await axios.get('/api/analysis/', {
            params: {
                startDate: form.startDate,
                endDate: form.endDate,
                type: form.type,
            }
        })
            .then(res => {
                data.data = res.data.data
                console.log(res.data)
            })
    } catch (e) {
        console.log(e.message)
    }
}
</script>

<template>
    <Head title="データ分析" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">データ分析</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">データ分析</div>
                    <form @submit.prevent="getData"
                        class="flex flex-col p-16 my-8 mx-auto drop-shadow-sm text-center max-w-[24rem] bg-teal-50">
                        <div class="flex mt-4 text-right align-baseline"><label for="startDate"
                                class="w-1/4 p-1 mr-1 ">From: </label>
                            <input type="date" name="startDate" v-model="form.startDate" class="w-3/4">
                        </div>
                        <div class="flex mt-4 text-right align-baseline"><label for="endDate" class="w-1/4 p-1 mr-1 ">To:
                            </label>
                            <input type="date" name="endDate" v-model="form.endDate" class="w-3/4">
                        </div>
                        <button
                            class="flex px-8 py-2 mx-auto mt-4 text-lg text-white bg-indigo-500 border-0 rounded focus:outline-none hover:bg-indigo-600">分析する</button>
                    </form>
                    <Chart />
                    <div v-show="data.data" class="p-4 mx-auto overflow-auto w-80 lg:w-2/3">
                        <table class="w-full text-left whitespace-no-wrap table-auto">
                            <thead>
                                <tr>
                                    <th
                                        class="px-4 py-4 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                                        日付</th>
                                    <th
                                        class="px-4 py-4 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                                        金額</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in data.data" :key="item.date">
                                    <td class="px-4 py-4 text-sm border-b-2 border-gray-200">{{ item.date }}
                                    </td>
                                    <td class="px-4 py-4 text-sm border-b-2 border-gray-200">{{ item.total.toLocaleString() }} 円
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
