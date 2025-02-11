<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import { Profile } from '@/types/models'

defineProps<{
    profile: Profile
}>()
</script>

<template>
    <div class="flex w-full flex-col gap-5 sm:flex-row">
        <div class="overflow-hidden rounded-lg sm:w-1/4">
            <img
                :src="profile.photo_url"
                class="size-64 rounded-lg object-cover"
            />
        </div>
        <div class="flex w-full flex-col gap-3">
            <div class="text-xl font-bold">{{ profile.name }}</div>
            <div>{{ profile.description }}</div>
            <div class="mt-auto flex gap-2 self-end">
                <AppButton
                    ghost
                    :icon-left="{ icon: 'ph:eye' }"
                    label="Ver"
                    :link="{
                        href: route('profile.index', { profile: profile.slug }),
                        target: '_blank',
                    }"
                    color="primary-dark"
                />
                <AppButton
                    ghost
                    :icon-left="{ icon: 'ph:pencil' }"
                    label="Editar"
                    :inertia-link="{
                        href: route('panel.profiles.edit', { profile: profile.slug }),
                    }"
                />
            </div>
        </div>
    </div>
</template>
