<?php
namespace Controllers;


use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{
    public  static function index(Router $router){
        $propiedades = Propiedad::get(3);
        $inicio = true;
        $router->render('paginas/index',[
            'inicio'=>$inicio,
            'propiedades'=>$propiedades
        ]);
    }


    public static function nosotros(Router $router){
        $router->render('paginas/nosotros',[]);
    }
    public static function propiedades(Router $router){
        $propiedades = Propiedad::all();
        $router->render('paginas/propiedades',[
            'propiedades'=>$propiedades
        ]);
    }
    public static function propiedad(Router $router){
        $id=validarORedireccionar('/');
        $propiedad = Propiedad::find($id);
        $propiedad=$propiedad->atributos(true);
        $router->render('paginas/propiedad',[
            'propiedad'=>$propiedad
        ]);
    }
    public static function blog(Router $router){
        $router->render('paginas/blog',[]);
    }
    public static function entrada(Router $router){
        $router->render('paginas/entrada',[]);
    }
    public static function contacto(Router $router){
        $mensaje = null;
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $respuestas = $_POST;
            //*Crear una nueva instancia de PHPMailer
            $mail = new PHPMailer();
            $mail->isSMTP(); //?Configurar el SMTP que es el protocolo que se utliza para el envio de emails
            $mail->Host = $_ENV['MAIL_HOST'];
            $mail->SMTPAuth = true; //nos vamos a autenticar
            $mail->Port = $_ENV['MAIL_PORT'];
            $mail->Username = $_ENV['MAIL_USERNAME'];
            $mail->Password = $_ENV['MAIL_PASSWORD'];
            $mail->SMTPSecure = $_ENV['MAIL_SMTPSECURE'];//Manda los email por un tunel seguro

            //*Configurar el contenido del mail (parte superior)
            $mail->setFrom('admin@bienesraices.com'); //?Quien envia el email
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');//direccion de donde se va a recibir
            $mail->Subject='Tienes un Nuevo Mensaje';
            //*Habilitar html
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            //*Definir el contenido
            $contenido = "<html>";
            $contenido .= "<p>Tienes un nuevo Mensaje</p>";
            foreach($respuestas as $key=>$value){
                if(empty($value)||$value==null) continue;
                if($key=='presupuesto'){
                    $value = "\${$value}";
                    $key='presupuesto o Precio';
                }
                if($key=='opciones'){
                    $key='venta o Conmpra';
                }
                $label=ucfirst(str_replace('_',' ',$key));
                $contenido .= "<p>$label: $value</p>";
            }
            $contenido .= "</html>";

            $mail->Body = $contenido;
            $mail->AltBody='Esto es texto alternativo sin HTML';
            //Enviar el email
            if($mail->send()){
                $mensaje= 1;
            }else{
                $mensaje= 2;
            }
        }
        $router->render('paginas/contacto',[
            'mensaje'=>$mensaje
        ]);
    }

}