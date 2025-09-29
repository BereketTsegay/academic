<template lang="">
    <div>
        <div v-for="(item, index) in dataset" :key="index">
            <span>{{item[options.display_field]}}</span>
        </div>
    </div>
</template>
<script>
export default {
    props:{dataset:{type:Array, required:true},options:{ type:Object, required:true}}
}
</script>
<style lang="">
    
</style>