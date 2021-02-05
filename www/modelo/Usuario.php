<?php
class User
{
	private $idUsuario;
	private $Nombre;
	private $clave;
    private $Nivel;
    private $Conexion;
	
	public function setIdUsuario($idUsuario)
	{
		$this->idUsuario=$idUsuario;
	}
	
	public function getIdUsuario()
	{
		return ($this->idUsuario);
	}
	
	public function setNombre($Nombre)
	{
		$this->Nombre=$Nombre;
	}
	
	public function getNombre()
	{
		return ($this->Nombre);
	}
	
	public function setclave($clave)
	{
		$this->clave=$clave;
	}
	
	public function getclave()
	{
		return ($this->clave);
	}
	
	public function setNivel($Nivel)
	{
		$this->Nivel=$Nivel;
	}
	
	public function getNivel()
	{
		return ($this->Nivel);
	}
	
	public function User()
	{
		//$Conexion = Conectarse();
	}
	
	public function crearUser($idUsuario, $Nombre, $clave, $Nivel)
	{
		$this->idUsuario=$idUsuario;
		$this->Nombre=$Nombre;
		$this->clave=$clave;
		$this->Nivel=$Nivel;
	}
	
    public function checkUser($Nombre)
    {
        $con = new conectar();
        $this->Conexion = $con->getConnection();
        $sql="select count(*) from tusuario where Nombre = ?";
        $resultado = $this->Conexion->prepare($sql);
		$resultado->execute([$Nombre]);
        $count = $resultado->fetchColumn();
		return $count;
    }
    
    public function getActualUser($Nombre)
    {
        $con = new conectar();
        $this->Conexion = $con->getConnection();
        $sql="select idUsuario from tusuario where Nombre = ?";
        $resultado = $this->Conexion->prepare($sql);
		$resultado->execute([$Nombre]);
        $count = $resultado->fetchColumn();
		return $count;
    }
    
    public function agregarUser()
	{	
        $this->clave = hash('sha512', $this->clave);
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="insert into tusuario (Nombre, clave, Nivel) values ('$this->Nombre','$this->clave','$this->Nivel')";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
	public function editarUser($idUsuario)
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="update tusuario set idUsuario='$this->idUsuario', Nombre='$this->Nombre', clave='$this->clave', Nivel='$this->Nivel' where idUsuario='$idUsuario'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
	public function borrarUser($idUsuario)
	{	
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="delete from tusuario where idUsuario='$idUsuario'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;
	}
	
	public function consultarUsers()
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select * from tusuario";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
	
	public function consultarUser($idUsuario)
	{
        $con = new conectar();
        $this->Conexion = $con->getConnection();
		$sql="select * from tusuario where idUsuario='$idUsuario'";
		$resultado=$this->Conexion->query($sql);
		return $resultado;	
	}
}

?>