<html>
    <head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="row justify-content-center">
<form  method="POST" action="">
                <div class="form-group">
                <label>ID VOITURE:</label>
                <input type="text" name="idvoiture" id="idvoiture" placeholder="Entrer ID" class="from-control" required>
              </div>
              <div class="form-group">
                <label> ETAT:</label>
           <input type="text" name="etat" id="etat" placeholder="Entrer votre etat" class="from-control" required>
         </div>
           <div class="form-group">
           <p>Date Location:</p>
           <input type="date" name="datelocation" id="datelocation" class="from-control" placeholder="Entrer la date Location" required>
           </div >
           <div class="form-group">
           <button type="submit" name="enregitrer">Enregistrer</button>
         </div>
</form>
       </div>
</body>

    </html>