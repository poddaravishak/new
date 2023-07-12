<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link type="text/css" rel="stylesheet" href="profile.css" />
    <title>Document</title>
  </head>
  <body>
  <?php
    include 'config.php';
    $sql="SELECT * from students";
    $query=mysqli_query($conn,$sql);
    while($info=mysqli_fetch_array($query)){
       ?>

    <section class="cardclass">
      <div class="card">
        <img
          src="<?php echo $info['photo']; ?>"
          alt="Alumni image"
          style="width: 70%"
          height="80%"
        />
        <h1><?php echo $info['first_name' ]; ?> <?php echo $info[ 'last_name']; ?></h1>
        <p>Department : CSE</p>
        <p>Batch : <?php echo $info['batch']; ?></p>
        <p>
          Email:
          <a href="mailto:<?php echo $info['email']; ?>"><?php echo $info['email']; ?></a>
        </p>
        <p>Mobile No : <?php echo $info['mobile']; ?></p>
        <p>Worked on : <?php echo $info['currently_worked']; ?></p>
        <p><button></button></p>
      </div>
    </section>

    <?php
    }
    ?>
  </body>
</html>
