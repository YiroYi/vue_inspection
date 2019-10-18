<template>
  <div>

    <!-- Breadcrumb -->
    <div class="page-bar">
      <div class="page-title-breadcrumb">
          <div class=" pull-left">
              <div class="page-title">Live inspection</div>
          </div>
          <ol class="breadcrumb page-breadcrumb pull-right">
              <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
              </li>
              <li class="active">Live inspection</li>
          </ol>
      </div>
    </div>
<!-- start widget -->
<!-- start Payment Details -->
      <div class="card">
        <!--Inicio listado-->
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
                              <th>Monitor</th>
                              <th>View & Edit</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="service in arrayService" v-bind:key="service.id">
                              <td v-text="service.reference"></td>
                              <td v-text="service.suppliers_name"></td>
                              <td v-text="service.inspection_date"></td>
                              <td v-text="service.istatus_name"></td>
                              <td>
                                <template v-if="service.action==0">
                                  <button type="button" @click="openModal('monitor','register',service)" class="btn deepPink btn-outline btn-circle m-b-10"><i class="icon-magnifier"></i></button>
                                </template>
                                <template v-else>

                                </template>

                              </td>
                              <td>
                                <template v-if="service.action==1">
                                  <button type="button" @click="openModal('monitor','update',service)" class="btn purple btn-outline btn-circle m-b-10"><i class="icon-eye"></i></button>
                                </template>
                                <template v-else>

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

         <!--Fin listado-->
         <!--Inicio detalle-->

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
                              <label class="col-md-3 form-control-label" for="text-input">Mid Day follow up evidence</label>
                              <div class="col-md-9">
                                <input type="file" accept="image/*" capture="camera" @change="imageFirst_evidence" ref="fEvidence">
                              </div>
                              <template v-if="actionType==2">
                                <label class="col-md-3 form-control-label" for="text-input">File name</label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control" v-model="first_evidence" readonly>
                                </div>
                              </template>
                              <div class="col-md-12">
                                <label class="col-md-2 form-control-label" for="text-input">Remarks 1</label>
                                <textarea  class="form-control" v-model="fe_remarks" rows="3" placeholder="Enter ..."></textarea>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">End day inspection follow up evidence</label>
                              <div class="col-md-9">
                                <input type="file" accept="image/*" capture="camera" @change="imageSecond_evidence" ref="sEvidence">
                              </div>
                              <template v-if="actionType==2">
                                <label class="col-md-3 form-control-label" for="text-input">File name</label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control" v-model="second_evidence" readonly>
                                </div>
                              </template>
                              <div class="col-md-12">
                                <label class="col-md-2 form-control-label" for="text-input">Remarks 2</label>
                                <textarea  class="form-control" v-model="se_remarks" rows="3" placeholder="Enter ..."></textarea>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Labeling Report</label>
                              <div class="col-md-9">
                                <input type="file" accept=".doc" capture="camera" @change="imageThird_evidence" ref="tEvidence">
                              </div>
                              <template v-if="actionType==2">
                                <label class="col-md-3 form-control-label" for="text-input">File name</label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control" v-model="third_evidence" readonly>
                                </div>
                              </template>
                              <div class="col-md-12">
                                <label class="col-md-2 form-control-label" for="text-input">Remarks 3</label>
                                <textarea  class="form-control" v-model="th_remarks" rows="3" placeholder="Enter ..."></textarea>
                              </div>
                          </div>

                          <div class="form-group row div-error" v-show="errorMonitor">
                            <div class="text-center text-error">
                              <div class="" v-for="error in errorShowMessageMonitor" :key="error" v-text="error"></div>
                            </div>
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                    <div class="col-md-12" style="text-align:center">
                      <button type="button" class="btn btn-secondary" @click="closeModal()">Close</button>
                      <button type="button" v-if="actionType==1" class="btn btn-primary" @click="storeMonitor()">Save</button>
                      <button type="button" v-if="actionType==2" class="btn btn-primary" @click="storeUpdate()">Update</button>
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

            idcategory:0,
            idistatus:0,
            idsupplier:0,
            idcustomer:0,
            reference:'',
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
            email:'',
            arrayService:[],
            errors:[],
            errorNum:'',
            //////Follow up variables Begin/////////////
            action:0,
            service_id:0,
            first_evidence:'',
            fe_remarks:'',
            second_evidence:'',
            se_remarks:'',
            third_evidence:'',
            th_remarks:'',
            arrayMonitor:[],
            //////Follow up variables Finish/////////////
            modal: 0,
            modalTitle :'',
            modalView: 0,
            modalFollow: 0,
            actionType:0,
            errorMonitor:0,
            errorShowMessageMonitor:[],
            listado:1,
            arrayInspectors:[],
            arrayDetail:[],
            iduser:0,
            name:'',
            idinspector:0,
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
            var url= 'monitor/index?page=' + page + '&search=' + search + '&criteria=' + criteria;

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
          storeMonitor(){
            if(this.validateMonitor())
            {
              return;
            }

                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                 })

              swalWithBootstrapButtons({
                title: 'Are you sure to save the inpection progress?',
                text: "Please double check your information!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, confirm!',
                cancelButtonText: 'No, Way!',
                reverseButtons: true
                  }).then((result) => {
                    if (result.value) {
                  let me=this;

                  axios.post('monitor/storeMonitor',{
                    'idservice': this.service_id,
                    'first_evidence':this.first_evidence,
                    'fe_remarks':this.fe_remarks,
                    'second_evidence':this.second_evidence,
                    'se_remarks':this.se_remarks,
                    'third_evidence':this.third_evidence,
                    'th_remarks':this.th_remarks,

                    }).then(function (response) {

                      me.closeModal();
                      me.listService(1,'','name');
                      swalWithBootstrapButtons(
                        'Good job!',
                        'Go back and take a rest',
                        '幸苦了'
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
          closeModal(){
            this.modal = 0;
            this.modalTitle ='';
            this.$refs.fEvidence.value  = '';
            this.$refs.sEvidence.value = '';
            this.$refs.tEvidence.value  = '';
            this.fe_remarks = '';
            this.se_remarks = '';
            this.th_remarks = '';
            this.errorMonitor=0;
            this.errorShowMessageMonitor=[];
          },
          openModal(model,action,data=[]){
            switch (model) {
              case "monitor":
              {
                  switch (action) {
                    case 'register':
                      {
                        this.modal = 1;
                        this.actionType =1;
                        this.modalTitle = 'LIVE FOLLOW UP RECORD';
                        this.service_id = data['id'];
                        break;
                      }
                      case 'update':
                      {
                        let me=this;
                        this.modal = 1;
                        this.actionType =2;
                        this.modalTitle = 'UPDATE FOLLOW UP RECORD';
                        this.service_id = data['id'];

                        var ids = this.service_id;
                        var url = 'monitor/indexMonitorUp?idservice=' + ids;
                        var self=this;
                        axios.get(url).then(function (response) {

                            var respuestaM=response.data;
                            me.arrayMonitor = respuestaM.monitorDetails;


                          }).then(function (response) {
                            self.fe_remarks=me.arrayMonitor[0]['fe_remarks'];
                            self.se_remarks=me.arrayMonitor[0]['se_remarks'];
                            self.th_remarks=me.arrayMonitor[0]['th_remarks'];
                            self.first_evidence=me.arrayMonitor[0]['first_evidence'];
                            self.second_evidence=me.arrayMonitor[0]['second_evidence'];
                            self.third_evidence=me.arrayMonitor[0]['third_evidence'];
                          }).catch(function(error){
                            console.log(error);
                          });


                        break;
                      }
                    }
                  }
                }
              },
          storeUpdate(){
            let me=this;
            if(this.validateMonitor())
            {
              return;
            }

            var ids = this.service_id;
            axios.put('monitor/storeUpdate',{

              'idservice': ids,
              'first_evidence': this.first_evidence,
              'second_evidence': this.second_evidence,
              'third_evidence': this.third_evidence,
              'fe_remarks': this.fe_remarks,
              'se_remarks': this.se_remarks,
              'th_remarks': this.th_remarks,


              }).then(function (response) {
                me.closeModal();
                me.listService(1,'','name');
              })
              .catch(function (error) {
                console.log(error);
              });
          },
          imageFirst_evidence(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.first_evidence = e.target.result;
              }
          },
          imageSecond_evidence(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.second_evidence = e.target.result;
              }
          },
          imageThird_evidence(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.third_evidence = e.target.result;
              }
          },
          validateMonitor(){
            this.errorMonitor=0;
            this.errorShowMessageMonitor=[];

            var md = this.first_evidence;
            var mdn = md.includes("image/");
            if(mdn==false) this.errorShowMessageMonitor.push("The format of the midday inspection picture file must be .jpeg or .jpg");

            var ff = this.second_evidence;
            var ffn = ff.includes("image/");
            if(ffn==false) this.errorShowMessageMonitor.push("The format of the final inspection picture file must be .jpeg or .jpg");


            var rep = this.third_evidence;
            var repn = rep.includes("/msword");
            if(repn==false) this.errorShowMessageMonitor.push("The format file for the report must be .doc");


            if(!this.first_evidence) this.errorShowMessageMonitor.push("Attach the photo of first contact with inspector");
            if(!this.second_evidence) this.errorShowMessageMonitor.push("Attach the photo of second contact with inspector");
            if(!this.third_evidence) this.errorShowMessageMonitor.push("Attach the file with labels");
            if(!this.fe_remarks) this.errorShowMessageMonitor.push("Write the corresponding remarks for midday feedback");
            if(!this.se_remarks) this.errorShowMessageMonitor.push("Write the corresponding remarks for ending inspection remarks");
            if(!this.th_remarks) this.errorShowMessageMonitor.push("Write the corresponding remarks for monitor report");



            if(this.errorShowMessageMonitor.length) this.errorMonitor = 1;
            return this.errorMonitor;
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
