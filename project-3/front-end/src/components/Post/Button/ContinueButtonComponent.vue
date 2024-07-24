<template>
  <div class="flex justify-end p-2 select-none">
    <div
      class="bg-color-4 p-2 cursor-pointer font-bold items-center text-white w-32 flex justify-center gap-2 rounded-sm group hover:scale-105 active:scale-105"
    >
      <p class="">Continue</p>
      <i class="fi fi-br-eyes mt-1 group-hover:-scale-x-100 group-active:-scale-x-100" :class="continued ? 'rotate-180' : ''" ></i>
      
    </div>
  </div>
</template>

<script>
  export default{
    name: "ContinueButtonComponent",
    props: ['continued']
  }
</script>
