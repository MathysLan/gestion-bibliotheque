# Gestion Bibliothèque
## LANGINY Mathys
## Installation / Configuration

### Installation par `Composer`

Lancer `composer install` pour installer [PHP Coding Standards Fixer](https://cs.symfony.com/) et le configurer dans PhpStorm (le fichier `.php-cs-fixer.php` contient les règles personnalisées basées sur la recommandation [Symfony](https://symfony.com/doc/current/contributing/code/standards.html))

### Configurer PhpStorm

Configurer l'intégration de PHP Coding Standards Fixer dans PhpStorm en fixant le jeu de règles sur `Custom` et en désignant `.php-cs-fixer.php` comme fichier de configuration de règles de codage.

### Configuration de la base de données

Nom de la base de données : login_contact  
Colonne :
- nom
- firstname
- lastname
- email  
  Dans le fichier .env.local   
  ```DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=10.2.25-MariaDB&charset=utf8mb4"```

### Scripts

```start``` : Permet de lancer le serveur
```fix:phpcs```: Permet de fixer le code php à l'aide PHP CS Fixer
```test:phpcs```: Permet de détecter les erreurs de code php à l'aide PHP CS Fixer
```test:twigcs``` : Permet de détecter les erreurs de code twigs à l'aide Twig CS Fixer
```fix:twigcs``` : Permet de fixer les erreurs de code twigs à l'aide Twig CS Fixer