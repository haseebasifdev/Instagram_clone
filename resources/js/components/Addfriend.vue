<template>
  <div class="container top mt-4">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 px-3">
        <div class="sidecard">
          <h6 class="ml-2">
            <b>Suggested</b>
          </h6>
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
          <div class="crd">
            <div v-for="user in users" class="card border">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div class=" d-flex">
                    <img :src="user.profile" class="rounded rounded-circle" width="8%" />
                    <div class=" ml-2 my-auto">
                      <router-link
                        :to="'/profiles/'+user.id"
                        class="font-weight-bold text-dark route"
                      >{{user.username}}</router-link>
                      <div>{{user.name}}</div>
                    </div>
                  </div>
                  <!-- <div class="friendlist my-auto"> -->
                  <button class="btn btn-primary btn-sm my-auto btnfollow">Follow</button>
                  <!-- </div> -->
                </div>
              </div>
            </div>
          </div>
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
  mounted() {
    this.id = $('meta[name="userid"]').attr("content");
    axios.get("./api/alluser/" + this.id).then(response => {
      this.users = response.data;
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