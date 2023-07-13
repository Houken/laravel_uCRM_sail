<script setup>
// import { reactive } from 'vue';
// import { router } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    title: null,
    content: null
})

const submitFunction = () => {
    form.post('/inertia');
}
</script>

<template>
<form action="" @submit.prevent="submitFunction" class="p-4">
    <div><label for="title" class="mr-2">タイトル</label>
    <input type="text" name="title" v-model="form.title" id="title"></div>
    <div v-if="form.errors.title" v-text="form.errors.title"></div>
    <div> <label for="content" class="ml-4 mr-2">内容</label>
    <input type="text" name="content" id="content" v-model="form.content"></div>
    <div v-if="form.errors.content" v-text="form.errors.content"></div>
    <button>送信</button>
</form>
</template>
