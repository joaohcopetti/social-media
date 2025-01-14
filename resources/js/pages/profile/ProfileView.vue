<script setup lang="ts">
import ProfileContainer from './_partials/ProfileContainer.vue';
import ProfileHeader from './_partials/ProfileHeader.vue';

const URL =
    'https://media.link.me/images/user-profile/812377/tmp-11799-1698288046076.png?w=1092&h=1092';
</script>

<template>
    <div>
        <img
            :src="URL"
            class="absolute inset-0 h-full w-full"
        />

        <div
            class="absolute inset-0 h-full w-full bg-opacity-50 shadow-[inset_0_10px_100px_black] backdrop-blur-2xl"
        />

        <ProfileContainer
            class="relative z-10 mt-10 overflow-hidden rounded-3xl"
        >
            <ProfileHeader />
        </ProfileContainer>
    </div>
</template>

<style></style>
