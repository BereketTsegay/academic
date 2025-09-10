<template lang="">
     <i :class="`fa-solid fa-${iconName}`"></i>
</template>
<script>
export default {
 name:"Icon",
 props:{iconName:{type: String, required : false, default:''}},
}
</script>
<style lang="">

</style>
