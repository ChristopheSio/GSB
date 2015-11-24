<div  id="contenu">
    <h2>Saisie du compte rendu</h2>

    <form action="index.php?uc=compte-rendu&action=valide" method="POST">

        <table class="table-no-border" border="0" width="100%">
            <tr>
                <td width="25%">NUMERO :</td>
                <td width="75%"><input type="text" name="VIS_NOM" ></td></tr>

            <tr>
                <td>DATE VISITE :</td>
                <td><input type="text" name="VIS_PRENOM" ></td>
            </tr>

            <tr><td>PRATICIEN :</td><td>
                    <select>
                        <?php foreach($lesPraticiens as $unPraticien){?>
                        <option value="praticiens"></option>
                        <?php } ?>
                    </select>
            <tr><td>COEFFICIENT :</td><td><input type="text" name="VIS_PRENOM" ></td></tr>

            <tr>
                <td>REMPLACANT </td>
                <td><input type="checkbox" name="remplacant" value="">

                </td>
            </tr>

            <tr><td>DATE :</td><td><input type="text" name="VIS_PRENOM" ></td></tr>

            <tr><td>MOTIF :</td><td><input type="text" name="VIS_PRENOM" ></td></tr>

            <tr><td>BILAN :</td><td><input type="text" name="VIS_PRENOM" ></td></tr>

        </table>
        <br>
        <br>

        <h2>Eléments présentés</h2>

        <table>
            <tr>
                <td>
                    PRODUIT 1 :
                </td>
                <td>
                    <select>
                        <option value=""></option>
                    </select>
                </td>
                <td>
            </tr>
            <tr>
                <td>
                    PRODUIT 2 :
                </td>
                <td>
                    <select>
                        <option value=""></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    DOCUMENTATION OFFERTE :
                </td>
                <td>
                    <input type="checkbox" name="documentation" value="">
                </td>
            </tr>
        </table>
        <br>
        <br>
        
        <h2>Echantillons</h2>
        <select>
            <option value="Produits" ></option>
        </select>
        <input type="text" name=" " >
        <input type="button" value="+">
        <br>
        <input type="checkbox" >
        
        <br>
        <br>
        <input type="submit" value="Envoyer" >

       
    </form>




</div>