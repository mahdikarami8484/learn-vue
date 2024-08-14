<template>
  <div class="bg-color-3 w-96 m-auto mt-14 mb-14 rounded-sm relative">
    <Picture @dblclick="showBigLike" :pictureData="pictureData">
      <BigLike :class="bigLike ? '!animate-big-like' : 'hidden'" />
    </Picture>

    <div class="pt-2 pl-2 flex gap-5 text-2xl font-bold">
      <LikeButton :like="likes" :isLike="is_liked" @likeHandler="likeHandler" />
      <ViewButton :viewed="is_viewed" :view="views" />
    </div>
    <Caption :showCaption="showCaption">
      {{ showText }}
    </Caption>
    <ContinueButton v-if="text.length > 276" @click="showCaptionFun" :continued="showCaption" />
  </div>
</template>

<script>
import Picture from "./PictureComponent.vue";
import LikeButton from "./Button/LikeButtonComponent.vue";
import ViewButton from "./Button/ViewButtonComponent.vue";
import Caption from "./CaptionComponent.vue";
import ContinueButton from "./Button/ContinueButtonComponent.vue";
import BigLike from "./BigLikeComponent.vue";
import { showCaption } from "@/assets/animations/caption/keyframes/showCaption";

export default {
  name: "PostComponent",
  components: {
    Picture,
    LikeButton,
    ViewButton,
    Caption,
    ContinueButton,
    BigLike,
  },
  data() {
    return {
      showCaption: false,
      is_viewed: this.init_is_viewed,
      views: this.init_views,
      bigLike: false,
      likes: this.init_likes,
      is_liked: this.is_liked,
    };
  },
  props: ['pictureData', 'text', 'init_likes', 'init_views', 'init_is_liked', 'init_is_viewed'],
  methods: {
    showCaptionFun() {
      if (!this.is_viewed) this.views++;
      this.is_viewed = true;
      this.showCaption = !this.showCaption;
    },
    showBigLike() {
      this.bigLike = true;
      if (!this.is_liked) {
        this.likes++;
        this.is_liked = true;
      }
      setTimeout(() => {
        this.bigLike = false;
      }, 501);
    },
    likeHandler() {
      if (!this.is_liked) {
        this.showBigLike();
      } else {
        this.likes--;
        this.is_liked = false;
      }
    },
  },
  computed: {
    showText() {
      if (this.text.length <= 276) {
        if (!this.is_viewed) {
          this.views++;
          this.is_viewed = true;
        }
        return this.text;
      }
      if (this.showCaption) return this.text;
      return this.text.slice(0, 276);
    }
  }
};
</script>
