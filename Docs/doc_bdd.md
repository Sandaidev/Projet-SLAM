# Mode d'emploi : Base de données

### Table : `Entreprise`

Permet la gestion des entreprises (front office)

Structure / Champs :
- `idEntreprise` - [`int(11)`]
    - Clé primaire, unique à chaque entreprise
- `denomination` - [`text`]
    - Nom complet de l'entreprise
- `rueAdresse` - [`text`]
    - Adresse complète de l'entreprise
- `complementAdresse` - [`text`]
    - Complément d'adresse de l'entreprise
- `codePostal` - [`text`]
    - Code postal + CEDEX de l'entreprise
- `ville` - [`text`]
    - Ville où se situe l'entreprise
- `pays` - [`text`]
    - Pays où se situe l'entreprise
- `numCompte` - [`text`]
    - Nom d'utilisateur utilisé pour la connexion (sur `index.php`)
- `mailContact` - [`text`]
    - Adresse e-mail de contact de l'entreprise
- `siret` - [`text`]
    - Siret (14 chiffres) de l'entreprise
- `motDePasse` - [`text`]
    -  Mot de passe haché de l'entreprise sur le site
    
### Table : `Utilisateur`

Permet la gestion des utilisateurs du back office

Structure / Champs :
- `idUtilisateur` - [`int(11)`]
    - Clé primaire, identifiant unique à chaque utilisateurs du back office
- `login` - [`text`]
    - Nom d'utilisateur utilisé pour la connexion au back office
- `motDePasse` - [`text`]
    - Mot de passe utilisé pour la connexion au back office
- `niveauAutorisation` - [`int(11)`]
    - Niveau d'autorisation de l'utilisateur, `root` doit être au niveau 1