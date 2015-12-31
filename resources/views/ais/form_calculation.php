<script src='Controller/cFormCalculation.js'></script>
<link href="css/formCalculation.css" rel="stylesheet">

<div class="ibox">
    <div class="ibox-title">
        <h5>  Form Calculation</h5>
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
           <!-- btn start -->
             <div class="row bgParam">
	            <div class="col-xs-8">
		            <a class="btn btn-primary  btn-sm" href='index.php?page=design_calculation'>Back </a> 
		            
	            </div>
	            <div class="col-xs-4"><h5 class='titleForm'>Calculation Management</h5></div>
	           
            </div>
            <!-- btn end -->
            <!-- form cal start -->
                <div class='row'>
                    <div class='col-xs-8 bottomMargin5'>
                        <textarea rows="12" style='width: 100%'></textarea>
                    </div>
                    <div class='col-xs-4'>
                        <!-- cal fn start -->
                            <div class='row'>
                          
                                <div class='col-xs-12 '>
                                     <label>
                                        <input type='radio'  name='cal' > Constant 
                                     </label>
                                    <div class='pull-right'>
                                    <button class=" btn btn-primary  btn-sm fa fa-gears" data-toggle="modal" id='btnConstant' data-target="#modalConstant"></button>
                                    </div>
                                        
                                     
                                        
                                        <input type='text'class='form-control input-sm'>
                                       
                                </div>
                              
                                
                                <div class='col-xs-6'>
                                     <label><input type='radio'  name='cal' > Steam Parameter</label>
                                     <div class="input-group">
                                          <select class="form-control  input-sm" name="">
                                            
                                            <option>Enthalpy(t:p)</option>
                                            <option>...</option>
                                        </select> 
                                        
                                    </div>
                                </div>
                                
                                <div class='col-xs-6'>
                                     <label><input type='radio'  name='cal' > Symbolic</label>
                                     <div class="input-group">
                                          <select class="form-control input-sm" name="">
                                 
                                            <option>Text goes here</option>
                                            <option>...</option>
                                        </select> 
                                        
                                    </div>
                                </div>
                                
                                <div class='col-xs-6'>
                                     <label><input type='radio'  name='cal' > Function</label>
                                     <div class="input-group">
                                          <select class="form-control input-sm" name="">
                                  
                                            <option>Abs(x)</option>
                                            <option>...</option>
                                        </select> 
                                        
                                    </div>
                                </div>
                                
                                <div class='col-xs-6'>
                                     <label><input type='radio'  name='cal' > Trigon</label>
                                     <div class="input-group">
                                          <select class="form-control input-sm" name="">
                                         
                                            <option>Sin(x)</option>
                                            <option>...</option>
                                        </select> 
                                        
                                    </div>
                                </div>
                                <div class='col-xs-12 '>
                                    <button class="btn btn-primary  btn-sm btnAddCal pull-right">Add Formula</button>
                               </div>
                            </div>
                        <!-- cal fn start -->
                    </div>
                </div>    
            <!-- form cal start -->
            <!-- btn start -->
             <div class="row bgParam">
	            <div class="col-xs-12">
		            <a class="btn btn-primary  btn-sm" href='index.php?page=form_calculation'>Clone </a> 
		            <a class="btn btn-w-m btn-warning  btn-sm">Clear </a>
		            <a class="btn btn-w-m btn-danger  btn-sm">Change </a>
		            <a class="btn btn-w-m btn-danger  btn-sm" data-toggle="modal" id='btnAddPoint' data-target="#modalAddPoint">Add Point </a>
		            <a class="btn btn-w-m btn-danger  btn-sm">Priview </a>
	            </div>
	           
            </div>
            <!-- btn end -->
            
             <div class="row">
	            <div class="col-xs-12 paramArea">
	               <div class='paramDesc'>
	                   Description
	                   <input type='text' class='form-control input-sm'>
	               </div>
	               <div class='param'>
	                   Tag
	                   <input type='text' class='form-control input-sm'>
	               </div>
	               <div class='param'>
	                   MM Plant
	                   <select name="account" class="form-control input-sm">
                            <option>MM04</option>
                            <option>MM05</option>
                            <option>MM06</option>
                            <option>...</option>
                        </select>
	               </div>
	               <div class='param'>
	                   Unit
	                   <select name="account" class="form-control input-sm">
                            <option>%</option>
                            <option></option>
                            <option></option>
                           
                        </select>
	               </div>
	               <div class='param'>
	                   Max
	                   <input type='text' class='form-control input-sm'>
	               </div>
	               <div class='param'>
	                   Min
	                   <input type='text' class='form-control input-sm'>
	               </div>
	               <div class=paramFamulaType>
	                   Formula type
	                  <select name="account" class="form-control input-sm">
                            <option>Standard</option>
                            <option></option>
                            <option></option>
                           
                        </select>
	               </div>
	               
	               <div class='paramSave'>
	                   <button class="btn btn-primary  btn-sm">Save</button>
	               </div>
	              
	            </div>
	            
	         </div>
            <br style='clear: both;'>
    </div>
 
