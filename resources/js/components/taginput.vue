<template>

  <div id="tagContainer">

    <div class="flex justify-start align-center flex-wrap">
        <label for="Container_number"
        :class="{'text-red-600 dark:text-red-400':!!hasError.length}"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ placeholder || 'Give lable' }}</label>

        <div v-for='(tag, index) in tags' :key='tag+index' class='tag-input__tag'>
          <span v-if="!!tag">{{ data.find(ele => ele.id == tag )[displayName]}}</span>
          <span @click='removeTag(index)'>x</span>
        </div>
    </div>

    <!-- <input
      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"

    /> -->
    <div class="flex">
      <div class="relative w-full">
            <input type="search" id="search-dropdown"
              @focusin="showDatalist()"
              :placeholder="placeholder"
              v-model="hses"
              @keydown.enter='addTag'
              @keydown.188='addTag'
              @keydown.delete='removeLastTag'
              :class="{'dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600':!!hasError.length}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"/>
            <button type="button"
              @click="$emit('hadishMezgebebKfet')"
            class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
              </svg>
                <span class="sr-only">Search</span>
            </button>
            <template v-if="!!hasError">
                            <p class="mt-2 text-xs text-red-600 dark:text-red-400 absolute" >
                           {{ hasError }}
                        </p>
                        </template>
            <div v-show="showChoices" class="z-10 w-full absolute bg-gray-50 divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700">
              <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                <li v-for="(rec, index) in methazi" :key="rec.id">
                    <button :disabled="aregagxAbTagsKeythlu(rec)" @click="nabTagsAetu(rec)" class="inline-flex w-full px-4 py-2 hover:bg-blue-100 dark:hover:bg-blue-600 dark:hover:text-white">
                      {{ rec[displayName] }}
                    </button>
                </li>
                <li v-if="methazi.length==0">No result found</li>
              </ul>
        </div>
      </div>
    </div>

  </div>

</template>
<script>
  export default {
    props:{
      tagsSet:{type:Array,requried:true},
      placeholder:{type:String,requried:false},
      data:{type:Array,required:true},
      value:{type:String,required:true},
      displayName:{type:String,required:true},
      hasError:{type:String,required:false,default:''},
    },
    data() {
      return {
        tags:[],
        showChoices:false,
        methazi : [],
        hses:'',
      }
    },
    mounted(){
        if(!!this.tagsSet) this.tags=this.tagsSet;
    },
    methods: {
      nabTagsAetu(rec) {

        //  ab tags atya keytkwen mejerta
          if(this.aregagxAbTagsKeythlu(rec)) return false;
          this.tags.push(rec.id);
          this.showChoices=false;
          this.$emit('inputUpdate',this.tags);
        },
        aregagxAbTagsKeythlu(rec){
            return this.tags.includes(rec.id);
        },
      removeTag(index) {
        this.tags.splice(index, 1);
        this.$emit('inputUpdate',this.tags);
      },
      removeLastTag(event) {
        if (event.target.value.length === 0) {
          this.removeTag(this.tags.length - 1)
        }
      },

      showDatalist(){
        this.showChoices=true;
        this.methazi = this.data.filter((rec)=>rec[this.displayName].toLocaleLowerCase().includes(this.hses.toLocaleLowerCase()));
      }

    },
    // watch:{
    //   tags(Value){
    //     // this.$emit('inputUpdate',Value);
    //   }
    // }
  }
</script>
<style scoped>
/*tag input style*/

  .tag-input {
    width: 100%;
    padding: 0 10px;
  }

  .tag-input__tag {
    color: white;
    float: left;
    font-size: 12px;
    margin:0 0.15rem;
    background-color: #0952e1;
    border-radius: 4px;
    padding: 0 8px;
  }

  .tag-input__tag > span {
    cursor: pointer;
    opacity: 0.75;
    display: inline-block;
    margin-left: 8px;
  }

  .tag-input__text, .tag-input__text:focus {
    border: none !important;
    outline: none !important;
  }
</style>
