<?php


    class Projets extends Connection{

        public function create($nom,$image,$content,$id_marie){
            $sql ="INSERT INTO `projets` (`nom`, `image`, `content`, `id_marie`) VALUES  ('$nom','$image','$content','$id_marie')";
            $result = mysqli_query($this->con,$sql);
            if($result){
                return 1;
            }
            else{
                return 10;
            }
        }

        public function all(){
            $sql = "SELECT * FROM projets";
            $result = mysqli_query($this->con,$sql);
            if(mysqli_num_rows($result) > 0){
                return mysqli_fetch_all($result,MYSQLI_ASSOC);
            }
            return [];
        }

        public function update($id,$nom,$image,$content){
            $sql = "UPDATE projets SET nom = '$nom',`image` = '$image',content='$content' WHERE id = $id";
            $result = mysqli_query($this->con,$sql);
            if($result){
                return 1;
            }
            else{
                return 10;
            }
        }

        public function delete($id){
            $sql = "DELETE FROM projets WHERE id = $id";
            $result = mysqli_query($this->con,$sql);
            if($result){
                return 1;
            }
            else{
                return 10;
            }
        }

        public function count(){
            return count($this->all());
        }

        public function findById($id){
            $sql = "SELECT * FROM projets WHERE id = $id";
            $result = mysqli_query($this->con,$sql);
            if($result){
                return mysqli_fetch_assoc($result);
            }
            return [];
        }
    }