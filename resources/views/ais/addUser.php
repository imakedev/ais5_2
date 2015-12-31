<script src='/Controller/cAddUser.js'></script>
<link href="/css/addUser.css" rel="stylesheet">

<div class="ibox">
    <div class="ibox-title">
        <h5>เพิ่มรายชื่อผู้ใช้งาน</h5>
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
            <div class="row bgParam">
	            <div class="col-md-12">
		            <a class="btn btn-primary  btn-sm" data-toggle="modal" data-target="#modalAddEditUser">Add User</a> 
		            <a class="btn btn-w-m btn-warning  btn-sm" data-toggle="modal" data-target="#modalAddEditUser">Edit User</a>
		            <a class="btn btn-w-m btn-danger  btn-sm">Delete User</a>
	            </div>
            </div>
      <!-- grid list user -->
      <table id="gridUserList">
            <colgroup>
                <col style="width:3%"/>
                <col style="width:10%"/>
                <col style="width:8%" />
                <col style="width:50%" />
                <col style="width:8%" />
            </colgroup>
            <thead>
                <tr>
                    <th data-field="field1">
                        <input type='checkbox'>
                    </th>
                    <th data-field="field2"><b>เลขประจำตัว</b></th>
                    <th data-field="field3"><b>คำนำหน้า</b></th>
                    <th data-field="field4"><b>ชื่อ-นามสกุล</b></th>
                    <th data-field="field5"><b>Priority</b></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                    <div class='listCheckbox'><input type='checkbox'></div>
                    </td>
                    <td>505684</td>
                    <td>นาย</td>
                    <td>บุญส่ง พะกาวัลย์</td>
                    <td>64</td>
                </tr>
                 <tr>
                    <td>
                    <div class='listCheckbox'><input type='checkbox'></div>
                    </td>
                    <td>505684</td>
                    <td>นาย</td>
                    <td>บุญส่ง พะกาวัลย์</td>
                     <td>64</td>
                </tr>
                 <tr>
                    <td>
                    <div class='listCheckbox'><input type='checkbox'></div>
                    </td>
                    <td>505684</td>
                    <td>นาย</td>
                    <td>บุญส่ง พะกาวัลย์</td>
                     <td>64</td>
                </tr>
                 <tr>
                    <td>
                    <div class='listCheckbox'><input type='checkbox'></div>
                    </td>
                    <td>505684</td>
                    <td>นาย</td>
                    <td>บุญส่ง พะกาวัลย์</td>
                     <td>64</td>
                </tr>
                 <tr>
                    <td>
                    <div class='listCheckbox'><input type='checkbox'></div>
                    </td>
                    <td>505684</td>
                    <td>นาย</td>
                    <td>บุญส่ง พะกาวัลย์</td>
                     <td>64</td>
                </tr>
                 <tr>
                    <td>
                    <div class='listCheckbox'><input type='checkbox'></div>
                    </td>
                    <td>505684</td>
                    <td>นาย</td>
                    <td>บุญส่ง พะกาวัลย์</td>
                     <td>64</td>
                </tr>
                 
                
            </tbody>
       </table>
       <br style='clear:both'>
      <!-- grid list user -->
        
    </div>
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