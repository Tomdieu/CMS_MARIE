<?php

    class Mission extends Connection{
        public $id_marie;
        public $content;
        public $created;

        public function create($id_marie,$content){
            $sql = "INSERT INTO missions VALUES ('$content',$id_marie)";
            $sql = "INSERT INTO `missions` (`content`, `id_marie`, `created`) VALUES ('$content', $id_marie, current_timestamp())";

            $result = mysqli_query($this->con,$sql,MYSQLI_STORE_RESULT);
            
            if($result){
                return 1;
            }
            return 100;
            
        }

        public function getAll($id){
            $sql = "SELECT * FROM missions WHERE id_marie = $id";
            $result = mysqli_query($this->con,$sql);
            if(mysqli_num_rows($result) > 0){
                $data = [];
                while($row = mysqli_fetch_assoc($result)){
                    $data[] = $row;
                }

                return $data;
            }
            return [];
        }

        public function update($id,$content){
            $sql = "UPDATE missions SET content = '$content' WHERE id = $id";
            $res = mysqli_query($this->con,$sql);

            if($res){
                return 1; //here 
            }
            return 100; // here it means the update has not tabke place successfully
        }

        public function findById($id){
            $sql = "SELECT * FROM missions WHERE id= $id";
            $result = mysqli_query($this->con,$sql);
            if(mysqli_num_rows($result)>0){
                $data = [];
                while($row = mysqli_fetch_assoc($result)){
                    $data[] = $row;
                }

                return $data;
            }
            return [];
        }

        public function delete($id){
            $sql = "DELETE FROM missions WHERE id = $id";
            $result = mysqli_query($this->con,$sql);
            if($result){
                return 1;
            }
            else{
                return 100;
            }
        }

        public function count(){
            $sql = 'SELECT * FROM missions';
            $resul = mysqli_query($this->con,$sql);
            return mysqli_num_rows($resul);
        }

    }