<?php require_once('includes/sidemenu.php')?>
<?php
    if(isset($_POST['calcu'])){
        $start = $_POST['start'];
        $end = $_POST['end'];
        $deCount = "SELECT COUNT(*) as counting FROM `transactions` WHERE `tansCreatedAt` BETWEEN '$start 00:00' AND '$end 11:59'";
        $totalCedis = "SELECT SUM(`amountPaid`) as total FROM `transactions` WHERE `tansCreatedAt` BETWEEN '$start 00:00' AND '$end 11:59'";
        $dateCount = $con->query($deCount);
        $pprow = $dateCount->fetch_object();
        $putCount = $pprow->counting;
        $tC = $con->query($totalCedis);
        $pprow2 = $tC->fetch_object();
        $putamount = $pprow2->total;
        
    }else{
        $putCount = 0;
        $putamount = 0;
    }
?>
<style>
    .search-box{
        position: absolute;
        z-index: 1;
        right: 5px;
        margin-right: 40px;
        transform: translate(-50, -50);
        color: #fff;
        background: #2f3640;
        height: 40px;
        border-radius: 40px;
        padding: 0px;
    }
    .search-btn{
        color: #e84118;
        float: right;
        width: 30px;
        height: 30px;
        margin: 5px 5px 5px 0px;
        border-radius: 50%;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: 0.4s;
    }
    .search-txt{
        border: none;
        background: none;
        outline: none;
        float: left;
        padding: 10px;
        color: white;
        font-size: 16px;
        transition: 0.4s;
        line-height: 20px;
        width: 180px;
    }
    /* .bg-priss{
        margin: 50px
    } */
    .priss{
        margin-left: 150px;
    }
