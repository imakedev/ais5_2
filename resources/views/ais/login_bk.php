<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Login</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/plugins/iCheck/custom.css">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
    
           
        <div>
			<h3>AIS2015 LOGIN FORM</h3>
          
            <form class="m-t ibox-content" role="form" action="index.html">
            	
            	
            	
            	 <div class="form-group">
                    	<input type='radio' checked='checked' name='mmplant'><span class='fa fa-tasks'></span> MM4-7 
                    	<input type='radio' name='mmplant'><span class='fa fa-tasks'></span> MM8-13 
                    	<input type='radio' name='mmplant'><span class='fa fa-tasks'></span> FGD8-13 
                </div>
               
                <div class="form-group input-group">
                   <span class="input-group-addon"><span class="fa fa-user"></span></span>
                    <input type="email" class="form-control" placeholder="รหัสประจำตัวพนักงาน" required="">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                    <input type="password" class="form-control" placeholder="รหัสผ่าน" required="">
                </div>
                <div class='row'>
                	<div class='col-md-6'>
                		<button type="submit" class="btn btn-primary block full-width m-b">Login</button>
               	 	</div>
               	 	<div class='col-md-6'>
						<button type="submit" class="btn btn-white block full-width m-b">Guest</button>
					</div>
               <!--  <a href="#"><small>Forgot password?</small></a> -->
               </div>
            </form>
           
        </div>
    </div>

    <!-- Mainly scripts -->
		<script src="j/s/jquery-2.1.1.js"></script>
		<script src="/js/bootstrap.min.js"></script>

</body>

</html>
