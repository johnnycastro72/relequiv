<?php
class Nivel
{
	private $idNivel;
	private $Nombre;
    private $Conexion;
	
	public function setIdNivel($idNivel)
	{
		$this->idNivel=$idNivel;
	}
	
	public function getIdNivel()
	{
		return ($this->idNivel);
	}
	
	public function setNombre($Nombre)
	{
		$this->Nombre=$Nombre;
	}
	
	public function getNombre()
	{
		return ($this->Nombre);
	}
	
	public function Nivel()
	{
		//$Conexion = Conectarse();
	}
	
	public function crearNivel($idNivel, $Nombre)
	{
		$this->idNivel=$idNivel;
		$this->Nombre=$Nombre;
	}
	
    public function checkNivel($Nombre)
    {
        $con = new conectar();
        $this->Conexion = $con->getConnection();
        $sql="select count(*) from tnivel where Nombre = ?";
        $resultado = $this->Conexion->prepare($sql);
		$resultado->execute([$Nombre]);
        $count = $resultado->fetchColumn();
		return $count;
    }
    
    public function agregarNivel()
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="insert into tnivel (Nombre) values ('$this->Nombre')";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
	public function editarNivel($idNivel)
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="update tnivel set idNivel='$this->idNivel', Nombre='$this->Nombre'  where idNivel='$idNivel'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
	public function borrarNivel($idNivel)
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="delete from tnivel where idNivel='$idNivel'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;
	}
	
	public function consultarNiveles()
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select * from tnivel";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
	public function consultarNivel($idNivel)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select * from tnivel where idNivel='$idNivel'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
}

?>