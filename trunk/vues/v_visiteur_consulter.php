<div id="contenu">
      <h2>Liste des visiteurs </h2>
      <div class="corpsForm">
     <table >
  	   <caption>Liste des visiteurs
       </caption>
             <tr>
                <th >Matricule</th>  
                <th >Nom</th>  
                <th >Prénom</th> 
                <th >Adresse</th>
                <th >Code postal</th>
                <th >Ville</th>
             </tr>
          
    <?php  
	   foreach ($lesVisiteurs as $unVisiteur) {
			$mat = $unVisiteur['VIS_MATRICULE'];
			$nom = $unVisiteur['VIS_NOM'];
                        $prenom = $unVisiteur['VIS_PRENOM'];
                        $adresse = $unVisiteur['VIS_ADRESSE'];
                        $cp = $unVisiteur['VIS_CP'];
                        $ville = $unVisiteur['VIS_VILLE'];
                        
		?>		
            <tr> <td><?php echo $mat ?></td>
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