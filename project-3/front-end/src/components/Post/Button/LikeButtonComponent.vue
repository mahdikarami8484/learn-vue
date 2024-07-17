<template>
    <div class="cursor-pointer select-none flex justify-center items-start gap-1">
        <i class="fi" @click="likeHandler" :class="isLike ? 'fi-sr-heart text-red-500 !animate-liked' : 'fi-rr-heart text-white'"></i>
        <p class="text-sm text-white mt-1">{{ like }}</p>
    </div>

</template>

<script>
export default {
    name: "LikeButtonComponent",
    data(){
        return{}
    },
    props: { 
        isLike: {
            type: Boolean,
            default: false
        },
        like: {
            type: Number,
            default: 0
        }
     },
    methods:{
        likeHandler(){
            this.$emit('likeHandler')
        }
    }
}

</script>