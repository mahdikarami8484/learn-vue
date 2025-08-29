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
                    name: "image1",
                    format: "jpg",
                    address: "https://picsum.photos/id/1018/400/300",
                    alt: "mountain view",
                },
                text: "Exploring the mountains gives a sense of freedom and peace that is hard to describe.",
                likes: 12,
                views: 45,
                is_liked: true,
                is_viewed: true
            },
            {
                pictureData: {
                    name: "image2",
                    format: "jpg",
                    address: "https://picsum.photos/id/1025/400/300",
                    alt: "dog portrait",
                },
                text: "A faithful companion, always bringing joy and love to our lives.",
                likes: 33,
                views: 78,
                is_liked: false,
                is_viewed: true
            },
            {
                pictureData: {
                    name: "image3",
                    format: "jpg",
                    address: "https://picsum.photos/id/1039/400/300",
                    alt: "city skyline",
                },
                text: "The city lights shine brighter at night, carrying endless stories in every window.",
                likes: 8,
                views: 20,
                is_liked: false,
                is_viewed: false
            },
            {
                pictureData: {
                    name: "image4",
                    format: "jpg",
                    address: "https://picsum.photos/id/1043/400/300",
                    alt: "forest pathway",
                },
                text: "Walking in nature reminds us of the simple beauty that surrounds us every day.",
                likes: 27,
                views: 64,
                is_liked: true,
                is_viewed: true
            },
            {
                pictureData: {
                    name: "image5",
                    format: "jpg",
                    address: "https://picsum.photos/id/1059/400/300",
                    alt: "desert dunes",
                },
                text: "Golden sands stretching endlessly, shaped by the winds of time.",
                likes: 14,
                views: 30,
                is_liked: false,
                is_viewed: true
            },
            {
                pictureData: {
                    name: "image6",
                    format: "jpg",
                    address: "https://picsum.photos/id/1069/400/300",
                    alt: "lake reflection",
                },
                text: "A mirror of the sky, calm waters reflecting the clouds above.",
                likes: 40,
                views: 95,
                is_liked: true,
                is_viewed: true
            },
            {
                pictureData: {
                    name: "image7",
                    format: "jpg",
                    address: "https://picsum.photos/id/1074/400/300",
                    alt: "snowy mountain",
                },
                text: "Snow peaks stand tall, a symbol of endurance and serenity.",
                likes: 6,
                views: 15,
                is_liked: false,
                is_viewed: false
            },
            {
                pictureData: {
                    name: "image8",
                    format: "jpg",
                    address: "https://picsum.photos/id/1084/400/300",
                    alt: "sunset beach",
                },
                text: "Waves kiss the shore under a sky painted with sunset colors.",
                likes: 51,
                views: 120,
                is_liked: true,
                is_viewed: true
            },
            {
                pictureData: {
                    name: "image9",
                    format: "jpg",
                    address: "https://picsum.photos/id/1081/400/300",
                    alt: "field of flowers",
                },
                text: "Every flower blooms in its own time, together creating a colorful harmony.",
                likes: 19,
                views: 40,
                is_liked: false,
                is_viewed: true
            },
            {
                pictureData: {
                    name: "image10",
                    format: "jpg",
                    address: "https://picsum.photos/id/109/400/300",
                    alt: "old bridge",
                },
                text: "An ancient bridge, carrying countless footsteps and untold stories.",
                likes: 23,
                views: 58,
                is_liked: true,
                is_viewed: false
            }
        ]

        }
    }
}


</script>