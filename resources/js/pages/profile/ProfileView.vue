<script setup lang="ts">
const URL =
    'https://media.link.me/images/user-profile/812377/tmp-11799-1698288046076.png?w=1092&h=1092';
</script>

<template>
    <div>
        <img
            :src="URL"
            class="absolute h-full w-full"
        />
        <div
            class="absolute inset-0 bg-opacity-50 shadow-[inset_0_10px_100px_black] backdrop-blur-2xl"
        />
        <div class="relative z-10">Olá mundo</div>
    </div>
</template>

<style></style>
