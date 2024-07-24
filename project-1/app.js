const app = Vue.createApp({
    data() {
      return {
        items: {
          title: "Hello Humans",
          items: {
            one: "Hi mahdi",
            two: "Hi ali",
            three: "Hi mmd",
            four: "Hi milad",
            five: "Hi ahmad",
          },
        },
        likes: 0,
      };
    },
    methods: {},
    computed: {
      checkHeart() {
        hearts = "";

        for (i = 0; i <= this.likes / 100; i++) {
          hearts += '<span class="fa fa-heart"></span>';
        }
        return hearts;
      },
    },
    watch: {
      likes(value) {
        if (value == 100) alert("Happy :D");
        console.log(this.items);
      },
    },
    mounted() {
        this.$refs.items_items_one[0].focus()  
    },
    directives:
    {
        autofocus:{
            mounted(el){
                el.focus()
            }
        },
    }
  }).mount("#app");