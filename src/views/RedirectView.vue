<template>
</template>

<script>
import axios from "axios"
import {useRoute, useRouter} from "vue-router";

export default {

  created() {
     console.log(this.$route.params);
     axios.get(`http://127.0.0.1:8000/api/v1/urls/${this.$route.params.id}`).then((response) =>{
      window.location.href = response.data.url;
    });
  },

};
</script>