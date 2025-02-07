<script setup>
import PanelSidebar from './_partials-panel/PanelSidebar.vue'
</script>

<template>
    <PanelSidebar />
    <div class="px-3 py-6 sm:ml-64 sm:px-10 sm:py-16">
        <slot />
    </div>
</template>
