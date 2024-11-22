<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    // Propiedades sin valores por defecto
    public string $fromEmail;
    public string $fromName;
    public string $protocol;
    public string $SMTPHost;
    public string $SMTPUser;
    public string $SMTPPass;
    public int $SMTPPort;
    public int $SMTPTimeout;
    public string $SMTPCrypto;

    // Otros parámetros de configuración
    public bool $wordWrap = true;
    public int $wrapChars = 76;
    public string $mailType = 'html';
    public string $charset = 'UTF-8';
    public bool $validate = true;
    public int $priority = 3;
    public string $CRLF = "\r\n";
    public string $newline = "\r\n";
    public bool $BCCBatchMode = false;
    public int $BCCBatchSize = 200;
    public bool $DSN = false;

    // Constructor para cargar las variables de entorno
    public function __construct()
    {
        // Inicializamos las variables con los valores de entorno
        $this->fromEmail = getenv('FROM_EMAIL');
        $this->fromName = getenv('FROM_NAME');
        $this->protocol = getenv('SMTP_PROTOCOL');
        $this->SMTPHost = getenv('SMTP_HOST');
        $this->SMTPUser = getenv('SMTP_USER');
        $this->SMTPPass = getenv('SMTP_PASS');
        $this->SMTPPort = (int) getenv('SMTP_PORT');
        $this->SMTPTimeout = (int) getenv('SMTP_TIMEOUT');
        $this->SMTPCrypto = getenv('SMTP_CRYPTO');
    }
}
