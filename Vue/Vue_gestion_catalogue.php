<?php

/*
 * Affiche un formulaire permettant la modification ou la création d'un nouveau produit dans la BDD
 * Paramètres (explicites exclus) :
 * 	$liste_categories : Pour la liste déroulante dans le choix de la catégorie à affecter.
 */
function Vue_formulaire_modification_produit($liste_categories, $infos_produit=null, $mode_creation=false, $liste_tva)
{
	// Affichage du titre
	if ($mode_creation)
	{
		echo "<h1 style='color: white;'>Création d'un nouveau produit</h1>";
	}

	else
	{
		echo "<h1 style='color: white;'>Modification d'un produit</h1>";
	}

	echo "<hr class='styled'>";

	// Form & pre-fills
	if ($mode_creation)
	{
		// Cas : Création d'un nouveau produit
		echo "
		<form style='display: contents;'>
			<table style='display: inline-block; font-family: ralewaymedium;'>

				<tr>
					<td>
						<b style='color: white'>Article :</b> <input type='text' name='nom_produit'>
					</td>
					<!-- FIXME path to article thumbnail in prod -->
					<td rowspan='6'> <img style='width:250px; border-radius: 16px; margin: 16px; box-shadow: black 0 0 16px;' src='/Projet-SLAM/public/PLACEHOLDER.jpg'>
					</td>
					
				</tr>
				
				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b style='color: white'>Prix (€ HT): </b> <input type='number' name='prix_ht' step='0.01' min='0'>
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b style='color: white'>Description :</b> <input type='text' name='description'>
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b style='color: white'>Résumé :</b> <input type='text' name='resume'>
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b style='color: white'>Catégorie :</b>
						<select name='id_categorie'>";

		// Category dropdown filling
		foreach ($liste_categories as $categorie)
		{
			echo "<option value='$categorie[idCategorie]'>$categorie[idCategorie] - $categorie[nomCategorie]</option>";
		}

		echo "
					</select>
					</td>
					</tr>
					
					<tr>
					<td style='vertical-align: top;width : 250px'>
					<b style='color: white'>TVA :</b>
					<select name='idTVA'>";

		// Tax dropdown filling
		foreach ($liste_tva as $ligne_tva)
        {
            echo "<option value='$ligne_tva[idTVA]'>$ligne_tva[idTVA] - $ligne_tva[nomTVA]</option>";
        }


		echo "
					</select>
                    </td>
                    </tr>
					
					<tr>
					<td><b style='color: white;'>Image : </b><input style='width: 80%;' type='url' name='img_src' placeholder=\"lien vers l'image\"></td>
				</tr>
				
				<tr>
					<td colspan='2'><input style='background-color: black;' class='input_styled' type='submit' name='confirmation_creer_produit' value='Confirmer'></td>
				</tr>
				
			</table>
			</button>
		</form>
		";
	}

	else
	{
		// Cas : Modification d'un produit
		echo "
		<form style='display: contents;'>			
			<input type='hidden' name='id_produit' value='$infos_produit[idProduit]'>
			<table style='padding: 20px; display: inline-block;'>

				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b>Article :</b> <input type='text' name='nom_produit' value='$infos_produit[nomProduit]'>
					</td>
					<!-- FIXME path to article thumbnail in prod -->
					<!--
					<td rowspan='7'> <img style='width:110px;' src='$infos_produit[imgSrc]'>-->
					<td rowspan='7'> <img style='width:250px;' src='/Projet-SLAM/public/PLACEHOLDER.jpg'>
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b>Référence : </b> <input type='text' name='code_reference' value='$infos_produit[codeReference]'>
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b>Prix : </b> <input type='number' name='prix_ht' value='$infos_produit[prixHT]'> € HT
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b>Description :</b> <input type='text' name='description' value='$infos_produit[description]'>
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b>Résumé :</b> <input type='text' name='resume' value='$infos_produit[resume]'>
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b>Catégorie :</b>
						<select name='id_categorie'>";

							// Category dropdown filling
							foreach ($liste_categories as $categorie)
							{
								if ($categorie["idCategorie"] == $infos_produit[id_categorie])
								{
									echo "<option value='$categorie[idCategorie]' selected>$categorie[nomCategorie]</option>";
								}

								else
								{
									echo "<option value='$categorie[idCategorie]'>$categorie[nomCategorie]</option>";
								}
							}

						echo "
						</select>
					</td>
				</tr>
				
				<tr>
					<td>
						<input type='submit' name='confirmation_modifier_produit' value='Confirmer'>
						<input type='submit' name='supprimer_produit' value='Supprimer ce produit' style='background-color: red'>
					</td>
				</tr>
				
			</table>
			</button>
		</form>
		";
	}

}

/**
 * @param bool $mode_creation
 * @return mixed
 */
function Vue_formulaire_modification_categorie($mode_creation=false, $id_categorie=null, $nom_categorie=null, $status_categorie=null)
{
	if ($mode_creation)
	{
		echo "
        <h1 style='color: white;'>Création d'une catégorie</h1>
        <hr class='styled'>
        
		<table style='margin: auto;'>
		<form style='display: contents;'>
			
			<tr>
				<td style='color: white; font-family: ralewaylight;'>
					<b>Nom de la nouvelle catégorie :</b>
				</td>
				<td>
					<input type='text' name='nom_categorie' required placeholder='Nouvelle catégorie'>
				</td>
			</tr>
			
			<tr>
			    <td style='color: white; font-family: ralewaylight;'>
			        <b>Status à la création : </b>
                </td>
                <td>
                    <select name='status_categorie' required>
                        <option value='1' selected>Activé</option>
                        <option value='0'>Désactivé</option>
                    </select>
                </td>
            </tr>
			
			<tr>
				<td colspan='2'>
					<input style='background-color: black;' class='input_styled' type='submit' name='confirmation_creer_categorie' value='Créer la catégorie!'>
				</td>
			</tr>
		</form>
		</table>
		";
	}

	else
	{
		echo "
        <h1 style='color: white;'>Modification d'une catégorie</h1>
        <hr class='styled'>
        
        <table style='margin: auto;'>
		<form style='display: contents;'>
			
			<tr>
				<td style='color: white; font-family: ralewaylight;'>
					<b>Nom de la catégorie :</b>
				</td>
				<td>
					<input type='text' name='nom_categorie' required placeholder='Nom de la catégorie' value='$nom_categorie'>
				</td>
			</tr>
			
			<tr>
			    <td style='color: white; font-family: ralewaylight;'>
			        <b>Status : </b>
                </td>
                <td>
                    <select name='status_categorie' required>
        ";

		if ($status_categorie == "1")
        {
            echo "
                <option value='1' selected>Activé</option>
                <option value='0'>Désactivé</option>
            ";
        }

		else
        {
            echo "
                <option value='1'>Activé</option>
                <option value='0' selected>Désactivé</option>
            ";
        }

        echo "
                    </select>
                </td>
            </tr>
			
			<tr>
				<td colspan='2'>
				    <input type='hidden' name='id_categorie' value='$id_categorie'>
					<input style='background-color: black;' class='input_styled' type='submit' name='confirmation_modifier_categorie' value='Enregistrer les modifications'>
				</td>
			</tr>
		</form>
		</table>
        ";
	}


}
