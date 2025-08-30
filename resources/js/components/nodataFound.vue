<template>
    <div class="nodata">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10 hover:text-blue-500 cursor-pointer">
            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
        </svg>
        <h3 class="cursor-pointer hover:text-blue-500" @click="$emit('add')">No data Found</h3>
    </div>
</template>
<script>

export default {

}
</script>
<style>
 .nodata{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 10rem;
    width: 100%;
    color: black;
    border: 1px;
    border-radius: 0.15rem;
    background-color: rgba(244,244,244, 0.5);
}
</style>
