<template>
  <OnClickOutside @trigger="clicked=false">
    <div
      class="w-28 rounded-sm flex border-b-current justify-center items-center border-b-2 border-b-color-3 cursor-pointer relative h-10"
      @click="clicked = true" :class="clicked ? 'bg-color-3' : ''"
    >
      <slot></slot>
    </div>
  </OnClickOutside>
</template>

<script>
import { OnClickOutside } from "@vueuse/components";

export default {
  name: "ItemMenuComponent",
  components: { OnClickOutside },
  data() {
    return {
      clicked: false,
    };
  },
};
</script>
