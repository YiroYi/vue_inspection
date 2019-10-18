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
              <li class="active">SFA Report</li>
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
                         <label for="">Number of unique items</label>
                         <input type="text" v-model.number="item_number" class="form-control">
                       </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label for="">Spare parts loaded Y / N?</label>
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
                         <label for="">Loaded cartons of items</label>
                         <input type="text" class="form-control" v-model.number="item_cnts">
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">Loaded cartons of spare parts</label>
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
                         <label for="">Number of damaged cartons</label>
                         <input type="text" v-model.number="damaged_cnts"class="form-control">
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">Pallets were loaded Y/N?</label>
                         <select class="form-control " v-model="pallets_loaded">
                           <option value="3">Choose</option>
                           <option value="1">Yes</option>
                           <option value="2">No</option>
                         </select>
                       </div>
                   </div>
                   <div class="col-md-4" v-if="pallets_loaded==1">
                       <div class="form-group">
                         <label for="">Pallets were fumigated Y/N?</label>
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
                         <label for="">Container number</label>
                         <input type="text" v-model="container_number" class="form-control">
                       </div>
                   </div>
                   <div class="col-md-6">
                       <div class="form-group">
                         <label for="">Container seal number</label>
                         <input type="text" v-model="seal_number" class="form-control">
                       </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label for="">Container number photo</label>
                       <input type="file" accept="image/*" capture="camera" @change="contNumPh" ref="myImage">
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label for="">Seal number photo</label>
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
                         <label for="">Is container damaged?</label>
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
                         <label for="">Inspection Result</label>
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
                       <select class="form-control " v-model="aql_level">
                         <option value="0">Choose</option>
                         <option value="2.5">2.5</option>
                         <option value="CustomerRequirement">Customer Standard</option>
                       </select>
                     </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">Number of unique items</label>
                         <input type="text" v-model.number="item_number" class="form-control">
                       </div>
                   </div>
                   <div class="col-md-4">
                     <div class="form-group">
                       <label for="">Production status</label>
                       <select class="form-control " v-model="production_status">
                         <option value="0">Choose</option>
                         <option value="Completed">Completed</option>
                         <option value="Not completed">Not completed</option>
                       </select>
                     </div>
                   </div>
                 </div>
                <!--Quality information finish-->

                <!--Inspection Preresult begin-->
                <div class="form-group row border">
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
                       <p>Inspection Pre-result</p>
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
                                  Results has not assigned.
                                </td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                 </div>

                <!--Defect Details-->
                <div class="form-group row border">
                  <div class="col-md-12">
                      <p>Edit pre-result</p>
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
                           <tbody v-if="arrayDefectDetail.length">
                               <tr v-for="(defect,index) in arrayDefectDetail" :key="defect.id">
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
                   <div class="col-md-4">
                     <div class="form-group">
                       <label for="">Acknowledgment photo</label>
                       <input type="file" accept="image/*" capture="camera" @change="imageAcknow" ref="myImage">
                     </div>
                   </div>
                   <div class="col-md-4">
                     <div class="form-group">
                       <label for="">Printed packing list photo</label>
                       <input type="file" accept="image/*" capture="camera" @change="imagePL" ref="myImage">
                     </div>
                   </div>
                   <div class="col-md-4">
                     <div class="form-group">
                       <label for="">Product photo</label>
                       <input type="file" accept="image/*" capture="camera" @change="imageProduct" ref="myImage">
                     </div>
                   </div>

                   <div class="col-md-4">
                     <div class="form-group">
                       <label for="">Sampling warehouse photo</label>
                       <input type="file" accept="image/*" capture="camera" @change="imageSample" ref="myImage">
                     </div>
                   </div>
                   <div class="col-md-4">
                     <div class="form-group">
                       <label for="">Opened Samples</label>
                       <input type="file" accept="image/*" capture="camera" @change="imageOpSample" ref="myImage">
                     </div>
                   </div>
                   <div class="col-md-4">
                     <div class="form-group">
                       <label for="">Sealed Samples</label>
                       <input type="file" accept="image/*" capture="camera" @change="imageClSample" ref="myImage">
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
                         <select class="form-control " v-model="fty_cooperate">
                           <option value="3">Choose</option>
                           <option value="1">Yes</option>
                           <option value="2">No</option>
                         </select>
                       </div>
                   </div>

                   <div class="col-md-6">
                       <div class="form-group">
                         <label for="">Inspection Result</label>
                         <select class="form-control " v-model="inspection_result">
                           <option value="0">Choose</option>
                           <option value="Pass">Pass</option>
                           <option value="Fail">Fail</option>
                           <option value="Customer consideration">To customer consideration</option>
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
                 <!--Inspection Result finish-->
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
                          <input type="file"  accept="image/*" capture="camera" @change="imageCkOutQci" ref="myImage">
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
                           <button type="button" @click="storeCheckOutQci(service_id)" class="btn btn-danger"><i class="icon-control-play"></i>CHECK OUT</button>
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
                    <p>INSPECTION INFORMATION</p>
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
                    <p>S1-GENERAL INFORMATION</p>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Factory name</label>
                      <input type="text" v-model="name" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Address</label>
                      <input type="text" v-model="address" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Website</label>
                      <input type="text" v-model="website" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Telephone</label>
                      <input type="text" v-model="telephone" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">E-mail</label>
                      <input type="text" v-model="email" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Name of contact person</label>
                      <input type="text" v-model="contact_name" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Mobile of contact person</label>
                      <input type="text" v-model="contact_mobile" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Position of contact person</label>
                      <input type="text" v-model="contact_position" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Main product</label>
                      <input type="text" v-model="main_product" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Main market</label>
                      <input type="text" v-model="main_market" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Production capacity</label>
                      <input type="text" v-model="production_capacity" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Registration date</label>
                      <input type="text" v-model="registration_date" class="form-control" readonly>
                    </div>
                </div>
              </div>
              <div class="form-group row border">
                <div class="col-md-12">
                    <p>S2-GENERAL INFORMATION</p>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Type of registration</label>
                      <input type="text" v-model="type_of_registration" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Type of company</label>
                      <input type="text" v-model="type_of_company" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Employees number</label>
                      <input type="text" v-model="employees_number" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Customer country</label>
                      <input type="text" v-model="customer_country" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Factory area</label>
                      <input type="text" v-model="factory_area_sqm2" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Company owner name</label>
                      <input type="text" v-model="company_owner" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">General manager name</label>
                      <input type="text" v-model="general_manager" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Tax Id</label>
                      <input type="text" v-model="tax_id" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Export licence</label>
                      <input type="text" v-model="export_license" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Nearest port</label>
                      <input type="text" v-model="nearest_port" class="form-control" readonly>
                    </div>
                </div>

                <div class="col-md-12 form-group row div-error" v-show="errorCheckoutSfa">
                  <div class=" form-group text-center text-error">
                    <div class="" v-for="error in errorShowMessageCheckoutSfa" :key="error" v-text="error"></div>
                  </div>
                </div>
              </div>
              <div class="form-group row border">
                <div class="col-md-12">
                    <p>BUSINESS LICENSE & BANK ACCOUNT PHOTOS</p>
                </div>
                    <!--<div class="col-md-6">
                      <div class="form-group">
                       <label  for="text-input">Business Licence</label>
                       <div class="widget-user-image">
                         <img  :src="getBusinessPh()" alt="" style="height:300px;width:300px;">
                       </div>
                     </div>
                   </div>-->
                    <div class="col-md-6">
                      <div class="form-group">
                       <label  for="text-input">Bank Account</label>
                       <div class="widget-user-image">
                         <img  :src="getBankPh()" alt="" style="height:300px;width:300px;">
                       </div>
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
                    <label class="col-md-9" for="">1.Is the workshop clean and organized?</label>
                    <input class="form-control col-md-1 " v-model="q1PaInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">2.Are the materials properly arranged?</label>
                    <input class="form-control col-md-1 " v-model="q2PaInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">3.Are factory facilities in good working conditions?</label>
                    <input class="form-control col-md-1 " v-model="q3PaInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">4.Were production lines producing during the inspection? </label>
                    <input class="form-control col-md-1 " v-model="q4PaInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">5.Are there any products finished available for the inspector to observe? </label>
                    <input class="form-control col-md-1 " v-model="q5PaInp" readonly>
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
                    <label class="col-md-9" for="">1.Are there any certificates, authentication or registration?</label>
                    <input class="form-control col-md-1 " v-model="q1CeInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">2.BSCI, SA8000, ICTI, ISO14001, GS, BRC, IFS, Other?</label>
                    <input class="form-control col-md-1 " v-model="q2CeInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">3.Are the facilities in general good condition aligning to the certificate?</label>
                    <input class="form-control col-md-1 " v-model="q3CeInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">4.Does the production process match the certificate guidelines?</label>
                    <input class="form-control col-md-1 " v-model="q4CeInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">5.Is factory´s appearance in accordance to the certificate?</label>
                    <input class="form-control col-md-1 " v-model="q5CeInp" readonly>
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
                    <label class="col-md-9" for="">1.Are the machines in good condition?</label>
                    <input class="form-control col-md-1 " v-model="q1PlmInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">2.Do the machines count with manufacturer´s manual? </label>
                    <input class="form-control col-md-1 " v-model="q2PlmInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">3.Are the machines working properly?</label>
                    <input class="form-control col-md-1 " v-model="q3PlmInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">4.Do the machines get any maintenance? </label>
                    <input class="form-control col-md-1 " v-model="q4PlmInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">5.Are the operators qualified to manipulate the machinery?</label>
                    <input class="form-control col-md-1 " v-model="q5PlmInp" readonly>
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
                    <label class="col-md-9" for="">1.Are there written instructions for workers to follow?</label>
                    <input class="form-control col-md-1 " v-model="q1MpInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">2.Are there regular Q.C. inspections on products during manufacturing?</label>
                    <input class="form-control col-md-1 " v-model="q2MpInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">3.Is there a Q.C. manager supervising during the entire process?</label>
                    <input class="form-control col-md-1 " v-model="q3MpInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">4.Are the inspection results recorded?</label>
                    <input class="form-control col-md-1 " v-model="q4MpInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">5.Are there approved samples attached to working stations for reference?</label>
                    <input class="form-control col-md-1 " v-model="q5MpInp" readonly>
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
                    <label class="col-md-9" for="">1.Is Incoming Quality Check (IQC) records or reports available?</label>
                    <input class="form-control col-md-1 " v-model="q1IinInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">2.Are there Production Quality Check (PQC) records or reports available?</label>
                    <input class="form-control col-md-1 " v-model="q2IinInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">3.Are final inspections (FI) records or reports available?</label>
                    <input class="form-control col-md-1 " v-model="q3IinInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">4.Are these records/reports updated?</label>
                    <input class="form-control col-md-1 " v-model="q4IinInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">5.Where there Quality Improvement Guidelines (QIG) being implemented?</label>
                    <input class="form-control col-md-1 " v-model="q5IinInp" readonly>
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
                    <label class="col-md-9" for="">1.Is there an independent Q.C. manager or supervisory level person to lead Q.C.   process?  </label>
                    <input class="form-control col-md-1 " v-model="q1QmInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">2.Is there a formal Quality Control Manual or related quality document being implemented?</label>
                    <input class="form-control col-md-1 " v-model="q2QmInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">3.Does the factory employs updated international, national or any specific standards to perform internal Q.C. on the products? </label>
                    <input class="form-control col-md-1 " v-model="q3QmInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">4.If raw materials need inspection prior to production, are they properly inspected and do they keep records? </label>
                    <input class="form-control col-md-1 " v-model="q4QmInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">5.Are the defective raw materials properly identified and separated from the functional bash?</label>
                    <input class="form-control col-md-1 " v-model="q5QmInp" readonly>
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
                    <label class="col-md-9" for="">1.A testing inspection is performed on products before packing?</label>
                    <input class="form-control col-md-1 " v-model="q1FiInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">2.Does the factory perform inspection on final products before shipping?</label>
                    <input class="form-control col-md-1 " v-model="q2FiInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">3.Are there adequate written criteria/instructions available for inspectors to follow for final inspection?</label>
                    <input class="form-control col-md-1 " v-model="q3FiInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">4.Are there records of rejected lots?</label>
                    <input class="form-control col-md-1 " v-model="q4FiInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">5.Is the sampling size for final inspection adequate to meet customer´s standards?</label>
                    <input class="form-control col-md-1 " v-model="q5FiInp" readonly>
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
                    <label class="col-md-9" for="">1.Does the factory have a raw material and finished product warehouse?</label>
                    <input class="form-control col-md-1 " v-model="q1WhInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">2.Are packed master cartons properly stored to avoid damage or contamination?</label>
                    <input class="form-control col-md-1 " v-model="q2WhInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">3.Is the warehouse clearly isolated from production areas? </label>
                    <input class="form-control col-md-1 " v-model="q3WhInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">4.Is the warehouse clean and organized?</label>
                    <input class="form-control col-md-1 " v-model="q4WhInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">5.Are raw materials kept in controlled, segregated locations to prevent quality deterioration?</label>
                    <input class="form-control col-md-1 " v-model="q5WhInp" readonly>
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
                    <label class="col-md-9" for="">1.Are there fire extinguishers available and accessible? </label>
                    <input class="form-control col-md-1 " v-model="q1EfInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">2.Are there fire alarms installed in each working station?</label>
                    <input class="form-control col-md-1 " v-model="q2EfInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">3.Are there emergency lights and exit signs installes at all emergency exits?</label>
                    <input class="form-control col-md-1 " v-model="q3EfInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">4.Is there an evacuation route marked and visible?</label>
                    <input class="form-control col-md-1 " v-model="q4EfInp" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-9" for="">5.Are there personal protective equipment, and it is perfectly notorious?</label>
                    <input class="form-control col-md-1 " v-model="q5EfInp" readonly>
                  </div>
                </div>
              </div>
             <!--Emergency information finish-->
             <!--Result begin-->
             <div class="form-group row border">
               <div class="col-md-12">
                   <p>INSPECTION SUMMARY & RESULT</p>
               </div>
                 <label class="col-md-3 form-control-label" for="text-input">1.Production area:</label>
                 <div class="col-md-1">
                     <input type="text" v-model.number="productionR" class="form-control" placeholder="" readonly>
                 </div>
                 <div class="col-md-8"></div>
                <label class="col-md-3 form-control-label" for="text-input">2.Certificates:</label>
                <div class="col-md-1">
                    <input type="text" v-model.number="certificatesR" class="form-control" placeholder="" readonly>
                </div>
                <div class="col-md-8"></div>
                <label class="col-md-3 form-control-label" for="text-input">3.Production line machines:</label>
                <div class="col-md-1">
                    <input type="text" v-model.number="productionlR" class="form-control" placeholder="" readonly>
                </div>
                <div class="col-md-8"></div>
                <label class="col-md-3 form-control-label" for="text-input">4.Manufacturing process:</label>
                <div class="col-md-1">
                    <input type="text" v-model.number="manufacturingR" class="form-control" placeholder="" readonly>
                </div>
                <div class="col-md-8"></div>
                <label class="col-md-3 form-control-label" for="text-input">5.Incoming inspections:</label>
                <div class="col-md-1">
                    <input type="text" v-model.number="incomingR" class="form-control" placeholder="" readonly>
                </div>
                <div class="col-md-8"></div>
                <label class="col-md-3 form-control-label" for="text-input">8.Quality management:</label>
                <div class="col-md-1">
                    <input type="text" v-model.number="qualityR" class="form-control" placeholder="" readonly>
                </div>
                <div class="col-md-8"></div>
                <label class="col-md-3 form-control-label" for="text-input">7.Final inspections & Q.A. test:</label>
                <div class="col-md-1">
                    <input type="text" v-model.number="finalinspR" class="form-control" placeholder="" readonly>
                </div>
                <div class="col-md-8"></div>
                <label class="col-md-3 form-control-label" for="text-input">8.Warehouse:</label>
                <div class="col-md-1">
                    <input type="text" v-model.number="warehouseR" class="form-control" placeholder="" readonly>
                </div>
                <div class="col-md-8"></div>
                <label class="col-md-3 form-control-label" for="text-input">9.Emergency facilities:</label>
                <div class="col-md-1">
                    <input type="text" v-model.number="emergencyR" class="form-control" placeholder="" readonly>
                </div>
                <div class="col-md-6"></div>

               <div class="col-md-4">
                   <div class="form-group">
                     <label for="">Factory cooperates?</label>
                     <input class="form-control " v-model="fty_cooperateInput" readonly>
                   </div>
               </div>
               <div class="col-md-4">
                   <div class="form-group">
                     <label for="">Inpection points</label>
                     <input type="text" class="form-control" v-model.number="result_num" readonly>
                   </div>
               </div>
               <div class="col-md-4">
                   <div class="form-group">
                     <label for="">Inspection Result</label>
                     <input type="text" class="form-control" v-model="result" readonly>
                   </div>
               </div>
               <div class="col-md-12">
                   <div class="form-group">
                     <label for="">Remarks</label>
                     <textarea class="form-control" v-model="remarks" rows="3" placeholder="Enter ..." readonly></textarea>
                   </div>
               </div>
             </div>
             <!--Result finish-->

           <!--Check out picture-->
           <div class="form-group row border">
             <div class="col-md-12">
                 <p>INSPECTOR WORK</p>
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
           <!--Arrange inspector begin-->

             <div class="form-group row">
                 <div class="col-md-12" style="text-align:center">

                     <div v-if="category_name=='CCI'">
                       <button type="button" @click="closeDetail()" class="btn btn-primary">EXIT</button>
                       <button type="button" @click="storeCheckOut(service_id)" class="btn btn-success"><i class="icon-control-play"></i>CHECK OUT</button>
                     </div>
                     <div v-else-if="category_name=='QCI'">
                       <button type="button" @click="closeDetail()" class="btn btn-primary">EXIT</button>
                       <button type="button" @click="storeCheckOutQci(service_id)" class="btn btn-danger"><i class="icon-control-play"></i>CHECK OUT</button>
                     </div>
                     <div v-else="category_name=='SFA'">
                       <button type="button" @click="closeDetail()" class="btn btn-primary">EXIT</button>
                       <button type="button" @click="openModal('action',category_name)" class="btn btn-info">SUBMIT REPORT</button>
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
                      <button type="button"class="btn btn-primary" @click="confirmInfoSfa()"><i class="icon-like"></i>Submit Inspection Material</button>

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
            fty_cooperate:'3',
            fty_cooperateInput:'',
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
            q1PaInp:'',
            q2PaInp:'',
            q3PaInp:'',
            q4PaInp:'',
            q5PaInp:'',
            img1Pa:'',
            img2Pa:'',
            //--S3 variables finish--//
            //--S4 variables begin--//
            q1Ce:'c',
            q2Ce:'c',
            q3Ce:'c',
            q4Ce:'c',
            q5Ce:'c',
            q1CeInp:'',
            q2CeInp:'',
            q3CeInp:'',
            q4CeInp:'',
            q5CeInp:'',
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
            q1PlmInp:'',
            q2PlmInp:'',
            q3PlmInp:'',
            q4PlmInp:'',
            q5PlmInp:'',
            img1Plm:'',
            img2Plm:'',
            //--S5 variables finish--//
            //--S6 variables begin--//
            q1Mp:'c',
            q2Mp:'c',
            q3Mp:'c',
            q4Mp:'c',
            q5Mp:'c',
            q1MpInp:'',
            q2MpInp:'',
            q3MpInp:'',
            q4MpInp:'',
            q5MpInp:'',
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
            q1IinInp:'',
            q2IinInp:'',
            q3IinInp:'',
            q4IinInp:'',
            q5IinInp:'',
            img1Iin:'',
            img2Iin:'',
            //--S7 variables finish--//
            //--S8 variables begin--//
            q1Qm:'c',
            q2Qm:'c',
            q3Qm:'c',
            q4Qm:'c',
            q5Qm:'c',
            q1QmInp:'',
            q2QmInp:'',
            q3QmInp:'',
            q4QmInp:'',
            q5QmInp:'',
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
            q1FiInp:'',
            q2FiInp:'',
            q3FiInp:'',
            q4FiInp:'',
            q5FiInp:'',
            img1Fi:'',
            img2Fi:'',
            //--S9 variables finish--//
            //--S10 variables begin--//
            q1Wh:'c',
            q2Wh:'c',
            q3Wh:'c',
            q4Wh:'c',
            q5Wh:'c',
            q1WhInp:'',
            q2WhInp:'',
            q3WhInp:'',
            q4WhInp:'',
            q5WhInp:'',
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
            q1EfInp:'',
            q2EfInp:'',
            q3EfInp:'',
            q4EfInp:'',
            q5EfInp:'',
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

            //--Scores--//
            // Sfa Variables Finish//
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
            this.q1Pa+
            this.q2Pa+
            this.q3Pa+
            this.q4Pa+
            this.q5Pa+
            this.q1Ce+
            this.q2Ce+
            this.q3Ce+
            this.q4Ce+
            this.q5Ce+
            this.q1Plm+
            this.q2Plm+
            this.q3Plm+
            this.q4Plm+
            this.q5Plm+
            this.q1Mp+
            this.q2Mp+
            this.q3Mp+
            this.q4Mp+
            this.q5Mp+
            this.q1Iin+
            this.q2Iin+
            this.q3Iin+
            this.q4Iin+
            this.q5Iin+
            this.q1Qm+
            this.q2Qm+
            this.q3Qm+
            this.q4Qm+
            this.q5Qm+
            this.q1Fi+
            this.q2Fi+
            this.q3Fi+
            this.q4Fi+
            this.q5Fi+
            this.q1Wh+
            this.q2Wh+
            this.q3Wh+
            this.q4Wh+
            this.q5Wh+
            this.q1Ef+
            this.q2Ef+
            this.q3Ef+
            this.q4Ef+
            this.q5Ef;

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
            var url= 'report/indexSfa?page=' + page + '&search=' + search + '&criteria=' + criteria;

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
                      this.modalTitle = 'Begin your QCI';
                      this.inspDate = new Date().toLocaleDateString();
                      this.check_in = new Date().toLocaleTimeString();
                      this.actionType =1;
                      break;
                    }
                    case 'SFA':
                    {
                      this.modal = 1;
                      this.modalTitle = 'SCORE & FEEDBACK ASSIGNMENT';
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
           this.fty_cooperateInput='',
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
            this.reference=data['reference'];
            this.category_name=data['category_name'];
            this.inspection_date=data['inspection_date']
            this.inspdetail_id=data['inspdetails_id'];
            this.qciactions_id=data['qciactions_id'];
            this.check_out = new Date().toLocaleTimeString();
            var id = this.service_id;
            var idDet = this.inspdetail_id;
            var idDef = this.qciactions_id;
            var url='score/indexScoreQci?idDef=' + idDef;
            var idi;
            var idi2;
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
          openDetailSfa(data=[]){

            let me=this;
            this.listado=3;
            this.service_id=data['id'];
            this.idDet = data['inspdetails_id'];
            this.reference=data['reference'];
            this.category_name=data['category_name'];
            this.inspection_date=data['inspection_date'];
            this.name=data['name'];
            this.address=data['address'];
            this.website=data['website'];
            this.telephone=data['telephone'];
            this.email=data['email'];
            this.contact_name=data['contact_name'];
            this.contact_mobile=data['contact_mobile'];
            this.contact_position=data['contact_position'];
            this.main_product=data['main_product'];
            this.main_market=data['main_market'];
            this.production_capacity=data['production_capacity'];
            this.registration_date=data['registration_date'];
            this.type_of_registration=data['type_of_registration'];
            this.type_of_company=data['type_of_company'];
            this.employees_number=data['employees_number'];
            this.customer_country=data['customer_country'];
            this.factory_area_sqm2=data['factory_area_sqm2'];
            this.company_owner=data['company_owner'];
            this.general_manager=data['general_manager'];
            this.tax_id=data['tax_id'];
            this.export_license=data['export_license'];
            this.nearest_port=data['nearest_port'];
            this.bank_account_picture=data['bank_account_picture'];
            this.fty_cooperate=data['fty_cooperate'];
            this.result_num=parseInt(data['result_num']);
            this.result=data['result'];
            this.remarks=data['remarks'];
            this.check_in=data['check_in'];
            this.check_out=data['check_out'];
            this.check_inPh=data['check_inPh'];
            this.check_outPh=data['check_outPh'];

            var productionR = 0;
            var certificatesR = 0;
            var productionlR = 0;
            var manufacturingR = 0;
            var incomingR = 0;
            var qualityR = 0;
            var finalinspR = 0;
            var warehouseR = 0;
            var emergencyR = 0;

            this.productionR = parseInt(data['q1Pa'])+parseInt(data['q2Pa'])+parseInt(data['q3Pa'])+parseInt(data['q4Pa'])+parseInt(data['q5Pa']);
            this.certificatesR = parseInt(data['q1Ce'])+parseInt(data['q2Ce'])+parseInt(data['q3Ce'])+parseInt(data['q4Ce'])+parseInt(data['q5Ce']);
            this.productionlR = parseInt(data['q1Plm'])+parseInt(data['q2Plm'])+parseInt(data['q3Plm'])+parseInt(data['q4Plm'])+parseInt(data['q5Plm']);
            this.manufacturingR = parseInt(data['q1Mp'])+parseInt(data['q2Mp'])+parseInt(data['q3Mp'])+parseInt(data['q4Mp'])+parseInt(data['q5Mp']);
            this.incomingR = parseInt(data['q1Iin'])+parseInt(data['q2Iin'])+parseInt(data['q3Iin'])+parseInt(data['q4Iin'])+parseInt(data['q5Iin']);
            this.qualityR = parseInt(data['q1Qm'])+parseInt(data['q2Qm'])+parseInt(data['q3Qm'])+parseInt(data['q4Qm'])+parseInt(data['q5Qm']);
            this.finalinspR = parseInt(data['q1Fi'])+parseInt(data['q2Fi'])+parseInt(data['q3Fi'])+parseInt(data['q4Fi'])+parseInt(data['q5Fi']);
            this.warehouseR = parseInt(data['q1Wh'])+parseInt(data['q2Wh'])+parseInt(data['q3Wh'])+parseInt(data['q4Wh'])+parseInt(data['q5Wh']);
            this.emergencyR = parseInt(data['q1Ef'])+parseInt(data['q2Ef'])+parseInt(data['q3Ef'])+parseInt(data['q4Ef'])+parseInt(data['q5Ef']);

            this.q1PaInp = (parseInt(data['q1Pa'])==1) ? 'Yes':'No';
            this.q2PaInp = (parseInt(data['q2Pa'])==1) ? 'Yes':'No';
            this.q3PaInp = (parseInt(data['q3Pa'])==1) ? 'Yes':'No';
            this.q4PaInp = (parseInt(data['q4Pa'])==1) ? 'Yes':'No';
            this.q5PaInp = (parseInt(data['q5Pa'])==1) ? 'Yes':'No';

            this.q1CeInp = (parseInt(data['q1Ce'])==1) ? 'Yes':'No';
            this.q2CeInp = (parseInt(data['q2Ce'])==1) ? 'Yes':'No';
            this.q3CeInp = (parseInt(data['q3Ce'])==1) ? 'Yes':'No';
            this.q4CeInp = (parseInt(data['q4Ce'])==1) ? 'Yes':'No';
            this.q5CeInp = (parseInt(data['q5Ce'])==1) ? 'Yes':'No';

            this.q1PlmInp = (parseInt(data['q1Plm'])==1) ? 'Yes':'No';
            this.q2PlmInp = (parseInt(data['q2Plm'])==1) ? 'Yes':'No';
            this.q3PlmInp = (parseInt(data['q3Plm'])==1) ? 'Yes':'No';
            this.q4PlmInp = (parseInt(data['q4Plm'])==1) ? 'Yes':'No';
            this.q5PlmInp = (parseInt(data['q5Plm'])==1) ? 'Yes':'No';

            this.q1MpInp = (parseInt(data['q1Mp'])==1) ? 'Yes':'No';
            this.q2MpInp = (parseInt(data['q2Mp'])==1) ? 'Yes':'No';
            this.q3MpInp = (parseInt(data['q3Mp'])==1) ? 'Yes':'No';
            this.q4MpInp = (parseInt(data['q4Mp'])==1) ? 'Yes':'No';
            this.q5MpInp = (parseInt(data['q5Mp'])==1) ? 'Yes':'No';

            this.q1IinInp = (parseInt(data['q1Iin'])==1) ? 'Yes':'No';
            this.q2IinInp = (parseInt(data['q2Iin'])==1) ? 'Yes':'No';
            this.q3IinInp = (parseInt(data['q3Iin'])==1) ? 'Yes':'No';
            this.q4IinInp = (parseInt(data['q4Iin'])==1) ? 'Yes':'No';
            this.q5IinInp = (parseInt(data['q5Iin'])==1) ? 'Yes':'No';

            this.q1QmInp = (parseInt(data['q1Qm'])==1) ? 'Yes':'No';
            this.q2QmInp = (parseInt(data['q2Qm'])==1) ? 'Yes':'No';
            this.q3QmInp = (parseInt(data['q3Qm'])==1) ? 'Yes':'No';
            this.q4QmInp = (parseInt(data['q4Qm'])==1) ? 'Yes':'No';
            this.q5QmInp = (parseInt(data['q5Qm'])==1) ? 'Yes':'No';

            this.q1FiInp = (parseInt(data['q1Fi'])==1) ? 'Yes':'No';
            this.q2FiInp = (parseInt(data['q2Fi'])==1) ? 'Yes':'No';
            this.q3FiInp = (parseInt(data['q3Fi'])==1) ? 'Yes':'No';
            this.q4FiInp = (parseInt(data['q4Fi'])==1) ? 'Yes':'No';
            this.q5FiInp = (parseInt(data['q5Fi'])==1) ? 'Yes':'No';

            this.q1WhInp = (parseInt(data['q1Wh'])==1) ? 'Yes':'No';
            this.q2WhInp = (parseInt(data['q2Wh'])==1) ? 'Yes':'No';
            this.q3WhInp = (parseInt(data['q3Wh'])==1) ? 'Yes':'No';
            this.q4WhInp = (parseInt(data['q4Wh'])==1) ? 'Yes':'No';
            this.q5WhInp = (parseInt(data['q5Wh'])==1) ? 'Yes':'No';

            this.q1EfInp = (parseInt(data['q1Ef'])==1) ? 'Yes':'No';
            this.q2EfInp = (parseInt(data['q2Ef'])==1) ? 'Yes':'No';
            this.q3EfInp = (parseInt(data['q3Ef'])==1) ? 'Yes':'No';
            this.q4EfInp = (parseInt(data['q4Ef'])==1) ? 'Yes':'No';
            this.q5EfInp = (parseInt(data['q5Ef'])==1) ? 'Yes':'No';



            if(this.fty_cooperate==1)
            {
              this.fty_cooperateInput="Yes";
            }else{
              this.fty_cooperateInput="No";
            }

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
          editDetailSfa(){
            if(this.validateEditSfa())
            {
              return;
            }

              const swalWithBootstrapButtons = swal.mixin({
              confirmButtonClass: 'btn btn-success',
              cancelButtonClass: 'btn btn-danger',
              buttonsStyling: false,
               })
                swalWithBootstrapButtons({
                  title: 'Would you like to edit something in this section?',
                  text: "Please double check your information!",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Yes, confirm!',
                  cancelButtonText: 'No, Way!',
                  reverseButtons: true
                    }).then((result) => {
                      if (result.value) {
                      let me=this;

                      axios.put('score/editSfainfo',{

                      'iddetailone': this.idDet,
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
                      'nearest_port':this.nearest_port

                      }).then(function (response) {

                        me.closeDetail();
                        me.listService(1,'','name');

                        swalWithBootstrapButtons(
                          'Great!',
                          'Section succesfully edited',

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
          validateEditSfa(){
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
            // Finish general information validation
            if(this.errorShowMessageCheckoutSfa.length) this.errorCheckoutSfa = 1;

            return this.errorCheckoutSfa;
          },
          getBusinessPh(){
            return "./files/"+ this.bank_account_picture;
          },
          getBankPh(){
            return "./files/"+ this.bank_account_picture;
          },
          validateScoreSfa(){

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
          confirmInfoSfa(){
                if(this.validateScoreSfa())
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
            if(this.arrayDefect.length==0) this.errorShowMessageCheckoutQci.push("Input number of defects per item");
            if(!this.acknowledgmentPh) this.errorShowMessageCheckoutQci.push("Attach a photo of acknowledgment");
            if(!this.printed_plPh) this.errorShowMessageCheckoutQci.push("Attach a photo of printed packing list");
            if(!this.product_picture) this.errorShowMessageCheckoutQci.push("Attach a photo of one product");
            if(!this.sampling_picture) this.errorShowMessageCheckoutQci.push("Attach a photo of the warehouse and selected samples");
            if(!this.opened_samplePh) this.errorShowMessageCheckoutQci.push("Attach a photo of the openend samples");
            if(!this.sealed_samplePh) this.errorShowMessageCheckoutQci.push("Attach a photo of the sealed samples");
            if(this.fty_cooperate==3) this.errorShowMessageCheckoutQci.push("Select wether factory cooperate or not");
            if(this.inspection_result==0) this.errorShowMessageCheckoutQci.push("Select the inspection result");
            if(!this.check_outPh) this.errorShowMessageCheckoutQci.push("Please take a selfie photo before leave the factory!");

            if(this.errorShowMessageCheckoutQci.length) this.errorCheckoutQci = 1;

            return this.errorCheckoutQci;

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
