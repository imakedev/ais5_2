@extends('layouts.main')
@section('page_title',' Login')

<body class="gray-bg">
<div class="loginColumns animated fadeInDown">
    <div class="row">
        <div class="col-md-6">
            <h2 class="font-bold"> Analytical Information System </h2>
            <p>
                เป็นเครื่องมือในกระบวนการเดินเครื่องของโรงไฟฟ้าแม่เมาะเครื่องที่ 4-13 โดยผู้ใช้สามารถออกแบบ Trend ตามความต้องการและสามารถกำหนดสูตรการคำนวณทางคณิตศาสตร์หรือ ทางวิศกรรมศาสตร์ ซึ่งจะทำให้สะดวกในการติดตามวิเคาระห์สภาพการเดินเครื่อง ให้มีประสิทธิภาพสูงสุด
            </p>
        </div>
        <div class="col-md-6">
            <div>
                <form class="m-t ibox-content" role="form"  method="POST" action="{{ url('/login') }}">
                    {!! csrf_field() !!}
                    @if(session()->has('error_message'))
                        <div style='text-align: center';>
                            <div class="alert alert-danger" style="margin: 5px 0px; padding: 5px 3px;" role="alert">
                                <i class="glyphicon glyphicon-ok-sign"></i> {{ session()->get('error_message') }}
                            </div>
                        </div>
                    @endif
                    <div style='text-align: center';>
                        <h3>AIS2015 LOGIN FORM</h3>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><span class="fa fa-user"></span></span>
                        <input type="empId"  name="empId" class="form-control" placeholder="รหัสประจำตัว" required="">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                        <input type="password"  name="password" class="form-control" placeholder="รหัสผ่าน" required="">
                    </div>
                    <div class="form-group">
                        <input type='radio' checked='checked' name='mmplant' value="1"> <span class='fa fa-tasks'></span> MM4-7
                        <input type='radio' name='mmplant' value="2"> <span class='fa fa-tasks'></span> MM8-13
                        <input type='radio' name='mmplant' value="3"> <span class='fa fa-tasks'></span> FGD8-13
                    </div>
                    <div class='row'>
                        <div class='col-md-6'>
                            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                        </div>
                        <!--
                        <div class='col-md-6'>
                            <button type="submit" class="btn btn-white block full-width m-b">Guest</button>
                        </div>
                        -->
                        <!--  <a href="#"><small>Forgot password?</small></a> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-6">
            Copyright โรงไฟฟ้าแม่เมาะ
        </div>
        <div class="col-md-6 text-right">
            <small>© 2014-2015</small>
        </div>
    </div>
</div>

</body>
