<template>
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 px-3">
        <div class="row">
          <div class="col-md-4 text-center my-4">
            <img class="rounded rounded-circle" :src="user.profile" width="50%" alt srcset />
          </div>
          <div class="col-md-8">
            <div class="d-flex mt-3 align-items-center">
              <div class="text-muted mr-3 username">{{user.username}}</div>
              <div>
                <router-link
                  :to="'/editprofile/'+this.$route.params.id"
                  class="btn btn-light btn-sm"
                >Edit Profile</router-link>
              </div>
            </div>
            <div class="d-flex">
              <div>
                <b>8</b> Posts
              </div>
              <div class="mx-4">
                <b>8</b> Followers
              </div>
              <div>
                <b>8</b> Following
              </div>
            </div>
            <div class="my-3">
              <b>{{user.name}}</b>
            </div>
            <div
              class="bio"
            >Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non quisquam explicabo quos in perferendis cupiditate.</div>
          </div>
        </div>
        <hr class="my-4" />
        <div class="row">
          <div class="col-md-4 mb-4" v-for="post in posts">
            <img :src="post.avatar" width="100%" alt srcset />
          </div>
        </div>
      </div>
      <div class="col-md-1"></div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      id: "",
      user: [],
      posts: [],
      timenow: ""
    };
  },

  mounted() {
    axios.get("./api/user/" + this.$route.params.id).then(response => {
      this.user = response.data[0];
      this.posts = response.data[1];
      console.log(response.data);
    });
    console.log("Component mounted.");
  },
  computed: {
    username() {
      // We will see what `params` is shortly
      this.id = this.$route.params.id;
      return this.id;
    }
  }
  // watch: {
  //   this.timenow = moment();
  // }
};
</script>
<style scoped>
div.username {
  font-size: 30px;
}
div.bio {
  font-size: 18px;
}
</style>