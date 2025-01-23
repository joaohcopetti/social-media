<script setup lang="ts">
import { inject } from 'vue';
import ProfileHeaderName from './_partials/ProfileHeaderName.vue';
import ProfileHeaderSocialIcons from './_partials/ProfileHeaderSocialIcons.vue';

const profile = inject<any>('profile');
</script>

<template>
    <div class="relative">
        <img
            class="w-full object-cover"
            :src="profile.photo_url"
        />

        <div
            class="absolute bottom-0 w-full bg-gradient-to-t from-slate-900 to-transparent px-5 py-10"
        >
            <div class="mb-5">
                <ProfileHeaderName />
            </div>

            <ProfileHeaderSocialIcons />
        </div>
    </div>
</template>
