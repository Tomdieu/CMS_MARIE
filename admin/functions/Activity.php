<?php

    class Activity extends Connection{

        public function create($nom,$image,$content,$id_marie){
            $sql = "INSERT INTO activity (nom,`image`,content,id_marie) VALUES ('$nom','$image','$content','$id_marie')";
            $result = mysqli_query($this->con,$sql);
            if($result){
                return 1;
            }
            return 10;
        }

        public function update($nom,$image,$content,$id){
            $sql = "UPDATE activity SET nom = '$nom',`image` = '$image',content ='$content' WHERE id = $id";
            $result = mysqli_query($this->con,$sql);
            if($result){
                return 1;
            }
            return 10;
        }

        public function delete($id){
            $sql = "DELETE FROM activity WHERE id = $id";
            $result = mysqli_query($this->con,$sql);
            if($result){
                return 1;
            }
            return 10;
        }

        public function findById($id){
            $sql = "SELECT * FROM activity WHERE id = $id";
            $result = mysqli_query($this->con,$sql);
            if(mysqli_num_rows($result)>0){
                return mysqli_fetch_assoc($result);
            }
            return [];
        }

        public function all(){
            $sql = "SELECT * FROM activity";
            $result = mysqli_query($this->con,$sql);
            if($result){
                return mysqli_fetch_all($result,MYSQLI_ASSOC);
            }
            return [];
        }

        public function count(){
            return count($this->all());
        }


    }