<?php
class Semestre
{
	private $idSemestre;
	private $Nombre;
    private $Conexion;
	
	public function setIdSemestre($idSemestre)
	{
		$this->idSemestre=$idSemestre;
	}
	
	public function getIdSemestre()
	{
		return ($this->idSemestre);
	}
	
	public function setNombre($Nombre)
	{
		$this->Nombre=$Nombre;
	}
	
	public function getNombre()
	{
		return ($this->Nombre);
	}
	
	public function Semestre()
	{
		//$Conexion = Conectarse();
	}
	
	public function crearSemestre($idSemestre, $Nombre)
	{
		$this->idSemestre=$idSemestre;
		$this->Nombre=$Nombre;
	}
	
    public function checkSemestre($Nombre)
    {
        $con = new conectar();
        $this->Conexion = $con->getConnection();
        $sql="select count(*) from tsemestre where Nombre = ?";
        $resultado = $this->Conexion->prepare($sql);
		$resultado->execute([$Nombre]);
        $count = $resultado->fetchColumn();
		return $count;
    }
    
    public function agregarSemestre()
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="insert into tsemestre (Nombre) values ('$this->Nombre')";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
	public function editarSemestre($idSemestre)
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="update tsemestre set idSemestre='$this->idSemestre', Nombre='$this->Nombre'  where idSemestre='$idSemestre'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;
	}
	
	public function borrarSemestre($idSemestre)
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="delete from tsemestre where idSemestre='$idSemestre'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;
	}
	
	public function consultarSemestres()
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select * from tsemestre order by CAST(Nombre as unsigned)";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
	public function consultarSemestre($idSemestre)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select * from tsemestre where idSemestre='$idSemestre'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
}

?>