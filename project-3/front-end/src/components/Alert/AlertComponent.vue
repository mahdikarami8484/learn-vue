<template>
    <div
      class="w-64 rounded-sm border-solid m-auto relative px-2 pt-1 pb-2 border-2 font-bold leading-3 cursor-default mt-4 animate-alert-open visible"
      :class="[setType(type), show ? '' : '!animate-alert-close']">
      <i class="fi fi-bs-circle-xmark text-md cursor-pointer transition duration-300" @click="show = false"></i>
      <div class="flex gap-1 mx-2">
        <i class="text-lg" :class="icon"></i>
        <p class="text-sm self-start">  
        <slot></slot>
        </p>
      </div>

    </div>
  </template>
  
  <script>
  
  export default {
    name: "AlertComponent",
    data(){
      return{
        show: true,
        icon: ""
      }
    },
    props: [
      'type',
    ],
    methods:{
      setType(type)
      {
        switch(type){
          case "success":
            this.icon = "fi fi-ss-check-circle"
            return "bg-green-200 border-green-300 text-green-500"
          case "danger":
            this.icon = "fi fi-ss-exclamation"
            return "bg-yellow-200 border-yellow-300 text-yellow-500"
          case "error":
            this.icon = "fi-ss-triangle-warning"
            return "bg-red-200 border-red-300 text-red-500"
        }
      }
    }
  }
  
  
  </script>