</div>

<!-- Modal Constant Start -->
<div aria-hidden="true" role="dialog" tabindex="-1" id="modalConstant" class="modal inmodal in" style="display: none;">
     <div class="modal-dialog">
      <div class="modal-content animated flipInY">
        <div class="modal-header">
          <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
           <h5 class="modal-title">Constant Management</h5>
              
           </div>
          <div class="modal-body">
          
          
          <!-- parameter start -->
          <div class="row bgParam">
	            <div class="col-md-12">
		           
		            <a class="btn btn-w-m btn-warning  btn-sm">Edit </a>
		            <a class="btn btn-w-m btn-danger  btn-sm">Delete </a>
	            </div>
            </div>
           <!-- parameter end -->  
           
           <!-- list constant start -->
           <div id='constantListArea'></div>
          
    
           <!-- list constant end -->
           
          	<!-- form constant start -->
            <form class="form-horizontal">
               
                <div class="form-group">
                	<label class="col-lg-3 control-label padding5">Constant Name</label>

                    <div class="col-lg-9 padding5">
                    	<input type="text" class="form-control input-sm" placeholder="Constant Name"> 
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-3 control-label padding5">Value</label>

                    <div class="col-lg-9 padding5">
                    	<input type="text" class="form-control input-sm" placeholder="Value"> 
                    </div>
                </div>
                <div class="form-group"><label class="col-lg-3 control-label padding5">Constant Type</label>

                    <div class="col-lg-9 padding5">
                        <select name="account" class="form-control input-sm">
                            <option>My Constant</option>
                            <option>Standard Consant</option>
                           
                        </select>
                    </div>
                </div>
            </form>
            <!-- form constant end -->
            
                        
          </div>
         <div class="modal-footer">
         <button class="btn btn-primary" type="button">Add</button>
         <button data-dismiss="modal" class="btn btn-white" type="button">Cancel</button>
        
      </div>
     </div>
   </div>
  </div>
<!-- Modal Constant End -->

  <!-- Modal add point Start -->
<div aria-hidden="true" role="dialog" tabindex="-1" id="modalAddPoint" class="modal inmodal in" style="display: none;">
     <div class="modal-dialog">
      <div class="modal-content animated flipInY">
        <div class="modal-header">
          <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
           <h5 class="modal-title">Point Management</h5>
              
           </div>
          <div class="modal-body">
          
          
          <!-- parameter start -->
          <div class='row bottomMargin5'>
                <div class="col-xs-12">
	            
	             <div class="row">
	               <div class="col-xs-4 ">
	                 
                           <select name="" class="form-control input-sm">
                             
                                <option>MMPlant04</option>
                                <option>...</option>
                            </select> 
                       
	               </div>
	              
	               <div class="col-xs-8">
        	               <div class="input-group">
                                <input type="text" placeholder="ค้นหาด่วน" class="input-sm form-control"> 
                                <span class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-primary"> Search</button> 
                                </span>
                            </div>
	               </div>
	             </div>
	            </div>
	         </div>
           <!-- parameter end -->  
           
           <!-- list point start -->
           <div id='pointListArea'></div>
          
    
           <!-- list point end -->
           
          	
            
                        
          </div>
         <div class="modal-footer">
         <button class="btn btn-primary" type="button">Add</button>
         <button data-dismiss="modal" class="btn btn-white" type="button">Cancel</button>
        
      </div>
     </div>
   </div>
  </div>
<!-- Modal add point End -->