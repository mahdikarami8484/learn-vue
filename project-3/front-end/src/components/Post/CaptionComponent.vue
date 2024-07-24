<template>
  <div class="text-white overflow-hidden flex gap-0 justify-start" >
    <p class="px-3" :class="showCaption ? 'animate-show-caption' : 'animate-un-show-caption'">
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
