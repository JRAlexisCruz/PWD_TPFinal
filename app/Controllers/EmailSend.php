<?php

namespace App\Controllers;

class EmailSend extends BaseController{

    protected $fromEmail = 'cebandohistorias@gmail.com';
    protected $fromName = "Cebando Historias";

    public function sendPreparationEmail($userEmail)
    {
        // Crear una instancia del servicio de correo de CodeIgniter
        $email = \Config\Services::email();

        // Configurar los parámetros del correo usando la configuración de Email.php . PROBAR HARCODEAR
        $email->setFrom($this->fromEmail, $this->fromName);
        // Configurar los parámetros del correo usando la configuración de Email.php
        $email->setTo($userEmail);
        $email->setSubject('Compra en preparacion');
        $email->setMessage('¡Tu compra esta siendo preparada! . Pronto te avisaremos cuando tu compra este viajando a destino. ¡Gracias por confiar en nosotros!');

        $emailSent = false; // Variable para indicar si el correo fue enviado con éxito

        // Enviar el correo y manejar el resultado
        if ($email->send()) {
            $emailSent = true;
        } else {
            log_message('error', 'Error al enviar el correo: ' . $email->printDebugger());
        }

        return $emailSent; // Retorna el resultado al final de la función
    }

    public function sendSendingEmail($userEmail)
    {
        // Crear una instancia del servicio de correo de CodeIgniter
        $email = \Config\Services::email();

        // Configurar los parámetros del correo usando la configuración de Email.php . PROBAR HARCODEAR
        $email->setFrom($this->fromEmail, $this->fromName);
        // Configurar los parámetros del correo usando la configuración de Email.php
        $email->setTo($userEmail);
        $email->setSubject('Compra en Camino');
        $email->setMessage('¡Tu compra esta en camino hacia su destino!. ¡Gracias por confiar en nosotros!');

        $emailSent = false; // Variable para indicar si el correo fue enviado con éxito

        // Enviar el correo y manejar el resultado
        if ($email->send()) {
            $emailSent = true;
        } else {
            log_message('error', 'Error al enviar el correo: ' . $email->printDebugger());
        }

        return $emailSent; // Retorna el resultado al final de la función
    }

    public function sendReceivingEmail($userEmail)
    {
        // Crear una instancia del servicio de correo de CodeIgniter
        $email = \Config\Services::email();

        // Configurar los parámetros del correo usando la configuración de Email.php . PROBAR HARCODEAR
        $email->setFrom($this->fromEmail, $this->fromName);
        // Configurar los parámetros del correo usando la configuración de Email.php
        $email->setTo($userEmail);
        $email->setSubject('Compra Recibida');
        $email->setMessage('¡Tu compra fue recibida en su destino!. ¡Gracias por confiar en nosotros!');

        $emailSent = false; // Variable para indicar si el correo fue enviado con éxito

        // Enviar el correo y manejar el resultado
        if ($email->send()) {
            $emailSent = true;
        } else {
            log_message('error', 'Error al enviar el correo: ' . $email->printDebugger());
        }

        return $emailSent; // Retorna el resultado al final de la función
    }

    public function sendCancellationEmail($userEmail)
    {
        // Crear una instancia del servicio de correo de CodeIgniter
        $email = \Config\Services::email();

        // Configurar los parámetros del correo usando la configuración de Email.php . PROBAR HARCODEAR
        $email->setFrom($this->fromEmail, $this->fromName);
        // Configurar los parámetros del correo usando la configuración de Email.php
        $email->setTo($userEmail);
        $email->setSubject('Compra Cancelada');
        $email->setMessage('¡Tu compra fue cancelada por el adminisatrador!. Lo sentimos, no pudimos preparar su compra ¡Gracias por confiar en nosotros!');

        $emailSent = false; // Variable para indicar si el correo fue enviado con éxito

        // Enviar el correo y manejar el resultado
        if ($email->send()) {
            $emailSent = true;
        } else {
            log_message('error', 'Error al enviar el correo: ' . $email->printDebugger());
        }

        return $emailSent; // Retorna el resultado al final de la función
    }

    public function sendUserCancelEmail($userEmail)
    {
        // Crear una instancia del servicio de correo de CodeIgniter
        $email = \Config\Services::email();

        // Configurar los parámetros del correo usando la configuración de Email.php . PROBAR HARCODEAR
        $email->setFrom($this->fromEmail, $this->fromName);
        // Configurar los parámetros del correo usando la configuración de Email.php
        $email->setTo($userEmail);
        $email->setSubject('Compra Cancelada');
        $email->setMessage('¡Cancelaste tu compra!');

        $emailSent = false; // Variable para indicar si el correo fue enviado con éxito

        // Enviar el correo y manejar el resultado
        if ($email->send()) {
            $emailSent = true;
        } else {
            log_message('error', 'Error al enviar el correo: ' . $email->printDebugger());
        }

        return $emailSent; // Retorna el resultado al final de la función
    }
}