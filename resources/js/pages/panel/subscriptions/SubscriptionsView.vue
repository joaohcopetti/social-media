<script setup lang="ts">
import AppPanelContainer from '@/components/AppPanelContainer.vue'

import SubscriptionsTable from './_partials/SubscriptionsTable.vue'

defineProps<{
    subscriptions: any[]
}>()
</script>

<template>
    <AppPanelContainer
        class="mx-auto sm:w-2/3"
        no-horizontal-padding
    >
        <template #title><div class="mx-5">Minhas assinaturas</div></template>
        <template #body>
            <div v-if="subscriptions.length">
                <SubscriptionsTable :subscriptions="subscriptions" />
            </div>
            <div
                v-else
                class="my-10 text-center text-xl"
            >
                Nada para exibir
            </div>
        </template>
    </AppPanelContainer>
</template>
