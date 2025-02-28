<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppStatus from '@/components/AppStatus.vue'
import AppTable from '@/components/table/AppTable.vue'

import { TableHeader } from '@/types/components'
import { formatCurrency } from '@/utils/helpers'
import { Icon } from '@iconify/vue/dist/iconify.js'
import { router } from '@inertiajs/vue3'
import { DateTime } from 'luxon'
import { useToast } from 'vue-toast-notification'

defineProps<{
    subscriptions: any[]
}>()

const HEADER: TableHeader[] = [
    { label: 'Nome', prop: 'name' },
    { label: 'Valor', prop: 'price', centered: true },
    { label: 'Assinado em', prop: 'subscribed_at', centered: true },
    { label: 'Válido até', prop: 'valid_until', centered: true },
    { label: 'Status', prop: 'status', centered: true },
    { label: '', prop: 'cancel' },
]

const cancelSubscription = (profile: any) => {
    const url = route('panel.my-subscriptions.cancel', { profile: profile.slug })

    router.post(url, undefined, {
        onSuccess() {
            useToast().success('Inscrição cancelada!')
        },
    })
}
</script>

<template>
    <AppTable
        :data="subscriptions"
        :header="HEADER"
    >
        <template #[`tbody.name`]="{ data }">
            <div class="flex items-center gap-2 p-2">
                <div>
                    <img
                        class="size-8 rounded-full"
                        :src="data.profile.photo_thumb_url"
                    />
                </div>
                <div>{{ data.profile.name }}</div>
                <a
                    target="_blank"
                    :href="route('profile.index', { profile: data.profile.slug })"
                >
                    <Icon
                        icon="ph:arrow-square-out-bold"
                        class="cursor-pointer text-blue-600 hover:text-blue-500"
                    />
                </a>
            </div>
        </template>

        <template #[`tbody.subscribed_at`]="{ data }">
            {{ DateTime.fromSeconds(data.asStripe.created, { locale: 'pt-BR' }).toLocaleString() }}
        </template>

        <template #[`tbody.valid_until`]="{ data }">
            {{
                DateTime.fromSeconds(data.asStripe.current_period_end, {
                    locale: 'pt-BR',
                }).toLocaleString()
            }}
        </template>

        <template #[`tbody.price`]="{ data }">
            {{ formatCurrency(data.asStripe.items.data[0].price.unit_amount / 100) }}
        </template>

        <template #[`tbody.status`]="{ data }">
            <div class="flex items-center justify-center gap-2">
                <AppStatus
                    :class="{
                        'bg-green-500': data.stripe_status === 'active',
                        'bg-yellow-500': data.stripe_status === 'incomplete',
                        'bg-red-500': data.stripe_status === 'error',
                    }"
                />
                <span class="capitalize">{{ data.status }}</span>
                <span v-if="data.ends_at">(Cancelado)</span>
            </div>
        </template>

        <template #[`tbody.cancel`]="{ data }">
            <AppButton
                label="Cancelar"
                :disabled="!!data.ends_at"
                @click="cancelSubscription(data.profile)"
            />
        </template>
    </AppTable>
</template>
