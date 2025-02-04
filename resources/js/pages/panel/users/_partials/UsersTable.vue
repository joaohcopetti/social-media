<script setup lang="ts">
import AppDropdown from '@/components/AppDropdown.vue'
import AppTable from '@/components/table/AppTable.vue'
import { DropdownItem, TableHeader } from '@/types/components'
import { User } from '@/types/models'

const TABLE_HEADERS: TableHeader[] = [
    { label: 'Nome', prop: 'name' },
    { label: 'Assinatura válida até', prop: 'subscription', centered: true },
    { label: '', prop: 'options', centered: true },
]

const emit = defineEmits(['edit'])

defineProps<{
    users: any
}>()

const getDropdownOptions = (user: User): DropdownItem[] => [
    {
        label: 'Editar',
        onClick: () => {
            emit('edit', { user })
        },
        icon: 'ph:pencil',
    },
]
</script>

<template>
    <AppTable
        :header="TABLE_HEADERS"
        :data="users.data"
    >
        <template #[`tbody.subscription`]> 20/03/2025 </template>
        <template #[`tbody.options`]="{ data }">
            <AppDropdown
                :icon="{ icon: 'ph:dots-three-outline-fill' }"
                :items="getDropdownOptions(data)"
            />
        </template>
    </AppTable>
</template>
