<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import { Profile } from '@/types/models'

defineProps<{
    profile: Profile
}>()
</script>

<template>
    <div class="flex w-full gap-5">
        <div class="w-1/4 overflow-hidden rounded-lg">
            <img
                :src="profile.photo_url"
                class="rounded-lg"
            />
        </div>
        <div class="flex w-full flex-col gap-3">
            <div class="text-xl font-bold">{{ profile.name }}</div>
            <div>{{ profile.description }}</div>
            <div class="mt-auto flex gap-2 self-end">
                <AppButton
                    ghost
                    :icon="{ icon: 'ph:eye' }"
                    label="Ver"
                    :inertia-link-attrs="{
                        href: route('profile.index', { profile: profile.slug }),
                    }"
                    color="primary-dark"
                />
                <AppButton
                    ghost
                    :icon="{ icon: 'ph:pencil' }"
                    label="Editar"
                    :inertia-link-attrs="{
                        href: route('panel.profiles.edit', { profile: profile.slug }),
                    }"
                />
            </div>
        </div>
    </div>
</template>
