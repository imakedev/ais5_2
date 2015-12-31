 <!-- iCheck -->
<link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
<link href="/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
  
 <!-- Main title Start -->
        	<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Design Trend </h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Design</a>
                        </li>
                       
                        <li class="active">
                            <strong>Design Trend</strong>
                        </li>
                    </ol>
                </div>
                
            </div>
            
<!-- Main title end -->          
<div class='row'>

<!-- Table trend start-->
<div class="col-lg-12">
            <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Design Trend Management</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
            <div class="row">
	            <div class='col-md-12'>
		            <a data-target="#myModal2" data-toggle="modal"  class="btn btn-primary  btn-sm">Add Trend</a> 
		            <a class="btn btn-w-m btn-warning  btn-sm">Edit Trend</a>
		            <a class="btn btn-w-m btn-danger  btn-sm">Delete Trend</a>
	            </div>
            </div>
            
            <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
           
            <div class="row">
            <div class="col-sm-12">
            
            <table id="editable" class="table table-striped table-bordered table-hover  dataTable" role="grid" aria-describedby="editable_info">
            <thead>
            <tr role="row">
            <th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1" style="width: 0%;" aria-sort="" aria-label="">
            
            </th>
            <th class="" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" style="width: 90%;" aria-label="Browser: activate to sort column ascending">
            Trend Name
            </th>
            <th class="" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" style="width: 10%;" aria-label="Platform(s): activate to sort column ascending">
           Action
            </th>
           
            </tr>
            </thead>
            <tbody>
            
            <tr class="gradeA odd" role="row">
                <td class="sorting_1">
                <div class="icheckbox_square-green checked" style="position: relative;"><input type="checkbox" name="input[]" class="i-checks" checked="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div>
                </td>
                <td>Trend Name001</td>
                <td> <a class="btn btn-primary  btn-xs">แสดง Point</a></td>
               
            </tr><tr class="gradeA even" role="row">
                <td class="sorting_1"><div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" name="input[]" class="i-checks" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div></td>
                <td>Trend Name 1.5</td>
                <td><a class="btn btn-primary  btn-xs">แสดง Point</a></td>
                
            </tr><tr class="gradeA odd" role="row">
                <td class="sorting_1"><div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" name="input[]" class="i-checks" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div></td>
                <td>Trend Name 2.0</td>
                <td><a class="btn btn-primary  btn-xs">แสดง Point</a></td>
            
            </tr><tr class="gradeA even" role="row">
                <td class="sorting_1"><div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" name="input[]" class="i-checks" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div></td>
                <td>Trend Name 3.0</td>
                <td><a class="btn btn-primary  btn-xs">แสดง Point</a></td>
            
            </tr><tr class="gradeA odd" role="row">
                <td class="sorting_1"><div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" name="input[]" class="i-checks" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div></td>
                <td>Trend Name 1.0</td>
                <td><a class="btn btn-primary  btn-xs">แสดง Point</a></td>
                
            </tr>
            </tbody>
            
            </table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="editable_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="editable_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="editable_previous"><a href="#" aria-controls="editable" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="editable" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="editable" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="editable" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="editable" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="editable" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="editable" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="editable_next"><a href="#" aria-controls="editable" data-dt-idx="7" tabindex="0">Next</a></li></ul></div></div></div></div>

            </div>
            </div>
            </div>
