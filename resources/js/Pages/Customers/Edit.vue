<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    customer: Object
})

const form = useForm({
    id: props.customer.id,
    name: props.customer.name,
    kana: props.customer.kana,
    tel: props.customer.tel,
    email: props.customer.email,
    postcode: props.customer.postcode,
    address: props.customer.address,
    birthday: props.customer.birthday,
    gender: props.customer.gender,
    memo: props.customer.memo,
})

const updateCustomer = id => {
    form.put(route('customers.update', { customer: id }))
}
</script>

<template>
    <Head title="顧客編集" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">顧客編集</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <section class="relative text-gray-600 body-font">
                        <div class="container px-5 py-24 mx-auto">
                            <form @submit.prevent="updateCustomer(form.id)">
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
                                                <input type="text" id="tel" name="tel" v-model="form.tel"
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
                                                <label for="price" class="text-sm leading-7 text-gray-600">郵便番号</label>
                                                <input type="number" id="postcode" name="postcode" v-model="form.postcode"
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
                                                <label for="gender" class="mr-4 text-sm leading-7 text-gray-600">性別</label>
                                                <input type="radio" id="gender-female" name="gender-female" v-model="form.gender" value="1" class="" />
                                                <label class="ml-2 mr-4">女性</label>
                                                <input type="radio" id="gender-other" name="gender-other" v-model="form.gender" value="2" class="" />
                                                <label class="ml-2 mr-4">その他</label>
                                                <input type="radio" id="gender-male" name="gender-male" v-model="form.gender" value="0" class="" />
                                                <label class="ml-2 mr-4">男性</label>
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
                                                class="flex px-8 py-2 mx-auto text-lg text-white bg-indigo-500 border-0 rounded focus:outline-none hover:bg-indigo-600">更新する</button>
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
