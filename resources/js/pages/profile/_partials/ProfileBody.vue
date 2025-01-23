<script setup lang="ts">
import { inject } from 'vue';
import ProfileBodyPost from './ProfileBodyPost.vue';
import ProfileBodyTabs from './ProfileBodyTabs.vue';

defineProps<{
    media: any[];
}>();

const profile = inject<any>('profile');
</script>

<template>
    <ProfileBodyTabs :profile="profile">
        <template #home>
            <div
                v-if="profile.description"
                class="bg-slate-900 p-5 text-center text-white"
            >
                {{ profile.description }}
            </div>
            <div class="mx-2 my-3 flex flex-col gap-3">
                <ProfileBodyPost
                    v-for="_media in media"
                    :key="_media.id"
                    :media="_media"
                />
            </div>
        </template>
        <template #free> Free </template>
        <template #premium> Premium </template>
    </ProfileBodyTabs>
</template>
