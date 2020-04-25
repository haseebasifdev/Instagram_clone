<template>
  <div class="container top mt-4">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 px-3">
        <div class="sidecard">
          <h6 class="ml-2">
            <b>Suggested</b>
          </h6>
          <div class="card border">
            <div class="card-body">
              <div class="d-flex">
                <img src="/images/download.jfif" class="rounded rounded-circle" width="6%" />
                <div class="ml-3 my-auto">
                  <router-link to="/" class="font-weight-bold text-dark route">{{user.username}}</router-link>

                  <div class="text-muted">{{user.name}}</div>
                </div>
                <div class="friendlist my-auto">
                  <button class="btn btn-primary btn-sm font-weight-bold">Follow</button>
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
      user: []
    };
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