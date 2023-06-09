<?php
require_once('Database.php');
class UserManager
{
   private Database $db;
   public function __construct($db)
   {
      $this->db = $db;
   }
   public function userExists($email)
   {
      $sql = 'SELECT * FROM `users` WHERE email = ?';
      return $this->db->queryHas($sql, ["$email"]);
   }

   public function verify($email, $pwd) {
      $sql = 'SELECT * FROM `users` WHERE email = ? AND pwd = ?';
      $hashedPwd = hash('sha256', $pwd);
      if($this->db->queryHas($sql, ["$email", "$hashedPwd"])) {
         return true;
      }
      return false;
   }

   public function registerUser($email, $pwd, $realName)
   {
      $sql = 'INSERT INTO users(email, pwd, name, pfp) VALUES (?, ?, ?, ?);';
      $hashedPwd = hash('sha256', $pwd);
      if ($this->db->query($sql, ["$email", "$hashedPwd", "$realName", "default.png"]))
         return true;
      return false;
   }

   public function getField($uid, $fieldName)
   {
      $sql = 'SELECT * FROM `users` where uid = ?';
      $result = $this->db->queryResult($sql, ["$uid"]);
      if ($result !== false)
         return $result[0]["$fieldName"];
      return "NO-DATA";
   }

   public function getUid($email) {
      $sql = 'SELECT * from `users` where email = ?';
      $result = $this->db->queryResult($sql, ["$email"]);
      if ($result !== false)
         return $result[0]['uid'];
      return "-1";
   }

   public function validEmail($email)
   {
      $regex = "/[a-zA-Z0-9_\-.+]+@[a-zA-Z0-9\-]+.[a-zA-Z]+/";
      if (preg_match($regex, $email) === 1) {
         return true;
      } else {
         return false;
      }
   }
   public function validPassword($pwd)
   {
      if (strlen($pwd) < 3 || strlen($pwd) >= 255) {
         return false;
      }
      return true;
   }

   public function matchPassword($pwd, $cpwd)
   {
      if (strcmp($pwd, $cpwd) === 0)
         return true;
      return false;
   }

   public function validName($name) {
      if(strlen($name) > 255) {
         return false;
      }
      return true;
   }

   public function validDob($dob)
   {
      $regex = "/[0-9]{4}-((0[0-9])|(1[1-2]))-(([0-2][0-9])|(3[0-1]))/";
      if (preg_match($regex, $dob) === 1) {
         return true;
      } else {
         return false;
      }
   }

   public function getUsers() {
      $sql = "SELECT name, email, dob, pfp FROM users";
      return $this->db->queryResult($sql, array());
   }

   public function updateEmail($uid, $email) {
      $sql = "UPDATE users SET email = ? WHERE uid = ?";
      return $this->db->query($sql, ["$email", "$uid"]);
   }

   public function updatePassword($uid, $pwd) {
      $sql = "UPDATE users SET pwd = ? WHERE uid = ?";
      return $this->db->query($sql, ["$pwd", "$uid"]);
   }

   public function updateName($uid, $name) {
      $sql = "UPDATE users SET name = ? WHERE uid = ?";
      return $this->db->query($sql, ["$name", "$uid"]);
   }

   public function updateDob($uid, $dob) {
      $sql = "UPDATE users SET dob = ? WHERE uid = ?";
      return $this->db->query($sql, ["$dob", "$uid"]);
   }

   public function setPfp($uid, $path) {
      $sql = "UPDATE users SET pfp = ? WHERE uid = ?";
      return $this->db->query($sql, ["$path", "$uid"]);
   }
}

$umgr = new UserManager($database);

?>