<!-- Table trend end-->
            
            
<!-- Table show point start-->
<div class="col-lg-12">
            <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>แสดง Point ของ Trend001 </h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
            <div class="row">
            <div class="col-md-6 ">
	            <a data-target="#myModalAddPoint" data-toggle="modal"  class="btn btn-primary  btn-sm">Add Point</a> 
	            <a class="btn btn-w-m btn-warning  btn-sm">Edit Point</a>
	            <a class="btn btn-w-m btn-danger  btn-sm">Delete Point</a>
            </div>
             <div class="col-md-3 lableDropdownList">MMPlant</div>
             <div class="col-md-3">
	             <select name="account" class="form-control m-b">
	                <option>MM04</option>
	                <option>MM05</option>
	                <option>MM06</option>
	                <option>MM07</option>
	            </select>
             </div>
           
            </div>
            
            <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
           
            <div class="row">
            <div class="col-sm-12">
            
            <table id="editable" class="table table-striped table-bordered table-hover  dataTable" role="grid" aria-describedby="editable_info">
            <thead>
            <tr role="row">
            <th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1" style="width: 0%;" aria-sort="" aria-label="">
            
            </th>
            <th class="" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" style="width: 10%;" aria-label="Browser: activate to sort column ascending">
           	Point
            </th>
            <th class="" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" style="width: 5%;" aria-label="Platform(s): activate to sort column ascending">
           	MM
            </th>
            <th class="" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" style="width: 35%;" aria-label="Platform(s): activate to sort column ascending">
           	Point Name
            </th>
            <th class="" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" style="width: 15%;" aria-label="Platform(s): activate to sort column ascending">
          	 Tag Name
            </th>
            <th class="" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" style="width: 10%;" aria-label="Platform(s): activate to sort column ascending">
           	Unit
            </th>
            <th class="" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" style="width: 5%;" aria-label="Platform(s): activate to sort column ascending">
           	Max
            </th>
            <th class="" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" style="width: 5%;" aria-label="Platform(s): activate to sort column ascending">
          	 Min
            </th>
           
            </tr>
            </thead>
            <tbody>
            
            <tr class="gradeA odd" role="row">
                <td class="sorting_1">
                <div class="icheckbox_square-green " style="position: relative;">
                <input type="checkbox" name="input[]" class="i-checks" checked="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div>
                </td>
                <td>Point001</td>
                <td>4</td>
                <td>43MSP Control Deviation</td>
                <td>40HF02U066</td>
                <td>N/A</td>
                <td>2</td>
                <td>0</td>
                
               
            </tr><tr class="gradeA even" role="row">
                <td class="sorting_1">
                <div class="icheckbox_square-green " style="position: relative;">
                <input type="checkbox" name="input[]" class="i-checks" checked="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div>
                </td>
                <td>Point002</td>
                <td>5</td>
                <td>43MSP Control Deviation</td>
                <td>40HF02U066</td>
                <td>N/A</td>
                <td>2</td>
                <td>0</td>
                
            </tr><tr class="gradeA odd" role="row">
               <td class="sorting_1">
                <div class="icheckbox_square-green " style="position: relative;">
                <input type="checkbox" name="input[]" class="i-checks" checked="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div>
                </td>
               <td>Point003</td>
                <td>6</td>
                <td>43MSP Control Deviation</td>
                <td>40HF02U066</td>
                <td>N/A</td>
                <td>2</td>
                <td>0</td>
            
            </tr><tr class="gradeA even" role="row">
               <td class="sorting_1">
                <div class="icheckbox_square-green " style="position: relative;">
                <input type="checkbox" name="input[]" class="i-checks" checked="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div>
                </td>
               <td>Point004</td>
                <td>7</td>
                <td>43MSP Control Deviation</td>
                <td>40HF02U066</td>
                <td>N/A</td>
                <td>2</td>
                <td>0</td>
            
            
            </tbody>
            
            </table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="editable_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="editable_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="editable_previous"><a href="#" aria-controls="editable" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="editable" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="editable" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="editable" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="editable" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="editable" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="editable" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="editable_next"><a href="#" aria-controls="editable" data-dt-idx="7" tabindex="0">Next</a></li></ul></div></div></div></div>

            </div>
            </div>
            </div>
<!-- Table show point end-->
		
</div>
<!-- Modal Start -->
<div aria-hidden="true" role="dialog" tabindex="-1" id="myModal2" class="modal inmodal in" style="display: none;">
     <div class="modal-dialog">
      <div class="modal-content animated flipInY">
        <div class="modal-header">
          <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
           <h5 class="modal-title">เพิ่ม Trend</h5>
              
           </div>
          <div class="modal-body">
          	
                            <form class="form-horizontal">
                               
                                <div class="form-group">
                                	<label class="col-lg-2 control-label padding5">ชื่อ Trend</label>

                                    <div class="col-lg-10 padding5">
                                    	<input type="email" class="form-control " placeholder="ชื่อ Trend"> 
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label padding5">Trend Group</label>

                                    <div class="col-lg-10 padding5">
	                                    <select name="account" class="form-control m-b">
	                                        <option>Trend Group</option>
	                                        <option>Trend Group1</option>
	                                        <option>Trend Group2</option>
	                                        <option>Trend Group3</option>
	                                    </select>
                                    </div>
                                </div>
                               
                                
                            </form>
                        
          </div>
         <div class="modal-footer">
         <button data-dismiss="modal" class="btn btn-white" type="button">ยกเลิก</button>
        <button class="btn btn-primary" type="button">เพิ่ม</button>
      </div>
     </div>
   </div>
  </div>
<!-- Modal End -->
  
  
  
  <!-- Modal Add Point Start -->
