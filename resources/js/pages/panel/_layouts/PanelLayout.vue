<script setup>
import HeaderButtons from './_partials/HeaderButtons.vue'

import PanelSidebar from './_partials/PanelSidebar.vue'
</script>

<template>
    <HeaderButtons />
    <PanelSidebar />
    <div class="px-3 py-6 sm:ml-64 sm:px-10 sm:py-16">
        <slot />
    </div>
</template>
