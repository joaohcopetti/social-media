<template>
    <div class="rounded-lg bg-slate-800 p-5">
        <div class="mb-5 text-xl font-bold text-gray-100">
            <slot name="title" />
        </div>

        <div>
            <slot name="body" />
        </div>
    </div>
</template>
