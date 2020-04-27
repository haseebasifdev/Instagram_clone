<template>
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-1"></div>

      <div class="col-md-3 border bg-white">Hello</div>
      <div class="col-md-7 border border-left-0 p-4 bg-white">
        <div class="d-flex ml-4 m-4">
          <img :src="user.profile" class="rounded rounded-circle prflimg" width="7%" height="7%" />
          <div class="my-auto username d-block">
            <h4>{{user.username}}</h4>
            <div class="text-muted">{{user.name}}</div>
          </div>
        </div>
        <button @click="showmodel()" class="profilebtn">Change Profile Photo</button>

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
    <!-- Button trigger modal -->
    <!-- <button
      type="button"
      class="btn btn-primary"
      data-toggle="modal"
      data-target="#exampleModalCenter"
    >Launch demo modal</button>-->

    <!-- Modal -->
    <div
      class="modal fade"
      id="profilemodel"
      tabindex="-1"
      role="dialog"
      aria-labelledby="profilemodelTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="custom-file">
              <input type="file" v-on:change="onFileChange" class="custom-file-input" required />

              <label class="custom-file-label" for="validatedCustomFile">Choose Image to Post...</label>
            </div>
          </div>
          <img :src="picture" width="50%" class="mx-auto" alt srcset />
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button @click="updateprofile()" type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      id: "",
      user: {},
      picture: ""
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
      axios
        .post("./api/updateprofile/" + this.user.id, data)
        .then(response => {
          console.log("updated");
          Toast.fire({
            icon: "success",
            title: "Updated successfully"
          });
        })
        .catch(error => {
          Toast.fire({
            icon: "error",
            title: "Eroor Occure in Updated Try Again"
          });
          console.log(error.data);
        });
      console.log("Updated");
    },
    onFileChange(e) {
      var fileReader = new FileReader();
      fileReader.readAsDataURL(e.target.files[0]);
      fileReader.onload = e => {
        this.picture = e.target.result;
      };
    },
    showmodel() {
      $("#profilemodel").modal("show");
    },
    updateprofile() {
      // this.id = $('meta[name="userid"]').attr("content");
      let data = {
        profile: this.picture
      };
      axios
        .post("./api/updatedprofilepicture/" + this.user.id, data)
        .then(response => {
          this.user.profile = this.picture;
          $("#profilemodel").modal("hide");
          // if (response.status === 422) {
          //   this.errorInputs = res.body;
          // } else {
          //   alert("Unkown error!");
          // }

          // this.$router.push("/");
          Toast.fire({
            icon: "success",
            title: "Profie Updated successfully"
          });
          console.log(response);
        })
        .catch(error => {
          // this.errorInputs = error.response.data.errors;

          Toast.fire({
            icon: "error",
            title: "Something went wrong please try again"
          });
          // console.log(error.response.data.errors);
        });
    }
  },
  mounted() {
    this.$Progress.start();
    this.id = $('meta[name="userid"]').attr("content");
    axios
      .get("./api/user/" + this.$route.params.id)
      .then(response => {
        this.user = response.data[0];
        console.log(response.data);
        this.$Progress.finish();
      })
      .catch(error => {
        this.$Progress.fail();
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