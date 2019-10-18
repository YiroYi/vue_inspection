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
                 </ul>
            </div>
          </div>
      </div>
      <!-- end sidebar menu -->
