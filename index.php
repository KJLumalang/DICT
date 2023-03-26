
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
        <input type="text" name="username" class="name" required>
        <label>Username</label>
      </div>
      <div class="input-box">
        <input type="password" name="password" class="password" required>
        <label>Password</label>
      </div>
	  
      <div class="btn-field">
        <input type="submit" name="login" value="SUBMIT">
      </div>
    </form>
  </div>
  </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>
