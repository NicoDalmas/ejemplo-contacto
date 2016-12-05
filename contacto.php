<?php
try {

    header('Content-Type: text/html; charset=utf-8');
    $mensaje = '';
    $accion = isset($_GET['accion']) ? $_GET['accion'] : '';

    if ($accion === 'enviar') {

        require_once('app/modelos/contacto-class.php');
        $con = new Contacto();
        $con->setNombre(isset($_POST['txtnombre']) ? $_POST['txtnombre'] : '');
        $con->setEmail(isset($_POST['txtemail']) ? $_POST['txtemail'] : '');
        $con->setMensaje(isset($_POST['txtmensaje']) ? $_POST['txtmensaje'] : '');
        if ($con->isDatos() === false) {
            throw new Exception($con->getError());
        }         

        require_once('app/librerias/phpmailer/class.phpmailer.php');
        $mail = new PHPMailer(true);
        $mail->CharSet = 'utf-8';
        $mail->SetLanguage('es');
        $mail->Mailer = 'smtp';
        $mail->Host = 'ssl://smtp.gmail.com';
        $mail->Port = 465; 
        $mail->SMTPAuth = true;
        //$mail->Username = '...@gmail.com';            //Cuenta que envía: usuario
        //$mail->Password = '...';                      //Cuenta que envía: password
        $mail->From = $con->getEmail();
        $mail->FromName = $con->getNombre();
        $mail->AddReplyTo($con->getEmail(), $con->getNombre());
        //$mail->AddAddress('...@...', '...');          //Cuenta que recibe: usuario, nombre
        $mail->Subject = 'Mensaje desde sitio web';
        $mail->Body = 'Nombre: ' . $con->getNombre() . '<br>'
                    . 'E-mail: ' . $con->getEmail() . '<br>'
                    . 'Mensaje: ' . $con->getMensaje() . '<br>';
        $mail->AltBody = 'Nombre: ' . $con->getNombre() . "\r\n"
                       . 'E-mail: ' . $con->getEmail() . "\r\n"
                       . 'Mensaje: ' . $con->getMensaje() . "\r\n";
        //$mail->Send();

        header('Location: contacto-enviado.php'); exit;       

    } else {

        require_once('app/modelos/contacto-class.php');
        $con = new Contacto();
        $con->setNombre('');
        $con->setEmail('');
        $con->setMensaje('');

    }   

} catch (phpmailerException $e) {
    $mensaje = $e->getMessage();
} catch (Exception $e) {
    $mensaje = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es"> 
<head>
    <meta charset="utf-8">
    <title>Contacto</title>
    <link rel="stylesheet" href="css/estilos.css">
    <script src="js/contacto.js"></script>
</head>
<body>

    <?php if ($mensaje != '') { ?>
    <div id="mensaje"><?php echo $mensaje;?></div>
    <?php } ?>

    <h1>Contacto</h1>

    <form id="contacto" action="contacto.php?accion=enviar" method="post" class="contacto">	

        <p><label>Nombre * <input type="text" id="txtnombre" name="txtnombre" value="<?php echo $con->getNombre();?>" required maxlength="100"></label></p>

        <p><label>E-mail * <input type="email" id="txtemail" name="txtemail" value="<?php echo $con->getEmail();?>" required maxlength="100"></label></p>

        <p><label>Mensaje * <textarea id="txtmensaje" name="txtmensaje" required rows="5" cols="40" maxlength="1000"><?php echo $con->getMensaje();?></textarea></label></p>

        <p>* Campo requerido.</p>

        <p><input type="submit" name="btnenviar" value="Enviar"></p>
     
    </form>

</body>
</html>