<?php
class Fallido
{
	private $idAprendiz;
	private $Cedula;
    private $Apellido1;
    private $Apellido2;
    private $Nombre1;
    private $Nombre2;
    private $FechaNacimiento;
    private $Sexo;
    private $idModelo;
    private $idPrueba;
    private $idCarrera;
    private $idSemestre;
    private $idNivel;
    private $FechaHora;
    private $Conexion;
	
	public function setIdAprendiz($idAprendiz)
	{
		$this->idAprendiz=$idAprendiz;
	}
	
	public function getIdAprendiz()
	{
		return ($this->idAprendiz);
	}
	
	public function setCedula($Cedula)
	{
		$this->Cedula=$Cedula;
	}
	
	public function getCedula()
	{
		return ($this->Cedula);
	}
	
	public function setApellido1($Apellido1)
	{
		$this->Apellido1=$Apellido1;
	}
	
	public function getApellido1()
	{
		return ($this->Apellido1);
	}
	
	public function setApellido2($Apellido2)
	{
		$this->Apellido2=$Apellido2;
	}
	
	public function getApellido2()
	{
		return ($this->Apellido2);
	}
	
	public function setNombre1($Nombre1)
	{
		$this->Nombre1=$Nombre1;
	}
	
	public function getNombre1()
	{
		return ($this->Nombre1);
	}
	
	public function setNombre2($Nombre2)
	{
		$this->Nombre2=$Nombre2;
	}
	
	public function getNombre2()
	{
		return ($this->Nombre2);
	}
	
	public function setFechaNacimiento($FechaNacimiento)
	{
		$this->FechaNacimiento=$FechaNacimiento;
	}
	
	public function getFechaNacimiento()
	{
		return ($this->FechaNacimiento);
	}
	
	public function setSexo($Sexo)
	{
		$this->Sexo=$Sexo;
	}
	
	public function getSexo()
	{
		return ($this->Sexo);
	}
	
	public function setidModelo($idModelo)
	{
		$this->idModelo=$idModelo;
	}
	
	public function getidModelo()
	{
		return ($this->idModelo);
	}

	public function setidPrueba($idPrueba)
	{
		$this->idPrueba=$idPrueba;
	}
	
	public function getidPrueba()
	{
		return ($this->idPrueba);
	}

	public function setidCarrera($idCarrera)
	{
		$this->idCarrera=$idCarrera;
	}
	
	public function getidCarrera()
	{
		return ($this->idCarrera);
	}

	public function setidSemestre($idSemestre)
	{
		$this->idSemestre=$idSemestre;
	}
	
	public function getidSemestre()
	{
		return ($this->idSemestre);
	}

	public function setidNivel($idNivel)
	{
		$this->idNivel=$idNivel;
	}
	
	public function getidNivel()
	{
		return ($this->idNivel);
	}

	public function setFechaHora($FechaHora)
	{
		$this->FechaHora=$FechaHora;
	}
	
	public function getFechaHora()
	{
		return ($this->FechaHora);
	}

    public function Fallido()
	{
		//$Conexion = Conectarse();
	}
	
    public function crearAprendiz($idAprendiz, $Cedula, $Apellido1, $Apellido2, $Nombre1, $Nombre2, $FechaNacimiento, $Sexo, $idModelo, $idPrueba, $idCarrera, $idSemestre, $idNivel, $FechaHora)
	{
		$this->idAprendiz=$idAprendiz;
		$this->Cedula=$Cedula;
		$this->Apellido1=$Apellido1;
		$this->Apellido2=$Apellido2;
		$this->Nombre1=$Nombre1;
		$this->Nombre2=$Nombre2;
		$this->FechaNacimiento=$FechaNacimiento;
		$this->Sexo=$Sexo;
		$this->idModelo=$idModelo;
		$this->idPrueba=$idPrueba;
		$this->idCarrera=$idCarrera;
		$this->idSemestre=$idSemestre;
		$this->idNivel=$idNivel;
        $this->FechaHora=$FechaHora;
	}
	
    public function agregarAprendiz()
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="insert into tfallido (Cedula, Apellido1, Apellido2, Nombre1, Nombre2, FechaNacimiento, Sexo, idModelo, idPrueba, idCarrera, idSemestre, idNivel, FechaHora) values ('$this->Cedula', '$this->Apellido1', '$this->Apellido2', '$this->Nombre1', '$this->Nombre2', '$this->FechaNacimiento', '$this->Sexo', '$this->idModelo', '$this->idPrueba', '$this->idCarrera', '$this->idSemestre', '$this->idNivel', '$this->FechaHora')";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
    
