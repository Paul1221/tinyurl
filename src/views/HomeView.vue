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
    <span v-if="formSubmitted"> The new URL is <a :href = tiny>{{ tiny }}</a> </span>
    <span v-if="!isSafe"> The URL is not safe to browse or no Api key for google added </span>
  </main>
</template>

<script>
  import axios from "axios"

  export default {
    data() {
      return {
        url: "",
        tiny: "",
        formSubmitted: false,
        isSafe: true
      };
    },
    methods: {
      submitForm: async function () {
        const safeResponse = await axios.post("https://safebrowsing.googleapis.com/v4/threatMatches:find?key=you-can-put-yours-if-you-want-to-test-it",{
          client: {
            clientId: "Paul",
            clientVersion: "1.0.0"
          },
          threatInfo: {
            threatTypes:      ["MALWARE", "SOCIAL_ENGINEERING"],
            platformTypes:    ["WINDOWS"],
            threatEntryTypes: ["URL"],
            threatEntries: [
              {url: this.url}
            ]
          }
        },{
          headers: {
            'Content-Type': 'application/json'
          }
        })
        if(safeResponse.data.matches === undefined){
          this.isSafe = true;
          this.formSubmitted = true;
          const response = await axios.post("http://127.0.0.1:8000/api/v1/urls", {
            url: this.url
          })
          this.tiny = "http://localhost:5173/" + response.data.data.hash;
        }else{
          this.isSafe = false;
          this.formSubmitted = false;
        }
        
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