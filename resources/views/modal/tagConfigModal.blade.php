<!-- TagConfiguration Modal Start -->

<div aria-hidden="true" role="dialog" tabindex="-1" id="modalAddEditTag" class="modal inmodal in" style="display: none;">
    <input type="hidden" name="modalAddEditTagMode" id="modalAddEditTagMode"/>
    <input type="hidden" name="modalAddEditTag_user_mmplant" id="modalAddEditTag_user_mmplant" value="{{Session::get('user_mmplant')}}"/>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h5 class="modal-title" id="header_label"></h5>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url'=>'ais/tagConfiguration/store','class'=>'form-horizontal','method'=>'post','id'=>'tagForm')) !!}
                    <div class='row'>
                        <div class='col-md-6'>
                            <div class="form-group">
                                <label class="col-lg-3 control-label padding5">Description</label>
                                <div class="col-lg-9 padding5">
                                    <input type="text" id="tagDescription" name="tagDescription" class="form-control " placeholder="Description">
                                </div>
                            </div>
                            @if(Session::get('user_mmplant')=='1')
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
                            @endif
                            @if(Session::get('user_mmplant')=='2')
                                <div class="form-group">
                                    <label class="col-lg-3 control-label padding5">Tag8</label>
                                    <div class="col-lg-9 padding5">
                                        <input type="text" id="tag8" name="tag8" class="form-control " placeholder="Tag8">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label padding5">Tag9</label>
                                    <div class="col-lg-9 padding5">
                                        <input type="text" id="tag9" name="tag9" class="form-control " placeholder="Tag9">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label padding5">Tag10</label>
                                    <div class="col-lg-9 padding5">
                                        <input type="text" id="tag10" name="tag10" class="form-control " placeholder="Tag10">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label padding5">Tag11</label>
                                    <div class="col-lg-9 padding5">
                                        <input type="text" id="tag11" name="tag11" class="form-control" placeholder="Tag11">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label padding5">Tag12</label>
                                    <div class="col-lg-9 padding5">
                                        <input type="text" id="tag12" name="tag12" class="form-control" placeholder="Tag12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label padding5">Tag13</label>
                                    <div class="col-lg-9 padding5">
                                        <input type="text" id="tag13" name="tag13" class="form-control" placeholder="Tag13">
                                    </div>
                                </div>
                                @endif
                            @if(Session::get('user_mmplant')=='3')
                                <div class="form-group">
                                    <label class="col-lg-3 control-label padding5">Tag8</label>
                                    <div class="col-lg-9 padding5">
                                        <input type="text" id="tag8" name="tag8" class="form-control " placeholder="Tag8">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label padding5">Tag9</label>
                                    <div class="col-lg-9 padding5">
                                        <input type="text" id="tag9" name="tag9" class="form-control " placeholder="Tag9">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label padding5">Tag10</label>
                                    <div class="col-lg-9 padding5">
                                        <input type="text" id="tag10" name="tag10" class="form-control " placeholder="Tag10">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label padding5">Tag11</label>
                                    <div class="col-lg-9 padding5">
                                        <input type="text" id="tag11" name="tag11" class="form-control" placeholder="Tag11">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label padding5">Tag12</label>
                                    <div class="col-lg-9 padding5">
                                        <input type="text" id="tag12" name="tag12" class="form-control" placeholder="Tag12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label padding5">Tag13</label>
                                    <div class="col-lg-9 padding5">
                                        <input type="text" id="tag13" name="tag13" class="form-control" placeholder="Tag13">
                                    </div>
                                </div>
                                @endif
                            <!-- form -->
                        </div>
                        <div class='col-md-6'>
                            <!-- form -->
                            <div class="form-group"><label class="col-lg-3 control-label padding5">Point Type</label>
                                <div class="col-lg-9 padding5">
                                    <select id="tagTitle" name="tagTitle" class="form-control ">
                                        <option value="ANALOG">Analog</option>
                                        <option value="DIGITAL">Digital</option>
                                        <option value="STATION">Station</option>
                                        <option value="RMSC">RMSC</option>
                                    </select>
                                </div>
                            </div>
                            @if(Session::get('user_mmplant')=='1')
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
                                @endif
                            @if(Session::get('user_mmplant')=='2')
                                <div class="form-group">
                                    <label class="col-lg-3 control-label padding5">MM08</label>
                                    <div class="col-lg-9 padding5">
                                        <input type="text" id="mm08L" name="mm08L" class="inputWidth" placeholder="Loop">
                                        <input type="text" id="mm08P" name="mm08P" class="inputWidth" placeholder="PCU">
                                        <input type="text" id="mm08M" name="mm08M" class="inputWidth" placeholder="Module">
                                        <input type="text" id="mm08B" name="mm08B" class="inputWidth" placeholder="Block">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label padding5">MM09</label>
                                    <div class="col-lg-9 padding5">
                                        <input type="text" id="mm09L" name="mm09L" class="inputWidth" placeholder="Loop">
                                        <input type="text" id="mm09P" name="mm09P" class="inputWidth" placeholder="PCU">
                                        <input type="text" id="mm09M" name="mm09M" class="inputWidth" placeholder="Module">
                                        <input type="text" id="mm09B" name="mm09B" class="inputWidth" placeholder="Block">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label padding5">MM10</label>
                                    <div class="col-lg-9 padding5">
                                        <input type="text" id="mm10L" name="mm10L" class="inputWidth" placeholder="Loop">
                                        <input type="text" id="mm10P" name="mm10P" class="inputWidth" placeholder="PCU">
                                        <input type="text" id="mm10M" name="mm10M" class="inputWidth" placeholder="Module">
                                        <input type="text" id="mm10B" name="mm10B" class="inputWidth" placeholder="Block">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label padding5">MM11</label>
                                    <div class="col-lg-9 padding5">
                                        <input type="text" id="mm11L" name="mm11L" class="inputWidth" placeholder="Loop">
                                        <input type="text" id="mm11P" name="mm11P" class="inputWidth" placeholder="PCU">
                                        <input type="text" id="mm11M" name="mm11M" class="inputWidth" placeholder="Module">
                                        <input type="text" id="mm11B" name="mm11B" class="inputWidth" placeholder="Block">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label padding5">MM12</label>
                                    <div class="col-lg-9 padding5">
                                        <input type="text" id="mm12L" name="mm12L" class="inputWidth" placeholder="Loop">
                                        <input type="text" id="mm12P" name="mm12P" class="inputWidth" placeholder="PCU">
                                        <input type="text" id="mm12M" name="mm12M" class="inputWidth" placeholder="Module">
                                        <input type="text" id="mm12B" name="mm12B" class="inputWidth" placeholder="Block">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label padding5">MM13</label>
                                    <div class="col-lg-9 padding5">
                                        <input type="text" id="mm13L" name="mm13L" class="inputWidth" placeholder="Loop">
                                        <input type="text" id="mm13P" name="mm13P" class="inputWidth" placeholder="PCU">
                                        <input type="text" id="mm13M" name="mm13M" class="inputWidth" placeholder="Module">
                                        <input type="text" id="mm13B" name="mm13B" class="inputWidth" placeholder="Block">
                                    </div>
                                </div>
                            @endif
                            @if(Session::get('user_mmplant')=='3')
                                <div class="form-group">
                                    <label class="col-lg-3 control-label padding5">MM08</label>
                                    <div class="col-lg-9 padding5">
                                        <input type="text" id="mm08L" name="mm08L" class="inputWidth" placeholder="Loop">
                                        <input type="text" id="mm08P" name="mm08P" class="inputWidth" placeholder="PCU">
                                        <input type="text" id="mm08M" name="mm08M" class="inputWidth" placeholder="Module">
                                        <input type="text" id="mm08B" name="mm08B" class="inputWidth" placeholder="Block">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label padding5">MM09</label>
                                    <div class="col-lg-9 padding5">
                                        <input type="text" id="mm09L" name="mm09L" class="inputWidth" placeholder="Loop">
                                        <input type="text" id="mm09P" name="mm09P" class="inputWidth" placeholder="PCU">
                                        <input type="text" id="mm09M" name="mm09M" class="inputWidth" placeholder="Module">
                                        <input type="text" id="mm09B" name="mm09B" class="inputWidth" placeholder="Block">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label padding5">MM10</label>
                                    <div class="col-lg-9 padding5">
                                        <input type="text" id="mm10L" name="mm10L" class="inputWidth" placeholder="Loop">
                                        <input type="text" id="mm10P" name="mm10P" class="inputWidth" placeholder="PCU">
                                        <input type="text" id="mm10M" name="mm10M" class="inputWidth" placeholder="Module">
                                        <input type="text" id="mm10B" name="mm10B" class="inputWidth" placeholder="Block">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label padding5">MM11</label>
                                    <div class="col-lg-9 padding5">
                                        <input type="text" id="mm11L" name="mm11L" class="inputWidth" placeholder="Loop">
                                        <input type="text" id="mm11P" name="mm11P" class="inputWidth" placeholder="PCU">
                                        <input type="text" id="mm11M" name="mm11M" class="inputWidth" placeholder="Module">
                                        <input type="text" id="mm11B" name="mm11B" class="inputWidth" placeholder="Block">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label padding5">MM12</label>
                                    <div class="col-lg-9 padding5">
                                        <input type="text" id="mm12L" name="mm12L" class="inputWidth" placeholder="Loop">
                                        <input type="text" id="mm12P" name="mm12P" class="inputWidth" placeholder="PCU">
                                        <input type="text" id="mm12M" name="mm12M" class="inputWidth" placeholder="Module">
                                        <input type="text" id="mm12B" name="mm12B" class="inputWidth" placeholder="Block">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label padding5">MM13</label>
                                    <div class="col-lg-9 padding5">
                                        <input type="text" id="mm13L" name="mm13L" class="inputWidth" placeholder="Loop">
                                        <input type="text" id="mm13P" name="mm13P" class="inputWidth" placeholder="PCU">
                                        <input type="text" id="mm13M" name="mm13M" class="inputWidth" placeholder="Module">
                                        <input type="text" id="mm13B" name="mm13B" class="inputWidth" placeholder="Block">
                                    </div>
                                </div>
                            @endif
                        </div>
                        <input type="hidden" id="tagId" name="tagId">
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" onclick="validateTag()">Save</button>
                <button data-dismiss="modal" class="btn btn-white" type="button">Cancel</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<!-- Modal End -->