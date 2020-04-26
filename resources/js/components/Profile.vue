<template>
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 px-3">
        <div class="row">
          <div class="col-md-4 text-center my-4">
            <img class="rounded rounded-circle" :src="user.profile" width="55%" alt srcset />
          </div>
          <div class="col-md-8">
            <div class="d-flex mt-3 align-items-center">
              <div class="text-muted username">{{user.username}}</div>
              <div>
                <router-link
                  v-if="authid==this.$route.params.id"
                  :to="'/editprofile/'+this.$route.params.id"
                  class="btn btn-light btn-sm mx-3"
                >Edit Profile</router-link>
              </div>
              <div class="settingicon" v-if="authid==this.$route.params.id" @click="showmodel()">
                <i class="fas fa-cog fa-2x"></i>
              </div>
            </div>
            <div class="d-flex my-3">
              <div>
                <b>{{posts.length}}</b> Posts
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
    <!-- Model -->
    <div
      class="modal fade p-4"
      id="profilemodel"
      tabindex="-1"
      role="dialog"
      aria-labelledby="profilemodelTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content d-block modelcontent">
          <!-- <div class="modal-body "> -->
          <button class="btn btn-white btn-block btn-lg border-bottom">Change Password</button>
          <button @click="hidemodel()" class="btn btn-white btn-block btn-lg">Cancel</button>
          <!-- </div> -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      id: " ",
      authid: "",
      visiteduser: " ",
      user: [],
      posts: [],
      timenow: ""
    };
  },
  beforeRouteUpdate(to, from, next) {
    this.visiteduser = to.params.id;
    axios.get("./api/user/" + to.params.id).then(response => {
      this.user = response.data[0];
      this.posts = response.data[1];
      console.log(response.data);
    });
    console.log("before route update mounted.");
    next();
  },
  methods: {
    showmodel() {
      $("#profilemodel").modal("show");
    },
    hidemodel() {
      $("#profilemodel").modal("hide");
    }
  },
  mounted() {
    axios.get("./api/user/" + this.$route.params.id).then(response => {
      this.user = response.data[0];
      this.posts = response.data[1];
      console.log(response.data);
    });
    console.log("Component mounted.");
    this.visiteduser = this.$route.params.id;
    this.authid = $('meta[name="userid"]').attr("content");
  },
  computed: {
    username() {
      // We will see what `params` is shortly
      this.id = this.$route.params.id;
      return this.id;
    }
  }

  // watch: {
  //   mounted();
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
div.settingicon:hover {
  cursor: pointer;
}
div.modelcontent {
  border: 1px solid white;
  border-radius: 20px;
}
</style>