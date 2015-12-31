<!-- PointConfiguration Modal Start -->
<div aria-hidden="true" role="dialog" tabindex="-1" id="modalPointConFig" class="modal inmodal in" style="display: none;">
    <div class="modal-dialog ">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h5 class="modal-title">Add Point Data380</h5>
            </div>
            <div class="modal-body">
                {!! Form::open(array('user'=>'/ais/pointConfiguration/store','class'=>'form-horizontal')) !!}
                    <div class="form-group">
                        <label class="col-lg-3 control-label padding5"></label>
                        <div class="col-lg-7 padding5">
                            <input id="avg" name="avg" type='checkbox'> เฉลี่ยค่าจากข้อมูลรายวินาที
                            <input id="avgVal" name="avgVal" type='hidden'>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-3 control-label padding5">Tag Atom</label>
                        <div class="col-lg-7 padding5">
                            <select id="poiAtom" name="poiAtom" class="form-control ">
                                <option value="Value">Value</option>
                                <option>...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-3 control-label padding5">หน่วยวัด</label>
                        <div class="col-lg-7 padding5">
                            <select id="poiUnit" name="poiUnit" class="form-control ">
                                <option value="%">%</option>
                                <option value="Bar">Bar</option>
                                <option value="kg/s">kg/s</option>
                                <option value="Deg C">Deg C</option>
                                <option value="MW">MW</option>
                                <option value="MVAR">MVAR</option>
                                <option value="Hz">Hz</option>
                                <option value="KV">KV</option>
                                <option value="KA">KA</option>
                                <option value="Amp">Amp</option>
                                <option value="micron">micron</option>
                                <option value="mm">mm</option>
                                <option value="rpm">rpm</option>
                                <option value="oC">oC</option>
                                <option value="RAD">RAD</option>
                                <option value="ton">ton</option>
                                <option>...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label padding5">Max</label>
                        <div class="col-lg-7 padding5">
                            <input type="text" id="poiMax" name="poiMax" class="form-control " placeholder="Max">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label padding5">Min</label>
                        <div class="col-lg-7 padding5">
                            <input type="text" id="poiMin" name="poiMin" class="form-control " placeholder="Min">
                        </div>
                    </div>
                <input type="hidden" id="poiId" name="poiId">
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Add</button>
                <button data-dismiss="modal" class="btn btn-white" type="button">Cancel</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- Modal End -->