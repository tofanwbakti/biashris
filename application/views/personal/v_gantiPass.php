<!-- View Template Ganti Password  -->
<!-- ================================================ -->
<script src="<?=base_url();?>assets/js/jquery-2.1.1.min.js" type="text/javascript"></script>
<script> 
$(function(){
    $("#oldpass").focus();
});

var isCtrl = false;
// Disable Ctrl + Command
document.onkeyup=function(e){
    if(e.which == 17)
    isCtrl=false;
}

document.onkeydown=function(e){
    if(e.which == 17)
    isCtrl=true;
    if((e.which == 85) || (e.which == 67) && isCtrl == true)
    {
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Tombol perintah dilarang!',
        })
        return false;
    }
}
// Disable right click
$(document).bind("contextmenu",function(e) {
    e.preventDefault();
    Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Tombol perintah dilarang!',
        })
});

// Disable F12 button
$(document).keydown(function (event) {
    if (event.keyCode == 123) { // Prevent F12
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Tombol perintah dilarang!',
        })
        return false;
    } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I      
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Tombol perintah dilarang!',
        })  
        return false;
    }
});

var passbaru = document.getElementById('newpass').value;
var konfpass = document.getElementById('matchpass').value;
// Cek Old Pass
function checkOldPass() {
    document.getElementById('pass').value = md5(document.getElementById('oldpass').value);
    $("#loaderIcon").show();

    let dbpass = document.getElementById('dbpass').value;
    let pass = document.getElementById('pass').value;

    if(dbpass == pass){
        $("#checkStatus").html('<span class="text-success"><i class="fa fa-check></i> Password Benar !</span>');
        $("#loaderIcon").hide();
        $("#newpass").attr('disabled',false);
        $("#matchpass").attr('disabled',false)
        document.getElementById("oldpass").style.backgroundColor = '#66cc66';
    }else {
        $('#checkStatus').html('<span class="text-red"><i class="fa fa-ban"></i> Password Salah !</span>');
        $("#loaderIcon").hide();
        $("#newpass").attr('disabled',true);
        $("#matchpass").attr('disabled',true);
        document.getElementById("oldpass").style.backgroundColor = '#ff6666';
    }
};

// validate Match Password
function cekCocok(){
    $("#btnsubmit").attr('disabled',true);
    

    if(konfpass == passbaru){
        $("#checkMatch").html('');
        document.getElementById("matchpass").style.backgroundColor = '#66cc66';
        $("#btnsubmit").attr('disabled',false);
    }else{
        $("#checkMatch").html('<span class="text-red"><i class="fa fa-ban"></i> Password tidak sama !</span>');
        document.getElementById("matchpass").style.backgroundColor = '#ff6666';
    }

}

</script>

<style>
    #password-meter {
        width:100%; 
        height:10px; 
        display: block;
        /* background-image: linear-gradient(to right, #e5405e 0%, #ffdb3a 45%, #3fffa2 100%); */
        border-radius: 25px;
        /* background-color: grey; */
    }
    
    #message p {
        padding: float;
        font-size: 15px;
        margin-left: 10px
    }

    /* Add a green text color and a checkmark when the requirements are right */
    .valid {
        color: green;
    }

    .valid:before {
        position: relative;
        left: -10px;
        content: "✔";
    }

    /* Add a red text color and an "x" when the requirements are wrong */
    .invalid {
        color: red;
    }

    .invalid:before {
        position: relative;
        left: -10px;
        content: "✖";
    }
</style>
<!-- Breadcumb section -->
<section class="content-header">
    <h1>
        <div class="icon">
        <i class="fa fa-key"></i> Ganti Password
        <!-- <small>Tidak Masuk Kerja / Alpa</small> -->
        </div>
        
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Hrd"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
        <li><a href="#"><i class="fa fa-key active"></i> Ganti Password</a></li>
        
</section>

<!-- Flash Data -->
<div class="passflash" data-flashdata="<?=$this->session->flashdata('flash'); ?>"></div>
<!-- Main content -->
<section class="content">
<!-- Default box -->
<div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Hi! <b><?= $this->fungsi->user_login()->nickname ?></b> Selamat Datang</h3> 
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            Kamu di dalam menu untuk reset password.
        </div><!-- /.box-body -->
        <!-- <div class="box-footer">
            Footer
        </div>/.box-footer -->
    </div>
