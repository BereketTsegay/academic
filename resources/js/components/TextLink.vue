<script setup>

const props = defineProps({
    href: String,
    tabindex:{
        type : Number,
        required : false,
    }
});
</script>

<template>
    <RouterLink
        :to="props.href"
        :tabindex="props.tabindex"
        class="text-foreground underline decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current! dark:decoration-neutral-500"
    >
        <slot />
    </RouterLink>
</template>
