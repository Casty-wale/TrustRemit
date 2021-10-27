<?php require_once('includes/sidemenu.php')?>
<!-- <script type="text/javascript" charset="utf8" src="js/OFFmain.js"></script> -->
  <section class="home-section">
      <div class="text">Feedbacks</div>
        <div class = content>
          <table id = "example" class ="table table-bordered table-hover">
            <thead class = "table-dark">
                <th>#</th>
                <th>Name</th>
                <th>E-Mail</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Created On</th>
                <th>Updated On</th>
            </thead>
            <tbody>
                <?php
                    // $count = 1;
                    // $sql = "SELECT * FROM feedbacks WHERE 1";
                    // $query = $con->query($sql);
                    // $nRow = mysqli_num_rows($query);
                    // if($nRow > 0){
                    //     while($row = $query->fetch_assoc()){

                    //         echo "
                    //         <tr>
                    //             <td>".$count."</td>
                    //             <td>".$row['name']."</td>
                    //             <td>".$row['email']."</td>
                    //             <td>".$row['subject']."</td>
                    //             <td>".$row['message']."</td>
                    //             <td>".$row['createdAt']."</td>
                    //             <td>".$row['updatedAt']."</td>
                    //         </tr>
                    //         ";

                    //         $count = $count + 1;
                    //     }
                    // }
                    // else{
                    //     echo "No Feedback found";
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
          'url':'feedback_data.php',
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