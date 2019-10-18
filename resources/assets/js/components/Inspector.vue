<template>
  <div>

    <!-- Breadcrumb -->
    <div class="page-bar">
      <div class="page-title-breadcrumb">
          <div class=" pull-left">
              <div class="page-title">INSPECTORS MANAGEMENT</div>
          </div>
          <ol class="breadcrumb page-breadcrumb pull-right">
              <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
              </li>
              <li class="active">Inspectors Management</li>
          </ol>
      </div>
    </div>
<!-- start widget -->
<!-- start Payment Details -->
      <div class="card">

        <div class="card-header">
            <i class="fa fa-align-justify"></i> ADD INSPECTOR
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
                                           <option value="cn_name">Chinese Name</option>
                                           <option value="province">Province</option>
                                           <option value="city">City</option>
                                           <option value="status">Status</option>
                                           <option value="score">Score</option>
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
                              <th>Name</th>
                              <th>Chinese name</th>
                              <th>User</th>
                              <th>Phone</th>
                              <th>Province</th>
                              <th>City</th>
                              <th>Score</th>
                              <th>Status</th>
                              <th>Edit</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="customer in arrayCustomer" :key="customer.id">
                              <td v-text="customer.name"></td>
                              <td v-text="customer.cn_name"></td>
                              <td v-text="customer.user"></td>
                              <td v-text="customer.phone"></td>
                              <td v-text="customer.province"></td>
                              <td v-text="customer.city"></td>
                              <td v-text="customer.score"></td>
                              <td>
                                <div v-if="customer.status">
                                  <span class="label label-sm label-success">Valid</span>
                                </div><div v-else="customer.status">
                                  <span class="label label-sm label-danger">Invalid</span>
                                </div>
                              </td>
                              <td>
                                <a title="Edit" class="btn btn-circle text-inverse label-warning" @click="openModal('customer','update',customer)"><i class="fa fa-magic"></i></a>
                                <!--<template v-if="customer.status">
                                <a class="btn btn-circle  text-inverse label-danger" title="Delete" @click="desactivateUser(customer.id)"><i class="fa fa-trash"></i></a>
                                </template>
                                <template v-else="customer.status">
                                <a class="btn btn-circle  text-inverse label-default" title="Delete" @click="activateUser(customer.id)"><i class="fa fa-refresh"></i></a>
                              </template>-->
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
                              <label class="col-md-2 form-control-label" for="text-input">Name<span class="required"> * </span></label>
                              <div class="col-md-4">
                                  <input type="text" v-model="name" class="form-control" placeholder="Name of inspector">
                              </div>
                              <label class="col-md-2 form-control-label" for="text-input">CN Name<span class="required"> * </span></label>
                              <div class="col-md-4">
                                  <input type="text" v-model="cn_name" class="form-control" placeholder="Name in chinese">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-2 form-control-label" for="text-input"><span class="required"> * </span>Type</label>
                              <div class="col-md-4">
                                <select class="form-control " v-model="type">
                                  <option value="fulltime">Full-time</option>
                                  <option value="partime">Part-time</option>
                                </select>
                              </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-2 form-control-label" for="text-input">Bank Name<span class="required"> * </span></label>
                            <div class="col-md-4">
                                <input type="text" v-model="bank_name" class="form-control" placeholder="">
                            </div>
                              <label class="col-md-2 form-control-label" for="text-input">B. Account<span class="required"> * </span></label>
                              <div class="col-md-4">
                                  <input type="text" v-model="back_account" class="form-control" placeholder="Account number">
                                  <span v-if="errors.back_account" class="font-red">{{errors.back_account[0]}}</span>
                                  <span v-else>{{errorNum}}</span>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-2 form-control-label" for="text-input">Province<span class="required"> * </span></label>
                              <div class="col-md-4">
                                  <input type="text" v-model="province" class="form-control" placeholder="Inspector province">
                              </div>
                              <label class="col-md-2 form-control-label" for="text-input">City<span class="required"> * </span></label>
                              <div class="col-md-4">
                                  <input type="text" v-model="city" class="form-control" placeholder="Inspector city">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-2 form-control-label" for="text-input">Phone<span class="required"> * </span></label>
                              <div class="col-md-4">
                                  <input type="text" v-model="phone" class="form-control" placeholder="">
                              </div>
                              <label class="col-md-2 form-control-label" for="text-input">Country<span class="required"> * </span></label>
                              <div class="col-md-4">
                                  <input type="mail" v-model="country" class="form-control" placeholder="">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-2 form-control-label" for="text-input">User(E-mail)<span class="required"> * </span></label>
                              <div class="col-md-4">
                                  <input type="text" v-model="user" class="form-control" placeholder="Access username">
                              </div>
                              <label class="col-md-2 form-control-label" for="text-input">Password<span class="required"> * </span></label>
                              <div class="col-md-4">
                                  <input type="password" v-model="password" class="form-control" placeholder="Input account password">
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
            cn_name:'',
            type:'fulltime',
            back_account:'',
            bank_name:'',
            country:'',
            phone:'',
            province:'',
            city:'',
            country:'',
            user:'',
            password:'',
            status:'',
            arrayCustomer:[],
            arrayRol:[],
            modal: 0,
            modalTitle :'',
            actionType:0,
            errorCustomer:0,
            errorShowMessageCustomer:[],
            errors:[],
            errorNum:'',
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
            var url= 'inspector?page=' + page + '&search=' + search + '&criteria=' + criteria;

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
            axios.post('inspector/store',{

              'name':this.name,
              'cn_name':this.cn_name,
              'type':this.type,
              'bank_name':this.bank_name,
              'back_account':this.back_account,
              'province':this.province,
              'city':this.city,
              'country':this.country,
              'phone':this.phone,
              'user':this.user,
              'password':this.password,


              }).then(function (response) {
                me.closeModal();
                me.listCustomer(1,'','name');
              })
              .catch(error=> {
                if(error.response.status ==422){
                  this.errors = error.response.data.errors
                    console.log(this.errors)
                }

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
            axios.put('inspector/update',{

              'id': this.customer_id,
              'name':this.name,
              'cn_name':this.cn_name,
              'type':this.type,
              'bank_name':this.bank_name,
              'back_account':this.back_account,
              'province':this.province,
              'city':this.city,
              'country':this.country,
              'phone':this.phone,
              'user':this.user,
              'password':this.password,

              }).then(function (response) {
                me.closeModal();
                me.listCustomer(1,'','name');
              })
              .catch(error=> {
                console.log(error.response.status)
                if(error.response.status ==422){
                  this.errorNum = 'This bank account has already taken please change it!'

                }
              });
          },
          desactivateUser(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
              })

              swalWithBootstrapButtons({
                title: 'Are you sure to desactivate this inspector?',
                text: "You can reactivate later!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, desactivate it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  let me=this;
                  axios.put('inspector/desactivate',{

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
                  axios.put('inspector/activate',{

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
            if(!this.name) this.errorShowMessageCustomer.push("Please input a name,cannot be empty");
            if(!this.cn_name) this.errorShowMessageCustomer.push("Please input a chinese name,cannot be empty");
            if(!this.province) this.errorShowMessageCustomer.push("Please input a province,cannot be empty");
            if(!this.city) this.errorShowMessageCustomer.push("Please input a city,cannot be empty");
            if(!this.country) this.errorShowMessageCustomer.push("Please input an country,cannot be empty");
            if(!this.phone) this.errorShowMessageCustomer.push("Please input a phone number,cannot be empty");
            if(!this.back_account) this.errorShowMessageCustomer.push("Please input a bank account number,cannot be empty");
            if(!this.bank_name) this.errorShowMessageCustomer.push("Please input a bank name,cannot be empty");
            if(!this.type) this.errorShowMessageCustomer.push("Please select inspector type,cannot be empty");
            if(!this.user) this.errorShowMessageCustomer.push("Please input user name, should be your country address");
            if(!this.password) this.errorShowMessageCustomer.push("Password cannot be empty");



            if(this.errorShowMessageCustomer.length) this.errorCustomer = 1;

            return this.errorCustomer;
          },
          closeModal(){
            this.modal = 0;
            this.modalTitle ='';
            this.name='';
            this.cn_name='';
            this.type='';
            this.city='';
            this.province='';
            this.country='';
            this.phone='';
            this.back_name='';
            this.bank_account='';
            this.user='';
            this.password='';
            this.errorCustomer=0;
            this.errors=[],
            this.errorNum='',
            this.errorShowMessageCustomer=[];
          },
          openModal(model,action,data=[]){

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
                        this.cn_name='';
                        this.type='';
                        this.city='';
                        this.province='';
                        this.country='';
                        this.phone='';
                        this.back_name='';
                        this.bank_account='';
                        this.user='';
                        this.password='';
                        break;
                      }
                      case 'update':
                      {
                        this.modal = 1;
                        this.modalTitle = 'Update user';
                        this.actionType =2;
                        this.customer_id=data['id'];
                        this.name=data['name'];
                        this.cn_name=data['cn_name'];
                        this.type=data['type'];
                        this.city=data['city'];
                        this.province=data['province'];
                        this.country=data['country'];
                        this.phone=data['phone'];
                        this.bank_name=data['bank_name'];
                        this.back_account=data['back_account'];
                        this.user=data['user'];
                        this.password=data['password'];
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
