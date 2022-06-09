<?php

class Marie extends Connection{
	public 	$id=null;
	public $nom=null;
	public $id_region = null;
	public $id_departement=null;
	public $id_arrondissement = null;

	public function create($nom,$id_region,$id_departement,$id_arrondissement){
		$sql = "SELECT * FROM maries WHERE id_region = $id_region AND id_departement=$id_departement AND id_region=$id_region AND nom = '$nom' ";
		$duplicates = mysqli_query($this->con,$sql);
		if(mysqli_num_rows($duplicates)>0){
			return 1;
		}
		else{
			$sql = "INSERT INTO maries(nom,id_region,id_departement,id_arrondissement) VALUES ('$nom',$id_region,$id_departement,$id_arrondissement)";
		if(mysqli_query($this->con,$sql)){
			return 1;
		}
		return 100;
		}
		
	}

	public function getByName($name){
		$sql = "SELECT * FROM maries WHERE nom = '$name'";
		$result = mysqli_query($this->con,$sql);
		$data = mysqli_fetch_assoc($result);
		return $data;
	}

	public function update(){

	}

    public function getByID($id){
        $sql = "SELECT * FROM marie WHERE id = $id";
        $re = mysqli_query($this->con,$sql);
        if($re){
            return 1;
        }
        else{
            return 100;
        }
    }

	public function getInfo($id){
		$sql = "SELECT M.id,M.nom,R.nom as region,D.nom as departement,A.nom  as arrondissement FROM maries M,regions R,departements D,arrondissements A WHERE M.id = '$id' AND R.id=M.id_region AND M.id_departement = D.id AND M.id_arrondissement = A.id";
		
		$result = mysqli_query($this->con,$sql);
		// var_dump(mysqli_error($this->con),mysqli_num_rows($result));
		return mysqli_fetch_assoc($result);
	}
}
