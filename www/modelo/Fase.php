<?php
class Fase
{
	private $idFase;
	private $Nombre;
    private $Evaluacion;
    private $Numero_Preguntas;
    private $Acertividad;
    private $idModelo;
    private $TiempoMuestra;
    private $TiempoEstimulo;
    private $TiempoEspera;
    private $Diccionario;
    private $Conexion;
	
	public function setIdFase($idFase)
	{
		$this->idFase=$idFase;
	}
	
	public function getIdFase()
	{
		return ($this->idFase);
	}
	
	public function setNombre($Nombre)
	{
		$this->Nombre=$Nombre;
	}
	
	public function getNombre()
	{
		return ($this->Nombre);
	}
	
	public function setEvaluacion($Evaluacion)
	{
		$this->Evaluacion=$Evaluacion;
	}
	
	public function getEvaluacion()
	{
		return ($this->Evaluacion);
	}
	
	public function setNumero_Preguntas($Numero_Preguntas)
	{
		$this->Numero_Preguntas=$Numero_Preguntas;
	}
	
	public function getNumero_Preguntas()
	{
		return ($this->Numero_Preguntas);
	}
	
	public function setAcertividad($Acertividad)
	{
		$this->Acertividad=$Acertividad;
	}
	
	public function getAcertividad()
	{
		return ($this->Acertividad);
	}
	
	public function setidModelo($idModelo)
	{
		$this->idModelo=$idModelo;
	}
	
	public function getidModelo()
	{
		return ($this->idModelo);
	}

	public function setTiempoMuestra($TiempoMuestra)
	{
		$this->TiempoMuestra=$TiempoMuestra;
	}
	
	public function getTiempoMuestra()
	{
		return ($this->TiempoMuestra);
	}
	
	public function setTiempoEstimulo($TiempoEstimulo)
	{
		$this->TiempoEstimulo=$TiempoEstimulo;
	}
	
	public function getTiempoEstimulo()
	{
		return ($this->TiempoEstimulo);
	}
	
	public function setTiempoEspera($TiempoEspera)
	{
		$this->TiempoEspera=$TiempoEspera;
	}
	
	public function getTiempoEspera()
	{
		return ($this->TiempoEspera);
	}
	
	public function setDiccionario($Diccionario)
	{
		$this->Diccionario=$Diccionario;
	}
	
	public function getDiccionario()
	{
		return ($this->Diccionario);
	}
	
    public function Fase()
	{
		//$Conexion = Conectarse();
	}
	
	public function crearFase($idFase, $Nombre, $Evaluacion, $Numero_Preguntas, $Acertividad, $idModelo, $TiempoMuestra, $TiempoEstimulo, $TiempoEspera, $Diccionario)
	{
		$this->idFase=$idFase;
		$this->Nombre=$Nombre;
		$this->Evaluacion=$Evaluacion;
		$this->Numero_Preguntas=$Numero_Preguntas;
		$this->Acertividad=$Acertividad;
		$this->idModelo=$idModelo;
		$this->TiempoMuestra=$TiempoMuestra;
		$this->TiempoEstimulo=$TiempoEstimulo;
		$this->TiempoEspera=$TiempoEspera;
		$this->Diccionario=$Diccionario;
	}
	
    public function checkFase($Nombre, $idModelo)
    {
        $con = new conectar();
        $this->Conexion = $con->getConnection();
        $sql="select count(*) from tfase where Nombre = ? and idModelo = ?";
        $resultado = $this->Conexion->prepare($sql);
		$resultado->execute([$Nombre, $idModelo]);
        $count = $resultado->fetchColumn();
		return $count;
    }
    
    public function agregarFase()
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="insert into tfase (Nombre, Evaluacion, Numero_Preguntas, Acertividad, idModelo, TiempoMuestra, TiempoEstimulo, TiempoEspera, Diccionario) values ('$this->Nombre', '$this->Evaluacion', '$this->Numero_Preguntas', '$this->Acertividad', '$this->idModelo', '$this->TiempoMuestra', '$this->TiempoEstimulo', '$this->TiempoEspera', '$this->Diccionario')";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
	public function editarFase($idFase)
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="update tfase set idFase='$this->idFase', Nombre='$this->Nombre', Evaluacion='$this->Evaluacion', Numero_Preguntas='$this->Numero_Preguntas', Acertividad='$this->Acertividad', idModelo='$this->idModelo', TiempoMuestra='$this->TiempoMuestra', TiempoEstimulo='$this->TiempoEstimulo', TiempoEspera='$this->TiempoEspera', Diccionario='$this->Diccionario'  where idFase='$idFase'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;
	}
	
	public function borrarFase($idFase)
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="delete from tfase where idFase='$idFase'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;
	}
	
	public function consultarFases($idModelo)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select * from tfase where idModelo='$idModelo'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
	public function consultarFase($idFase)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select * from tfase where idFase='$idFase'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}

    public function evaluacion($idModelo)
    {
        $con = new conectar();
        $this->Conexion = $con->getConnection();
        $sql="select idFase from tfase where idModelo = ? and Evaluacion = 1";
        $resultado = $this->Conexion->prepare($sql);
		$resultado->execute([$idModelo]);
        $id = $resultado->fetchColumn();
		return $id;
    }
}

?>