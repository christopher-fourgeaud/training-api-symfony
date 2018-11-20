Entrainement création d'api sur Symfony 3.4
========================
Le but est de  faire une API sur symfony, avec les 4 tables suivantes :

catégorie : id genre_principal sous_genre

livre : id titre catégorie auteur date_parution date_ajout photo 

auteur : id nom prénom 

commentaire : id pseudo message date

On ne fait pas de gestion d'utilisateurs. 

⋅⋅* L'api permettra de :
⋅⋅* get les catégories
⋅⋅* get les livres
⋅⋅* Get les auteurs
⋅⋅* Get les livres d'une catégorie sur genre principal
⋅⋅* Get les livres d'une catégorie sur sous genre
⋅⋅* Get les livre d'un auteur
⋅⋅* Get les commentaires d'un livre
⋅⋅* Post un auteur
⋅⋅* Post un livre
⋅⋅* Post un commentaire sur un livre
⋅⋅* Patch un auteur
⋅⋅* Patch un livre
⋅⋅* Delete un livre
⋅⋅* Delete un auteur 
⋅⋅* Delete un commentaire sur un livre