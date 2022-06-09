<?php

    class Annonce extends Connection{


        public function create($nom,$type,$content,$image,$id_marie){
            $sql = "INSERT INTO `annonce`(`type`, `nom`, `content`, `image`, `id_marie`) VALUES  ('$type','$nom','$content','$image',$id_marie)";
            $result = mysqli_query($this->con,$sql);
            if($result){
                return 1;
            }
            return 10;
        }

        public function update($nom,$type,$content,$image,$id){
            $sql = "UPDATE annonce SET nom = '$nom',`type`='$type',content='$content',`image`='$image' WHERE id=$id";
            $result = mysqli_query($this->con,$sql);
            if($result){
                return 1;
            } 
            else{
                return 0;
            }
        }

        public function delete($id){
            $sql = "DELETE  FROM annonce WHERE id= $id";
            $result = mysqli_query($this->con,$sql);
            if($result){
                return 1;
            } 
            else{
                return 10;
            }
        }

        public function all(){
            $sql = "SELECT * FROM annonce";
            $result = mysqli_query($this->con,$sql);
            if($result){
                return mysqli_fetch_all($result,MYSQLI_ASSOC);
            } 
            else{
                return [];
            }
        }

        public function count(){
            return count($this->all());
        }

        public function findById($id){
            $sql = "SELECT * FROM annonce WHERE id= $id";
            $result = mysqli_query($this->con,$sql);
            if($result){
                return mysqli_fetch_assoc($result);
            } 
            else{
                return [];
            }
        }


    }