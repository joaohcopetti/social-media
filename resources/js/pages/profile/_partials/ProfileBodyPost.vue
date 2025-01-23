<script setup lang="ts">
defineProps<{
    media: any
}>()
</script>

<template>
    <div class="overflow-hidden rounded-xl">
        <img
            class="w-full"
            :src="media.url"
        />
    </div>
</template>
