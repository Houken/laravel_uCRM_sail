<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { getToday } from '@/common';
import { Head, useForm, Link } from '@inertiajs/vue3';
import axios from 'axios';
import { reactive, onMounted } from 'vue';
import Chart from '@/Components/Chart.vue';
import ResultTable from '@/Components/ResultTable.vue';

onMounted(() => {
    form.startDate = getToday()
    form.endDate = getToday()
})

const form = useForm({
    startDate: null,
    endDate: null,
    type: 'perDay',
    rfmPrms: [
        14, 28, 60, 90, 7, 5, 3, 2, 300000, 200000, 100000, 30000
    ],
})

const data = reactive({})

const getData = async () => {
    try {
        await axios.get('/api/analysis/', {
            params: {
                startDate: form.startDate,
                endDate: form.endDate,
                type: form.type,
                rfmPrms: form.rfmPrms,
            }
        })
            .then(res => {
                data.data = res.data.data
                if (res.data.labels) { data.labels = res.data.labels }
                if (res.data.eachCount) { data.eachCount = res.data.eachCount }
                data.totals = res.data.totals
                data.type = res.data.type
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
                        class="flex flex-col p-16 my-8 mx-auto drop-shadow-sm text-center max-w-[64rem] bg-teal-50">
                        <div id="typeRadio">
                            <label for="typeRadioButtons" class="mr-4">分析方法</label>
                            <input type="radio" v-model="form.type" name="typeRadioButtons" id="typeRadioButtonDay"
                                value="perDay" checked>
                            <label for="typeRadioButtonDay" class="mx-2">日別</label>
                            <input type="radio" v-model="form.type" name="typeRadioButtons" id="typeRadioButtonMonth"
                                value="perMonth">
                            <label for="typeRadioButtonMonth" class="mx-2">月別</label>
                            <input type="radio" v-model="form.type" name="typeRadioButtons" id="typeRadioButtonYear"
                                value="perYear">
                            <label for="typeRadioButtonYear" class="mx-2">年別</label>
                            <input type="radio" v-model="form.type" name="typeRadioButtons" id="typeRadioButtonDecile"
                                value="decile">
                            <label for="typeRadioButtonDecile" class="mx-2">デシル分析</label>
                            <input type="radio" v-model="form.type" name="typeRadioButtons" id="typeRadioButtonRfm"
                                value="rfm">
                            <label for="typeRadioButtonRfm" class="mx-2">RFM分析</label>
                        </div>
                        <div class="flex mt-4 text-right align-baseline">
                            <label for="startDate" class="w-1/4 p-1 mr-1 ">From: </label>
                            <input type="date" id="startDate" name="startDate" v-model="form.startDate" class="w-3/4">
                        </div>
                        <div class="flex mt-4 text-right align-baseline"><label for="endDate" class="w-1/4 p-1 mr-1 ">To:
                            </label>
                            <input type="date" id="endDate" name="endDate" v-model="form.endDate" class="w-3/4">
                        </div>
                        <div v-if="form.type === 'rfm'" class="my-8">
                            <table class="w-full whitespace-no-wrap border border-collapse table-auto border-slate-400">
                                <thead>
                                    <th
                                        class="px-4 py-3 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 border rounded-tl rounded-bl border-slate-300 title-font">
                                        ランク</th>
                                    <th
                                        class="px-4 py-3 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 border border-slate-300 title-font">
                                        R(○日以内)</th>
                                    <th
                                        class="px-4 py-3 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 border border-slate-300 title-font">
                                        F(○回以上)</th>
                                    <th
                                        class="px-4 py-3 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 border border-slate-300 title-font">
                                        M(○円以上)</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th class="bg-blue-300 border border-slate-300">5</th>
                                        <td class="p-1 bg-white border border-slate-300"><input type="number" name="r5"
                                                id="r5" v-model="form.rfmPrms[0]"
                                                class="m-0 text-right border-slate-100 bg-slate-50"></td>
                                        <td class="p-1 bg-white border border-slate-300"><input type="number" name="f5"
                                                id="f5" v-model="form.rfmPrms[4]"
                                                class="m-0 text-right border-slate-100 bg-slate-50"></td>
                                        <td class="p-1 bg-white border border-slate-300"><input type="number" name="m5"
                                                id="m5" v-model="form.rfmPrms[8]"
                                                class="m-0 text-right border-slate-100 bg-slate-50"></td>
                                    </tr>
                                    <tr>
                                        <th class="bg-blue-300 border border-slate-300">4</th>
                                        <td class="p-1 bg-white border border-slate-300"><input type="number" name="r4"
                                                id="r4" v-model="form.rfmPrms[1]"
                                                class="m-0 text-right border-slate-100 bg-slate-50"></td>
                                        <td class="p-1 bg-white border border-slate-300"><input type="number" name="f4"
                                                id="f4" v-model="form.rfmPrms[5]"
                                                class="m-0 text-right border-slate-100 bg-slate-50"></td>
                                        <td class="p-1 bg-white border border-slate-300"><input type="number" name="m4"
                                                id="m4" v-model="form.rfmPrms[9]"
                                                class="m-0 text-right border-slate-100 bg-slate-50"></td>
                                    </tr>
                                    <tr>
                                        <th class="bg-blue-300 border border-slate-300">3</th>
                                        <td class="p-1 bg-white border border-slate-300"><input type="number" name="r3"
                                                id="r3" v-model="form.rfmPrms[2]"
                                                class="m-0 text-right border-slate-100 bg-slate-50"></td>
                                        <td class="p-1 bg-white border border-slate-300"><input type="number" name="f3"
                                                id="f3" v-model="form.rfmPrms[6]"
                                                class="m-0 text-right border-slate-100 bg-slate-50"></td>
                                    <td class="p-1 bg-white border border-slate-300"><input type="number" name="m3"
                                            id="m3" v-model="form.rfmPrms[10]"
                                            class="m-0 text-right border-slate-100 bg-slate-50"></td>
                                </tr>
                                <tr>
                                    <th class="bg-blue-300 border border-slate-300">2</th>
                                    <td class="p-1 bg-white border border-slate-300"><input type="number" name="r2"
                                            id="r2" v-model="form.rfmPrms[3]"
                                            class="m-0 text-right border-slate-100 bg-slate-50"></td>
                                    <td class="p-1 bg-white border border-slate-300"><input type="number" name="f2"
                                            id="f2" v-model="form.rfmPrms[7]"
                                            class="m-0 text-right border-slate-100 bg-slate-50"></td>
                                    <td class="p-1 bg-white border border-slate-300"><input type="number" name="m2"
                                            id="m2" v-model="form.rfmPrms[11]"
                                            class="m-0 text-right border-slate-100 bg-slate-50"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button
                        class="flex px-8 py-2 mx-auto mt-4 text-lg text-white bg-indigo-500 border-0 rounded focus:outline-none hover:bg-indigo-600">分析する</button>
                </form>
                <div v-show="data.data">
                    <Chart v-if="data.type != 'rfm'" :data="data" />
                    <ResultTable :data="data" />
                </div>
            </div>
        </div>
    </div>
</AuthenticatedLayout></template>
