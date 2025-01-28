<template>
    <div class="rounded-lg bg-slate-700 p-5">
        <div class="mb-2 text-xl font-bold text-gray-100">
            <slot name="title" />
        </div>

        <div>
            <slot name="body" />
        </div>
    </div>
</template>
