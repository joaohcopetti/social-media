<script setup lang="ts">
import { inject } from 'vue';

const profile = inject<any>('profile');
</script>
<template>
    <h1 class="font-fancy text-center text-4xl font-extrabold text-white">
        {{ profile.name }}
    </h1>
</template>
