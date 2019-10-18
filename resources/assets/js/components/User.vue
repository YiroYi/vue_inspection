<template>
  <div>

    <!-- Breadcrumb -->
    <div class="page-bar">
      <div class="page-title-breadcrumb">
          <div class=" pull-left">
              <div class="page-title">USER MANAGEMENT</div>
          </div>
          <ol class="breadcrumb page-breadcrumb pull-right">
              <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
              </li>
              <li class="active">User management</li>
          </ol>
      </div>
    </div>
<!-- start widget -->
<!-- start Payment Details -->
      <div class="card">

        <div class="card-header">
            <i class="fa fa-align-justify"></i> ADD USER
            <button type="button" class="btn btn-primary" @click="openModal('customer','register')">
                <i class="icon-plus"></i>&nbsp;NEW
            </button>
        </div>
         <div class="card-body">
           <div class="row">
               <div class="col-md-12 col-sm-12">
                   <div class="card  card-box">
                       <div class="card-body ">
                         <div class="table-wrap">
                         <div class="table-responsive">
                         <div class="card-body">
                             <div class="form-group row">
                                 <div class="col-md-6">
                                     <div class="input-group">
                                         <select class="form-control col-md-3" v-model="criteria">
                                           <option value="name">Name</option>
                                           <option value="rol">Role Type</option>
                                         </select>
                                         <input type="text" v-model="search" @keyup.enter="listCustomer(1,search,criteria)"class="form-control" placeholder="Search text...">
                                         <button type="submit" @click="listCustomer(1,search,criteria)" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                                     </div>
                                 </div>
                             </div>
                          </div>
                         <table class="table display product-overview mb-30" id="support_table5">
                          <thead>
                            <tr>
                              <th>First Name</th>
                              <th>Last Name</th>
                              <th>Phone</th>
                              <th>Country</th>
                              <th>User</th>
                              <th>Rol</th>
                              <th>Status</th>
                              <th>Edit / Desactivate</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="customer in arrayCustomer" :key="customer.id">
                              <td v-text="customer.name"></td>
                              <td v-text="customer.short_name"></td>
                              <td v-text="customer.phone"></td>
                              <td v-text="customer.country"></td>
                              <td v-text="customer.user"></td>
                              <td v-text="customer.rol"></td>
                              <td>
                                <div v-if="customer.status==1">
                                  <span class="label label-sm label-success">Valid</span>
                                </div><div v-else>
                                  <span class="label label-sm label-danger">Invalid</span>
                                </div>
                              </td>
                              <td>
                                <a title="Edit" class="btn btn-circle text-inverse label-warning" @click="openModal('customer','update',customer)"><i class="fa fa fa-magic"></i></a>
                                <template v-if="customer.status==1">
                                <a class="btn btn-circle  text-inverse label-danger" title="Delete" @click="desactivateUser(customer.id)"><i class="fa fa-trash"></i></a>
                                </template>
                                <template v-else>
                                <a class="btn btn-circle  text-inverse label-default" title="Delete" @click="activateUser(customer.id)"><i class="fa fa-refresh"></i></a>
                                </template>
                              </td>
                            </tr>
                          </tbody>
                         </table>
                         <nav>
                             <ul class="pagination">
                                 <li class="page-item" v-if="pagination.current_page>1">
                                     <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page - 1,search,criteria)">Prev</a>
                                 </li>
                                 <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' :'']" >
                                     <a class="page-link" href="#" @click.prevent="changePage(page,search,criteria)" v-text="page"></a>
                                 </li>
                                 <li class="page-item" v-if="pagination.current_page<pagination.last_page">
                                     <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page + 1,search,criteria)">Next</a>
                                 </li>
                             </ul>
                         </nav>
                         </div>
                         </div>
                       </div>
                   </div>
               </div>
           </div>

         </div>

      </div>
      <!--Inicio del modal agregar/actualizar-->
      <div class="modal fade" tabindex="-1" :class="{'showM' :modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-primary modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header bg-b-purple">
                      <h4 class="modal-title" v-text="modalTitle"></h4>
                      <button type="button" class="close" @click="closeModal()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">First Name<span class="required"> * </span></label>
                              <div class="col-md-9">
                                  <input type="text" v-model="name" class="form-control" placeholder="Input the first name of the user">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Last name</label>
                              <div class="col-md-9">
                                  <input type="text" v-model="short_name" class="form-control" placeholder="Input the last name of the user">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Phone<span class="required"> * </span></label>
                              <div class="col-md-9">
                                  <input type="text" v-model="phone" class="form-control" placeholder="User mobile phone">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Country</label>
                              <div class="col-md-9">
                                  <input type="text" v-model="country" class="form-control" placeholder="Input the country of the user">
                              </div>
                          </div>
                          <h3>User & Password</h3>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">E-mail<span class="required"> * </span></label>
                              <div class="col-md-9">
                                  <input type="text" v-model="user" class="form-control" placeholder="Your e-mail will be the the username for the account">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Password<span class="required"> * </span></label>
                              <div class="col-md-9">
                                  <input type="password" v-model="password" class="form-control" placeholder="Input account password">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Rol<span class="required"> * </span></label>
                              <div class="col-md-9">
                                <select class="form-control " v-model="idrol">
                                  <option value="0">Choose a role</option>
                                  <option v-for="rol in arrayRol" :key="rol.id" :value="rol.id" v-text="rol.name"></option>
                                </select>
                              </div>

                          </div>
                          <div class="form-group row div-error" v-show="errorCustomer">
                            <div class="text-center text-error">
                              <div class="" v-for="error in errorShowMessageCustomer" :key="error" v-text="error"></div>
                            </div>
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" @click="closeModal()">Close</button>
                      <button type="button" v-if="actionType==1"class="btn btn-primary" @click="registerCustomer()">Save</button>
                      <button type="button" v-if="actionType==2"class="btn btn-primary"@click="updateCustomer()">Update</button>
                  </div>
              </div>
              <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>
      <!--Fin del modal-->
  </div>
