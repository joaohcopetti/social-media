<script setup lang="ts">
import AppPaginator from '@/components/paginator/AppPaginator.vue'
import AppTable from '@/components/table/AppTable.vue'
import { formatPaginationFromData } from '@/utils/helpers'
import { computed } from 'vue'

const props = defineProps<{
    profiles: any
}>()

const pagination = computed(() => formatPaginationFromData(props.profiles))
</script>

<template>
    <div>
        <AppTable
            :header="[
                { label: 'Foto', prop: 'photo', width: '3rem', centered: true },
                { label: 'Nome', prop: 'name' },
                { label: 'Mídias', prop: 'media_count', centered: true },
                { label: 'Opções', prop: 'options', centered: true, width: '10rem' },
            ]"
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

            <template #[`tbody.options`]> O </template>

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
