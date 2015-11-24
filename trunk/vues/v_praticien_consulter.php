<div id="contenu">
      <h2>Praticiens </h2>
      <div class="corpsForm">
     <table >
  	   <caption>Liste des praticiens
       </caption>
             <tr> 
                <th >Nom</th>  
                <th >Prénom</th> 
                <th >Adresse</th>
                <th >Code postal</th>
                <th >Ville</th>
             </tr>
          
    <?php  
	   foreach ($lesPraticiens as $unPraticien) {
			$nom = $unPraticien['PRA_NOM'];
                        $prenom = $unPraticien['PRA_PRENOM'];
                        $adresse = $unPraticien['PRA_ADRESSE'];
                        $cp = $unPraticien['PRA_CP'];
                        $ville = $unPraticien['PRA_VILLE'];
                        
		?>		
            <tr>
                <td><?php echo $nom ?></td>
                <td><?php echo $prenom ?></td>
                <td><?php echo $adresse ?></td>
                <td><?php echo $cp ?></td>
                <td><?php echo $ville ?></td>
            </tr>
                
    <?php		 
          
          }
?>	  
                                          
    </table> 
    </div>
</div>