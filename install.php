<?php 

$content = json_decode(file_get_contents('admin/includes/conf.json'),true);
// var_dump($content['database']);
$created = $content['already_created'];
if($created === true){
    header('location: acceuil.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Install Nv Marie</title>
    <?php include 'icon.php' ?>
    <link href="admin/css/style.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            transition: all 0.4s;
        }

        body,
        html {
            padding: 0;
            margin: 0;
        }

        .container {
            width: 100%;
            height: 100vh;
            background-color: #ffffffb2;
            display: flex;
            justify-content: center;
            align-items: center;
            /* linear-gradient(from top,#272727cc,#1c1d1f) */
        }

        .form {
            padding: 20px;
            box-shadow: 0 0 3px 3px rgba(221, 221, 221, 0.781);
            transform: scale(1.02);
            /* color: #fff; */
            border-radius: 4px;
            display:none;
        }

        .form.active{
            display: block;
        }

        .input>* {
            display: block;
            margin-bottom: 5px;
            width: 100%;
        }

        .input input {
            padding: 8px;
            font-size: 1.2em;
            border: unset;
            outline-style: none;
            border-bottom: 2px solid rgba(44, 122, 224, 0.867);
            position: relative;
        }

        .input input::placeholder {
            /* color: rgba(247, 117, 229, 0.767);
             */
            color: rgb(5, 85, 190);
        }

        .input input:focus-within {
            border-radius: 3px;
            border-bottom: none;
            box-shadow: 0 0 0 3px rgba(44, 122, 224, 0.867);
        }

        .input.button {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }


        button {
            padding: 8px;
            border: unset;
            border-radius: 4px;
            background-color: rgba(23, 91, 180, 0.867);
            color: #fff;
            font-size: 1.2em;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            box-shadow: 0 0 0 3px #fff, 0 0 0 3px rgba(23, 91, 180, 0.867);
            /* background-color: rgb(255, 255, 255);
            color: rgba(23, 91, 180, 0.867); */
            font-weight: 800;
            cursor: pointer;
        }

        button:active {
            transform: scale(.98);
        }

        h1 {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        label {
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid transparent;
            border-top-color: rgb(7, 76, 155);
            position: absolute;
            border-radius: 50%;
            animation: rotate 1s ease-out infinite;
            cursor: wait;
            display: none;
        }

        .spinner.active{
            display: block;
        }

        @keyframes rotate {
            form {
                transform: rotate(0turn);
            }

            to {
                transform: rotate(1turn);
            }
        }

        .help-text {
            color: rgb(165, 169, 173);

        }

        @media screen and (max-width:600px) {
            .container {
                transform: scale(.8);
            }
        }

        .error {
            max-width: 400px;
            position: absolute;
            z-index: 99;
            padding: 10px;
            border-radius: 6px;
            background-color: rgb(153, 26, 26);
            color: #fff;
            font-size: 1.4em;
            box-shadow: 0 0 6px 0 rgba(153, 26, 26, .9), 0 0 0 1px #fff;
            /* display: none; */
            /* bottom: 3px;
            right: 4px; */
            /* left: 50%;
            top: 50%; */
            /* transform: translate(-50%,-50%); */
            animation: grow 2s linear;
            transition: all 1s;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            transform: scale(.8);
        }

        .error button {
            background-color: rgba(235, 41, 41, 0.911);
        }

        @keyframes grow {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .modal.active {
            display: block;
        }

        .modal {
            position: absolute;
            display: flex;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form active">
            <h1 align="center">Install Nv Marie</h1>
            <!-- <div class="input">
                <label>WebSite Name</label>
                <input type="text" id="dbname" autocomplete="off" placeholder="Enter The Database Name" />
                <span class='help-text'>This name represent the name of you website!</span>
            </div> -->
            <div class="input">
                <label>DataBase Name</label>
                <input type="text" id="dbname" autocomplete="off" placeholder="Enter The Database Name" />
                <span class='help-text'>If Left Empty the database name will be nvmarie!</span>
            </div>
            <div class="input">
                <label>Database User</label>
                <input type="text" id="dbuser" autocomplete="off" placeholder="Enter The Database user">
                <span class='help-text'>if left empty its value will be root</span>

            </div>
            <div class="input">
                <label>Database host</label>
                <input type="text" id="dbhost" autocomplete="off" placeholder="Enter The Database Host">
                <span class='help-text'>if left empty the host will be localhost</span>

            </div>
            <div class="input">
                <label>Database password</label>
                <input type="text" id="dbpsw" value="" autocomplete="off" placeholder="Enter The Database Password">
                <span class='help-text'>please only fill this input if your database requires a password!</span>

            </div>
            <div class="input">
                <label>Database Port</label>
                <input type="text" id="dbport" value="3306" autocomplete="off" placeholder="Enter The Database Password">
                <span class='help-text'>Default Value is 3306 Please don't modify if you need to do so</span>

            </div>
            <div class="input button">
                <button id="submit">Connect</button>
            </div>
        </div>
        <div class="form    ">
        <h3 align="center">Creer Un Site Web De Marie</h3>
            <form method="post" autocomplete="off">
                <div class="form-input">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" placeholder="nom du site web"/>
                    <span id="nom_invalid" class="invalid"></span>
                </div>
                <div class="form-input">
                    <label for="regions">Region</label>
                    <select name="regions" id="regions">
                    </select>
                </div>
                <div class="form-input">
                    <label for="departements">Departement</label>
                    <select name="departements" id="departements">
                    <!-- <option value="">Selectionner Le Departement</option> -->

                    </select>
                </div>
                <div class="form-input">
                    <label for="arrondissement">Arrondissement</label>
                    <select name="arrondissement" id="arrondissement">
                    <!-- <option>Selectionner L'arrondissement</option> -->
                    </select>
                </div>
                <div class="form-input">
                <button type="submit" id="submit_marie" name="submit">Creer</button>
                </div>
            </form>
            <div class="alert">
                
            </div>
        </div>
        <div class="modal">
            <div class="error">
                <p align="center">
                    Could Not Connect To The database with the information you had provided please provide the correct information!
                </p>
                <div>
                    <button id="close_error">Close</button>
                </div>
            </div>
        </div>
        <div class="spinner"></div>
    </div>

    <script>
        var spinner = document.querySelector('.spinner');
        var submit = document.querySelector('#submit');
        var dbname = document.querySelector('#dbname');
        var dbuser = document.querySelector('#dbuser');
        var dbhost = document.querySelector('#dbhost');
        var dbpsw = document.querySelector('#dbpsw');
        var dbport = document.querySelector('#dbport');
        var modal = document.querySelector('.modal');
        var close_error = document.querySelector('#close_error');

        var forms = document.querySelectorAll('.form');


        dbpsw.setAttribute('value', '');

        close_error.addEventListener('click', () => {
            modal.style.display = 'none';
        })

        submit.addEventListener('click', () => {
            if (dbname.value === '') {
                dbname.setAttribute('value', 'nvmarie');
            }
            
            if(dbuser.value.length === 0){
                dbuser.setAttribute('value', 'root')
            }
            if (dbhost.value.length === 0) {
                dbhost.setAttribute('value', 'localhost');
            }
            if (dbpsw.value.length === 0) {
                dbpsw.setAttribute('value', '');
            }
            if (dbport.value.length === 0) {
                alert('The database port is required')
                return;
            }
            spinner.classList.add('active')
            var formData = new FormData();

            formData.append('db_name', dbname.value);
            formData.append('db_user', dbuser.value);
            formData.append('db_psw', dbpsw.value);
            formData.append('db_host', dbhost.value);
            formData.append('db_port', parseInt(dbport.value));


            var xml = new XMLHttpRequest();
            // xml.responseType = 'json';
            xml.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                   
                    setTimeout(check,1500);
                    function check(){
                        try{
                        var res = JSON.parse(xml.responseText);
                        modal.classList.remove('active')
                        console.log(res);
                        forms[0].classList.remove('active');
                        forms[1].classList.add('active');

                    }catch(Exception){
                        modal.classList.add('active')
                        console.log(xml.responseText)

                    }

                    spinner.classList.remove('active')
                    }
                    // console.log(this.responseText);
                    // if (res['connected'] === true) {
                    //     modal.classList.remove('active')
                    // } else {
                    //     modal.classList.add('active')
                    // }
                }
            }
            var url = 'includes/test_connection.php';
            xml.open('POST', url, true);
            xml.send(formData);
        });
    </script>
   <script>
   var nom_input = document.getElementById('nom');

var region_input = document.getElementById('regions');

var departement_input = document.getElementById('departements');

var arrondissement_input = document.getElementById('arrondissement');


var submit = document.getElementById('submit_marie');

var spinner = document.querySelector('.spinner');


var alert = document.querySelector('.alert');

submit.onclick = function (e){
    e.preventDefault();
    let nom = nom_input.value;
    if(nom == ""){
        $('span').text('Name Require');
        return;
    }
    else{
        submit.setAttribute('disabled',true);
        spinner.classList.add('active');
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.responseType = "json";
        xmlhttp.onreadystatechange = function(){
            if(this.readyState==4 && this.status==200){
                var data = this.response;
                console.log(data);  
                spinner.classList.remove('active');

                    spinner.classList.add('active');

                    if(data['created']==true){
                        spinner.classList.remove('active');
    
                        // since it has created the marie successfully
                        // we are now going to save the information
                        console.log('validated');

                        window.location = 'admin/register.php';
                        // console.log(SendName(nom_input.value));
                        // window.location.replace('dashboard.php')
    
                    }
                
                
                else{
                    alert.innerHTML = '<h4 style="color:red;text-align:center">Could Not creat '+nom_input.value+' Please make sure you change the permission on /admin/includes/conf.json</h4>';
        // submit.setAttribute('disabled',false);
                    submit.removeAttribute('disabled');
        spinner.classList.remove('active');

                }
            }
        }
        let url = "admin/includes/data/create_marie.php";
        xmlhttp.open('POST',url,true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send("name="+nom_input.value+"&id_region="+region_input.value+"&id_departement="+departement_input.value+"&id_arrondissement="+arrondissement_input.value);
    }
}
var spn = document.getElementById('nom_invalid');
nom_input.onchange = ()=>{
    spn.style.display = 'none';
}


async function fetchData(table,column=null,id=null){
    if(table === 'regions'){
        const reponse = await fetch('admin/includes/data/fetch_data.php?table=regions');
        const region = await reponse.json();
        return region;
    }
    else{
        const reponse = await fetch(`amin/includes/data/fetch_data.php?table=${table}&column=${column}&id=${null}`);
        const data = await reponse.json();
        return data;
    }
}

window.onload = ()=>{
    let regions_data;
    

    fetchData('regions')
    .then(regions => {
        regions_data = regions;
        console.log(regions);
        let id = regions_data[0]['id'];
        
        regions_data.map(({id,nom})=>{
            let opt = document.createElement('option');
            opt.setAttribute('value',id);
            opt.innerText = nom;
            region_input.appendChild(opt);
        })

        fetchJsonData('departements','id_region',id,departement_input,fetchAdditionalData);
    });
}


function fetchJsonData(table,column,id,element,callback){
    let xml = new XMLHttpRequest();
    xml.responseType = "json";
    xml.onreadystatechange = function (){
       if(this.readyState==4 && this.status==200){
        console.log(xml.response);
        var data = xml.response;
        if(data)
        {
            var _id = data[0]['id'];
        }
        element.innerHTML = '';
        data?.map(({id,nom})=>{
            console.log(id,nom);
            let opt = document.createElement('option');
            opt.setAttribute('value',id);
            opt.innerText = nom;
            element.appendChild(opt);
        });
        if(callback!=null){
            callback(_id);
        }
       }
    }
    url =  `admin/includes/data/fetch_data.php?table=${table}&column=${column}&id=${id}`
    xml.open('GET',url,true);
    xml.send();
}

region_input.onchange = function (){
    region_id = parseInt(region_input.value);
    fetchJsonData('departements','id_region',region_id,departement_input,fetchAdditionalData);

}

departement_input.onchange = function(){
    id = parseInt(departement_input.value);
    fetchAdditionalData(id);
}


function fetchAdditionalData(id){
    fetchJsonData('arrondissements','id_departement',id,arrondissement_input)
}

   </script>
</body>

</html>