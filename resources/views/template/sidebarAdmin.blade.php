<div class="sidebar-container">
  <div class="sidemenu-container navbar-collapse collapse fixed-menu">
            <div id="remove-scroll">
                <ul class="sidemenu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                    <li class="sidebar-toggler-wrapper hide">
                        <div class="sidebar-toggler">
                            <span></span>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link nav-toggle"> <i class="material-icons">desktop_mac</i>
                            <span class="title">System Management</span> <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                          <li @click="menu=0" class="nav-item">
                              <a href="#" class="nav-link "> <span class="title">Category management</span>
                              </a>
                          </li>
                            <li @click="menu=1" class="nav-item">
                                <a href="#" class="nav-link "> <span class="title">Users management</span>
                                </a>
                            </li>
                            <li @click="menu=13" class="nav-item">
                                <a href="#" class="nav-link "> <span class="title">Forwarder management</span>
                                </a>
                            </li>
                            <li @click="menu=12" class="nav-item">
                                <a href="#" class="nav-link "> <span class="title">Role management</span>
                                </a>
                            </li>
                            <li @click="menu=14" class="nav-item">
                                <a href="#" class="nav-link "> <span class="title">Billing company</span>
                                </a>
                            </li>
                            <li @click="menu=15" class="nav-item">
                                <a href="#" class="nav-link "> <span class="title">Inspection status</span>
                                </a>
                            </li>
                            <li @click="menu=29" class="nav-item">
                                <a href="#" class="nav-link "> <span class="title">Cancel inspection</span>
                                </a>
                            </li>
                            <!--<li @click="menu=17" class="nav-item">
                                <a href="#" class="nav-link "> <span class="title">Cost management</span>
                                </a>
                            </li>-->
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link nav-toggle"> <i class="material-icons">grain</i>
                            <span class="title">CS management</span> <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li @click="menu=16" class="nav-item">
                                <a  href="#" class="nav-link "><span class="title">New inspection</span>
                                </a>
                            </li>
                            <li @click="menu=2"class="nav-item">
                                <a  href="#" class="nav-link "><span class="title">Customer management</span>
                                </a>
                            </li>
                            <li @click="menu=3" class="nav-item">
                                <a  href="#" class="nav-link "><span class="title">Supplier management</span>
                                </a>
                            </li>
                            <li @click="menu=30" class="nav-item">
                                <a  href="#" class="nav-link "><span class="title">Invoice management</span>
                                </a>
                            </li>
                            <!--<li @click="menu=5" class="nav-item">
                                <a  href="#" class="nav-link "><span class="title">Cost Management</span>
                                </a>
                            </li>-->
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link nav-toggle">
                            <i class="material-icons">dvr</i>
                            <span class="title">Inspection Mngmnt</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li @click="menu=6" class="nav-item">
                                <a href="#" class="nav-link ">
                                    <span class="title">Create inspector</span>
                                </a>
                            </li>
                            <li @click="menu=7" class="nav-item">
                                <a href="#" class="nav-link ">
                                    <span class="title">Inspection plan</span>
                                </a>
                            </li>
                            <li @click="menu=8" class="nav-item">
                                <a href="#" class="nav-link ">
                                    <span class="title">Arranged inspections</span>
                                </a>
                            </li>
                            <li @click="menu=11" class="nav-item">
                                <a href="#" class="nav-link ">
                                    <span class="title">Monitoring inspections</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link nav-toggle">
                            <i class="material-icons">store</i>
                            <span class="title">Inspector tasks</span>
                            <span class="arrow"></span>
                        </a>
                        <ul  class="sub-menu">
                            <li @click="menu=9" class="nav-item">
                                <a href="#" class="nav-link ">
                                    <span class="title">My inspections</span>
                                </a>
                            </li>
                            <li @click="menu=10" class="nav-item">
                                <a href="#" class="nav-link ">
                                    <span class="title">On action</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="material-icons">find_in_page</i>
                            <span class="title">Quality Management </span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li @click="menu=5" class="nav-item" >
                                <a href="#" class="nav-link ">
                                    <span class="title">Completed CCI Revision</span>
                                </a>
                            </li>
                            <li @click="menu=18" class="nav-item" >
                                <a href="#" class="nav-link ">
                                    <span class="title">Completed QCI Revision</span>
                                </a>
                            </li>
                            <li @click="menu=19" class="nav-item" >
                                <a href="#" class="nav-link ">
                                    <span class="title">Completed SFA Revision</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="material-icons">description</i>
                            <span class="title">Reporting Management</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li @click="menu=20" class="nav-item" >
                                <a href="#" class="nav-link ">
                                    <span class="title">CCI Report</span>
                                </a>
                            </li>
                            <li @click="menu=21" class="nav-item" >
                                <a href="#" class="nav-link ">
                                    <span class="title">QCI Report</span>
                                </a>
                            </li>
                            <li @click="menu=22" class="nav-item" >
                                <a href="#" class="nav-link ">
                                    <span class="title">SFA Report</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="fa fa-handshake-o"></i>
                            <span class="title">Sales Management</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li @click="menu=23" class="nav-item" >
                                <a href="#" class="nav-link ">
                                    <span class="title">New Inspection</span>
                                </a>
                            </li>
                            <li @click="menu=24" class="nav-item" >
                                <a href="#" class="nav-link ">
                                    <span class="title">Inspection Tracking</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <span class="title">Inspection Pre-result</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li @click="menu=25" class="nav-item" >
                                        <a href="#" class="nav-link ">
                                            <span class="title">CCI</span>
                                        </a>
                                    </li>
                                    <li @click="menu=26" class="nav-item" >
                                        <a href="#" class="nav-link ">
                                            <span class="title">QCI</span>
                                        </a>
                                    </li>
                                    <li @click="menu=27" class="nav-item" >
                                        <a href="#" class="nav-link ">
                                            <span class="title">SFA</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li @click="menu=28" class="nav-item" >
                                <a href="#" class="nav-link ">
                                    <span class="title">Inspection Completed</span>
                                </a>
                            </li>
                        </ul>
                    </li>
            </div>
          </div>
      </div>
      <!-- end sidebar menu -->
