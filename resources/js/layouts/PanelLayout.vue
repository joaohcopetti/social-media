<script setup>
import PanelSidebar from './_partials-panel/PanelSidebar.vue'
</script>

<template>
    <PanelSidebar />
    <div class="px-10 py-16 sm:ml-64">
        <slot />
    </div>
</template>
