<template>
  <div>

    <!-- Breadcrumb -->
    <div class="page-bar">
      <div class="page-title-breadcrumb">
          <div class=" pull-left">
              <div class="page-title">NEW INSPECTION</div>
          </div>
          <ol class="breadcrumb page-breadcrumb pull-right">
              <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
              </li>
              <li class="active">New Inspection</li>
          </ol>
      </div>
    </div>
<!-- start widget -->
<!-- start Payment Details -->
      <div class="card">

        <div class="card-header">
            <i class="fa fa-align-justify"></i> ADD INSPECTION
            <button type="button" class="btn btn-primary" @click="openModal('service','register')">
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
                                           <option value="name">Reference</option>
                                           <option value="forwarder">Forwarder</option>
                                           <option value="invoice">Billing to</option>
                                           <option value="customer">Customer</option>
                                           <option value="supplier">Supplier</option>
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
                              <th>Forwarder</th>
                              <th>Billing To</th>
                              <th>Customer</th>
                              <th>Supplier</th>
                              <th>Selling Price</th>
                              <th>Status</th>
                              <th>Detail</th>
                              <th>Edit</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="service in arrayService" v-bind:key="service.id">
                              <td v-text="service.reference"></td>
                              <td v-text="service.forwarders_name"></td>
                              <td v-text="service.companies_name"></td>
                              <td v-text="service.customers_name"></td>
                              <td v-text="service.suppliers_name"></td>
                              <td v-text="service.selling_price"></td>
                              <td v-text="service.istatus_name"></td>
                              <td v-text="service.istatus_description"></td>
                              <!--<td>
                                <div v-if="service.status">
                                  <span class="label label-sm label-success">Valid</span>
                                </div><div v-else="service.status">
                                  <span class="label label-sm label-danger">Invalid</span>
                                </div>
                              </td>-->
                              <td>
                                <a title="Edit" @click="openModal('service','update',service)"class="btn btn-circle btn-success"><i class="fa fa-legal"></i></a>
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
                              <label class="col-md-2 form-control-label" for="text-input"><span class="required"> * </span>Reference :</label>
                              <div class="col-md-4">
                                  <input type="text" v-model="reference" class="form-control" placeholder="">
                                  <span v-if="errors.reference" class="font-red">{{errors.reference[0]}}</span>
                                  <span v-else>{{errorNum}}</span>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-2 form-control-label" for="text-input"><span class="required"> * </span>Customer :</label>
                              <div class="col-md-4">
                                <select class="form-control " v-model="idcustomer">
                                  <option value="0">Choose</option>
                                  <option v-for="customer in arrayCustomer" :key="customer.id" :value="customer.id" v-text="customer.name"></option>
                                </select>
                              </div>
                              <label class="col-md-2 form-control-label" for="email-input"><span class="required"> * </span>Supplier :</label>
                              <div class="col-md-4">
                                <select class="form-control " v-model="idsupplier">
                                  <option value="0">Choose</option>
                                  <option v-for="supplier in arraySupplier" :key="supplier.id" :value="supplier.id" v-text="supplier.name"></option>
                                </select>
                              </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-2 form-control-label" for="text-input"><span class="required"> * </span>Billing to :</label>
                            <div class="col-md-4">
                              <select class="form-control " v-model="idcompany">
                                <option value="0">Choose</option>
                                <option v-for="company in arrayCompany" :key="company.id" :value="company.id" v-text="company.name"></option>
                              </select>

                            </div>
                              <label class="col-md-2 form-control-label" for="email-input"><span class="required"> * </span>Sales Rep :</label>
                              <div class="col-md-4">
                                <select class="form-control " v-model="idsales">
                                  <option value="0">Choose</option>
                                  <option v-for="user in arrayUser" :key="user.id" :value="user.id" v-text="user.name"></option>
                                </select>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-2 form-control-label" for="email-input"><span class="required"> * </span>Selling price:</label>
                              <div class="col-md-4">
                                  <input type="text" v-model="selling_price" class="form-control" placeholder="">
                              </div>
                              <label class="col-md-2 form-control-label" for="email-input">Billing price :</label>
                              <div class="col-md-4">
                                  <input type="text" v-model="billing_price" class="form-control" placeholder="">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-2 form-control-label" for="email-input"><span class="required"> * </span>Service type</label>
                              <div class="col-md-4">
                                    <select class="form-control " v-model="idcategory">
                                      <option value="0">Choose</option>
                                      <option v-for="category in arrayCategory" :key="category.id" :value="category.id" v-text="category.name"></option>
                                    </select>
                              </div>
                              <label class="col-md-2 form-control-label" for="text-input"><span class="required"> * </span>Forwarder :</label>
                              <div class="col-md-4">
                                <select class="form-control " v-model="idforwarder">
                                  <option value="0">Choose</option>
                                  <option v-for="forwarder in arrayForwarder" :key="forwarder.id" :value="forwarder.id" v-text="forwarder.name"></option>
                                </select>
                              </div>
                          </div>
                          <template v-if="idcategory==1 || idcategory==2 ">
                          <div class="form-group row">
                            <label class="col-md-2 form-control-label" for="text-input"><span class="required"> * </span>Product :</label>
                            <div class="col-md-4">
                                <input type="text" v-model="product_type" class="form-control" placeholder="Input the product user">
                            </div>
                              <label class="col-md-2 form-control-label" for="text-input">PO #</label>
                              <div class="col-md-4">
                                  <input type="text" v-model="po_number" class="form-control" placeholder="Enter the PO number">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-2 form-control-label" for="email-input">Item #</label>
                              <div class="col-md-4">
                                  <input type="text" v-model="item_number" class="form-control" placeholder="Number of unique items">
                              </div>
                              <label class="col-md-2 form-control-label" for="email-input">CTNS #</label>
                              <div class="col-md-4">
                                  <input type="text" v-model="cnts_cnts" class="form-control" placeholder="Number of item CTNS">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-2 form-control-label" for="text-input">Spare parts#</label>
                              <div class="col-md-4">
                                  <input type="text" v-model="spareparts_number" class="form-control" placeholder="Number of unique items">
                              </div>
                              <label class="col-md-2 form-control-label" for="email-input">CNTS #</label>
                              <div class="col-md-4">
                                  <input type="text" v-model="total_sp_cnts" class="form-control" placeholder="Number of SP CTNS">
                              </div>
                          </div>
                          </template>
                          <template v-if="idcategory==1">
                            <div class="form-group row">

                                <label class="col-md-2 form-control-label" for="email-input"><span class="required"> * </span>Container :</label>
                                <div class="col-md-4">
                                  <select class="form-control" v-model="container_type">
                                      <option value="0">Choose</option>
                                      <option value="1">20</option>
                                      <option value="2">20*HQ</option>
                                      <option value="3">40</option>
                                      <option value="4">40*HQ</option>
                                  </select>
                                </div>
                                <label class="col-md-3 form-control-label" for="text-input"><span class="required"> * </span>Type of CCI</label>
                                <div class="col-md-2">
                                  <select class="form-control" v-model="supplier_number">
                                      <option value="0">Choose</option>
                                      <option value="1">FLC</option>
                                      <option value="2">LCL</option>
                                  </select>
                                </div>
                            </div>
                          </template>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input"><span class="required"> * </span>Special instructions</label>
                              <div class="col-md-2">
                                <select class="form-control" v-model="special_instructions">
                                  <option value="3">Choose</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                              </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md form-control-label">Enter the instructions:</label>
                            <div class="col-md-12">
                              <textarea v-model="instructions" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                            </div>
                          </div>
                          <div class="form-group row div-error" v-show="errorService">
                            <div class="text-center text-error">
                              <div class="" v-for="error in errorShowMessageService" :key="error" v-text="error"></div>
                            </div>
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" @click="closeModal()">Close</button>
                      <button type="button" v-if="actionType==1"class="btn btn-primary" @click="registerService()">Save</button>
                      <button type="button" v-if="actionType==2"class="btn btn-primary"@click="updateService()">Update</button>
                  </div>
              </div>
              <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>
      <!--Fin del modal-->
      <!--Inicio del modal follow up-->
      <div class="modal fade" tabindex="-1" :class="{'showM' :modalView}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-primary modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header bg-b-blue">
                      <h4 class="modal-title" v-text="modalTitle"></h4>
                      <button type="button" class="close" @click="closeModalView()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                          <div class="form-group row">
                              <label class="col-md-2 form-control-label" for="text-input">Reference :</label>
                              <div class="col-md-4">
                                  <input type="text" v-model="reference" class="form-control" placeholder="" readonly>
                                  <span v-if="errors.reference" class="font-red">{{errors.reference[0]}}</span>
                                  <span v-else>{{errorNum}}</span>
                              </div>
                              <label class="col-md-2 form-control-label" for="email-input" readonly>Ins. Date :</label>
                              <div class="col-md-4">
                                  <input type="date"  class="form-control" placeholder="" readonly>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-2 form-control-label" for="email-input">Sales Rep :</label>
                              <div class="col-md-4">
                                <select class="form-control " v-model="idsales" disabled>
                                  <option value="0">Choose</option>
                                  <option v-for="user in arrayUser" :key="user.id" :value="user.id" v-text="user.name"></option>
                                </select>
                              </div>
                              <label class="col-md-2 form-control-label" for="email-input">Service type:</label>
                              <div class="col-md-4">
                                <select class="form-control " v-model="idcategory" disabled>
                                  <option value="0">Choose</option>
                                  <option v-for="category in arrayCategory" :key="category.id" :value="category.id" v-text="category.name"></option>
                                </select>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-2 form-control-label" for="text-input">Customer :</label>
                              <div class="col-md-4">
                                <select class="form-control " v-model="idcustomer" disabled>
                                  <option value="0">Choose</option>
                                  <option v-for="customer in arrayCustomer" :key="customer.id" :value="customer.id" v-text="customer.name"></option>
                                </select>
                              </div>
                              <label class="col-md-2 form-control-label" for="email-input">Supplier :</label>
                              <div class="col-md-4">
                                <select class="form-control " v-model="idsupplier" disabled>
                                  <option value="0">Choose</option>
                                  <option v-for="supplier in arraySupplier" :key="supplier.id" :value="supplier.id" v-text="supplier.name"></option>
                                </select>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-2 form-control-label" for="text-input">Contact :</label>
                              <div class="col-md-4">
                                  <input type="text" v-model="supplier_contact" class="form-control" placeholder="" readonly>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-2 form-control-label" for="text-input">Telephone :</label>
                              <div class="col-md-4">
                                  <input type="text" v-model="supplier_phone" class="form-control" placeholder="" readonly>
                              </div>
                              <label class="col-md-2 form-control-label" for="email-input">Email :</label>
                              <div class="col-md-4">
                                  <input type="text"  v-model="email" class="form-control" placeholder="" readonly>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-2 form-control-label" for="text-input">Province :</label>
                              <div class="col-md-4">
                                  <input type="text" v-model="province" class="form-control" placeholder="" readonly>
                              </div>
                              <label class="col-md-2 form-control-label" for="email-input">City :</label>
                              <div class="col-md-4">
                                  <input type="text"  v-model="city" class="form-control" placeholder="" readonly>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Inspection address :</label>
                              <div class="col-md-9">
                                  <input type="text"  class="form-control" placeholder="Input the corresponding inspection address" readonly>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Special instructions:</label>
                              <div class="col-md-2">
                                <select class="form-control" v-model="special_instructions" disabled>
                                  <option value="3">Choose</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                              </div>
                              <label class="col-md-3 form-control-label" for="text-input">Inspection status:</label>
                              <div class="col-md-4">
                                <select class="form-control" v-model="idistatus" disabled>
                                  <option value="0">Choose</option>
                                    <option v-for="istatus in arrayIstatus" :key="istatus.id" :value="istatus.id" v-text="istatus.name">New inspection</option>

                                </select>
                              </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md form-control-label">Enter the instructions:</label>
                            <div class="col-md-12">
                              <textarea v-model="instructions" class="form-control" rows="3" placeholder="Enter ..." readonly></textarea>
                            </div>
                          </div>
                          <div class="form-group row div-error" v-show="errorService">
                            <div class="text-center text-error">
                              <div class="" v-for="error in errorShowMessageService" :key="error" v-text="error"></div>
                            </div>
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" @click="closeModalView()">Close</button>
                      <button type="button" v-if="actionType==1"class="btn btn-primary" @click="registerService()">Save</button>
                      <button type="button" v-if="actionType==2"class="btn btn-primary" @click="followupService(service_id)">Follow up</button>
                  </div>
              </div>
              <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>
      <!--Fin del modal-->
      <!--Inicio del modal CS Follow up-->
      <div class="modal fade" tabindex="-1" :class="{'showM' :modalFollow}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-primary modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header bg-b-blue">
                      <h4 class="modal-title" v-text="modalTitle"></h4>
                      <button type="button" class="close" @click="closeModalFollow()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                          <div class="form-group row">
                              <label class="col-md-2 form-control-label" for="text-input">Reference :</label>
                              <div class="col-md-4">
                                  <input type="text" v-model="reference" class="form-control" placeholder="" readonly>
                                  <span v-if="errors.reference" class="font-red">{{errors.reference[0]}}</span>
                                  <span v-else>{{errorNum}}</span>
                              </div>
                              <label class="col-md-2 form-control-label" for="email-input" >Ins. Date :</label>
                              <div class="col-md-4">
                                  <input type="date"  class="form-control" v-model="inspection_date" >
                                  <div class="form-group row div-error" v-show="errorInspectionDate">
                                    <div class="text-center text-error">
                                      <div class="" v-for="error in errorShowMessageInspectionDate" :key="error" v-text="error"></div>
                                    </div>
                                  </div>
                              </div>

                          </div>
                          <div class="form-group row">
                              <label class="col-md-2 form-control-label" for="email-input">Sales Rep :</label>
                              <div class="col-md-4">
                                <select class="form-control " v-model="idsales" disabled>
                                  <option value="0">Choose</option>
                                  <option v-for="user in arrayUser" :key="user.id" :value="user.id" v-text="user.name"></option>
                                </select>
                              </div>
                              <label class="col-md-2 form-control-label" for="email-input">Service type:</label>
                              <div class="col-md-4">
                                <select class="form-control " v-model="idcategory" disabled>
                                  <option value="0">Choose</option>
                                  <option v-for="category in arrayCategory" :key="category.id" :value="category.id" v-text="category.name"></option>
                                </select>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-2 form-control-label" for="text-input">Customer :</label>
                              <div class="col-md-4">
                                <select class="form-control " v-model="idcustomer" disabled>
                                  <option value="0">Choose</option>
                                  <option v-for="customer in arrayCustomer" :key="customer.id" :value="customer.id" v-text="customer.name"></option>
                                </select>
                              </div>
                              <label class="col-md-2 form-control-label" for="email-input">Supplier :</label>
                              <div class="col-md-4">
                                <select class="form-control " v-model="idsupplier" disabled>
                                  <option value="0">Choose</option>
                                  <option v-for="supplier in arraySupplier" :key="supplier.id" :value="supplier.id" v-text="supplier.name"></option>
                                </select>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-2 form-control-label" for="text-input">Contact :</label>
                              <div class="col-md-4">
                                  <input type="text" v-model="supplier_contact" class="form-control" placeholder="" readonly>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-2 form-control-label" for="text-input">Telephone :</label>
                              <div class="col-md-4">
                                  <input type="text" v-model="supplier_phone" class="form-control" placeholder="" readonly>
                              </div>
                              <label class="col-md-2 form-control-label" for="email-input">Email :</label>
                              <div class="col-md-4">
                                  <input type="text"  v-model="email" class="form-control" placeholder="" readonly>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-2 form-control-label" for="text-input">Province :</label>
                              <div class="col-md-4">
                                  <input type="text" v-model="province" class="form-control" placeholder="" readonly>
                              </div>
                              <label class="col-md-2 form-control-label" for="email-input">City :</label>
                              <div class="col-md-4">
                                  <input type="text"  v-model="city" class="form-control" placeholder="" readonly>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Inspection address :</label>
                              <div class="col-md-9">
                                  <input type="text"  class="form-control" placeholder="Input the corresponding inspection address" readonly>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Special instructions:</label>
                              <div class="col-md-2">
                                <select class="form-control" v-model="special_instructions" disabled>
                                  <option value="3">Choose</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                              </div>
                              <label class="col-md-3 form-control-label" for="text-input">Inspection status:</label>
                              <div class="col-md-4">
                                <select class="form-control" v-model="idistatus" disabled>
                                  <option value="0">Choose</option>
                                    <option v-for="istatus in arrayIstatus" :key="istatus.id" :value="istatus.id" v-text="istatus.name">New inspection</option>

                                </select>
                              </div>
                          </div>
                          <div class="form-group row">
                            <div class="card-head">
                                <header>Special Instructions:</header>
                            </div>
                            <div class="col-md-12">
                              <textarea v-model="instructions" class="form-control" rows="3" placeholder="Enter ..." readonly></textarea>
                            </div>
                          </div>
                          <div class="col-md-12 col-sm-12">
                              <div class="card card-box">
                                  <div class="card-head">
                                      <header>Enter a comment:</header>
                                  </div>
                                  <div class="card-body " id="bar-parent1">

                                        <div class="form-group row">
                                          <div class="col-md-12">
                                            <textarea v-model="content" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                          </div>
                                        </div>
                                        <div class="form-group row div-error" v-show="errorFollowup">
                                          <div class="text-center text-error">
                                            <div class="" v-for="error in errorShowMessageFollowup" :key="error" v-text="error"></div>
                                          </div>
                                        </div>
                                          <div class="form-group">
                                              <div class="offset-md-3 col-md-9">
                                                  <button type="button" class="btn btn-primary" @click="storeFollowup()">Comment</button>
                                                  <button type="button" class="btn btn-success "@click="confirmInspectionDate(service_id)">Confirm inspection date</button>
                                              </div>
                                          </div>

                                  </div>
                              </div>
                          </div>
                          <table class="table display product-overview mb-30" id="support_table5">
                           <thead>
                             <tr>
                               <th>DAILY FOLLOW UP</th>
                             </tr>
                           </thead>
                           <tbody v-if="arrayFollowups.length">
                             <tr v-for="followup in arrayFollowups" v-bind:key="followup.id">
                               <td>
                                 <div class="card card-topline-lightblue" >
                                     <div class="card-head">
                                         <span class="name" style="color:blue;" v-text="'BY ' + followup.name + ' | ' + ' '"></span><span class="datetime" v-text="'Recorded at : '+ followup.created_at"></span>
                                         <button type="button" class="btn btn-danger btn-xs btn-circle" @click="desactivateFollowup(followup.id)">Delete</button>
                                         <div class="tools">
                                             <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                         </div>
                                     </div>
                                     <div class="card-body " v-text="followup.content">
                                     </div>
                                 </div>

                               </td>
                             </tr>
                           </tbody>
                           <tbody v-else>
                             <tr>
                               <td colspan="5">No se ha comenzado el seguimiento</td>
                             </tr>
                           </tbody>
                          </table>
                          <div class="form-group row div-error" v-show="errorService">
                            <div class="text-center text-error">
                              <div class="" v-for="error in errorShowMessageService" :key="error" v-text="error"></div>
                            </div>
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" @click="closeModalFollow()">Close</button>
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
            var url= 'service/new?page=' + page + '&search=' + search + '&criteria=' + criteria;

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
          addFollowup(){
            let me=this;
            me.arrayComments.push({
              content: me.content,
              service_id: me.service_id
            });
          },
          listFollowup(){

            this.content = '';
            let me = this;
            var id = me.service_id;

            var url= 'followup/getFollowup?id=' + id;

            axios.get(url).then(function (response) {
                var respuesta1=response.data;
                me.arrayFollowups = respuesta1.followups;


              })
              .catch(function (error) {
                console.log(error);
              })
              .then(function () {
              });
          },
          storeFollowup(){

            if(this.validateFollowup())
            {
              return;
            }

            let me=this;
            axios.post('followup/store',{

              'content':this.content,
              'idservice':this.service_id,

              }).then(function (response) {

                me.listFollowup();

              })
              .catch(function (error) {
                console.log(error);
              })
              .then(function () {
              });
          },
          desactivateFollowup(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,

              })

              swalWithBootstrapButtons({
                title: 'Are you sure to delete this comment?',
                text: "You are not going to see it again",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  let me=this;
                  axios.put('followup/desactivate',{

                    'id': id

                    }).then(function (response) {
                      me.listFollowup();
                      swalWithBootstrapButtons(
                        'Deleted!',
                        'Your comment was deleted',
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
                    'Your comment will remain alive :)',
                    'error'
                  )
                }
              })
          },
          validateFollowup(){
            this.errorFollowup=0;
            this.errorShowMessageFollowup=[];
            if(!this.content) this.errorShowMessageFollowup.push("Please input a message");
            if(this.errorShowMessageFollowup.length) this.errorFollowup = 1;

            return this.errorFollowup;
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
          registerService(){
            this.errors=[]
            if(this.validateService())
            {
              return;
            }

            let me=this;
            axios.post('service/store',{

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
          validateService(){
            this.errorService=0;
            this.errorShowMessageService=[];

            if(!this.selling_price) this.errorShowMessageService.push("Please enter a selling price,cannot be empty");

            if(this.idsupplier==0) this.errorShowMessageService.push("Please select a supplier");
            if(this.idcustomer==0) this.errorShowMessageService.push("Please select a customer");
            if(this.idcompany==0) this.errorShowMessageService.push("Please select a company to billing");
            if(this.idsales==0) this.errorShowMessageService.push("Please select a sales representative");
            if(this.idforwarder==0) this.errorShowMessageService.push("Please select a forwarder");
            if(this.idcategory==0) this.errorShowMessageService.push("Please select a service type");

            if(this.idcategory==1)
            {
              if(!this.product_type) this.errorShowMessageService.push("Please enter a product type,cannot be empty");
              if(!this.container_type) this.errorShowMessageService.push("Please enter a container type,cannot be empty");
              if(this.container_type==0) this.errorShowMessageService.push("Please select a container type");
              if(this.supplier_number==0) this.errorShowMessageService.push("Please enter the type of loading FCL or LCL,cannot be empty");
            }else if (this.idcategory==2) {
              if(!this.product_type) this.errorShowMessageService.push("Please enter a product type,cannot be empty");
            }

            if(this.special_instructions==3) this.errorShowMessageService.push("Please confirm wheater or not has special instructions");

            if(this.errorShowMessageService.length) this.errorService = 1;

            return this.errorService;
          },
          closeModal(){
            this.modal = 0;
            this.modalTitle ='';
            this.name = '';
            this.description = '';
            this.errorService=0;
            this.errorShowMessageService=[];
            this.errorNum='';
          },
          openModal(model,action,data=[]){
            this.selectCategory();
            this.selectForwarder();
            this.selectCompany();
            this.selectSupplier();
            this.selectCustomer();
            this.selectUser();

              switch (model) {
                case "service":
                {
                  switch (action) {
                    case 'register':
                      {
                        this.modal = 1;
                        this.modalTitle = 'Register new service';
                        this.actionType =1;

                        this.idcategory=0;
                        this.idistatus=0;
                        this.idforwarder=0;
                        this.idsales=0;
                        this.idcompany=0;
                        this.idsupplier=0;
                        this.idcustomer=0;
                        this.reference='';
                        this.selling_price='';
                        this.billing_price='';
                        this.product_type='';
                        this.container_type='';
                        this.item_number='';
                        this.cnts_cnts='';
                        this.spareparts_number='';
                        this.total_sp_cnts='';
                        this.po_number='';
                        this.supplier_number=0;
                        this.instructions='';
                        this.special_instructions=3;
                        this.inspection_status='';
                        break;
                      }
                      case 'update':
                      {
                        this.modal = 1;
                        this.modalTitle = 'Update service';
                        this.actionType =2;
                        this.service_id=data['id'];
                        this.idcategory=data['idcategory'];
                        this.idistatus=data['idistatus'];
                        this.idforwarder=data['idforwarder'];
                        this.idsales=data['idsales'];
                        this.idcompany=data['idcompany'];
                        this.idsupplier=data['idsupplier'];
                        this.idcustomer=data['idcustomer'];
                        this.reference=data['reference'];
                        this.selling_price=data['selling_price'];
                        this.billing_price=data['billing_price'];
                        this.product_type=data['product_type'];
                        this.container_type=data['container_type'];
                        this.item_number=data['item_number'];
                        this.cnts_cnts=data['cnts_cnts'];
                        this.spareparts_number=data['spareparts_number'];
                        this.total_sp_cnts=data['total_sp_cnts'];
                        this.po_number=data['po_number'];
                        this.supplier_number=data['supplier_number'];
                        this.instructions=data['instructions'];
                        this.special_instructions=data['special_instructions'];
                        this.inspection_status=data['inspection_status'];
                        break;
                      }
                  }
                }
              }
          },
          closeModalView(){
            this.modalView = 0;
            this.modalTitle ='';
            this.name = '';
            this.description = '';
            this.errorService=0;
            this.errorShowMessageService=[];
            this.errorNum='';
          },
          openModalView(model,action,data=[]){
            this.selectCategory();
            this.selectSupplier();
            this.selectCustomer();
            this.selectUser();
            this.selectIstatus();
              switch (model) {
                case "service":
                {
                  switch (action) {

                      case 'update':
                      {
                        this.modalView = 1;
                        this.modalTitle = 'Service follow up';
                        this.actionType =2;
                        this.service_id=data['id'];
                        this.idcategory=data['idcategory'];
                        this.idistatus=data['idistatus'];
                        this.idforwarder=data['idforwarder'];
                        this.idsales=data['idsales'];
                        this.idcompany=data['idcompany'];
                        this.idsupplier=data['idsupplier'];
                        this.idcustomer=data['idcustomer'];
                        this.reference=data['reference'];
                        this.selling_price=data['selling_price'];
                        this.billing_price=data['billing_price'];
                        this.product_type=data['product_type'];
                        this.container_type=data['container_type'];
                        this.item_number=data['item_number'];
                        this.cnts_cnts=data['cnts_cnts'];
                        this.spareparts_number=data['spareparts_number'];
                        this.total_sp_cnts=data['total_sp_cnts'];
                        this.po_number=data['po_number'];
                        this.supplier_number=data['supplier_number'];
                        this.instructions=data['instructions'];
                        this.special_instructions=data['special_instructions'];
                        this.inspection_status=data['inspection_status'];
                        this.province=data['province'];
                        this.city=data['city'];
                        this.supplier_contact=data['supplier_contact'];
                        this.supplier_phone=data['supplier_phone'];
                        this.email=data['email'];

                        break;
                      }
                  }
                }
              }
          },
          closeModalFollow(){
            this.modalFollow = 0;
            this.modalTitle ='';
            this.name = '';
            this.description = '';
            this.arrayFollowups=[],
            this.service_id='',
            this.errorService=0;
            this.errorShowMessageService=[];
            this.errorNum='';
          },
          openModalFollow(model,action,data=[]){
            this.selectCategory();
            this.selectSupplier();
            this.selectCustomer();
            this.selectUser();
            this.selectIstatus();



              switch (model) {
                case "service":
                {
                  switch (action) {

                      case 'update':
                      {
                        this.modalFollow = 1;
                        this.modalTitle = 'Service follow up on progress';
                        this.actionType =2;
                        this.service_id=data['id'];
                        this.listFollowup();
                        this.idcategory=data['idcategory'];
                        this.idistatus=data['idistatus'];
                        this.idforwarder=data['idforwarder'];
                        this.idsales=data['idsales'];
                        this.idcompany=data['idcompany'];
                        this.idsupplier=data['idsupplier'];
                        this.idcustomer=data['idcustomer'];
                        this.reference=data['reference'];
                        this.selling_price=data['selling_price'];
                        this.billing_price=data['billing_price'];
                        this.product_type=data['product_type'];
                        this.container_type=data['container_type'];
                        this.item_number=data['item_number'];
                        this.cnts_cnts=data['cnts_cnts'];
                        this.spareparts_number=data['spareparts_number'];
                        this.total_sp_cnts=data['total_sp_cnts'];
                        this.po_number=data['po_number'];
                        this.supplier_number=data['supplier_number'];
                        this.instructions=data['instructions'];
                        this.special_instructions=data['special_instructions'];
                        this.inspection_status=data['inspection_status'];
                        this.province=data['province'];
                        this.city=data['city'];
                        this.supplier_contact=data['supplier_contact'];
                        this.supplier_phone=data['supplier_phone'];
                        this.email=data['email'];
                        this.created_at=data['created_at'];

                        break;
                      }
                  }
                }
              }
          }
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
