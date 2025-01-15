<script setup lang="ts">
import ProfileHeaderName from './ProfileHeaderName.vue';
import ProfileHeaderSocialIcons from './ProfileHeaderSocialIcons.vue';
</script>

<template>
    <div class="relative">
        <img
            class="w-full object-cover"
            src="https://placehold.co/500x500"
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
