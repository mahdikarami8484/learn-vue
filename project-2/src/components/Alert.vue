<template>
  <div
    class="w-64 rounded-sm border-solid m-auto relative px-2 pt-1 pb-4 border-2 font-bold leading-3 cursor-default mt-4 animate-alert-open visible"
    :class="[setType(type), show ? '' : '!animate-alert-close']">
    <span class="fa-solid fa-close hover:scale-125 cursor-pointer transition hover:duration-100 ease-in-out" @click="show = false"></span>
    <p class="text-sm mx-2 mt-1 ">
      <span class="mr-1" :class="icon"></span>  
      <slot></slot>
    </p>
  </div>
</template>

<script>

export default {
  // eslint-disable-next-line vue/multi-word-component-names
  name: "Alert",
  data(){
    return{
      show: true,
      icon: "fa fa-home"
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
          this.icon = "fa fa-check-circle"
          return "bg-green-200 border-green-300 text-green-500"
        case "danger":
          this.icon = "fa fa-exclamation-circle "
          return "bg-yellow-200 border-yellow-300 text-yellow-500"
        case "error":
          this.icon = "fa fa-exclamation-triangle "
          return "bg-red-200 border-red-300 text-red-500"
      }
    }
  }
}


</script>
