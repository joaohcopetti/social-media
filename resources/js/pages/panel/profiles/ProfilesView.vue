<script setup lang="ts">
import AppPaginator from '@/components/AppPaginator.vue'
import AppTable from '@/components/table/AppTable.vue'
import { formatPaginationFromData } from '@/utils/helpers'

const props = defineProps<{
    profiles: any
}>()
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

            <template #caption>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque nam atque ea
                minus temporibus sit quas deserunt officia magni sapiente error aut recusandae
                cupiditate, consequatur eos voluptatibus impedit nobis enim.
            </template>

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
                <AppPaginator :pagination="formatPaginationFromData(props.profiles)" />
            </template>
        </AppTable>
    </div>
</template>
