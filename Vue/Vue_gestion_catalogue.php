<?php

/*
 * Affiche un formulaire permettant la modification ou la création d'un nouveau produit dans la BDD
 * Paramètres (explicites exclus) :
 * 	$liste_categories : Pour la liste déroulante dans le choix de la catégorie à affecter.
 */
function Vue_formulaire_modification_produit($liste_categories, $infos_produit=null, $mode_creation=false)
{
	// Affichage du titre
	if ($mode_creation)
	{
		echo "<h1>Création d'un nouveau produit</h1>";
	}

	else
	{
		echo "<h1>Modification d'un produit</h1>";
	}

	// Form & pre-fills
	if ($mode_creation)
	{
		// Cas : Création d'un nouveau produit
		echo "
		<form style='display: contents;'>			
			<table style='padding: 20px; display: inline-block;'>

				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b>Article :</b> <input type='text' name='nom_produit' value='$infos_produit[nomProduit]'>
					</td>
					<!-- FIXME path to article thumbnail in prod -->
					<td rowspan='7'> <img style='width:250px;' src='/Projet-SLAM/public/PLACEHOLDER.jpg'>
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b>Référence : </b> <input type='text' name='code_reference' value='$infos_produit[codeReference]'>
					</td>
				</tr>
				
				<tr>f
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
			echo "<option value='$categorie[idCategorie]'>$categorie[nomCategorie]</option>";
		}

		echo "
					</select>
					</td>
				</tr>
				
				<tr>
					<td><input type='submit' name='confirmation_creer_produit' value='Confirmer'></td>
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