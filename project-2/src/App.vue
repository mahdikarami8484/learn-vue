<template>

  <div ref="alerts">
    <Alert v-for="alert in alerts" :type="alert.type" :key="alert.msg">
      {{ alert.msg }}
    </Alert>

  </div>

  <h1 class="text-red-800 text-2xl text-center mt-6">{{ title }}</h1>

  <div class="flex justify-center gap-4 mt-6">

    <Counter @addTotalCounter="totalCounter++"/>
    <Counter @addTotalCounter="totalCounter++"/>
    <Counter @addTotalCounter="totalCounter++"/>

  </div>
  
  <div class="flex gap-1 justify-center m-auto w-24 bg-purple-500 mt-4 p-2 rounded-sm text-white font-bold cursor-pointer">
    <p> Total :</p>
    <p> {{ totalCounter }}</p>
  </div>

  <div
    class="bg-green-600 m-auto mt-6 rounded-sm p-3 text-center cursor-pointer text-white w-36 hover:scale-105 hover:border-green-700 hover:border-2"
    @click="showAlert('success...!', 'success')"
  >
    <span class="font-bold">Show Alert</span>
  </div>

  <div
    class="bg-red-600 m-auto mt-6 rounded-sm p-3 text-center cursor-pointer text-white w-36 hover:scale-105 hover:border-red-700 hover:border-2"
    @click="showAlert('Error...!', 'error')"
  >
    <span class="font-bold">Show Alert</span>
  </div>

  <div
    class="bg-yellow-400 m-auto mt-6 rounded-sm p-3 text-center cursor-pointer text-white w-36 hover:scale-105 hover:border-yellow-500 hover:border-2"
    @click="showAlert('Warn...!', 'danger')"
  >
    <span class="font-bold">Show Alert</span>
  </div>



</template>


<script>

import Alert from "./components/Alert.vue";
import Counter from "./components/Counter.vue"


export default {
  name: "App",
  components: { 
    Alert,
    Counter,
   },
  data() {
    return {
      title: "Hello Human, i'm Vue.js app :D",
      totalCounter: 0,
      alerts: [],
    };
  },
  methods: {
    showAlert(msg, type) {
      this.alerts.unshift({ msg:msg , type:type});
      console.log(this.alerts)
    },
  },
};
</script>
