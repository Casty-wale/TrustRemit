<?php require_once ('includes/session.php')?>
<?php require_once('includes/header.php');?>
<?php require_once('includes/add_model.php');?>
<?php require_once('includes/connect.php');?>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i><img src="images/remmy.png" class = "icon" alt="trustremit" style = "width:80px"></i>
        <div class="logo_name"><span style="font-weight:bold; color:rgb(116, 12, 12)">Trust</span><b style="color:rgb(9, 94, 6)">Remit</b></div>
        <!-- <i class='bx bx-menu' id="btn" ></i> -->
    </div>
    <hr style="height:2px; background-color:white">
    <ul class="nav-list">
      <!-- <li>
        <form action="transaction1.php" method="POST">
          <i class='bx bx-search' name = "Search"></i>
         <input type="text" name = "Search" placeholder="Search...">
         <button name = "Search"></button>
         <span class="tooltip">Search</span>
        </form>
      </li> -->
      <li>
        <a href="#">
        <i class='bx bx-user'></i>
          <span class="links_name">Users</span>
        </a>
         <span class="tooltip">Users</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bxs-user-account'></i>
          <span class="links_name">Accounts</span>
        </a>
        <span class="tooltip">Accounts</span>
      </li>
      <li>
       <a href="transaction.php">
        <i class='bx bx-dollar-circle'></i>
        <span class="links_name">Transactions</span>
       </a>
       <span class="tooltip">Transactions</span>
     </li>
     <li>
       <a href="#">
        <i class='bx bxs-coin-stack'></i>
        <span class="links_name">Completed</span>
       </a>
       <span class="tooltip">Completed</span>
     </li>
     <li>
       <a href="#">
        <i class='bx bx-loader-alt'></i>
        <span class="links_name">Pending</span>
       </a>
       <span class="tooltip">Pending</span>
     </li>
     <li>
       <a href="#">
        <i class='bx bx-yen'></i>
        <span class="links_name">Fox Rate</span>
       </a>
       <span class="tooltip">Fox Rate</span>
     </li>
     <li>
       <a href="#">
        <i class='bx bx-donate-heart'></i>
        <span class="links_name">Receiver</span>
       </a>
       <span class="tooltip">Receiver</span>
     </li>
     <li>
      <div class="iocn-link">
       <a href="#">
        <i class='bx bx-chat' ></i> 
        <span class="links_name">Feedback</span>
      </a>
      </div>
       <span class="tooltip">Feedback</span>
     </li>
    <?php if($_SESSION['access'] == "Admin"){?>
        <li>
          <div class="iocn-link">
          <a href="#addnew" data-toggle="modal">
            <i class='bx bx-user-plus'></i>
            <span class="links_name">Add User</span>
          </a>
          </div>
          <span class="tooltip">Add User</span>
        </li>
    <?php }?>
     <li class="profile">
         <div class="profile-details">
           <img src="images/upsa.jpg" alt="profileImg">
           <div class="name_job">
             <div class="name"><?php echo $_SESSION['user']?></div>
             <div class="job"><?php echo $_SESSION['access']?></div>
           </div>
         </div>
         <a href = "logout.php"><i class='bx bx-log-out' id="log_out" href = "logout.php"></i></a>
     </li>
    </ul>
  </div>
  <!-- <div class="mname"><?php //$_SESSION['user']?></div> -->
  <!-- <div class="mjob"><?php //$_SESSION['access']?></div> -->
  <script>
  let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector(".icon");
  // let searchBtn = document.querySelector(".bx-search");
  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();//calling the function(optional)
  });

  // searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
  //   sidebar.classList.toggle("open");
  //   menuBtnChange(); //calling the function(optional)
  // });

  // following are the code to change sidebar button(optional)
  function menuBtnChange() {
   if(sidebar.classList.contains("open")){
     closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
   }else {
     closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
   }
  }
  </script>
