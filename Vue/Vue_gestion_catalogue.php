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
					<td style='vertical-align: top; width : 350px; text-align: center;'>
						<b style='color: white;'>⸻ Nom de l'article ⸻</b> <input style='width: 100%; border-radius: 8px;' type='text' name='nom_produit' required>
					</td>
					<td rowspan='7'> <img style='width:270px; border-radius: 16px; margin: 16px; box-shadow: black 0 0 16px;' src='$GLOBALS[site_baseurl]/public/PLACEHOLDER.jpg'>
					</td>
					
				</tr>
				
				<tr>
					<td style='vertical-align: top; text-align: center;'>
						<b style='color: white'>⸻ Prix (€ HT) ⸻</b><input style='width: 100%;' type='number' name='prix_ht' step='0.01' min='0' required>
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top; text-align: center;'>
						<b style='color: white'>⸻ Description ⸻</b> <input style='width: 100%; border-radius: 8px;' type='text' name='description' required>
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top; text-align: center;'>
						<b style='color: white;'>⸻ Résumé ⸻</b> <input style='width: 100%; border-radius: 8px;' type='text' name='resume' required>
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top; text-align: center;'>
						<b style='color: white;'>⸻ Catégorie ⸻</b>
						";

		if (sizeof($liste_categories) == 0)
        {
            // Si il n'y a aucune catégories, on désactive la liste

            $confirm_disable_tag = "disabled";

            echo "
                <select style='width: 100%;' name='id_categorie' disabled>
                    <option>Vous devez d'abord créer une catégorie!</option>
                </select>
                ";
        }

		else
        {
            $confirm_disable_tag = "";

            echo "<select style='width: 100%;' name='id_categorie' required>";

            // Category dropdown filling
            foreach ($liste_categories as $categorie)
            {
                echo "<option value='$categorie[idCategorie]'>$categorie[idCategorie] - $categorie[nomCategorie]</option>";
            }

            echo "</select>";
        }

		echo "
					</td>
					</tr>
					
					<tr>
					<td style='vertical-align: top;width : 100%; text-align: center;'>
					<b style='color: white'>⸻ TVA ⸻</b>
					<select style='width: 100%;' name='idTVA'>";

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
                    <td style='text-align: center;'>
					    <b style='color: white'>⸻ Status à la création ⸻</b>
					    <select style='width: 100%;' name='status_produit' required>
					        <option value='1' selected>Activé</option>
				            <option value='0'>Désactivé</option>
                        </select>
                    </td>
                </tr>
                    			
				<tr>
					<td colspan='2'><input style='background-color: black;' class='input_styled' type='submit' name='confirmation_creer_produit' value='Confirmer' $confirm_disable_tag></td>
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
			<table style='display: inline-block; font-family: ralewaymedium;'>

				<tr>
					<td style='vertical-align: top; width : 350px; text-align: center;'>
						<b style='color: white;'>⸻ Nom de l'article ⸻</b> <input style='width: 100%; border-radius: 8px;' type='text' name='nom_produit' value='$infos_produit[nomProduit]'>
					</td>
					<td rowspan='7'>
					";

		if ($infos_produit["imgSrc"] == "")
        {
            echo "<img style='width:270px; border-radius: 16px; margin: 16px; box-shadow: black 0 0 16px;' src='$GLOBALS[site_baseurl]/public/PLACEHOLDER.jpg'>";
        }

		else
        {
            echo "<img style='width:270px; border-radius: 16px; margin: 16px; box-shadow: black 0 0 16px;' src='$GLOBALS[site_baseurl]/public/$infos_produit[imgSrc]'>";
        }

		echo "
					
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top; text-align: center;'>
						<b style='color: white'>⸻ Prix (€ HT) ⸻</b><input style='width: 100%;' type='number' name='prix_ht' step='0.01' min='0' value='$infos_produit[prixHT]'>
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top; text-align: center;'>
						<b style='color: white'>⸻ Description ⸻</b> <input style='width: 100%; border-radius: 8px;' type='text' name='description' value='$infos_produit[description]'>
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top; text-align: center;'>
						<b style='color: white;'>⸻ Résumé ⸻</b> <input style='width: 100%; border-radius: 8px;' type='text' name='resume' value='$infos_produit[resume]'>
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top; text-align: center;'>
						<b style='color: white;'>⸻ Catégorie ⸻</b>
						<select style='width: 100%;' name='id_categorie'>";

        // Category dropdown filling
        foreach ($liste_categories as $categorie)
        {
            if ($infos_produit["idCategorie"] == $categorie["idCategorie"])
            {
                echo "<option value='$categorie[idCategorie]' selected>$categorie[idCategorie] - $categorie[nomCategorie]</option>";
            }

            else
            {
                echo "<option value='$categorie[idCategorie]'>$categorie[idCategorie] - $categorie[nomCategorie]</option>";
            }
        }

        echo "
					</select>
					</td>
					</tr>
					
					<tr>
					<td style='vertical-align: top;width : 100%; text-align: center;'>
					<b style='color: white'>⸻ TVA ⸻</b>
					<select style='width: 100%;' name='idTVA'>";

        // Tax dropdown filling
        foreach ($liste_tva as $ligne_tva)
        {
            if ($infos_produit["idTVA"] == $ligne_tva["idTVA"])
            {
                echo "<option value='$ligne_tva[idTVA]' selected>$ligne_tva[idTVA] - $ligne_tva[nomTVA]</option>";
            }

            else
            {
                echo "<option value='$ligne_tva[idTVA]'>$ligne_tva[idTVA] - $ligne_tva[nomTVA]</option>";
            }
        }


        echo "
                        </select>
                    </td>
                </tr>
                    
                <tr>
                    <td style='text-align: center;'>
					    <b style='color: white'>⸻ Status ⸻</b>
					    <select style='width: 100%;' name='status_produit' required>
					    ";

        if ($infos_produit["statusProduit"] == "1")
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
					<td colspan='2'><input style='background-color: black;' class='input_styled' type='submit' name='confirmation_modifier_produit' value='Confirmer'></td>
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
