<template>
  <div>

    <!-- Breadcrumb -->
    <div class="page-bar">
      <div class="page-title-breadcrumb">
          <div class=" pull-left">
              <div class="page-title">CUSTOMER MANAGEMENT</div>
          </div>
          <ol class="breadcrumb page-breadcrumb pull-right">
              <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
              </li>
              <li class="active">Customer management</li>
          </ol>
      </div>
    </div>
<!-- start widget -->
<!-- start Payment Details -->
      <div class="card">

        <div class="card-header">
            <i class="fa fa-align-justify"></i> ADD CUSTOMER
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
                                           <option value="short_name">Short Name</option>
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
                              <th>Customer Name</th>
                              <th>Fiscal Name</th>
                              <th>Contact Person</th>
                              <th>E-mail</th>
                              <th>Phone</th>
                              <th>Country</th>
                              <th>Address</th>
                              <th>Edit</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="customer in arrayCustomer" :key="customer.id">
                              <td v-text="customer.name"></td>
                              <td v-text="customer.short_name"></td>
                              <td v-text="customer.contact_person"></td>
                              <td v-text="customer.customer_mail"></td>
                              <td v-text="customer.phone"></td>
                              <td v-text="customer.country"></td>
                              <td v-text="customer.address"></td>
                              <td>
                                <a  class="btn btn-circle text-inverse label-warning" title="Edit" @click="openModal('customer','update',customer)"><i class="fa fa-magic"></i></a>
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
                              <label class="col-md-3 form-control-label" for="text-input">Customer Name<span class="required"> * </span></label>
                              <div class="col-md-9">
                                  <input type="text" v-model="name" class="form-control" placeholder="Input customer name">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Fiscal Name<span class="required"> * </span></label>
                              <div class="col-md-9">
                                  <input type="text" v-model="short_name" class="form-control" placeholder="Fiscal name of customer">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Contact Person</label>
                              <div class="col-md-9">
                                  <input type="text" v-model="contact_person" class="form-control" placeholder="Input contact person">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Customer Mail</label>
                              <div class="col-md-9">
                                  <input type="text" v-model="customer_mail" class="form-control" placeholder="Input the e-mail of customer">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Phone<span class="required"> * </span></label>
                              <div class="col-md-9">
                                  <input type="text" v-model="phone" class="form-control" placeholder="Input the mobile phone of customer">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Country</label>
                              <div class="col-md-9">
                                  <input type="text" v-model="country" class="form-control" placeholder="Input the country location of customer">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Invoicing Address</label>
                              <div class="col-md-9">
                                  <input type="text" v-model="address" class="form-control" placeholder="Customer address, please include Tax ID">
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
            contact_person:'',
            customer_mail:'',
            country:'',
            phone:'',
            address:'',
            arrayCustomer:[],
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
            var url= 'customer?page=' + page + '&search=' + search + '&criteria=' + criteria;

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
            axios.post('customer/store',{

              'name':this.name,
              'short_name':this.short_name,
              'phone':this.phone,
              'address':this.address,
              'contact_person':this.contact_person,
              'customer_mail':this.customer_mail,
              'country':this.country

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
            axios.put('customer/update',{

              'id': this.customer_id,
              'name':this.name,
              'short_name':this.short_name,
              'phone':this.phone,
              'address':this.address,
              'contact_person':this.contact_person,
              'customer_mail':this.customer_mail,
              'country':this.country

              }).then(function (response) {
                me.closeModal();
                me.listCustomer(1,'','name');
              })
              .catch(function (error) {
                console.log(error);
              });
          },
          validateCustomer(){
            this.errorCustomer=0;
            this.errorShowMessageCustomer=[];
            if(!this.name) this.errorShowMessageCustomer.push("Please input a customer name,cannot be empty");
            if(!this.short_name) this.errorShowMessageCustomer.push("Please input a fiscal name,cannot be empty");
            if(!this.phone) this.errorShowMessageCustomer.push("Please input a phone number,cannot be empty");
            if(!this.customer_mail) this.errorShowMessageCustomer.push("Please input a e-mail,cannot be empty");
            if(!this.address) this.errorShowMessageCustomer.push("Please input a invoicing address number,cannot be empty");
            if(!this.country) this.errorShowMessageCustomer.push("Please input a country,cannot be empty");

            if(this.errorShowMessageCustomer.length) this.errorCustomer = 1;

            return this.errorCustomer;
          },
          closeModal(){
            this.modal = 0;
            this.modalTitle ='';
            this.name='';
            this.short_name='';
            this.phone='';
            this.address='';
            this.contact_person='';
            this.customer_mail='';
            this.country='';
            this.errorCustomer=0;
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
                        this.modalTitle = 'Register customer';
                        this.actionType =1;
                        this.name='';
                        this.short_name='';
                        this.phone='';
                        this.address='';
                        this.customer_mail='';
                        this.country='';
                        this.contact_person='';
                        break;
                      }
                      case 'update':
                      {
                        this.modal = 1;
                        this.modalTitle = 'Update customer';
                        this.actionType =2;
                        this.customer_id=data['id'];
                        this.name=data['name'];
                        this.short_name=data['short_name'];
                        this.phone=data['phone'];
                        this.address=data['address'];
                        this.customer_mail=data['customer_mail'];
                        this.country=data['country'];
                        this.contact_person=data['contact_person'];
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
