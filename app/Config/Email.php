<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    // Dirección de correo del remitente
    public string $fromEmail  = 'cebandohistorias@gmail.com'; // Cambia esto por tu correo electrónico de envío
    public string $fromName   = 'Cebando Historias'; // Nombre que aparecerá en el correo

    // SMTP Configuración
    public string $protocol = 'smtp'; // Usamos SMTP para enviar correos
    public string $SMTPHost = 'smtp.gmail.com'; // Dirección del servidor SMTP (por ejemplo, 'smtp.gmail.com')
    public string $SMTPUser = 'cebandohistorias@gmail.com'; // Tu correo electrónico
    public string $SMTPPass = 'abc12345*'; // La contraseña de tu correo (o una contraseña de aplicación, dependiendo del proveedor)
    public int $SMTPPort = 587; // Puerto para SMTP (587 es común para TLS, usa 465 para SSL)
    public int $SMTPTimeout = 5; // Timeout de la conexión

    // Encriptación SMTP (TLS o SSL)
    public string $SMTPCrypto = 'tls'; // Utiliza 'tls' o 'ssl', dependiendo del proveedor

    // Otros parámetros de configuración
    public bool $wordWrap = true; // Activar el ajuste de línea
    public int $wrapChars = 76; // Longitud máxima de línea
    public string $mailType = 'html'; // Si envías HTML en los correos
    public string $charset = 'UTF-8'; // Codificación de caracteres
    public bool $validate = true; // Validación de dirección de correo
    public int $priority = 3; // Prioridad del correo, 1 = alta, 5 = baja
    public string $CRLF = "\r\n"; // Salto de línea para la RFC 822
    public string $newline = "\r\n"; // Nuevo salto de línea
    public bool $BCCBatchMode = false; // Enviar múltiples correos en lotes
    public int $BCCBatchSize = 200; // Tamaño del lote
    public bool $DSN = false; // Si se requiere notificación de entrega
}


