<script setup lang="ts">
import { TableHeader } from '@/types/components'

defineProps<{
    header: TableHeader[]
    data: any
}>()
</script>

<template>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-400 rtl:text-right">
            <thead class="bg-slate-700 text-xs uppercase text-gray-200">
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
                    class="200 border-b border-slate-700 bg-slate-800 text-gray-200 transition-colors duration-75 hover:bg-slate-600"
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
