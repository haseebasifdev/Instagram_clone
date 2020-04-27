<template>
  <li class="nav-item position-relative">
    <a class="nav-link" href="#">
      <i class="far fa-heart fa-lg"></i>
    </a>
    <div class="position-absolute bg-danger rounded-circle text-white" style="width:10px;height:10px; left:20px;bottom:23px">{{unread.length}}</div>
  </li>
</template>

<script>
export default {
    props:['unread']
};
</script>
<style scoped>

</style>