<?php
class Resultado
{
	private $idResultado;
	private $idAprendiz;
    private $idPregunta;
    private $Acierto;
    private $Tiempo;
    private $Intento;
    private $idPrueba;
    private $idModelo;
    private $idFase;
    private $Conexion;
	
	public function setIdResultado($idResultado)
	{
		$this->idResultado=$idResultado;
	}
	
	public function getIdResultado()
	{
		return ($this->idResultado);
	}
	
	public function setIdAprendiz($idAprendiz)
	{
		$this->idAprendiz=$idAprendiz;
	}
	
	public function getIdAprendiz()
	{
		return ($this->idAprendiz);
	}
	
	public function setIdPregunta($idPregunta)
	{
		$this->idPregunta=$idPregunta;
	}
	
	public function getIdPregunta()
	{
		return ($this->idPregunta);
	}
	
	public function setAcierto($Acierto)
	{
		$this->Acierto=$Acierto;
	}
	
	public function getAcierto()
	{
		return ($this->Acierto);
	}
	
	public function setTiempo($Tiempo)
	{
		$this->Tiempo=$Tiempo;
	}
	
	public function getTiempo()
	{
		return ($this->Tiempo);
	}
	
	public function setIntento($Intento)
	{
		$this->Intento=$Intento;
	}
	
	public function getIntento()
	{
		return ($this->Intento);
	}
	
	public function setidPrueba($idPrueba)
	{
		$this->idPrueba=$idPrueba;
	}
	
	public function getidPrueba()
	{
		return ($this->idPrueba);
	}

	public function setidModelo($idModelo)
	{
		$this->idModelo=$idModelo;
	}
	
	public function getidModelo()
	{
		return ($this->idModelo);
	}

	public function setidFase($idFase)
	{
		$this->idFase=$idFase;
	}
	
	public function getidFase()
	{
		return ($this->idFase);
	}

    public function Resultado()
	{
		//$Conexion = Conectarse();
	}
	
    public function crearResultado($idResultado, $idAprendiz, $idPregunta, $Acierto, $Tiempo, $Intento, $idPrueba, $idModelo, $idFase)
	{
		$this->idResultado=$idResultado;
		$this->idAprendiz=$idAprendiz;
		$this->idPregunta=$idPregunta;
		$this->Acierto=$Acierto;
		$this->Tiempo=$Tiempo;
		$this->Intento=$Intento;
		$this->idPrueba=$idPrueba;
		$this->idModelo=$idModelo;
		$this->idFase=$idFase;
	}
	
    public function contarResultados($idPrueba, $idModelo)
    {
        $con = new conectar();
        $this->Conexion = $con->getConnection();
        $sql="select count(distinct(idAprendiz)) from tresultado where idPrueba = ? and idModelo = ?";
        $resultado = $this->Conexion->prepare($sql);
		$resultado->execute([$idPrueba, $idModelo]);
        $count = $resultado->fetchColumn();
		return $count;
    }
    
    public function contarFase($idPrueba, $idFase, $idAprendiz)
    {
        $con = new conectar();
        $this->Conexion = $con->getConnection();
        $sql="select count(idResultado) from tresultado where idPrueba = ? and idFase = ? and idAprendiz = ?";
        $resultado = $this->Conexion->prepare($sql);
		$resultado->execute([$idPrueba, $idFase, $idAprendiz]);
        $count = $resultado->fetchColumn();
		return $count;
    }
    
    public function tiempoEvaluacion($idAprendiz, $idFase)
    {
        $con = new conectar();
        $this->Conexion = $con->getConnection();
        $sql="select sum(Tiempo) from tresultado where idFase = ? and idAprendiz = ?";
        $resultado = $this->Conexion->prepare($sql);
		$resultado->execute([$idFase, $idAprendiz]);
        $count = $resultado->fetchColumn();
		return $count;
    }
    
    public function aciertos($idAprendiz, $idFase)
    {
        $con = new conectar();
        $this->Conexion = $con->getConnection();
        $sql="select count(*) from tresultado where idFase = ? and idAprendiz = ? and Acierto=1";
        $resultado = $this->Conexion->prepare($sql);
		$resultado->execute([$idFase, $idAprendiz]);
        $count = $resultado->fetchColumn();
		return $count;
    }
    
    public function errores($idAprendiz, $idFase)
    {
        $con = new conectar();
        $this->Conexion = $con->getConnection();
        $sql="select count(*) from tresultado where idFase = ? and idAprendiz = ? and Acierto=0";
        $resultado = $this->Conexion->prepare($sql);
		$resultado->execute([$idFase, $idAprendiz]);
        $count = $resultado->fetchColumn();
		return $count;
    }
    
    public function acertoResultado($idPrueba, $idFase, $idAprendiz, $Preguntas)
    {
        $con = new conectar();
        $this->Conexion = $con->getConnection();
        $sql="SELECT COUNT(totals.Acierto) AS falla FROM tresultado, (SELECT * FROM tresultado WHERE idPrueba = '$idPrueba' AND idFase = '$idFase' AND idAprendiz = '$idAprendiz' ORDER BY idResultado DESC LIMIT $Preguntas) totals WHERE tresultado.idResultado = totals.idResultado AND totals.Acierto = 0";
        $resultado = $this->Conexion->query($sql);
        if ($resultado) {
            $count = $resultado->fetchColumn();
            if ($count > 0) {
                $acerto = 0;
            } else {
                $acerto = 1;
            }
        } else {
            $acerto = 0;
        }
        return $acerto;
    }
    
    public function agregarResultado()
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="insert into tresultado (idAprendiz, idPregunta, Acierto, Tiempo, Intento, idPrueba, idModelo, idFase) values ('$this->idAprendiz', '$this->idPregunta', '$this->Acierto', '$this->Tiempo', '$this->Intento', '$this->idPrueba', '$this->idModelo', '$this->idFase')";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}

    public function borrarResultados($idPrueba)
    {
        $con = new conectar();
        $this->Conexion = $con->getConnection();
        $sql="delete from tresultado where idPrueba=" . $idPrueba;
        $resultado = $this->Conexion->query($sql);
		return $resultado;
    }

    public function borrarResultado($idAprendiz)
    {
        $con = new conectar();
        $this->Conexion = $con->getConnection();
        $sql="delete from tresultado where idAprendiz=" . $idAprendiz;
        $resultado = $this->Conexion->query($sql);
		return $resultado;
    }

    public function consultaResultados($idAprendiz)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select * from tresultado where idAprendiz='$idAprendiz'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
    public function sumaTiempo($idAprendiz)
    {
        $con = new conectar();
        $this->Conexion = $con->getConnection();
        $sql="select sum(Tiempo) from tresultado where idAprendiz = ?";
        $resultado = $this->Conexion->prepare($sql);
		$resultado->execute([$idAprendiz]);
        $suma = $resultado->fetchColumn();
		return $suma;
    }
    
}

?>