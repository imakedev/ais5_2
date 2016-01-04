<script src='/Controller/cTrendSetting.js'></script>
<link href="/css/trendSetting.css" rel="stylesheet">


<div class="row bgParam ">
            
    
    <div class="col-xs-offset-6 col-xs-2 ">
           <div id='listAllTrendGroupArea'></div>
    </div>
   
     <div class="col-xs-2">
      <input type="text" id='searhTrend' name='searhTrend' placeholder="ค้นหาด่วน" class="input-sm form-control pull-right"> 
     </div>
    <div class="col-xs-2 ">
          
                <button type="button" id ='btnSearchByGroup'class="btn btn-sm btn-primary pull-right" style='width:100%'> Search Trend</button> 
              
    </div>
</div>



<!-- grid list Trend -->
<div id='gridTrendListArea'></div>
<br style='clear:both'>
 <div class="col-xs-10  displaynone " id='trendNameArea'>
  Trend Name <i class='glyphicon glyphicon-menu-right'></i> <span id='trendName'></span>
 </div>
 <div class="col-xs-offset-0 col-xs-2 ">
        <div id='listAllUnitArea' class='displaynone'>
            <select class="form-control input-sm" id='unit' name="unit">
                <!-- <option value='All'>All Point</option> -->
                <option selected value='4'>MM04</option>
                <option value='5'>MM05</option>
                <option value='6'>MM06</option>
                <option value='7'>MM07</option>
               
            </select> 
       </div>
</div>
<br style='clear:both'>
<br style='clear:both'>
<div id='gridPointListArea'></div>
<div  class='row bgParam displaynone' id='btnPlotGraphArea'>
     <div class="col-xs-12">
        <buton class="btn btn-primary  btn-sm pull-right btnPlotGraph" id='btnPlotGraph' >Plot Graph </button>
     </div>
</div>
<br style='clear:both'>
<br style='clear:both'>
<br style='clear:both'>
<!-- grid list piont -->