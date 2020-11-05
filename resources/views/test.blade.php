<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form method="post" action="/admin_dash" enctype="multipart/form-data">
		@csrf
		<input type="file" name="images[]" accept="image/*" multiple>
		<input type="submit" value="Submit">
	</form>
</body>
</html>