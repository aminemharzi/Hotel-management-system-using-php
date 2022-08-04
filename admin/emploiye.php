<html>
    <head>
        <title>
            admin
        </title>

        <link rel="stylesheet" href="emploiye.css">
        <link rel="stylesheet" href="menubar.css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">

    </head>
    <body>
    <nav id="nav">
  
  <!--<button class="toggle" id="toggle">
  <i class="fas fa-bars"></i>
   <i class="fas fa-times"></i>

  </button>-->
  <header><h3>My Menu</h3></header>
      <ul>

          <li><i class="fas fa-home"></i><a href="dashoard.php">Dashboard<i class="fas fa-caret-down"></i></a></li>
          <li ><i class="fas fa-chart-pie"></i><a href="adminmanagement.php">Admmin management</a></li>
          <li><i class="fas fa-address-book"></i><a href="company.php">Company management</a></li>
          <li><i class="fas fa-user"></i><a href="user.php">Users</a></li>
          <li class="this"><i class="fas fa-briefcase"></i><a href="#">Employee Management</a></li>
          <li><i class="fas fa-file-contract"></i><a href="#">Contracts</a></li>
          <li><i class="fas fa-door-closed"></i><a href="#">Requests</a></li>
          <li><i class="fas fa-door-closed"></i><a href="#">Leave Policy</a></li>
          <li><i class="fas fa-door-closed"></i><a href="#">Special Days</a></li>
          <li><i class="fas fa-door-closed"></i><a href="#">Apply for Leave</a></li>
      </ul>

  </nav>
    <div class="chambres">
    <div class="reserve">
            <fieldset>
                <legend>RESERVE ICI</legend>
                <form action="" method="post">
                Date de début:<input type="date" name="dateD" >
                Date de fin:<input type="date" name="dateF" >
                Chambres:<input type="number" name="idchambre" placeholder="numéro de chambre" min="1">
                Nombre des personnes:<input type="number" min="1" name="nbrP">
                
                </form>
            </fieldset>



        </div>
        

    </div>


        
        <script>
    
        </script>
    </body>
</html>