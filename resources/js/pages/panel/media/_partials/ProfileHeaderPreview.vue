<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import { useAppStore } from '@/stores/app-store'
import { Profile } from '@/types/models'

defineProps<{
    profile: Profile
}>()

const appStore = useAppStore()
</script>

<template>
    <div class="grid gap-5 sm:grid-cols-[.20fr_.80fr]">
        <img
            :src="profile.photo_url"
            class="min-h-56 w-full rounded-lg object-cover"
        />
        <div class="flex w-full flex-col gap-3">
            <div class="text-center text-xl font-bold sm:text-left">{{ profile.name }}</div>
            <div>{{ profile.description }}</div>
            <div class="mt-auto flex gap-2 self-center sm:self-end">
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
                        href:
                            appStore.currentRoute !== 'panel.my-media.manage'
                                ? route('panel.profiles.edit', { profile: profile.slug })
                                : route('panel.my-profile.edit'),
                    }"
                />
            </div>
        </div>
    </div>
</template>
