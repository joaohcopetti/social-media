<script setup lang="ts">
import { inject } from 'vue';
import ProfileBodyPost from './ProfileBodyPost.vue';
import ProfileBodyTabs from './ProfileBodyTabs.vue';

const profile = inject<any>('profile');
</script>

<template>
    <ProfileBodyTabs :profile="profile">
        <template #home>
            <div class="bg-slate-900 p-5 text-center text-white">Descrição da home do perfil</div>
            <div class="mx-2 my-3 flex flex-col gap-3">
                <ProfileBodyPost />
                <ProfileBodyPost />
            </div>
        </template>
        <template #free> Free </template>
        <template #premium> Premium </template>
    </ProfileBodyTabs>
</template>
