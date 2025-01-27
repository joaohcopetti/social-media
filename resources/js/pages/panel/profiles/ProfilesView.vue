<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppPaginator from '@/components/paginator/AppPaginator.vue'
import AppTable from '@/components/table/AppTable.vue'
import { TableHeader } from '@/types/components'
import { formatPaginationFromData } from '@/utils/helpers'
import { computed } from 'vue'

const TABLE_HEADERS: TableHeader[] = [
    { label: 'Foto', prop: 'photo', width: '3rem', centered: true },
    { label: 'Nome', prop: 'name' },
    { label: 'Mídias', prop: 'media_count', centered: true },
    { label: 'Opções', prop: 'options', centered: true, width: '10rem' },
]

const props = defineProps<{
    profiles: any
}>()

const pagination = computed(() => formatPaginationFromData(props.profiles))
</script>

<template>
    <div>
        <AppTable
            :header="TABLE_HEADERS"
            :data="props.profiles.data"
        >
            <template #title> Perfis </template>

            <template #caption> Gerenciamento de perfis </template>

            <template #[`tbody.photo`]="{ data }">
                <div class="m-2 flex justify-center">
                    <img
                        class="w-12 rounded-full object-cover"
                        :src="data.photo_url"
                    />
                </div>
            </template>

            <template #[`tbody.options`]>
                <div class="flex gap-2">
                    <AppButton
                        color="success"
                        :icon="{
                            icon: 'ph:eye-fill',
                        }"
                    />
                    <AppButton
                        color="primary"
                        :icon="{
                            icon: 'ph:pencil-fill',
                        }"
                    />
                    <AppButton
                        color="danger"
                        :icon="{
                            icon: 'ph:trash-fill',
                        }"
                    />
                </div>
            </template>

            <template #footer>
                <div class="flex items-center justify-between">
                    <AppPaginator :pagination="pagination" />
                    <div class="text-sm">
                        Exibindo <b>{{ profiles.data.length }}</b> de <b>{{ pagination.total }}</b>
                    </div>
                </div>
            </template>
        </AppTable>
    </div>
</template>
