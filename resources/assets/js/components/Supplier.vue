<template>
  <div>

    <!-- Breadcrumb -->
    <div class="page-bar">
      <div class="page-title-breadcrumb">
          <div class=" pull-left">
              <div class="page-title">SUPPLIER MANAGEMENT</div>
          </div>
          <ol class="breadcrumb page-breadcrumb pull-right">
              <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
              </li>
              <li class="active">Supplier management</li>
          </ol>
      </div>
    </div>
<!-- start widget -->
<!-- start Payment Details -->
      <div class="card">

        <div class="card-header">
            <i class="fa fa-align-justify"></i> ADD SUPPLIER
            <button type="button" class="btn btn-primary" @click="openModal('supplier','register')">
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
                                           <option value="city">City</option>
                                           <option value="supplier_contact">Contact Person</option>
                                         </select>
                                         <input type="text" v-model="search" @keyup.enter="listSupplier(1,search,criteria)"class="form-control" placeholder="Search text...">
                                         <button type="submit" @click="listSupplier(1,search,criteria)" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                                     </div>
                                 </div>
                             </div>
                          </div>
                         <table class="table display product-overview mb-30" id="support_table5">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Short name</th>
                              <th>Contact person</th>
                              <th>Email</th>
                              <th>Phone</th>
                              <th>Product type</th>
                              <th>Province</th>
                              <th>City</th>
                              <th>Inspection city</th>
                              <th>Edit</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="supplier in arraySupplier" :key="supplier.id">
                              <td v-text="supplier.name"></td>
                              <td v-text="supplier.short_name"></td>
                              <td v-text="supplier.supplier_contact"></td>
                              <td v-text="supplier.email"></td>
                              <td v-text="supplier.supplier_phone"></td>
                              <td v-text="supplier.product_type"></td>
                              <td v-text="supplier.province"></td>
                              <td v-text="supplier.city"></td>
                              <td v-text="supplier.inspection_address"></td>
                              <td>
                                <a class="btn btn-circle text-inverse label-warning" title="Edit" @click="openModal('supplier','update',supplier)"><i class="fa fa-magic"></i></a>
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
                              <label class="col-md-3 form-control-label" for="text-input">Name<span class="required"> * </span></label>
                              <div class="col-md-9">
                                  <input type="text" v-model="name" class="form-control" placeholder="Name of the supplier">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Short Name</label>
                              <div class="col-md-9">
                                  <input type="text" v-model="short_name" class="form-control" placeholder="Short name of supplier">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Contact Person<span class="required"> * </span></label>
                              <div class="col-md-9">
                                  <input type="text" v-model="supplier_contact" class="form-control" placeholder="Supplier contact person">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">E-mail<span class="required"> * </span></label>
                              <div class="col-md-9">
                                  <input type="email" v-model="email" class="form-control" placeholder="Supplier contact person">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Phone<span class="required"> * </span></label>
                              <div class="col-md-9">
                                  <input type="text" v-model="supplier_phone" class="form-control" placeholder="Supplier contact person">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Product type<span class="required"> * </span></label>
                              <div class="col-md-9">
                                  <input type="text" v-model="product_type" class="form-control" placeholder="Commodities">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Province<span class="required"> * </span></label>
                              <div class="col-md-9">
                                  <input type="text" v-model="province" class="form-control" placeholder="Factory province">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">City<span class="required"> * </span></label>
                              <div class="col-md-9">
                                  <input type="text" v-model="city" class="form-control" placeholder="Factory city">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Address</label>
                              <div class="col-md-9">
                                  <input type="text" v-model="inspection_address" class="form-control" placeholder="Input the inspection address">
                              </div>
                          </div>

                          <div class="form-group row div-error" v-show="errorSupplier">
                            <div class="text-center text-error">
                              <div class="" v-for="error in errorShowMessageSupplier" :key="error" v-text="error"></div>
                            </div>
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" @click="closeModal()">Close</button>
                      <button type="button" v-if="actionType==1"class="btn btn-primary" @click="registerSupplier()">Save</button>
                      <button type="button" v-if="actionType==2"class="btn btn-primary"@click="updateSupplier()">Update</button>
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
            supplier_id:0,
            name:'',
            short_name:'',
            supplier_contact:'',
            email:'',
            supplier_phone:'',
            product_type:'',
            province:'',
            city:'',
            inspection_address:'',
            arraySupplier:[],
            modal: 0,
            modalTitle :'',
            actionType:0,
            errorSupplier:0,
            errorShowMessageSupplier:[],
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
          listSupplier(page,search,criteria){
            let me = this;
            var url= 'supplier?page=' + page + '&search=' + search + '&criteria=' + criteria;

            axios.get(url).then(function (response) {
                var respuesta=response.data;
                me.arraySupplier = respuesta.suppliers.data;
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
            me.listSupplier(page,search,criteria);
          },
          registerSupplier(){

            if(this.validateSupplier())
            {
              return;
            }

            let me=this;
            axios.post('supplier/store',{

              'name':this.name,
              'short_name':this.short_name,
              'supplier_contact':this.supplier_contact,
              'email':this.email,
              'supplier_phone':this.supplier_phone,
              'inspection_address':this.inspection_address,
              'product_type':this.product_type,
              'province':this.province,
              'city':this.city

              }).then(function (response) {
                me.closeModal();
                me.listSupplier(1,'','name');
              })
              .catch(function (error) {
                console.log(error);
              })
              .then(function () {
              });
          },
          updateSupplier(){

            if(this.validateSupplier())
            {
              return;
            }

            let me=this;
            axios.put('supplier/update',{

              'id': this.supplier_id,
              'name':this.name,
              'short_name':this.short_name,
              'supplier_contact':this.supplier_contact,
              'email':this.email,
              'supplier_phone':this.supplier_phone,
              'inspection_address':this.inspection_address,
              'product_type':this.product_type,
              'province':this.province,
              'city':this.city

              }).then(function (response) {
                me.closeModal();
                me.listSupplier(1,'','name');
              })
              .catch(function (error) {
                console.log(error);
              });
          },
          validateSupplier(){
            this.errorSupplier=0;
            this.errorShowMessageSupplier=[];
            if(!this.name) this.errorShowMessageSupplier.push("Please input a supplier name,cannot be empty");
            if(!this.supplier_contact) this.errorShowMessageSupplier.push("Please input a contact person,cannot be empty");
            if(!this.email) this.errorShowMessageSupplier.push("Please input an email,cannot be empty");
            if(!this.supplier_phone) this.errorShowMessageSupplier.push("Please input a phone number,cannot be empty");
            if(!this.product_type) this.errorShowMessageSupplier.push("Please input product type");
            if(!this.province) this.errorShowMessageSupplier.push("Please input the province of factory");
            if(!this.city) this.errorShowMessageSupplier.push("Please input the city of factory");

            if(this.errorShowMessageSupplier.length) this.errorSupplier = 1;

            return this.errorSupplier;
          },
          closeModal(){
            this.modal = 0;
            this.modalTitle ='';
            this.name='';
            this.short_name='';
            this.supplier_contact='';
            this.email='';
            this.supplier_phone='';
            this.inspection_address='';
            this.product_type='';
            this.province='';
            this.city='';
            this.errorSupplier=0;
            this.errorShowMessageSupplier=[];
          },
          openModal(model,action,data=[]){
              switch (model) {
                case "supplier":
                {
                  switch (action) {
                    case 'register':
                      {
                        this.modal = 1;
                        this.modalTitle = 'Register new supplier';
                        this.actionType =1;
                        this.name='';
                        this.short_name='';
                        this.supplier_contact='';
                        this.email='';
                        this.supplier_phone='';
                        this.inspection_address='';
                        this.product_type='';
                        this.province='';
                        this.city='';
                        break;
                      }
                      case 'update':
                      {
                        this.modal = 1;
                        this.modalTitle = 'Update supplier';
                        this.actionType =2;
                        this.supplier_id=data['id'];
                        this.name=data['name'];
                        this.short_name=data['short_name'];
                        this.supplier_contact=data['supplier_contact'];
                        this.email=data['email'];
                        this.supplier_phone=data['supplier_phone'];
                        this.inspection_address=data['inspection_address'];
                        this.product_type=data['product_type'];
                        this.province=data['province'];
                        this.city=data['city'];
                        break;
                      }
                  }
                }
              }
          }
        },
        mounted() {
            this.listSupplier(1,this.search,this.name);
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
