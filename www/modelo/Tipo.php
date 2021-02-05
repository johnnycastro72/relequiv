<?php
class Tipo
{
	private $idTipoEstimulo;
	private $Nombre;
    private $Conexion;
	
	public function setIdTipoEstimulo($idTipoEstimulo)
	{
		$this->idTipoEstimulo=$idTipoEstimulo;
	}
	
	public function getIdTipoEstimulo()
	{
		return ($this->idTipoEstimulo);
	}
	
	public function setNombre($Nombre)
	{
		$this->Nombre=$Nombre;
	}
	
	public function getNombre()
	{
		return ($this->Nombre);
	}
	
	public function Tipo()
	{
		//$Conexion = Conectarse();
	}
	
	public function crearTipo($idTipoEstimulo, $Nombre)
	{
		$this->idTipoEstimulo=$idTipoEstimulo;
		$this->Nombre=$Nombre;
	}
	
    public function checkTipo($Nombre)
    {
        $con = new conectar();
        $this->Conexion = $con->getConnection();
        $sql="select count(*) from ttipoestimulo where Nombre = ?";
        $resultado = $this->Conexion->prepare($sql);
		$resultado->execute([$Nombre]);
        $count = $resultado->fetchColumn();
		return $count;
    }
    
    public function agregarTipo()
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="insert into ttipoestimulo (Nombre) values ('$this->Nombre')";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
	public function editarTipo($idTipoEstimulo)
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="update ttipoestimulo set idTipoEstimulo='$this->idTipoEstimulo', Nombre='$this->Nombre'  where idTipoEstimulo='$idTipoEstimulo'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
	public function borrarTipo($idTipoEstimulo)
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="delete from ttipoestimulo where idTipoEstimulo='$idTipoEstimulo'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;
	}
	
	public function consultarTipos()
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select * from ttipoestimulo";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
	public function consultarTipo($idTipoEstimulo)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select * from ttipoestimulo where idTipoEstimulo='$idTipoEstimulo'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
}

?>