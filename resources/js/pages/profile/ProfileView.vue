<script setup lang="ts">
import { provide } from 'vue';
import ProfileBackground from './ProfileBackground.vue';
import ProfileBody from './ProfileBody.vue';
import ProfileContainer from './ProfileContainer.vue';
import ProfileHeader from './ProfileHeader.vue';

const props = defineProps<{
    profile: any;
    media: any[];
}>();

provide('profile', props.profile);
</script>

<template>
    <div>
        <ProfileBackground />
        <ProfileContainer class="relative z-10 my-10 overflow-hidden rounded-3xl bg-slate-900">
            <ProfileHeader />
            <ProfileBody :media="props.media" />
        </ProfileContainer>
    </div>
</template>

<style></style>
