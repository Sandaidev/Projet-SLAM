<?php

/*
 * Affiche un formulaire permettant la modification ou la création d'un nouveau produit dans la BDD
 * Paramètres (explicites exclus) :
 * 	$liste_categories : Pour la liste déroulante dans le choix de la catégorie à affecter.
 */
function Vue_formulaire_modification_produit($liste_categories,
											 $id_produit=null,
											 $id_categorie=null,
											 $nom_produit=null,
											 $description=null,
											 $code_reference=null,
											 $prix_ht=null,
											 $resume=null,
											 $img_src=null,
											 $mode_creation=false)
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
			<table style='padding: 20px; display: inline-block; height: 300px;'>

				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b>Article :</b> <input type='text' name='nom_produit' value='$nom_produit'>
					</td>
					<!-- FIXME path to article thumbnail in prod -->
					<td rowspan='4'> <img style='width:110px;' src='$img_src'>
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b>Référence : </b> <input type='text' name='code_reference' value='$code_reference'>
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b>Prix : </b> <input type='number' name='prix_ht' value='$prix_ht'>
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b>Description :</b> <input type='text' name='description' value='$description'>
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b>Résumé :</b> <input type='text' name='resume' value='$resume'>
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b>Catégorie :</b>
						<select name='id_categorie'>";

		// Category dropdown filling
		foreach ($liste_categories as $categorie)
		{
			if ($categorie["idCategorie"] == $id_categorie)
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
					<td><input type='submit' name='confirmation_creer_produit' value='Confirmer'></td>
				</tr>
				
			</table>
			</button>
		</form>
		";
	}

	else
	{
		// Cas : Modification d'un nouveau produit
		echo "
		<form style='display: contents;'>			
			<input type='hidden' name='id_produit' value='$id_produit'>
			<table style='padding: 20px; display: inline-block; height: 300px;'>

				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b>Article :</b> <input type='text' name='nom_produit' value='$nom_produit'>
					</td>
					<!-- FIXME path to article thumbnail in prod -->
					<td rowspan='4'> <img style='width:110px;' src='$img_src'>
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b>Référence : </b> <input type='text' name='code_reference' value='$code_reference'>
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b>Prix : </b> <input type='number' name='prix_ht' value='$prix_ht'>
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b>Description :</b> <input type='text' name='description' value='$description'>
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b>Résumé :</b> <input type='text' name='resume' value='$resume'>
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b>Catégorie :</b>
						<select name='id_categorie'>";

							// Category dropdown filling
							foreach ($liste_categories as $categorie)
							{
								if ($categorie["idCategorie"] == $id_categorie)
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
					<td><input type='submit' name='confirmation_modifier_produit' value='Confirmer'></td>
				</tr>
				
			</table>
			</button>
		</form>
		";
	}

}