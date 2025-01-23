<script setup lang="ts">
import { provide } from 'vue';
import ProfileBackground from './_partials/ProfileBackground.vue';
import ProfileBody from './_partials/ProfileBody.vue';
import ProfileContainer from './_partials/ProfileContainer.vue';
import ProfileHeader from './_partials/ProfileHeader.vue';

const props = defineProps<{
    profile: any;
    homeMedia: any[];
}>();

provide('profile', props.profile);
</script>

<template>
    <div>
        <ProfileBackground />
        <ProfileContainer class="relative z-10 my-10 overflow-hidden rounded-3xl bg-slate-900">
            <ProfileHeader />
            <ProfileBody :media="props.homeMedia" />
        </ProfileContainer>
    </div>
</template>

<style></style>
