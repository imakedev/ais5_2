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
                    <div style='text-align: center';>
                        <h3>AIS2015 LOGIN FORM</h3>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><span class="fa fa-user"></span></span>
                        <input type="email"  name="email" class="form-control" placeholder="รหัสประจำตัว" required="">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                        <input type="password"  name="password" class="form-control" placeholder="รหัสผ่าน" required="">
                    </div>
                    <div class="form-group">
                        <input type='radio' checked='checked' name='mmplant'> <span class='fa fa-tasks'></span> MM4-7
                        <input type='radio' name='mmplant'> <span class='fa fa-tasks'></span> MM8-13
                        <input type='radio' name='mmplant'> <span class='fa fa-tasks'></span> FGD8-13
                    </div>
                    <div class='row'>
                        <div class='col-md-6'>
                            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                        </div>
                        <!--
                        <div class='col-md-6'>
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
