<template>
  <Alert v-for="alert in alerts" :type="alert.type"> {{ alert.msg }}</Alert>
  <div>
    <Form @submit.prevent="doLogin">
      <template v-slot:title>Sing In</template>
      <Input
        placeholder="Username like mio15"
        name="username"
        @validInput="validData"
        type="text"
        v-model="username"
        >Username :</Input
      >
      <Input
        type="password"
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
    validData([name, el]) {
      if (name == "password") {
        if (el.value.length > 16 || el.value.length < 6) {
          el.setCustomValidity("your password should be between 6 - 16 char");
          this.showAlert(
            "your password should be between 6 - 16 char",
            "error"
          );
        } else {
          el.setCustomValidity("");
        }
      }

      if (name == "username") {
        if (el.value == "") {
          el.setCustomValidity("please enter your username");
          this.showAlert("please enter your username", "danger");
        } else {
          el.setCustomValidity("");
        }
      }
    },
    showAlert(msg, type) {
      this.alerts.unshift({ msg: msg, type: type });
    },
    doLogin() {
      console.log([this.username, this.password]);
      // this.$store.commit('login', "abc111")
      // this.$router.push("/admin")
    },
  },
  data() {
    return {
      alerts: [],
      username: "",
      password: "",
    };
  },
};
</script>
