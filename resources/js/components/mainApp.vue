<template>
    <div class="max-h-svh">
        <router-view></router-view>
    </div>
</template>

<script>
    import { initFlowbite, 
        initAccordions, 
        initCarousels, 
        initCollapses, 
        initDials, 
        initDismisses, 
        initDrawers, 
        initDropdowns, 
        initModals, 
        initPopovers, 
        initTabs, 
        initTooltips } from 'flowbite';
    export default {
        mounted() {
            initFlowbite();
            initAccordions();
            initCarousels();
            initCollapses();
            initDials();
            initDismisses();
            initDrawers();
            initDropdowns();
            initModals();
            initPopovers();
            initTabs();
            initTooltips();
        }
    }
</script>
