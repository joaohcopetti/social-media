<script setup lang="ts">
import AppDropdown from '@/components/AppDropdown.vue'
import AppPaginator from '@/components/paginator/AppPaginator.vue'
import AppTable from '@/components/table/AppTable.vue'
import { DropdownItem, TableHeader } from '@/types/components'
import { User } from '@/types/models'
import { formatPaginationFromData } from '@/utils/helpers'
import { computed } from 'vue'

const TABLE_HEADERS: TableHeader[] = [
    { label: 'Nome', prop: 'name' },
    { label: 'E-mail', prop: 'email' },
    { label: 'Assinatura válida até', prop: 'subscription', centered: true },
    { label: '', prop: 'options', centered: true },
]

const emit = defineEmits(['edit'])

const props = defineProps<{
    users: any
}>()

const pagination = computed(() => formatPaginationFromData(props.users))

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
        <template #[`tbody.name`]="{ data }: { data: User }">
            <div class="flex items-center gap-2 px-6 py-4">
                <span>{{ data.name }}</span>
            </div>
        </template>
        <template #[`tbody.subscription`]> 20/03/2025 </template>
        <template #[`tbody.options`]="{ data }">
            <AppDropdown
                :icon="{ icon: 'ph:dots-three-outline-fill' }"
                :items="getDropdownOptions(data)"
            />
        </template>

        <template #footer>
            <AppPaginator :pagination="pagination" />
        </template>
    </AppTable>
</template>
