<template>
  <div class="flex justify-between items-center">
    <div class="w-11/12 flex justify-between items-center font-bold">
      <div>
        <slot></slot>
      </div>
      <input
        ref="input"
        :value="modelValue"
        :type="pass"
        :name="name"
        :placeholder="placeholder"
        class="outline-none focus:outline-none text-white border-color-2 border-2 rounded-sm bg-color-1 p-1 placeholder:text-color-2 invalid:border-red-600 invalid:bg-red-400" @change="validInput" @input="$emit('update:modelValue', $event.target.value)"/>
    </div>
    <i
      v-show="type=='password'"
      class="text-2xl mt-1 active:animate-liked fi"
      :class="!show ? 'fi-rr-face-eyes-xmarks' : 'fi-rr-laugh-beam'" @click.stop="setType"
    ></i>
  </div>
</template>

<script>
export default {
  name: "InputComponent",
  props: ["name", "placeholder", "type", "modelValue"],
  emits: ['update:modelValue'],
  data() {
    return {
      show: false,
      pass: this.type
    };
  },
  computed:{},
  methods:{
    setType(){
        this.show = !this.show;
        this.pass = this.show ? 'text' : 'password';
    },
    validInput(){
        var el = this.$refs.input
        this.$emit('validInput', [this.name, el])
    }
  }
};
</script>
