# TAMUSNI

## Structure du projet :

### /public/

- Contient la partie publique de l'application avec les js, css et assets
- Contient également l'entry point "index.php" où sont définies les routines à exécuter selon le cas qui se présente
- Accéder à l'application via : **http://localhost/public/?page=welcome**

### /app/

- Contient les sources propres au projet : Models, Views, Controllers
- Les contrôleurs publiques et ceux relatif au profil 'administrateur' implémentent le design pattern "Singleton", ils fonctionnent donc selon une instance unique.
- L'ensemble des contrôleurs dérivent de la classe "Controller", les modèles dérivent de la classe "Table" où des méthodes génériques sont définies.
- Les vues sont générées via leurs contrôleurs en utilisant un template selon que la page soit publique ou accessible via connexion.
- Le routing est assuré en partie par un autoloader qui effectue les "require_once" de manière automatique

### /core/

- API avec des classes génériques : Connexion à la BDD, Classe Controller et Table dont héritent les contrôleurs et modèles du projet.
- Contient également un module d'authentification "Auth.php" pour effectuer les vérifications nécessaires lors de la connexion.

### /config/

- dossier contenant les identifiants de la BDD

## État d'avancement :

- Structure générale du projet bien établie.
- Classes génériques (Controlleur, table et Database) réalisées.
- Base de données conçue et implémentée.
- Système de routing ajouté (avec privilèges)
- Authentification implémentée
- Vues et fonctionnalités publiques : finalisées à 80%
- Vues et fonctionnalités du profil administrateur : finalisées à 70%
- Documentation de l'ensemble du code PHP effectuée

## Technologies utilisées jusqu'à présent :

HTML, SCSS, JS, JQUERY, AJAX, PHP, MYSQL.
