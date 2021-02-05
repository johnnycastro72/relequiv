<?php
class Prueba
{
	private $idPrueba;
	private $Fecha;
	private $Ubicacion;
	private $Numero_Aprendiz;
	private $idUsuario;
    private $maximoAprendices;
    private $cantidadAprendices;
    private $Conexion;
	
	public function setidPrueba($idPrueba)
	{
		$this->idPrueba=$idPrueba;
	}
	
	public function getidPrueba()
	{
		return ($this->idPrueba);
	}
	
	public function setFecha($Fecha)
	{
		$this->Fecha=$Fecha;
	}
	
	public function getFecha()
	{
		return ($this->Fecha);
	}
	
	public function setUbicacion($Ubicacion)
	{
		$this->Ubicacion=$Ubicacion;
	}
	
	public function getUbicacion()
	{
		return ($this->Ubicacion);
	}
	
	public function setNumero_Aprendiz($Numero_Aprendiz)
	{
		$this->Numero_Aprendiz=$Numero_Aprendiz;
	}
	
	public function getNumero_Aprendiz()
	{
		return ($this->Numero_Aprendiz);
	}
	
	public function setidUsuario($idUsuario)
	{
		$this->idUsuario=$idUsuario;
	}
	
	public function getidUsuario()
	{
		return ($this->idUsuario);
	}
	
	public function setmaximoAprendices($maximoAprendices)
	{
		$this->maximoAprendices=$maximoAprendices;
	}
	
	public function getmaximoAprendices()
	{
		return ($this->maximoAprendices);
	}
	
	public function setcantidadAprendices($cantidadAprendices)
	{
		$this->cantidadAprendices=$cantidadAprendices;
	}
	
	public function getcantidadAprendices()
	{
		return ($this->cantidadAprendices);
	}
	
	public function Prueba()
	{
		//$Conexion = Conectarse();
	}
	
	public function crearPrueba($idPrueba, $Fecha, $Ubicacion, $Numero_Aprendiz, $idUsuario, $maximoAprendices, $cantidadAprendices)
	{
		$this->idPrueba=$idPrueba;
		$this->Fecha=$Fecha;
		$this->Ubicacion=$Ubicacion;
		$this->Numero_Aprendiz=$Numero_Aprendiz;
		$this->idUsuario=$idUsuario;
		$this->maximoAprendices=$maximoAprendices;
		$this->cantidadAprendices=$cantidadAprendices;
	}
	
    public function agregarPrueba()
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="insert into tprueba (Fecha, Ubicacion, Numero_Aprendiz, idusuario, maximoAprendices, cantidadAprendices) values ('$this->Fecha', '$this->Ubicacion', '$this->Numero_Aprendiz', '$this->idUsuario', '$this->maximoAprendices', '$this->cantidadAprendices')";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
	public function borrarPrueba($idPrueba)
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="delete from tprueba where idPrueba='$idPrueba'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;
	}
	
	public function consultarPruebas()
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select * from tprueba";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
	public function ultimaPrueba()
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select * from tprueba order by idPrueba desc limit 1";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
	public function consultarPrueba($idPrueba)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select * from tprueba where idPrueba='$idPrueba'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}

	public function agregarAprendiz($idPrueba)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="update tprueba set cantidadAprendices=IFNULL(cantidadAprendices,0)+1 where idPrueba='$idPrueba'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}

	public function restarAprendiz($idPrueba)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="update tprueba set cantidadAprendices=IFNULL(cantidadAprendices,0)-1 where idPrueba='$idPrueba'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}

}

?>