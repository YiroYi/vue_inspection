<template>
    <ul class="dropdown-menu-list small-slimscroll-style" style="height:40px;" data-handle-color="#637283">
                <div v-if="notificationsfoll.length">
                  <li v-for="item in listarFoll" :key="item.id">
                      <a class="dropdown-item">
                        {{item.oldfollow.msj}}</span> has not follow up recently. <span class="badge badge-warning">{{item.oldfollow.numero}}</span>
                      </a>
                  </li>
                </div>
                <div v-else>
                  <a><span>No pending work</span></a>
                </div>
            </ul>
</template>
<script>
  export default {
  props : ['notificationsfoll'],
  data(){
    return {
      arrayNotificationsFoll:[],
      noti:0,
    }
  },
  computed: {

    listarFoll: function(){
      this.arrayNotificationsFoll =Object.values(this.notificationsfoll[0]);

      if (this.notificationsfoll == '') {
        return this.arrayNotificationsFoll = [];
      }else{
        this.arrayNotificationsFoll = Object.values(this.notificationsfoll[0]);
        if(this.arrayNotificationsFoll.length > 3){

          return Object.values(this.arrayNotificationsFoll[4]);

        }else{
          return Object.values(this.arrayNotificationsFoll[0]);
        }
      }
    }
  }
}
</script>
