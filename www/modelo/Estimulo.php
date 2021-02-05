<?php
class Estimulo
{
	private $idEstimulo;
	private $Palabra;
	private $Imagen;
    private $Kanji;
    private $Conexion;
	
	public function setIdEstimulo($idEstimulo)
	{
		$this->idEstimulo=$idEstimulo;
	}
	
	public function getIdEstimulo()
	{
		return ($this->idEstimulo);
	}
	
	public function setPalabra($Palabra)
	{
		$this->Palabra=$Palabra;
	}
	
	public function getPalabra()
	{
		return ($this->Palabra);
	}
	
	public function setImagen($Imagen)
	{
		$this->Imagen=$Imagen;
	}
	
	public function getImagen()
	{
		return ($this->Imagen);
	}
	
	public function setKanji($Kanji)
	{
		$this->Kanji=$Kanji;
	}
	
	public function getKanji()
	{
		return ($this->Kanji);
	}
	
	public function Estimulo()
	{
		//$Conexion = Conectarse();
	}
	
	public function crearEstimulo($idEstimulo, $Palabra, $Imagen, $Kanji)
	{
		$this->idEstimulo=$idEstimulo;
		$this->Palabra=$Palabra;
		$this->Imagen=$Imagen;
		$this->Kanji=$Kanji;
	}
	
    public function checkEstimulo($Palabra)
    {
        $con = new conectar();
        $this->Conexion = $con->getConnection();
        $sql="select count(*) from testimulo where Palabra = ?";
        $resultado = $this->Conexion->prepare($sql);
		$resultado->execute([$Palabra]);
        $count = $resultado->fetchColumn();
		return $count;
    }
    
    public function imagenEstimulo($Imagen)
    {
        $con = new conectar();
        $this->Conexion = $con->getConnection();
        $sql="select count(*) from testimulo where Imagen = ?";
        $resultado = $this->Conexion->prepare($sql);
		$resultado->execute([$Imagen]);
        $count = $resultado->fetchColumn();
		return $count;
    }

    public function kanjiEstimulo($Kanji)
    {
        $con = new conectar();
        $this->Conexion = $con->getConnection();
        $sql="select count(*) from testimulo where Kanji = ?";
        $resultado = $this->Conexion->prepare($sql);
		$resultado->execute([$Kanji]);
        $count = $resultado->fetchColumn();
		return $count;
    }

    public function agregarEstimulo()
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="insert into testimulo (Palabra, Imagen, Kanji) values ('$this->Palabra','$this->Imagen','$this->Kanji')";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
	public function editarEstimulo($idEstimulo)
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="update testimulo set idEstimulo='$this->idEstimulo', Palabra='$this->Palabra', Imagen='$this->Imagen', Kanji='$this->Kanji' where idEstimulo='$idEstimulo'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
	public function borrarEstimulo($idEstimulo)
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="delete from testimulo where idEstimulo='$idEstimulo'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;
	}
	
	public function consultarEstimulos()
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select * from testimulo";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
	public function consultarEstimulo($idEstimulo)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select * from testimulo where idEstimulo='$idEstimulo'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
    
	public function obtenerEstimulo($idEstimulo)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select * from testimulo  where idEstimulo<>'$idEstimulo' order by rand() limit 3";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
    
}

?>