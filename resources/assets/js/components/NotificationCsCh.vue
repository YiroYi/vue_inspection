<template>
  <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
      <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
          <i class="fa fa-user-circle"></i>
          <span class="badge badge-success">
            {{notificationscsch[0] ?
              notificationscsch[0]['data']['datos']['newcci']['numero'] +
              notificationscsch[0]['data']['datos']['newqci']['numero'] +
              notificationscsch[0]['data']['datos']['newsfa']['numero'] : '...'}}

          </span>
       </a>
      <ul class="dropdown-menu animated swing">
          <li class="external">
              <h3><span class="bold">NEW SERVICES</span></h3>
          </li>
          <li>
              <ul class="dropdown-menu-list small-slimscroll-style" style="height:91px;" data-handle-color="#637283">
                <div v-if="notificationscsch.length">
                  <li v-for="item in listarCs" :key="item.id">
                      <a class="dropdown-item">
                          New {{item.newcci.msj}}</span>'s were submitted. <span class="badge badge-success">{{item.newcci.numero}}</span>
                      </a>
                      <a class="dropdown-item">
                          New {{item.newqci.msj}}</span>'s were submitted. <span class="badge badge-success">{{item.newqci.numero}}</span>
                      </a>
                      <a class="dropdown-item">
                          New {{item.newsfa.msj}}</span>'s were submitted. <span class="badge badge-success">{{item.newsfa.numero}}</span>
                      </a>
                  </li>
                </div>
                <div v-else>
                  <a><span>No pending work</span></a>
                </div>
              </ul>
          </li>
          <li>
            <notification-foll :notificationsfoll="notificationsfoll"></notification-foll>

          </li>
      </ul>
  </li>
</template>
<script>
  export default {
  props : ['notificationscsch','notificationsfoll'],
  data(){
    return {
      arrayNotificationsCsCh:[],
      noti:0,
    }
  },
  computed: {

    listarCs: function(){
      this.arrayNotificationsCsCh =Object.values(this.notificationscsch[0]);

      if (this.notificationscsch == '') {
        return this.arrayNotificationsCsCh = [];
      }else{
        this.arrayNotificationsCsCh = Object.values(this.notificationscsch[0]);
        if(this.arrayNotificationsCsCh.length > 3){

          return Object.values(this.arrayNotificationsCsCh[4]);

        }else{
          return Object.values(this.arrayNotificationsCsCh[0]);
        }
      }
    }
  }
}
</script>
