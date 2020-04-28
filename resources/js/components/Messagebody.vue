<template>
  <div class="position-relative">
    <div class="border-left">
      <div class="border-0">
        <div class="card-header">
          <img :src="frienduser.profile" class="rounded rounded-circle mr-1" width="2%" alt srcset />
          <span>{{frienduser.username}}</span>
        </div>
        <div class="bg-white overflow-scroll overflow-auto" style="height:290px">
          <div v-if="messages.length==0" class="text-center mt-4 font-weight-bold">
            <h5>No Chat yet</h5>
          </div>
          <ul v-for="msg in messages" class="d-block list-group">
            <li
              class="user list-group-item p-3 mb-1 float-right d-block text-center"
              v-if="msg.from==userid"
            >{{msg.message}}</li>
            <li
              class="friend list-group-item p-3 mb-1 bg-primary text-white float-left d-block text-center"
              v-else
            >{{msg.message}}</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="form-group position-absolute" style="bottom:-19%;left:5%;">
      <input
        type="email"
        class="mx-auto form-control"
        id="exampleInputEmail1"
        aria-describedby="emailHelp"
        placeholder="Message..."
        style="width:350%"
        v-model="message"
        @keyup.enter="savemessage()"
      />
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      friends: "",
      userid: "",
      friendid: "",
      messages: "",
      frienduser: "",
      message: ""
    };
  },
  methods: {
    savemessage() {
      this.$Progress.start();
      if (this.message) {
        var data = {
          from: $('meta[name="userid"]').attr("content"),
          to: this.frienduser.id,
          message: this.message
        };
        this.message = "";
        axios
          .post("./api/savemessage", data)
          .then(response => {
            this.messages.push(data);
            this.$Progress.finish();
          })
          .catch(error => {
            this.$Progress.fail();
          });
      }
    }
  },
  mounted() {
    // alert($('meta[name="userid"]').attr("content"));
    this.$Progress.start();
    this.friendid = this.$route.params.id;
    this.userid = $('meta[name="userid"]').attr("content");

    var data = {
      userid: $('meta[name="userid"]').attr("content"),
      friendid: this.$route.params.id
    };
    axios
      .post("./api/allmessages/" + this.$route.params.id, data)
      .then(response => {
        this.messages = response.data[0];
        this.frienduser = response.data[1];

        this.$Progress.finish();
      })
      .catch(error => {
        this.$Progress.fail();
      });
  },
  created() {
    const to = this.$route.params.id;
    const from = $('meta[name="userid"]').attr("content");
    Echo.private("chat." + from + "." + to).listen("Chat", e => {
      console.log(e);
      this.messages.push(e.message);
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
}
input.form-control:hover {
  box-shadow: none;
}
input.form-control:focus {
  box-shadow: none;
}
input.form-control {
  border-radius: 20px;
  box-shadow: none;
}
.user,
.friend {
  width: 70%;
  border-radius: 20px;
}
</style>