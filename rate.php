<?php require_once('includes/sidemenu.php')?>
<script type="text/javascript" charset="utf8" src="js/OFFmain.js"></script>
    <section class="home-section">
        <div class="text">Fox Rate</div>
        <div class = content>
            <table id = "example" class ="table table-bordered table-hover">
                <thead class = "table-dark">
                    <th>#</th>
                    <th>Currency</th>
                    <th>Currency Code</th>
                    <th>Rate</th>
                    <th>Created On</th>
                    <th>Updated On</th>
                </thead>
                <tbody>
                    <?php
                        $count = 1;
                        $sql = "SELECT * FROM fxrates WHERE 1";
                        $query = $con->query($sql);
                        $nRow = mysqli_num_rows($query);
                        if($nRow > 0){
                            while($row = $query->fetch_assoc()){

                                echo "
                                <tr>
                                    <td>".$count."</td>
                                    <td>".$row['currencyFull']."</td>
                                    <td>".$row['currencyShort']."</td>
                                    <td>".number_format($row['rate'], 2, '.', '')."</td>
                                    <td>".$row['createdAt']."</td>
                                    <td>".$row['updatedAt']."</td>
                                </tr>
                                ";

                                $count = $count + 1;
                            }
                        }
                        else{
                            echo "No Rate found";
                        }
                    ?>
                </tbody>  
            </table>
        </div>
    </section>
    <?php require_once('includes/script.php')?>
</body>
</html>