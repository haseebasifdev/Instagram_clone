<template>
  <div class="container">
    <div class="row">
      <div class="col-md-1 col-"></div>
      <div class="col-md-10 col-sm-12">
        <div class="row">
          <div class="col-md-8">
            <!-- Card start -->
            <h1 v-if="posts==0" class="text-danger">No Post Yet</h1>
            <div v-for="(post,index) in posts" :key="index" class="card mb-4">
              <div class="card-body">
                <div class="card-title font-weight-bold">
                  <img src="/images/download.jfif" class="mr-2" width="7%" height="7%" alt srcset />
                  Haseeb Asif
                </div>
                <hr />
                <img :src="post.avatar" class="my-3" width="100%" height="600px" alt srcset />

                <p class="card-text">
                  <button @click="likepost(post.id,index)" :class="'btn '+iconcolor[index]">
                    <i class="fas fa-heart fa-lg"></i>
                  </button>
                  <button class="btn text-primary">
                    <i class="fas fa-comment fa-lg"></i>
                  </button>
                  <button class="btn text-primary">
                    <i class="fas fa-location-arrow fa-lg"></i>
                  </button>
                </p>
                <p class="card-subtitle text-muted like">{{post.likes}} Likes</p>
                <router-link
                  :to="'/post/'+post.id"
                  class="card-subtitle text-muted comments mt-1"
                >{{post.comments}} Comment</router-link>
                <p class="text-muted mt-1">{{post.created_at | mytime}}</p>
                <hr />
                <div class="d-flex">
                  <img
                    src="/images/download.jfif"
                    class="mr-2 my-auto"
                    width="7%"
                    height="7%"
                    alt
                    srcset
                  />
                  <input
                    type="text"
                    class="form-control border-0"
                    placeholder="Add a Comment..."
                    v-model="comment[index]"
                    @keyup.enter="indexshow(post.id,index)"
                  />
                  <button
                    class="btn text-primary font-weight-bold"
                    @click="indexshow(post.id,index)"
                  >Post</button>
                </div>
                <!--  -->
              </div>
            </div>
            <!-- Card End -->
          </div>
          <div class="col-md-4 sidebar">
            <div class="d-flex">
              <img src="/images/download.jfif" class="rounded rounded-circle" width="20%" />
              <div class="ml-3 my-auto">
                <router-link
                  :to="route()"
                  class="font-weight-bold text-dark route"
                >{{user.username}}</router-link>

                <div class="text-muted">{{user.name}}</div>
              </div>
            </div>
            <div class="crd">
              <div class="d-flex justify-content-between">
                <h6 class="text-muted font-weight-bold">Suggesions For you</h6>
                <router-link to="/addfriends" class="route">See all</router-link>
              </div>
              <div class="card border sidecard">
                <div class="card-body">
                  <div class="d-flex">
                    <img src="/images/download.jfif" class="rounded rounded-circle" width="15%" />
                    <div class="ml-3 my-auto">
                      <router-link
                        :to="route()"
                        class="font-weight-bold text-dark route"
                      >{{user.username}}</router-link>

                      <div class="text-muted">{{user.name}}</div>
                    </div>
                    <div class="friendlist my-auto">
                      <router-link to="/">Follow</router-link>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-1 col-"></div>
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
      comment: [],
      iconcolor: []
    };
  },
  methods: {
    route() {
      return "/profiles/" + this.id;
    },
    indexshow(postid, index) {
      this.id = $('meta[name="userid"]').attr("content");
      var data = {
        user_id: this.id,
        post_id: postid,
        body: this.comment[index]
      };
      this.comment[index] = "";
      axios
        .post("./api/addcomment", data)
        .then(response => {
          console.log(response.data);
          this.posts[index].comments = response.data;
          // this.comment[index] = "";
        })
        .catch(error => {
          // this.comment[index] = "";
          console.log(error.data);
        });
      // console.log(post, index);
    },
    likepost(postid, index) {
      this.id = $('meta[name="userid"]').attr("content");
      var data = {
        user_id: this.id,
        post_id: postid
      };
      axios
        .post("./api/addlike", data)
        .then(response => {
          this.posts[index].likes = response.data[0];
          this.iconcolor[index] = response.data[1];
        })
        .catch(error => {
          console.log(error.data);
        });
    }
  },
  mounted() {
    this.id = $('meta[name="userid"]').attr("content");
    axios.get("./api/user/" + this.id).then(response => {
      this.user = response.data[0];
      console.log(response.data);
    });
    axios.get("./api/allpost/").then(response => {
      this.posts = response.data;
      console.log(response.data);
    });
  },
  computed: {
    username() {
      // We will see what `params` is shortly
      this.id = this.$route.params.id;
      // this.timenow = moment(posts.created_at);
      return this.id;
    }
  },
  created() {
    const auth = $('meta[name="userid"]').attr("content");
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
div.container {
  margin-top: 2%;
}
.route:hover {
  text-decoration: none;
}
.crd {
  margin-top: 6%;
}
.sidecard {
  max-width: 100%;
  max-height: 450px;
  overflow-y: auto;
}
.friendlist {
  margin-left: 25%;
  /* float: right; */
}
.like,
.comments {
  font-size: 12px;
}
p.comments:hover {
  cursor: pointer;
}
</style>