<script src='Controller/cTrendColor.js'></script>
<link href="css/trendColor.css" rel="stylesheet">

<script src='js/spectrum.js'></script>
<link rel='stylesheet' href='css/spectrum.css' />



<div class="ibox">
    <div class="ibox-title">
        <h5>Defind Colos Point</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
            <a class="fullscreen-link">
                <i class="fa fa-expand"></i>
            </a>
            <a class="close-link">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content">
           
     <!-- content start -->            
                            
        <div class='row alert alert-warning'>
            <div class='col-xs-2'>
            
                <!-- set color start  -->
                <div class='ballArea'>
                    <div class='ball redBall'>
                    <input type='text' class="customColors" />
                    </div>
                    <div class='textBall'>
                        Point 1
                    </div>
                </div>
                 <!-- set color end  -->
                 
            </div>
            <div class='col-xs-2'>
                <!-- set color start  -->
                <div class='ballArea'>
                    <div class='ball'>
                    <input type='text' class="customColors" />
                    </div>
                    <div class='textBall'>
                        Point 2
                    </div>
                </div>
                <!-- set color end  -->
            </div>
            <div class='col-xs-2'>
                <!-- set color start  -->
                <div class='ballArea'>
                    <div class='ball'>
                    <input type='text' class="customColors" />
                    </div>
                    <div class='textBall'>
                         Point 3
                    </div>
                </div>
                <!-- set color end  -->
            </div>
            <div class='col-xs-2'>
                <!-- set color start  -->
                <div class='ballArea'>
                    <div class='ball'>
                     <input type='text' class="customColors" />
                    </div>
                    <div class='textBall'>
                         Point 4
                    </div>
                </div>
                <!-- set color end  -->
            </div>
             <div class='col-xs-2'>
               <!-- set color start  -->
                <div class='ballArea'>
                    <div class='ball '>
                     <input type='text' class="customColors" />
                    </div>
                    <div class='textBall'>
                         Point 5
                    </div>
                </div>
                <!-- set color end  -->
            </div>
             <div class='col-xs-2'>
                <!-- set color start  -->
                <div class='ballArea'>
                    <div class='ball '>
                     <input type='text' class="customColors" />
                    </div>
                    <div class='textBall'>
                         Point 6
                    </div>
                </div>
                <!-- set color end  -->
            </div>
             <div class='col-xs-2'>
                <!-- set color start  -->
                <div class='ballArea'>
                    <div class='ball '>
                     <input type='text' class="customColors" />
                    </div>
                    <div class='textBall'>
                         Point 7
                    </div>
                </div>
                <!-- set color end  -->
            </div>
             <div class='col-xs-2'>
                <!-- set color start  -->
                <div class='ballArea'>
                    <div class='ball '>
                     <input type='text' class="customColors" />
                    </div>
                    <div class='textBall'>
                         Point 8
                    </div>
                </div>
                <!-- set color end  -->
            </div>
             <div class='col-xs-2'>
                <!-- set color start  -->
                <div class='ballArea'>
                    <div class='ball '>
                     <input type='text' class="customColors" />
                    </div>
                    <div class='textBall'>
                         Point 9
                    </div>
                </div>
                <!-- set color end  -->
            </div>
             <div class='col-xs-2'>
                <!-- set color start  -->
                <div class='ballArea'>
                    <div class='ball'>
                     <input type='text' class="customColors" />
                    </div>
                    <div class='textBall'>
                         Point 10
                    </div>
                </div>
                <!-- set color end  -->
            </div>
             <div class='col-xs-2'>
                <!-- set color start  -->
                <div class='ballArea'>
                    <div class='ball'>
                     <input type='text' class="customColors" />
                    </div>
                    <div class='textBall'>
                         Point 11
                    </div>
                </div>
                <!-- set color end  -->
            </div>
             <div class='col-xs-2'>
                <!-- set color start  -->
                <div class='ballArea'>
                    <div class='ball'>
                     <input type='text' class="customColors" />
                    </div>
                    <div class='textBall'>
                         Point 12
                    </div>
                </div>
                <!-- set color end  -->
            </div>
           
        </div>
        
        <div class='row'>
            <div class='col-xs-12'>
                <input type='radio' >เส้นหนา
                <input type='radio' checked='checked'>เส้นปกติ
                <input type='radio'>เส้นบาง
            </div>
        </div>
        <br style='clear: both'>
     <!-- content end -->
    
    </div>

<!-- Modal Start -->
<div aria-hidden="true" role="dialog" tabindex="-1" id="modalAddEditUser" class="modal inmodal in" style="display: none;">
     <div class="modal-dialog">
      <div class="modal-content animated flipInY">
        <div class="modal-header">
          <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
           <h5 class="modal-title">เพิ่มผู้ใช้งาน</h5>
              
           </div>
          <div class="modal-body">
          	
                            <form class="form-horizontal">
                               
                                <div class="form-group">
                                	<label class="col-lg-2 control-label padding5">เลขประจำตัว</label>

                                    <div class="col-lg-10 padding5">
                                    	<input type="text" class="form-control " placeholder="เลขประจำตัว"> 
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label padding5">ยศ/ตำแหน่ง</label>

                                    <div class="col-lg-10 padding5">
	                                    <select name="account" class="form-control m-b">
	                                        <option>นาย</option>
	                                        <option>นาง</option>
	                                        <option>นางสาว</option>
	                                        <option>...</option>
	                                    </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                	<label class="col-lg-2 control-label padding5">ชื่อ</label>

                                    <div class="col-lg-10 padding5">
                                    	<input type="text" class="form-control " placeholder="เลขประจำตัว"> 
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                	<label class="col-lg-2 control-label padding5">นามสกุล</label>

                                    <div class="col-lg-10 padding5">
                                    	<input type="text" class="form-control " placeholder=""> 
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                	<label class="col-lg-2 control-label padding5">Priority</label>

                                    <div class="col-lg-10 padding5">
                                    	<input type="text" class="form-control " placeholder=""> 
                                    </div>
                                </div>
                               
                                
                            </form>
                        
          </div>
         <div class="modal-footer">
         <button class="btn btn-primary" type="button">Add</button>
         <button data-dismiss="modal" class="btn btn-white" type="button">Cancel</button>
        
      </div>
     </div>
   </div>
  </div>
<!-- Modal End -->