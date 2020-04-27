<template>
  <div class="container mt-0">
    <div class="row">
      <div class="col-md-1 p-0"></div>
      <div class="col-md-10 p-0">
        <div class="row container">
          <div class="col-md-7 p-0 m-0">
            <img :src="post.avatar" class width="100%" height="100%" alt srcset />
          </div>
          <div class="col-md-5 p-0 m-0 bg-white border">
            <div class="card-title font-weight-bold p-3 my-auto border-bottom">
              <img
                :src="user.profile"
                class="mr-2 rounded rounded-circle"
                width="10%"
                height="10%"
                alt
                srcset
              />
              {{user.name}}
            </div>
            <div class="border-bottom overflow-scroll" style="height:300px">
              <div v-for="cmnt in comments" class="my-2 ml-2">
                <img
                  :src="(finduser(cmnt.user_id)).profile"
                  class="rounded rounded-circle my-auto"
                  width="10%"
                  height="65%"
                />
                <span class="font-weight-bold mx-1">{{finduser(cmnt.user_id).name}}</span>
                <small>{{cmnt.body}}</small>
              </div>
            </div>
            <div class="ml-3 mt-3 bottom">
              <p class="card-text">
                <a class="iconcover" @click="likepost(post.id)">
                  <i :class="checklike()"></i>
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
              <p class="text-muted mt-1">{{post.created_at | mytime}}</p>
            </div>
            <div class="d-flex py-2 border-top">
              <input
                type="text"
                class="form-control border-0 hover"
                placeholder="Add a Comment..."
                v-model="comment"
                @keyup.enter="commentpost(post.id)"
              />
              <button
                v-if="comment"
                @click="commentpost(post.id)"
                class="btn text-primary font-weight-bold"
              >Post</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-1 p-0"></div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      id: "",
      user: [],
      profile: [],
      post: [],
      comments: [],
      commentsuser: [],
      comment: "",
      likes: ""
    };
  },
  methods: {
    commentpost(postid) {
       this.$Progress.start();
      this.id = $('meta[name="userid"]').attr("content");
      if (this.comment) {
        var data = {
          user_id: this.id,
          post_id: postid,
          body: this.comment
        };

        this.comments.push(data);
        this.commentsuser.push(this.user);
        this.comment = "";
        axios
          .post("./api/addcomment", data)
          .then(response => {
            console.log(response.data);
            this.post.comments = response.data;
            // this.comment[index] = "";
             this.$Progress.finish();
          })
          .catch(error => {
            // this.comment[index] = "";
            console.log(error.data);
             this.$Progress.fail();
          });
        // console.log(post, index);
      }
    },
    checklike() {
      for (let like of this.likes) {
        if (like.post_id == this.post.id) {
          // console.log("in Loop");
          console.log(like.post_id, this.post.id);
          return "fas fa-heart iconsize text-danger";
          break;
        }
      }
      return "far fa-heart iconsize";
    },
    finduser(id) {
      for (let user of this.commentsuser) {
        if (id == user.id) {
          return user;
          break;
        }
      }
    },
    route() {
      return "/profiles/" + this.id;
    },
    indexshow(postid, index) {
      this.id = $('meta[name="userid"]').attr("content");

      this.comment[index] = "";
      // console.log(post, index);
    },
    likepost(postid) {
      this.id = $('meta[name="userid"]').attr("content");
      var data = {
        user_id: this.id,
        post_id: postid
      };
       this.$Progress.start();
      axios
        .post("./api/addlike", data)
        .then(response => {
          this.post.likes = response.data[0];
          this.likes = response.data[1];
           this.$Progress.finish();
          // this.iconcolor[index] = response.data[1];
        })
        .catch(error => {
           this.$Progress.fail();
          console.log(error.data);
        });
    }
  },
  mounted() {
    this.$Progress.start();
    console.log(this.$route.params.id);
    axios
      .get("./api/post/" + this.$route.params.id)
      .then(response => {
        console.log(response.data);
        this.post = response.data[3];
        this.comments = response.data[0];
        this.user = response.data[1];
        this.likes = response.data[2];
        this.commentsuser = response.data[4];
        this.$Progress.finish();
      })
      .catch(error => {
        this.$Progress.fail();
        console.log(error.data);
      });
    console.log("mounted");
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
    // const auth = $('meta[name="userid"]').attr("content");
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
.iconsize {
  font-size: 1.5rem;
}
input:focus {
  box-shadow: none;
}
.iconcover:hover {
  cursor: pointer;
}
</style>