<template>
  <div class="w-full relative">
    <img
      class="rounded-t-sm w-full h-full max-h-80"
      :src="imageSrc"
      :alt="pictureData.alt"
    />
    <slot></slot>
  </div>
</template>

<script>
import nonePostPic from "@/assets/img/nonePost.png";

export default {
  name: "PictureComponent",
  data() {
    return {
      imageSrc: nonePostPic,
    };
  },
  props: {
    pictureData: {
      default: {
        name: "nonePost",
        format: "png",
        address: nonePostPic,
        alt: "nonePost",
      },
    },
  },
  mounted() {
    this.loadImage();
  },
  methods: {
    async loadImage() {
      try {
        if (!this.pictureData.address) throw new Error("Image not found..!");
        const response = await fetch(this.pictureData.address);
        console.log(response)
        if (!response.ok) throw new Error("Image not found..!");
        this.imageSrc = this.pictureData.address;
      } catch (error) {
        console.log(error)
      }
    },
  },
};
</script>
