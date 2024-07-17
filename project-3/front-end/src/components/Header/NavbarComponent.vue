<template>
    <div class="bg-color-3 text-white flex flex-initial justify-between items-center py-3 px-2">
        <RouterLink to="/">
            <Icon>
                {{ title }}
            </Icon>
        </RouterLink>

        <Menu></Menu>
    </div>
</template>

<script>
    import Icon from './IconComponent.vue'
    import Menu from './menuComponents/MenuComponent.vue'

    export default {
        name: "NavbarComponent",
        components: { Icon, Menu },
        data() { 
            return {
                title: 'Blog'
            }
        },
    }
</script>