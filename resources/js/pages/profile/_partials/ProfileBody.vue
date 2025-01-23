<script setup lang="ts">
import { inject } from 'vue';
import ProfileBodyHome from './ProfileBodyHome.vue';
import ProfileBodyTabs from './ProfileBodyTabs.vue';

defineProps<{
    media: any[];
}>();

const profile = inject<any>('profile');
</script>

<template>
    <ProfileBodyTabs :profile="profile">
        <template
            v-if="route().current() === 'profile.index'"
            #home
        >
            <ProfileBodyHome :media="media" />
        </template>
        <template
            v-if="route().current() === 'profile.free'"
            #free
        >
            <ProfileBodyFree :media="media" />
        </template>
        <template #premium> Premium </template>
    </ProfileBodyTabs>
</template>
