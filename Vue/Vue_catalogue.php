<?php

global $site_baseurl;
$site_baseurl = "/Projet-SLAM";

function Vue_Catalogue_menu($liste_categories, $mode_admin=false)
{
    echo "
    <nav style='height: auto;'>
        <ul style='max-height: 100%;'>
    ";

    foreach ($liste_categories as $categorie)
    {
        echo "
            <li>
                <form style='border: none; background: none; box-shadow: none; padding: 10px; margin-bottom: 0;'>
                    <input type='hidden' name='idCategorie' value='". $categorie["idCategorie"] ."'>
                    <input class='input_styled' type='submit' value='". $categorie["nomCategorie"] ."'>
                </form>
            </li>
        ";
    }

    // Bonton hardcoded : Afficher toutes les catégories (idCategorie == -1)
    echo "
        <li>
            <form style='border: none; background: none; box-shadow: none; padding: 10px; margin-bottom: 0;'>
                <input type='hidden' name='idCategorie' value='-1'>
                <input class='input_styled' type='submit' value='Afficher tout'>
            </form>
        </li>
    ";

    echo "</ul>";

    if ($mode_admin)
	{
		echo "
        <ul>
            <li>
                <form style='border: none; background: none; box-shadow: none; padding: 10px; margin-top: 0;'>
                    <input class='input_styled' type='submit' name='gerer_produits' value='Gérer les produits'>
                </form>
            </li>
            <li>
                <form style='border: none; background: none; box-shadow: none; padding: 10px; margin-top: 0;'>
                    <input class='input_styled' type='submit' name='gerer_categories' value='Gérer les catégories'>
                </form>
            </li>
    	</ul>
    	";
	}

    echo "
    </nav>";
}

function Vue_afficher_liste_produits($liste_produits)
{
	if ($liste_produits == false)
	{
		// Cas : aucun produit n'existe dans la catégorie sélectionnée
		echo "<h3 style='color: white; font-family: ralewaylight;'>Il n'y a pas encore d'articles dans cette catégorie.</h3>";
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
							<td rowspan='4'>
							";

            if ($produit["imgSrc"] == "")
            {
                echo "<img style='width:110px;' src='$GLOBALS[site_baseurl]/public/PLACEHOLDER.jpg'>";
            }

            else
            {
                echo "<img style='width:110px;' src='$GLOBALS[site_baseurl]/public/$produit[imgSrc]'>";
            }

            echo "
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
					
					<td rowspan='4'> 
					
					";

	if ($produit["imgSrc"] == "")
    {
        echo "<img style='width:110px;' src='$GLOBALS[site_baseurl]/public/PLACEHOLDER.jpg'>";
    }

	else
    {
        echo "<img style='width:110px;' src='$GLOBALS[site_baseurl]/public/$produit[imgSrc]'>";
    }

	echo "
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