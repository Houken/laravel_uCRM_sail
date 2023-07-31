<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import { Core as YubinBangoCore } from "yubinbango-core2";

const form = useForm({
    name: null,
    kana: null,
    tel: null,
    email: null,
    postcode: null,
    address: null,
    birthday: null,
    gender: null,
    memo: null,
})

const fetchAddress = () => {
    new YubinBangoCore(String(form.postcode), (value) => {
        // console.log(value)
        form.address = value.region + value.locality + value.street
    })
}

const storeCustomer = () => {
    form.post('/customers')
}
</script>

<template>
    <Head title="顧客登録" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">顧客登録</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <section class="relative text-gray-600 body-font">
                        <div class="container px-5 py-24 mx-auto">
                            <form @submit.prevent="storeCustomer">
                                <div class="mx-auto lg:w-1/2 md:w-2/3">
                                    <div class="flex flex-wrap -m-2">
                                        <div class="w-full p-2">
                                            <div class="relative">
                                                <label for="name" class="text-sm leading-7 text-gray-600">氏名</label>
                                                <input type="text" id="name" name="name" v-model="form.name"
                                                    class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                                                <InputError class="mt-2" :message="form.errors.name" />
                                            </div>
                                        </div>
                                        <div class="w-full p-2">
                                            <div class="relative">
                                                <label for="kana" class="text-sm leading-7 text-gray-600">フリガナ</label>
                                                <input type="text" id="kana" name="kana" v-model="form.kana"
                                                    class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                                                <InputError class="mt-2" :message="form.errors.kana" />
                                            </div>
                                        </div>
                                        <div class="w-full p-2">
                                            <div class="relative">
                                                <label for="tel" class="text-sm leading-7 text-gray-600">電話番号</label>
                                                <input type="tel" id="tel" name="tel" v-model="form.tel"
                                                    class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                                                <InputError class="mt-2" :message="form.errors.tel" />
                                            </div>
                                        </div>
                                        <div class="w-full p-2">
                                            <div class="relative">
                                                <label for="email" class="text-sm leading-7 text-gray-600">メールアドレス</label>
                                                <input type="email" id="email" name="email" v-model="form.email"
                                                    class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                                                <InputError class="mt-2" :message="form.errors.email" />
                                            </div>
                                        </div>
                                        <div class="w-full p-2">
                                            <div class="relative">
                                                <label for="postcode" class="text-sm leading-7 text-gray-600">郵便番号</label>
                                                <input type="number" id="postcode" name="postcode" v-model="form.postcode" @change="fetchAddress"
                                                    class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                                                <InputError class="mt-2" :message="form.errors.postcode" />
                                            </div>
                                        </div>
                                        <div class="w-full p-2">
                                            <div class="relative">
                                                <label for="address" class="text-sm leading-7 text-gray-600">住所</label>
                                                <input type="text" id="address" name="address" v-model="form.address"
                                                    class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                                                <InputError class="mt-2" :message="form.errors.address" />
                                            </div>
                                        </div>
                                        <div class="w-full p-2">
                                            <div class="relative">
                                                <label for="birthday" class="text-sm leading-7 text-gray-600">誕生日</label>
                                                <input type="date" id="birthday" name="birthday" v-model="form.birthday"
                                                    class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                                                <InputError class="mt-2" :message="form.errors.birthday" />
                                            </div>
                                        </div>
                                        <div class="w-full p-2">
                                            <div class="relative">
                                                <label for="gender" class="text-sm leading-7 text-gray-600">性別</label>
                                                <input type="radio" id="gender-male" name="gender" v-model="form.gender" value="0" class="ml-4">
                                                <label for="gender-male" class="pl-1 text-sm leading-7 text-gray-600">男性</label>
                                                <input type="radio" id="gender-female" name="gender" v-model="form.gender" value="1" class="ml-4">
                                                <label for="gender-female" class="px-1 text-sm leading-7 text-gray-600">女性</label>
                                                <input type="radio" id="gender-other" name="gender" v-model="form.gender" value="2" class="ml-4">
                                                <label for="gender-other" class="pl-1 text-sm leading-7 text-gray-600">その他</label>
                                                <InputError class="mt-2" :message="form.errors.gender" />
                                            </div>
                                        </div>
                                        <div class="w-full p-2">
                                            <div class="relative">
                                                <label for="memo" class="text-sm leading-7 text-gray-600">メモ</label>
                                                <textarea id="memo" name="memo" v-model="form.memo"
                                                    class="w-full h-32 px-3 py-1 text-base leading-6 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none resize-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"></textarea>
                                                <InputError class="mt-2" :message="form.errors.memo" />
                                            </div>
                                        </div>
                                        <div class="w-full p-2">
                                            <button
                                                class="flex px-8 py-2 mx-auto text-lg text-white bg-indigo-500 border-0 rounded focus:outline-none hover:bg-indigo-600">登録する</button>
                                        </div>
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
