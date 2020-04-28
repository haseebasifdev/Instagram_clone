<template>
  <div class="container mt-4 border">
    <div class="row">
      <div class="col-md-4 p-0 m-0">
        <div class="card sidecard border-0">
          <div class="card-header text-center">Direct</div>
          <div class="sidecard">
            <div class="card-text py-1 mr-3" v-for="friend in friends">
              <router-link :to="'/direct/to/'+friend.id" class="ml-2 route">
                <img
                  :src="friend.profile"
                  class="rounded rounded-circle mr-2"
                  width="15%"
                  alt
                  srcset
                />
                <span>{{friend.username}}</span>
              </router-link>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8 p-0 m-0">
        <router-view :key="$route.path"></router-view>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["unread", "userid"],
  data() {
    return {
      friends: ""
    };
  },
  mounted() {
    axios.get("./api/allfriends").then(response => {
      this.friends = response.data;
    });
  }
};
// mounted()
// {
//     // Echo.private('App.User.' + userId)
//     // .notification((notification) => {
//     //     console.log(notification.type);
//     // });
// }
</script>
<style scoped>
.sidecard {
  height: 100%;
  max-width: 100%;
  max-height: 100%;
  overflow-y: auto;
}
div.card-text:hover {
  background-color: rgb(248, 248, 248);
}
.route {
  display: block;
}
.route:hover {
  text-decoration: none;
}
</style>