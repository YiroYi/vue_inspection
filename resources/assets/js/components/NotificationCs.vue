<template>
  <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
      <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
          <i class="fa fa-pencil"></i>
          <span class="badge badge-danger">
            {{notificationscs[0] ?
              notificationscs[0]['data']['datos']['reportesccia']['numero'] +
              notificationscs[0]['data']['datos']['reportesqci']['numero'] +
              notificationscs[0]['data']['datos']['reportessfa']['numero']  : '...'}}

          </span>
       </a>
      <ul class="dropdown-menu animated swing">
          <li class="external">
              <h3><span class="bold">REPORTS TO BE PERFORMED</span></h3>
          </li>
          <li>
              <ul class="dropdown-menu-list small-slimscroll-style" style="height:91px;" data-handle-color="#637283">
                <div v-if="notificationscs.length">
                  <li v-for="item in listarCs" :key="item.id">
                      <a class="dropdown-item">
                          New {{item.reportesccia.msj}}</span>'s to be reviewed. <span class="badge badge-success">{{item.reportesccia.numero}}</span>
                      </a>
                      <a class="dropdown-item">
                          New {{item.reportesqci.msj}}</span>'s to be reviewed. <span class="badge badge-success">{{item.reportesqci.numero}}</span>
                      </a>
                      <a class="dropdown-item">
                          New {{item.reportessfa.msj}}</span>'s to be reviewed. <span class="badge badge-success">{{item.reportessfa.numero}}</span>
                      </a>
                  </li>
                </div>
                <div v-else>
                  <a><span>No pending work</span></a>
                </div>
              </ul>
          </li>
      </ul>
  </li>
</template>
<script>
  export default {
  props : ['notificationscs'],
  data(){
    return {
      arrayNotificationsCs:[],
      noti:0,
    }
  },
  computed: {

    listarCs: function(){
      this.arrayNotificationsCs =Object.values(this.notificationscs[0]);

      if (this.notificationscs == '') {
        return this.arrayNotificationsCs = [];
      }else{
        this.arrayNotificationsCs = Object.values(this.notificationscs[0]);
        if(this.arrayNotificationsCs.length > 3){

          return Object.values(this.arrayNotificationsCs[4]);

        }else{
          return Object.values(this.arrayNotificationsCs[0]);
        }
      }
    }
  }
}
</script>
