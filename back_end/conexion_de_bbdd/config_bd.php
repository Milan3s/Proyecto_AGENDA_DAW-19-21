    <?php
    try {
        $usuario = 'root';
        $password = '';
        $nombrebd = 'aplicacion';

        $bd = new PDO('mysql:host=localhost;dbname=' . $nombrebd, $usuario, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    } catch (PDOException $config_bd) {
        die("Algo ha fallado en la conexión." . $config_bd->getMessage());
    }
    

    ?>