<!-- /.box -->
<div class="container">
    <div class="row">
    <form action="<?=site_url('C_Personal/resetPassword')?>" method="post">
            <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span class="fa fa-th" style="margin-right:10px"></span>
                            Ganti Password   
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 separator"> <br>
                                <img alt="" class="img-thumbnail" src="<?php echo base_url();?>uploads/image/<?=$this->fungsi->user_login()->foto ?>">                        
                            </div>                        
                            <div style="margin-top:50px;" class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="hidden" name="email" value="<?= $this->fungsi->user_login()->email?>">
                                        <input class="form-control" type="password" id="oldpass" style="width:200px" placeholder="Password Lama" onblur="checkOldPass()" utocomplete="off" required>
                                        <div class="input-group-addon" id="btn_old" >
                                            <a href="javascript:void(0)" onclick="myFunction3()"><i class="fa fa-eye-slash text-black" aria-hidden="true"></i></a>
                                        </div>
                                        
                                    </div>
                                    <?php foreach ($row as $data){ ?>
                                        <input type="hidden" id="dbpass" value="<?= $data['password']?>">
                                    <?php } ?>
                                        <input type="hidden" id="pass" >
                                    <span id="checkStatus"></span>
                                    <p><img src="<?=base_url();?>assets/images/48x48.gif" id="loaderIcon" style="display:none"></p>
                                </div>
                                <div class="form-group" >
                                    <div class="input-group">
                                        <input class="form-control password" type="password" id="newpass" name="newpass" style="width:200px" placeholder="Password Baru" autocomplete="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Harus ada minimal satu angka, satu huruf besar dan huruf kecil, dan minimal 8 karakter" disabled required>
                                        <div class="input-group-addon" id="btn_new" >
                                            <a href="javascript:void(0)" onclick="myFunction2()"><i class="fa fa-eye-slash text-black" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <div>
                                        <progress id="password-meter" value="0" max="100"></progress>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <!-- <div class="input-group-addon"><span class="fa fa-sign-in"></span></div> -->
                                        <input class="form-control" type="password" id="matchpass" name="matchpass" style="width:200px" placeholder="Konfirmasi" autocomplete="off" onchange="cekCocok()" disabled required>
                                        <div class="input-group-addon" id="btn_match">
                                            <a href="javascript:void(0)" onclick="myFunction()"  ><i class="fa fa-eye-slash text-black" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <span id="checkMatch"></span>
                                </div>
                                <div class="form-group">
                                    <div class="container" style="opacity:.5; display:none" id="message">
                                        <p id="capital" class="invalid">
                                            <span> Huruf Kapital</span>
                                        </p>                                
                                        <p id="num" class="invalid">
                                            <span> Angka</span>
                                        </p>                                
                                        <p id="more8" class="invalid">
                                            <span> 8 karakter</span>
                                        </p>                                
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6"></div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <button class="btn icon-btn-save btn-success" type="submit" id="btnsubmit"  disabled>
                                <span class="btn-save-label"><i class="fa fa-floppy-o"></i></span>save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</section>


<script>
let newpass = document.querySelector("#newpass");
let passmtr = document.querySelector("#password-meter");

var pwd     = document.getElementById("newpass");
var capital = document.getElementById("capital");
var num     = document.getElementById("num");
var more8   = document.getElementById("more8");
pwd.onfocus = function(){
    document.getElementById("message").style.display = "block";
}

if(pwd == ""){
    pwd.onblur = function (){
        document.getElementById("message").style.display = "none";
    }
}

// Validate when typing password
pwd.onkeyup = function(){
    // validate uppercase letter
    var upperCase = /[A-Z]/g;
    if(pwd.value.match(upperCase)){
        capital.classList.remove("invalid");
        capital.classList.add("valid");
    }else{
        capital.classList.remove("valid");
        capital.classList.add("invalid");
    }

    // Validate Number 
    var numbers = /[0-9]/g;
    if(pwd.value.match(numbers)){
        num.classList.remove("invalid");
        num.classList.add("valid");
    }else{
        num.classList.remove("valid");
        num.classList.add("invalid");
    }

    // Validate length
    if(pwd.value.length >= 8){
        more8.classList.remove("invalid");
        more8.classList.add("valid");
    }else{
        more8.classList.remove("valid");
        more8.classList.add("invalid");        
    }
}

// When typing password call function on progress
newpass.addEventListener("keyup", function(e){
    cekPassword(newpass.value);
});

// Progress Strength Password
function cekPassword(newpass){
    let strength = 0;
    if(newpass.match(/([a-z])/)){ strength += 1; }
    if(newpass.match(/([A-Z])/)){ strength += 1; }
    if(newpass.match(/([0-9])/)){ strength += 1;}
    if(newpass.length >= 8){ strength += 1;}
    passmtr.value = strength *25;
}



function myFunction() {
    let x = document.getElementById("matchpass");
    if (x.type === "password") {
        x.type = "text";
        $("#btn_match").html('<a href="javascript:void(0)" onclick="myFunction()"  ><i class="fa fa-eye" aria-hidden="true"></i></a>');
    } else {
        x.type = "password";
        $("#btn_match").html('<a href=javascript:void(0)" onclick="myFunction()"  ><i class="fa fa-eye-slash text-black" aria-hidden="true"></i></a>');
    }
}

function myFunction2() {
    let x = document.getElementById("newpass");
    if (x.type === "password") {
        x.type = "text";
        $("#btn_new").html('<a href="javascript:void(0)" onclick="myFunction2()"  ><i class="fa fa-eye" aria-hidden="true"></i></a>');
    } else {
        x.type = "password";
        $("#btn_new").html('<a href="javascript:void(0)" onclick="myFunction2()"  ><i class="fa fa-eye-slash text-black" aria-hidden="true"></i></a>');
    }
}

function myFunction3() {
    let x = document.getElementById("oldpass");
    if (x.type === "password") {
        x.type = "text";
        $("#btn_old").html('<a href="javascript:void(0)" onclick="myFunction3()"  ><i class="fa fa-eye" aria-hidden="true"></i></a>');
    } else {
        x.type = "password";
        $("#btn_old").html('<a href="javascript:void(0)" onclick="myFunction3()"  ><i class="fa fa-eye-slash text-black" aria-hidden="true"></i></a>');
    }
}



</script>





