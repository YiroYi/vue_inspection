<template>
  <div>

    <!-- Breadcrumb -->
    <div class="page-bar">
      <div class="page-title-breadcrumb">
          <div class=" pull-left">
              <div class="page-title">CANCEL INSPECTIONS</div>
          </div>
          <ol class="breadcrumb page-breadcrumb pull-right">
              <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
              </li>
              <li class="active">Cancel inspection</li>
          </ol>
      </div>
    </div>
<!-- start widget -->
<!-- start Payment Details -->
      <div class="card">

        <div class="card-header">
            <i class="fa fa-align-justify"></i> INSPECTION STATUS
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
                                           <option value="name">Reference</option>
                                           <option value="customer">Customer</option>
                                           <option value="supplier">Supplier</option>
                                           <option value="status">Status</option>
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
                              <th>Status</th>
                              <th>Progress</th>

                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="service in arrayService" v-bind:key="service.id">
                              <td v-text="service.reference"></td>
                              <td v-text="service.customers_name"></td>
                              <td v-text="service.suppliers_name"></td>
                              <td v-text="service.istatus_name"></td>
                              <td>
                                <template v-if="service.istatus_id==11">
                                  <a class="btn btn-circle  text-inverse label-default"><i class="fa fa-ban"></i></a>
                                </template>
                                <template v-else>
                                  <a class="btn btn-circle  text-inverse label-danger"  title="Delete" @click="desactivateInspection(service.id)"><i class="fa fa-trash"></i></a>
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
            supplier_contact:'',
            supplier_phone:'',
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
          listService(page,search,criteria){
            let me = this;
            var url= 'service/progress?page=' + page + '&search=' + search + '&criteria=' + criteria;

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
          desactivateInspection(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
              })

              swalWithBootstrapButtons({
                title: 'Are you sure to cancel this inspection?',
                text: "You cannot reactivate later!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, cancel it!',
                cancelButtonText: 'No, stop!',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  let me=this;
                  axios.put('service/cancel',{

                    'id': id

                    }).then(function (response) {
                      me.listService(1,'','name');
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
</style>
