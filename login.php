
<html>
<head><title>LoginPage</title></head>
<body>
<div align="center">
<link href="style.css" type="text/css" rel="stylesheet">

<!-- form for login if you have a user -->
<div class="container">
  <form action="check_login.php" method="post">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="pwd"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="pwd" required>

      <button type="submit">Login</button>
    <br><br>
  </form>

  ユーザーがない場合はしたに、登録してください！
<!-- form for create user -->
  <form action="createuser.php" method="post">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="pwd"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="pwd" required>

      <button type="submit">create</button>
    <br><br>
  </form>
</div>



<script>
	function isNumberKey(evt){
    var charCode = evt.keyCode;
	    if(charCode>48&&charCode<57){
	    	return true;	
	    }    
	    alert("aaa");
	    return false;
	}
</script>
</div>
</body>
</html>

