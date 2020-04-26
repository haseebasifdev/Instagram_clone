<template>
  <div class="container">
    <div class="row">
      <div class="col-md-1 col-"></div>
      <div class="col-md-10 col-sm-12">
        <div class="row">
          <div class="col-md-8">
            <h6 v-if="posts==0" class="text-danger text-center">No Post Yet</h6>
            <div v-for="(post,index) in posts" :key="index" class="bg-white border mb-4">
              <div class="borderpost" style>
                <div class="card-title font-weight-bold p-3 my-auto">
                  <img
                    :src="user.profile"
                    class="mr-2 rounded rounded-circle"
                    width="5%"
                    height="5%"
                    alt
                    srcset
                  />
                  {{user.name}}
                </div>
                <!-- Post Image -->
                <img :src="post.avatar" class width="100%" height="600px" alt srcset />
                <!-- Post likes and comments -->
                <div class="ml-3 mt-3">
                  <p class="card-text">
                    <a
                      class="iconcover"
                      @click="likepost(post.id,index)"
                      :class="' '+iconcolor[index]"
                    >
                      <i class="far fa-heart iconsize"></i>
                    </a>
                    <a class="text-dark iconcover">
                      <i class="far fa-comment iconsize mx-2"></i>
                    </a>
                    <a class="text-primary iconcover">
                      <i class="fas fa-location-arrow iconsize"></i>
                    </a>
                  </p>
                  <p
                    v-if="post.likes>0"
                    class="card-subtitle text-dark like font-weight-bold"
                  >{{post.likes}} Likes</p>
                  <router-link
                    v-if="post.comments>0"
                    :to="'/post/'+post.id"
                    class="card-subtitle text-muted comments mt-1"
                  >{{post.comments}} Comment</router-link>
                  <p class="text-muted mt-1">{{post.created_at | mytime}}</p>
                </div>
                <div class="d-flex py-2 border-top">
                  <input
                    type="text"
                    class="form-control border-0 hover"
                    placeholder="Add a Comment..."
                    v-model="comment[index]"
                    @keyup.enter="commentpost(post.id,index)"
                  />
                  <button
                    v-if="comment[index]"
                    class="btn text-primary font-weight-bold"
                    @click="commentpost(post.id,index)"
                  >Post</button>
                </div>
              </div>
            </div>
            <!-- <div class="card" v-for="(post,index) in posts" :key="index" style="width: 100%;">
              <img class="card-img-top" src="/images/download.jfif" alt="Card image cap" />
              <div class="">
                <p
                  class=""
                >Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>-->
            <!-- Card End -->
          </div>
          <div class="col-md-4 sidebar">
            <div class="d-flex">
              <img :src="user.profile" class="rounded rounded-circle" width="20%" />
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
                <h6
                  class="text-muted font-weight-bold my-auto"
                  style="font-size:0.8rem"
                >Suggesions For you</h6>
                <router-link to="/addfriends" class="route my-auto">See all</router-link>
              </div>
              <div v-for="notflw in notfollower" class="card border sidecard">
                <div class="card-body">
                  <div class="d-flex justify-content-between">
                    <img :src="notflw.profile" class="rounded rounded-circle" width="15%" />
                    <div class="ml-3 my-auto">
                      <router-link
                        :to="'/profiles/'+notflw.id"
                        class="font-weight-bold text-dark route"
                      >{{notflw.username}}</router-link>
                      {{notflw.name}}
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
      iconcolor: [],
      notfollower: []
    };
  },
  methods: {
    route() {
      return "/profiles/" + this.id;
    },
    commentpost(postid, index) {
      this.id = $('meta[name="userid"]').attr("content");
      if (this.comment[index]) {
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
      }
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
      this.posts = response.data[1];
      this.notfollower = response.data[2];
      console.log(response.data);
    });
    // axios.get("./api/allpost/").then(response => {
    //   this.posts = response.data;
    //   console.log(response.data);
    // });
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
  margin-left: 5%;
  /* float: right; */
}
.like,
.comments {
  font-size: 12px;
}
p.comments:hover {
  cursor: pointer;
}
.iconsize {
  font-size: 1.5rem;
}
.iconcover:hover {
  cursor: pointer;
}
input:focus {
  box-shadow: none;
}
.borderpost {
  border: 0.0001em solid gainsboro;
}
</style>