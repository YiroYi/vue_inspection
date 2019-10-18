<template>
  <div>

    <!-- Breadcrumb -->
    <div class="page-bar">
      <div class="page-title-breadcrumb">
          <div class=" pull-left">
              <div class="page-title">INSPECTION COSTS</div>
          </div>
          <ol class="breadcrumb page-breadcrumb pull-right">
              <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
              </li>
              <li class="active">Inspection Cost</li>
          </ol>
      </div>
    </div>
<!-- start widget -->
<!-- start Payment Details -->
      <div class="card">

        <div class="card-header">
            <i class="fa fa-align-justify"></i> Add Cost
            <button type="button" class="btn btn-primary" @click="openModal('cost','register')">
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
                                           <option value="description">Description</option>
                                         </select>
                                         <input type="text" v-model="search" @keyup.enter="listCost(1,search,criteria)"class="form-control" placeholder="Texto a buscar">
                                         <button type="submit" @click="listCost(1,search,criteria)" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                                     </div>
                                 </div>
                             </div>
                          </div>
                         <table class="table display product-overview mb-30" id="support_table5">
                          <thead>
                            <tr>
                              <th>Code</th>
                              <th>Name</th>
                              <th>Description</th>
                              <th>Status</th>
                              <th>Edit / Desactivate</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="cost in arrayCost" :key="cost.id">
                              <td v-text="cost.code"></td>
                              <td v-text="cost.name"></td>
                              <td v-text="cost.description"></td>
                              <td>
                                <div v-if="cost.status">
                                  <span class="label label-sm label-success">Valid</span>
                                </div><div v-else="cost.status">
                                  <span class="label label-sm label-danger">Invalid</span>
                                </div>
                              </td>
                              <td>
                                <a title="Edit" class="btn btn-circle text-inverse label-warning" @click="openModal('cost','update',cost)"><i class="fa fa-magic"></i></a>
                                <template v-if="cost.status">
                                <a class="btn btn-circle  text-inverse label-danger" title="Delete" @click="desactivateCost(cost.id)"><i class="fa fa-trash"></i></a>
                                </template>
                                <template v-else="cost.status">
                                <a class="btn btn-circle  text-inverse label-default" title="Delete" @click="activateCost(cost.id)"><i class="fa fa-refresh"></i></a>
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
                              <label class="col-md-3 form-control-label" for="text-input">Code<span class="required"> * </span></label>
                              <div class="col-md-9">
                                  <input type="text" v-model="code" class="form-control" placeholder="Input a code for the cost">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Name<span class="required"> * </span></label>
                              <div class="col-md-9">
                                  <input type="text" v-model="name" class="form-control" placeholder="Name of cost">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="email-input">Description</label>
                              <div class="col-md-9">
                                  <input type="text" v-model="description" class="form-control" placeholder="Input a description for this cost">
                              </div>
                          </div>
                          <div class="form-group row div-error" v-show="errorCost">
                            <div class="text-center text-error">
                              <div class="" v-for="error in errorShowMessageCost" :key="error" v-text="error"></div>
                            </div>
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" @click="closeModal()">Close</button>
                      <button type="button" v-if="actionType==1"class="btn btn-primary" @click="registerCost()">Save</button>
                      <button type="button" v-if="actionType==2"class="btn btn-primary"@click="updateCost()">Update</button>
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
            cost_id:0,
            name:'',
            description:'',
            code:'',
            arrayCost:[],
            modal: 0,
            modalTitle :'',
            actionType:0,
            errorCost:0,
            errorShowMessageCost:[],
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
          listCost(page,search,criteria){
            let me = this;
            var url= 'cost?page=' + page + '&search=' + search + '&criteria=' + criteria;

            axios.get(url).then(function (response) {
                var respuesta=response.data;
                me.arrayCost = respuesta.costs.data;
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
            me.listCost(page,search,criteria);
          },
          registerCost(){

            if(this.validateCost())
            {
              return;
            }

            let me=this;
            axios.post('cost/store',{

              'name': this.name,
              'description': this.description,
              'code': this.code

              }).then(function (response) {
                me.closeModal();
                me.listCost(1,'','name');
              })
              .catch(function (error) {
                console.log(error);
              })
              .then(function () {
              });
          },
          updateCost(){

            if(this.validateCost())
            {
              return;
            }

            let me=this;
            axios.put('cost/update',{

              'id': this.cost_id,
              'name': this.name,
              'description': this.description,
              'code': this.code

              }).then(function (response) {
                me.closeModal();
                me.listCost(1,'','name');
              })
              .catch(function (error) {
                console.log(error);
              });
          },
          desactivateCost(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
              })

              swalWithBootstrapButtons({
                title: 'Are you sure to desactivate this element?',
                text: "You can reactivate later!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, desactivate it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  let me=this;
                  axios.put('cost/desactivate',{

                    'id': id

                    }).then(function (response) {
                      me.listCost(1,'','name');
                      swalWithBootstrapButtons(
                        'Desactivated!',
                        'Your element has been desactivated',
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
          activateCost(id){
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
                  axios.put('cost/activate',{

                    'id': id

                    }).then(function (response) {
                      me.listCost(1,'','name');
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
          validateCost(){
            this.errorCost=0;
            this.errorShowMessageCost=[];
            if(!this.name) this.errorShowMessageCost.push("Please input a cost name,cannot be empty");
            if(!this.description) this.errorShowMessageCost.push("Please input a cost description,cannot be empty");
            if(!this.code) this.errorShowMessageCost.push("Please input a cost code,cannot be empty");
            if(this.errorShowMessageCost.length) this.errorCost = 1;

            return this.errorCost;
          },
          closeModal(){
            this.modal = 0;
            this.modalTitle ='';
            this.name = '';
            this.description = '';
            this.code = '';
            this.errorCost=0;
            this.errorShowMessageCost=[];
          },
          openModal(model,action,data=[]){
              switch (model) {
                case "cost":
                {
                  switch (action) {
                    case 'register':
                      {
                        this.modal = 1;
                        this.modalTitle = 'Register cost';
                        this.actionType =1;
                        this.name = '';
                        this.contact_person = '';
                        this.email = '';
                        this.contact_person = '';
                        break;
                      }
                      case 'update':
                      {
                        this.modal = 1;
                        this.modalTitle = 'Update cost';
                        this.actionType =2;
                        this.cost_id=data['id'];
                        this.name = data['name'];
                        this.description = data['description'];
                        this.code = data['code'];

                        break;
                      }
                  }
                }
              }
          }
        },
        mounted() {
            this.listCost(1,this.search,this.name);
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
