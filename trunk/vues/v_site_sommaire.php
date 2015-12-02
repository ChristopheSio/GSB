    <!-- Division pour le sommaire -->
    <div id="menuGauche">
     <div id="infosUtil">
    
        <h2>
    </h2>
          </div>  
        <ul id="menuList">
            <li>
                Bienvenue :<br>
               <?php echo $_SESSION['prenom']."  ".$_SESSION['nom']  ?>
            </li>
           
           <li class="smenu">Comptes rendu
               <ul>
                   <li><a href="index.php?uc=compte-rendu&action=consulter" title="Consulter les comptes rendus">Consulter</a></li>
                   <li><a href="index.php?uc=compte-rendu&action=saisir" title="Consulter les comptes rendus">Saisie</a></li>
               </ul>
           </li>
           <li class="smenu">Praticiens
               <ul>
                   <li><a href="index.php?uc=praticien&action=Tous" title="Consulter les praticiens">Tous</a></li>
                   <li><a href="index.php?uc=praticien&action=Liste" title="Saisir des praticiens">Par nom</a></li>
               </ul>
           </li>
           <!--Mission 3-->
            <li class="smenu">
                <a href="index.php?uc=visiteur&action=consulter" title="Consulter les visiteurs">Visiteurs</a></li>
            </li>
		  
           <li class="smenu">Médicaments
               <ul>
                   <li><a href="index.php?uc=medicament&action=liste" title="Consulter les comptes rendus">Tous</a></li>
                   <li><a href="index.php?uc=medicament&action=consulter" title="Consulter les comptes rendus">Par nom</a></li>
                   <!--<li><a href="index.php?uc=medicament&action=saisir" title="Consulter les comptes rendus">Saisie</a></li>-->
               </ul>
           </li>
           
           <li class="smenu">
              <a href="index.php?uc=auth&action=deconnexion" title="Se déconnecter">Déconnexion</a>
           </li>
           
           <li class="smenu">
              <a href="index.php?uc=" title="Rapport de visite">Rapport</a>
           </li><li class="smenu">
         </ul>
        
    </div>
    