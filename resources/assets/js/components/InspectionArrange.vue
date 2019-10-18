<template>
  <div>

    <!-- Breadcrumb -->
    <div class="page-bar">
      <div class="page-title-breadcrumb">
          <div class=" pull-left">
              <div class="page-title">INSPECTION PLAN</div>
          </div>
          <ol class="breadcrumb page-breadcrumb pull-right">
              <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
              </li>
              <li class="active">Inspection Plan</li>
          </ol>
      </div>
    </div>
<!-- start widget -->
<!-- start Payment Details -->
      <div class="card">
        <!--Inicio listado-->
        <template v-if="listado">
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
                                           <option value="name">Reference</option>
                                           <option value="type">Service type</option>
                                           <option value="date">Inspection date</option>
                                           <option value="customer">Customer</option>
                                         </select>
                                         <input type="text" v-model="search" @keyup.enter="listService(1,search,criteria)"class="form-control" placeholder="Search text...">
                                         <button type="submit" @click="listService(1,search,criteria)" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                                     </div>
                                 </div>
                             </div>
                          </div>
                         <table class="table display product-overview mb-30" id="support_table5">
                          <thead>
                            <tr>
                              <th>Reference</th>
                              <th>Type</th>
                              <th>Customer</th>
                              <th>Supplier</th>
                              <th>Inspection Date</th>
                              <th>Status</th>
                              <th>Plan</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="service in arrayService" v-bind:key="service.id">
                              <td v-text="service.reference"></td>
                              <td v-text="service.category_name"></td>
                              <td v-text="service.customers_name"></td>
                              <td v-text="service.suppliers_name"></td>
                              <td v-text="service.inspection_date"></td>
                              <td v-text="service.istatus_name"></td>
                              <td>
                                  <a class="btn btn-circle text-inverse label-primary" title="Edit" @click="openDetail(service)"><i class="fa fa-child"></i></a>
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
        </template>
         <!--Fin listado-->
         <!--Inicio detalle-->
         <template v-else>
           <div class="card-body">
           <!--Inspection instructions begin-->
             <div class="form-group row border">
               <div class="col-md-12">
                   <p>INSPECTION INFORMATION</p>
               </div>
               <div class="col-md-3">
                   <div class="form-group">
                     <label for="">Reference</label>
                     <input type="text" class="form-control" v-model="reference" readonly>
                   </div>
               </div>
               <div class="col-md-3">
                   <label for="">Service type</label>
                   <input type="text" class="form-control" v-model="category_name" readonly>
               </div>
               <div class="col-md-3">
                   <label for="">Customer name</label>
                   <input type="text" class="form-control" v-model="customers_name" readonly>
               </div>
               <div class="col-md-3">
                   <label for="">Inspection date</label>
                   <input type="text" class="form-control" v-model="inspection_date" readonly>
               </div>
             </div>
             <div class="form-group row border">
               <div class="col-md-12">
                   <p>SUPPLIER INFORMATION</p>
               </div>
               <div class="col-md-3">
                   <div class="form-group">
                     <label for="">Name</label>
                     <input type="text" class="form-control" v-model="suppliers_name" readonly>
                   </div>
               </div>
               <div class="col-md-3">
                   <label for="">Contact person</label>
                   <input type="text" class="form-control" v-model="supplier_contact" readonly>
               </div>
               <div class="col-md-3">
                   <label for="">Telephone</label>
                   <input type="text" class="form-control" v-model="supplier_phone" readonly>
               </div>
               <div class="col-md-3">
                   <label for="">E-mail</label>
                   <input type="text" class="form-control" v-model="email" readonly>
               </div>
               <div class="col-md-3">
                   <div class="form-group">
                     <label for="">Province</label>
                     <input type="text" class="form-control" v-model="province" readonly>
                   </div>
               </div>
               <div class="col-md-3">
                   <label for="">City</label>
                   <input type="text" class="form-control" v-model="city" readonly>
               </div>
               <div class="col-md-6">
                   <label for="">Factory address</label>
                   <input type="text" class="form-control" v-model="inspection_address" readonly>
               </div>
             </div>
             <div class="form-group row border">
               <div class="col-md-12">
                   <label for="">Special instructions</label>
                   <textarea v-model="instructions" class="form-control" rows="3" placeholder="Enter ..." readonly></textarea>
               </div>
             </div>
           <!--Inspection instructions End-->
           <!--Arrange inspector begin-->
            <div class="form-group row border">
               <div class="col-md-12">
                   <p>ARRANGE INSPECTOR & INSTRUCTIONS</p>
               </div>
               <div class="col-md-6">
                   <div class="form-group">
                       <label>Select Inspector<span style="color:red;" v-show="idinspector==''">(*Select)</span></label>
                        <div class="form-inline">
                           <label>CLICK ME &nbsp; </label>
                           <button @click="openModal()" class="btn btn-primary"><i class="fa fa-child"></i></button>

                        </div>
                   </div>
               </div>
             <!--<div class="col-md-2">
                 <label for="">Inspector type </label>
                 <input v-model="inspector_type" type="text" class="form-control" readonly>
             </div>
             <div class="col-md-2">
                 <label for="">Fee<span style="color:red;" v-show="fee==0"> (*Input)</span></label>
                 <input type="number" class="form-control" v-model.number="fee">
             </div>
             <div class="col-md-2">
                 <div class="form-group" >
                     <button @click="addInspector()" class="btn btn-success form-control btnagregar"><i class="icon-plus"></i></button>
                 </div>
             </div>-->
             <div class="col-md-12">
                 <label for="">Supervisor instructions</label>
                 <textarea v-model="sup_instructions" class="form-control" rows="3" placeholder="Enter ..."></textarea>
             </div>
            </div>
           <div class="col-md-12">
             <div class="form-group row div-error" v-show="errorArrange">
               <div class="text-center text-error">
                 <div class="" v-for="error in errorShowMessageArrange" :key="error" v-text="error"></div>
               </div>
             </div>
           </div>
             <div class="form-group row border">
                 <div class="table-responsive col-md-12">
                     <table class="table table-bordered table-striped table-sm">
                         <thead>
                             <tr>
                                 <th>Options</th>
                                 <th>Inspector name</th>
                                 <th>Type</th>
                                 <th>Fee</th>
                                 <th>Subtotal</th>
                             </tr>
                         </thead>
                         <tbody v-if="arrayDetail.length">
                             <tr v-for="(detail,index) in arrayDetail" :key="detail.id">
                                 <td>
                                     <button @click="deleteDetail(index)" type="button" class="btn btn-danger btn-sm">
                                         <i class="icon-close"></i>
                                     </button>
                                 </td>
                                 <td v-text="detail.inspector">

                                 </td>
                                 <td>
                                     <input v-model="detail.inspector_type" type="text" class="form-control" readonly>
                                 </td>
                                 <td>
                                     <input v-model.number="detail.detailFee" type="number" class="form-control">
                                 </td>
                                 <td>
                                    {{detail.detailFee}}
                                 </td>
                             </tr>

                             <tr style="background-color: #CEECF5;">
                                 <td colspan="4" align="right"><strong>Pre-inspection cost:</strong></td>
                                 <td>$ {{total=calculateTotal}}</td>
                             </tr>
                         </tbody>
                         <tbody v-else>
                           <tr>
                             <td colspan="5">
                               Inspectors have not been added for this mission.
                             </td>
                           </tr>
                         </tbody>
                     </table>
                 </div>
             </div>
             <div class="form-group row">
                 <div class="col-md-12">
                     <button type="button" @click="closeDetail()" class="btn btn-secondary">Cancel</button>
                     <button type="button" class="btn btn-primary" @click="arrangeInspector()">Arrange Inspector</button>
                 </div>
             </div>
           <!--Arrange inspector finish-->
         </div>
        </template>
         <!--Fin detalle-->
      </div>


      <!--Inicio del modal Buscar-->
      <div class="modal fade" tabindex="-1" :class="{'showM' :modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-primary modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header bg-b-blue">
                      <h4 class="modal-title" v-text="modalTitle"></h4>
                      <button type="button" class="close" @click="closeModal()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criteriaA">
                                  <option value="name">Name</option>
                                </select>
                                <input type="text" v-model="searchA" @keyup.enter="listInspector(searchA,criteriaA)"class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listInspector(searchA,criteriaA)" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                      <table class="table display product-overview mb-30" id="support_table5">
                       <thead>
                         <tr>
                           <th>Name</th>
                           <th>CN name</th>
                           <th>Province</th>
                           <th>City</th>
                           <th>Email</th>
                           <th>Phone</th>
                           <th>Edit</th>
                         </tr>
                       </thead>
                       <tbody>
                         <tr v-for="customer in arrayCustomer" :key="customer.id">
                           <td v-text="customer.name"></td>
                           <td v-text="customer.cn_name"></td>
                           <td v-text="customer.province"></td>
                           <td v-text="customer.city"></td>
                           <td v-text="customer.email"></td>
                           <td v-text="customer.phone"></td>
                           <td>
                            <button @click="addInspectorModal(customer)" class="btn btn-success form-control btnagregar"><i class="icon-plus"></i></button>
                           </td>
                         </tr>
                       </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" @click="closeModal()">Close</button>
                      <button type="button" v-if="actionType==1"class="btn btn-primary" @click="registerService()">Save</button>
                      <button type="button" v-if="actionType==2"class="btn btn-primary" @click="followupService(service_id)">Follow up</button>
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
            service_id:0,
            idcategory:0,
            idistatus:0,
            idforwarder:0,
            idsales:0,
            idcompany:0,
            idsupplier:0,
            idcustomer:0,
            reference:'',
            selling_price:0,
            billing_price:0,
            product_type:'',
            container_type:'',
            item_number:0,
            cnts_cnts:0,
            spareparts_number:0,
            total_sp_cnts:0,
            po_number:'',
            supplier_number:0,
            inspection_date:0,
            instructions:'',
            special_instructions:'',
            inspection_status:'',
            province:'',
            city:'',
            category_name:'',
            customers_name:'',
            suppliers_name:'',
            supplier_contact:'',
            supplier_phone:'',
            inspection_address:'',
            email:'',
            arrayService:[],
            arrayCategory:[],
            arrayForwarder:[],
            arrayCompany:[],
            arraySupplier:[],
            arrayCustomer:[],
            arrayUser:[],
            arrayIstatus:[],
            arrayFollowups:[],
            arrayComments:[],
            content:'',
            errors:[],
            errorNum:'',
            modal: 0,
            modalTitle :'',
            modalView: 0,
            modalFollow: 0,
            actionType:0,
            errorService:0,
            errorShowMessageService:[],
            errorFollowup:0,
            errorShowMessageFollowup:[],
            errorInspectionDate:0,
            errorShowMessageInspectionDate:[],
            errorArrange:0,
            errorShowMessageArrange:[],
            listado:1,
            arrayInspectors:[],
            arrayDetail:[],
            iduser:0,
            name:'',
            idinspector:0,
            inspector:'',
            inspectorType:'',
            inspector_type:'',
            sup_instructions:'',
            fee:0.0,
            detailFee:0.0,
            total:0.0,
            criteriaA:'name',
            searchA:'',
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
          },
          calculateTotal: function(){
            var result=0.0;
            for(var i=0;i<this.arrayDetail.length;i++){
              result=result+(this.arrayDetail[i].detailFee)
            }
            return result;
          }
        },
        methods:{
          listService(page,search,criteria){
            let me = this;
            var url= 'service/arrange?page=' + page + '&search=' + search + '&criteria=' + criteria;

            axios.get(url).then(function (response) {
                var respuesta=response.data;

                me.arrayService = respuesta.services.data;

                me.pagination = respuesta.pagination;
              })
              .catch(function (error) {
                console.log(error);
              })
              .then(function () {
              });
          },
          selectCategory(){
            let me = this;
            var url= 'category/selectCategory';

            axios.get(url).then(function (response) {
                var respuesta=response.data;
                me.arrayCategory = respuesta.categories;//lo que te regresa el metodo.

              })
              .catch(function (error) {
                console.log(error);
              })
              .then(function () {
              });
          },
          selectForwarder(){
            let me = this;
            var url= 'forwarder/selectForwarder';

            axios.get(url).then(function (response) {
                var respuesta=response.data;
                me.arrayForwarder = respuesta.forwarders;//lo que te regresa el metodo.

              })
              .catch(function (error) {
                console.log(error);
              })
              .then(function () {
              });
          },
          selectCompany(){
            let me = this;
            var url= 'company/selectCompany';

            axios.get(url).then(function (response) {
                var respuesta=response.data;
                me.arrayCompany = respuesta.companies;//lo que te regresa el metodo.

              })
              .catch(function (error) {
                console.log(error);
              })
              .then(function () {
              });
          },
          selectSupplier(){
            let me = this;
            var url= 'supplier/selectSupplier';

            axios.get(url).then(function (response) {
                var respuesta=response.data;
                me.arraySupplier = respuesta.suppliers;//lo que te regresa el metodo.

              })
              .catch(function (error) {
                console.log(error);
              })
              .then(function () {
              });
          },
          selectCustomer(){
            let me = this;
            var url= 'customer/selectCustomer';

            axios.get(url).then(function (response) {
                var respuesta=response.data;
                me.arrayCustomer = respuesta.customers;//lo que te regresa el metodo.

              })
              .catch(function (error) {
                console.log(error);
              })
              .then(function () {
              });
          },
          selectUser(){
            let me = this;
            var url= 'user/selectUser';

            axios.get(url).then(function (response) {
                var respuesta=response.data;
                me.arrayUser = respuesta.users;//lo que te regresa el metodo.

              })
              .catch(function (error) {
                console.log(error);
              })
              .then(function () {
              });
          },
          selectIstatus(){
            let me = this;
            var url= 'istatus/selectIstatus';

            axios.get(url).then(function (response) {
                var respuesta=response.data;
                me.arrayIstatus = respuesta.istatuses;//lo que te regresa el metodo.

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
            me.listService(page,search,criteria);
          },
          arrangeInspector(){
            this.errors=[]
            if(this.validateInspector())
            {
              return;
            }

            let me=this;
            axios.put('arrangeInspector',{
              'id':this.service_id,
              'idservice':this.idservice,
              'total_cost':this.total,
              'sup_instructions':this.sup_instructions,
              'data': this.arrayDetail


              }).then(function (response) {
                me.arrayDetail=[];
                me.sup_instructions='';
                me.listado=1;
                me.listService(1,'','name');
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
          updateService(){
            this.errors=[]
            this.errorNum=''
            if(this.validateService())
            {
              return;
            }

            let me=this;
            axios.put('service/update',{

              'id': this.service_id,
              'idcategory':this.idcategory,
              'idforwarder':this.idforwarder,
              'idsales':this.idsales,
              'idcompany':this.idcompany,
              'idsupplier':this.idsupplier,
              'idcustomer':this.idcustomer,
              'reference':this.reference,
              'selling_price':this.selling_price,
              'billing_price':this.billing_price,
              'product_type':this.product_type,
              'container_type':this.container_type,
              'item_number':this.item_number,
              'cnts_cnts':this.cnts_cnts,
              'spareparts_number':this.spareparts_number,
              'total_sp_cnts':this.total_sp_cnts,
              'po_number':this.po_number,
              'supplier_number':this.supplier_number,
              'instructions':this.instructions,
              'special_instructions':this.special_instructions,
              'inspection_status':this.inspection_status

              }).then(function (response) {
                me.closeModal();
                me.listService(1,'','name');
              })
              .catch(error=> {
                console.log(error.response.status)
                if(error.response.status ==500){
                  this.errorNum = 'This reference already exists please change it!'

                }
              });
          },
          followupService(id){
                this.closeModalView()
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
              })

              swalWithBootstrapButtons({
                title: 'Are you sure to want to take this adventure?',
                text: "You are great!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Follow Up!',
                cancelButtonText: 'No, Way!',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  let me=this;
                  axios.put('service/updateIstatus',{

                    'id': id

                    }).then(function (response) {
                      me.listService(1,'','name');
                      swalWithBootstrapButtons(
                        'You are so brave!',
                        'You are in charge of this adventure',
                        '加油'
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
                    'Got It!',
                    'I will be waiting for you!',
                    'error'
                  )
                }
              })
          },
          confirmInspectionDate(id){
                if(this.validateInspectionDate())
                {
                  return;
                }
                let me=this;
                this.closeModalView()
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
              })

              swalWithBootstrapButtons({
                title: 'Are you sure to confirm the battle day?',
                text: "Let's prepare the warriors!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, confirm!',
                cancelButtonText: 'No, Way!',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  let me=this;
                  axios.put('service/updateIstatusInspectionDate',{

                    'id': id,
                    'inspection_date': this.inspection_date

                    }).then(function (response) {
                      me.listService(1,'','name');
                      swalWithBootstrapButtons(
                        'Please confirm with your captain!',
                        'Lets the war team to make the dirty job',
                        '加油'
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
                    'Got It!',
                    'I will be waiting for you!',
                    'error'
                  )
                }
              })
          },
          validateInspectionDate(){
            this.errorInspectionDate=0;
            this.errorShowMessageInspectionDate=[];
            if(!this.inspection_date) this.errorShowMessageInspectionDate.push("Please input a battle date");
            if(this.errorShowMessageInspectionDate.length) this.errorInspectionDate = 1;

            return this.errorInspectionDate;
          },
          activateService(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
              })

              swalWithBootstrapButtons({
                title: 'Are you sure to want to activate this element?',
                text: "You can deactivate later!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, activate it again!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  let me=this;
                  axios.put('service/activate',{

                    'id': id

                    }).then(function (response) {
                      me.listService(1,'','name');
                      swalWithBootstrapButtons(
                        'activated!',
                        'Your element has been activated',
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
          validateInspector(){


            this.errorArrange=0;
            this.errorShowMessageArrange=[];
            if(this.arrayDetail<=0){
              this.errorShowMessageArrange.push("Add at least one inspector");
            }else{
              var fee = this.arrayDetail[0].detailFee;
              if(fee<=0) this.errorShowMessageArrange.push("Add the fee of the inspector");
            }

            if(!this.sup_instructions) this.errorShowMessageArrange.push("Input the inspection instructions");


            if(this.errorShowMessageArrange.length) this.errorArrange = 1;

            return this.errorArrange;
          },
          closeModal(){
            this.modal = 0;
            this.modalTitle ='';
          },
          openModal(){
            //this.arrayDetail=[];
            this.modal = 1;
            this.modalTitle = 'Select inspectors';
          },
          openDetail(data=[]){
            let me=this;
           this.listado=0;
           me.arrayDetail=[];
           me.sup_instructions='';
           me.inspector_type='';

           this.service_id=data['id'];
           this.reference=data['reference'];
           this.category_name=data['category_name'];
           this.customers_name=data['customers_name'];
           this.inspection_date=data['inspection_date'];
           this.suppliers_name=data['suppliers_name'];
           this.supplier_contact=data['supplier_contact'];
           this.supplier_phone=data['supplier_phone'];
           this.inspection_address=data['inspection_address'];
           this.email=data['email'];
           this.province=data['province'];
           this.city=data['city'];
           this.instructions=data['instructions'];
          },
          closeDetail(){
              this.arrayDetail=[];
               this.listado=1;
              },
              searchInspector(){
                let me=this;
                var url = 'inspector/search?filtro=' + me.name;

                axios.get(url).then(function (response){
                  var respuesta=response.data;

                  me.arrayInspectors = respuesta.inspectors;

                  if(me.arrayInspectors.length>0)
                  {
                    me.inspector=me.arrayInspectors[0]['name'];
                    me.idinspector=me.arrayInspectors[0]['id'];
                    me.inspector_type=me.arrayInspectors[0]['type'];

                  }
                  else{
                    me.inspector='Inspector with this name do not exist'
                    me.idinspector=0;
                  }
                })
                .catch(function (error){
                  console.log(error);
                });
          },
          findId(id){

            var sw=0;
            for(var i=0;i<this.arrayDetail.length;i++){

              if(this.arrayDetail[i].idinspector==id){
                sw=true;
              }
            }
            return sw;
          },
          addInspector(){
            let me=this;
            if(me.idinspector==0||me.fee==0){
            }
            else{
              if(me.findId(me.idinspector)){
                swal({
                  type:'error',
                  title: 'Error...',
                  text: 'This inspector has been already added please choose another one',
                })
              }else {
                {
                  me.arrayDetail.push({
                    idinspector:me.idinspector,
                    inspector:me.inspector,
                    inspector_type:me.inspector_type,
                    detailFee:me.fee,
                  });
                  me.name="";
                  me.idinspector=0;
                  me.inspector="";
                  me.inspectorType="";
                  me.fee=0;
                }
              }
            }
          },
          addInspectorModal(data=[]){
            let me=this
            if(me.findId(data['id'])){
              swal({
                type:'error',
                title: 'Error...',
                text: 'This inspector has been already added please choose another one',
              })
            }else {

                me.arrayDetail.push({
                  idinspector:data['id'],
                  inspector:data['name'],
                  //inspectorType:data['type'],
                  inspector_type:data['type'],
                  detailFee:me.fee,
                });
                me.closeModal();
            }
          },
          listInspector(search,criteria){
            let me = this;
            var url= 'inspector/listInspector?search=' + search + '&criteria=' + criteria;

            axios.get(url).then(function (response) {
                var respuesta=response.data;
                me.arrayCustomer = respuesta.customers.data;

              })
              .catch(function (error) {
                console.log(error);
              })
              .then(function () {

              });
          },
          deleteDetail(index){
            let me=this;
            me.arrayDetail.splice(index,1);
          },

        },
        mounted() {
            this.listService(1,this.search,this.name);


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
  @media (min-width: 600px){
    .btnagregar{
      margin-top: 2rem;
    }
  }
</style>
