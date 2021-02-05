<?php
class Pregunta
{
	private $idPregunta;
	private $idFase;
    private $idTipoMuestra;
    private $idTipoEstimulo;
    private $idMuestra;
    private $Entrenamiento;
    private $FraseMuestra;
    private $FraseEstimulo;
    private $FraseFinal;
    private $Conexion;
	
	public function setIdPregunta($idPregunta)
	{
		$this->idPregunta=$idPregunta;
	}
	
	public function getIdPregunta()
	{
		return ($this->idPregunta);
	}
	
	public function setIdFase($idFase)
	{
		$this->idFase=$idFase;
	}
	
	public function getIdFase()
	{
		return ($this->idFase);
	}
	
	public function setidTipoMuestra($idTipoMuestra)
	{
		$this->idTipoMuestra=$idTipoMuestra;
	}
	
	public function getidTipoMuestra()
	{
		return ($this->idTipoMuestra);
	}
	
	public function setidTipoEstimulo($idTipoEstimulo)
	{
		$this->idTipoEstimulo=$idTipoEstimulo;
	}
	
	public function getidTipoEstimulo()
	{
		return ($this->idTipoEstimulo);
	}
	
	public function setidMuestra($idMuestra)
	{
		$this->idMuestra=$idMuestra;
	}
	
	public function getidMuestra()
	{
		return ($this->idMuestra);
	}
	
	public function setEntrenamiento($Entrenamiento)
	{
		$this->Entrenamiento=$Entrenamiento;
	}
	
	public function getEntrenamiento()
	{
		return ($this->Entrenamiento);
	}
	
	public function setFraseMuestra($FraseMuestra)
	{
		$this->FraseMuestra=$FraseMuestra;
	}
	
	public function getFraseMuestra()
	{
		return ($this->FraseMuestra);
	}
	
	public function setFraseEstimulo($FraseEstimulo)
	{
		$this->FraseEstimulo=$FraseEstimulo;
	}
	
	public function getFraseEstimulo()
	{
		return ($this->FraseEstimulo);
	}
	
	public function setFraseFinal($FraseFinal)
	{
		$this->FraseFinal=$FraseFinal;
	}
	
	public function getFraseFinal()
	{
		return ($this->FraseFinal);
	}
	
    public function Pregunta()
	{
		//$Conexion = Conectarse();
	}
	
	public function crearPregunta($idPregunta, $idFase, $idTipoMuestra, $idTipoEstimulo, $idMuestra, $Entrenamiento, $FraseMuestra, $FraseEstimulo, $FraseFinal)
	{
		$this->idPregunta=$idPregunta;
		$this->idFase=$idFase;
		$this->idTipoMuestra=$idTipoMuestra;
		$this->idTipoEstimulo=$idTipoEstimulo;
		$this->idMuestra=$idMuestra;
		$this->Entrenamiento=$Entrenamiento;
		$this->FraseMuestra=$FraseMuestra;
		$this->FraseEstimulo=$FraseEstimulo;
		$this->FraseFinal=$FraseFinal;
	}
	
    public function agregarPregunta()
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="insert into tpregunta (idFase, idTipoMuestra, idTipoEstimulo, idMuestra, Entrenamiento, FraseMuestra, FraseEstimulo, FraseFinal) values ('$this->idFase', '$this->idTipoMuestra', '$this->idTipoEstimulo', '$this->idMuestra', '$this->Entrenamiento', '$this->FraseMuestra', '$this->FraseEstimulo', '$this->FraseFinal')";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
	public function editarPregunta($idPregunta)
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="update tpregunta set idPregunta='$this->idPregunta', idFase='$this->idFase', idTipoMuestra='$this->idTipoMuestra', idTipoEstimulo='$this->idTipoEstimulo', idMuestra='$this->idMuestra', Entrenamiento='$this->Entrenamiento', FraseMuestra='$this->FraseMuestra', FraseEstimulo='$this->FraseEstimulo', FraseFinal='$this->FraseFinal'  where idPregunta='$idPregunta'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;
	}
	
	public function borrarPregunta($idPregunta)
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="delete from tpregunta where idPregunta='$idPregunta'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;
	}
	
	public function consultarPreguntas($idFase)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select * from tpregunta where idFase='$idFase'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
	public function consultarPregunta($idPregunta)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select * from tpregunta where idPregunta='$idPregunta'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
}

?>