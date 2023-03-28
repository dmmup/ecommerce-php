<?php
require_once("fonctions.php");
require_once("connexion.php");
session_start();
$contenu='';
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- AJOUT PANIER ---//
if(isset($_POST['ajout_panier'])) 
{	
	
	$req = "SELECT * FROM products WHERE id='$_POST[id]'";
	$resultat=$conn->query($req);
	$product = $resultat->fetch_assoc();

	//------création du panier------

	if (!isset($_SESSION['panier']))
	{
	   $_SESSION['panier']=array();
	   $_SESSION['panier']['title'] = array();
	   $_SESSION['panier']['id_produit'] = array();
	   $_SESSION['panier']['artistname'] = array();
	   $_SESSION['panier']['annee'] = array();
	   $_SESSION['panier']['quantite'] = array();
	   $_SESSION['panier']['prix'] = array();
	}
//------ajout du produit dans le panier------

	$position_produit = array_search($_POST['id'],  $_SESSION['panier']['id_produit']); 
    if ($position_produit !== false)
    {
         $_SESSION['panier']['quantite'][$position_produit] += $_POST['quantite'] ;
    }
    else 
    {
        $_SESSION['panier']['title'][] = $product['title'];
        $_SESSION['panier']['id_produit'][] = $_POST['id'];
		$_SESSION['panier']['artistname'][] = $product['artistname'];
		$_SESSION['panier']['annee'][] = $product['annee'];
        $_SESSION['panier']['quantite'][] = $_POST['quantite'];
		$_SESSION['panier']['prix'][] = $product['prix'];
		
    }}


//------------------


if(isset($_GET['action']) && $_GET['action'] == "retirer")

{
	$position_produit = array_search($_GET['id_produit'],  $_SESSION['panier']['id_produit']);
	if ($position_produit !== false)
    {
		//supprimer un seul element dont l'indice est position produit
		array_splice($_SESSION['panier']['title'], $position_produit, 1);
		array_splice($_SESSION['panier']['id_produit'], $position_produit, 1);
		array_splice($_SESSION['panier']['artistname'], $position_produit, 1);
		array_splice($_SESSION['panier']['annee'], $position_produit, 1);
		array_splice($_SESSION['panier']['quantite'], $position_produit, 1);
		array_splice($_SESSION['panier']['prix'], $position_produit, 1);
	}
}

	//-----------

//--- VIDER PANIER ---//
if(isset($_GET['action']) && $_GET['action'] == "vider")
{
	unset($_SESSION['panier']);
}
//--- PAIEMENT ---//
if(isset($_POST['payer']))
{
	for($i=0 ;$i < count($_SESSION['panier']['id_produit']) ; $i++) 
	{
		$req = "SELECT * FROM flower WHERE id_produit=" . $_SESSION['panier']['id_produit'][$i];
		$resultat=$conn->query($req);
		$produit = $resultat->fetch_assoc();
		if($produit['stock'] < $_SESSION['panier']['quantite'][$i])
		{
			$contenu .= '<hr /><div class="erreur">Stock Restant: ' . $produit['stock'] . '</div>';
			$contenu .= '<div class="erreur">Quantité demandée: ' . $_SESSION['panier']['quantite'][$i] . '</div>';
			if($produit['stock'] > 0)
			{
				$contenu .= '<div class="erreur">la quantité du produit ' . $_SESSION['panier']['id_produit'][$i] . ' a été réduite car notre stock était insuffisant, veuillez vérifier vos achats.</div>';
				$_SESSION['panier']['quantite'][$i] = $produit['stock'];
			}
			else
			{
				$contenu .= '<div class="erreur">le produit ' . $_SESSION['panier']['id_produit'][$i] . ' a été retiré de votre panier car nous sommes en rupture de stock, veuillez vérifier vos achats.</div>';
				retirerproduitDuPanier($_SESSION['panier']['id_produit'][$i]);
				$i--;
			}
			$erreur = true;
		}
	}
	if(!isset($erreur))
	{
		$req="INSERT INTO commande (id_membre, montant, date_enregistrement) VALUES (" . $_SESSION['membre']['id_membre'] . "," . montantTotal() . ", NOW())";
		$resultat=$conn->query($req);
		$id_commande = $conn->insert_id;
		
		
		for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
		{
			$req="INSERT INTO details_commande (id_commande, id_produit, quantite, prix)
			 VALUES ($id_commande, " . $_SESSION['panier']['id_produit'][$i] . "," . $_SESSION['panier']['quantite'][$i] . "," . $_SESSION['panier']['prix'][$i] . ")";
			
			$resultat=$conn->query($req);
			$x=$_SESSION['panier']['quantite'][$i];

			//-------mise a jour de stock dans la base de données-------------

			$req = "SELECT * FROM flower WHERE id_produit=" . $_SESSION['panier']['id_produit'][$i];
			$resultat=$conn->query($req);
			$produit = $resultat->fetch_assoc();
			$y=$produit['stock'];
		
			$req="UPDATE flower set   stock=$y-$x WHERE id_produit=" . $_SESSION['panier']['id_produit'][$i];
   			$res=$conn->query($req);

//----------------------

		}
		unset($_SESSION['panier']);
		$contenu .= "<div class='validation'>Merci pour votre commande. votre numéro de suivi est le $id_commande</div>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <title>Panier</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">M&J RECORDS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php">Accueuil</a>
        </li>
        <li class="nav-item">
		<a class="nav-link" href="display_products.php">Our Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="panier.php">Panier</a>
        </li>
		<li class="nav-item">
        <a class="nav-link" href="#">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="loginAdmin.php" tabindex="-1" aria-disabled="true">Administrateur</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="card text-center mt-5">
	<div class="container d-flex justify-content-center">

	


<?php

//--------------------------------- AFFICHAGE HTML ---------------------------------//


echo $contenu;
echo "<table class='table table-hover table-warning col-8' border='1' style='border-collapse: collapse' cellpadding='7'>";
echo "<thead><tr><td colspan='5'>Shopping Cart</td></tr>";
echo "<tr><th>Title</th><th>Artist</th><th>Year</th><th>Quantite</th><th>Price per Unit</th><th>Action</th></tr></thead>";
if(empty($_SESSION['panier']['id_produit'])) // panier vide
{
	echo "<tr><td colspan='5'>Youre Shopping Cart Is Empty</td></tr>";
}
else
{
	for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++) 
	
	{
		echo "<tbody><tr>";
		echo "<td>" . $_SESSION['panier']['title'][$i] . "</td>";
		
		echo "<td>" . $_SESSION['panier']['artistname'][$i] . "</td>";
		echo "<td>" . $_SESSION['panier']['annee'][$i] . "</td>";
		echo "<td>" . $_SESSION['panier']['quantite'][$i] . "</td>";
		echo "<td>" . $_SESSION['panier']['prix'][$i] .'$'. "</td>";
		echo '<td><a href="?action=retirer&id_produit=' . $_SESSION['panier']['id_produit'][$i] .'"><i class="fa fa-trash" aria-hidden=true></i></a></td>';
		echo "</tr></tbody>";
	}
	echo "<tr><th colspan='5'>Total</th><td colspan='2'>" . montantTotal() . " $</td></tr>";
	echo "<tr><td colspan='7'><a href='?action=vider'>Empty My Shopping Cart</a></td></tr>";
	echo "<tr><td colspan='7'><a href='display_products.php'>Continue My Shopping</a></td></tr>";
}
echo "</table><br />";
?>

</div>
</div>
</body>