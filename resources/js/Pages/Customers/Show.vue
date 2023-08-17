<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

defineProps({
    customer: Object,
});

const deleteCustomer = id => {
    router.delete(route('customers.destroy', {customer: id}), {
        onBefore: () => confirm('本当に削除しますか？')
    })
}
// ダイアログを出して、
// customerオブジェクトをidをキーにして渡している。
// 送り先(destroyメソッド)には、該当するcustomerモデルが配列で渡されている。
</script>

<template>
    <Head title="顧客詳細" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                顧客詳細
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <section class="relative text-gray-600 body-font">
                        <div class="container px-5 py-24 mx-auto">
                            <div class="mx-auto lg:w-1/2 md:w-2/3">
                                <div class="flex flex-wrap -m-2">
                                    <div class="w-full p-2">
                                        <div class="relative">
                                            <label for="name" class="text-sm leading-7 text-gray-600">商品名</label>
                                            <div id="name"
                                                class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-opacity-50 border border-gray-100 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                                                {{ customer.name }}</div>
                                        </div>
                                    </div>
                                    <div class="w-full p-1">
                                        <div class="relative">
                                            <label for="kana" class="text-sm leading-7 text-gray-600">フリガナ</label>
                                            <div id="kana"
                                                class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-opacity-50 border border-gray-100 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                                                {{ customer.kana }}</div>

                                        </div>
                                    </div>
                                    <div class="w-full p-1">
                                        <div class="relative">
                                            <label for="tel" class="text-sm leading-7 text-gray-600">電話番号</label>
                                            <div id="tel"
                                                class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-opacity-50 border border-gray-100 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                                                {{ customer.tel }}</div>

                                        </div>
                                    </div>
                                    <div class="w-full p-1">
                                        <div class="relative">
                                            <label for="email" class="text-sm leading-7 text-gray-600">メールアドレス</label>
                                            <div id="email"
                                                class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-opacity-50 border border-gray-100 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                                                {{ customer.email }}</div>

                                        </div>
                                    </div>
                                    <div class="w-full p-1">
                                        <div class="relative">
                                            <label for="gender" class="text-sm leading-7 text-gray-600">性別</label>
                                            <div id="gender"
                                                class="w-full px-3 py-1 text-base leading-6 text-gray-700 transition-colors duration-200 ease-in-out bg-opacity-50 border border-gray-100 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                                                <span v-if="customer.gender === 1" class="text-blue-700">女性</span>
                                                <span v-if="customer.gender === 2" class="text-blue-700">その他</span>
                                                <span v-if="customer.gender === 0" class="text-red-700">男性</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full p-1">
                                        <div class="relative">
                                            <label for="postcode" class="text-sm leading-7 text-gray-600">郵便番号</label>
                                            <div id="postcode"
                                                class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-opacity-50 border border-gray-100 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                                                {{ customer.postcode }}</div>

                                        </div>
                                    </div>
                                    <div class="w-full p-1">
                                        <div class="relative">
                                            <label for="address" class="text-sm leading-7 text-gray-600">住所</label>
                                            <div id="address"
                                                class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-opacity-50 border border-gray-100 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                                                {{ customer.address }}</div>

                                        </div>
                                    </div>
                                    <div class="w-full p-1">
                                        <div class="relative">
                                            <label for="birthday" class="text-sm leading-7 text-gray-600">誕生日</label>
                                            <div id="birthday"
                                                class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-opacity-50 border border-gray-100 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                                                {{ customer.birthday }}</div>

                                        </div>
                                    </div>
                                    <div class="w-full p-1">
                                        <div class="relative">
                                            <label for="memo" class="text-sm leading-7 text-gray-600">メモ</label>
                                            <div id="memo"
                                                class="w-full h-32 px-3 py-1 text-base leading-6 text-gray-700 whitespace-pre-wrap transition-colors duration-200 ease-in-out bg-opacity-50 border border-gray-100 rounded outline-none resize-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                                                {{ customer.memo }}</div>
                                        </div>
                                    </div>
                                    <div class="flex w-full p-1 mt-4">
                                        <Link as="button" :href="route('customers.edit', { customer:customer.id })"
                                                class="flex-initial w-32 px-4 py-2 mx-auto text-lg text-white bg-indigo-500 border-0 rounded focus:outline-none hover:bg-indigo-600">Edit</Link>
                                        <button @click="deleteCustomer(customer.id)"
                                        class="flex-initial w-32 px-4 py-2 mx-auto text-lg text-white bg-red-500 border-0 rounded focus:outline-none hover:bg-red-600">削除する</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
