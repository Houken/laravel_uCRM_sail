<script setup>
import axios from 'axios';
import { ref, onMounted, reactive } from 'vue'

const search = ref('')
const customers = reactive({})

const searchCustomers = async () => {
    try {
        await axios.get(`/api/searchCustomers/?search=${search.value}`)
            .then(res => {
                console.log(res.data)
                customers.value = res.data
            })
        toggleStatus()
    } catch (e) {
        console.log(e.message)
    }
}

// onMounted(() => {
//     axios.get('/api/user')
//         .then(res => {
//             console.log(res)
//         })
// })


// boolean型の変数 初期値がfalse
// クリックしたらtrueに変わる
const isShow = ref(false)
const toggleStatus = () => { isShow.value = !isShow.value }

const emit = defineEmits(['update:customerId'])
const setCustomer = e => {
    search.value = e.kana
    emit('update:customerId', e.id)
    toggleStatus()
}
</script>

<template>
    <!-- [1] -->
    <!-- モーダルの最外部のコンテナ -->
    <!-- モーダルのdisplayを切り替え -->
    <div id="modal-1" aria-hidden="true" class="modal" v-show="isShow">
        <!-- [2] -->
        <!-- モーダルのオーバーレイ -->
        <!-- data-micromodal-closeが必須 -->
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
            <!-- [3] -->
            <!-- 以下のコンテンツはページの他から分離していることをroleが説明 -->
            <div class="w-2/3 modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
                <header class="modal__header">
                    <h2 class="modal__title" id="modal-1-title">
                        顧客検索
                    </h2>
                    <!-- [4] -->
                    <!-- aria-labelがボタンのアクションを定義 -->
                    <!-- 「閉じる」ボタンにdata-micromodal-closeを置く -->
                    <button type="button" class="modal__close" aria-label="Close modal" data-micromodal-close
                        @click="toggleStatus"></button>
                </header>
                <main class="modal__content" id="modal-1-content">
                    <table v-if="customers.value" class="w-full text-left whitespace-no-wrap table-auto">
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
                            <tr v-for="customer in customers.value.data" :key="customer.id">
                                <td class="px-4 py-1 text-sm border-b-2 border-gray-200">
                                    <button type="button" @click="setCustomer({ id: customer.id, kana: customer.kana })" class="text-blue-500 hover:text-blue-700">{{ customer.id }}</button>
                                </td>
                                <td class="px-4 py-1 text-sm border-b-2 border-gray-200">{{ customer.name }}
                                </td>
                                <td class="px-4 py-1 text-sm border-b-2 border-gray-200">{{ customer.kana }}
                                </td>
                                <td class="px-4 py-1 text-sm border-b-2 border-gray-200">{{ customer.tel }}</td>
                            </tr>
                        </tbody>
                    </table>
                </main>
                <footer class="modal__footer">
                    <button @click="toggleStatus" type="button" class="modal__btn" data-micromodal-close
                        aria-label="Close this dialog window">閉じる</button>
                </footer>
            </div>
        </div>
    </div>
    <input type="text" name="customer" v-model="search">
    <button @click="searchCustomers" type="button" data-micromodal-trigger="modal-1"
        class="px-8 py-2 ml-4 text-lg text-white bg-teal-500 border-0 rounded focus:outline-none hover:bg-teal-600">検索する</button>
</template>
