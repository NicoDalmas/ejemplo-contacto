<?php

class Contacto 
{
    private $nombre = '';
    private $email = '';
    private $mensaje = '';

    private $errorTotal = 0; 
    private $errorInfo = array();    

    public function setNombre($valor)
	{
		$this->nombre = $valor;
	}
	public function getNombre()
	{
		return $this->nombre;
	}
    private function isNombre()
	{
        if (strlen($this->nombre) >= 1 && strlen($this->nombre) <= 100) {
            return true;
        }
        $this->setError('Nombre: campo requerido (hasta 100 caracteres).');        
        return false;
	}  

    public function setEmail($valor)
	{
		$this->email = $valor;
	}
	public function getEmail()
	{
		return $this->email;
	}
    private function isEmail()
	{
        if (strlen($this->email) >= 1 && strlen($this->email) <= 100) {
            return true;
        }
        $this->setError('E-mail: campo requerido (hasta 100 caracteres).');
        return false;
	}

    public function setMensaje($valor)
	{
		$this->mensaje = $valor;
	}
	public function getMensaje()
	{
		return $this->mensaje;
	}
    private function isMensaje()
	{
        if (strlen($this->mensaje) >= 1 && strlen($this->mensaje) <= 1000) {
            return true;
        }
        $this->setError('Mensaje: campo requerido (hasta 1000 caracteres).');
        return false;
    }

    public function isDatos()
	{
        $this->resetError();
        $this->isNombre();
        $this->isEmail();
        $this->isMensaje();
        if ($this->errorTotal === 0) {
            return true;
        }
        return false;
    }

    private function setError($valor)
    {
        $this->errorTotal++;
        $this->errorInfo[] = $valor;
    }
    private function resetError() 
    {
        $this->errorTotal = 0;
        $this->errorInfo = array();
    } 
    public function getError() 
    {
        return 'Errores: ' . $this->errorTotal . '. ' . implode(' - ', $this->errorInfo);
    }

}
