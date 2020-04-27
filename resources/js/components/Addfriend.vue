<template>
  <div class="container top mt-4">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 px-3">
        <div class="sidecard">
          <div class="text-muted" style="margin-left:9%;">
            <b>Suggested</b>
          </div>
          <!-- <div class="card border">
            <div class="card-body">
              <div v-for="user in users" class="d-flex mb-2 justify-content-between">
                <img :src="user.profile" class="rounded rounded-circle" width="6%" />
                <div class="ml-3 my-auto">
                  <router-link
                    :to="'/profiles/'+user.id"
                    class="font-weight-bold text-dark route"
                  >{{user.username}}</router-link>
                  {{user.name}}
                </div>
                <button @click class="btn btn-primary btn-sm font-weight-bold">Follow</button>
              </div>
            </div>
          </div>-->
          <!-- <div class="crd"> -->
          <div class="card container border-0 my-1">
            <div v-for="(user,index) in users" class="py-2">
              <div class="d-flex justify-content-between">
                <div class="d-flex">
                  <img :src="user.profile" class="rounded rounded-circle" width="6%" height="90%" />
                  <div class="ml-2 my-auto">
                    <router-link
                      :to="'/profiles/'+user.id"
                      class="font-weight-bold text-dark route"
                    >{{user.username}}</router-link>
                    <div>{{user.name}}</div>
                  </div>
                </div>
                <!-- <div class="friendlist my-auto"> -->
                <button
                  class="btn btn-primary btn-sm my-auto btnfollow"
                  @click="following(user.id,index)"
                >Follow</button>
                <!-- </div> -->
              </div>
            </div>
          </div>
          <!-- </div> -->
        </div>
      </div>
      <div class="col-md-2"></div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      id: "",
      users: []
    };
  },
  methods: {
    following(following, index) {
      var data = {
        followerid: $('meta[name="userid"]').attr("content"),
        userid: following
      };
      this.$Progress.start();
      axios
        .post("./api/follow", data)
        .then(response => {
          console.log(response.data);
          this.users.splice(index, 1);
          this.$Progress.finish();
          Toast.fire({
            icon: "success",
            title: "Follow Successfully"
          });
        })
        .catch(error => {
          this.$Progress.fail();
          Toast.fire({
            icon: "error",
            title: "Something went wrong please try again"
          });
        });
    }
  },
  mounted() {
    this.$Progress.start();
    this.id = $('meta[name="userid"]').attr("content");
    axios.get("./api/notfollwer/" + this.id).then(response => {
      this.users = response.data;
      console.log(response.data);
      this.$Progress.finish();
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
  margin-top: 8%;
}
div.card {
  margin-left: 7.5%;
  width: 82.6%;
}
</style>