<script setup>
const props = defineProps({
    'data': Object
})

function currencyPrefix(figure) {
    return parseInt(figure).toLocaleString('ja-JP')
}
</script>
<template>
    <div v-if="data.type === 'perDay' || data.type === 'perMonth' || data.type === 'perYear'" class="p-4 mx-auto overflow-auto w-80 lg:w-2/3">
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
</template>
