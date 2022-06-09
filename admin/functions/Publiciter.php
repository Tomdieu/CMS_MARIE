<?php


    class Publiciter extends Connection{


        public function create($title,$content,$image,$id_marie){
            $sql = "INSERT INTO pubs (title,content,`image`,id_marie) VALUES ('$title','$content','$image',$id_marie)";
            $result = mysqli_query($this->con,$sql);
            if($result){
                return 1;
            }
            else{
                return 10;
            }
        }

        public function update($title,$content,$image,$id){
            $sql = "UPDATE pubs SET title='$title',content='$content',`image` = '$image' WHERE id =$id";
            $result = mysqli_query($this->con,$sql);
            if($result){
                return 1;
            }
            else{
                return 10;
            }
        }

        public function delete($id){
            $sql = "DELETE FROM pubs WHERE id =$id";
            $result = mysqli_query($this->con,$sql);
            if($result){
                return 1;
            }
            else{
                return 10;
            }
        }

        public function all(){
            $sql = "SELECT * FROM pubs";
            $result = mysqli_query($this->con,$sql);
            if(mysqli_num_rows($result)>0){
                return mysqli_fetch_all($result,MYSQLI_ASSOC);
            }
            return [];
        }

        public function count(){
            return count($this->all());
        }

        public function findById($id){
            $sql = "SELECT * FROM pubs WHERE id = $id";
            $result = mysqli_query($this->con,$sql);
            if(mysqli_num_rows($result)>0){
                return mysqli_fetch_assoc($result);
            }
            return [];
        }

        public function increase($id){
            $sql = "UPDATE pubs SET visitors = visitors+1 WHERE id = $id";
            $result = mysqli_query($this->con,$sql);
            if($result){
                return 1;
            }
            return 0;
        }
    }