<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    blogs: Array
})
</script>

<template>
<h1>InertiaTest</h1>
<h2 v-if="$page.props.flash.message" class="bg-blue-300">{{ $page.props.flash.message }}</h2>
<ul>
    <li v-for="blog in blogs" :key="blog.id">タイトル: {{ blog.title }}, 内容: {{ blog.content }},
    <Link :href="route('inertia.show', { id: blog.id })" class="font-bold text-blue-400">詳細</Link></li>
</ul>
<p>タグを打ったところで、リセットされちゃってるから。</p>
</template>
