<template lang="">
    <div class="flex items-center bg-gray-50 justify-between p-4 md:p-5">
        <div class="w-full bg-white rounded  dark:divide-gray-700">
                <div class="bg-whtie" v-for="[key,value] of Object.entries(data)">
                    <div class="flex items-center space-x-4 rtl:space-x-reverse">
                        <div class="flex w-full justify-start">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white ml-5">
                            {{key.toUpperCase()}} :
                            </p>
                            <p class="text-sm ml-2 text-gray-500 truncate dark:text-gray-400">
                            {{value}}
                            </p>
                        </div>

                    </div>
                </div>
            </div>
    </div>
</template>
<script>
export default {
    props:['data'],
}
</script>
<style lang="">

</style>