<div aria-hidden="true" role="dialog" tabindex="-1" id="myModalAddPoint" class="modal inmodal in" style="display: none;">
     <div class="modal-dialog modal-lg">
      <div class="modal-content animated flipInY">
        <div class="modal-header">
          <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
           <h5 class="modal-title">เพิ่ม Point ไปที่ Trend001</h5>
              
           </div>
          <div class="modal-body">
          
          	<!-- Table show point start-->
			<div class="col-lg-12">
            <div class="ibox float-e-margins">
            
            <div class="ibox-content">
            <div class="row">
            
             <div class="col-md-3 lableDropdownList">MMPlant</div>
             <div class="col-md-3">
	             <select name="account" class="form-control m-b">
	                <option>MM04</option>
	                <option>MM05</option>
	                <option>MM06</option>
	                <option>MM07</option>
	                <option>MM04-07</option>
	                <option>My Calculation</option>
	                <option>All Calculation</option>
	            </select>
             </div>
              <div class="col-md-3 ">
              <input type="email" placeholder="ค้นหา" class="form-control ">
              </div>
             <div class="col-md-3">
	            	<bunton class='btn btn-primary  btn-sm'>ค้นหา</bunton>
             </div>
            
             
             
           
            </div>
            
            <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
           
            <div class="row">
            <div class="col-sm-12">
            
            <table id="editable" class="table table-striped table-bordered table-hover  dataTable" role="grid" aria-describedby="editable_info">
            <thead>
            <tr role="row">
            <th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1" style="width: 0%;" aria-sort="" aria-label="">
            
            </th>
            <th class="" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" style="width: 20%;" aria-label="Browser: activate to sort column ascending">
           	Point Name
            </th>
            <th class="" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" style="width: 13%;" aria-label="Platform(s): activate to sort column ascending">
           	Tag4
            </th>
            <th class="" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" style="width: 13%;" aria-label="Platform(s): activate to sort column ascending">
           	Tag5
            </th>
            <th class="" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" style="width: 13%;" aria-label="Platform(s): activate to sort column ascending">
          	Tag6
            </th>
            <th class="" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" style="width: 13%;" aria-label="Platform(s): activate to sort column ascending">
           	Tag7
            </th>
            <th class="" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" style="width: 5%;" aria-label="Platform(s): activate to sort column ascending">
           	Unit
            </th>
            <th class="" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" style="width: 5%;" aria-label="Platform(s): activate to sort column ascending">
          	 Max
            </th>
             <th class="" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" style="width: 5%;" aria-label="Platform(s): activate to sort column ascending">
          	 Min
            </th>
             <th class="" tabindex="0" aria-controls="editable" rowspan="1" colspan="1" style="width: 5%;" aria-label="Platform(s): activate to sort column ascending">
          	 Data
            </th>
           
            </tr>
            </thead>
            <tbody>
            
            <tr class="gradeA odd" role="row">
                <td class="sorting_1">
                <div class="icheckbox_square-green " style="position: relative;">
                <input type="checkbox" name="input[]" class="i-checks" checked="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div>
                </td>
                <td>Point001</td>
                <td>40HF02U066</td>
                <td>50HF02U066</td>
                <td>60HF02U066</td>
                <td>70HF02U066</td>
                <td>N/A</td>
                <td>2</td>
                <td>0</td>
                <td>435</td>
                
               
            </tr><tr class="gradeA even" role="row">
                <td class="sorting_1">
                <div class="icheckbox_square-green " style="position: relative;">
                <input type="checkbox" name="input[]" class="i-checks" checked="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div>
                </td>
               <td>Point002</td>
                <td>40HF02U066</td>
                <td>50HF02U066</td>
                <td>60HF02U066</td>
                <td>70HF02U066</td>
                <td>N/A</td>
                <td>2</td>
                <td>0</td>
                <td>432</td>
                
            </tr><tr class="gradeA odd" role="row">
               <td class="sorting_1">
                <div class="icheckbox_square-green " style="position: relative;">
                <input type="checkbox" name="input[]" class="i-checks" checked="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div>
                </td>
               <td>Point003</td>
                <td>40HF02U066</td>
                <td>50HF02U066</td>
                <td>60HF02U066</td>
                <td>70HF02U066</td>
                <td>N/A</td>
                <td>2</td>
                <td>0</td>
                <td>433</td>
            
            </tr><tr class="gradeA even" role="row">
               <td class="sorting_1">
                <div class="icheckbox_square-green " style="position: relative;">
                <input type="checkbox" name="input[]" class="i-checks" checked="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div>
                </td>
               <td>Point004</td>
                <td>40HF02U066</td>
                <td>50HF02U066</td>
                <td>60HF02U066</td>
                <td>70HF02U066</td>
                <td>N/A</td>
                <td>2</td>
                <td>0</td>
                <td>436</td>
            
            
            </tbody>
            
            </table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="editable_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="editable_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="editable_previous"><a href="#" aria-controls="editable" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="editable" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="editable" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="editable" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="editable" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="editable" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="editable" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="editable_next"><a href="#" aria-controls="editable" data-dt-idx="7" tabindex="0">Next</a></li></ul></div></div></div></div>
				<div class='col-md-2'>
					<input type="email" placeholder="Max" class="form-control ">
				</div>
				<div class='col-md-2'>
					<input type="email" placeholder="Min" class="form-control ">
				</div>
				<div class='col-md-4 lableText'>
				หน่วยวัด: N/A
				</div>
				<br>
            </div>
            </div>
            </div>
<!-- Table show point end-->
                           
                        
          </div>
         <div class="modal-footer">
         <button data-dismiss="modal" class="btn btn-white" type="button">ยกเลิก</button>
        <button class="btn btn-primary" type="button">เพิ่ม</button>
      </div>
     </div>
   </div>
  </div>
<!-- Modal Add Point End -->
