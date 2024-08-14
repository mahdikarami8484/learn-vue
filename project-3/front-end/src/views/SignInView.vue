<template>
  <Alert v-for="alert in alerts" :type="alert.type"> {{ alert.msg }}</Alert>
  <div>
    <Form @submit.prevent="doLogin">
      <template v-slot:title>Sing In</template>
      <Input
        ref="username"
        placeholder="Username like mio15"
        name="username"
        @validInput="validData"
        type="text"
        v-model="username"
        >Username :</Input
      >
      <Input
        type="password"
        ref="password"
        placeholder="Your password"
        name="password"
        @validInput="validData"
        :value="password" v-model="password"
        >Password :
      </Input>

      <Button>Sign In</Button>
    </Form>
  </div>
</template>

<script>
import Form from "@/components/Form/FormComponent.vue";
import Input from "@/components/Form/InputComponent.vue";
import Button from "@/components/Form/ButtonComponent.vue";
import Alert from "@/components/Alert/AlertComponent.vue";

export default {
  name: "SignInView",
  components: { Form, Input, Button, Alert },
  methods: {
    validData(name = "") {
      const username = this.$refs.username.$refs.input
      const password = this.$refs.password.$refs.input
      
      if ((this.password.length > 16 || this.password.length < 6) && (name == "password" || name == "")) {
        password.setCustomValidity("your password should be between 6 - 16 char");
        this.showAlert(
          "your password should be between 6 - 16 char",
          "error"
        );
        this.access = false
      } else {
        password.setCustomValidity("");
      }

      if (this.username == "" && (name == "username" || name == "")) {
        username.setCustomValidity("please enter your username");
        this.showAlert("please enter your username", "error");
        this.access = false
      } else {
        username.setCustomValidity("");
      }

    },
    showAlert(msg, type) {
      this.alerts.unshift({ msg: msg, type: type });
    },
    doLogin() {
      this.access = true
      this.validData()
      if(this.access){
        this.$store.commit('login', `${this.username}:${this.password}`)
        this.$router.push("/admin")
      }
    },
  },
  data() {
    return {
      alerts: [],
      username: "",
      password: "",
      access: true
    };
  },
};
</script>
