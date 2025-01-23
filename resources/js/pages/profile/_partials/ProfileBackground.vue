<script setup lang="ts">
import { inject } from 'vue';

const profile = inject<any>('profile');
</script>

<template>
    <img
        :src="profile.photo_url"
        class="fixed inset-0 h-full w-full"
    />

    <div
        class="fixed inset-0 h-full w-full bg-opacity-50 shadow-[inset_0_10px_100px_15px_black] backdrop-blur-2xl"
    />
</template>
