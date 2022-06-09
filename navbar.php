
<div class="navbar">
    <div class="navbar_head">
       <div style="display: flex;justify-content:center;align-items:center;font-size:1.4em">
       <img height="42" width="42" src="./favicon.ico"/>
        <b><a href="acceuil.php" > <?php echo $site_name ?? '';?></a></b>
        
       </div>
       <button class='toog'>&capand;</button>
    </div>
    <div class="menu">
        <ul>
            <li><a href="acceuil.php">Presentation</a></li>
            <li><a href="projet.php">Projet</a></li>
            <li><a href="activiter.php">Activite</a></li>
            <li><a href="annonce.php">Annonce</a></li>
            <li><a href="site_touristique.php">Site Touristique</a></li>
            <li><a href="publiciter.php">Pubs</a></li>
        </ul>
    </div>
</div>

<script>
    var toog = document.querySelector('.toog');
    var menu = document.querySelector('.menu');

    toog.addEventListener('click',()=>{
        toogle();
    })

    function toogle(){
        if(menu.style.display === 'none'){
            menu.style.display = 'block';
            menu.classList.add('zoom')
            // menu.style.height = 'fit-content';

        }
        else{
            // menu.style.height = '0px';

        menu.style.display = 'none';

        }
    }
</script>