<?php 
include_once 'Session.php';
include 'Databse.php';

class Student{

	public $db;

	function __construct(){
		$this->db = new Database();
	}

	function studentRegister($data){
		$name 		= $data['name'];
		$email 		= $data['email'];
		$pass1 		= $data['password'];
		$pass2 		= $data['repassword'];
		$chcek_mail = $this->checkemail($email);

		if (empty($name) || empty($email) || empty($pass1) || empty($pass2)) {
			return $msg = "<p class='alert alert-danger'><strong>Error ! </strong>Field must not be empty.</p>";
		}
		if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
			return $msg = "<p class='alert alert-danger'><strong>Error ! </strong>Invalid email address.</p>";
		}
		if ($pass1 != $pass2) {
			return $msg = "<p class='alert alert-danger'><strong>Error ! </strong>Password does not match.</p>";
		}
		if ($chcek_mail == true) {
			return $msg = "<p class='alert alert-danger'><strong>Error ! </strong>Email Address Already Exist.</p>";
		}
		if (strlen($pass1) < 5 || strlen($pass2) < 5) {
			return $msg = "<p class='alert alert-danger'><strong>Error ! </strong>Password must Least to 5 Character.</p>";
		}

		$password = md5($pass1);
		$repassword = md5($pass2);
		$sql = "INSERT INTO users(name, email, password, repassword) VALUES(:name, :email, :password, :repassword)";
		$data = $this->db->pdo->prepare($sql);
		$data->bindValue(':name', $name);
		$data->bindValue(':email', $email);
		$data->bindValue(':password', $password);
		$data->bindValue(':repassword', $repassword);
		if ($data->execute()) {
			return $msg = "<p class='alert alert-success mt-5'><strong>Success ! </strong>Student Data Successfully Inserted.</p>";
		}
	}

	function getstudentLogin($data){
		$email = $data['email'];
		$pass = $data['password'];
		$chcek_mail = $this->checkemail($email);

		if (empty($email) || empty($pass)) {
			return $msg = "<p class='alert alert-danger'><strong>Error ! </strong>Field must not be empty.</p>";
		}
		if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
			return $msg = "<p class='alert alert-danger'><strong>Error ! </strong>Invalid email address.</p>";
		}
		if (strlen($pass) < 5) {
			return $msg = "<p class='alert alert-danger'><strong>Error ! </strong>Password must Least to 5 Character.</p>";
		}
		if ($chcek_mail == false) {
			return $msg = "<p class='alert alert-danger'><strong>Error ! </strong>Email does not match.</p>";
		}

		$password = md5($pass);
		$result = $this->checkEmailPassword($email, $password);
		if ($result == true) {
			Session::init();
			Session::set('login', true);
			Session::set('id', $result['id']);
			Session::set('name', $result['name']);
			header('Location: index.php');
		}else{
			return $msg = "<p class='alert alert-danger'><strong>Error ! </strong>Email or Password is Rong.</p>";
		}
	}

	function checkemail($email){
		$sql = "SELECT email from users WHERE email=:email";
		$data = $this->db->pdo->prepare($sql);
		$data->bindValue(':email', $email);
		$data->execute();
		if ($data->rowCount() > 0) {
			return true;
		} else{
			return false;
		}
	}

	function checkEmailPassword($email, $password){
		$sql = "SELECT * FROM users WHERE email=:email AND password=:password LIMIT 1";
		$data = $this->db->pdo->prepare($sql);
		$data->bindValue(':email', $email);
		$data->bindValue(':password', $password);
		$data->execute();
		return $data->fetch();
	}

	function getStudentById($id){
		$sql = "SELECT * FROM users WHERE id=:id LIMIT 1";
		$data = $this->db->pdo->prepare($sql);
		$data->bindValue(':id', $id);
		$data->execute();
		return $data->fetch();
	}

	function updateUserById($id, $data){
		$name = $data['name'];
		$email = $data['email'];

		if (empty($name) || empty($email)) {
			return $msg = "<p class='alert alert-danger'><strong>Error ! </strong>Field must not be empty.</p>";
		}
		if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
			return $msg = "<p class='alert alert-danger'><strong>Error ! </strong>Invalid email address.</p>";
		}

		$sql = "UPDATE users SET name=:name, email=:email WHERE id=:id";
		$data = $this->db->pdo->prepare($sql);
		$data->bindValue(':name', $name);
		$data->bindValue(':email', $email);
		$data->bindValue(':id', $id);
		if ($data->execute()) {
			return $msg = "<p class='alert alert-success'><strong>Success ! </strong>Student Data Successfully Updated.</p>";
			header('Location: view-profile.php?profile_view=view');
		}
	}

	function checkpass($pass){
		$sql = "SELECT password from users WHERE password=:password";
		$data = $this->db->pdo->prepare($sql);
		$data->bindValue(':password', $pass);
		$data->execute();
		if ($data->rowCount() > 0) {
			return true;
		} else{
			return false;
		}
	}

	function changePassword($id, $data){
		$oldpass 	 = $data['oldpass'];
		$newpass 	 = $data['newpass'];
		$confirmpass = $data['confirmpass'];

		if (empty($oldpass) || empty($newpass) || empty($confirmpass)) {
			return $msg = "<p class='alert alert-danger'><strong>Error ! </strong>Field must not be empty.</p>";
		}
		if (strlen($newpass) < 5 || strlen($confirmpass) < 5) {
			return $msg = "<p class='alert alert-danger'><strong>Error ! </strong>Password must Least to 5 Character.</p>";
		}
		if ($newpass != $confirmpass) {
			return $msg = "<p class='alert alert-danger'><strong>Error ! </strong>New and Confirm password does not match.</p>";
		}

		$passold = md5($oldpass);
		$passnew = md5($newpass);
		$passconfirm = md5($confirmpass);
		$check_pass = $this->checkpass($passold);

		if ($check_pass == false) {
			return $msg = "<p class='alert alert-danger'><strong>Error ! </strong>Old Password does not match.</p>";
		}
		if ($check_pass == true){
			$sql = "UPDATE users SET password=:pass1, repassword=:pass2 WHERE id=:id";
			$data = $this->db->pdo->prepare($sql);
			$data->bindValue(':pass1', $passnew);
			$data->bindValue(':pass2', $passconfirm);
			$data->bindValue(':id', $id);
			if ($data->execute()) {
				return $msg = "<p class='alert alert-success'><strong>Success ! </strong>Password Successfully Changed.</p>";
			}
		} 
	}

}

?>