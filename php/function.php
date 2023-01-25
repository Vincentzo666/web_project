<?php
class lms{
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "project";
	public $dbConnect = false;
    
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }
		
	public function insert($table,$para=array()){
		
		$table_columns = implode(',', array_keys($para));
		$table_value = implode("','", $para);

		$sql="INSERT INTO $table($table_columns) VALUES('$table_value')";

		return $this->dbConnect->query($sql);
	}

	public function update($table,$para=array(),$id){
		
		$args = array();

		foreach ($para as $key => $value) {
			$args[] = "$key = '$value'"; 
		}

		$sql="UPDATE  $table SET " . implode(',', $args);

		$sql .=" WHERE $id";

		return $this->dbConnect->query($sql);
	}

	public function delete($table,$id){
		
		$sql="DELETE FROM $table";
		$sql .=" WHERE $id ";
		$sql;
		return $this->dbConnect->query($sql);
	}

	public function select($table,$rows="*",$where = null){
		
		if ($where != null) {
			$sql="SELECT $rows FROM $table WHERE $where";
		}else{
			$sql="SELECT $rows FROM $table";
		}
		$result = $this->dbConnect->query($sql);
		
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;

	}

	public function checkLoggedIn(){
		if(!$_SESSION['id_teacher']) {
			echo "<script>window.location.href='auth/login.php';</script>";
			exit;
		}
	}
	
	public function __destruct(){
		$this->dbConnect->close();
	}
}
?>