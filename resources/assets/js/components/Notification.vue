<template>
  <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
      <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
          <i class="fa fa-search"></i>
          <span class="badge badge-info">
            {{notifications[0] ?
              notifications[0]['data']['datos']['services']['numero'] +
              notifications[0]['data']['datos']['servicesqci']['numero'] +
              notifications[0]['data']['datos']['servicessfa']['numero']  : '...'}}
          </span>
       </a>
      <ul class="dropdown-menu animated swing">
          <li class="external">
              <h3><span class="bold">MATERIALS TO BE REVIEWED</span></h3>
          </li>
          <li>
              <ul class="dropdown-menu-list small-slimscroll-style" style="height:91px;" data-handle-color="#637283">
                <div v-if="notifications.length">
                  <li v-for="item in listar" :key="item.id">
                      <a class="dropdown-item">
                          New {{item.services.msj}}</span>'s to be reviewed. <span class="badge badge-success">{{item.services.numero}}</span>
                      </a>
                      <a class="dropdown-item">
                          New {{item.servicesqci.msj}}</span>'s to be reviewed. <span class="badge badge-success">{{item.servicesqci.numero}}</span>
                      </a>
                      <a class="dropdown-item">
                          New {{item.servicessfa.msj}}</span>'s to be reviewed. <span class="badge badge-success">{{item.servicessfa.numero}}</span>
                      </a>
                  </li>
                </div>
                <div v-else>
                  <a><span>No pending workx</span></a>
                </div>
              </ul>
          </li>
      </ul>
  </li>
</template>
<script>
  export default {
  props : ['notifications'],
  data(){
    return {
      arrayNotifications:[],
      noti:0,
    }
  },
  computed: {
    listar: function(){

      this.arrayNotifications =Object.values(this.notifications[0]);

      if (this.notifications == '') {
        return this.arrayNotifications = [];
      }else{
        this.arrayNotifications = Object.values(this.notifications[0]);
        if(this.arrayNotifications.length > 3){

          return Object.values(this.arrayNotifications[4]);

        }else{
          return Object.values(this.arrayNotifications[0]);
        }
      }
    }
  }
}
</script>
