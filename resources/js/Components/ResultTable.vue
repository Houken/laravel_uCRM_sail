<script setup>
const props = defineProps({
    'data': Object
})

function currencyPrefix(figure) {
    return parseInt(figure).toLocaleString('ja-JP')
}
</script>
<template>
    <div v-if="data.type === 'perDay' || data.type === 'perMonth' || data.type === 'perYear'"
        class="p-4 mx-auto overflow-auto w-80 lg:w-2/3">
        <table class="w-full text-left whitespace-no-wrap table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-4 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                        日付</th>
                    <th class="px-4 py-4 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                        金額</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in data.data" :key="item.date">
                    <td class="px-4 py-4 text-sm border-b-2 border-gray-200">{{ item.date }}
                    </td>
                    <td class="px-4 py-4 text-sm border-b-2 border-gray-200">{{ item.total.toLocaleString()
                    }} 円
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-if="data.type === 'decile'" class="p-4 mx-auto overflow-auto w-80 lg:w-2/3">
        <table class="w-full text-left whitespace-no-wrap table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-4 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                        Group</th>
                    <th class="px-4 py-4 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                        Average</th>
                    <th class="px-4 py-4 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                        Total</th>
                    <th class="px-4 py-4 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                        Ratio</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in data.data" :key="item.date">
                    <td class="px-4 py-4 text-sm border-b-2 border-gray-200">{{ item.decile }}
                    </td>
                    <td class="px-4 py-4 text-sm border-b-2 border-gray-200">{{ currencyPrefix(item.average) }}
                    </td>
                    <td class="px-4 py-4 text-sm border-b-2 border-gray-200">{{ currencyPrefix(item.totalPerGroup) }}
                    </td>
                    <td class="px-4 py-4 text-sm border-b-2 border-gray-200">{{ item.totalRatio }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-if="data.type === 'rfm'" class="w-auto p-8 mx-auto overflow-auto lg:w-2/3">
        <h3>合計人数 : {{ data.totals }} 人</h3>
        <table class="w-full mt-8 text-left whitespace-no-wrap table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-4 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                        Rank</th>
                    <th class="px-4 py-4 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                        R</th>
                    <th class="px-4 py-4 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                        F</th>
                    <th class="px-4 py-4 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                        M</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="rfm in data.eachCount" :key="rfm.rank">
                    <th class="px-4 py-4 text-sm text-gray-900 bg-gray-50 title-font">
                        {{ rfm.rank }}</th>
                    <td class="px-4 py-4 text-sm text-gray-900 bg-white border-b border-gray-200 title-font">
                        {{ rfm.r }}</td>
                    <td class="px-4 py-4 text-sm text-gray-900 bg-white border-b border-gray-200 title-font">
                        {{ rfm.f }}</td>
                    <td class="px-4 py-4 text-sm text-gray-900 bg-white border-b border-gray-200 title-font">
                        {{ rfm.m }}</td>
                </tr>
            </tbody>
        </table>
        <table class="w-full mt-8 text-left whitespace-no-wrap table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-4 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                        rRank</th>
                    <th class="px-4 py-4 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                        5</th>
                    <th class="px-4 py-4 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                        4</th>
                    <th class="px-4 py-4 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                        3</th>
                    <th class="px-4 py-4 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                        2</th>
                    <th class="px-4 py-4 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font">
                        1</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="rf in data.data" :key="rf.rRank">
                    <th class="px-4 py-4 text-sm text-gray-900 bg-gray-50 title-font">{{ rf.rRank }}
                    </th>
                    <td class="px-4 py-4 text-sm border-b border-gray-200">{{ rf.f_5 }}
                    </td>
                    <td class="px-4 py-4 text-sm border-b border-gray-200">{{ rf.f_4 }}
                    </td>
                    <td class="px-4 py-4 text-sm border-b border-gray-200">{{ rf.f_3 }}
                    </td>
                    <td class="px-4 py-4 text-sm border-b border-gray-200">{{ rf.f_2 }}
                    </td>
                    <td class="px-4 py-4 text-sm border-b border-gray-200">{{ rf.f_1 }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
