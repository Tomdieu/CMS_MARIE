<?php


    class Histoire extends Connection {
        public $id = null;
        public $id_marie = null;
        public $content = null;
    
        public function create($id_marie,$content) {
            
            if($this->count() >0){
                return 100;
            }

            $sql = "INSERT INTO histoires (content,id_marie) VALUES ('$content',$id_marie)";
    
            $res = mysqli_query($this->con,$sql);
            if($res){
                return 1;
                // success
            }
            else{
                return 10;
                // error
            }
    
        }
        
        public function count(){
            $sql = "SELECT * FROM histoires";
            $result = mysqli_query($this->con,$sql);
            return mysqli_num_rows($result);
        }

        public function update($content,$id){
            $sql = "UPDATE histoires SET content = '$content' WHERE id=$id";
            $res = mysqli_query($this->con,$sql);
            if($res){
                return 1;
                // success
            }
            else{
                return 10;
                // error
            }
        }

        public function delete($id){
            $sql = "DELETE FROM histoires WHERE id = $id";
            $result = mysqli_query($this->con,$sql);
            if($result){
                return 1;
            }
            else{
                return 10;
            }
        }

        public function findById($id){
            $sql = "SELECT * FROM histoires WHERE id = $id";
            $result = mysqli_query($this->con,$sql);
            if(mysqli_num_rows($result)>0){
                return mysqli_fetch_all($result,MYSQLI_ASSOC);
            }
            return [];
        }

        public function getHistory($id_marie){
            $sql = "SELECT * FROM histoires WHERE id_marie = $id_marie";
            $result = mysqli_query($this->con,$sql);
            if($result){
                return mysqli_fetch_assoc($result);
            }
            return [];
        }
    }
    