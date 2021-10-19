<?php require_once('includes/session.php')?>
<?php require_once('includes/header.php')?>
<?php require_once('includes/sidemenu.php')?>
<?php include './utils.php'; ?>
<script type="text/javascript" charset="utf8" src="js/OFFmain.js"></script>

  <section class="home-section">
      <div class="text">Users Details</div>
        <div class = content>
          <table id = "example" class ="table table-bordered table-hover">
              <thead class = "table-dark">
                <th>#</th>
                <th>Full Name</th>
                <th>Date of Birth</th>
                <th>ID Type</th>
                <th>ID Number</th>
                <th>Phone Number</th>
                <th>City</th>
                <th>Region</th>
                <th>Country</th>
                <th>Created on</th>
              </thead>
              <tbody>
                <?php
                  // $count = 1;
                  $details = array();
                  $checker = array();
                  
                  $sql = "SELECT title, firstName, lastName, dob, idType, idNumber, phoneNumber, city, region, countryLong, createdAt FROM userdetails LEFT JOIN accounts ON accounts.id = userdetails.accountId ORDER BY `userdetails`.`user_id` asc";
                  $query = $con->query($sql);
                  $nRow = mysqli_num_rows($query);
                  if($nRow > 0){
                    while($row = $query->fetch_assoc()){
                      array_push($details, [
                        'fn'=>$row['title'].'. '.$row['firstName'].' '.$row['lastName'],
                        'id_type'=>$row['idType'],
                        'id_num'=>$row['idNumber'],
                        'dob'=>$row['dob'],
                        'phoneNumber'=>$row['phoneNumber'],
                        'city'=>$row['city'],
                        'region'=>$row['region'],
                        'countryLong'=>$row['countryLong'],
                        'createdAt'=>$row['createdAt']
                      ]);
                      $data = $row['title'].'. '.$row['firstName'].' '.$row['lastName'].$row['idNumber'].$row['dob'];
                      $data = strtolower($data);
                      array_push($checker, $data);
                    }
                    foreach ($details as $key => $detail) {
                      $user = $detail['fn'].$detail['id_num'].$detail['dob'];
                      $user = strtolower($user);
                      $totalAppearance = flag($checker, $user);
                      if($totalAppearance > 1){
                        echo "<tr style='background:red'>
                        <td>".++$key."</td>
                        <td>".$detail['fn']."</td>
                        <td>".$detail['dob']."</td>
                        <td>".$detail['id_type']."</td>
                        <td>".$detail['id_num']."</td>
                        <td>".$detail['phoneNumber']."</td>
                        <td>".$detail['city']."</td>
                        <td>".$detail['region']."</td>
                        <td>".$detail['countryLong']."</td>
                        <td>".$detail['createdAt']."</td>
                        </tr>
                        ";
                      }else{
                        echo "<tr>
                        <td>".++$key."</td>
                        <td>".$detail['fn']."</td>
                        <td>".$detail['dob']."</td>
                        <td>".$detail['id_type']."</td>
                        <td>".$detail['id_num']."</td>
                        <td>".$detail['phoneNumber']."</td>
                        <td>".$detail['city']."</td>
                        <td>".$detail['region']."</td>
                        <td>".$detail['countryLong']."</td>
                        <td>".$detail['createdAt']."</td>
                        </tr>
                        ";
                      }
                    }

                  }
                ?>
              </tbody>
          </table>
        </div>
  </section>
  <?php require_once('includes/script.php')?>
</body>
</html>