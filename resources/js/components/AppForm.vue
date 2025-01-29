<script setup lang="ts">
import { InertiaForm } from '@inertiajs/vue3'

const props = defineProps<{
    form: InertiaForm<any>
}>()

const onFieldFocus = (event: Event) => {
    const target = event.target as HTMLInputElement

    props.form.clearErrors(target.name)
}
</script>

<template>
    <form @focus.capture="onFieldFocus">
        <slot />
    </form>
</template>
