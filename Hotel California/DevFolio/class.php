<?php


class USER
{
   private $db;
   private $host = "localhost";
   private $dbname = "hotelcalifornia";
   private $username = "root";
   private $password = "";
   private $charset = 'utf8mb4';

   const UP = 1;
   const DOWN = 2;

   public function __construct()
   {
       $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset";



       $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false, ];
       try
       {
           $this->db = new PDO($dsn, $this->username, $this->password, $options);
       }
       catch(\PDOException $e)
       {
           throw new \PDOException($e->getMessage() , (int)$e->getCode());
       }
   }
    
   
    private function getCurrentCount($paramid) {
        $stmt = $this->db->prepare("SELECT quantity FROM categories WHERE id = :id");
        $stmt->execute([":id" => $paramid]);
        $count = $stmt->fetch(PDO::FETCH_COLUMN);
        return $count;
    }
    
    
    public function createButtons($paramid) {
      
        $s = "<button type='submit' name='btnUP' value='$paramid'><i class='fa fa-plus'></i></button>"
            . "&nbsp;&nbsp;&nbsp"
            . "<button type='submit' name='btnDOWN' value='$paramid'><i class='fa fa-minus'></i></button>";
        
      return $s;
    }

    public function doUpdateCategoryCount($paramid, $incOrDec) {
   
      $current = $this->getCurrentCount($paramid); 

      if ( $current == 1 && $incOrDec == self::DOWN)
         return;
         
      if ( $current == 10 && $incOrDec == self::UP) {
         return;
      }

      $sql = "UPDATE categories SET quantity = quantity ";
      $sql .= ($incOrDec) == self::UP ? "+ 1" : "- 1 ";
      $sql .= " WHERE id = :id";

      $stmt = $this->db->prepare($sql);
      $stmt->execute([":id" => $paramid]);
    }

    public function getCategoryCount() {
    
      $stmt = $this->db->prepare('SELECT * FROM `categories`');
      $stmt->execute();
        
      $s = "<form id='frm' action='' method='post'>";
        
      $s .= "<table border='1' style='border-collapse:collapse' class='hoewilikdatmijntabeleruitziet' width='100%' cellspacing='5' cellpadding='5'>\n";
      $s .= "<tr><th>ID</th><th>Category</th><th width='15'>Amount</th><th>COMMAND</th></tr>\n";

      while($row = $stmt->fetch(PDO::FETCH_NUM)) {
         list($id, $cat, $prc, $cnt) = $row;
          $s .= "<tr><td>$id</td><td>$cat</td><td>$cnt</td><td>".$this->createButtons($id)."</td></tr>\n";
      }
      $s .= "</table></form>";

      return $s;
    }

    public function setCategoryQuantity($id, $quantity)
    {

      // haal de huidige waarde op SELECT quanity FROM categories WHERE (id = :id)
      // resultaat doe je + $quantity;
      // dan heb je nieuwe quantity
       try
       {
           $stmt = $this->db->prepare("UPDATE categories SET quantity = :quantity WHERE id = :id");
              
           $stmt->bindparam(":quantity", $quantity);
           $stmt->bindparam(":id", $id);         
           $stmt->execute(); 
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
 
    public function getFloorPlan() {
        // bouw een for-lus per verdieping (1 tot en met 4)
        // binnen die verdieping haal alle kamers die OP DIE verdieping zitten
        // output de gegevens van die kamers die je dan aantreft

        $sqlRooms = "SELECT id, room_number FROM rooms WHERE floor = :flr ORDER BY id";
        $stmt = $this->db->prepare($sqlRooms);

        for($f = 1; $f <= 4; $f++) {
            echo "<h1>THIS IS FLOOR $f</h1>";
            $stmt->execute([":flr" => $f]);
            while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                echo "<div class='room' style='border: solid 1px red; padding: 1cm; margin: 40px; float: left;'>";
                echo "<strong>ROOM NUMBER ". $row->room_number." ({$row->id})</strong>";
                echo "<br><br>";

                $this->getDetails($row->id);
                echo "</div>";
            }
            echo "<br style='clear:both'>";
        }
    }

    public function getRoomPricesOnCategory($param_catid = 999) { 
        $sql = "
            SELECT
                r.id roomid, c.id catid, 
                room_number,
                FLOOR,
                designation,
                base_price
            FROM
                `rooms` r
            LEFT JOIN categories c
                ON r.categories_id = c.id
";

        if($param_catid != 999) {
            $sql .= " WHERE c.id = :dezehebikzelfbedachtcatid";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([":dezehebikzelfbedachtcatid" => $param_catid]);
        } else {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
        }   

        $data = array();
        while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $data[] = $row;
        }

        //echo "<pre>", print_r($data, true), "</pre>";
        return $data;
    }


    


    private function getDetails($roomid) {
        $sqlRoom = "SELECT * FROM rooms WHERE room_number = :room_number";
        $stmt = $this->db->prepare($sqlRoom);

        $stmt->execute([":room_number" => $roomid]);

        $row = $stmt->fetch(PDO::FETCH_NUM);
        list($id, $room_price, $room_number, $floor, $category_id) = $row;
        echo "<hr>Hallo wereld, ik ben kamer $room_number of de $floor verdieping en ik kost $room_price<hr>";
    }

    public function register($fname,$lname,$uname,$umail,$upass)
    {
       try
       {
           $new_password = password_hash($upass, PASSWORD_DEFAULT);
   
           $stmt = $this->db->prepare("INSERT INTO users(user_name,user_email,user_pass) 
                                                       VALUES(:uname, :umail, :upass)");
              
           $stmt->bindparam(":uname", $uname);
           $stmt->bindparam(":umail", $umail);
           $stmt->bindparam(":upass", $new_password);            
           $stmt->execute(); 
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
 
    public function login($uname,$umail,$upass)
    {
       try
       {
          $stmt = $this->db->prepare("SELECT * FROM users WHERE user_name=:uname OR user_email=:umail LIMIT 1");
          $stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
             if(password_verify($upass, $userRow['user_pass']))
             {
                $_SESSION['user_session'] = $userRow['user_id'];
                return true;
             }
             else
             {
                return false;
             }
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
 
   public function is_loggedin()
   {
      if(isset($_SESSION['user_session']))
      {
         return true;
      }
   }
 
   public function redirect($url)
   {
       header("Location: $url");
   }
 
   public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
   }
}


?>