</style>
<section class="home-section">
    <div class="text">Transactions</div>
        <div class = "content">
            <form action = "transaction.php" method= "POST">
                <div class = "container">
                    <div class = "row">
                        <div class = "col-md-10 input-group bg-priss">
                            <!-- <div class = "row"> -->
                                <div class = "col-md-5">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                        <input type="text" name = "start" class="form-control" id = "start_date" placeholder="Start Date" readonly/>
                                    </div>
                                </div>
                            <!-- </div> -->
                            <!-- <div class = "row"> -->
                                <div class = "col-md-5 priss">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                        <input type="text" name = "end" class="form-control" id = "end_date" placeholder="End Date" readonly/>
                                    </div>
                                </div>
                            <!-- </div> -->
                        </div>
                        <div>
                            <button id = "calcu" name = "calcu" class ="btn btn-outline-info btn-sm">Calculate</button>
                            <button id = "reset" name = "reset" class ="btn btn-outline-warning btn-sm">Reset</button>
                        </div>
                    </div>
                </div>
            </form>
            <form action = "transaction.php" method= "POST">
                <div class="search-box">
                    <input class = "search-txt" type="text" name ="search" placeholder = "Search something"/>
                    <button class = "search-btn" type = "submit" name = "submit-search"><i class="fas fa-search-dollar fa-lg"></i></button>
                    <!-- <a class = "search-btn" href = "#">
                        <i class="fas fa-search-dollar fa-2x"></i>
                    </a> -->
                </div>
            </form>
            <div class = "input-group" style = "text-align: center, position: absolute">
                <div class = "col-md-2">
                    <div class="input-group mb-2">
                        <span class="input-group-text" id="basic-addon1">GHc </span>
                        <span class="input-group-text"><?php echo number_format($putamount, 2, '.', ''); ?></span>
                    </div>
                </div>
                <div class = "col-md-2">
                    <div class="input-group mb-2">
                        <span class="input-group-text" id="basic-addon1">Transactions </span>
                        <span class="input-group-text"><?php echo $putCount; ?></span>
                    </div>
                </div>
            </div>
          <table id = "example" class ="table table-bordered table-hover">
              <thead class = "table-dark">
                  <th>ID</th>
                  <th>Sent By</th>
                  <th>Invoice ID</th>
                  <th>Order ID</th>
                  <th>Amount Paid</th>
                  <th>Charge</th>
                  <th>Amount Received</th>
                  <th>Status</th>
                  <th>Date</th>
                  <th>Received By</th>
              </thead>
              <tbody>
                  <?php
                    if(isset($_POST['submit-search'])){
                        $search = $_POST['search'];
                        $sql = "SELECT * FROM transactions LEFT JOIN accounts ON accounts.id = transactions.accountId LEFT JOIN destdetails ON destdetails.code = transactions.destinationCode LEFT JOIN fxrates ON fxrates.id = transactions.fxRateId LEFT JOIN receivers ON receivers.r_id = transactions.receiverId LEFT JOIN services ON services.id = transactions.serviceId WHERE Trans_id = '$search'";
                        $result = mysqli_query($con, $sql);
                        $queryResult = mysqli_num_rows($result);
                        if($queryResult > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $caught = $row['orderID'];
                                if($caught != ''){
                                    echo "
                                    <tr>
                                        <td>".$row['Trans_id']."</td>
                                        <td>".$row['title'].". ".$row['firstName']." ".$row['lastName']."</td>
                                        <td>".$row['invoiceID']."</td>
                                        <td>".$row['orderID']."</td>
                                        <td>".number_format($row['amountPaid'], 2, '.', '')."</td>
                                        <td>".number_format($row['fees'], 2, '.', '')."</td>
                                        <td>".number_format($row['volumeReceived'], 2, '.', '')."</td>
                                        <td>".$row['status']."</td>
                                        <td>".$row['tansCreatedAt']."</td>
                                        <td>".$row['firstNameR']." ".$row['lastNameR']."</td>
                                    </tr>
                                    ";
                                }else{
                                    echo "
                                    <tr style='background: #e46c6cb6'>
                                        <td>".$row['Trans_id']."</td>
                                        <td>".$row['title'].". ".$row['firstName']." ".$row['lastName']."</td>
                                        <td>".$row['invoiceID']."</td>
                                        <td>".$row['orderID']."</td>
                                        <td>".number_format($row['amountPaid'], 2, '.', '')."</td>
                                        <td>".number_format($row['fees'], 2, '.', '')."</td>
                                        <td>".number_format($row['volumeReceived'], 2, '.', '')."</td>
                                        <td>".$row['status']."</td>
                                        <td>".$row['tansCreatedAt']."</td>
                                        <td>".$row['firstNameR']." ".$row['lastNameR']."</td>
                                    </tr>
                                    ";
                                  }

                            }
                
                        }
                    }else{
                      $sql = "SELECT * FROM transactions LEFT JOIN accounts ON accounts.id = transactions.accountId LEFT JOIN destdetails ON destdetails.code = transactions.destinationCode LEFT JOIN fxrates ON fxrates.id = transactions.fxRateId LEFT JOIN receivers ON receivers.r_id = transactions.receiverId LEFT JOIN services ON services.id = transactions.serviceId WHERE status ='completed' OR status ='failed' OR status ='processing' ORDER BY `transactions`.`tansCreatedAt` DESC";
                      $query = $con->query($sql);
                      $nRow = mysqli_num_rows($query);
                      if($nRow > 0){
                          while($row = $query->fetch_assoc()){
                            $caught = $row['orderID'];
                            if($caught != ''){
                                echo "
                                <tr>
                                    <td>".$row['Trans_id']."</td>
                                    <td>".$row['title'].". ".$row['firstName']." ".$row['lastName']."</td>
                                    <td>".$row['invoiceID']."</td>
                                    <td>".$row['orderID']."</td>
                                    <td>".number_format($row['amountPaid'], 2, '.', '')."</td>
                                    <td>".number_format($row['fees'], 2, '.', '')."</td>
                                    <td>".number_format($row['volumeReceived'], 2, '.', '')."</td>
                                    <td>".$row['status']."</td>
                                    <td>".$row['tansCreatedAt']."</td>
                                    <td>".$row['firstNameR']." ".$row['lastNameR']."</td>
                                </tr>
                                ";
                            }else{
                                echo "
                                <tr style='background: #e46c6cb6'>
                                    <td>".$row['Trans_id']."</td>
                                    <td>".$row['title'].". ".$row['firstName']." ".$row['lastName']."</td>
                                    <td>".$row['invoiceID']."</td>
                                    <td>".$row['orderID']."</td>
                                    <td>".number_format($row['amountPaid'], 2, '.', '')."</td>
                                    <td>".number_format($row['fees'], 2, '.', '')."</td>
                                    <td>".number_format($row['volumeReceived'], 2, '.', '')."</td>
                                    <td>".$row['status']."</td>
                                    <td>".$row['tansCreatedAt']."</td>
                                    <td>".$row['firstNameR']." ".$row['lastNameR']."</td>
                                </tr>
                                ";
                              }

                              //$count = $count + 1;
                          }
                        }
                      else{
                          echo "No Transactions found";
                      }
                    }
                  ?>
              </tbody>
          </table>
        </div>
  </section>
  <?php require_once('includes/script.php')?>
  <script>
    $(document).ready( function () {
        $('#example').DataTable({
        'searching'   : false,
        });
    } );

    $( function() {
        $( "#start_date" ).datepicker({
            dateFormat: "yy-mm-dd",
            changeYear: true,
            changeMonth: true,
            showOtherMonths: true,
            minDate: new Date(2020,11,15)
        });
        $( "#end_date" ).datepicker({
            dateFormat: "yy-mm-dd",
            changeYear: true,
            changeMonth: true,
            showOtherMonths: true,
            minDate: new Date(2021,1,15),
            maxDate: new Date(2022,12,1)
        });
    } );
</script>
</body>
</html>