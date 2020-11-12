<div id="menu">
	<div id="menuInt">
		<p><a href="index.php?page=home"><img src="image/accueil.gif" class="imagMenu" alt="Accueil"/>Accueil</a></p>
		<p><img src="image/personne.png" class="imagMenu" alt="Personne"/>Personne</p>
		<ul>			
			<li><a href="index.php?page=ajouterPersonne">Ajouter</a></li>
			<li><a href="index.php?page=listerPersonne">Lister</a></li>
		</ul>
		<p><img src="image/parcours.gif" class="imagMenu" alt="Parcours"/>Parcours</p>
		<ul>
			<li><a href="index.php?page=ajouterParcours">Ajouter</a></li>
			<li><a href="index.php?page=listerParcours">Lister</a></li>
		</ul>
		<p><img src="image/ville.png" class="imagMenu" alt="Ville"/>Ville</p>
		<ul>
			<li><a href="index.php?page=ajouterVille">Ajouter</a></li>
			<li><a href="index.php?page=listerVille">Lister</a></li>
		</ul>
        <div <?php if (empty($_SESSION['username'])) echo 'class="nonConnecte"'; ?>>
            <p><img src="image/trajet.png" class="imagMenu" alt="Trajet"/>Trajet</p>
            <ul>
                <li><a href="index.php?page=proposerTrajet">Proposer</a></li>
                <li><a href="index.php?page=rechercherTrajet">Rechercher</a></li>
            </ul>
        </div>
	</div>
</div>
