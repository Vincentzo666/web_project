<?php
class lms{
	
	public $dbConnect = false;
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "project";
	private $ciphering = "AES-128-CTR";
	private $options = 0;
	private $key_iv = '1234567891011121';
	private $key = 'KbPeShVmYq3t6w9z';
	
    
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
			die('Error in query: '. mysqli_error($this->dbConnect));
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

	public function pagination($table,$rows="*",$where = null,$page_rows=10){
		
		$countrow=$this->select($table,'COUNT(id)',$where);
		$last = ceil($countrow[0]['COUNT(id)']/$page_rows);
		
		if($last < 1){
			$last = 1;
		}
		
		$pagenum = 1;
	
		if(isset($_GET['pn'])){
			$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
		}
	
		if ($pagenum < 1) {
			$pagenum = 1;
		}
		else if ($pagenum > $last) {
			$pagenum = $last;
		}

		if(isset($_GET['sx'])){
			$_SESSION['sx']=str_replace("+"," ",$_GET['sx']);
		}
		// echo "<script>console.log('{$_SESSION['sx']}')</script>";

		$limit = ' LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
		$searchx = $where.' ORDER BY '.$_SESSION['sx'].$limit;
		$result = $this->select($table,$rows,$searchx);
	
		$paginationCtrls = '';
	
		if($last != 1){
			
			$paginationCtrls .= '<nav aria-label="Page navigation"><ul class="pagination">';
 
			if ($pagenum > 1) {
				$previous = $pagenum - 1;
				$paginationCtrls .= '<li class="page-item"><a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'" class="page-link">Previous</a></li>';
		 
				for($i = $pagenum-4; $i < $pagenum; $i++){
					if($i > 0){
						$paginationCtrls .= '<li class="page-item"><a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="page-link">'.$i.'</a></li>';
					}
				}
			}
		 
			$paginationCtrls .= '<li class="page-item"><a class="page-link active" aria-current="page">'.$pagenum.'</a></li>';
		 
			for($i = $pagenum+1; $i <= $last; $i++){
				$paginationCtrls .= '<li class="page-item"><a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="page-link">'.$i.'</a></li>';
				if($i >= $pagenum+4){
					break;
				}
			}
			if ($pagenum != $last) {
				$next = $pagenum + 1;
				$paginationCtrls .= '<li class="page-item"><a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'" class="page-link">Next</a></li>';
			}
			
			$paginationCtrls .='</ul></nav>';
		}
		
		return array($result,$paginationCtrls);
	}

	public function getRandomImage(){
		
		$dir_path = "image/bg_subject";
		$files = scandir($dir_path);
		$count = count($files);
		if($count > 2){
			$index = rand(2, ($count-1));
			$filename = $files[$index];
			return "image/bg_subject/".$filename;
			
		} else {
			
			$filename = $files[0];
			return "image/bg_subject/".$filename;
		}
	}

	public function encode($message){


		$encrypted = openssl_encrypt($message, $this->ciphering, $this->key, $this->options, $this->key_iv); 

		return $encrypted;
	}

	public function decode($message){
		
		$decrypted = openssl_decrypt ($message, $this->ciphering, $this->key, $this->options, $this->key_iv); 
	
		return $decrypted;
		
	}

	public function __destruct(){
		$this->dbConnect->close();
	}
}
?>