var nom_input = document.getElementById('nom');

var region_input = document.getElementById('regions');

var departement_input = document.getElementById('departements');

var arrondissement_input = document.getElementById('arrondissement');


var submit = document.getElementById('submit');

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
        // xmlhttp.responseType = "json";
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
                        console.log(SendName(nom_input.value));
                        window.location.replace('dashboard.php')
    
                    }
                
                
                else{
                    alert.innerHTML = '<h4 style="color:red;text-align:center">Could Not creat '+nom_input.value+' Please make sure you change the permission on /admin/includes/conf.json</h4>';
        // submit.setAttribute('disabled',false);
                    submit.removeAttribute('disabled');
        spinner.classList.remove('active');

                }
            }
        }
        let url = "./includes/data/create_marie.php";
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
        const reponse = await fetch('./includes/data/fetch_data.php?table=regions');
        const region = await reponse.json();
        return region;
    }
    else{
        const reponse = await fetch(`./includes/data/fetch_data.php?table=${table}&column=${column}&id=${null}`);
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
    url =  `./includes/data/fetch_data.php?table=${table}&column=${column}&id=${id}`
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
