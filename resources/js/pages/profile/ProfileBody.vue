<script setup lang="ts">
import { inject } from 'vue';
import ProfileBodyFree from './_partials/ProfileBodyFree.vue';
import ProfileBodyHome from './_partials/ProfileBodyHome.vue';
import ProfileBodyPremium from './_partials/ProfileBodyPremium.vue';
import ProfileBodyTabs from './_partials/ProfileBodyTabs.vue';

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
        <template #premium>
            <ProfileBodyPremium :media="media" />
        </template>
    </ProfileBodyTabs>
</template>
