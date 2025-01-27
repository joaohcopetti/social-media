<script setup lang="ts">
import { Pagination } from '@/utils/helpers'
import { Icon } from '@iconify/vue/dist/iconify.js'
import { computed, onMounted } from 'vue'
import PaginatorItem from './PaginatorItem.vue'

const props = defineProps<{
    pagination: Pagination
}>()

const totalLinks = computed(() => props.pagination.links.length)

onMounted(() => {
    console.log(props.pagination)
})
</script>

<template>
    <nav aria-label="Page navigation example">
        <ul class="inline-flex h-10 -space-x-px text-base">
            <li
                v-for="(link, index) in pagination.links"
                :key="link.label"
            >
                <template v-if="index === 0">
                    <PaginatorItem
                        class="rounded-l-lg"
                        label="Anterior"
                        :href="link.url"
                    >
                        <template #label>
                            <Icon icon="ph:arrow-left-bold" />
                        </template>
                    </PaginatorItem>
                </template>
                <template v-else-if="index === totalLinks - 1">
                    <PaginatorItem
                        class="rounded-r-lg"
                        :href="link.url"
                    >
                        <template #label>
                            <Icon icon="ph:arrow-right-bold" />
                        </template>
                    </PaginatorItem>
                </template>
                <template v-else>
                    <PaginatorItem
                        :active="link.active"
                        :label="link.label"
                        :href="link.url"
                    />
                </template>
            </li>
        </ul>
    </nav>
</template>
