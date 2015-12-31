<!-- Add User Modal Start -->
<div aria-hidden="true" role="dialog" tabindex="-1" id="modalAddEditUser" class="modal inmodal in" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h5 class="modal-title">เพิ่มผู้ใช้งาน</h5>
            {!! Form::open(array('user'=>'ais/addUser/store', 'class'=>'form-horizontal')) !!}
            <div class="modal-body">
                    <div class="form-group">
                        <label class="col-lg-2 control-label padding5">เลขประจำตัว</label>
                        <div class="col-lg-10 padding5">
                            <input type="text" class="form-control" id="empNo" name="empNo" placeholder="เลขประจำตัว">
                            {{--<span id="empNo_msg">eror</span>--}}
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-2 control-label padding5">ยศ/ตำแหน่ง</label>
                        <div class="col-lg-10 padding5">
                            <select id="empTitle" name="empTitle" class="form-control m-b">
                                <option value="นาย">นาย</option>
                                <option value="นาง">นาง</option>
                                <option value="นางสาว">นางสาว</option>
                                <option value="">...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label padding5">ชื่อ</label>
                        <div class="col-lg-10 padding5">
                            <input id="empFirstName" name="empFirstName" type="text" class="form-control" placeholder="ชื่อ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label padding5">นามสกุล</label>
                        <div class="col-lg-10 padding5">
                            <input id="empLastName" name="empLastName" type="text" class="form-control" placeholder="นามสกุล">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label padding5">Priority</label>
                        <div class="col-lg-10 padding5">
                            <input id="empPriority" name="empPriority" type="text" class="form-control " placeholder="">
                        </div>
                    </div>
                    <input type="hidden" id="empId" name="empId">
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit" onclick="return validateForm()">Save</button>
                <button class="btn btn-white" type="button" data-dismiss="modal">Cancel</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- Modal End -->