<template>
  <OnClickOutside @trigger="open = false">
    <div
      class="w-28 h-10 flex flex-row-reverse gap-1 items-center justify-center pr-4"
      @click="open = !open"
    >
      <p><slot name="text"> </slot></p>
      <i class="fi fi-br-angle-small-left mt-1.5"></i>
    </div>
    <div
      class="absolute right-28 top-5 bg-color-2 rounded-sm h-0 overflow-hidden"
      :class="open ? '!animate-open-menu' : '!animate-close-menu'"
    >
      <slot name="items"></slot>
    </div>
  </OnClickOutside>
</template>

<script>
import { OnClickOutside } from "@vueuse/components";

export default {
  name: "NavComponent",
  components: { OnClickOutside },
  data() {
    return {
      open: false
    };
  },
};
</script>
