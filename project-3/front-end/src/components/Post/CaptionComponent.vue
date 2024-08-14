<template>
  <div class="text-white mt-2 overflow-hidden flex gap-0 justify-start" >
    <p class="px-3 pb-3" :class="showCaption ? 'animate-show-caption max-h-max' : 'animate-un-show-caption'">
      <slot></slot>
    </p>
  </div>
</template>

<script>
import { showCaption } from '@/assets/animations/caption/keyframes/showCaption';

export default {
  name: "CaptionComponent",
  props: ["showCaption"],
};
</script>
