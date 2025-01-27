<script setup>
import PanelSidebar from './_partials-panel/PanelSidebar.vue'
</script>

<template>
    <PanelSidebar />
    <div class="p-4 sm:ml-64">
        <slot />
    </div>
</template>
