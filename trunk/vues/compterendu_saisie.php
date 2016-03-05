<div  id="contenu">
    <?php if (count($errors)>0) { ?>
        <ul>
            <?php foreach ($errors as $error) { ?>
                <li><?php echo $error; ?></li>
            <?php } ?>
        </ul>    
    <?php } ?>

    <h2>Saisie du compte rendu</h2>

    <form action="index.php?uc=compte-rendu&action=valider" method="POST">

        <table class="table-no-border" border="0" width="100%">
            <tr>
                <td width="25%">NUMERO :</td>
                <td width="75%"><input type="number" name="numero" value="<?php echo ((empty($_POST['numero']))?"":$_POST['numero']); ?>" ></td></tr>

            <tr>
                <td>DATE VISITE : </td>
                <td><input type="text" name="datevisite" value="<?php echo ((empty($_POST['datevisite']))?"":$_POST['datevisite']); ?>" ></td>
            </tr>

            <tr><td>PRATICIEN :</td>
                <td><select name="choixPraticiens" > 
                        <option value="">--</option> 
                        <?php foreach ($lesPraticiens as $value) { ?>
                            <option <?php echo ((empty($_POST['choixPraticiens']))?"":(($_POST['choixPraticiens']==$value['PRA_NUM'])?"selected":'')); ?> value="<?php echo $value['PRA_NUM']; ?>"><?php echo $value['PRA_NOM'] . " " . $value['PRA_PRENOM']; ?></option> 
                        <?php } ?>
                    </select></td>

            <tr><td>COEFFICIENT :</td><td><input value="<?php echo ((empty($_POST['numero']))?"":$_POST['numero']); ?>" type="text" name="coefficient" ></td></tr>

            <tr>
                <td>REMPLACANT </td>
                <td><input type="checkbox" name="remplacant" value="" value="<?php echo ((empty($_POST['remplacant']))?"":$_POST['remplacant']); ?>">

                </td>
            </tr>

            <tr><td>DATE :</td><td><input type="text" name="date" value="<?php echo ((empty($_POST['date']))?"":$_POST['date']); ?>"></td></tr>

            <tr><td>MOTIF :</td><td><input type="text" name="modif" value="<?php echo ((empty($_POST['modif']))?"":$_POST['modif']); ?>"></td></tr>

            <tr><td>BILAN :</td><td><input type="text" name="bilan" value="<?php echo ((empty($_POST['bilan']))?"":$_POST['bilan']); ?>"></td></tr>

        </table>
        <br>
        <br>

        <h2>Eléments présentés</h2>

        <table>
            <tr>
                <td>
                    PRODUIT 1 :
                </td>
                <td><select name="choixProduit1" > 
                        <option value="">--</option> 
                        <?php foreach ($lesMedicaments as $value) { ?>
                            <option <?php echo ((empty($_POST['choixProduit1']))?"":(($_POST['choixProduit1']==$value['MED_DEPOTLEGAL'])?"selected":'')); ?> value="<?php echo $value['MED_DEPOTLEGAL']; ?>"><?php echo $value['MED_NOMCOMMERCIAL']; ?></option> 
                        <?php } ?>
                    </select></td>
            </tr>
            <tr>
                <td>
                    PRODUIT 2 :
                </td>
                <td><select name="choixProduit2" > 
                        <option value="">--</option> 
                        <?php foreach ($lesMedicaments as $value) { ?>
                            <option <?php echo ((empty($_POST['choixProduit2']))?"":(($_POST['choixProduit2']==$value['MED_DEPOTLEGAL'])?"selected":'')); ?> value="<?php echo $value['MED_DEPOTLEGAL']; ?>"><?php echo $value['MED_NOMCOMMERCIAL']; ?></option> 
                        <?php } ?>
                    </select></td>
            </tr>
            <tr>
                <td>
                    DOCUMENTATION OFFERTE :
                </td>
                <td>
                    <input type="checkbox" name="documentation" value="" value="<?php echo ((empty($_POST['documentation']))?"":$_POST['documentation']); ?>">
                </td>
            </tr>
        </table>
        <br>
        <br>

        <h2>Echantillons</h2>
        <input type="checkbox"  name="avecEchantillon"> <!-- onchange="changerVisibilite('masque_Echantillion',this.checked)" -->

        <div id="masque_Echantillion" >  <!--style="visibility: hidden;"-->
            <td><select name="choixEchantillon" > 
                    <option value="">--</option> 
                    <?php foreach ($lesMedicaments as $value) { ?>
                        <option <?php echo ((empty($_POST['choixEchantillon']))?"":(($_POST['choixEchantillon']==$value['MED_DEPOTLEGAL'])?"selected":'')); ?> value="<?php echo $value['MED_DEPOTLEGAL']; ?>"><?php echo $value['MED_NOMCOMMERCIAL']; ?></option> 
                    <?php } ?>
                </select>
                <input type="number" name="nbEchantillons" min="0" max="100" value="0" value="<?php echo ((empty($_POST['nbEchantillons']))?"":$_POST['nbEchantillons']); ?>">
                <br>
        </div>

        <br>
        <br>
        <input type="submit" value="Envoyer" >


    </form>




</div>