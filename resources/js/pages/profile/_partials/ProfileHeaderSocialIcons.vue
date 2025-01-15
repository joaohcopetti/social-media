<script setup lang="ts">
import ProfileHeaderSocialIcon from './ProfileHeaderSocialIcon.vue';
</script>
<template>
    <div class="flex justify-center gap-2">
        <ProfileHeaderSocialIcon
            href="http://google.com"
            :icon="{ icon: 'fa6-brands:facebook-f' }"
        />
        <ProfileHeaderSocialIcon
            href="http://google.com"
            :icon="{ icon: 'fa6-brands:instagram' }"
        />
        <ProfileHeaderSocialIcon
            href="http://google.com"
            :icon="{ icon: 'fa6-brands:x-twitter' }"
        />
        <ProfileHeaderSocialIcon
            href="http://google.com"
            :icon="{ icon: 'fa6-brands:tiktok' }"
        />
        <ProfileHeaderSocialIcon
            href="http://google.com"
            :icon="{ icon: 'fa6-brands:youtube' }"
        />
    </div>
</template>
