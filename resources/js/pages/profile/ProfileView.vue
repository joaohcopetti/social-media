<script setup lang="ts">
import ProfileBackground from './_partials/ProfileBackground.vue';
import ProfileBody from './_partials/ProfileBody.vue';
import ProfileContainer from './_partials/ProfileContainer.vue';
import ProfileHeader from './_partials/ProfileHeader.vue';
</script>

<template>
    <div>
        <ProfileBackground />
        <ProfileContainer class="relative z-10 my-10 overflow-hidden rounded-3xl bg-slate-900">
            <ProfileHeader />
            <ProfileBody />
        </ProfileContainer>
    </div>
</template>

<style></style>
