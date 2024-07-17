<template>
  <form @submit.prevent="">
    <div class="m-auto rounded-sm mt-12 w-96 py-3 px-5 text-white bg-color-3">
      <div class="font-bold text-xl text-center">
        <slot name="title"></slot>
      </div>
      <div class="flex flex-col gap-4 mt-5">
        <slot></slot>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  name: "FormComponent",
  methods: {
    submit(){
      this.$emit('submit.prevent')
    }
  }
};
</script>
