<?php

class Personnel extends Connection{

	public 	$id = null;
	public $nom = null;
	public $parcours = null;
	public $cv = null;
	public $id_marie = null;
	public $created = null;

	private function extract($arr){
		$per = new Personnel();
		$per->nom = $arr['nom'];
		$per->parcours = $arr['parcours']??'';
		$per->cv = $arr['cv'];
		$per->id_marie = $arr['id'];
		$per->created = $arr['created'];
		return $per;

	}


	public function all(){
		$sql = "SELECT * FROM personnel";
		$res = mysqli_query($this->con,$sql);
		if(mysqli_num_rows($res) > 0){
			while($data = mysqli_fetch_assoc($res)){
				$result[] = $data;
			}
			return $result;
		}
		return null;
	}

	public function create($nom,$parcour,$poste,$cv,$photo,$id_marie){
		$sql = "INSERT INTO personnel(nom,parcours,poste,cv,photo,id_marie) VALUES ('$nom','$parcour','$poste','$cv','$photo',$id_marie)";
		$res = mysqli_query($this->con,$sql);
		// var_dump(mysqli_error($this->con));
		if($res){
			return 1;
		}
		else{
			return 10;
		}
	}

	public function update($id,$nom,$parcours,$poste,$cv,$photo){
		$sql = "UPDATE personnel SET nom = '$nom', parcours = '$parcours',poste = '$poste', cv = '$cv',photo ='$photo' WHERE id =$id";
		$res = mysqli_query($this->con,$sql	);
		if($res){
			return 1;
		} 
		else{
			return 10;
		}
	}

	public function count(){
		$sql = "SELECT * FROM personnel";
		$result = mysqli_query($this->con,$sql);
		return mysqli_num_rows($result);
	}

	public function findById($id){
		$sql= "SELECT * FROM personnel WHERE id =$id";
		$result = mysqli_query($this->con,$sql);
		if(mysqli_num_rows($result)>0){
			return mysqli_fetch_assoc($result);
		}
		return [];
	}

	public function delete($id){
		$sql = "DELETE FROM personnel WHERE id = $id";
		$result = mysqli_query($this->con,$sql);
		if($result){
			return 1;
		}
		return 0;
	}
}