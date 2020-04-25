<template>
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-1"></div>

      <div class="col-md-3 border bg-white">Hello</div>
      <div class="col-md-7 border border-left-0 p-4 bg-white">
        <div class="d-flex ml-4 m-4">
          <img
            src="/images/download.jfif"
            class="rounded rounded-circle prflimg"
            width="7%"
            height="7%"
          />
          <div class="my-auto username d-block">
            <h4>{{user.username}}</h4>
            <div class="text-muted">{{user.name}}</div>
          </div>
        </div>
        <button class="profilebtn">Change Profile Photo</button>

        <form>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
              <input
                type="text"
                class="form-control"
                id="inputPassword"
                v-model="user.name"
                placeholder="Name"
              />
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
              <input
                type="text"
                v-model="user.username"
                class="form-control"
                id="inputPassword"
                placeholder="Username"
              />
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Bio</label>
            <div class="col-sm-10">
              <textarea
                type="text"
                v-model="user.bio"
                class="form-control"
                id="inputPassword"
                placeholder="Write..."
              ></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input
                type="email"
                v-model="user.email"
                class="form-control"
                id="inputPassword"
                placeholder="Email"
              />
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Gender</label>
            <div class="col-sm-10">
              <select v-model="user.gender" class="form-control" id="exampleFormControlSelect1">
                <option>Male</option>
                <option>Female</option>
                <option>Not Know</option>
              </select>
            </div>
          </div>
          <div class="form-group row mt-3">
            <label class="col-sm-2"></label>
            <div class="col-sm-10">
              <button
                type="submit"
                @click.prevent="update(user.id)"
                class="btn btn-primary btn-sm"
              >Submit</button>
            </div>
          </div>
        </form>
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
      user: {},
      name: "Haseeb asif"
    };
  },
  methods: {
    update(id) {
      var data = {
        name: this.user.name,
        username: this.user.username,
        bio: this.user.bio,
        email: this.user.email,
        gender: this.user.gender
      };
      // axios.post("./api/updateprofile" + this.user.id);
      console.log("Updated");
    }
  },
  mounted() {
    this.id = $('meta[name="userid"]').attr("content");
    axios.get("./api/user/" + this.$route.params.id).then(response => {
      this.user = response.data;
      console.log(response.data);
    });
    console.log("Component mounted.");
  }
};
</script>
<style scoped>
div.username {
  margin-left: 4%;
}
div.bio {
  font-size: 18px;
}
.prflimg {
  margin-left: 3%;
}
.profilebtn {
  border: none;
  background: none;
  color: rgb(0, 162, 255);
  font-weight: bold;
  margin-left: 16%;
  margin-bottom: 3%;
}
</style>