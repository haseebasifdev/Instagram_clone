<template>
  <div class="container mt-0">
    <div class="row">
      <div class="col-md-1 p-0"></div>
      <div class="col-md-10 p-0">
        <div class="row container">
          <div class="col-md-8 p-0 m-0">Lorem, ipsum dolor sit Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi amet voluptatibus quis, ad quasi quia aspernatur inventore quaerat repellendus error quibusdam eius, sed impedit autem alias dolorem vero maxime, accusamus fugiat perspiciatis delectus laboriosam repellat labore totam. Enim ipsum architecto aspernatur repellendus magnam ut facilis vitae officia. Molestiae non provident perspiciatis, sint officiis quia dignissimos ducimus at eum recusandae numquam illo corrupti nisi nostrum dolorum praesentium quidem nulla, repellat sunt, nesciunt veritatis minima. Aliquid adipisci fugit perferendis tenetur non maiores est atque soluta, qui officia repellendus corrupti optio, maxime a ipsum unde eos? Itaque esse accusamus voluptatem repellendus deserunt fuga? amet consectetur adipisicing elit. Animi ea nobis ut natus praesentium omnis eius. Velit atque doloribus necessitatibus voluptas ad maxime sapiente quam iusto numquam! Ipsam, similique aspernatur voluptatibus quod quae numquam architecto accusantium repudiandae eius assumenda recusandae dolores sapiente ad dolor, odio molestiae id nam. Voluptatum, repudiandae?</div>
          <div class="col-md-4 p-0 m-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Culpa sequi eos quam magnam ratione ipsam dicta natus, quaerat sapiente vero quibusdam possimus voluptas perferendis, amet distinctio. Saepe, ipsum dicta? Laboriosam delectus pariatur molestiae impedit eum similique ipsa voluptatem doloribus, accusantium aperiam illum totam, architecto neque tempore! Molestias eos molestiae voluptates!</div>
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
</style>