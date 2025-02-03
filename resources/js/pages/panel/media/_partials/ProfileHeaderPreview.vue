<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import { Profile } from '@/types/models'

defineProps<{
    profile: Profile
}>()
</script>

<template>
    <div class="flex w-full gap-5">
        <div class="w-52 overflow-hidden rounded-lg">
            <img :src="profile.photo_url" />
        </div>
        <div class="flex w-full flex-col gap-3">
            <div class="text-xl font-bold">{{ profile.name }}</div>
            <div>{{ profile.description }}</div>
            <div class="mt-auto self-end">
                <AppButton
                    ghost
                    label="Editar perfil"
                    :inertia-link-attrs="{
                        href: route('panel.profiles.edit', { profile: profile.slug }),
                    }"
                />
            </div>
        </div>
    </div>
</template>