</template>

<script>
    export default {
        data(){//Estas variables son las que se ligan con los inputs
          return{
            customer_id:0,
            name:'',
            short_name:'',
            phone:'',
            country:'',
            user:'',
            password:'',
            status:'',
            idrol: 0,
            arrayCustomer:[],
            arrayRol:[],
            modal: 0,
            modalTitle :'',
            actionType:0,
            errorCustomer:0,
            errorShowMessageCustomer:[],
            pagination:{
              'total' : 0,
              'current_page': 0,
              'per_page': 0,
              'last_page' : 0,
              'from' : 0,
              'to': 0,
            },
            offset: 3,
            criteria: 'name',
            search: ''
          }
        },
        computed:{
          isActived: function(){
            return this.pagination.current_page;
          },
          pagesNumber: function(){
            if(!this.pagination.to){
              return[];
            }
            var from = this.pagination.current_page - this.offset;
            if(from <1){
              from=1;
            }
            var to = from + (this.offset * 2);
            if(to >= this.pagination.last_page){
              to=this.pagination.last_page;
            }

            var pagesArray =[];
            while(from<=to){
              pagesArray.push(from);
              from++;
            }
            return pagesArray;
          }
        },
        methods:{
          listCustomer(page,search,criteria){
            let me = this;
            var url= 'user?page=' + page + '&search=' + search + '&criteria=' + criteria;

            axios.get(url).then(function (response) {
                var respuesta=response.data;
                me.arrayCustomer = respuesta.customers.data;
                me.pagination = respuesta.pagination;
              })
              .catch(function (error) {
                console.log(error);
              })
              .then(function () {
              });
          },
          selectRol(){
            let me = this;
            var url= 'rol/selectRol';

            axios.get(url).then(function (response) {
                var respuesta=response.data;
                me.arrayRol = respuesta.rols;//lo que te regresa el metodo.

              })
              .catch(function (error) {
                console.log(error);
              })
              .then(function () {
              });
          },
          changePage(page,search,criteria){
            let me = this;
            me.pagination.current_page = page;
            me.listCustomer(page,search,criteria);
          },
          registerCustomer(){

            if(this.validateCustomer())
            {
              return;
            }

            let me=this;
            axios.post('user/store',{

              'name':this.name,
              'short_name':this.short_name,
              'phone':this.phone,
              'country':this.country,
              'user':this.user,
              'password':this.password,
              'idrol':this.idrol


              }).then(function (response) {
                me.closeModal();
                me.listCustomer(1,'','name');
              })
              .catch(function (error) {
                console.log(error);
              })
              .then(function () {
              });
          },
          updateCustomer(){

            if(this.validateCustomer())
            {
              return;
            }

            let me=this;
            axios.put('user/update',{

              'id': this.customer_id,
              'name':this.name,
              'short_name':this.short_name,
              'phone':this.phone,
              'country':this.country,
              'user':this.user,
              'password':this.password,
              'idrol':this.idrol

              }).then(function (response) {
                me.closeModal();
                me.listCustomer(1,'','name');
              })
              .catch(function (error) {
                console.log(error);
              });
          },
          desactivateUser(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
              })

              swalWithBootstrapButtons({
                title: 'Are you sure to desactivate this user?',
                text: "You can reactivate later!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, desactivate it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  let me=this;
                  axios.put('user/desactivate',{

                    'id': id

                    }).then(function (response) {
                      me.listCustomer(1,'','name');
                      swalWithBootstrapButtons(
                        'Desactivated!',
                        'Your user has been desactivated',
                        'success'
                      )
                    })
                    .catch(function (error) {
                      console.log(error);
                    });

                } else if (
                  // Read more about handling dismissals
                  result.dismiss === swal.DismissReason.cancel
                ) {
                  swalWithBootstrapButtons(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                  )
                }
              })
          },
          activateUser(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
              })

              swalWithBootstrapButtons({
                title: 'Are you sure to want to activate this user?',
                text: "You can deactivate later!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, activate it again!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  let me=this;
                  axios.put('user/activate',{

                    'id': id

                    }).then(function (response) {
                      me.listCustomer(1,'','name');
                      swalWithBootstrapButtons(
                        'activated!',
                        'Youruser has been activated',
                        'success'
                      )
                    })
                    .catch(function (error) {
                      console.log(error);
                    });

                } else if (
                  // Read more about handling dismissals
                  result.dismiss === swal.DismissReason.cancel
                ) {
                  swalWithBootstrapButtons(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                  )
                }
              })
          },
          validateCustomer(){
            this.errorCustomer=0;
            this.errorShowMessageCustomer=[];
            if(!this.name) this.errorShowMessageCustomer.push("Please input a user name,cannot be empty");
            if(!this.phone) this.errorShowMessageCustomer.push("Please input a phone number,cannot be empty");
            if(!this.user) this.errorShowMessageCustomer.push("Please input user name, should be your email country");
            if(!this.password) this.errorShowMessageCustomer.push("Password cannot be empty");
            if(this.idrol==0) this.errorShowMessageCustomer.push("Please choose a role");


            if(this.errorShowMessageCustomer.length) this.errorCustomer = 1;

            return this.errorCustomer;
          },
          closeModal(){
            this.modal = 0;
            this.modalTitle ='';
            this.name='';
            this.short_name='';
            this.phone='';
            this.country='';
            this.user='';
            this.password='';
            this.idrol=0;
            this.errorCustomer=0;
            this.errorShowMessageCustomer=[];
          },
          openModal(model,action,data=[]){
            this.selectRol();
              switch (model) {
                case "customer":
                {
                  switch (action) {
                    case 'register':
                      {
                        this.modal = 1;
                        this.modalTitle = 'Register new user';
                        this.actionType =1;
                        this.name='';
                        this.short_name='';
                        this.phone='';
                        this.country='';
                        this.user='';
                        this.password='';
                        this.idrol=0;
                        break;
                      }
                      case 'update':
                      {
                        this.modal = 1;
                        this.modalTitle = 'Update user';
                        this.actionType =2;
                        this.customer_id=data['id'];
                        this.name=data['name'];
                        this.short_name=data['short_name'];
                        this.phone=data['phone'];
                        this.country=data['country'];
                        this.user=data['user'];
                        this.password=data['password'];
                        this.idrol=data['idrol'];
                        break;
                      }
                  }
                }
              }
          }
        },
        mounted() {
            this.listCustomer(1,this.search,this.name);
        }
    }
</script>
<style>
  .modal-content
  {
    width: 100% !important;
    position: absolute !important;
  }
  .showM
  {
    display : list-item !important;
    opacity: 1 !important;
    position: absolute !important;
    background-color: #3c29297a !important;
  }
  .div-error
  {
    display: flex;
    justify-content: center;
  }
  .text-error{
    color: red !important;
    font-weight: bold;
  }
</style>
