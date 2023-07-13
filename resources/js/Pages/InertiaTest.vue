<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const newTitle = ref('');
const newContent = ref('');
</script>

<template>
    <Head title="Inertia Test" />
    <h1 class="m-4 font-bold">Inertiaのテストです。</h1>
    <p class="p-4 m-4 font-semibold">
        <ul>
            <li>aタグで<a href="/" class="text-blue-400">Welcome</a>に移動</li>
            <li>Linkで<Link href="/" class="text-blue-400">Welcome</Link>に移動</li>
            <li>名前付きルートの<Link :href="route('inertia.index')" class="text-blue-400">確認</Link>です</li>
            <li>パラメータのテスト<Link :href="route('inertia.show', { id : 50 })" class="text-blue-400">click</Link></li>
        </ul>
    </p>
    <div class="mt-8">
        <label for="newTitle">タイトル</label>
        <input type="text" name="newTitle" v-model="newTitle" id="newTitle">
        <p>{{ newTitle }}</p>
        <label for="newContent">内容</label>
        <input type="text" name="newContent" v-model="newContent" id="newContent">
        <p>{{ newContent }}</p>
        <Link class="p-2 border-2 rounded" as="button" method="post"
            :href="route('inertia.store')"
            :data="{
                title: newTitle,
                content: newContent
            }">保存のテスト</Link>
    </div>
</template>
