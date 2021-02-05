<?php
class Modelo
{
	private $idModelo;
	private $Nombre;
    private $Numero_Aprendiz;
    private $Conexion;
	
	public function setIdModelo($idModelo)
	{
		$this->idModelo=$idModelo;
	}
	
	public function getIdModelo()
	{
		return ($this->idModelo);
	}
	
	public function setNombre($Nombre)
	{
		$this->Nombre=$Nombre;
	}
	
	public function getNombre()
	{
		return ($this->Nombre);
	}
	
	public function setNumero_Aprendiz($Numero_Aprendiz)
	{
		$this->Nombre=$Numero_Aprendiz;
	}
	
	public function getNumero_Aprendiz()
	{
		return ($this->Numero_Aprendiz);
	}
	
	public function Modelo()
	{
		//$Conexion = Conectarse();
	}
	
	public function crearModelo($idModelo, $Nombre, $Numero_Aprendiz)
	{
		$this->idModelo=$idModelo;
		$this->Nombre=$Nombre;
        $this->Numero_Aprendiz=$Numero_Aprendiz;
	}
	
    public function checkModelo($Nombre)
    {
        $con = new conectar();
        $this->Conexion = $con->getConnection();
        $sql="select count(*) from tmodelo where Nombre = ?";
        $resultado = $this->Conexion->prepare($sql);
		$resultado->execute([$Nombre]);
        $count = $resultado->fetchColumn();
		return $count;
    }
    
    public function random()
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select idModelo from tmodelo order by rand() limit 1";
		$resultado=$this->Conexion->query($sql);
		return $resultado;
	}
    
    public function agregarModelo()
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="insert into tmodelo (Nombre, Numero_Aprendiz) values ('$this->Nombre', 0)";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
	public function editarModelo($idModelo)
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="update tmodelo set idModelo='$this->idModelo', Nombre='$this->Nombre'  where idModelo='$idModelo'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;
	}
	
	public function borrarModelo($idModelo)
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="delete from tmodelo where idModelo='$idModelo'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;
	}
	
	public function consultarModelos()
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select * from tmodelo";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
	public function consultarModelo($idModelo)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select * from tmodelo where idModelo='$idModelo'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}

    public function agregarAprendiz($idModelo)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="update tmodelo set Numero_Aprendiz=IFNULL(Numero_Aprendiz,0)+1 where idModelo='$idModelo'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}

    public function restarAprendiz($idModelo)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="update tmodelo set Numero_Aprendiz=IFNULL(Numero_Aprendiz,0)-1 where idModelo='$idModelo'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
    
    public function contarModelos()
    {
        $con = new conectar();
        $this->Conexion = $con->getConnection();
        $sql="select count(*) from tmodelo";
        $resultado = $this->Conexion->prepare($sql);
		$resultado->execute();
        $count = $resultado->fetchColumn();
		return $count;
    }

}
?>