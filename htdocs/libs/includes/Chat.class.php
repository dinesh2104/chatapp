<?php

Class Chat{
    private $conn;
    public function __construct()
    {
        $this->conn=Database::getConnection();
    }

    public function get_chat($outgoing_id,$incoming_id){
        if (isset($_SESSION['unique_id'])) {
            $output="";
            $sql="select * from message 
            left join users on users.unique_id=message.outgoing_id
            where ((outgoing_id={$outgoing_id} and incoming_id={$incoming_id})
            or (outgoing_id={$incoming_id} and incoming_id={$outgoing_id})) order by msg_id";
            $query=mysqli_query($this->conn, $sql);
            if (mysqli_num_rows($query)>0) {
                while ($row=mysqli_fetch_assoc($query)) {
                    if ($row['outgoing_id']===$outgoing_id) {
                        $output .='<div class="chat outgoing">
                        <div class="details">
                            <p>'.$row['msg'].'</p>
                        </div>
                    </div>';
                    } else {
                        $output .='<div class="chat incoming">
                            <img src="asset/image/'.$row['image'].'" alt="">
                            <div class="details">
                                <p>'.$row['msg'].'</p>
                            </div>
                        </div>';
                    }
                }
            }
            echo $output;
        } else {
            header("../login.php");
        }
    }

    public function insert_chat($outgoing_id,$incoming_id){
        if (isset($_SESSION['unique_id'])) {
            $message=mysqli_real_escape_string($this->conn, $_POST['message']);
        
            if (!empty($message)) {
                $sql=mysqli_query($this->conn, "Insert into message(outgoing_id,incoming_id,msg)
                values('{$outgoing_id}','{$incoming_id}','{$message}')") or die();
                echo("success");
            }
        } else {
            header("../login.php");
        }
        
    }
}