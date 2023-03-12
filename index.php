
<!DOCTYPE html>
  <head>
    <meta charset="UTF-8">
    <title> Login</title>
    <link rel="stylesheet" href="logstyle.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="content">
      <div class="image-box">
        <img src="logo.png" alt="">
      </div>
    <form  action="log.php" method="post"	>
	
	
      <div class="topic">LOGIN</div>
	  <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
      <div class="input-box">
        <input type="text" name="username" class="name" >
        <label>Username</label>
      </div>
      <div class="input-box">
        <input type="password" name="password" class="password" >
        <label>Password</label>
      </div>
	  
      <div class="btn-field">
        <input type="submit" name="login" value="SUBMIT">
      </div>
    </form>
  </div>
  </div>
</body>
</html>
