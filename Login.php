
<?php 
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="Style.css" />
</head>

<body>
<div class="content">
		<div class="menu">
			<div class="menuleft">
				<a href=""><img src="Anh_logo/nhanh_vn.png"></a>
			</div><!--end menuleft-->
			<div class="menuright">
				<ul>
					<li><a href="Trang_chu.html">Trang chủ</a></li>
					<li><a href="#">Tin tức</a></li>
					<li><a href="#">Dịch vụ</a></li>
					<li><a href="#">Bảng Giá</a></li>
                    <li><a href="#">Đăng Nhập</a></li>
				</ul>
			</div><!--end menuright-->
		</div><!--end menu--> 
    <!--begin Form -->
    <div class="form">
        <form method="post">
                <div class="tong">
                    <div class="trai">
                        <img src="Anh_logo/Login.jpg" width="300px" height="300px"/>
                    </div><!--end trai-->
                    <div class="phai">
                        <h1>Đăng nhập</h1><br>
                        <input class="inp" type="text" name="email" placeholder="Nhập vào email"/><br />
                        <input class="inp" type="password" name="pass" placeholder="Nhập vào mật khẩu" /><br />
                        <input type="checkbox" name="chkbox" /><font>Tôi không phải Robot</font><br />
                        <input class="sub" type="submit" name="ok" value="Đăng nhập" /><br><br>
                        <a href="Doi_Pass.php"><i>Đổi mật khẩu?</i></a> |
                        <a href="Quen_pass.php"><i>Quên mật khẩu?</i></a><br><br>
                        <i>Bạn chưa có tài khoản?</i><a href="Dangky.php">Đăng Ký</a>        
                    </div><!--end phai-->
                </div><!--end tong-->
        </form>
		<?php 
            include ('Control.php');
            if(isset($_POST['ok']))
            {
                $em = $_POST['email'];
                $pass = $_POST['pass'];	
                $dn = new Datphong();
                $dn_em  = $dn->login_user($em);
                $dn_pass = $dn->login_pass($em);
                $_SESSION['email'] = $em;
                if(empty($em)||empty($pass))//Kiem tra viec nhap du lieu
                    echo "<script>alert('Ban chua nhap du lieu')</script>";
                else if(isset($_POST['chkbox']))//Kiem tra viec kich vao check box
                {
                    if(($em=='admin@gmail.com') && ($pass=='123'))//Kiem tra tai khoan co phai la admin ko
                    {	$_SESSION['email'] = 'admin@gmail.com';
                        header('location:Get_All.php');//chuyen trang neu thoa man
                    }
                    else
                    {
                        if($dn_em==0) echo "<script>alert('Email khong ton tai')</script>";	//Kiem tra email co trong CSDL ko
                        else 
                        {
                            foreach($dn_pass as $dem)
                            { 
								//So sanh pass nhap voi pass trong CSDL co trung nhau ko
								if($pass != $dem['Pass']) echo"<script>alert('Ban nhap sai password!')</script>"; 
                                /*if($dn_pass==0) echo "<script>alert('Ban nhap sai password')</script>";*/ //TH ko so pass 
                                else 
								{
									echo "<script>alert('Dang nhap thanh cong')</script>";
									header('location:Form_KH_Nhap.php');//chuyen trang neu thoa man
								}
                            }	
                        }
                      
                    }
                }
                else echo "<script>alert('Ban chua kich vao checkbox')</script>";
             }
        ?>
 	</div><!--end Form--> 
 </div><!--end content-->
</body>
</html>