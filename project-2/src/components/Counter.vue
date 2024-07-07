<template>

    <div class="p-2 cursor-pointer bg-slate-500 rounded-sm text-white border-slate-600 border-2 select-none hover:font-bold hover:scale-105" @click="addCounter">
        <p class="text-center"> {{  counter }} </p>
    </div>

</template>

<script>

    export default {
        // eslint-disable-next-line vue/multi-word-component-names
        name: "Counter",
        data(){
            return{
                counter: 0
            }
        },
        methods:{
            addCounter(){
                this.counter++
                this.$emit("addTotalCounter")
            }
        }
    }
    
</script>