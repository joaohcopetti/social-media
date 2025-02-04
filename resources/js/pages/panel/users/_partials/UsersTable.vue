<script setup lang="ts">
import AppTable from '@/components/table/AppTable.vue'
import { TableHeader } from '@/types/components'

const TABLE_HEADERS: TableHeader[] = [
    { label: 'Nome', prop: 'name' },
    { label: 'Assinatura válida até', prop: 'subscription', centered: true },
]

defineProps<{
    users: any
}>()
</script>

<template>
    <AppTable
        :header="TABLE_HEADERS"
        :data="users.data"
    >
        <template #[`tbody.subscription`]> 20/03/2025 </template>
    </AppTable>
</template>
