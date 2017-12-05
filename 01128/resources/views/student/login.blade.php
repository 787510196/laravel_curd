<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<form action="login" method="post" >
<center>
 <h3>登录界面</h3>
	<table>
		<tr>
		{{csrf_field()}}
			<td>用户名</td> 
			<td><input type="text" name="username"></td>
		</tr>
		<tr>
			<td>密码</td>
			<td><input type="text" name="password"></td>
		</tr>
		<tr>
			<td><input type="submit" value="登录"></td>
			<td><a href="#">注册</a></td>
		</tr>
	</table>
	</center>
</form>
	
</body>
</html>