<template>
  <div class="container">
    <div class="row">
      <div class="col-md-1 col-"></div>
      <div class="col-md-10 col-sm-12">
        <div class="row bg-white">
          <div
            class="col-md-8"
          >Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga, iste. Iusto laboriosam voluptate ipsam, minus explicabo suscipit delectus repellendus odit ut repellat, perferendis illum! Delectus perspiciatis ratione quisquam repellat vitae?</div>
          <div
            class="col-md-4 bg-white"
          >Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit placeat obcaecati quidem provident voluptates ratione, cum necessitatibus, architecto culpa asperiores perspiciatis dolorum quo dicta. Illo cumque cum id accusantium corporis?</div>
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
      profile: [],
      post: [],
      comments: [],
      likes: ""
    };
  },
  methods: {
    route() {
      return "/profiles/" + this.id;
    },
    indexshow(postid, index) {
      this.id = $('meta[name="userid"]').attr("content");

      this.comment[index] = "";
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
    console.log(this.$route.params.id);
    axios
      .get("./api/post/" + this.$route.params.id)
      .then(response => {
        console.log(response.data);
        this.comments = response.data[0];
        this.user = response.data[1];
        this.profile = response.data[2];
        this.likes = response.data[3];
      })
      .catch(error => {
        console.log(error.data);
      });
      console.log('mounted');
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
</style>