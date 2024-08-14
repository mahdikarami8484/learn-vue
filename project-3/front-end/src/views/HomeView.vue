<template>
    <div class="Home">
        <Posts></Posts>
    </div>
</template>

<script>
import Posts from "@/components/Post/PostsComponent.vue"

export default {
    name: "HomeView",
    components: { Posts },
    data() {
        return {
        }
    }
}


</script>