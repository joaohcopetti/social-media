<script setup lang="ts">
import AppDropdown from '@/components/AppDropdown.vue'
import AppPaginator from '@/components/paginator/AppPaginator.vue'
import AppTable from '@/components/table/AppTable.vue'
import { DropdownItem, TableHeader } from '@/types/components'
import { Profile } from '@/types/models'
import { formatPaginationFromData } from '@/utils/helpers'
import { computed } from 'vue'

const TABLE_HEADERS: TableHeader[] = [
    { label: 'Foto', prop: 'photo', width: '3rem', centered: true },
    { label: 'Nome', prop: 'name' },
    { label: 'Mídias', prop: 'media_count', centered: true },
    { label: 'Opções', prop: 'options', centered: true, width: '10rem' },
]

const props = defineProps<{ profiles: any }>()

const pagination = computed(() => formatPaginationFromData(props.profiles))
const getDropdownOptions = (data: Profile): DropdownItem[] => {
    return [
        {
            label: 'Ver',
            href: route('profile.index', { profile: data.slug }),
            icon: 'ph:eye',
            openInNewTab: true,
        },
        {
            label: 'Editar',
            href: route('panel.profiles.edit', { profile: data.slug }),
            icon: 'ph:pencil',
        },
        {
            label: 'Gerenciar mídias',
            href: route('panel.profiles.manage-media', { profile: data.slug }),
            icon: 'ph:image',
        },
        {
            label: 'Excluir',
            icon: 'ph:trash',
            onClick: () => {
                console.log('ola')
            },
        },
    ]
}
</script>

<template>
    <AppTable
        :header="TABLE_HEADERS"
        :data="profiles.data"
    >
        <template #[`tbody.photo`]="{ data }">
            <div class="m-2 flex justify-center">
                <img
                    class="w-12 rounded-full object-cover"
                    :src="data.photo_thumb_url"
                />
            </div>
        </template>
        <template #[`tbody.options`]="{ data }">
            <AppDropdown
                :icon="{ icon: 'ph:dots-three-outline-fill' }"
                :items="getDropdownOptions(data)"
            />
        </template>
        <template #footer>
            <div class="flex items-center justify-between">
                <AppPaginator :pagination="pagination" />
                <div class="text-sm">
                    Exibindo <b>{{ profiles.data.length }}</b> de
                    <b>{{ pagination.total }}</b>
                </div>
            </div>
        </template>
    </AppTable>
</template>
