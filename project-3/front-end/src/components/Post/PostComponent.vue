<template>
  <div class="bg-color-3 w-10/12 m-auto mt-14 mb-14 rounded-sm relative">
    <Picture @dblclick="showBigLike" :pictureData="pictureData">
      <BigLike :class="bigLike ? '!animate-big-like' : 'hidden'" />
    </Picture>

    <div class="pt-2 pl-2 flex gap-5 text-2xl font-bold">
      <LikeButton :like="like" :isLike="isLike" @likeHandler="likeHandler" />
      <ViewButton :viewed="viewed" :view="view" />
    </div>
    <Caption :showCaption="showCaption">
      Lorem Ipsum is simply dummy text of the printing and typesetting industry.
      Lorem Ipsum has been the industry's standard dummy text ever since the
      1500s, when an unknown printer took a galley of type and scrambled it to
      make a type specimen book. It has survived not only five centuries, but
      also the leap into electronic typesetting, remaining essentially
      unchanged. It was popularised in the 1960s with the release of Letraset
      sheets containing Lorem Ipsum passages, and more recently with desktop
      publishing software like Aldus PageMaker including versions of Lorem
      Ipsum.
    </Caption>
    <ContinueButton @click="showCaptionFun" :continued="showCaption" />
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
      viewed: false,
      view: 100,
      bigLike: false,
      like: 10,
      isLike: false,
      pictureData: {
        name: "image",
        format: "jpg",
        address:
          "https://static.vecteezy.com/system/resources/thumbnails/009/398/082/small_2x/tree-growth-on-globe-glass-in-nature-concept-eco-earth-day-free-photo.jpg",
        alt: "nature pic",
      },
    };
  },
  props: [
  ],
  methods: {
    showCaptionFun() {
      if (!this.viewed) this.view++;
      this.viewed = true;
      this.showCaption = !this.showCaption;
    },
    showBigLike() {
      this.bigLike = true;
      if (!this.isLike) {
        this.like++;
        this.isLike = true;
      }
      setTimeout(() => {
        this.bigLike = false;
      }, 501);
    },
    likeHandler() {
      if (!this.isLike) {
        this.showBigLike();
      } else {
        this.like--;
        this.isLike = false;
      }
    },
  },
};
</script>
