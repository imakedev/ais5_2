<script src='Controller/cSoot.js'></script>
<link href="css/soot.css" rel="stylesheet">

<div class="ibox">
    <div class="ibox-title">
        <h5>Soot/Blow</h5>
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
           
	      <div class='row'>
	            <div class="col-sm-2">
                    <div class="form-group">
                        <label for="product_name" class="control-label">Blow/Soot</label>
                        <select name="" class="form-control input-sm">
                            <option>เวลาที่ Blow</option>
                        </select> 
                    </div>
                </div>
                 <div class="col-sm-2">
                    <div class="form-group">
                        <label for="product_name" class="control-label">Unit</label>
                        <select name="" class="form-control input-sm">
                            <option>Unit4</option>
                        </select>
                    </div>
                </div>
                 <div class="col-sm-2">
                    <div class="form-group">
                        <label for="product_name" class="control-label">Date</label>
                        
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" value="03/04/2014" class="form-control">
                        </div>
                        
                    </div>
                </div>
                <div class="col-sm-2">
               
                    <a href="#" class="btn btn-primary  btn-sm btnSubmit">OK </a>
                </div>
                
            </div> 
            <div class='row'>
                <div class='col-xs-4'>
                
                   <!-- BOX1 START -->
                    <div class='row'>
                        <div class='col-xs-12'>
                            <label>   กะดึก 00:00:-08:00 น.</label>
                        </div>
                    </div>
                    
                    <div class='row'>
                        <div class='col-xs-12 '>
                        
                        <!-- list soot start -->
                      
                          <table id="gridSootList">
                                <colgroup>
                                    
                                    <col style="width:10%"/>
                                    <col style="width:8%" />
                                    <col style="width:50%" />
                                   
                                </colgroup>
                                <thead>
                                    <tr>
                                       
                                        <th data-field="field1"><b></b></th>
                                        <th data-field="field2"><b></b></th>
                                        <th data-field="field3"><b></b></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                for($i=20;$i<=59;$i++){
                                ?>
                                    <tr>
                                       
                                        <td>00:<?=$i?></td>
                                        <td>Flow=1.67Kg/s</td>
                                        <td>Soot=21L,21R,D1,D14,AHC2</td>
                                     
                                    </tr>
                                    
                                   <?php 
                                    }
                                   ?>  
                                    
                                </tbody>
                           </table>
                           <br style='clear:both'>
                        
                        <!-- list soot end -->
                        </div>
                      </div>
                      
                        <!-- BOX1 END -->
                        
                    
                </div>
                <div class='col-xs-4'>
                
                    <!-- BOX2 START -->
                        <div class='row'>
                            <div class='col-xs-12'>
                                <label>   กะเช้า 08:00:-16:00 น.</label>
                            </div>
                        </div>
                        
                        <div class='row'>
                            <div class='col-xs-12 '>
                            
                            <!-- list soot start -->
                          
                              <table id="gridSootList2">
                                    <colgroup>
                                        
                                        <col style="width:10%"/>
                                        <col style="width:8%" />
                                        <col style="width:50%" />
                                       
                                    </colgroup>
                                    <thead>
                                        <tr>
                                           
                                            <th data-field="field1"><b></b></th>
                                            <th data-field="field2"><b></b></th>
                                            <th data-field="field3"><b></b></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    for($i=20;$i<=59;$i++){
                                    ?>
                                        <tr>
                                            <td>08:<?=$i?></td>
                                            <td>Flow=1.67Kg/s</td>
                                            <td>Soot=21L,21R,D1,D14,AHC2</td>
                                         
                                        </tr>
                                        
                                       <?php 
                                        }
                                       ?>  
                                        
                                    </tbody>
                               </table>
                               <br style='clear:both'>
                            
                            <!-- list soot end -->
                            </div>
                          </div>
                          
                            <!-- BOX1 END -->
                </div>
                
                <div class='col-xs-4'>
    
                      <!-- BOX1 START -->
                        <div class='row'>
                            <div class='col-xs-12'>
                                <label>   กะบ่าย 16:00:-08:24 น.</label>
                            </div>
                        </div>
                        
                        <div class='row'>
                            <div class='col-xs-12 '>
                            
                            <!-- list soot start -->
                          
                              <table id="gridSootList3">
                                    <colgroup>
                                        
                                        <col style="width:10%"/>
                                        <col style="width:8%" />
                                        <col style="width:50%" />
                                       
                                    </colgroup>
                                    <thead>
                                        <tr>
                                           
                                            <th data-field="field1"><b></b></th>
                                            <th data-field="field2"><b></b></th>
                                            <th data-field="field3"><b></b></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    for($i=20;$i<=59;$i++){
                                    ?>
                                        <tr>
                                           
                                            <td>16:<?=$i?></td>
                                            <td>Flow=1.67Kg/s</td>
                                            <td>Soot=21L,21R,D1,D14,AHC2</td>
                                         
                                        </tr>
                                        
                                       <?php 
                                        }
                                       ?>  
                                        
                                    </tbody>
                               </table>
                               <br style='clear:both'>
                            
                            <!-- list soot end -->
                            </div>
                          </div>
                          
                            <!-- BOX1 END -->
                </div>
                
                
            </div> 
       </div>
      
 </div>  

