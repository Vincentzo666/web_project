<?php
class lms{
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "project";   
	private $teacherTable = 'teacher';	
    private $subjectTable = 'subject';
	private $studentTable = 'student';
    private $sub_stdTable = 'sub_std';
	private $dbConnect = false;
    
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
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	public function loginUsers($email, $password){
		$sqlQuery = "
			SELECT id, email, first_name, last_name, address, mobile 
			FROM ".$this->invoiceUserTable." 
			WHERE email='".$email."' AND password='".$password."'";
        return  $this->getData($sqlQuery);
	}	
	public function checkLoggedIn(){
		if(!$_SESSION['userid']) {
			header("Location:index.php");
		}
	}		
	public function RegisterTeacher($email,$password){
		date_default_timezone_set('Asia/Bangkok');
		$date = date("Y-m-d H:i:s");
		$c_email = mysqli_real_escape_string($this->dbConnect, $email);
		$c_password = mysqli_real_escape_string($this->dbConnect, $password);
		$sqlInsert = "INSERT INTO $this->teacherTable (email, password, cr_time)
					VALUES ('$c_email', '$c_password', '$date')";		
		return mysqli_query($this->dbConnect, $sqlInsert);
	}	
}
?>