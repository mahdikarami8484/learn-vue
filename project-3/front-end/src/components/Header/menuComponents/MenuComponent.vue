<template>
  <div class="">
    <OnClickOutside @trigger="open = false">
      <div
        class="text-2xl cursor-pointer transition duration-150 hover:scale-110"
        @click="open = !open"
      >
        <i
          class="fi"
          :class="[open ? 'fi-br-bars-staggered' : 'fi-br-menu-burger']"
        ></i>
      </div>

      <div
        class="absolute w-28 overflow-hidden bg-color-2 right-5 top-11 rounded-sm h-0 select-none z-50"
        :class="[open ? '!animate-open-menu' : '!animate-close-menu']"
      >
        <RouterLink to="home"
          ><ItemMenu> <p>Home</p> </ItemMenu>
        </RouterLink>
        <RouterLink :to="{ name: 'SignIn' }"
          ><ItemMenu v-if="!$store.state.isAuthenticated">
            <p>Sign In</p>
          </ItemMenu></RouterLink
        >
        <RouterLink to="/admin"
          ><ItemMenu v-if="$store.state.isAuthenticated">
            <p>Admin Panel</p>
          </ItemMenu></RouterLink
        >
        <ItemMenu>
          <Nav>
            <template v-slot:text> Ok </template>
            <template v-slot:items>
              <ItemMenu><p>test</p></ItemMenu>
            </template>
          </Nav>
        </ItemMenu>
      </div>
    </OnClickOutside>
  </div>
</template>

<script>
import ItemMenu from "./ItemMenuComponent.vue";
import Nav from "./NavComponent.vue";
import { OnClickOutside } from "@vueuse/components";

export default {
  name: "MenuComponent",
  components: { ItemMenu, OnClickOutside, Nav },
  data() {
    return {
      open: false,
    };
  },
  methods: {
    handleClickOutside() {
      if (this.menu) this.open = false;
    },
  },
};
</script>
