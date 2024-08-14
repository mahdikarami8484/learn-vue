<template>
    <div class="Posts">
        <Post v-for="post in posts" :pictureData="post.pictureData" :text="post.text" :init_is_liked='post.is_liked' :init_is_viewed="post.is_viewed" :init_views="post.views" :init_likes="post.likes"></Post>
    </div>
</template>

<script>
import Post from "@/components/Post/PostComponent.vue"

export default {
    name: "PostsComponent",
    components: { Post },
    data() {
        return {
            posts: [
                {
                    pictureData: {
                        name: "image",
                        format: "jpg",
                        address:
                            "https://static.vecteezy.com/system/resources/thumbnails/009/398/082/small_2x/tree-growth-on-globe-glass-in-nature-concept-eco-earth-day-free-photo.jpg",
                        alt: "nature pic",
                    },
                    text: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
                    likes: 5,
                    views: 10,
                    is_liked: true,
                    is_viewed: false
                }
            ]
        }
    }
}


</script>