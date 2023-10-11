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
                data.labels = res.data.labels
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
                        class="flex flex-col p-16 my-8 mx-auto drop-shadow-sm text-center max-w-[32rem] bg-teal-50">
                        <div id="typeRadio">
                            <label for="typeRadioButtons" class="mr-4">分析方法</label>
                            <input type="radio" v-model="form.type" name="typeRadioButtons" id="typeRadioButtonDay" value="perDay" checked>
                            <label for="typeRadioButtonDay" class="mx-2">日別</label>
                            <input type="radio" v-model="form.type" name="typeRadioButtons" id="typeRadioButtonMonth" value="perMonth">
                            <label for="typeRadioButtonMonth" class="mx-2">月別</label>
                            <input type="radio" v-model="form.type" name="typeRadioButtons" id="typeRadioButtonYear" value="perYear">
                            <label for="typeRadioButtonYear" class="mx-2">年別</label>
                            <input type="radio" v-model="form.type" name="typeRadioButtons" id="typeRadioButtonDecile" value="decile">
                            <label for="typeRadioButtonDecile" class="mx-2">デシル分析</label>
                        </div>
                        <div class="flex mt-4 text-right align-baseline">
                            <label for="startDate"
                                class="w-1/4 p-1 mr-1 ">From: </label>
                            <input type="date" id="startDate" name="startDate" v-model="form.startDate" class="w-3/4">
                        </div>
                        <div class="flex mt-4 text-right align-baseline"><label for="endDate" class="w-1/4 p-1 mr-1 ">To:
                            </label>
                            <input type="date" id="endDate" name="endDate" v-model="form.endDate" class="w-3/4">
                        </div>
                        <button
                            class="flex px-8 py-2 mx-auto mt-4 text-lg text-white bg-indigo-500 border-0 rounded focus:outline-none hover:bg-indigo-600">分析する</button>
                    </form>
                    <div v-show="data.data">
                        <Chart :data="data" />
                        <ResultTable :data="data" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
