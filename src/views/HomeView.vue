<template>
  <main>
    <form @submit.prevent="submitForm">
      <span>URL</span><br>
      <input 
        v-model="url"
        type="text"
        placeholder="Enter URL" 
      /><br>
      <button type="submit">Tinify</button>
    </form>
    <span v-if="formSubmitted"> The new URL is {{ tiny }} </span>
  </main>
</template>

<script>
  import axios from "axios"

  export default {
    data() {
      return {
        url: "",
        tiny: "",
        formSubmitted: false
      };
    },
    methods: {
      submitForm: async function () {
        this.formSubmitted = true;
        const response = await axios.post("http://127.0.0.1:8000/api/v1/urls", {
          url: this.url
        })
        this.tiny = response.data.data.hash + '<3';
        console.log(response);
      }
    },
  };
</script>
<style>
  form {
    padding: 10px;
    border: 2px solid black;
    border-radius: 5px;
  }

  input {
    padding: 4px 8px;
    margin: 4px;
  }

  span {
    font-size: 18px;
    margin: 4px;
    font-weight: 500;
  }

  .submit {
    font-size: 15px;
    color: #fff;
    background: #222;
    padding: 6px 12px;
    border: none;
    margin-top: 8px;
    cursor: pointer;
    border-radius: 5px;
  }

</style>