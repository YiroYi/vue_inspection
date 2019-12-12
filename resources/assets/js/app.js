
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.$ = window.jQuery = require('jquery');
window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '12px'
})

Vue.component('category', require('./components/Category.vue'));
Vue.component('customer', require('./components/Customer.vue'));
Vue.component('supplier', require('./components/Supplier.vue'));
Vue.component('rol', require('./components/Rol.vue'));
Vue.component('user', require('./components/User.vue'));
Vue.component('forwarder', require('./components/Forwarder.vue'));
Vue.component('billingcompany', require('./components/Company.vue'));
Vue.component('istatus', require('./components/Istatus.vue'));
Vue.component('service', require('./components/Service.vue'));
Vue.component('servicenew', require('./components/ServiceNew.vue'));
Vue.component('servicefollowup', require('./components/ServiceFollowUp.vue'));
Vue.component('cost', require('./components/Cost.vue'));
Vue.component('arrange', require('./components/InspectionArrange.vue'));
Vue.component('inspector', require('./components/Inspector.vue'));
Vue.component('assigned', require('./components/InspectorAssigned.vue'));
Vue.component('preaction', require('./components/Preaction.vue'));
Vue.component('action', require('./components/ActionInsp.vue'));
Vue.component('monitor', require('./components/Monitor.vue'));
Vue.component('score', require('./components/Score.vue'));
Vue.component('scoreqci', require('./components/ScoreQci.vue'));
Vue.component('scoresfa', require('./components/ScoreSfa.vue'));
Vue.component('prescore', require('./components/PreScore.vue'));
Vue.component('prescoreqci', require('./components/PreScoreQci.vue'));
Vue.component('prescoresfa', require('./components/PreScoreSfa.vue'));
Vue.component('reporting', require('./components/Reporting.vue'));
Vue.component('reportingqci', require('./components/ReportingQci.vue'));
Vue.component('reportingsfa', require('./components/ReportingSfa.vue'));
Vue.component('complete', require('./components/CompleteInspection.vue'));
Vue.component('cancel', require('./components/ServiceCancel.vue'));
Vue.component('invoice', require('./components/Invoice.vue'));
Vue.component('notification', require('./components/Notification.vue'));
Vue.component('notification-cs', require('./components/NotificationCs.vue'));
Vue.component('notification-csch', require('./components/NotificationCsCh.vue'));
Vue.component('notification-foll', require('./components/NotificationFollowup.vue'));


const app = new Vue({
    el: '#app',
    data: {
      menu : 0,
      notifications: [],
      notificationscs: [],
      notificationscsch: [],
      notificationsfoll: [],

    },
    created() {
      let me = this;


      axios.post('notification/getAdmin').then(function(response){
        me.notifications=response.data;
        axios.post('notification/getCs').then(function(response){
          me.notificationscs=response.data;
          axios.post('notification/getCsCh').then(function(response){
            me.notificationscsch=response.data;
            axios.post('notification/getNotFoll').then(function(response){
              me.notificationsfoll=response.data;
            })
          })
        })
      }).catch(function(error){
        console.log(error);
      });

      var userId = $('meta[name="userId"]').attr('content');

      Echo.private('App.User.' + userId).notification((notification)=>{
        me.notifications.unshift(notification);
      });

      var userId = $('meta[name="userId"]').attr('content');

      Echo.private('App.User.' + userId).notification((notification)=>{
        me.notificationscs.unshift(notification);
      });

      var userId = $('meta[name="userId"]').attr('content');

      Echo.private('App.User.' + userId).notification((notification)=>{
        me.notificationscsch.unshift(notification);
      });

      var userId = $('meta[name="userId"]').attr('content');

      Echo.private('App.User.' + userId).notification((notification)=>{
        me.notificationsfoll.unshift(notification);
      });

    }
});
