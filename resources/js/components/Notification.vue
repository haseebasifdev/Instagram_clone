<template>
  <li class="nav-item position-relative">
    <a class="nav-link" href="#">
      <i class="far fa-heart fa-lg"></i>
    </a>
    <div
      v-if="unread.length>0"
      class="position-absolute bg-danger rounded-circle text-white text-center justify-content-center align-items-center"
      style="width:15px;height:15px; left:20px;bottom:23px;font-size:10px"
    >{{unread.length}}</div>
  </li>
</template>

<script>
export default {
  props: ["unread", "userId"],
  mounted() {
    console.log("notification mounted");
    Echo.private("App.User." + this.userId).notification(notification => {
      console.log(notification);
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
</style>