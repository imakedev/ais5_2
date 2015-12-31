@extends('layouts.main')

@section('page_title','Calculation')

@include('layouts.navigation')

@section('body')
    @include('layouts.header')
    @section('content')
<script src='/Controller/cDesignCalculation.js'></script>
<link href="/css/designCalculation.css" rel="stylesheet">

<div class="ibox">
    <div class="ibox-title">
        <h5> Calculation</h5>
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
	            <div class="col-xs-7">
		            <a class="btn btn-primary  btn-sm" href='formCalculation'>Add </a>
		            <a class="btn btn-w-m btn-warning  btn-sm" href='formCalculation'>Edit </a>
		            <a class="btn btn-w-m btn-danger  btn-sm">Delete </a>
	            </div>
	            <div class='col-xs-5'>
	            
	             <div class='row'>
	               <div class='col-xs-6'>
	                 
                           <select class="form-control input-sm" name="">
                                <option>All Calculation</option>
                                <option>My Calculation</option>
                                <option>Standard Calculation</option>
                                <option>...</option>
                            </select> 
                       
	               </div>
	               <div class='col-xs-6'>
        	               <div class="input-group">
                                <input type="text" class="input-sm form-control" placeholder="ค้นหาด่วน"> 
                                <span class="input-group-btn">
                                <button class="btn btn-sm btn-primary" type="button"> Search</button> 
                                </span>
                            </div>
	               </div>
	             </div>
                 
                
                
                  
                
	            </div>
            </div>
      <!-- grid list user -->
      <table id="gridCalList">
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
                    <th data-field="field2"><b>Data</b></th>
                    <th data-field="field3"><b>MM</b></th>
                    <th data-field="field4"><b>Description</b></th>
                    <th data-field="field5"><b>TagName</b></th>
                    <th data-field="field6"><b>Unit</b></th>
                    <th data-field="field7"><b>Max</b></th>
                    <th data-field="field8"><b>Min</b></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                    <div class='listCheckbox'><input type='checkbox'></div>
                    </td>
                    <td>435</td>
                    <td>4</td>
                    <td>HR Change By FW Temp.</td>
                    <td>40HR_FW</td>
                    <td>%</td>
                    <td>2</td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>
                    <div class='listCheckbox'><input type='checkbox'></div>
                    </td>
                    <td>435</td>
                    <td>4</td>
                    <td>HR Change By FW Temp.</td>
                    <td>40HR_FW</td>
                    <td>%</td>
                    <td>2</td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>
                    <div class='listCheckbox'><input type='checkbox'></div>
                    </td>
                    <td>435</td>
                    <td>4</td>
                    <td>HR Change By FW Temp.</td>
                    <td>40HR_FW</td>
                    <td>%</td>
                    <td>2</td>
                    <td>0</td>
                </tr>
                 
                 
                
            </tbody>
       </table>
       <br style='clear:both'>
      <!-- grid list user -->
        
    </div>
</div>


  @stop
    @section('footer')
        @include('layouts.footer')
    @stop
@stop