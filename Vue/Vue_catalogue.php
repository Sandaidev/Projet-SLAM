<?php

function Vue_Catalogue_menu($liste_categories, $mode_admin=false)
{
    echo "
    <nav style='height: auto;'>
        <ul>
    ";

    foreach ($liste_categories as $categorie)
    {
        echo "
            <li>
                <form style='border: none; background: none; box-shadow: none;'>
                    <input type='hidden' name='idCategorie' value='". $categorie["idCategorie"] ."'>
                    <input style='padding: 6px 0px; margin: 0;' type='submit' value='". $categorie["nomCategorie"] ."'>
                </form>
            </li>
        ";
    }

    // Bonton hardcoded : Afficher toutes les catégories (idCategorie == -1)
    echo "
        <li>
            <form style='border: none; background: none; box-shadow: none;'>
                <input type='hidden' name='idCategorie' value='-1'>
                <input style='padding: 6px 0px; margin: 0;' type='submit' value='Afficher tout'>
            </form>
        </li>
    ";

    if ($mode_admin)
	{
		echo "
		<li>
			<form style='border: none; background: none; box-shadow: none;'>
				<button style='background-color: #53af57; border-radius: 8px; color: white; padding: 6px; font-family: Tahoma;' onclick='submit();' name='ajouter_categorie'>
					<i class='fas fa-folder-plus' style='font-size: 18px;'> Ajouter une catégorie</i>
				</input>
    		</form>
    	</li>
    	";
	}

    echo "
        </ul>
    </nav>";
}

function Vue_afficher_liste_produits($liste_produits)
{
	if ($liste_produits == false)
	{
		// Cas : aucun produit n'existe dans la catégorie sélectionnée
		echo "<h3>Il n'y a pas encore d'articles dans cette catégorie.</h3>";
	}

	else
	{

		foreach ($liste_produits as $produit)
		{
			echo "
			<form style='display: contents;'>
				<input type='hidden' name='idProduit' value='$produit[idProduit]'>
				<input type='hidden' name='idCategorie' value='$_REQUEST[idCategorie]'>
				<button onclick='submit();' width='25%' 
            	onmouseover=\"this.style.background='#FFFF99';this.style.color='#FF0000';\"
            	onmouseout=\"this.style.background='';this.style.color='';\"
            	style='margin: 20px'>
			
					<table style='padding: 20px; display: inline-block; height: 300px;'>
						
						<tr>
							<td style='vertical-align: top;width : 250px'>
								<b>Article :</b> $produit[nomProduit]
							</td>
							<!-- FIXME path to article thumbnail in prod -->
							<td rowspan='4'> <img style='width:110px;' src='/Projet-SLAM/public/PLACEHOLDER.jpg'>
							</td>
						</tr>
						
						<tr>
							<td style='vertical-align: top;width : 250px'>
								<b>Référence : </b> $produit[codeReference]
							</td>
						</tr>
						
						<tr>
							<td style='vertical-align: top;width : 250px'>
								<b>Prix : </b> $produit[prixHT]€ HT
							</td>
						</tr>
						
						<tr>
							<td style='vertical-align: top;width : 250px'>
								<b>Résumé :</b> $produit[resume]
							</td>
						</tr>
						
					</table>
				</button>
			</form>
			";


		}
	}
}

function Vue_afficher_produit_detail($produit)
{
	echo "
	<form style='display: contents;'>
		<input type='hidden' name='idCategorie' value='$_REQUEST[idCategorie]'>
		<button onclick='submit();'
				width='25%' 
        		onmouseover=\"this.style.background='#FFFF99';this.style.color='#FF0000';\"
            	onmouseout=\"this.style.background='';this.style.color='';\"
            	style='margin: 20px'>
			
			<table style='padding: 20px; display: inline-block; height: 300px;'>
						
				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b>Article :</b> $produit[nomProduit]
					</td>
					<!-- FIXME path to article thumbnail in prod -->
					<td rowspan='4'> <img style='width:110px;' src='/Projet-SLAM/public/PLACEHOLDER.jpg'>
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b>Référence : </b> $produit[codeReference]
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b>Prix : </b> $produit[prixHT]€ HT
					</td>
				</tr>
				
				<tr>
					<td style='vertical-align: top;width : 250px'>
						<b>Description :</b> $produit[description]
					</td>
				</tr>
				
			</table>
			</button>
		</form>
		";
}