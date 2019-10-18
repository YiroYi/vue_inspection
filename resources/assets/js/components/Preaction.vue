<template>
  <div>

    <!-- Breadcrumb -->
    <div class="page-bar">
      <div class="page-title-breadcrumb">
          <div class=" pull-left">
              <div class="page-title">MY INSPECTIONS</div>
          </div>
          <ol class="breadcrumb page-breadcrumb pull-right">
              <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
              </li>
              <li class="active">My Inspections</li>
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
                                           <option value="inspection_date">Inspection Date</option>
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
                              <th>Supplier</th>
                              <th>Inspection Date</th>
                              <th>Status</th>
                              <th>Begin Inspection</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="service in arrayService" v-bind:key="service.id">
                              <td v-text="service.reference"></td>
                              <td v-text="service.suppliers_name"></td>
                              <td v-text="service.inspection_date"></td>
                              <td v-text="service.istatus_name"></td>
                              <td>
                                  <a title="Edit" @click="openDetail(service)" class="btn btn-success" ><i class="icon-control-play"></i></a>
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
                   <p>SUPPLIER INFORMATION</p>
               </div>
               <div class="col-md-12">
                   <div class="form-group">
                     <label for="">Inspection Instructions</label>
                     <textarea type="text" class="form-control" v-model="sup_instructions" readonly></textarea>
                   </div>
               </div>
             </div>
           <!--Inspection instructions End-->
           <!--Arrange inspector begin-->
             <div class="form-group row">
                 <div class="col-md-12" style="text-align:center">
                     <button type="button" @click="closeDetail()" class="btn btn-primary">EXIT</button>
                     <button type="button" @click="openModal('action',category_name)" class="btn btn-success"><i class="icon-control-play"></i>BEGIN INSPECTION</button>
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
                  <div class="modal-header bg-b-purple">
                      <h4 class="modal-title" v-text="modalTitle"></h4>
                      <button type="button" class="close" @click="closeModal()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                          <div class="form-group row">
                              <label class="col-md-1 form-control-label" for="text-input">Date</label>
                              <div class="col-md-5">
                                  <input type="text" v-model="inspDate" class="form-control" placeholder="Name of the service">
                              </div>
                              <label class="col-md-1 form-control-label" for="text-input">Time</label>
                              <div class="col-md-5">
                                  <input type="text" v-model="check_in" class="form-control" placeholder="Name of the service">
                              </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Check-In Photo</label>
                            <div class="col-md-9">
                              <input type="file" accept="image/*" capture="camera" @change="imageChanged" ref="myImage">
                            </div>
                          </div>
                          <div class="form-group row div-error" v-show="errorCheckin">
                            <div class="text-center text-error">
                              <div class="" v-for="error in errorShowMessageCheckin" :key="error" v-text="error"></div>
                            </div>
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                    <div class="col-md-12" style="text-align:center">
                      <button type="button" class="btn btn-secondary" @click="closeModal()">Close</button>
                      <button type="button" v-if="actionType==1"class="btn btn-primary" @click="checkin(service_id)" :disabled="button==1"><i class="icon-control-play"></i>Start</button>
                    </div>
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
            idsupplier:0,
            idcustomer:0,
            reference:'',
            supplier_number:0,
            inspection_date:0,
            button:0,
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
            arraySupplier:[],
            arrayCustomer:[],
            arrayUser:[],
            arrayIstatus:[],
            errors:[],
            errorNum:'',
            modal: 0,
            modalTitle :'',
            modalView: 0,
            modalFollow: 0,
            actionType:0,
            errorCheckin:0,
            errorShowMessageCheckin:[],
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
            inspDate:'',
            check_in:'',
            check_inPh:'',
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
        },
        methods:{
          listService(page,search,criteria){
            let me = this;
            var url= 'action/index?page=' + page + '&search=' + search + '&criteria=' + criteria;

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
          changePage(page,search,criteria){
            let me = this;
            me.pagination.current_page = page;
            me.listService(page,search,criteria);
            },
          closeModal(){
            this.modal = 0;
            this.button = 0;
            this.modalTitle ='';
            this.check_inPh ='';
            this.$refs.myImage.value = '';
            this.errorShowMessageCheckin=[];
            this.errorCheckin=0;
          },
          openModal(model,action){
            switch (model) {
              case "action":
              {
                switch (action) {
                  case 'CCI':
                    {
                      this.modal = 1;
                      this.modalTitle = 'Begin your CCI';
                      this.inspDate = new Date().toLocaleDateString();
                      this.check_in = new Date().toLocaleTimeString();
                      this.actionType =1;
                      break;
                    }
                    case 'QCI':
                    {
                      this.modal = 1;
                      this.modalTitle = 'Begin your QCI';
                      this.inspDate = new Date().toLocaleDateString();
                      this.check_in = new Date().toLocaleTimeString();
                      this.actionType =1;
                      break;
                    }
                    case 'SFA':
                    {
                      this.modal = 1;
                      this.modalTitle = 'Begin your SFA';
                      this.inspDate = new Date().toLocaleDateString();
                      this.check_in = new Date().toLocaleTimeString();
                      this.actionType =1;
                      break;
                    }
                }
              }
            }
          },
          openDetail(data=[]){

           let me=this;
           this.listado=0;

           this.service_id=data['id'];
           this.reference=data['reference'];
           this.category_name=data['category_name'];
           this.customers_name=data['customers_name'];
           this.inspection_date=data['inspection_date'];
           this.suppliers_name=data['suppliers_name'];
           this.supplier_contact=data['supplier_contact'];
           this.supplier_phone=data['supplier_phone'];
           this.email=data['email'];
           this.province=data['province'];
           this.inspection_address=data['inspection_address'];
           this.sup_instructions=data['sup_intructions'];
           this.city=data['city'];
           this.instructions=data['instructions'];
           var id = this.service_id;

           var url='assign/getDetailsAssigned?id=' + id;

           axios.get(url).then(function (response){

             var respuesta = response.data;
             me.arrayDetail= respuesta.details;
           })
           .catch(function(error){
             console.log(error);

           });

          },
          closeDetail(){
           this.listado=1;
          },
          checkin(ids){

              if(this.validateCheckin())
              {
                return;
              }
              const swalWithBootstrapButtons = swal.mixin({
              confirmButtonClass: 'btn btn-success',
              cancelButtonClass: 'btn btn-danger',
              buttonsStyling: false,
            })

            swalWithBootstrapButtons({
              title: 'Are you sure to begin the battle?',
              text: "Prepare your weapons!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, confirm!',
              cancelButtonText: 'No, Way!',
              reverseButtons: true
            }).then((result) => {
              if (result.value) {
                let me=this;
                this.button=1;
                this.$Progress.start();
                axios.put('action/storeCheckIn',{

                  'idservice': ids,
                  'check_inPh': this.check_inPh,

                  }).then(function (response) {

                    me.$Progress.finish();
                    me.closeModal();
                    me.closeDetail();
                    me.listService(1,'','name');
                    swalWithBootstrapButtons(
                      'Please confirm with your captain!!',
                      'Lets go to the battle',
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
              //Finish

            },
          imageChanged(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.check_inPh = e.target.result;
              }
          },
          validateCheckin(){
            this.errorCheckin=0;
            this.errorShowMessageCheckin=[];

            var docType = this.check_inPh;
            var n = docType.includes("image/");

            if(!this.check_inPh) this.errorShowMessageCheckin.push("Please take your selfie photo before start!");
            if(n==false) this.errorShowMessageCheckin.push("The format file must be jpeg or jpg");
            if(this.errorShowMessageCheckin.length) this.errorCheckin = 1;
            return this.errorCheckin;
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
