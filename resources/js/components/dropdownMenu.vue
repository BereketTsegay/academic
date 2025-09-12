<template lang="">
   <!-- Include this script tag or install `@tailwindplus/elements` via npm: -->
<!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> -->
<el-dropdown class="inline-block">
  <button class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white/10 px-3 py-2 text-sm font-semibold text-white inset-ring-1 inset-ring-white/5 hover:bg-white/20">
    {{label}}
    <i class="fa-solid fa-ellipsis-vertical"></i>
    
  </button>

  <el-menu anchor="bottom end" popover class="w-56 origin-top-right rounded-md bg-gray-800 outline-1 -outline-offset-1 outline-white/10 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
    <div class="py-1">
     <slot />

    </div>
  </el-menu>
</el-dropdown>

</template>
<script>
import faIcon from './faIcon.vue';
export default {
    name:"DropdownMenu",
    components:{faIcon},
    props:{
        actions:{
            type:Array,
            required: true,
        },
        label : String

    },
    data() {
        return {
            toggle:false,
        }
    },
}
</script>
<style lang="">

</style>
