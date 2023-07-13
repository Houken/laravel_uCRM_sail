<script setup>
import { router } from '@inertiajs/vue3';

defineProps({ id: String, blog: Object })

const deleteConfirm = id => {
    router.delete(`/inertia/${id}`, {
        onBefore: () => confirm('本当に削除しますか？')
    })
}
</script>

<template>
    <h1 class="m-4">レコードの表示</h1>
    <h2 class="m-4">id: {{ id }}</h2>
    <h3 class="m-4">タイトル: {{ blog.title }}</h3>
    <button @click="deleteConfirm(blog.id)" class="p-2 m-4 border-2">削除</button>
</template>