	public function consultarCedula($Cedula, $idPrueba)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select idAprendiz, Cedula, Apellido1, Apellido2, Nombre1, Nombre2, FechaNacimiento, Sexo, idModelo, idPrueba, idCarrera, idSemestre, idNivel, date_sub(FechaHora, interval 5 hour) as FechaHora from tfallido where Cedula='$Cedula' and idPrueba='$idPrueba'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}

    public function consultarAprendices($idPrueba)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select idAprendiz, Cedula, Apellido1, Apellido2, Nombre1, Nombre2, FechaNacimiento, Sexo, idModelo, idPrueba, idCarrera, idSemestre, idNivel, date_sub(FechaHora, interval 5 hour) as FechaHora from tfallido where idPrueba='$idPrueba' order by idModelo";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
    public function consultarAprendices2($idPrueba, $idModelo)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select idAprendiz, Cedula, Apellido1, Apellido2, Nombre1, Nombre2, FechaNacimiento, Sexo, idModelo, idPrueba, idCarrera, idSemestre, idNivel, date_sub(FechaHora, interval 5 hour) as FechaHora from tfallido where idPrueba='$idPrueba' and idModelo = '$idModelo'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
    public function consultarAprendices3()
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select idAprendiz, Cedula, Apellido1, Apellido2, Nombre1, Nombre2, FechaNacimiento, Sexo, idModelo, idPrueba, idCarrera, idSemestre, idNivel, date_sub(FechaHora, interval 5 hour) as FechaHora from tfallido";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
    public function consultarAprendiz($idAprendiz)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select idAprendiz, Cedula, Apellido1, Apellido2, Nombre1, Nombre2, FechaNacimiento, Sexo, idModelo, idPrueba, idCarrera, idSemestre, idNivel, date_sub(FechaHora, interval 5 hour) as FechaHora from tfallido where idAprendiz='$idAprendiz'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}

    public function demograficoEdad($idPrueba)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select ((year(now())-year(FechaNacimiento)) - if(month(now()) < month(FechaNacimiento), 1, 0)) as Edad, count(*) as Frecuencia from tfallido where idPrueba='$idPrueba' group by ((year(now())-year(FechaNacimiento)) - if(month(now()) < month(FechaNacimiento), 1, 0))";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}

    public function demograficoGenero($idPrueba)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select Sexo, count(*) as Frecuencia from tfallido where idPrueba='$idPrueba' group by Sexo";
		$resultado=$this->Conexion->query($sql);
		return $resultado;
	}

    public function demograficoNivel($idPrueba)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select idNivel, count(*) as Frecuencia from tfallido where idPrueba='$idPrueba' group by idNivel";
		$resultado=$this->Conexion->query($sql);
		return $resultado;
	}

    public function demograficoCarrera($idPrueba)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select idCarrera, count(*) as Frecuencia from tfallido where idPrueba='$idPrueba' group by idCarrera";
		$resultado=$this->Conexion->query($sql);
		return $resultado;
	}

    public function demograficoSemestre($idPrueba)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select idSemestre, count(*) as Frecuencia from tfallido where idPrueba='$idPrueba' group by idSemestre";
		$resultado=$this->Conexion->query($sql);
		return $resultado;
	}

    public function contarAprendiz($idPrueba)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
        $sql="select count(*) from tfallido where idPrueba = ?";
        $resultado = $this->Conexion->prepare($sql);
		$resultado->execute([$idPrueba]);
        $count = $resultado->fetchColumn();
		return $count;
	}

    public function demograficoEdad2($idPrueba, $idModelo)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select ((year(now())-year(FechaNacimiento)) - if(month(now()) < month(FechaNacimiento), 1, 0)) as Edad, count(*) as Frecuencia from tfallido where idPrueba='$idPrueba' and idModelo='$idModelo' group by ((year(now())-year(FechaNacimiento)) - if(month(now()) < month(FechaNacimiento), 1, 0))";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}

    public function demograficoGenero2($idPrueba, $idModelo)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select Sexo, count(*) as Frecuencia from tfallido where idPrueba='$idPrueba' and idModelo='$idModelo' group by Sexo";
		$resultado=$this->Conexion->query($sql);
		return $resultado;
	}

    public function demograficoNivel2($idPrueba, $idModelo)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select idNivel, count(*) as Frecuencia from tfallido where idPrueba='$idPrueba' and idModelo='$idModelo' group by idNivel";
		$resultado=$this->Conexion->query($sql);
		return $resultado;
	}

    public function demograficoCarrera2($idPrueba, $idModelo)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select idCarrera, count(*) as Frecuencia from tfallido where idPrueba='$idPrueba' and idModelo='$idModelo' group by idCarrera";
		$resultado=$this->Conexion->query($sql);
		return $resultado;
	}

    public function demograficoSemestre2($idPrueba, $idModelo)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select idSemestre, count(*) as Frecuencia from tfallido where idPrueba='$idPrueba' and idModelo='$idModelo' group by idSemestre";
		$resultado=$this->Conexion->query($sql);
		return $resultado;
	}

    public function contarAprendiz2($idPrueba, $idModelo)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
        $sql="select count(*) from tfallido where idPrueba = ? and idModelo = ?";
        $resultado = $this->Conexion->prepare($sql);
		$resultado->execute([$idPrueba, $idModelo]);
        $count = $resultado->fetchColumn();
		return $count;
	}
}

?>