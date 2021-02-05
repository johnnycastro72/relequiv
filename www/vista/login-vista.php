<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="UTF-8">
        <title>Acceso -> Relaciones de Equivalencia 1.0</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        
        <link rel="stylesheet" href="../recursos/style.css">
        <link rel="stylesheet" href="../css/style.css">
        
	</head>
	<body>
	    <div class="container-form">
    	    <div class="header">
                <h2>Relaciones de Equivalencia 1.0</h2>
	        </div>
	        
    		<div class="formulario">
    	        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="form">
    	            <div class="welcome-form"><h1>Bienvenido</h1> 
	                </div>
    	            <div class="line-input">
	                    <label class="lnr lnr-user"></label>
	                    <input type="text" placeholder="Nombre de Usuario" name="usuario" required>
	                </div>
	                <div class="line-input">
	                    <label class="lnr lnr-lock"></label>
	                    <input type="password" placeholder="Contraseña" name="clave" required>
	                </div>
	            
    	            <?php if(!empty($error)): ?>
	                <div class="mensaje">
	                    <?php echo $error; ?>
	                </div>
	                <?php endif; ?>
	            
    	            <button type="submit">Iniciar Sesión<label class="lnr lnr-chevron-right"></label></button>
	            </form>
    		</div>

	    </div>
	    
	    <footer>
             <h2>Relaciones de equivalencia 1.0</h2>
        </footer>

         <script src="../js/jquery.js"></script>
         <script src="../js/script.js"></script>
    </body>
</html>