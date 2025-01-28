<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppContainer from '@/components/AppContainer.vue'

const PROFILES_INDEX_ROUTE = route('panel.profiles.index')
</script>

<template>
    <div>
        <div class="mb-5">
            <AppButton
                label="Voltar"
                :inertia-link-attrs="{ href: PROFILES_INDEX_ROUTE }"
            />
        </div>
        <AppContainer>
            <template #title> Cadastre um novo perfil </template>
            <template #body>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis cupiditate
                distinctio fugiat dolorem error neque sapiente ab deleniti libero, id delectus
                commodi accusantium autem magnam voluptates omnis corrupti optio. Asperiores?
            </template>
        </AppContainer>
    </div>
</template>
