<?php require_once('includes/sidemenu.php')?>
<!-- <script type="text/javascript" charset="utf8" src="js/OFFmain.js"></script> -->
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
                    // $count = 1;
                    // $sql = "SELECT `amountPaid`,`volumeReceived`, `doneAt`, `receivers`.`firstName` AS Rfname, `receivers`.`lastName`AS Rlname, `receivers`.`email` AS Remail, `receivers`.`phoneNumber` AS RPnumber, `receivers`.`countryLong` AS RcountryLong, `accounts`.`title` AS Atitle, `accounts`.`firstName` AS Afname, `accounts`.`lastName` AS Alname FROM `transactions` LEFT JOIN `accounts` ON `accounts`.`id` = `transactions`.`accountId` LEFT JOIN `fxrates` ON `fxrates`.`id` = `transactions`.`fxRateId` LEFT JOIN `receivers` ON `receivers`.`id` = `transactions`.`receiverId` WHERE `receivers`.`firstName` IS NOT NULL AND `receivers`.`lastName` IS NOT NULL ORDER BY `receivers`.`id`"; //ORDER BY `receivers`.`r_id` ASC;
                    // $query = $con->query($sql);
                    // $nRow = mysqli_num_rows($query);
                    // if($nRow > 0){
                    //     while($row = $query->fetch_assoc()){

                    //         // `r_id`,<td>".$row['r_id']."</td>
                    //         echo "
                    //         <tr>
                    //             <td>".$count."</td>
                    //             <td>".$row['Rfname']." ".$row['Rlname']."</td>
                    //             <td>".$row['Remail']."</td>
                    //             <td>".$row['RPnumber']."</td>
                    //             <td>".$row['RcountryLong']."</td>
                    //             <td>".$row['Atitle'].". ".$row['Afname']." ".$row['Alname']."</td>
                    //             <td>".number_format($row['amountPaid'], 2, '.', '')."</td>
                    //             <td>".number_format($row['volumeReceived'], 2, '.', '')."</td>
                    //             <td>".$row['doneAt']."</td>
                    //             </tr>
                    //             ";

                    //         $count = $count + 1;
                    //     }
                    // }
                    // else{
                    //     echo "No Receiver found";
                    // }
                ?>
            </tbody>
          </table>
        </div>
  </section>
  <?php require_once('includes/script.php')?>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable({
        // "fnCreatedRow": function( nRow, aData, iDataIndex ) {
        //   $(nRow).attr('id', aData[0]);
        // },
        'serverSide':'true',
        'processing':'true',
        'paging':'true',
        // 'order':[],
        'ajax': {
          'url':'receiver_data.php',
          'type':'post',
        },
        "columnDefs": [{
          'target':[8],
          'orderable' :false,
        }]
      });
    } );

  </script>
</body>
</html>