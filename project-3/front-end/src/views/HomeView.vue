<template>
    <div class="Home">
        <Post></Post>
        <Post></Post>
        <Post></Post>
    </div>
</template>

<script>
import Post from "@/components/Post/PostComponent.vue"

export default {
    name: "HomeView",
    components: { Post }
}

</script>