<?php
class Carrera
{
	private $idCarrera;
	private $Nombre;
    private $Conexion;
	
	public function setIdCarrera($idCarrera)
	{
		$this->idCarrera=$idCarrera;
	}
	
	public function getIdCarrera()
	{
		return ($this->idCarrera);
	}
	
	public function setNombre($Nombre)
	{
		$this->Nombre=$Nombre;
	}
	
	public function getNombre()
	{
		return ($this->Nombre);
	}
	
	public function Carrera()
	{
		//$Conexion = Conectarse();
	}
	
	public function crearCarrera($idCarrera, $Nombre)
	{
		$this->idCarrera=$idCarrera;
		$this->Nombre=$Nombre;
	}
	
    public function checkCarrera($Nombre)
    {
        $con = new conectar();
        $this->Conexion = $con->getConnection();
        $sql="select count(*) from tcarrera where Nombre = ?";
        $resultado = $this->Conexion->prepare($sql);
		$resultado->execute([$Nombre]);
        $count = $resultado->fetchColumn();
		return $count;
    }
    
    public function agregarCarrera()
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="insert into tcarrera (Nombre) values ('$this->Nombre')";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
	public function editarCarrera($idCarrera)
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="update tcarrera set idCarrera='$this->idCarrera', Nombre='$this->Nombre'  where idCarrera='$idCarrera'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;
	}
	
	public function borrarCarrera($idCarrera)
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="delete from tcarrera where idCarrera='$idCarrera'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;
	}
	
	public function consultarCarreras()
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select * from tcarrera";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
	public function consultarCarrera($idCarrera)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select * from tcarrera where idCarrera='$idCarrera'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
}

?>