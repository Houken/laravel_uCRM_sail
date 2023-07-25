<script setup>

</script>

<template>
    <div v-if="$page.props.flash.status === 'success'" class="p-4 text-white bg-blue-300">
        {{ $page.props.flash.message }}</div>
    <div v-if="$page.props.flash.status === 'danger'" class="p-4 text-white bg-red-300">
        {{ $page.props.flash.message }}</div>
</template>
