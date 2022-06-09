<?php

    class LieuxTouristique extends Connection{

        public function create($nom,$image,$description,$id_marie){
            $sql = "INSERT INTO lieu_touristic (nom,`image`,`description`,id_marie) VALUES ('$nom','$image','$description',$id_marie)";
            $result = mysqli_query($this->con,$sql);
            if($result){
                return 1;
            }
            return 0;
        }

        public function update($nom,$image,$description,$id){
            $sql = "UPDATE lieu_touristic SET nom = '$nom' ,`image` = '$image',`description` = '$description' WHERE id = $id";
            $result = mysqli_query($this->con,$sql);
            if($result){
                return 1;
            }
            return 0;
        }

        public function delete($id){
            $sql = "DELETE FROM lieu_touristic WHERE id=$id";
            $result = mysqli_query($this->con,$sql);
            if($result){
                return 1;
            }
            return 0;
        }

        public function all(){
            $sql = "SELECT * FROM lieu_touristic";
            $result = mysqli_query($this->con,$sql);
            if(mysqli_num_rows($result)>0){
                return mysqli_fetch_all($result,MYSQLI_ASSOC);
            }
            return [];
        }

        public function findByID($id){
            $sql = "SELECT * FROM lieu_touristic WHERE id=$id";
            $result = mysqli_query($this->con,$sql);
            if(mysqli_num_rows($result)>0){
                return mysqli_fetch_assoc($result);
            }
            return [];
        }

        public function count(){
            return count($this->all());
        }
    }