@extends('layouts.main')

@section('page_title','Form Calculation')

@include('layouts.navigation')

@section('body')
    @include('layouts.header')
    @section('content')

<script src='/Controller/cFormCalculation.js'></script>
<link href="/css/formCalculation.css" rel="stylesheet">

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
		            <a class="btn btn-primary  btn-sm" href='/ais/designCalculation'>Back </a>
		            
	            </div>
	            <div class="col-xs-4"><h5 class='titleForm'>Calculation Management</h5></div>
	           
            </div>
            <!-- btn end -->
            <!-- form cal start -->
                <div class='row'>
                    <div class='col-xs-8 bottomMargin5'>
                        <textarea id="cal_g" name="cal_g" rows="12" style='width: 100%'>{{ $mmcalculation->G }}</textarea>
                    </div>
                    <div class='col-xs-4'>
                        <!-- cal fn start -->
                            <div class='row'>
                          
                                <div class='col-xs-12 '>
                                     <label>
                                        <input type='radio' checked  name='cal' value="constant" > Constant
                                     </label>
                                    <div class='pull-right'>
                                    <button class=" btn btn-primary  btn-sm fa fa-gears"
                                            data-toggle="modal" id='btnConstant' data-target="#modalConstant"></button>
                                    </div>
                                        
                                     
                                        
                                        <input type='text' id="constant" name="constant" class='form-control input-sm'>
                                       
                                </div>
                              
                                
                                <div class='col-xs-6'>
                                     <label><input type='radio'  name='cal' value="steam_parameter" > Steam Parameter</label>
                                     <div class="input-group">
                                          <select class="form-control  input-sm" id="steam_parameter" name="steam_parameter">
                                              <option value="Enthalpy(t;p)">Enthalpy(t;p)</option>
                                               <option value="Enthalpy_s_p(s;p)">Enthalpy_s_p(s;p)</option>
                                              <option value="Enthalpy_Tsat(t;x)">Enthalpy_Tsat(t;x)</option>
                                               <option value="Enthalpy_Psat(p;x)">Enthalpy_Psat(p;x)</option>
                                              <option value="Entropy(t;p)">Entropy(t;p)</option>
                                              <option value="Entropy_Tsat(t;x)">Entropy_Tsat(t;x)</option>
                                               <option value="Entropy_Psat(p;x)">Entropy_Psat(t;p)</option>
                                              <option value="Density(t;p)">Density(t;p)</option>
                                               <option value="Viscosity(t;p)">Viscosity(t;p)</option>
                                              <option value="Density_Tsat(t;x)">Density_Tsat(t;x)</option>
                                               <option value="Density_Psat(p;x)">Density_Psat(p;x)</option>
                                              <option value="Temperature_Psat(p)">Temperature_Psat(p)</option>
                                               <option value="Pressure_Tsat(t)">Pressure_Tsat(t)</option>
                                        </select> 
                                        
                                    </div>
                                </div>
                                
                                <div class='col-xs-6'>
                                     <label><input type='radio'  name='cal' value="symbolic" > Symbolic</label>
                                     <div class="input-group">
                                          <select class="form-control input-sm" id="symbolic" name="symbolic">
                                            <option value="+"> + </option>
                                              <option value="-"> - </option>
                                              <option value="*"> * </option>
                                              <option value="/"> / </option>
                                              <option value="^"> ^ </option>
                                              <option value="%"> % </option>
                                              <option value=";"> ; </option>
                                              <option value="["> [ </option>
                                              <option value="{"> { </option>
                                              <option value="("> ( </option>
                                              <option value=")"> ) </option>
                                              <option value="}"> } </option>
                                              <option value="]"> ] </option>
                                        </select> 
                                        
                                    </div>
                                </div>
                                
                                <div class='col-xs-6'>
                                     <label><input type='radio'  name='cal' value="function" > Function</label>
                                     <div class="input-group">
                                          <select class="form-control input-sm" id="function" name="function">
                                            <option value="Abs(x)">Abs(x)</option>
                                              <option value="Fix(x)">Fix(x)</option>
                                              <option value="Int(x)">Int(x)</option>
                                              <option value="Dec(x)">Dec(x)</option>
                                              <option value="Fact(x)">Fact(x)</option>
                                              <option value="Rnd(X)">Rnd(x)</option>
                                              <option value="Sgn(x)">Sgn(x)</option>
                                              <option value="Sqr(x)">Sqr(x)</option>
                                              <option value="Cbr(x)">Cbr(x)</option>
                                              <option value="Exp(x)">Exp(x)</option>
                                              <option value="Ln(x)">Ln(x)</option>
                                              <option value="Log(x)">Log(x)</option>
                                              <option value="LogN(x;n)">LogN(x;n)</option>
                                              <option value="Root(x;n)">Root(x;n)</option>
                                              <option value="Mod(a;b)">Mod(a;b)</option>
                                              <option value="Comb(n;k)">Comb(n;k)</option>
                                              <option value="Max(a;b)">Max(a;b)</option>
                                              <option value="Min(a;b)">Min(a;b)</option>
                                              <option value="Mcd(a;b)">Mcd(a;b)</option>
                                              <option value="Mcm(a;b)">Mcm(a;b)</option>
                                        </select> 
                                        
                                    </div>
                                </div>
                                
                                <div class='col-xs-6'>
                                     <label><input type='radio'  name='cal' value="trigon"> Trigon</label>
                                     <div class="input-group">
                                          <select class="form-control input-sm" id="trigon" name="trigon">
                                         
                                            <option value="Sin(x)">Sin(x)</option>
                                              <option value="Cos(x)">Cos(x)</option>
                                              <option value="Tan(x)">Tan(x)</option>
                                              <option value="Asin(x)">Asin(x)</option>
                                              <option value="Acos(x)">Acos(x)</option>
                                              <option value="Atan(x)">Atan(x)</option>
                                              <option value="Sinh(x)">Sinh(x)</option>
                                              <option value="Cosh(x)">Cosh(x)</option>
                                              <option value="Tanh(x)">Tanh(x)</option>
                                              <option value="Asinh(x)">Asinh(x)</option>
                                              <option value="Acosh(x)">Acosh(x)</option>
                                              <option value="Atanh(x)">Atanh(x)</option>
                                        </select> 
                                        
                                    </div>
                                </div>
                                <div class='col-xs-12 '>
                                    <button class="btn btn-primary  btn-sm btnAddCal pull-right" onclick="addFormula()">Add Formula</button>
                               </div>
                            </div>
                        <!-- cal fn start -->
                    </div>
                </div>    
            <!-- form cal start -->
            <!-- btn start -->
             <div class="row bgParam">
	            <div class="col-xs-12">
		            <a class="btn btn-primary  btn-sm" href='index.php?page=formCalculation'>Clone </a>
		            <a class="btn btn-w-m btn-warning  btn-sm" onclick="clearCalculation()">Clear </a>
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
	                   <input type='text' id="cal_c" name="cal_c" value="{{ $mmcalculation->C }}" class='form-control input-sm'>
	               </div>
	               <div class='param'>
	                   Tag
	                   <input type='text' id="cal_d" name="cal_d" value="{{ $mmcalculation->D }}" class='form-control input-sm'>
	               </div>
	               <div class='param'>
	                   MM Plant
	                   <select id="cal_slelect_b" name="cal_slelect_b"  class="form-control input-sm">
                            <option value="4">MM04</option>
                            <option value="5">MM05</option>
                            <option value="6">MM06</option>
                            <option value="7">MM07</option>
                           <option value="47">MM47</option>
                        </select>
                       <input type="hidden" id="cal_slelect_b_hidden" value="{{ $mmcalculation->B }}" />
	               </div>
	               <div class='param'>
	                   Unit
	                   <select id="cal_slelect_e" name="cal_slelect_e" class="form-control input-sm">
                            <option value="%">%</option>
                           <option value="Amp">Amp</option>
                           <option value="Bar">Bar</option>
                           <option value="Deg">Deg</option>
                           <option value="Deg C">Deg C</option>
                           <option value="Hz">Hz</option>
                           <option value="kA">kA</option>
                           <option value="kCal/kg">kCal/kg</option>
                           <option value="kg/s">kg/s</option>
                           <option value="kMol/H">kMol/H</option>
                           <option value="kV">kV</option>
                           <option value="kW">kW</option>
                           <option value="m">m</option>
                           <option value="m/min">m/min</option>
                           <option value="mBar">mBar</option>
                           <option value="mg/Nm3">mg/Nm3</option>
                           <option value="micron">micron</option>
                           <option value="mm">mm</option>
                           <option value="mm/s">mm/s</option>
                           <option value="mmWG">mmWG</option>
                           <option value="MVAr">MVAr</option>
                           <option value="MW">MW</option>
                           <option value="N/A">N/A</option>
                           <option value="PF">PF</option>
                           <option value="ppm">ppm</option>
                           <option value="rpm">rpm</option>
                           <option value="T">T</option>
                           <option value="T/H">T/H</option>
                           <option value="Time">Time</option>
                           <option value="Volt">Volt</option>
                        </select>
                       <input type="hidden" id="cal_slelect_e_hidden" value="{{ $mmcalculation->E }}" />
	               </div>
	               <div class='param'>
	                   Max
	                   <input type='text' id="cal_f0" name="cal_f0" value="{{ $mmcalculation->F0 }}" class='form-control input-sm'>
	               </div>
	               <div class='param'>
	                   Min
	                   <input type='text' id="cal_f1" name="cal_f1" value="{{ $mmcalculation->F1 }}" class='form-control input-sm'>

                   </div>
	               <div class=paramFamulaType>
	                   Formula type
	                  <select id="cal_h" name="cal_h" class="form-control input-sm">
                            <option value="">Standard</option>
                            <option value="{{Auth::user()->empId}}">My Calculation</option>
                        </select>
                       <input type="hidden" id="cal_h_hidden" value="{{ $mmcalculation->H }}" />
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
  @stop
    @section('footer')
        @include('layouts.footer')
    @stop
@stop