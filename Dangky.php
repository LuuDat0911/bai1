<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Dang ky</title>
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
            	<img src="Anh_logo/Dang_ky.png" width="300px" height="300px"/>
            </div><!--end trai-->
            <div class="phai">
            	<h1>Đăng ký</h1><br>
                <input class="inp" type="text" name="email" placeholder="Nhập vào email"/><br />
                <input class="inp" type="password" name="passwd" placeholder="Nhập vào mật khẩu" /><br />
                <input class="inp" type="password" name="re-passwd" placeholder="Nhập lại mật khẩu" /><br />
                <input type="checkbox" name="chkbox" /><font>Bạn có đồng ý với các điều khoản</font><br/>
                <input class="sub" type="submit" name="ok" value="Đăng ký" /><br><br>
                <i>Bạn đã có tài khoản?</i><a href="Login.php">Đăng Nhập</a>
            </div><!--end phai-->
        </div><!--end tong-->
    </form>
    <?php 
		include('Control.php');
		$acc = new Datphong();
		if(isset($_POST['ok']))
		{
			if(empty($_POST['email'])||empty($_POST['passwd']))//Kiem tra viec nhap du lieu
				echo "<script>alert('Ban chua nhap du lieu')</script>";
			else
			{
				$se_acc = $acc->Select_email($_POST['email']);	
				if($_POST['passwd'] != $_POST['re-passwd']) //Kiem tra viec nhap lai pass 
					echo "<script>alert('Hai mat khau chua khop nhau')</script>";
				else if(isset($_POST['chkbox']))//Kiem tra viec kich vao check box
				{
					if($se_acc!=0) echo	"<script>alert('Email khong ton tai')</script>";//Kiem tra email co trong CSDL hay ko
					else
					{
						//Insert thong tin vao ca bang t_dk va t_thongtin
						$ad_acc = $acc->adduser($_POST['email'], $_POST['passwd']);
						$ad_infor = $acc->Insert_t_thongtin('','',$_POST['email'],'','','','','','','',''); 
						if($ad_acc and $ad_infor)
						{
							echo "<script>alert('Dang ky thanh cong')</script>";
							header('location:Login.php');//chuyen trang neu thoa man
						}
						else echo "<script>alert('Dang ky khong thanh cong')</script>";
					}
				}
				else echo "<script>alert('Ban chua kich vao checkbox')</script>";
			}	
		}
	?>
    </div><!--end form--> 
</div><!--end content-->	
</body>
</html>