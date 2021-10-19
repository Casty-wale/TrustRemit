<?php require_once('includes/sidemenu.php')?>
<script type="text/javascript" charset="utf8" src="js/OFFmain.js"></script>
  <section class="home-section">
      <div class="text">Receivers Details</div>
        <div class = content>
          <table id = "example" class ="table table-bordered table-hover">
            <thead class = "table-dark">
                <th>#</th>
                <th>Full Name</th>
                <th>E-Mail</th>
                <th>Phone Number</th>
                <th>Country</th>
                <th>Sent From</th>
                <th>Account Sent</th>
                <th>Account Received</th>
                <th>Date</th>
            </thead>
            <tbody>
                <?php
                    $count = 1;
                    $sql = "SELECT `amountPaid`, `volumeReceived`, `doneAt`, `firstNameR`, `lastNameR`, `emailR`, `phoneNumberR`, `countryLongR`, `title`, `firstName`, `lastName` FROM transactions LEFT JOIN accounts ON accounts.id = transactions.accountId LEFT JOIN fxrates ON fxrates.id = transactions.fxRateId LEFT JOIN receivers ON receivers.r_id = transactions.receiverId WHERE `firstNameR` IS NOT NULL AND `lastNameR` IS NOT NULL"; //ORDER BY `receivers`.`r_id` ASC;
                    $query = $con->query($sql);
                    $nRow = mysqli_num_rows($query);
                    if($nRow > 0){
                        while($row = $query->fetch_assoc()){

                            // `r_id`,<td>".$row['r_id']."</td>
                            echo "
                            <tr>
                                <td>".$count."</td>
                                <td>".$row['firstNameR']." ".$row['lastNameR']."</td>
                                <td>".$row['emailR']."</td>
                                <td>".$row['phoneNumberR']."</td>
                                <td>".$row['countryLongR']."</td>
                                <td>".$row['title'].". ".$row['firstName']." ".$row['lastName']."</td>
                                <td>".number_format($row['amountPaid'], 2, '.', '')."</td>
                                <td>".number_format($row['volumeReceived'], 2, '.', '')."</td>
                                <td>".$row['doneAt']."</td>
                            </tr>
                            ";

                            $count = $count + 1;
                        }
                    }
                    else{
                        echo "No Receiver found";
                    }
                ?>
            </tbody>
          </table>
        </div>
  </section>
  <?php require_once('includes/script.php')?>
</body>
</html>