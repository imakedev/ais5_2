<!-- TagConfiguration Modal Start -->
<div aria-hidden="true" role="dialog" tabindex="-1" id="modalAddEditTag" class="modal inmodal in" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h5 class="modal-title">Add New Tag Data</h5>
            </div>
            <div class="modal-body">
                {!! Form::open(array('user'=>'ais/tagConfiguration/store','class'=>'form-horizontal')) !!}
                    <div class='row'>
                        <div class='col-md-6'>
                            <div class="form-group">
                                <label class="col-lg-3 control-label padding5">Description</label>
                                <div class="col-lg-9 padding5">
                                    <input type="text" id="tagDescription" name="tagDescription" class="form-control " placeholder="Description">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label padding5">Tag4</label>
                                <div class="col-lg-9 padding5">
                                    <input type="text" id="tag4" name="tag4" class="form-control " placeholder="Tag4">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label padding5">Tag5</label>
                                <div class="col-lg-9 padding5">
                                    <input type="text" id="tag5" name="tag5" class="form-control " placeholder="Tag5">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label padding5">Tag6</label>
                                <div class="col-lg-9 padding5">
                                    <input type="text" id="tag6" name="tag6" class="form-control " placeholder="Tag6">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label padding5">Tag7</label>
                                <div class="col-lg-9 padding5">
                                    <input type="text" id="tag7" name="tag7" class="form-control" placeholder="Tag7">
                                </div>
                            </div>
                            <!-- form -->
                        </div>
                        <div class='col-md-6'>
                            <!-- form -->
                            <div class="form-group"><label class="col-lg-3 control-label padding5">Point Type</label>
                                <div class="col-lg-9 padding5">
                                    <select id="tagTitle" name="tagTitle" class="form-control ">
                                        <option value="Analog">Analog</option>
                                        <option value="Digital">Digital</option>
                                        <option value="Station">Station</option>
                                        <option value="RMSC">RMSC</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label padding5">MM04</label>
                                <div class="col-lg-9 padding5">
                                    <input type="text" id="mm04L" name="mm04L" class="inputWidth" placeholder="Loop">
                                    <input type="text" id="mm04P" name="mm04P" class="inputWidth" placeholder="PCU">
                                    <input type="text" id="mm04M" name="mm04M" class="inputWidth" placeholder="Module">
                                    <input type="text" id="mm04B" name="mm04B" class="inputWidth" placeholder="Block">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label padding5">MM05</label>
                                <div class="col-lg-9 padding5">
                                    <input type="text" id="mm05L" name="mm05L" class="inputWidth" placeholder="Loop">
                                    <input type="text" id="mm05P" name="mm05P" class="inputWidth" placeholder="PCU">
                                    <input type="text" id="mm05M" name="mm05M" class="inputWidth" placeholder="Module">
                                    <input type="text" id="mm05B" name="mm05B" class="inputWidth" placeholder="Block">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label padding5">MM06</label>
                                <div class="col-lg-9 padding5">
                                    <input type="text" id="mm06L" name="mm06L" class="inputWidth" placeholder="Loop">
                                    <input type="text" id="mm06P" name="mm06P" class="inputWidth" placeholder="PCU">
                                    <input type="text" id="mm06M" name="mm06M" class="inputWidth" placeholder="Module">
                                    <input type="text" id="mm06B" name="mm06B" class="inputWidth" placeholder="Block">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label padding5">MM07</label>
                                <div class="col-lg-9 padding5">
                                    <input type="text" id="mm07L" name="mm07L" class="inputWidth" placeholder="Loop">
                                    <input type="text" id="mm07P" name="mm07P" class="inputWidth" placeholder="PCU">
                                    <input type="text" id="mm07M" name="mm07M" class="inputWidth" placeholder="Module">
                                    <input type="text" id="mm07B" name="mm07B" class="inputWidth" placeholder="Block">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="tagId" name="tagId">
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Save</button>
                <button data-dismiss="modal" class="btn btn-white" type="button">Cancel</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- Modal End -->