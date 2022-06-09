<div class="center">
    <div class="main">
        <div class="mw-500">
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
                <button type="submit" id="submit" name="submit">Creer</button>
                </div>
            </form>
            <div class="alert">
                
            </div>
            
        </div>
    </div>
</div>
<div class="spinner">

</div>
<script src="js/script.js"></script>
<script src="js/validate_marie.js"></script>