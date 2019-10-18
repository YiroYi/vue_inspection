<template>
  <div>

    <!-- Breadcrumb -->
    <div class="page-bar">
      <div class="page-title-breadcrumb">
          <div class=" pull-left">
              <div class="page-title">ON ACTION</div>
          </div>
          <ol class="breadcrumb page-breadcrumb pull-right">
              <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
              </li>
              <li class="active">On Action</li>
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
                              <th>Complete</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="service in arrayService" v-bind:key="service.id">
                              <td v-text="service.reference"></td>
                              <td v-text="service.suppliers_name"></td>
                              <td v-text="service.inspection_date"></td>
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
                       <p style="font-size:18px;"><b>监装告知书</b></p>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">工作号</label>
                         <input type="text" class="form-control" v-model="reference" readonly>
                       </div>
                   </div>
                   <div class="col-md-4">
                       <label for="">服务类似</label>
                       <input type="text" class="form-control" v-model="category_name" readonly>
                   </div>
                   <div class="col-md-4">
                       <label for="">监装时间</label>
                       <input type="text" class="form-control" v-model="inspection_date" readonly>
                   </div>
                 </div>
                 <div class="form-group row border">
                   <div class="col-md-12">
                       <p style="font-size:18px;"><b>工厂信息</b></p>
                   </div>
                   <div class="col-md-12">
                       <div class="form-group">
                         <label for="">特殊要求</label>
                         <textarea type="text" class="form-control" v-model="sup_instructions" readonly></textarea>
                       </div>
                   </div>
                 </div>
                 <div class="form-group row border">
                   <div class="col-md-12">
                       <p style="font-size:18px;"><b>产品信息</b></p>
                   </div>
                   <div class="col-md-6">
                       <div class="form-group">
                         <label for="">款数<span class="required"> * </span></label>
                         <input type="text" v-model.number="item_number" class="form-control">
                       </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label for="">是否装配件?<span class="required"> * </span></label>
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
                       <p>装货数量</p>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">产品箱子数量<span class="required"> * </span></label>
                         <input type="text" class="form-control" v-model.number="item_cnts">
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">配件箱子数量<span class="required"> * </span></label>
                         <input type="text" class="form-control" v-model.number="sp_cnts">
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">箱子总数<span class="required"> * </span></label>
                         <input type="number" class="form-control" v-model="total_cnts" readonly>
                         <p hidden>{{total_cnts=calculateTotalCtns}}</p>
                       </div>
                   </div>
                 </div>
                 <div class="form-group row border">
                   <div class="col-md-12">
                       <p style="font-size:18px;"><b>产品情况</b></p>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">破损箱子数量<span class="required"> * </span></label>
                         <input type="text" v-model.number="damaged_cnts"class="form-control">
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">是否托盘装？<span class="required"> * </span></label>
                         <select class="form-control " v-model="pallets_loaded">
                           <option value="3">Choose</option>
                           <option value="1">Yes</option>
                           <option value="2">No</option>
                         </select>
                       </div>
                   </div>
                   <div class="col-md-4" v-if="pallets_loaded==1">
                       <div class="form-group">
                         <label for="">是否托板有熏蒸?<span class="required"> * </span></label>
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
                       <p style="font-size:18px;"><b>柜子信息</b></p>
                   </div>
                   <div class="col-md-6">
                       <div class="form-group">
                         <label for="">柜子号<span class="required"> * </span></label>
                         <input type="text" v-model="container_number" class="form-control">
                       </div>
                   </div>
                   <div class="col-md-6">
                       <div class="form-group">
                         <label for="">柜子铅封号<span class="required"> * </span></label>
                         <input type="text" v-model="seal_number" class="form-control">
                       </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label for="">柜子照片<span class="required"> * </span></label>
                       <input type="file" accept="image/*"  @change="contNumPh" ref="CNumPh">
                       <!--<input type="file" accept="image/*" capture="camera" @change="contNumPh" ref="CNumPh">-->
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label for="">柜子铅封号照片<span class="required"> * </span></label>
                       <input type="file" accept="image/*" @change="sealNumPh" ref="SNumPh">
                     </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">是否柜子有破损?<span class="required"> * </span></label>
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
                       <p style="font-size:18px;"><b>告知文件</b></p>
                   </div>
                   <!--<div class="col-md-4">
                     <div class="form-group">
                       <label for="">Printed packing list photo<span class="required"> * </span></label>
                       <input type="file" accept="image/*" capture="camera" @change="imagePL" ref="iPL">
                     </div>
                   </div>
                   <div class="col-md-4">
                     <div class="form-group">
                       <label for="">Inspector next container photo<span class="required"> * </span></label>
                       <input type="file" accept="image/*" capture="camera" @change="imageinspContPh" ref="ContPh">
                     </div>
                   </div>-->
                   <div class="col-md-6">
                     <div class="form-group">
                       <label for="">工厂告知书照片<span class="required"> * </span></label>
                       <input type="file" accept="image/*" @change="imageAcknow" ref="Acknow">
                     </div>
                   </div>
                   <!--<div class="col-md-4">
                     <div class="form-group">
                       <label for="">Container acknowledgment 1 photo<span class="required"> * </span></label>
                       <input type="file" accept="image/*" capture="camera" @change="imageC1" ref="C1i">
                     </div>
                   </div>
                   <div class="col-md-4">
                     <div class="form-group">
                       <label for="">Container acknowledgment 2 photo <span class="required"> * </span></label>
                       <input type="file" accept="image/*" capture="camera" @change="imageC2" ref="C2i">
                     </div>
                   </div>-->
                   <div class="col-md-6">
                     <div class="form-group">
                       <label for="">点数表照片 <span class="required"> * </span></label>
                       <input type="file" accept="image/*"  @change="imageCounting" ref="Counting">
                     </div>
                   </div>
                 </div>
                 <div class="form-group row border">
                   <div class="col-md-12">
                      <p style="font-size:18px;"><b>监装总结</b></p>
                   </div>
                   <div class="col-md-6">
                       <div class="form-group">
                         <label for="">是否工厂配合?<span class="required"> * </span></label>
                         <select class="form-control " v-model="fty_cooperate">
                           <option value="3">Choose</option>
                           <option value="1">Yes</option>
                           <option value="2">No</option>
                         </select>
                       </div>
                   </div>
                   <div class="col-md-6">
                       <div class="form-group">
                         <label for="">监装结果<span class="required"> * </span></label>
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
                         <label for="">监装备注</label>
                         <textarea class="form-control" v-model="remarks" rows="3" placeholder="Enter ..."></textarea>
                       </div>
                   </div>
                 </div>
                 <div class="form-group row border">
                   <div class="col-md-12">
                       <p style="font-size:18px;"><b>Check Out</b></p>
                   </div>
                     <div class="form-group ">
                       <div class="col-md-6">
                          <label  for="text-input">时间</label>
                          <input type="text" v-model="check_out" class="form-control" placeholder="Name of the service">
                       </div>
                       <div class="col-md-6">
                         <div class="form-group">
                          <label for="">Check-Out 锁柜子后，检验员站在边上的照片</label>
                          <input type="file"  accept="image/*" @change="imageCkout" ref="Ckout">
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
                         <button type="button" @click="storeCheckOut(service_id)" class="btn btn-success" :disabled="button==1"><i class="icon-control-play"></i>CHECK OUT</button>
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
                       <p style="font-size:18px;"><b>验货告知书</b></p>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">工作号</label>
                         <input type="text" class="form-control" v-model="reference" readonly>
                       </div>
                   </div>
                   <div class="col-md-4">
                       <label for="">服务类似</label>
                       <input type="text" class="form-control" v-model="category_name" readonly>
                   </div>
                   <div class="col-md-4">
                       <label for="">验货时间</label>
                       <input type="text" class="form-control" v-model="inspection_date" readonly>
                   </div>
                 </div>
                <!--General information finish-->
                <div class="form-group row border">
                  <div class="col-md-12">
                      <p style="font-size:18px;"><b>工厂信息</b></p>
                  </div>
                  <div class="col-md-12">
                      <div class="form-group">
                        <label for="">特殊要求</label>
                        <textarea type="text" class="form-control" v-model="sup_instructions" readonly></textarea>
                      </div>
                  </div>
                </div>
                <!--Quality information begin-->
                 <div class="form-group row border">
                   <div class="col-md-12">
                       <p style="font-size:18px;"><b>产品信息</b></p>
                   </div>
                   <div class="col-md-4">
                     <div class="form-group">
                       <label for="">AQL 级别<span class="required"> * </span></label>
                       <select class="form-control " v-model="aql_level">
                         <option value="0">Choose</option>
                         <option value="2.5">2.5</option>
                         <option value="CustomerRequirement">Customer Standard</option>
                       </select>
                     </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                         <label for="">款数<span class="required"> * </span></label>
                         <input type="text" v-model.number="item_number" class="form-control">
                       </div>
                   </div>
                   <div class="col-md-4">
                     <div class="form-group">
                       <label for="">生产情况<span class="required"> * </span></label>
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
                       <p style="font-size:18px;"><b>疵点总结</b></p>
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
                          <input type="number" class="form-control" v-model="sample_size">
                   </div>
                   <div class="col-md-1">
                          <label>Minor*<span style="color:red;" v-show="minor_defects==''">(*Fill)</span></label>
                          <input type="number" class="form-control" v-model.number="minor_defects">
                   </div>
                   <div class="col-md-1">
                          <label>Major*<span style="color:red;" v-show="major_defects==''">(*Fill)</span></label>
                          <input type="number" class="form-control" v-model.number="major_defects">
                   </div>
                   <div class="col-md-1">
                           <label>Critical*<span style="color:red;" v-show="critical_defects==''">(*Fill)</span></label>
                          <input type="number" class="form-control" v-model.number="critical_defects">
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
                       <p style="font-size:18px;"><b>验货总结</b></p>
                   </div>
                    <div class="table-responsive col-md-12">
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>删除</th>
                                    <th>产品代码</th>
                                    <th>产品描述</th>
                                    <th>Sample Size</th>
                                    <th>Minor Defect</th>
                                    <th>Major Defect</th>
                                    <th>Critical Defect</th>
                                    <th>总数</th>
                                    <th>结果</th>
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
                <!--Inspection Preresult finish-->

                 <!--Inspection photos begin-->
                 <div class="form-group row border">
                   <div class="col-md-12">
                       <p style="font-size:18px;"><b>验货文件</b></p>
                   </div>
                   <div class="col-md-4">
                     <div class="form-group">
                       <label for="">工厂告知书照片<span class="required"> * </span></label>
                       <input type="file" accept="image/*"  @change="imageAcknowQci" ref="AcknowQci">
                     </div>
                   </div>
                   <!--<div class="col-md-4">
                     <div class="form-group">
                       <label for="">Printed packing list photo<span class="required"> * </span></label>
                       <input type="file" accept="image/*" capture="camera" @change="imagePLQci" ref="PLQci">
                     </div>
                   </div>
                   <div class="col-md-4">
                     <div class="form-group">
                       <label for="">Product photo<span class="required"> * </span></label>
                       <input type="file" accept="image/*" capture="camera" @change="imageProduct" ref="Product">
                     </div>
                   </div>
                   <div class="col-md-4">
                     <div class="form-group">
                       <label for="">Sampling warehouse photo<span class="required"> * </span></label>
                       <input type="file" accept="image/*" capture="camera" @change="imageSample" ref="Sample">
                     </div>
                   </div>-->
                   <div class="col-md-4">
                     <div class="form-group">
                       <label for="">拆开抽样照片<span class="required"> * </span></label>
                       <input type="file" accept="image/*"  @change="imageOpSample" ref="OpSample">
                     </div>
                   </div>
                   <div class="col-md-4">
                     <div class="form-group">
                       <label for="">封抽样照片<span class="required"> * </span></label>
                       <input type="file" accept="image/*"  @change="imageClSample" ref="ClSample">
                     </div>
                   </div>
                 </div>
                 <!--Inspection photos finish-->

                 <!--Inspection Result begin-->
                 <div class="form-group row border">
                   <div class="col-md-12">
                       <p style="font-size:18px;"><b>验货结果</b></p>
                   </div>
                   <div class="col-md-6">
                       <div class="form-group">
                         <label for="">是否工厂配合?<span class="required"> * </span></label>
                         <select class="form-control " v-model="fty_cooperate">
                           <option value="3">Choose</option>
                           <option value="1">Yes</option>
                           <option value="2">No</option>
                         </select>
                       </div>
                   </div>

                   <div class="col-md-6">
                       <div class="form-group">
                         <label for="">验货成绩<span class="required"> * </span></label>
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
                         <label for="">备注</label>
                         <textarea class="form-control" v-model="remarks" rows="3" placeholder="Enter ..."></textarea>
                       </div>
                   </div>
                 </div>
                 <!--Inspection Result finish-->
                 <div class="form-group row border">
                   <div class="col-md-12">
                       <p style="font-size:18px;"><b>Check Out</b></p>
                   </div>
                     <div class="form-group ">
                       <div class="col-md-6">
                          <label  for="text-input">时间</label>
                          <input type="text" v-model="check_out" class="form-control" placeholder="Name of the service">
                       </div>
                       <div class="col-md-6">
                         <div class="form-group">
                          <label for="">Check-Out 照片</label>
                          <input type="file"  accept="image/*" capture="camera" @change="imageCkOutQci" ref="CkOutQci">
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
                           <button type="button" @click="closeDetailQci()" class="btn btn-primary">EXIT</button>
                           <button type="button" @click="storeCheckOutQci(service_id)" class="btn btn-danger" :disabled="button==1"><i class="icon-control-play"></i>CHECK OUT</button>
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
                    <input type="file"  accept="image/*"  @change="bank_account_pictureMethod" ref="bank">
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
                <!--<div class="form-group row">
                  <label class="col-md-3 form-control-label" for="text-input">Emergency facilities photo 1</label>
                  <div class="col-md-9">
                    <input type="file"  accept="image/*" capture="camera" @change="img1EfMethod" ref="img1Ef">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 form-control-label" for="text-input">Emergency facilities photo 2</label>
                  <div class="col-md-9">
                    <input type="file"  accept="image/*" capture="camera" @change="img2EfMethod" ref="img2Ef">
                  </div>
                </div>-->
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
               <p hidden>{{result_num=sfaPoints}}</p>
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
                    <input type="file"  accept="image/*" capture="camera" @change="check_outPhMethod" ref="outPhMethod">
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
                       <button type="button" @click="storeCheckOutQci(service_id)" class="btn btn-danger"><i class="icon-control-play"></i>CHECK OUT</button>
                     </div>
                     <div v-else="category_name=='SFA'">
                       <button type="button" @click="closeDetailSfa()" class="btn btn-primary">EXIT</button>
                       <button type="button" @click="storeCheckOutSfa(service_id)" class="btn btn-info" :disabled="button==1"><i class="icon-control-play"></i>CHECK OUT</button>
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
                              <input type="file"  accept="image/*" capture="camera" @change="imageChanged" ref="myImage">
                            </div>
                          </div>
                          <div class="form-group row div-error" v-show="errorCheckout">
                            <div class="text-center text-error">
                              <div class="" v-for="error in errorShowMessageCheckout" :key="error" v-text="error"></div>
                            </div>
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                    <div class="col-md-12" style="text-align:center">
                      <button type="button" class="btn btn-secondary" @click="closeModal()">Close</button>
                      <button type="button" v-if="actionType==1"class="btn btn-primary" @click="checkin(service_id)"><i class="icon-control-play"></i>Start</button>
                      <button type="button" v-if="actionType==2" class="btn btn-primary" @click="storeCheckOut()">Update</button>
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
            reference:'',
            supplier_number:0,
            inspection_date:0,
            // CCI Variables Begin//
            button:0,
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
            //packing_listPh:'',
            ack_Ph:'',
            //c1ack_Ph:'',
            //c2ack_Ph:'',
            count_ck_Ph:'',
            remarks:'',
            check_out:'',
            check_outPh:'',
            //inspContPh:'',
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
            //product_picture:'',
            //sampling_picture:'',
            //printed_plPh:'',
            acknowledgmentPh:'',
            arrayDefect:[],
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
            //--S3 variables finish--//
            //--S4 variables begin--//
            q1Ce:'c',
            q2Ce:'c',
            q3Ce:'c',
            q4Ce:'c',
            q5Ce:'c',
            //--S4 variables finish--//
            //--S5 variables begin--//
            iddetailqtwo:'',
            q1Plm:'c',
            q2Plm:'c',
            q3Plm:'c',
            q4Plm:'c',
            q5Plm:'c',

            //--S5 variables finish--//
            //--S6 variables begin--//
            q1Mp:'c',
            q2Mp:'c',
            q3Mp:'c',
            q4Mp:'c',
            q5Mp:'c',

            //--S6 variables finish--//
            //--S7 variables begin--//
            iddetailqthree:'',
            q1Iin:'c',
            q2Iin:'c',
            q3Iin:'c',
            q4Iin:'c',
            q5Iin:'c',
            //--S7 variables finish--//
            //--S8 variables begin--//
            q1Qm:'c',
            q2Qm:'c',
            q3Qm:'c',
            q4Qm:'c',
            q5Qm:'c',

            //--S8 variables finish--//
            //--S9 variables begin--//
            iddetailqfour:'',
            q1Fi:'c',
            q2Fi:'c',
            q3Fi:'c',
            q4Fi:'c',
            q5Fi:'c',
            //--S9 variables finish--//
            //--S10 variables begin--//
            q1Wh:'c',
            q2Wh:'c',
            q3Wh:'c',
            q4Wh:'c',
            q5Wh:'c',
            //--S10 variables finish--//
            //--S11 variables begin--//
            iddetailqfive:'',
            q1Ef:'c',
            q2Ef:'c',
            q3Ef:'c',
            q4Ef:'c',
            q5Ef:'c',
            //img1Ef:'',
            //img2Ef:'',
            //--S11 variables finish--//

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
            var url= 'onaction/index?page=' + page + '&search=' + search + '&criteria=' + criteria;

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
            this.check_inPh ='';
            this.$refs.myImage.value = '';
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
          closeDetail(){
            this.errorShowMessageCheckout=[];
            this.button = 0;
            this.listado=1;
            this.item_number=0;
            this.spare_parts='0';
            this.item_cnts=0;
            this.sp_cnts=0;
            this.total_cnts=0;
            this.damaged_cnts=0;
            this.pallet_fumigate='3';
            this.pallets_loaded=3;
            this.container_number='';
            this.seal_number='';
            this.fty_cooperate='3';
            this.container_damaged=3;
            this.result='0';
            this.remarks='';
            this.$refs.CNumPh.value  = '';
            this.$refs.SNumPh.value  = '';
            //this.$refs.iPL.value  = '';
            this.$refs.Acknow.value  = '';
            //this.$refs.C1i.value  = '';
            //this.$refs.C2i.value  = '';
            this.$refs.Counting.value  = '';
            //this.$refs.ContPh.value  = '';
            this.$refs.Ckout.value  = '';

          },
          closeDetailQci(){
           this.errorShowMessageCheckout=[];
           this.errorShowMessageCheckoutQci=[];
           this.listado=1;
           this.aql_level='0';
           this.button = 0;
            this.item_number=0;
            this.production_status='0';
            this.arrayDefect=[];
            this.$refs.AcknowQci.value  = '';
            //this.$refs.PLQci.value  = '';
            //this.$refs.Product.value  = '';
            //this.$refs.Sample.value  = '';
            this.$refs.OpSample.value  = '';
            this.$refs.ClSample.value  = '';
            this.fty_cooperate='3';
            this.inspection_result='0';
            this.$refs.CkOutQci.value  = '';
            this.remarks='';

          },
          closeDetailSfa(){
           this.errorShowMessageCheckout=[];
           this.listado=1;
           this.name='';
            this.address='';
            this.button = 0;
            this.website='';
            this.telephone='';
            this.email='';
            this.contact_name='';
            this.contact_mobile='';
            this.contact_position='';
            this.main_product='';
            this.main_market='';
            this.production_capacity='';
            this.registration_date='';
            this.type_of_registration='';
            this.type_of_company='';
            this.employees_number='';
            this.customer_country='';
            this.factory_area_sqm2='';
            this.company_owner='';
            this.general_manager='';
            this.tax_id='';
            this.export_license='';
            this.nearest_port='';
            this.$refs.bank.value  = '';
            this.q1Pa='c';
            this.q2Pa='c';
            this.q3Pa='c';
            this.q4Pa='c';
            this.q5Pa='c';
            this.q1Ce='c';
            this.q2Ce='c';
            this.q3Ce='c';
            this.q4Ce='c';
            this.q5Ce='c';
            this.q1Plm='c';
            this.q2Plm='c';
            this.q3Plm='c';
            this.q4Plm='c';
            this.q5Plm='c';
            this.q1Mp='c';
            this.q2Mp='c';
            this.q3Mp='c';
            this.q4Mp='c';
            this.q5Mp='c';
            this.q1Iin='c';
            this.q2Iin='c';
            this.q3Iin='c';
            this.q4Iin='c';
            this.q5Iin='c';
            this.q1Qm='c';
            this.q2Qm='c';
            this.q3Qm='c';
            this.q4Qm='c';
            this.q5Qm='c';
            this.q1Fi='c';
            this.q2Fi='c';
            this.q3Fi='c';
            this.q4Fi='c';
            this.q5Fi='c';
            this.q1Wh='c';
            this.q2Wh='c';
            this.q3Wh='c';
            this.q4Wh='c';
            this.q5Wh='c';
            this.q1Ef='c';
            this.q2Ef='c';
            this.q3Ef='c';
            this.q4Ef='c';
            this.q5Ef='c';
            //this.$refs.img1Ef.value  = '';
            //this.$refs.img2Ef.value  = '';
            this.$refs.outPhMethod.value  = '';
            this.remarks='';
            this.fty_cooperate=3;

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
              //
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
          /*imagePL(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.packing_listPh = e.target.result;
              }
          },*/
          imageAcknow(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.ack_Ph = e.target.result;
              }
          },
          /*imageC1(e){

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
          },*/
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
          /*imageinspContPh(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.inspContPh = e.target.result;
              }
          },*/
          validateCheckout(){

            this.errorCheckout=0;
            this.errorShowMessageCheckout=[];

            var cn = this.container_numberph;
            var cnn = cn.includes("image/");


            var snph = this.seal_numberph;
            var nsnph = snph.includes("image/");


            //var pl = this.packing_listPh;
            //var npl = pl.includes("image/");


            var ack = this.ack_Ph;
            var nack = ack.includes("image/");


            //var cont = this.inspContPh;
            //var ncont = cont.includes("image/");


            //var c1ack = this.c1ack_Ph;
            //var nc1ack = c1ack.includes("image/");


            //var c2ack = this.c2ack_Ph;
            //var nc2ack = c2ack.includes("image/");


            var countck = this.count_ck_Ph;
            var ncountck = countck.includes("image/");


            var check = this.check_outPh;
            var ncheck = check.includes("image/");


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
            if(cnn==false) this.errorShowMessageCheckout.push("The format of the container picture file must be .jpeg or .jpg");
            if(!this.seal_numberph) this.errorShowMessageCheckout.push("Attach a photo of seal number");
            if(nsnph==false) this.errorShowMessageCheckout.push("The format of the seal photo file must be .jpeg or .jpg");
            //if(!this.packing_listPh) this.errorShowMessageCheckout.push("Attach a photo of printed packing list");
            //if(npl==false) this.errorShowMessageCheckout.push("The format file of the PL photo must be .jpeg or .jpg");
            if(!this.ack_Ph) this.errorShowMessageCheckout.push("Attach a photo of the inspection acknowledgment");
            if(nack==false) this.errorShowMessageCheckout.push("The format file of the acknowledgment photo must be .jpeg or .jpg");
            //if(!this.inspContPh) this.errorShowMessageCheckout.push("Take a photo next to the closed container");
            //if(ncont==false) this.errorShowMessageCheckout.push("The format file of the inspector next to container photo must be .jpeg or .jpg");
            //if(!this.c1ack_Ph) this.errorShowMessageCheckout.push("Attach a photo of container acknowledgement 1");
            //if(nc1ack==false) this.errorShowMessageCheckout.push("The format file of the container acknowledgment 1 photo must be .jpeg or .jpg");
            //if(!this.c2ack_Ph) this.errorShowMessageCheckout.push("Attach a photo of container acknowledgement 2");
            //if(nc2ack==false) this.errorShowMessageCheckout.push("The format file of the container acknowledgment 2 must be .jpeg or .jpg");
            if(!this.count_ck_Ph) this.errorShowMessageCheckout.push("Attach a photo of the counting acknowledgment");
            if(ncountck==false) this.errorShowMessageCheckout.push("The format file of the counting acknowledgment must be .jpeg or .jpg");
            if(this.fty_cooperate==3) this.errorShowMessageCheckout.push("Confirm if factory cooperate or not during the inspection");
            if(this.result==0) this.errorShowMessageCheckout.push("Input the inspection result");
            if(!this.check_outPh) this.errorShowMessageCheckout.push("Please take a selfie photo before leave the factory!");
            if(ncheck==false) this.errorShowMessageCheckout.push("The format file must be .jpeg or .jpg");
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
                    this.button=1;
                    this.$Progress.start();
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
                      //'packing_listPh': this.packing_listPh,
                      'ack_Ph': this.ack_Ph,
                      //'c1ack_Ph': this.c1ack_Ph,
                      //'c2ack_Ph' : this.c2ack_Ph,
                      'count_ck_Ph': this.count_ck_Ph,
                      'check_outPh': this.check_outPh,
                      //'inspContPh' : this.inspContPh

                      }).then(function (response) {
                        me.$Progress.finish();
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

            var ack = this.acknowledgmentPh;
            var ackn = ack.includes("image/");


            //var pl = this.printed_plPh;
            //var pln = pl.includes("image/");

            //var pp = this.product_picture;
            //var ppn = pp.includes("image/");

            //var sp = this.sampling_picture;
            //var spn = sp.includes("image/");

            var ops = this.opened_samplePh;
            var opsn = ops.includes("image/");

            var sss = this.sealed_samplePh;
            var sssn = sss.includes("image/");

            var co = this.check_outPh;
            var con = co.includes("image/");

            if(this.aql_level==0) this.errorShowMessageCheckoutQci.push("Select the inspection standard");
            if(this.item_number<=0) this.errorShowMessageCheckoutQci.push("Input the number of unique items");
            if(this.production_status==0) this.errorShowMessageCheckoutQci.push("Select the status of production");
            if(this.arrayDefect.length==0) this.errorShowMessageCheckoutQci.push("Input number of defects per item");
            if(!this.acknowledgmentPh) this.errorShowMessageCheckoutQci.push("Attach a photo of acknowledgment");
            if(ackn==false) this.errorShowMessageCheckoutQci.push("The format of the acknowledgment picture file must be .jpeg or .jpg");
            //if(!this.printed_plPh) this.errorShowMessageCheckoutQci.push("Attach a photo of printed packing list");
            //if(pln==false) this.errorShowMessageCheckoutQci.push("The format of the Pl picture file must be .jpeg or .jpg");
            //if(!this.product_picture) this.errorShowMessageCheckoutQci.push("Attach a photo of one product");
            //if(ppn==false) this.errorShowMessageCheckoutQci.push("The format of the product picture file must be .jpeg or .jpg");
            //if(!this.sampling_picture) this.errorShowMessageCheckoutQci.push("Attach a photo of the warehouse and selected samples");
            //if(spn==false) this.errorShowMessageCheckoutQci.push("The format of the sampling picture file must be .jpeg or .jpg");
            if(!this.opened_samplePh) this.errorShowMessageCheckoutQci.push("Attach a photo of the openend samples");
            if(opsn==false) this.errorShowMessageCheckoutQci.push("The format of the openend samples picture file must be .jpeg or .jpg");
            if(!this.sealed_samplePh) this.errorShowMessageCheckoutQci.push("Attach a photo of the sealed samples");
            if(sssn==false) this.errorShowMessageCheckoutQci.push("The format of the sealed samples picture file must be .jpeg or .jpg");
            if(this.fty_cooperate==3) this.errorShowMessageCheckoutQci.push("Select wether factory cooperate or not");
            if(this.inspection_result==0) this.errorShowMessageCheckoutQci.push("Select the inspection result");
            if(!this.check_outPh) this.errorShowMessageCheckoutQci.push("Please take a selfie photo before leave the factory!");
            if(con==false) this.errorShowMessageCheckoutQci.push("The format of the check out picture file be .jpeg or .jpg");
            if(this.errorShowMessageCheckoutQci.length) this.errorCheckoutQci = 1;

            return this.errorCheckoutQci;

          },
          imageAcknowQci(e){

              var fileReader = new FileReader();

              fileReader.readAsDataURL(e.target.files[0]);

              fileReader.onload = (e) => {
                this.acknowledgmentPh = e.target.result;
              }
          },
          /*imagePLQci(e){

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
          },*/
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
                this.button=1;
                this.$Progress.start();
                axios.put('onaction/storeCheckOutQci',{
                  'idservice': ids,
                  'iddetail':me.arrayInspDetail['id'],
                  'aql_level':this.aql_level,
                  'item_number':this.item_number,
                  'production_status':this.production_status,
                  'arrayDefect':this.arrayDefect,
                  'acknowledgmentPh':this.acknowledgmentPh,
                  //'printed_plPh':this.printed_plPh,
                  //'product_picture':this.product_picture,
                  //'sampling_picture':this.sampling_picture,
                  'opened_samplePh':this.opened_samplePh,
                  'sealed_samplePh':this.sealed_samplePh,
                  'fty_cooperate':this.fty_cooperate,
                  'inspection_result':this.inspection_result,
                  'check_outPh':this.check_outPh,
                  'remarks':this.remarks,
                  }).then(function (response) {
                    me.$Progress.finish();
                    me.closeDetailQci();
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
                  this.button=1;
                  this.$Progress.start();
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
                    'q1Ce':this.q1Ce,
                    'q2Ce':this.q2Ce,
                    'q3Ce':this.q3Ce,
                    'q4Ce':this.q4Ce,
                    'q5Ce':this.q5Ce,
                    'q1Plm':this.q1Plm,
                    'q2Plm':this.q2Plm,
                    'q3Plm':this.q3Plm,
                    'q4Plm':this.q4Plm,
                    'q5Plm':this.q5Plm,
                    'q1Mp':this.q1Mp,
                    'q2Mp':this.q2Mp,
                    'q3Mp':this.q3Mp,
                    'q4Mp':this.q4Mp,
                    'q5Mp':this.q5Mp,
                    'q1Iin':this.q1Iin,
                    'q2Iin':this.q2Iin,
                    'q3Iin':this.q3Iin,
                    'q4Iin':this.q4Iin,
                    'q5Iin':this.q5Iin,
                    'q1Qm':this.q1Qm,
                    'q2Qm':this.q2Qm,
                    'q3Qm':this.q3Qm,
                    'q4Qm':this.q4Qm,
                    'q5Qm':this.q5Qm,
                    'q1Fi':this.q1Fi,
                    'q2Fi':this.q2Fi,
                    'q3Fi':this.q3Fi,
                    'q4Fi':this.q4Fi,
                    'q5Fi':this.q5Fi,
                    'q1Wh':this.q1Wh,
                    'q2Wh':this.q2Wh,
                    'q3Wh':this.q3Wh,
                    'q4Wh':this.q4Wh,
                    'q5Wh':this.q5Wh,
                    'q1Ef':this.q1Ef,
                    'q2Ef':this.q2Ef,
                    'q3Ef':this.q3Ef,
                    'q4Ef':this.q4Ef,
                    'q5Ef':this.q5Ef,
                    //'img1Ef':this.img1Ef,
                    //'img2Ef':this.img2Ef,
                    'check_outPh':this.check_outPh,
                    'result_num':this.result_num,
                    'remarks':this.remarks,
                    'result':this.result,
                    'fty_cooperate':this.fty_cooperate


                    }).then(function (response) {
                      me.$Progress.finish();
                      me.closeDetailSfa();
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

            var ba = this.bank_account_picture;
            var ban = ba.includes("image/");

            //var ef1 = this.img1Ef;
            //var ef1n = ef1.includes("image/");

            //var ef2 = this.img2Ef;
            //var ef2n = ef2.includes("image/");

            var ck = this.check_outPh;
            var ckn = ck.includes("image/");

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
            if(ban==false) this.errorShowMessageCheckoutSfa.push("The format of the bank account picture file must be .jpeg or .jpg");
            // Finish general information validation

            // Begin section 3 validation
            if(this.q1Pa=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 1 in Section 3");
            if(this.q2Pa=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 2 in Section 3");
            if(this.q3Pa=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 3 in Section 3");
            if(this.q4Pa=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 4 in Section 3");
            if(this.q5Pa=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 5 in Section 3");

            // Finish section 3 validation

            // Begin section 4 validation
            if(this.q1Ce=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 1 in Section 4");
            if(this.q2Ce=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 2 in Section 4");
            if(this.q3Ce=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 3 in Section 4");
            if(this.q4Ce=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 4 in Section 4");
            if(this.q5Ce=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 5 in Section 4");
            // Finish section 4 validation

            // Begin section 5 validation
            if(this.q1Plm=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 1 in Section 5");
            if(this.q2Plm=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 2 in Section 5");
            if(this.q3Plm=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 3 in Section 5");
            if(this.q4Plm=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 4 in Section 5");
            if(this.q5Plm=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 5 in Section 5");
            // Finish section 5 validation

            // Begin section 6 validation
            if(this.q1Mp=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 1 in Section 6");
            if(this.q2Mp=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 2 in Section 6");
            if(this.q3Mp=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 3 in Section 6");
            if(this.q4Mp=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 4 in Section 6");
            if(this.q5Mp=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 5 in Section 6");

            // Finish section 6 validation

            // Begin section 7 validation
            if(this.q1Iin=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 1 in Section 7");
            if(this.q2Iin=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 2 in Section 7");
            if(this.q3Iin=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 3 in Section 7");
            if(this.q4Iin=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 4 in Section 7");
            if(this.q5Iin=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 5 in Section 7");
            // Finish section 7 validation

            // Begin section 8 validation
            if(this.q1Qm=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 1 in Section 8");
            if(this.q2Qm=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 2 in Section 8");
            if(this.q3Qm=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 3 in Section 8");
            if(this.q4Qm=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 4 in Section 8");
            if(this.q5Qm=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 5 in Section 8");
            // Finish section 8 validation

            // Begin section 9 validation
            if(this.q1Fi=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 1 in Section 9");
            if(this.q2Fi=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 2 in Section 9");
            if(this.q3Fi=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 3 in Section 9");
            if(this.q4Fi=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 4 in Section 9");
            if(this.q5Fi=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 5 in Section 9");
            // Finish section 9 validation

            // Begin section 10 validation
            if(this.q1Wh=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 1 in Section 10");
            if(this.q2Wh=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 2 in Section 10");
            if(this.q3Wh=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 3 in Section 10");
            if(this.q4Wh=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 4 in Section 10");
            if(this.q5Wh=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 5 in Section 10");
            // Finish section 10 validation

            // Begin section 11 validation
            if(this.q1Ef=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 1 in Section 11");
            if(this.q2Ef=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 2 in Section 11");
            if(this.q3Ef=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 3 in Section 11");
            if(this.q4Ef=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 4 in Section 11");
            if(this.q5Ef=="c") this.errorShowMessageCheckoutSfa.push("Choose an option for question 5 in Section 11");
            //if(!this.img1Ef) this.errorShowMessageCheckoutSfa.push("Attach a photo of Emergency facilities 1");
            //if(ef1n==false) this.errorShowMessageCheckoutSfa.push("The format of the Emergency facilities 1 picture file must be .jpeg or .jpg");
            //if(!this.img2Ef) this.errorShowMessageCheckoutSfa.push("Attach a photo of Emergency facilities 2");
            //if(ef2n==false) this.errorShowMessageCheckoutSfa.push("The format of the Emergency facilities 2 picture file must be .jpeg or .jpg");

            // Finish section 11 validation

            // Inspection result
            if(this.fty_cooperate=="3") this.errorShowMessageCheckoutSfa.push("Confirm wether factory cooperate or not");
            // Inspection result

            if(!this.check_outPh) this.errorShowMessageCheckoutSfa.push("Please take a selfie photo before leave the factory!");
            if(ckn==false) this.errorShowMessageCheckoutSfa.push("The format of the checkout picture file must be .jpeg or .jpg");

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
          /*img1EfMethod(e){

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
          },*/
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
