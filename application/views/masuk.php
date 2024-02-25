<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>E-Canngopi | Login</title>
       <link href="<?php echo base_url(); ?>assets/login/css/masuk.css" rel="stylesheet" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <div class="login-form">
        
         <div class="text">
            E-Canngopi
         </div>
          <form action="<?=base_url('auth/aksi_login')?>" method="post">

            <div class="field">
               <div class="fas fa-envelope"></div>
               <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="field">
               <div class="fas fa-lock"></div>
               <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <button type="submit" value="Login">LOGIN</button>
                     </form>
      </div>
   </body>
</html>