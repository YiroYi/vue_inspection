<template>
  <div>

    <!-- Breadcrumb -->
    <div class="page-bar">
      <div class="page-title-breadcrumb">
          <div class=" pull-left">
              <div class="page-title">COMPLETED INSPECTIONS</div>
          </div>
          <ol class="breadcrumb page-breadcrumb pull-right">
              <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
              </li>
              <li class="active">Completed</li>
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
                                           <option value="supplier">Supplier</option>
                                           <option value="customer">Customer</option>
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
                              <th>Customer</th>
                              <th>Supplier</th>
                              <th>Inspection Date</th>
                              <th>Inspector</th>
                              <th>Dropbox Link</th>
                              <th>Status</th>
                              <th>Complete</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="service in arrayService" v-bind:key="service.id">
                              <td v-text="service.reference"></td>
                              <td v-text="service.customer_name"></td>
                              <td v-text="service.suppliers_name"></td>
                              <td v-text="service.inspection_date"></td>
                              <td v-text="service.inspector"></td>
                              <td v-text="service.db_link"></td>
                              <td v-text="service.istatus_name"></td>

                              <td>
                                <div v-if="service.category_name=='CCI'">
                                  <a title="Edit" @click="openModal('action','CCI',service)" class="btn btn-circle btn-success"><i class="icon-power"></i></a>
                                </div>
                                <div v-else-if="service.category_name=='QCI'">
                                  <a title="Edit" @click="openModal('action','QCI',service)" class="btn btn-circle btn-danger"><i class="icon-power"></i></a>
                                </div>
                                <div v-else>
                                  <a title="Edit" @click="openModal('action','SFA',service)" class="btn btn-circle btn-info"><i class="icon-power"></i></a>
                                </div>

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
         <!--Inicio detalle CCI-->
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
                              <label class="col-md-4 form-control-label" for="text-input">Reference</label>
                              <div class="col-md-8">
                                  <input type="text" v-model="reference" class="form-control" placeholder="Name of the service" readonly>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-4 form-control-label" for="email-input">Inspection Satisfaction<span class="required"> * </span></label>
                              <div class="col-md-8">
                                <select class="form-control " v-model="insp_grade">
                                  <option value="0">Choose</option>
                                  <option value="Bad">Bad</option>
                                  <option value="Good">Good</option>
                                </select>
                              </div>
                          </div>
                          <template v-if="insp_grade=='Bad'">
                          <div class="form-group row">
                              <label class="col-md-4 form-control-label" for="text-input">Remarks<span class="required"> * </span></label>
                              <div class="col-md-8">
                                  <textarea class="form-control" v-model="insp_remark" rows="3" placeholder="Enter ..."></textarea>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-4 form-control-label" for="text-input">Evidence file<span class="required"> * </span></label>
                              <div class="col-md-8">
                                  <input type="file" accept=".doc" @change="ins_ev" capture="camera"  ref="ins_evRef" enctype="multipart/form-data">
                              </div>
                          </div>
                        </template>
                          <div class="form-group row">
                              <label class="col-md-4 form-control-label" for="email-input">Customer Service satisfaction<span class="required"> * </span></label>
                              <div class="col-md-8">
                                <select class="form-control " v-model="cs_grade">
                                  <option value="0">Choose</option>
                                  <option value="Bad">Bad</option>
                                  <option value="Good">Good</option>
                                </select>
                              </div>
                          </div>
                          <template v-if="cs_grade=='Bad'">
                          <div class="form-group row">
                              <label class="col-md-4 form-control-label" for="text-input">Remarks<span class="required"> * </span></label>
                              <div class="col-md-8">
                                  <textarea class="form-control" v-model="cs_remark" rows="3" placeholder="Enter ..."></textarea>
                              </div>
                          </div>
                          </template>
                          <div class="form-group row">
                              <label class="col-md-4 form-control-label" for="email-input">Report satisfaction<span class="required"> * </span></label>
                              <div class="col-md-8">
                                <select class="form-control " v-model="report_grade">
                                  <option value="0">Choose</option>
                                  <option value="Bad">Bad</option>
                                  <option value="Good">Good</option>
                                </select>
                              </div>
                          </div>
                          <template v-if="report_grade=='Bad'">
                          <div class="form-group row">
                              <label class="col-md-4 form-control-label" for="text-input">Remarks<span class="required"> * </span></label>
                              <div class="col-md-8">
                                  <textarea class="form-control" v-model="report_remark" rows="3" placeholder="Enter ..."></textarea>
                              </div>
                          </div>
                          </template>
                          <h3>Confirm selling price & invoicing</h3>
                          <div class="form-group row">
                            <label class="col-md-2 form-control-label" for="text-input"><span class="required"> * </span>Billing to :</label>
                            <div class="col-md-4">
                              <select class="form-control " v-model="idcompany">
                                <option value="0">Choose</option>
                                <option v-for="company in arrayCompany" :key="company.id" :value="company.id" v-text="company.name"></option>
                              </select>
                            </div>
                            <label class="col-md-2 form-control-label" for="email-input"><span class="required"> * </span>Selling price:</label>
                            <div class="col-md-4">
                                <input type="text" v-model="selling_price" class="form-control" placeholder="">
                            </div>
                          </div>
                          <div class="form-group row div-error" v-show="errorFeedback">
                            <div class="text-center text-error">
                              <div class="" v-for="error in errorShowMessageFeedback" :key="error" v-text="error"></div>
                            </div>
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" @click="closeModal()">Close</button>
                      <button type="button" class="btn btn-primary" @click="saleClosing()">Save</button>
                  </div>
              </div>
              <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>
      <!--Fin del modal-->
      <!--Fin del modal-->

  </div>
</template>

