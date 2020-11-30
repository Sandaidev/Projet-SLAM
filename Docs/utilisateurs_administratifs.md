# Utilisateurs administratifs

Dans la BDD, table `Utilisateur` :

- niveauAutorisation = 1 : `root` ou "Super Administrateur", rôle attribué au SysAdmin
- niveauAutorisation = 2 : Commercial, il permet de gérer le catalogue sans plus.
- niveauAutorisation = 3 : Employés, ils ont un contrôle moins puissant sur le catalogue que les commerciaux.