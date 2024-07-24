<template>
    <div class="cursor-pointer select-none flex justify-center items-start gap-1 text-white">
        <i class="active:animate-liked fi" :class="!viewed ? 'fi-rr-face-eyes-xmarks' : 'fi-rr-laugh-beam'"></i>
        <p class="text-sm text-white mt-1">{{ view }}</p>
    </div>

</template>

<script>
export default {
    name: "ViewButtonComponent",
    data(){
        return{
        }
    },
    props: [ 'viewed', 'view']
}
</script>