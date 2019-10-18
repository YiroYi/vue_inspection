<template>
  <div>

    <!-- Breadcrumb -->
    <div class="page-bar">
      <div class="page-title-breadcrumb">
          <div class=" pull-left">
              <div class="page-title">Reporting Management</div>
          </div>
          <ol class="breadcrumb page-breadcrumb pull-right">
              <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
              </li>
              <li class="active">QCI Report</li>
          </ol>
      </div>
    </div>
<!-- start widget -->
<!-- start Payment Details -->
      <div class="card">
        <!--Inicio listado-->
        <template v-if="listado==1">
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
                              <td v-text="service.istatus_name"></td>
                              <td>
                                <div v-if="service.category_name=='CCI'">
                                  <a title="Edit" @click="openDetail(service)" class="btn btn-circle btn-success"><i class="icon-power"></i></a>
                                </div>
                                <div v-else-if="service.category_name=='QCI'">
                                  <a title="Edit" @click="openDetailQci(service)" class="btn btn-circle btn-danger"><i class="icon-power"></i></a>
                                </div>
                                <div v-else>
                                  <a title="Edit" @click="openDetailSfa(service)" class="btn btn-circle btn-info"><i class="icon-power"></i></a>
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
        </template>
         <!--Fin listado-->
         <!--Inicio detalle CCI-->
         <template v-else-if="listado==0">
           <div class="card-body">
               <!--Inspection instructions begin-->
                 <div class="form-group row border">
                   <div class="col-md-12">
                       <p>Inspection Acknowledgement</p>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">Reference</label>
                         <input type="text" class="form-control" v-model="reference" readonly>
                       </div>
                   </div>
                   <div class="col-md-4">
                       <label for="">Service type</label>
                       <input type="text" class="form-control" v-model="category_name" readonly>
                   </div>
                   <div class="col-md-4">
                       <label for="">Inspection date</label>
                       <input type="text" class="form-control" v-model="inspection_date" readonly>
                   </div>
                 </div>
                 <div class="form-group row border">
                   <div class="col-md-12">
                       <p>Product Information</p>
                   </div>
                   <div class="col-md-6">
                       <div class="form-group">
                         <label for="">Number of unique items<span class="required"> * </span></label>
                         <input type="text" v-model.number="item_number" class="form-control">
                       </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label for="">Spare parts loaded Y / N?<span class="required"> * </span></label>
                       <select class="form-control " v-model="spare_parts">
                         <option value="0">Choose</option>
                         <option value="Yes">Yes</option>
                         <option value="No">No</option>
                       </select>
                     </div>
                   </div>
                 </div>
                 <div class="form-group row border">
                   <div class="col-md-12">
                       <p>Loaded Quantity</p>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">Loaded cartons of items<span class="required"> * </span></label>
                         <input type="text" class="form-control" v-model.number="item_cnts">
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">Loaded cartons of spare parts<span class="required"> * </span></label>
                         <input type="text" class="form-control" v-model.number="sp_cnts">
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">Total loaded cartons</label>
                         <input type="number" class="form-control" v-model="total_cnts" readonly>
                         <p hidden>${{total_cnts=calculateTotalCtns}}</p>
                       </div>
                   </div>
                 </div>
                 <div class="form-group row border">
                   <div class="col-md-12">
                       <p>Product conditions</p>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">Number of damaged cartons<span class="required"> * </span></label>
                         <input type="text" v-model.number="damaged_cnts"class="form-control">
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">Pallets were loaded Y/N?<span class="required"> * </span></label>
                         <select class="form-control " v-model="pallets_loaded">
                           <option value="3">Choose</option>
                           <option value="1">Yes</option>
                           <option value="2">No</option>
                         </select>
                       </div>
                   </div>
                   <div class="col-md-4" v-if="pallets_loaded==1">
                       <div class="form-group">
                         <label for="">Pallets were fumigated Y/N?<span class="required"> * </span></label>
                         <select class="form-control " v-model="pallet_fumigate">
                           <option value="3">Choose</option>
                           <option value="1">Yes</option>
                           <option value="2">No</option>
                         </select>
                       </div>
                   </div>
                   <div class="col-md-4" v-else>
                       <div class="form-group">
                       </div>
                   </div>
                 </div>
                 <div class="form-group row border">
                   <div class="col-md-12">
                       <p>Container information</p>
                   </div>
                   <div class="col-md-6">
                       <div class="form-group">
                         <label for="">Container number<span class="required"> * </span></label>
                         <input type="text" v-model="container_number" class="form-control">
                       </div>
                   </div>
                   <div class="col-md-6">
                       <div class="form-group">
                         <label for="">Container seal number<span class="required"> * </span></label>
                         <input type="text" v-model="seal_number" class="form-control">
                       </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label for="">Container number photo<span class="required"> * </span></label>
                       <input type="file" accept="image/*" capture="camera" @change="contNumPh" ref="myImage">
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label for="">Seal number photo<span class="required"> * </span></label>
                       <input type="file" accept="image/*" capture="camera" @change="sealNumPh" ref="myImage">
                     </div>
                   </div>
                   <div class="col-md-6">
                       <div class="form-group">
                         <label for="">Container number photo file name</label>
                         <input type="text" v-model="container_numberph" class="form-control" readonly>
                       </div>
                   </div>
                   <div class="col-md-6">
                       <div class="form-group">
                         <label for="">Seal number photo file name</label>
                         <input type="text" v-model="seal_numberph" class="form-control" readonly>
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">Is container damaged?<span class="required"> * </span></label>
                         <select class="form-control " v-model="container_damaged">
                           <option value="3">Choose</option>
                           <option value="Not Damaged">Not Damaged</option>
                           <option value="Low Damaged">Low Damaged</option>
                           <option value="Medium Damaged">Medium Damaged</option>
                           <option value="Seriouss Damaged">Seriouss Damaged</option>
                         </select>
                       </div>
                   </div>
                 </div>
                 <div class="form-group row border">
                   <div class="col-md-12">
                       <p>Acknowledgment documents</p>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">Printed packing file name</label>
                         <input type="text" v-model="packing_listPh" class="form-control" readonly>
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">Inspector & container file name</label>
                         <input type="text" v-model="inspContPh" class="form-control" readonly>
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">Acknowledgment file name</label>
                         <input type="text" v-model="ack_Ph" class="form-control" readonly>
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">Container acknowledgment 1 file name</label>
                         <input type="text" v-model="c1ack_Ph" class="form-control" readonly>
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">Container acknowledgment 2 file name</label>
                         <input type="text" v-model="c2ack_Ph" class="form-control" readonly>
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">Counting acknowledgment</label>
                         <input type="text" v-model="count_ck_Ph" class="form-control" readonly>
                       </div>
                   </div>
                 </div>
                 <div class="form-group row border">
                   <div class="col-md-12">
                       <p>Inspection result</p>
                   </div>
                   <div class="col-md-6">
                       <div class="form-group">
                         <label for="">Factory cooperates?</label>
                         <select class="form-control " v-model="fty_cooperate" readonly>
                           <option value="3">Choose</option>
                           <option value="1">Yes</option>
                           <option value="2">No</option>
                         </select>
                       </div>
                   </div>
                   <div class="col-md-6">
                       <div class="form-group">
                         <label for="">Inspection Result<span class="required"> * </span></label>
                         <select class="form-control " v-model="result">
                           <option value="0">Choose</option>
                           <option value="Pass">Pass</option>
                           <option value="Fail">Fail</option>
                           <option value="Pending">Pending</option>
                         </select>
                       </div>
                   </div>
                   <div class="col-md-12">
                       <div class="form-group">
                         <label for="">Remarks</label>
                         <textarea class="form-control" v-model="remarks" rows="3" placeholder="Enter ..."></textarea>
                       </div>
                   </div>
                 </div>
                 <div class="form-group row border">
                   <div class="col-md-12">
                       <p>Check Out</p>
                   </div>
                       <div class="col-md-6">
                         <div class="form-group">
                          <label  for="text-input">Check in time</label>
                          <input type="text" v-model="check_in" class="form-control" placeholder="Name of the service">
                        </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group">
                          <label  for="text-input">Check out time</label>
                          <input type="text" v-model="check_out" class="form-control" placeholder="Name of the service">
                        </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group">
                          <label  for="text-input">Check-In Photo</label>
                          <div class="widget-user-image">
                            <img  :src="getCheckInPh()" alt="" style="height:300px;width:300px;">
                          </div>
                        </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group">
                          <label  for="text-input">Check-Out Photo</label>
                          <div class="widget-user-image">
                            <img  :src="getCheckOutPh()" alt="" style="height:300px;width:300px;">
                          </div>
                        </div>
                       </div>

                 </div>
                 <div class="form-group row div-error" v-show="errorCheckout">
                   <div class="text-center text-error">
                     <div class="" v-for="error in errorShowMessageCheckout" :key="error" v-text="error"></div>
                   </div>
                 </div>
               <!--Inspection instructions End-->
               <!--Arrange inspector begin-->
                 <div class="form-group row">
                     <div class="col-md-12" style="text-align:center">
                         <button type="button" @click="closeDetail()" class="btn btn-primary">EXIT</button>
                         <button type="button" @click="confirmInfo()" class="btn btn-success"><i class="icon-control-play"></i>CHECK OUT</button>
                     </div>
                 </div>
               <!--Arrange inspector finish-->
            </div>
         </template>
         <!--Fin detalle CCI-->
         <!--Inicio detalle QCI-->
         <template v-else-if="listado==2">
           <div class="card-body">
                <!--General information begin-->
                 <div class="form-group row border">
                   <div class="col-md-12">
                       <p>Quality Inspection Acknowledgement</p>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">Reference</label>
                         <input type="text" class="form-control" v-model="reference" readonly>
                       </div>
                   </div>
                   <div class="col-md-4">
                       <label for="">Service type</label>
                       <input type="text" class="form-control" v-model="category_name" readonly>
                   </div>
                   <div class="col-md-4">
                       <label for="">Inspection date</label>
                       <input type="text" class="form-control" v-model="inspection_date" readonly>
                   </div>
                 </div>
                <!--General information finish-->

                <!--Quality information begin-->
                 <div class="form-group row border">
                   <div class="col-md-12">
                       <p>Product Information</p>
                   </div>
                   <div class="col-md-4">
                     <div class="form-group">
                       <label for="">AQL Level</label>
                       <input class="form-control " v-model="aql_level" readonly>
                     </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">Number of unique items</label>
                         <input type="text" v-model.number="item_number" class="form-control" readonly>
                       </div>
                   </div>
                   <div class="col-md-4">
                     <div class="form-group">
                       <label for="">Production status</label>
                       <input class="form-control " v-model="production_status" readonly>
                     </div>
                   </div>
                 </div>
                <!--Quality information finish-->

                <!--Inspection Preresult begin-->
                <!--<div class="form-group row border">
                   <div class="col-md-12">
                       <p>Defects summary</p>
                   </div>
                   <div class="col-md-2">
                          <label>Product Code(*)<span style="color:red;" v-show="product_code==''">(*Fill)</span></label>
                          <input type="text" class="form-control" v-model="product_code">
                   </div>
                   <div class="col-md-2">
                           <label>Description(*)<span style="color:red;" v-show="product_description==''">(*Fill)</span></label>
                           <input type="text" class="form-control" v-model="product_description">
                   </div>
                   <div class="col-md-1">
                           <label>Sample*<span style="color:red;" v-show="sample_size==''">(*Fill)</span></label>
                          <input type="text" class="form-control" v-model="sample_size">
                   </div>
                   <div class="col-md-1">
                          <label>Minor*<span style="color:red;" v-show="minor_defects==''">(*Fill)</span></label>
                          <input type="text" class="form-control" v-model.number="minor_defects">
                   </div>
                   <div class="col-md-1">
                          <label>Major*<span style="color:red;" v-show="major_defects==''">(*Fill)</span></label>
                          <input type="text" class="form-control" v-model.number="major_defects">
                   </div>
                   <div class="col-md-1">
                           <label>Critical*<span style="color:red;" v-show="critical_defects==''">(*Fill)</span></label>
                          <input type="text" class="form-control" v-model.number="critical_defects">
                   </div>
                   <div class="col-md-1">

                           <label>Result*<span style="color:red;" v-show="result=='0'">(*Fill)</span></label>
                              <select class="form-control " v-model="result">
                                <option value="0">Choose</option>
                                <option value="Pass">Pass</option>
                                <option value="Fail">Fail</option>
                                <option value="Customer consideration">To customer consideration</option>
                              </select>
                   </div>
                   <div class="col-md-1">
                       <div class="form-group" >
                           <button @click="addDefect()" class="btn btn-success form-control btnagregar"><i class="icon-plus"></i></button>
                       </div>
                   </div>
                </div>
                 <div class="form-group row border">
                   <div class="col-md-12">
                       <p>ADD NEW DEFECT</p>
                   </div>
                    <div class="table-responsive col-md-12">
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Delete</th>
                                    <th>Product Code</th>
                                    <th>Product Description</th>
                                    <th>Sample Size</th>
                                    <th>Minor Defect</th>
                                    <th>Major Defect</th>
                                    <th>Critical Defect</th>
                                    <th>Total</th>
                                    <th>Result</th>
                                </tr>
                            </thead>
                            <tbody v-if="arrayDefect.length">
                                <tr v-for="(defect,index) in arrayDefect" :key="defect.id">
                                    <td>
                                        <button @click="deleteDefect(index)" type="button" class="btn btn-danger btn-sm">
                                            <i class="icon-close"></i>
                                        </button>
                                    </td>
                                    <td v-text="defect.product_code"></td>
                                    <td v-text="defect.product_description"></td>
                                    <td v-text="defect.sample_size"></td>
                                    <td v-text="defect.minor_defects"></td>
                                    <td v-text="defect.major_defects"></td>
                                    <td v-text="defect.critical_defects"></td>
                                    <td v-text="defect.total"></td>
                                    <td v-text="defect.result"></td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                              <tr>
                                <td colspan="9">
                                  New defects has not added.
                                </td>
                              </tr>

                            </tbody>
                            <tbody>
                              <tr>
                                <td colspan="9">
                                  <button type="button" @click="addNewDefect()" class="btn btn-success">Save</button>
                                </td>
                              </tr>
                            </tbody>
                        </table>
                        <div class="form-group row div-error" v-show="errorCheckoutQci">
                          <div class="text-center text-error">
                            <div class="" v-for="error in errorShowMessageCheckoutQci" :key="error" v-text="error"></div>
                          </div>
                        </div>
                    </div>
                 </div>-->

                <!--Defect Details-->
                <div class="form-group row border">
                  <div class="col-md-12">
                      <p>AQL RESULT</p>
                  </div>
                   <div class="table-responsive col-md-12">
                       <table class="table table-bordered table-striped table-sm">
                           <thead>
                               <tr>
                                   <th>Product Code</th>
                                   <th>Product Description</th>
                                   <th>Sample Size</th>
                                   <th>Minor Defect</th>
                                   <th>Major Defect</th>
                                   <th>Critical Defect</th>
                                   <th>Total</th>
                                   <th>Result</th>
                               </tr>
                           </thead>
                           <tbody v-if="arrayDefectDetail.length">
                               <tr v-for="(defect,index) in arrayDefectDetail" :key="defect.id">
                                   <td v-text="defect.product_code"></td>
                                   <td v-text="defect.product_description"></td>
                                   <td v-text="defect.sample_size"></td>
                                   <td v-text="defect.minor_defects"></td>
                                   <td v-text="defect.major_defects"></td>
                                   <td v-text="defect.critical_defects"></td>
                                   <td v-text="defect.total"></td>
                                   <td v-text="defect.result"></td>
                               </tr>
                           </tbody>
                           <tbody v-else>
                             <tr>
                               <td colspan="9">
                                 Results has not assigned.
                               </td>
                             </tr>
                           </tbody>
                       </table>

                   </div>
                </div>
                <!--Defect Details-->


                <!--Inspection Preresult finish-->

                 <!--Inspection photos begin-->
                 <div class="form-group row border">
                   <div class="col-md-12">
                       <p>Inspection documents</p>
                   </div>
                   <div class="col-md-12">
                       <div class="form-group">
                         <label for="">Acknowledgment file name</label>
                         <input type="text" v-model="acknowledgmentPh" class="form-control" readonly>
                       </div>
                   </div>
                   <!--<div class="col-md-6">
                       <div class="form-group">
                         <label for="">Printed packing file name</label>
                         <input type="text" v-model="printed_plPh" class="form-control" readonly>
                       </div>
                   </div>-->
                   <!--<div class="col-md-4">
                     <div class="form-group">
                      <label  for="text-input">Sampling warehouse photo</label>
                      <div class="widget-user-image">
                        <img  :src="getSamplingPh()" alt="" style="height:300px;width:300px;">
                      </div>
                    </div>
                  </div>-->
                   <div class="col-md-6">
                     <div class="form-group">
                      <label  for="text-input">Opened Samples Photo</label>
                      <div class="widget-user-image">
                        <img  :src="getOpenedSamplePh()" alt="" style="height:300px;width:300px;">
                      </div>
                    </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                      <label  for="text-input">Sealed Samples Photo</label>
                      <div class="widget-user-image">
                        <img  :src="getSealedSamplePh()" alt="" style="height:300px;width:300px;">
                      </div>
                    </div>
                   </div>
                 </div>
                 <!--Inspection photos finish-->

                 <!--Inspection Result begin-->
                 <div class="form-group row border">
                   <div class="col-md-12">
                       <p>Inspection result</p>
                   </div>
                   <div class="col-md-6">
                       <div class="form-group">
                         <label for="">Factory cooperates?</label>
                         <input class="form-control " v-model="fty_cooperateInput" readonly>
                       </div>
                   </div>

                   <div class="col-md-6">
                       <div class="form-group">
                         <label for="">INSPECTION RESULT</label>
                         <input select class="form-control " v-model="inspection_result" readonly>
                       </div>
                   </div>
                   <div class="col-md-12">
                       <div class="form-group">
                         <label for="">Remarks</label>
                         <textarea class="form-control" v-model="remarks" rows="3" placeholder="Enter ..." readonly></textarea>
                       </div>
                   </div>
                 </div>
                 <!--Inspection Result finish-->
                 <div class="form-group row border">
                   <div class="col-md-12">
                       <p>Check Out</p>
                   </div>
                       <div class="col-md-6">
                         <div class="form-group">
                          <label  for="text-input">Check in time</label>
                          <input type="text" v-model="check_in" class="form-control" placeholder="Name of the service" readonly>
                        </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group">
                          <label  for="text-input">Check out time</label>
                          <input type="text" v-model="check_out" class="form-control" placeholder="Name of the service" readonly>
                        </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group">
                          <label  for="text-input">Check-In Photo</label>
                          <div class="widget-user-image">
                            <img  :src="getCheckInPh()" alt="" style="height:300px;width:300px;">
                          </div>
                        </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group">
                          <label  for="text-input">Check-Out Photo</label>
                          <div class="widget-user-image">
                            <img  :src="getCheckOutPh()" alt="" style="height:300px;width:300px;">
                          </div>
                        </div>
                       </div>

                 </div>
                 <div class="form-group row div-error" v-show="errorCheckout">
                   <div class="text-center text-error">
                     <div class="" v-for="error in errorShowMessageCheckout" :key="error" v-text="error"></div>
                   </div>
                 </div>
                 <div class="form-group row div-error" v-show="errorCheckoutQci">
                   <div class="text-center text-error">
                     <div class="" v-for="error in errorShowMessageCheckoutQci" :key="error" v-text="error"></div>
                   </div>
                 </div>
               <!--Inspection instructions End-->
               <!--Arrange inspector begin-->
                 <div class="form-group row">
                     <div class="col-md-12" style="text-align:center">

                         <div v-if="category_name=='CCI'">
                           <button type="button" @click="closeDetail()" class="btn btn-primary">EXIT</button>
                           <button type="button" @click="storeCheckOut(service_id)" class="btn btn-success"><i class="icon-control-play"></i>CHECK OUT</button>
                         </div>
                         <div v-else-if="category_name=='QCI'">
                           <button type="button" @click="closeDetail()" class="btn btn-primary">EXIT</button>
                           <button type="button" @click="openModal('action',category_name)" class="btn btn-danger">SUBMIT REPORT</button>
                         </div>
                         <div v-else="category_name=='SFA'">
                           <button type="button" @click="closeDetail()" class="btn btn-primary">EXIT</button>
                           <button type="button" @click="storeCheckOutSfa(service_id)" class="btn btn-info"><i class="icon-control-play"></i>CHECK OUT</button>
                         </div>
                     </div>
                 </div>
               <!--Arrange inspector finish-->
            </div>
         </template>
         <!--Fin detalle QCI-->
         <!--Inicio detalle SFA-->
         <template v-else>
           <div class="card-body">
             <!--General information begin-->
              <div class="form-group row border">
                <div class="col-md-12">
                    <p>Factory Audit Acknowledgement</p>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Reference</label>
                      <input type="text" class="form-control" v-model="reference" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="">Service type</label>
                    <input type="text" class="form-control" v-model="category_name" readonly>
                </div>
                <div class="col-md-4">
                    <label for="">Inspection date</label>
                    <input type="text" class="form-control" v-model="inspection_date" readonly>
                </div>
              </div>
             <!--General information finish-->

             <!--Quality information begin-->
              <div class="form-group row border">
                <div class="col-md-12">
                    <p>S1-General information</p>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Factory name<span class="required"> * </span></label>
                      <input type="text" v-model="name" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Address<span class="required"> * </span></label>
                      <input type="text" v-model="address" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Website<span class="required"> * </span></label>
                      <input type="text" v-model="website" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Telephone<span class="required"> * </span></label>
                      <input type="text" v-model="telephone" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">E-mail<span class="required"> * </span></label>
                      <input type="text" v-model="email" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Name of contact person<span class="required"> * </span></label>
                      <input type="text" v-model="contact_name" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Mobile of contact person<span class="required"> * </span></label>
                      <input type="text" v-model="contact_mobile" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Position of contact person<span class="required"> * </span></label>
                      <input type="text" v-model="contact_position" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Main product<span class="required"> * </span></label>
                      <input type="text" v-model="main_product" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Main market<span class="required"> * </span></label>
                      <input type="text" v-model="main_market" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Production capacity<span class="required"> * </span></label>
                      <input type="text" v-model="production_capacity" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Registration date<span class="required"> * </span></label>
                      <input type="text" v-model="registration_date" class="form-control">
                    </div>
                </div>
              </div>
              <div class="form-group row border">
                <div class="col-md-12">
                    <p>S2-General information</p>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Type of registration<span class="required"> * </span></label>
                      <input type="text" v-model="type_of_registration" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Type of company<span class="required"> * </span></label>
                      <input type="text" v-model="type_of_company" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Employees number<span class="required"> * </span></label>
                      <input type="text" v-model="employees_number" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Customer country<span class="required"> * </span></label>
                      <input type="text" v-model="customer_country" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Factory area<span class="required"> * </span></label>
                      <input type="text" v-model="factory_area_sqm2" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Company owner name<span class="required"> * </span></label>
                      <input type="text" v-model="company_owner" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">General manager name<span class="required"> * </span></label>
                      <input type="text" v-model="general_manager" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Tax Id<span class="required"> * </span></label>
                      <input type="text" v-model="tax_id" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Export licence<span class="required"> * </span></label>
                      <input type="text" v-model="export_license" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Nearest port<span class="required"> * </span></label>
                      <input type="text" v-model="nearest_port" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 form-control-label" for="text-input">Bank account picture</label>
                  <div class="col-md-9">
                    <input type="file"  accept="image/*" capture="camera" @change="bank_account_pictureMethod" ref="myImage">
                  </div>
                </div>
              </div>
             <!--Quality information finish-->
             <!--Production Area information begin-->
              <div class="form-group row border">
                <div class="col-md-12">
                    <p>S3-Production Area</p>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">1.Is the workshop clean and organized?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q1Pa">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">2.Are the materials properly arranged?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q2Pa">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">3.Are factory facilities in good working conditions?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q3Pa">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">4.Were production lines producing during the inspection? <span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q4Pa">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">5.Are there any products finished available for the inspector to observe? <span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q5Pa">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 form-control-label" for="text-input">Production line photo 1</label>
                  <div class="col-md-9">
                    <input type="file"  accept="image/*" capture="camera" @change="img1PaMethod" ref="myImage">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 form-control-label" for="text-input">Production line photo 2</label>
                  <div class="col-md-9">
                    <input type="file"  accept="image/*" capture="camera" @change="img2PaMethod" ref="myImage">
                  </div>
                </div>
              </div>
             <!--Production Area information finish-->
             <!--Certificate information begin-->
              <div class="form-group row border">
                <div class="col-md-12">
                    <p>S4-Certificates</p>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">1.Are there any certificates, authentication or registration?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q1Ce">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">2.BSCI, SA8000, ICTI, ISO14001, GS, BRC, IFS, Other?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q2Ce">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">3.Are the facilities in general good condition aligning to the certificate?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q3Ce">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">4.Does the production process match the certificate guidelines?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q4Ce">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">5.Is factory´s appearance in accordance to the certificate?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q5Ce">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 form-control-label" for="text-input">Business license</label>
                  <div class="col-md-9">
                    <input type="file"  accept="image/*" capture="camera" @change="img1CeMethod" ref="myImage">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 form-control-label" for="text-input">Certificate picture</label>
                  <div class="col-md-9">
                    <input type="file"  accept="image/*" capture="camera" @change="img2CeMethod" ref="myImage">
                  </div>
                </div>
              </div>
             <!--Certificate information finish-->
             <!--Production line machine information begin-->
              <div class="form-group row border">
                <div class="col-md-12">
                    <p>S5-Production line machines</p>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">1.Are the machines in good condition?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q1Plm">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">2.Do the machines count with manufacturer´s manual? <span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q2Plm">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">3.Are the machines working properly?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q3Plm">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">4.Do the machines get any maintenance? <span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q4Plm">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">5.Are the operators qualified to manipulate the machinery?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q5Plm">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 form-control-label" for="text-input">Production line machine photo 1</label>
                  <div class="col-md-9">
                    <input type="file"  accept="image/*" capture="camera" @change="img1PlmMethod" ref="myImage">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 form-control-label" for="text-input">Production line machine photo 2</label>
                  <div class="col-md-9">
                    <input type="file"  accept="image/*" capture="camera" @change="img2PlmMethod" ref="myImage">
                  </div>
                </div>
              </div>
             <!--Production line machine information finish-->
             <!--Manufacturing process information begin-->
              <div class="form-group row border">
                <div class="col-md-12">
                    <p>S6-Manufacturing process</p>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">1.Are there written instructions for workers to follow?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q1Mp">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">2.Are there regular Q.C. inspections on products during manufacturing?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q2Mp">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">3.Is there a Q.C. manager supervising during the entire process?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q3Mp">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">4.Are the inspection results recorded?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q4Mp">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">5.Are there approved samples attached to working stations for reference?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q5Mp">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 form-control-label" for="text-input">Manufacturing process photo 1</label>
                  <div class="col-md-9">
                    <input type="file"  accept="image/*" capture="camera" @change="img1MpMethod" ref="myImage">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 form-control-label" for="text-input">Manufacturing process photo 2</label>
                  <div class="col-md-9">
                    <input type="file"  accept="image/*" capture="camera" @change="img2MpMethod" ref="myImage">
                  </div>
                </div>
              </div>
             <!--Manufacturing information finish-->
             <!--Incoming inspections begin-->
              <div class="form-group row border">
                <div class="col-md-12">
                    <p>S7-Incoming inspections</p>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">1.Is Incoming Quality Check (IQC) records or reports available?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q1Iin">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">2.Are there Production Quality Check (PQC) records or reports available?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q2Iin">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">3.Are final inspections (FI) records or reports available?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q3Iin">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">4.Are these records/reports updated?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q4Iin">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">5.Where there Quality Improvement Guidelines (QIG) being implemented?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q5Iin">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 form-control-label" for="text-input">Incoming inspections photo 1</label>
                  <div class="col-md-9">
                    <input type="file"  accept="image/*" capture="camera" @change="img1IinMethod" ref="myImage">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 form-control-label" for="text-input">Incoming inspections photo 2</label>
                  <div class="col-md-9">
                    <input type="file"  accept="image/*" capture="camera" @change="img2IinMethod" ref="myImage">
                  </div>
                </div>
              </div>
             <!--Incoming inspections information finish-->
             <!--Quality management information begin-->
              <div class="form-group row border">
                <div class="col-md-12">
                    <p>S8-Quality management</p>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">1.Is there an independent Q.C. manager or supervisory level person to lead Q.C.   process?  <span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q1Qm">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">2.Is there a formal Quality Control Manual or related quality document being implemented?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q2Qm">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">3.Does the factory employs updated international, national or any specific standards to perform internal Q.C. on the products? <span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q3Qm">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">4.If raw materials need inspection prior to production, are they properly inspected and do they keep records? <span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q4Qm">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">5.Are the defective raw materials properly identified and separated from the functional bash?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q5Qm">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 form-control-label" for="text-input">Quality management photo 1</label>
                  <div class="col-md-9">
                    <input type="file"  accept="image/*" capture="camera" @change="img1QmMethod" ref="myImage">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 form-control-label" for="text-input">Quality management photo 2</label>
                  <div class="col-md-9">
                    <input type="file"  accept="image/*" capture="camera" @change="img2QmMethod" ref="myImage">
                  </div>
                </div>
              </div>
             <!--Quality management information finish-->
             <!--Final inspection information begin-->
              <div class="form-group row border">
                <div class="col-md-12">
                    <p>S9-Final inspection and Q.A</p>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">1.A testing inspection is performed on products before packing?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q1Fi">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">2.Does the factory perform inspection on final products before shipping?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q2Fi">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">3.Are there adequate written criteria/instructions available for inspectors to follow for final inspection?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q3Fi">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">4.Are there records of rejected lots?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q4Fi">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">5.Is the sampling size for final inspection adequate to meet customer´s standards?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q5Fi">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 form-control-label" for="text-input">Final inspection photo 1</label>
                  <div class="col-md-9">
                    <input type="file"  accept="image/*" capture="camera" @change="img1FiMethod" ref="myImage">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 form-control-label" for="text-input">Final inspection photo 2</label>
                  <div class="col-md-9">
                    <input type="file"  accept="image/*" capture="camera" @change="img2FiMethod" ref="myImage">
                  </div>
                </div>
              </div>
             <!--Final inspection information finish-->
             <!--Warehouse information begin-->
              <div class="form-group row border">
                <div class="col-md-12">
                    <p>S10-Warehouse</p>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">1.Does the factory have a raw material and finished product warehouse?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q1Wh">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">2.Are packed master cartons properly stored to avoid damage or contamination?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q2Wh">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">3.Is the warehouse clearly isolated from production areas? <span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q3Wh">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">4.Is the warehouse clean and organized?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q4Wh">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">5.Are raw materials kept in controlled, segregated locations to prevent quality deterioration?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q5Wh">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 form-control-label" for="text-input">Warehouse photo 1</label>
                  <div class="col-md-9">
                    <input type="file"  accept="image/*" capture="camera" @change="img1WhMethod" ref="myImage">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 form-control-label" for="text-input">Warehouse photo 2</label>
                  <div class="col-md-9">
                    <input type="file"  accept="image/*" capture="camera" @change="img2WhMethod" ref="myImage">
                  </div>
                </div>
              </div>
             <!--Warehouse information finish-->
             <!--Emergency information begin-->
              <div class="form-group row border">
                <div class="col-md-12">
                    <p>S11-Emergency facilities</p>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">1.Are there fire extinguishers available and accessible? <span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q1Ef">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">2.Are there fire alarms installed in each working station?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q2Ef">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">3.Are there emergency lights and exit signs installes at all emergency exits?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q3Ef">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">4.Is there an evacuation route marked and visible?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q4Ef">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-5" for="">5.Are there personal protective equipment, and it is perfectly notorious?<span class="required"> * </span></label>
                    <select class="form-control col-md-1 " v-model="q5Ef">
                      <option value="c">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 form-control-label" for="text-input">Emergency facilities photo 1</label>
                  <div class="col-md-9">
                    <input type="file"  accept="image/*" capture="camera" @change="img1EfMethod" ref="myImage">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 form-control-label" for="text-input">Emergency facilities photo 2</label>
                  <div class="col-md-9">
                    <input type="file"  accept="image/*" capture="camera" @change="img2EfMethod" ref="myImage">
                  </div>
                </div>
              </div>
             <!--Emergency information finish-->
             <!--Result begin-->
             <div class="form-group row border">
               <div class="col-md-12">
                   <p>Inspection result</p>
               </div>
               <div class="col-md-4">
                   <div class="form-group">
                     <label for="">Factory cooperates?<span class="required"> * </span></label>
                     <select class="form-control " v-model="fty_cooperate">
                       <option value="3">Choose</option>
                       <option value="1">Yes</option>
                       <option value="2">No</option>
                     </select>
                   </div>
               </div>
               <div class="col-md-4">
                   <div class="form-group">
                     <label for="">Inpection points<span class="required"> * </span></label>
                     <input type="text" class="form-control" v-model.number="result_num" readonly>
                   </div>
               </div>
               <p hidden>${{result_num=sfaPoints}}</p>
               <div class="col-md-4">
                   <div class="form-group">
                     <label for="">Inspection Result<span class="required"> * </span></label>
                     <input type="text" class="form-control" v-model="result" readonly>
                   </div>
               </div>
               <p hidden>${{result=sfaResult}}</p>
               <div class="col-md-12">
                   <div class="form-group">
                     <label for="">Remarks</label>
                     <textarea class="form-control" v-model="remarks" rows="3" placeholder="Enter ..."></textarea>
                   </div>
               </div>
             </div>
             <!--Result finish-->

           <!--Inspection instructions End-->
           <div class="form-group row border">
             <div class="col-md-12">
                 <p>Check Out</p>
             </div>
               <div class="form-group ">
                 <div class="col-md-6">
                    <label  for="text-input">Time</label>
                    <input type="text" v-model="check_out" class="form-control" placeholder="Name of the service">
                 </div>
                 <div class="col-md-6">
                   <div class="form-group">
                    <label for="">Check-Out Photo</label>
                    <input type="file"  accept="image/*" capture="camera" @change="check_outPhMethod" ref="myImage">
                  </div>
                </div>
               </div>
           </div>
           <!--Arrange inspector begin-->
           <div class="form-group row div-error" v-show="errorCheckoutSfa">
             <div class="text-center text-error">
               <div class="" v-for="error in errorShowMessageCheckoutSfa" :key="error" v-text="error"></div>
             </div>
           </div>
             <div class="form-group row">
                 <div class="col-md-12" style="text-align:center">

                     <div v-if="category_name=='CCI'">
                       <button type="button" @click="closeDetail()" class="btn btn-primary">EXIT</button>
                       <button type="button" @click="storeCheckOut(service_id)" class="btn btn-success"><i class="icon-control-play"></i>CHECK OUT</button>
                     </div>
                     <div v-else-if="category_name=='QCI'">
                       <button type="button" @click="closeDetail()" class="btn btn-primary">EXIT</button>
                       <button type="button" @click="openModal('action',category_name)" class="btn btn-danger">COMPLETE REVIEW</button>
                     </div>
                     <div v-else="category_name=='SFA'">
                       <button type="button" @click="closeDetail()" class="btn btn-primary">EXIT</button>
                       <button type="button" @click="storeCheckOutSfa(service_id)" class="btn btn-info"><i class="icon-control-play"></i>CHECK OUT</button>
                     </div>
                 </div>
             </div>
           </div>
         </template>
         <!--Fin detalle SFA-->
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
                              <label class="col-md-6 form-control-label" for="text-input">1.Critical photos were taken completely?</label>
                              <div class="col-md-6">
                                <select class="form-control " v-model.number="mxQone" readonly>
                                  <option value="3">Choose</option>
                                  <option value="2">Yes</option>
                                  <option value="0">No</option>
                                </select>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-6 form-control-label" for="text-input">2.Critical photos were taken clear and legible?</label>
                              <div class="col-md-6">
                                <select class="form-control " v-model.number="mxQtwo" readonly>
                                  <option value="3">Choose</option>
                                  <option value="2">Yes</option>
                                  <option value="0">No</option>
                                </select>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-6 form-control-label" for="text-input">3.Loading photos were taken completely?</label>
                              <div class="col-md-6">
                                <select class="form-control " v-model.number="mxPthree" readonly>
                                  <option value="3">Choose</option>
                                  <option value="1">Yes</option>
                                  <option value="0">No</option>
                                </select>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-6 form-control-label" for="text-input">4.Pallets photos were taken completely?</label>
                              <div class="col-md-6">
                                <select class="form-control " v-model.number="mxPfour" readonly>
                                  <option value="3">Choose</option>
                                  <option value="2">Yes</option>
                                  <option value="0">No</option>
                                </select>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-6 form-control-label" for="text-input">5.Documents were attached completely?</label>
                              <div class="col-md-6">
                                <select class="form-control " v-model.number="mxQfive" readonly>
                                  <option value="3">Choose</option>
                                  <option value="1">Yes</option>
                                  <option value="0">No</option>
                                </select>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-6 form-control-label" for="text-input">6.Inspection requirements were fullfilled complete?</label>
                              <div class="col-md-6">
                                <select class="form-control " v-model.number="mxQSix" readonly>
                                  <option value="3">Choose</option>
                                  <option value="2">Yes</option>
                                  <option value="0">No</option>
                                </select>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label class="col-md-1 form-control-label" for="text-input">Remarks</label>
                              <div class="col-md-11">
                                  <textarea type="text" v-model="mxRemarks"class="form-control" placeholder="Inspection feedback...">
                                  </textarea>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-6 form-control-label" for="text-input">Would you like to submit evidence file?</label>
                              <div class="col-md-6">
                                <select class="form-control " v-model.number="optionEvidence" readonly>
                                  <option value="3">Choose</option>
                                  <option value="1">Yes</option>
                                  <option value="0">No</option>
                                </select>
                              </div>
                          </div>
                          <template v-if="optionEvidence==1">
                            <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Evidence file (Just .doc files accepted): </label>
                              <div class="col-md-9">
                                <input type="file"  accept=".doc" capture="camera" @change="evidenceFile" ref="nceFile">
                              </div>
                            </div>
                          </template>
                          <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Dropbox link: </label>
                            <div class="col-md-9">
                              <input type="text" v-model="db_link" class="form-control" placeholder="Input dropbox link">
                            </div>
                          </div>
                          <div class="form-group row div-error" v-show="errorSfaConfirm">
                            <div class="text-center text-error">
                              <div class="" v-for="error in errorShowMessageSfaConfirm" :key="error" v-text="error"></div>
                            </div>
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                    <div class="col-md-10" style="text-align:center">
                      <button type="button" class="btn btn-secondary" @click="closeModal()">Close</button>
                      <button type="button"class="btn btn-primary" @click="confirmInfoQCI()"><i class="icon-like"></i>Submit Inspection Material</button>

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
            idDet:0,
            idcategory:0,
            idistatus:0,
            idsupplier:0,
            reference:'',
            supplier_number:0,
            inspection_date:0,
            //Variable for make appear and dissapear the add doc question//
            optionEvidence:3,
            //Variable for make appear and dissapear the add doc question//
            // CCI Variables Begin//

            inspection_status:'',
            spare_parts:'0',
            pallet_fumigate:'3',
            fty_cooperate:'3',
            result:'0',
            inspdetail_id:0,
            iddetail:0,
            item_number:0,
            item_cnts:0,
            sp_cnts:0,
            total_cnts:0,
            damaged_cnts:0,
            container_number:'',
            seal_number:'',
            container_numberph:'',
            seal_numberph:'',
            container_damaged:3,
            pallets_loaded:3,
            packing_listPh:'',
            ack_Ph:'',
            c1ack_Ph:'',
            c2ack_Ph:'',
            count_ck_Ph:'',
            remarks:'',
            check_out:'',
            check_outPh:'',
            check_inPh:'',
            inspContPh:'',
            category_name:'',
            //CCI variables finished//
            // QCI Variables Begin//
            aql_level:'0',
            production_status:'0',
            item_number:0,
            inspection_result:'0',
            fty_cooperate:'3',
            remarks:'',
            opened_samplePh:'',
            sealed_samplePh:'',
            product_picture:'',
            sampling_picture:'',
            printed_plPh:'',
            acknowledgmentPh:'',
            arrayDefect:[],
            arrayDefectDetail:[],
            qciactions_id:0,
            errorCheckoutQci:0,
            errorShowMessageCheckoutQci:[],
            fty_cooperateInput:'',
            // QCI Variables Finishes//
            // QCI defects Variables Begin//
            idqciaction:'',
            product_code:'',
            product_description:'',
            sample_size:0,
            minor_defects:0,
            major_defects:0,
            critical_defects:0,
            total:0,
            result:'0',
            // QCI defects Variables Finishes//
            // Sfa Variables begin//
            arrayQuestions:[],
            errorCheckoutSfa:0,
            errorShowMessageCheckoutSfa:[],
            //--S1 variables begin--//
            iddetailone:'',
            name:'',
            address:'',
            website:'',
            telephone:'',
            email:'',
            contact_name:'',
            contact_mobile:'',
            contact_position:'',
            main_product:'',
            main_market:'',
            production_capacity:'',
            registration_date:'',
            type_of_registration:'',
            type_of_company:'',
            employees_number:'',
            result_num:0,
            result:'',
            fty_cooperate:3,
            remarks:'',
            //--S1 variables finish--//
            //--S2 variables begin--//
            iddetailtwo:'',
            customer_country:'',
            factory_area_sqm2:'',
            company_owner:'',
            general_manager:'',
            tax_id:'',
            export_license:'',
            nearest_port:'',
            bank_account_picture:'',
            //--S2 variables finish--//
            //--S3 variables begin--//
            iddetailqone:'',
            q1Pa:'c',
            q2Pa:'c',
            q3Pa:'c',
            q4Pa:'c',
            q5Pa:'c',
            img1Pa:'',
            img2Pa:'',
            //--S3 variables finish--//
            //--S4 variables begin--//
            q1Ce:'c',
            q2Ce:'c',
            q3Ce:'c',
            q4Ce:'c',
            q5Ce:'c',
            img1Ce:'',
            img2Ce:'',
            //--S4 variables finish--//
            //--S5 variables begin--//
            iddetailqtwo:'',
            q1Plm:'c',
            q2Plm:'c',
            q3Plm:'c',
            q4Plm:'c',
            q5Plm:'c',
            img1Plm:'',
            img2Plm:'',
            //--S5 variables finish--//
            //--S6 variables begin--//
            q1Mp:'c',
            q2Mp:'c',
            q3Mp:'c',
            q4Mp:'c',
            q5Mp:'c',
            img1Mp:'',
            img2Mp:'',
            //--S6 variables finish--//
            //--S7 variables begin--//
            iddetailqthree:'',
            q1Iin:'c',
            q2Iin:'c',
            q3Iin:'c',
            q4Iin:'c',
            q5Iin:'c',
            img1Iin:'',
            img2Iin:'',
            //--S7 variables finish--//
            //--S8 variables begin--//
            q1Qm:'c',
            q2Qm:'c',
            q3Qm:'c',
            q4Qm:'c',
            q5Qm:'c',
            img1Qm:'',
            img2Qm:'',
            //--S8 variables finish--//
            //--S9 variables begin--//
            iddetailqfour:'',
            q1Fi:'c',
            q2Fi:'c',
            q3Fi:'c',
            q4Fi:'c',
            q5Fi:'c',
            img1Fi:'',
            img2Fi:'',
            //--S9 variables finish--//
            //--S10 variables begin--//
            q1Wh:'c',
            q2Wh:'c',
            q3Wh:'c',
            q4Wh:'c',
            q5Wh:'c',
            img1Wh:'',
            img2Wh:'',
            //--S10 variables finish--//
            //--S11 variables begin--//
            iddetailqfive:'',
            q1Ef:'c',
            q2Ef:'c',
            q3Ef:'c',
            q4Ef:'c',
            q5Ef:'c',
            img1Ef:'',
            img2Ef:'',
            //--S11 variables finish--//

            //--Scores--/
            mxQone:3,
            mxQtwo:3,
            mxEtwo:'',
            mxPthree:3,
            mxPfour:3,
            mxQfive:3,
            mxQSix:3,
            mxRemarks:'',
            mxScore:0,
            db_link:'',
            errorShowMessageSfaConfirm:[],
            errorSfaConfirm:0,
            // Sfa Variables Finish//
            arrayService:[],
            arrayCategory:[],
            arraySupplier:[],
            arrayCustomer:[],
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
            errorCheckout:0,
            errorShowMessageCheckout:[],
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
          calculateTotalCtns: function(){
            var result=0;
            result = this.item_cnts + this.sp_cnts;
            return result;
          },
          sfaPoints: function(){

            var resultP = 0;
            resultP =
            +this.q1Pa+
            +this.q2Pa+
            +this.q3Pa+
            +this.q4Pa+
            +this.q5Pa+
            +this.q1Ce+
            +this.q2Ce+
            +this.q3Ce+
            +this.q4Ce+
            +this.q5Ce+
            +this.q1Plm+
            +this.q2Plm+
            +this.q3Plm+
            +this.q4Plm+
            +this.q5Plm+
            +this.q1Mp+
            +this.q2Mp+
            +this.q3Mp+
            +this.q4Mp+
            +this.q5Mp+
            +this.q1Iin+
            +this.q2Iin+
            +this.q3Iin+
            +this.q4Iin+
            +this.q5Iin+
            +this.q1Qm+
            +this.q2Qm+
            +this.q3Qm+
            +this.q4Qm+
            +this.q5Qm+
            +this.q1Fi+
            +this.q2Fi+
            +this.q3Fi+
            +this.q4Fi+
            +this.q5Fi+
            +this.q1Wh+
            +this.q2Wh+
            +this.q3Wh+
            +this.q4Wh+
            +this.q5Wh+
            +this.q1Ef+
            +this.q2Ef+
            +this.q3Ef+
            +this.q4Ef+
            +this.q5Ef;

            return resultP;
          },
          sfaResult: function(){

            var result2='';

            if(this.result_num<=9)
            {
              result2="Non Compliance"

            }else if(this.result_num>9 && this.result_num<=18){

              result2="Below Average"

            }else if(this.result_num>18 && this.result_num<=27){

              result2="Average"

            }else if(this.result_num>27 && this.result_num<=36){

              result2="Good"

            }else{

              result2="Excellent"
            }

            return result2;
          },
        },
        methods:{
          listService(page,search,criteria){
            let me = this;
            var url= 'report/indexQci?page=' + page + '&search=' + search + '&criteria=' + criteria;

            axios.get(url).then(function (response) {
                var respuesta=response.data;

                me.arrayService = respuesta.services.data;

                me.pagination = respuesta.pagination;
              })
              .catch(function (error) {

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
            this.mxQone=3;
            this.mxQtwo=3;
            this.mxPthree=3;
            this.mxPfour=3;
            this.mxQfive=3;
            this.mxQSix=3;
            this.optionEvidence = 3;
            this.mxRemarks='';
            this.db_link='';
            if(!this.mxEtwo){
            }else{
              this.$refs.nceFile.value = '';
            }
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
                      this.modalTitle = 'SCORE & FEEDBACK ASSIGNMENT';
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
           this.inspection_date=data['inspection_date'];
           this.sup_instructions=data['sup_intructions'];
           this.instructions=data['instructions'];
           this.inspdetail_id=data['inspdetails_id'];
           this.check_in= data['check_in'];
           this.check_out= data['check_out'];
           this.check_outPh= data['check_outPh'];
           this.check_inPh= data['check_inPh'];
           //this.check_out = new Date().toLocaleTimeString();

           var id = this.service_id;
           var idDet = this.inspdetail_id;
           var url='score/indexScoreUp?idDet=' + idDet;
           var idi;
           var idi2;

           var self=this;
           //AXIOS REQUEST TO GET THE ARRAY DETAIL//
            axios.get(url).then(function (response){
               var respuesta = response.data;
               me.arrayDetail= respuesta.cciDetail;

            }).then(function (response) {

              self.item_number=me.arrayDetail[0]['item_number'];
              self.item_number= me.arrayDetail[0]['item_number'];
              self.spare_parts= me.arrayDetail[0]['spare_parts'];
              self.item_cnts= me.arrayDetail[0]['item_cnts'];
              self.sp_cnts= me.arrayDetail[0]['sp_cnts'];
              self.total_cnts= me.arrayDetail[0]['total_cnts'];
              self.damaged_cnts= me.arrayDetail[0]['damaged_cnts'];
              self.pallet_fumigate= me.arrayDetail[0]['pallet_fumigate'];
              self.pallets_loaded= me.arrayDetail[0]['pallets_loaded'];
              self.container_number= me.arrayDetail[0]['container_number'];
              self.seal_number= me.arrayDetail[0]['seal_number'];
              self.container_numberph= me.arrayDetail[0]['container_numberph'];
              self.seal_numberph= me.arrayDetail[0]['seal_numberph'];
              self.fty_cooperate= me.arrayDetail[0]['fty_cooperate'];
              self.container_damaged= me.arrayDetail[0]['container_damaged'];
              self.result= me.arrayDetail[0]['result'];
              self.remarks= me.arrayDetail[0]['remarks'];
              self.packing_listPh= me.arrayDetail[0]['packing_listPh'];
              self.ack_Ph= me.arrayDetail[0]['ack_Ph'];
              self.c1ack_Ph= me.arrayDetail[0]['c1ack_Ph'];
              self.c2ack_Ph= me.arrayDetail[0]['c2ack_Ph'];
              self.count_ck_Ph= me.arrayDetail[0]['count_ck_Ph']
              self.inspContPh= me.arrayDetail[0]['inspContPh'];


            }).catch(function(error){
              console.log(error);
            });
          },
          getCheckOutPh(){
            return "./files/"+ this.check_outPh;
          },
          getCheckInPh(){
            return "./files/"+ this.check_inPh;
          },
          confirmInfo(){
            let me=this;
            var ids = this.service_id;
            var idDet = this.inspdetail_id;

            if(this.validateCheckout())
            {
              return;
            }
            axios.put('score/confirmInfo',{

              'ids':ids,
              'idcci': idDet,
              'item_number':this.item_number,
              'spare_parts':this.spare_parts,
              'item_cnts':this.item_cnts,
              'sp_cnts':this.sp_cnts,
              'total_cnts':this.total_cnts,
              'damaged_cnts':this.damaged_cnts,
              'pallet_fumigate':this.pallet_fumigate,
              'pallets_loaded':this.pallets_loaded,
              'container_number':this.container_number,
              'seal_number':this.seal_number,
              'container_numberph':this.container_numberph,
              'seal_numberph':this.seal_numberph,
              'fty_cooperate':this.fty_cooperate,
              'container_damaged':this.container_damaged,
              'result':this.result,
              'remarks':this.remarks,

              }).then(function (response) {
                me.closeDetail();
                me.listService(1,'','name');
              })
              .catch(function (error) {
                console.log(error);
              });

          },
          closeDetail(){
           this.errorShowMessageCheckout=[];
           this.fty_cooperateInput='';
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
                axios.put('action/storeCheckIn',{

                  'idservice': ids,
                  'check_inPh': this.check_inPh,

                  }).then(function (response) {
                    me.closeModal();
                    me.closeDetail();
                    me.listService(1,'','name');
                    swalWithBootstrapButtons(
                      'Please confirm with your captain!',
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
          contNumPh(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.container_numberph = e.target.result;
              }
          },
          sealNumPh(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.seal_numberph = e.target.result;
              }
          },
          imagePL(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.packing_listPh = e.target.result;
              }
          },
          imageAcknow(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.ack_Ph = e.target.result;
              }
          },
          imageC1(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.c1ack_Ph = e.target.result;
              }
          },
          imageC2(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.c2ack_Ph = e.target.result;
              }
          },
          imageCounting(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.count_ck_Ph = e.target.result;
              }
          },
          imageCkout(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.check_outPh = e.target.result;
              }
          },
          imageinspContPh(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.inspContPh = e.target.result;
              }
          },
          validateCheckout(){

            this.errorCheckout=0;
            this.errorShowMessageCheckout=[];

            if(!this.item_number) this.errorShowMessageCheckout.push("Input the number of unique items");
            if(this.spare_parts==0) this.errorShowMessageCheckout.push("Confirm if spare parts were loaded");
            if(!this.item_cnts) this.errorShowMessageCheckout.push("Input the final number of item loaded ctns");
            if(this.sp_cnts<0) this.errorShowMessageCheckout.push("Input the final number of spare parts loaded ctns");
            if(this.damaged_cnts<0) this.errorShowMessageCheckout.push("Input the number of damaged ctns");
            if(this.pallets_loaded==3) this.errorShowMessageCheckout.push("Confirm whether or not pallets were loaded");
            if(!this.container_number) this.errorShowMessageCheckout.push("Input the container number");
            if(!this.seal_number) this.errorShowMessageCheckout.push("Input the seal number");
            if(this.container_damaged==3) this.errorShowMessageCheckout.push("Confirm whether or not container is damaged");
            if(!this.container_numberph) this.errorShowMessageCheckout.push("Attach a photo of container number");
            if(!this.seal_numberph) this.errorShowMessageCheckout.push("Attach a photo of seal number");
            if(!this.packing_listPh) this.errorShowMessageCheckout.push("Attach a photo of printed packing list");
            if(!this.ack_Ph) this.errorShowMessageCheckout.push("Attach a photo of the inspection acknowledgment");
            if(!this.inspContPh) this.errorShowMessageCheckout.push("Take a photo next to the closed container");
            if(!this.c1ack_Ph) this.errorShowMessageCheckout.push("Attach a photo of container acknowledgement 1");
            if(!this.c2ack_Ph) this.errorShowMessageCheckout.push("Attach a photo of container acknowledgement 2");
            if(!this.count_ck_Ph) this.errorShowMessageCheckout.push("Attach a photo of the counting acknowledgment");
            if(this.fty_cooperate==3) this.errorShowMessageCheckout.push("Confirm if factory cooperate or not during the inspection");
            if(this.result==0) this.errorShowMessageCheckout.push("Input the inspection result");
            if(!this.check_outPh) this.errorShowMessageCheckout.push("Please take a selfie photo before leave the factory!");

            if(this.errorShowMessageCheckout.length) this.errorCheckout = 1;

            return this.errorCheckout;
          },
          storeCheckOut(ids){
                if(this.validateCheckout())
                {
                  return;
                }

                  const swalWithBootstrapButtons = swal.mixin({
                  confirmButtonClass: 'btn btn-success',
                  cancelButtonClass: 'btn btn-danger',
                  buttonsStyling: false,
                   })

                swalWithBootstrapButtons({
                  title: 'Are you sure to Check out?',
                  text: "Please double check your information!",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Yes, confirm!',
                  cancelButtonText: 'No, Way!',
                  reverseButtons: true
                }).then((result) => {
                  if (result.value) {

                    let me=this;
                    var idi3 = me.arrayInspDetail['id'];

                    axios.put('onaction/storeCheckOut',{
                      'idservice': ids,
                      'iddetail':me.arrayInspDetail['id'],
                      'item_number': this.item_number,
                      'spare_parts': this.spare_parts,
                      'item_cnts': this.item_cnts,
                      'sp_cnts': this.sp_cnts,
                      'total_cnts': this.total_cnts,
                      'damaged_cnts': this.damaged_cnts,
                      'pallet_fumigate': this.pallet_fumigate,
                      'pallets_loaded': this.pallets_loaded,
                      'container_number': this.container_number,
                      'seal_number': this.seal_number,
                      'container_numberph': this.container_numberph,
                      'seal_numberph': this.seal_numberph,
                      'fty_cooperate': this.fty_cooperate,
                      'container_damaged': this.container_damaged,
                      'result': this.result,
                      'remarks': this.remarks,
                      'packing_listPh': this.packing_listPh,
                      'ack_Ph': this.ack_Ph,
                      'c1ack_Ph': this.c1ack_Ph,
                      'c2ack_Ph' : this.c2ack_Ph,
                      'count_ck_Ph': this.count_ck_Ph,
                      'check_outPh': this.check_outPh,
                      'inspContPh' : this.inspContPh

                      }).then(function (response) {

                        me.closeDetail();
                        me.listService(1,'','name');
                        swalWithBootstrapButtons(
                          'Good work soldier!',
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
          openDetailQci(data=[]){
            let me=this;
            this.listado=2;
            this.service_id=data['id'];
            this.idDet = data['inspdetails_id'];
            this.reference=data['reference'];
            this.category_name=data['category_name'];
            this.inspection_date=data['inspection_date']
            this.inspdetail_id=data['inspdetails_id'];
            this.qciactions_id=data['qciactions_id'];
            this.aql_level=data['aql_level'];
            this.production_status=data['production_status'];
            this.item_number=data['item_number'];
            this.printed_plPh=data['printed_plPh'];
            this.acknowledgmentPh=data['acknowledgmentPh'];
            this.check_out = new Date().toLocaleTimeString();
            this.opened_samplePh=data['opened_samplePh'];
            this.sealed_samplePh=data['sealed_samplePh'];
            this.sampling_picture=data['sampling_picture'];
            this.inspection_result=data['inspection_result'];
            this.fty_cooperate=data['fty_cooperate'];
            this.remarks=data['remarks'];
            this.check_in=data['check_in'];
            this.check_out=data['check_out'];
            this.check_outPh=data['check_outPh'];
            this.check_inPh=data['check_inPh'];
            var id = this.service_id;
            var idDet = this.inspdetail_id;
            var idDef = this.qciactions_id;
            var url='score/getDefectQci?idDef=' + idDef;
            var idi;
            var idi2;

            if(this.fty_cooperate==1)
            {
              this.fty_cooperateInput="Yes";
            }else{
              this.fty_cooperateInput="No";
            }
            //AXIOS REQUEST TO GET THE ARRAY DETAIL//
             axios.get(url).then(function (response){
                var respuesta = response.data;
                me.arrayDefectDetail= respuesta.qciDetail;
             }).then(function (response) {
                 var urlGd='onaction/getDetail?id=' + id +'&iduser=' + idi;
                 axios.get(urlGd).then(function (response){
                 var respuesta1 = response.data;
                 me.arrayInspDetail= respuesta1.inspdetail;
                 idi2 = me.arrayInspDetail['id'];

             })}).catch(function(error){
               console.log(error);
             });

          },
          addNewDefect(){
            if(this.validateAddNew())
            {
              return;
            }
              const swalWithBootstrapButtons = swal.mixin({
              confirmButtonClass: 'btn btn-success',
              cancelButtonClass: 'btn btn-danger',
              buttonsStyling: false,
               })

            swalWithBootstrapButtons({
              title: 'Are you sure to add this new defects?',
              text: "Please double check your information!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, confirm!',
              cancelButtonText: 'No, Way!',
              reverseButtons: true
                }).then((result) => {
                  if (result.value) {
                  let me=this;
                  var idDef = this.qciactions_id;
                //var idi3 = me.arrayInspDetail['id'];

                axios.put('score/addNewDefect',{
                  'idqciaction': idDef,
                  'arrayDefect':this.arrayDefect,
                  }).then(function (response) {
                    me.cleanNewDefect();
                    me.closeDetail();
                    me.listService(1,'','name');

                    swalWithBootstrapButtons(
                      'Great!',
                      'Your defect has been added',

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
          validateAddNew(){
            this.errorCheckoutQci=0;
            this.errorShowMessageCheckoutQci=[];
            if(this.arrayDefect.length==0) this.errorShowMessageCheckoutQci.push("Input at least one new item with defects");
            if(this.errorShowMessageCheckoutQci.length) this.errorCheckoutQci = 1;
            return this.errorCheckoutQci;
          },
          cleanNewDefect(){
             this.arrayDefect=[];
           },
          deleteDefectEdit(id,index){
                var iddelete = id;
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
              })

              swalWithBootstrapButtons({
                title: 'Are you sure to delete this defect?',
                text: "You cannot recover it after delete!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, desactivate it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  let me=this;
                  me.arrayDefectDetail.splice(index,1);
                  axios.put('score/deleteDefectEdit',{

                    'id': iddelete,


                    }).then(function (response) {

                      //me.listService(1,'','name');
                      swalWithBootstrapButtons(
                        'Deleted!',
                        'This defect has been deleted',
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
          getSamplingPh(){
            return "./files/"+ this.sampling_picture;
          },
          getOpenedSamplePh(){
            return "./files/"+ this.opened_samplePh;
          },
          getSealedSamplePh(){
            return "./files/"+ this.sealed_samplePh;
          },
          openDetailSfa(data=[]){

            let me=this;
            this.listado=3;
            this.service_id=data['id'];
            this.reference=data['reference'];
            this.category_name=data['category_name'];
            this.inspection_date=data['inspection_date'];
            this.sup_instructions=data['sup_intructions'];
            this.instructions=data['instructions'];
            this.check_out = new Date().toLocaleTimeString();
            var id = this.service_id;
            var url='assign/getDetailsAssigned?id=' + id;
            var idi;
            var idi2;
            //AXIOS REQUEST TO GET THE ARRAY DETAIL//
             axios.get(url).then(function (response){
                var respuesta = response.data;
                me.arrayDetail= respuesta.details;
                idi = me.arrayDetail[0]['idinspector'];

             }).then(function (response) {
                 var urlGd='onaction/getDetail?id=' + id +'&iduser=' + idi;
                 axios.get(urlGd).then(function (response){
                 var respuesta1 = response.data;
                 me.arrayInspDetail= respuesta1.inspdetail;
                 idi2 = me.arrayInspDetail['id'];

             })}).catch(function(error){
               console.log(error);
             });

          },
          addDefect(){
              let me=this;

              if(me.product_code==''
                ||me.product_description==''
                ||me.sample_size<0
                ||me.minor_defects<0
                ||me.major_defects<0
                ||me.major_defects<0
                ||me.critical_defects<0
                ||me.result=='0'){
              }
              else{
              me.arrayDefect.push({
                product_code:me.product_code,
                product_description:me.product_description,
                sample_size:me.sample_size,
                minor_defects:me.minor_defects,
                major_defects:me.major_defects,
                critical_defects:me.critical_defects,
                total:me.minor_defects+me.major_defects+me.critical_defects,
                result:me.result,
                //las variables en blanco son las variables del arreglo
              });
              me.product_code="";
              me.product_description="";
              me.sample_size=0;
              me.minor_defects=0;
              me.major_defects=0;
              me.critical_defects=0;
              me.total=0;
              me.result="0";
            }
          },
          deleteDefect(index){
            let me=this;
            me.arrayDefect.splice(index,1);
          },
          validateCheckoutQci(){

            this.errorCheckoutQci=0;
            this.errorShowMessageCheckoutQci=[];

            if(this.aql_level==0) this.errorShowMessageCheckoutQci.push("Select the inspection standard");
            if(this.item_number<=0) this.errorShowMessageCheckoutQci.push("Input the number of unique items");
            if(this.production_status==0) this.errorShowMessageCheckoutQci.push("Select the status of production");
            if(!this.acknowledgmentPh) this.errorShowMessageCheckoutQci.push("Attach a photo of acknowledgment");
            if(!this.printed_plPh) this.errorShowMessageCheckoutQci.push("Attach a photo of printed packing list");
            if(!this.sampling_picture) this.errorShowMessageCheckoutQci.push("Attach a photo of the warehouse and selected samples");
            if(!this.opened_samplePh) this.errorShowMessageCheckoutQci.push("Attach a photo of the openend samples");
            if(!this.sealed_samplePh) this.errorShowMessageCheckoutQci.push("Attach a photo of the sealed samples");
            if(this.fty_cooperate==3) this.errorShowMessageCheckoutQci.push("Select wether factory cooperate or not");
            if(this.inspection_result==0) this.errorShowMessageCheckoutQci.push("Select the inspection result");
            if(!this.check_outPh) this.errorShowMessageCheckoutQci.push("Please take a selfie photo before leave the factory!");

            if(this.errorShowMessageCheckoutQci.length) this.errorCheckoutQci = 1;

            return this.errorCheckoutQci;

          },
          validateScoreQCI(){

            this.errorSfaConfirm=0;
            this.errorShowMessageSfaConfirm=[];

            var docType = this.mxEtwo;
            var n = docType.includes("/msword");

            if(this.mxQone==3) this.errorShowMessageSfaConfirm.push("Answer question number 1");
            if(this.mxQtwo==3) this.errorShowMessageSfaConfirm.push("Answer question number 2");
            if(this.mxPthree==3) this.errorShowMessageSfaConfirm.push("Answer question number 3");
            if(this.mxPfour==3) this.errorShowMessageSfaConfirm.push("Answer question number 4");
            if(this.mxQfive==3) this.errorShowMessageSfaConfirm.push("Answer question number 5");
            if(this.mxQSix==3) this.errorShowMessageSfaConfirm.push("Answer question number 6");
            if(!this.db_link) this.errorShowMessageSfaConfirm.push("Input report link");

            if(this.optionEvidence==1)
            {
              if(!this.mxEtwo) this.errorShowMessageSfaConfirm.push("Attach the corresponding evidence file");
              if(n==false) this.errorShowMessageSfaConfirm.push("The format file must be .doc");
            }

            if(this.errorShowMessageSfaConfirm.length) this.errorSfaConfirm = 1;
            return this.errorSfaConfirm;

          },
          confirmInfoQCI(){
                if(this.validateScoreQCI())
                {
                  return;
                }

                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                 })
                  swalWithBootstrapButtons({
                    title: 'Would you like to confirm that inspection report has been completed?',
                    text: "Please double check your information!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, confirm!',
                    cancelButtonText: 'No, Way!',
                    reverseButtons: true
                      }).then((result) => {
                        if (result.value) {
                        let me=this;

                        this.mxScore = (this.mxQone + this.mxQtwo + this.mxPthree + this.mxPfour + this.mxQfive + this.mxQSix) * .70;
                        axios.put('report/newSfaScore',{

                          'iddetail':this.idDet,
                          'idservice':this.service_id,
                          'mxQone':this.mxQone,
                          'mxQtwo':this.mxQtwo,
                          'mxEtwo':this.mxEtwo,
                          'mxPthree':this.mxPthree,
                          'mxPfour':this.mxPfour,
                          'mxQfive':this.mxQfive,
                          'mxQSix':this.mxQSix,
                          'mxRemarks':this.mxRemarks,
                          'mxScore':this.mxScore,
                          'db_link':this.db_link

                        }).then(function (response) {


                          me.closeModal();
                          me.closeDetail();
                          me.listService(1,'','name');

                          swalWithBootstrapButtons(
                            'Great!',
                            'Inspection moved succesfully',
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
          evidenceFile(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.mxEtwo = e.target.result;
              }
          },
          imageAcknow(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.acknowledgmentPh = e.target.result;
              }
          },
          imagePL(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.printed_plPh = e.target.result;
              }
          },
          imageProduct(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.product_picture = e.target.result;
              }
          },
          imageSample(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.sampling_picture = e.target.result;
              }
          },
          imageOpSample(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.opened_samplePh = e.target.result;
              }
          },
          imageClSample(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.sealed_samplePh = e.target.result;
              }
          },
          imageCkOutQci(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.check_outPh = e.target.result;
              }
          },
          storeCheckOutQci(ids){
            if(this.validateCheckoutQci())
            {
              return;
            }

              const swalWithBootstrapButtons = swal.mixin({
              confirmButtonClass: 'btn btn-success',
              cancelButtonClass: 'btn btn-danger',
              buttonsStyling: false,
               })

            swalWithBootstrapButtons({
              title: 'Are you sure to Check out?',
              text: "Please double check your information!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, confirm!',
              cancelButtonText: 'No, Way!',
              reverseButtons: true
                }).then((result) => {
                  if (result.value) {
                let me=this;
                var idi3 = me.arrayInspDetail['id'];

                axios.put('onaction/storeCheckOutQci',{
                  'idservice': ids,
                  'iddetail':me.arrayInspDetail['id'],
                  'aql_level':this.aql_level,
                  'item_number':this.item_number,
                  'production_status':this.production_status,
                  'arrayDefect':this.arrayDefect,
                  'acknowledgmentPh':this.acknowledgmentPh,
                  'printed_plPh':this.printed_plPh,
                  'product_picture':this.product_picture,
                  'sampling_picture':this.sampling_picture,
                  'opened_samplePh':this.opened_samplePh,
                  'sealed_samplePh':this.sealed_samplePh,
                  'fty_cooperate':this.fty_cooperate,
                  'inspection_result':this.inspection_result,
                  'check_outPh':this.check_outPh,
                  'remarks':this.remarks,
                  }).then(function (response) {

                    me.closeDetail();
                    me.listService(1,'','name');
                    swalWithBootstrapButtons(
                      'Good work soldier!',
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
          storeCheckOutSfa(ids){
            if(this.validateCheckoutSfa())
            {
              return;
            }
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                 })

              swalWithBootstrapButtons({
                title: 'Are you sure to Check out?',
                text: "Please double check your information!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, confirm!',
                cancelButtonText: 'No, Way!',
                reverseButtons: true
                  }).then((result) => {
                    if (result.value) {
                  let me=this;
                  var idi3 = me.arrayInspDetail['id'];

                  axios.put('onaction/storeCheckOutSfa',{
                    'idservice': ids,
                    'iddetail':me.arrayInspDetail['id'],
                    'name':this.name,
                    'address':this.address,
                    'website':this.website,
                    'telephone':this.telephone,
                    'email':this.email,
                    'contact_name':this.contact_name,
                    'contact_mobile':this.contact_mobile,
                    'contact_position':this.contact_position,
                    'main_product':this.main_product,
                    'main_market':this.main_market,
                    'production_capacity':this.production_capacity,
                    'registration_date':this.registration_date,
                    'type_of_registration':this.type_of_registration,
                    'type_of_company':this.type_of_company,
                    'employees_number':this.employees_number,
                    'customer_country':this.customer_country,
                    'factory_area_sqm2':this.factory_area_sqm2,
                    'company_owner':this.company_owner,
                    'general_manager':this.general_manager,
                    'tax_id':this.tax_id,
                    'export_license':this.export_license,
                    'nearest_port':this.nearest_port,
                    'bank_account_picture':this.bank_account_picture,
                    'q1Pa':this.q1Pa,
                    'q2Pa':this.q2Pa,
                    'q3Pa':this.q3Pa,
                    'q4Pa':this.q4Pa,
                    'q5Pa':this.q5Pa,
                    'img1Pa':this.img1Pa,
                    'img2Pa':this.img2Pa,
                    'q1Ce':this.q1Ce,
                    'q2Ce':this.q2Ce,
                    'q3Ce':this.q3Ce,
                    'q4Ce':this.q4Ce,
                    'q5Ce':this.q5Ce,
                    'img1Ce':this.img1Ce,
                    'img2Ce':this.img2Ce,
                    'q1Plm':this.q1Plm,
                    'q2Plm':this.q2Plm,
                    'q3Plm':this.q3Plm,
                    'q4Plm':this.q4Plm,
                    'q5Plm':this.q5Plm,
                    'img1Plm':this.img1Plm,
                    'img2Plm':this.img2Plm,
                    'q1Mp':this.q1Mp,
                    'q2Mp':this.q2Mp,
                    'q3Mp':this.q3Mp,
                    'q4Mp':this.q4Mp,
                    'q5Mp':this.q5Mp,
                    'img1Mp':this.img1Mp,
                    'img2Mp':this.img2Mp,
                    'q1Iin':this.q1Iin,
                    'q2Iin':this.q2Iin,
                    'q3Iin':this.q3Iin,
                    'q4Iin':this.q4Iin,
                    'q5Iin':this.q5Iin,
                    'img1Iin':this.img1Iin,
                    'img2Iin':this.img2Iin,
                    'q1Qm':this.q1Qm,
                    'q2Qm':this.q2Qm,
                    'q3Qm':this.q3Qm,
                    'q4Qm':this.q4Qm,
                    'q5Qm':this.q5Qm,
                    'img1Qm':this.img1Qm,
                    'img2Qm':this.img2Qm,
                    'q1Fi':this.q1Fi,
                    'q2Fi':this.q2Fi,
                    'q3Fi':this.q3Fi,
                    'q4Fi':this.q4Fi,
                    'q5Fi':this.q5Fi,
                    'img1Fi':this.img1Fi,
                    'img2Fi':this.img2Fi,
                    'q1Wh':this.q1Wh,
                    'q2Wh':this.q2Wh,
                    'q3Wh':this.q3Wh,
                    'q4Wh':this.q4Wh,
                    'q5Wh':this.q5Wh,
                    'img1Wh':this.img1Wh,
                    'img2Wh':this.img2Wh,
                    'q1Ef':this.q1Ef,
                    'q2Ef':this.q2Ef,
                    'q3Ef':this.q3Ef,
                    'q4Ef':this.q4Ef,
                    'q5Ef':this.q5Ef,
                    'img1Ef':this.img1Ef,
                    'img2Ef':this.img2Ef,
                    'check_outPh':this.check_outPh,
                    'result_num':this.result_num,
                    'remarks':this.remarks,
                    'result':this.result,
                    'fty_cooperate':this.fty_cooperate


                    }).then(function (response) {

                      me.closeDetail();
                      me.listService(1,'','name');
                      swalWithBootstrapButtons(
                        'Good work soldier!',
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
          validateCheckoutSfa(){
            this.errorCheckoutSfa=0;
            this.errorShowMessageCheckoutSfa=[];

            // Begin general information validation
            if(!this.name) this.errorShowMessageCheckoutSfa.push("Input a factory name");
            if(!this.address) this.errorShowMessageCheckoutSfa.push("Input an address");
            if(!this.website) this.errorShowMessageCheckoutSfa.push("Input a website");
            if(!this.telephone) this.errorShowMessageCheckoutSfa.push("Input a telephone");
            if(!this.email) this.errorShowMessageCheckoutSfa.push("Input an email");
            if(!this.contact_name) this.errorShowMessageCheckoutSfa.push("Input the contact name of factory");
            if(!this.contact_mobile) this.errorShowMessageCheckoutSfa.push("Input the phone of the contact in factory");
            if(!this.contact_position) this.errorShowMessageCheckoutSfa.push("Input the position of the contact in factory");
            if(!this.main_product) this.errorShowMessageCheckoutSfa.push("Input the main product");
            if(!this.main_market) this.errorShowMessageCheckoutSfa.push("Input the main market");
            if(!this.production_capacity) this.errorShowMessageCheckoutSfa.push("Input the production capacity");
            if(!this.registration_date) this.errorShowMessageCheckoutSfa.push("Input the registration date");
            if(!this.type_of_registration) this.errorShowMessageCheckoutSfa.push("Input the type of registration");
            if(!this.type_of_company) this.errorShowMessageCheckoutSfa.push("Input the type of company");
            if(!this.employees_number) this.errorShowMessageCheckoutSfa.push("Input the number of employees");
            if(!this.customer_country) this.errorShowMessageCheckoutSfa.push("Input the country of customers");
            if(!this.factory_area_sqm2) this.errorShowMessageCheckoutSfa.push("Input the area of factory in sqm2");
            if(!this.company_owner) this.errorShowMessageCheckoutSfa.push("Input the name of the company owner");
            if(!this.general_manager) this.errorShowMessageCheckoutSfa.push("Input the name of the general manager");
            if(!this.tax_id) this.errorShowMessageCheckoutSfa.push("Input the tax ID");
            if(!this.export_license) this.errorShowMessageCheckoutSfa.push("Input the export licence number");
            if(!this.nearest_port) this.errorShowMessageCheckoutSfa.push("Input the nearest port name");
            if(!this.bank_account_picture) this.errorShowMessageCheckoutSfa.push("Input the picture of the bank account");
            // Finish general information validation

            // Begin section 3 validation
            if(this.q1Pa=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 1 in Section 3");
            if(this.q2Pa=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 2 in Section 3");
            if(this.q3Pa=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 3 in Section 3");
            if(this.q4Pa=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 4 in Section 3");
            if(this.q5Pa=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 5 in Section 3");
            if(!this.img1Pa) this.errorShowMessageCheckoutSfa.push("Attach a photo of production area 1");
            if(!this.img2Pa) this.errorShowMessageCheckoutSfa.push("Attach a photo of production area 2");
            // Finish section 3 validation

            // Begin section 4 validation
            if(this.q1Ce=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 1 in Section 4");
            if(this.q2Ce=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 2 in Section 4");
            if(this.q3Ce=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 3 in Section 4");
            if(this.q4Ce=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 4 in Section 4");
            if(this.q5Ce=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 5 in Section 4");
            if(!this.img1Ce) this.errorShowMessageCheckoutSfa.push("Attach a photo of Business licence");
            if(!this.img2Ce) this.errorShowMessageCheckoutSfa.push("Attach a photo of Certificate");
            // Finish section 4 validation

            // Begin section 5 validation
            if(this.q1Plm=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 1 in Section 5");
            if(this.q2Plm=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 2 in Section 5");
            if(this.q3Plm=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 3 in Section 5");
            if(this.q4Plm=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 4 in Section 5");
            if(this.q5Plm=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 5 in Section 5");
            if(!this.img1Plm) this.errorShowMessageCheckoutSfa.push("Attach a photo of production line machines 1");
            if(!this.img2Plm) this.errorShowMessageCheckoutSfa.push("Attach a photo of production line machines 2");
            // Finish section 5 validation

            // Begin section 6 validation
            if(this.q1Mp=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 1 in Section 6");
            if(this.q2Mp=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 2 in Section 6");
            if(this.q3Mp=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 3 in Section 6");
            if(this.q4Mp=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 4 in Section 6");
            if(this.q5Mp=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 5 in Section 6");
            if(!this.img1Mp) this.errorShowMessageCheckoutSfa.push("Attach a photo of manufacturing process 1");
            if(!this.img2Mp) this.errorShowMessageCheckoutSfa.push("Attach a photo of manufacturing process 2");
            // Finish section 6 validation

            // Begin section 7 validation
            if(this.q1Iin=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 1 in Section 7");
            if(this.q2Iin=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 2 in Section 7");
            if(this.q3Iin=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 3 in Section 7");
            if(this.q4Iin=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 4 in Section 7");
            if(this.q5Iin=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 5 in Section 7");
            if(!this.img1Iin) this.errorShowMessageCheckoutSfa.push("Attach a photo of incoming inspections 1");
            if(!this.img2Iin) this.errorShowMessageCheckoutSfa.push("Attach a photo of incoming inspections 2");
            // Finish section 7 validation

            // Begin section 8 validation
            if(this.q1Qm=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 1 in Section 8");
            if(this.q2Qm=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 2 in Section 8");
            if(this.q3Qm=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 3 in Section 8");
            if(this.q4Qm=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 4 in Section 8");
            if(this.q5Qm=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 5 in Section 8");
            if(!this.img1Qm) this.errorShowMessageCheckoutSfa.push("Attach a photo of quality management 1");
            if(!this.img2Qm) this.errorShowMessageCheckoutSfa.push("Attach a photo of quality management 2");
            // Finish section 8 validation

            // Begin section 9 validation
            if(this.q1Fi=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 1 in Section 9");
            if(this.q2Fi=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 2 in Section 9");
            if(this.q3Fi=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 3 in Section 9");
            if(this.q4Fi=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 4 in Section 9");
            if(this.q5Fi=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 5 in Section 9");
            if(!this.img1Fi) this.errorShowMessageCheckoutSfa.push("Attach a photo of Final inspection 1");
            if(!this.img2Fi) this.errorShowMessageCheckoutSfa.push("Attach a photo of Final inspection 2");
            // Finish section 9 validation

            // Begin section 10 validation
            if(this.q1Wh=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 1 in Section 10");
            if(this.q2Wh=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 2 in Section 10");
            if(this.q3Wh=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 3 in Section 10");
            if(this.q4Wh=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 4 in Section 10");
            if(this.q5Wh=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 5 in Section 10");
            if(!this.img1Wh) this.errorShowMessageCheckoutSfa.push("Attach a photo of Warehouse 1");
            if(!this.img2Wh) this.errorShowMessageCheckoutSfa.push("Attach a photo of Warehouse 2");
            // Finish section 10 validation

            // Begin section 11 validation
            if(this.q1Ef=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 1 in Section 11");
            if(this.q2Ef=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 2 in Section 11");
            if(this.q3Ef=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 3 in Section 11");
            if(this.q4Ef=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 4 in Section 11");
            if(this.q5Ef=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 5 in Section 11");
            if(!this.img1Ef) this.errorShowMessageCheckoutSfa.push("Attach a photo of Emergency facilities 1");
            if(!this.img2Ef) this.errorShowMessageCheckoutSfa.push("Attach a photo of Emergency facilities 2");
            // Finish section 11 validation

            // Inspection result
            if(this.fty_cooperate=="3") this.errorShowMessageCheckoutSfa.push("Confirm wether factory cooperate or not");
            // Inspection result

            if(!this.check_outPh) this.errorShowMessageCheckoutSfa.push("Please take a selfie photo before leave the factory!");

            if(this.errorShowMessageCheckoutSfa.length) this.errorCheckoutSfa = 1;

            return this.errorCheckoutSfa;
          },
          bank_account_pictureMethod(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.bank_account_picture = e.target.result;
              }
          },
          img1PaMethod(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.img1Pa = e.target.result;
              }
          },
          img2PaMethod(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.img2Pa = e.target.result;
              }
          },
          img1CeMethod(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.img1Ce = e.target.result;
              }
          },
          img2CeMethod(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.img2Ce = e.target.result;
              }
          },
          img1PlmMethod(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.img1Plm = e.target.result;
              }
          },
          img2PlmMethod(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.img2Plm = e.target.result;
              }
          },
          img1MpMethod(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.img1Mp = e.target.result;
              }
          },
          img2MpMethod(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.img2Mp = e.target.result;
              }
          },
          img1IinMethod(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.img1Iin = e.target.result;
              }
          },
          img2IinMethod(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.img2Iin = e.target.result;
              }
          },
          img1QmMethod(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.img1Qm = e.target.result;
              }
          },
          img2QmMethod(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.img2Qm = e.target.result;
              }
          },
          img1FiMethod(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.img1Fi = e.target.result;
              }
          },
          img2FiMethod(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.img2Fi = e.target.result;
              }
          },
          img1WhMethod(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.img1Wh = e.target.result;
              }
          },
          img2WhMethod(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.img2Wh = e.target.result;
              }
          },
          img1EfMethod(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.img1Ef = e.target.result;
              }
          },
          img2EfMethod(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.img2Ef = e.target.result;
              }
          },
          check_outPhMethod(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.check_outPh = e.target.result;
              }
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