<script>
    export default {
        data(){//Estas variables son las que se ligan con los inputs
          return{
            service_id:0,
            idservice:0,
            iddetail:0,
            idinspscores:0,
            idcategory:0,
            idistatus:0,
            idsupplier:0,
            idcompany:0,
            reference:'',
            supplier_number:0,
            inspection_date:0,
            category_name:'',
            selling_price:0,
            // Sales feedback variables//
            insp_grade:'0',
            insp_remark:'',
            insp_ev:'',
            cs_grade:'0',
            cs_remark:'',
            report_grade:'0',
            report_remark:'',
            errorFeedback:0,
            errorShowMessageFeedback:[],
            // Sales feedback variables//

            // Sfa Variables Finish//
            arrayService:[],
            arrayCategory:[],
            arraySupplier:[],
            arrayCustomer:[],
            arrayCompany:[],
            arrayInspDetail:[],
            arrayUser:[],
            arrayIstatus:[],
            errors:[],
            errorNum:'',
            modal: 0,
            modalTitle :'',
            modalView: 0,
            modalFollow: 0,
            actionType:0,
            listado:1,
            iduser:0,
            name:'',
            idinspector:0,
            inspector:'',
            inspectorType:'',
            inspector_type:'',
            inspDate:'',
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
            var url= 'complete/indexCompleted?page=' + page + '&search=' + search + '&criteria=' + criteria;

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
            this.modalTitle ='';
            this.insp_grade ='0';
            this.insp_remark='';
            if(!this.insp_ev){  
            }else{
              this.$refs.ins_evRef.value='';
            }
            this.cs_grade ='0';
            this.cs_remark='';
            this.report_grade ='0';
            this.report_remark='';
            this.idcompany='';
            this.selling_price=0;

            this.errorFeedback = 0;
            this.errorShowMessageFeedback =[];

          },
          openModal(model,action,data=[]){
            switch (model) {
              case "action":
              {
                switch (action) {
                  case 'CCI':
                    {
                      this.modal = 1;
                      this.modalTitle = 'Close your CCI inspection';
                      this.selectCompany();
                      this.idservice = data['id'];
                      this.iddetail = data['inspdetails_id'];
                      this.idinspscores = data['inspscores_id'];
                      this.reference = data['reference'];
                      this.actionType =1;

                      break;
                    }
                    case 'QCI':
                    {
                      this.modal = 1;
                      this.modalTitle = 'Close your QCI inspection';
                      this.selectCompany();
                      this.idservice = data['id'];
                      this.iddetail = data['inspdetails_id'];
                      this.idinspscores = data['inspscores_id'];
                      this.reference = data['reference'];
                      this.actionType =1;
                      break;
                    }
                    case 'SFA':
                    {
                      this.modal = 1;
                      this.modalTitle = 'Close your SFA inspection'
                      this.selectCompany();
                      this.idservice = data['id'];
                      this.iddetail = data['inspdetails_id'];
                      this.idinspscores = data['inspscores_id'];
                      this.reference = data['reference'];
                      this.actionType =1;
                      break;
                    }
                }
              }
            }
          },
          validateFeedback(){

            this.errorFeedback=0;
            this.errorShowMessageFeedback=[];

            var docType = this.insp_ev;
            var n = docType.includes("/msword");

            if(this.insp_grade=="0") this.errorShowMessageFeedback.push("Fill your inspection satisfaction");

            if(this.insp_grade=='Bad'){
              if(!this.insp_remark) this.errorShowMessageFeedback.push("Input the reason that you are not happy with your inspection");
              if(!this.insp_ev) this.errorShowMessageFeedback.push("Upload the corresponding file with the evidence of the inspection mistakes including photos");
              if(n==false) this.errorShowMessageFeedback.push("The format file must be .doc");

            }

            if(this.cs_grade=="0") this.errorShowMessageFeedback.push("Fill your customer service satisfaction level");
            if(this.cs_grade=='Bad'){
              if(!this.cs_remark) this.errorShowMessageFeedback.push("Input the reason that you are not happy with the follow up of the customer service");
            }

            if(this.report_grade=="0") this.errorShowMessageFeedback.push("Fill your final report satisfaction level");
            if(this.report_grade=='Bad'){
              if(!this.report_remark) this.errorShowMessageFeedback.push("Input the reason that you are not happy with your final report");
            }


            if(this.idcompany=="0") this.errorShowMessageFeedback.push("Select the billing company");
            if(!this.selling_price) this.errorShowMessageFeedback.push("Input the selling price for this service");

            if(this.errorShowMessageFeedback.length) this.errorFeedback = 1;

            return this.errorFeedback;
          },
          ins_ev(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.insp_ev = e.target.result;
              }
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
          saleClosing()
          {
            if(this.validateFeedback())
            {
              return;
            }

            const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
             })
              swalWithBootstrapButtons({
                title: 'Would you like to close your inspection?',
                text: "Please double check your information,after confirm you can not change it!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, confirm!',
                cancelButtonText: 'No, Way!',
                reverseButtons: true
                  }).then((result) => {
                    if (result.value) {
                    let me=this;
                    axios.put('complete/saleClosing',{

                      'idservice':this.idservice,
                      'idinspscores':this.idinspscores,
                      'insp_grade':this.insp_grade,
                      'insp_remark':this.insp_remark,
                      'insp_ev':this.insp_ev,
                      'cs_grade':this.cs_grade,
                      'cs_remark':this.cs_remark,
                      'report_grade':this.report_grade,
                      'report_remark':this.report_remark,
                      'selling_price':this.selling_price,
                      'idcompany':this.idcompany

                    }).then(function (response) {
                      me.closeModal();
                      me.listService(1,'','name');

                      swalWithBootstrapButtons(
                        'Great!',
                        'Inspection closed succesfully',
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
