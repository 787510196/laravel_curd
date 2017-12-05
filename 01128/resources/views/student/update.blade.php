<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<form action="up" method="post" >
<center>
 <h3>修改页面</h3>
	<table>
		<tr>
		{{csrf_field()}}
		<input type="hidden" name="id" value="{{$res->id}}">

			<td>标题</td> 
			<td><input type="text" name="title" value="{{$res->title}}"></td>

		</tr>
		<tr>
			<td>评论</td>
			<td><textarea name="content" >{{$res->title}}</textarea></td>
		</tr>
		<tr>
     
			<td><input type="submit" value="修改"></td>
			<td><input type="reset" value="重置"></td>
		</tr>
	</table>
	</center>
</form>
	
</body>
</html>