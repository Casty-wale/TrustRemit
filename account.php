
<?php require_once('includes/sidemenu.php')?>
<script type="text/javascript" charset="utf8" src="js/OFFmain.js"></script>
  <section class="home-section">
      <div class="text">Accounts</div>
        <div class = content>
          <table id = "example" class ="table table-bordered table-hover">
            <thead class = "table-dark">
                <th>#</th>
                <th>Title</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>E-mail</th>
                <th>Number</th>
                <th>Account Limit</th>
                <th>Created on</th>
            </thead>
            <tbody>
                <?php
                    $count = 1;
                    $sql = "SELECT `title`, `firstName`, `lastName`, `email`, `phoneNumber`, `txLimit`, `created` FROM `accounts` WHERE 1";
                    $query = $con->query($sql);
                    $nRow = mysqli_num_rows($query);
                    if($nRow > 0){
                        while($row = $query->fetch_assoc()){

                            echo "
                            <tr>
                                <td>".$count."</td>
                                <td>".$row['title']."</td>
                                <td>".$row['firstName']."</td>
                                <td>".$row['lastName']."</td>
                                <td>".$row['email']."</td>
                                <td>".$row['phoneNumber']."</td>
                                <td>".number_format($row['txLimit'], 2, '.', '')."</td>
                                <td>".$row['created']."</td>
                            </tr>
                            ";

                            $count = $count + 1;
                        }
                    }
                    else{
                        echo "No Account found";
                    }
                ?>
            </tbody>
          </table>
        </div>
  </section>
  <?php require_once('includes/script.php')?>
</body>
</html>