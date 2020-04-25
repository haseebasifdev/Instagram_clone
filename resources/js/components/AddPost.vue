<template>
  <div class="container top mt-4">
    <form @submit.prevent="savepost()" enctype="multipart/form-data">
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Caption</label>
        <textarea
          class="form-control"
          v-model="body"
          id="exampleFormControlTextarea1"
          placeholder="Write a caption"
        ></textarea>
      </div>
      <div class="custom-file">
        <input type="file" v-on:change="onFileChange" class="custom-file-input" required />

        <label class="custom-file-label" for="validatedCustomFile">Choose Image to Post...</label>
        <small class="text-danger" v-if="errorInputs">{{errorInputs.avatar[0]}}</small>
      </div>

      <button type="submit" class="btn btn-primary mt-3 mx-auto">Submit</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      id: "",
      picture: "",
      body: "",
      errorInputs: ""
    };
  },
  methods: {
    onFileChange(e) {
      var fileReader = new FileReader();
      fileReader.readAsDataURL(e.target.files[0]);
      fileReader.onload = e => {
        this.picture = e.target.result;
      };
    },

    processFile(event) {
      this.picture = event.target.files[0];
    },
    savepost() {
      this.id = $('meta[name="userid"]').attr("content");
      let data = {
        body: this.body,
        avatar: this.picture,
        user_id: this.id
      };
      axios
        .post("./api/post", data)
        .then(response => {
          // if (response.status === 422) {
          //   this.errorInputs = res.body;
          // } else {
          //   alert("Unkown error!");
          // }

          this.$router.push("/");

          Toast.fire({
            icon: "success",
            title: "Posted successfully"
          });
          console.log(response);
        })
        .catch(error => {
          this.errorInputs = error.response.data.errors;

          Toast.fire({
            icon: "error",
            title: "Something went wrong please try again"
          });
          // console.log(error.response.data.errors);
        });
    }
  },
  mounted() {
    this.id = $('meta[name="userid"]').attr("content");
    axios.get("./api/user/" + this.id).then(response => {
      this.user = response.data[0];
      console.log(response.data);
    });
    console.log("Component mounted.");
  }
};
</script>
<style scoped>
div.username {
  font-size: 30px;
}
div.bio {
  font-size: 18px;
}
.friendlist {
  margin-left: 65%;
}
.route:hover {
  text-decoration: none;
}
div.sidecard {
  margin-top: 10%;
}
</style>