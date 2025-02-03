<script setup lang="ts">
import { TableHeader } from '@/types/components'

defineProps<{
    header: TableHeader[]
    data: any
}>()
</script>

<template>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400">
            <thead
                class="bg-gray-50 text-xs uppercase text-slate-700 dark:bg-slate-700 dark:text-gray-200"
            >
                <tr>
                    <th
                        v-for="column in header"
                        :key="column.prop"
                        class="px-6 py-3"
                        :class="{
                            'text-center': column.centered || false,
                        }"
                        :style="{ width: column.width || 'auto' }"
                    >
                        {{ column.label }}
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr
                    v-for="row in data"
                    :key="row"
                    class="border-b border-gray-200 bg-white text-gray-200 transition-colors duration-75 hover:bg-gray-50 dark:border-slate-700 dark:bg-slate-800 dark:hover:bg-slate-600"
                >
                    <template
                        v-for="column in header"
                        :key="row[column.prop]"
                    >
                        <td
                            v-if="$slots[`tbody.${column.prop}`]"
                            :class="{
                                'text-center': column.centered,
                            }"
                        >
                            <slot
                                :name="`tbody.${column.prop}`"
                                v-bind="{ data: row }"
                            />
                        </td>
                        <td
                            v-else
                            class="px-6 py-4"
                            :class="{
                                'flex justify-center': column.centered,
                            }"
                        >
                            {{ row[column.prop] }}
                        </td>
                    </template>
                </tr>
            </tbody>
        </table>

        <div class="bg-slate-800 p-4">
            <slot name="footer" />
        </div>
    </div>
</template>
