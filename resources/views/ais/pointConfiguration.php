<script src='/Controller/cPointConfig.js'></script>
<link href="/css/pointConfig.css" rel="stylesheet">

<div class="ibox">
    <div class="ibox-title">
        <h5>Point Configuration</h5>
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
		            <a class="btn btn-primary  btn-sm" data-toggle="modal" data-target="#modalFormPointConFig">Add Point</a> 
		            <a class="btn btn-w-m btn-warning  btn-sm" data-toggle="modal" data-target="#modalFormPointConFig">Edit Point</a>
		            <a class="btn btn-w-m btn-danger  btn-sm">Delete Point</a>
	            </div>
            </div>
      <!-- grid list user -->
      <table id="gridPointConfigList">
            <colgroup>
                <col style="width:3%"/>
                <col  style="width:4%"/>
                <col />
                <col />
                <col />
                <col />
                <col/>
                <col />https://github.com/nong053/AIS2015.git
                <col/>
                <col />
                <col />
            </colgroup>
            <thead>
                <tr>
                    <th data-field="field0">
                        <input type='checkbox'>
                    </th>
                    <th data-field="field1"><b>Data</b></th>
                    <th data-field="field2"><b>Point Desc</b></th>
                    <th data-field="field3"><b>Tag4</b></th>
                    <th data-field="field4"><b>Tag5</b></th>
                    <th data-field="field5"><b>Tag6</b></th>
                    <th data-field="field6"><b>Tag7</b></th>
                    <th data-field="field7"><b>Tag Atom</b></th>
                    <th data-field="field8"><b>Average</b></th>
                    <th data-field="field9"><b>Unit</b></th>
                    <th data-field="field10"><b>Max</b></th>
                    <th data-field="field11"><b>Min</b></th>
                    <th data-field="field12"><b>Item</b></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                    <div class='listCheckbox'><input type='checkbox'></div>
                    </td>
                    <td>1</td>
                    <td>LP Bypass Value#1 Position</td>
                    <td>405SF61C502</td>
                    <td>505SF61C502</td>
                    <td>605SF61C502</td>
                    <td>705SF61C502</td>
                    <td>Value</td>
                    <td>Yes</td>
                    <td>%</td>
                    <td>100</td>
                    <td>0</td>
                    <td>1</td>
                </tr>
                
                <tr>
                    <td>
                    <div class='listCheckbox'><input type='checkbox'></div>
                    </td>
                    <td>2</td>
                    <td>LP Bypass Value#2 Position</td>
                    <td>405SF61C502</td>
                    <td>505SF61C502</td>
                    <td>605SF61C502</td>
                    <td>705SF61C502</td>
                    <td>Value</td>
                    <td>Yes</td>
                    <td>%</td>
                    <td>100</td>
                    <td>0</td>
                    <td>2</td>
                </tr>
                
                
            </tbody>
       </table>
       <br style='clear:both'>
      <!-- grid list user -->
        
    </div>
</div>

<!-- Modal Start -->
<div aria-hidden="true" role="dialog" tabindex="-1" id="modalFormPointConFig" class="modal inmodal in" style="display: none;">
     <div class="modal-dialog ">
      <div class="modal-content animated flipInY">
        <div class="modal-header">
          <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
           <h5 class="modal-title">Add Point Data380</h5>
              
           </div>
          <div class="modal-body">
          
          <form class="form-horizontal">

                    <!-- form -->
                    
                         <div class="form-group">
                        	<label class="col-lg-3 control-label padding5"></label>

                            <div class="col-lg-7 padding5">
                            	<input type='checkbox' > เฉลี่ยค่าจากข้อมูลรายวินาที
                            </div>
                        </div>
                        
                        <div class="form-group"><label class="col-lg-3 control-label padding5">Tag Atom</label>

                            <div class="col-lg-7 padding5">
                                <select name="account" class="form-control ">
                                    <option>Value</option>
                                    <option>...</option>
                                </select>
                            </div>
                        </div>
                        
                        
                        <div class="form-group"><label class="col-lg-3 control-label padding5">หน่วยวัด</label>

                            <div class="col-lg-7 padding5">
                                <select name="account" class="form-control ">
                                    <option>%</option>
                                    <option>...</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                        	<label class="col-lg-3 control-label padding5">Max</label>

                            <div class="col-lg-7 padding5">
                            	<input type="text" class="form-control " placeholder="Max"> 
                            </div>
                        </div>
                        
                       <div class="form-group">
                        	<label class="col-lg-3 control-label padding5">Min</label>

                            <div class="col-lg-7 padding5">
                            	<input type="text" class="form-control " placeholder="Min"> 
                            </div>
                        </div>
                       
                      
                    <!-- form -->
      
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