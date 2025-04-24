# Containers Docker PHP

Ensemble de containers pour du développement PHP _vanilla_ ou _frameworks_ avec bases de données.

* Serveur **Nginx**
* **PHP**
* **PostgreSQL** + pgAdmin
* **MariaDB** + phpMyAdmin

> Sur une base générée par https://phpdocker.io


---
## Sommaire
<!-- vscode-markdown-toc -->
* [Services](#Services)
* [Identifiants](#Identifiants)
* [Configuration automatique des serveurs dans pgAdmin](#ConfigurationautomatiquedesserveursdanspgAdmin)
* [Démarrage manuel des containers](#Dmarragemanueldescontainers)
* [Arrêt manuel des containers](#Arrtmanueldescontainers)
* [Démarrage et arrêt des containers par `make`](#Dmarrageetarrtdescontainersparmake)
* [Test de la configuration](#Testdelaconfiguration)

<!-- vscode-markdown-toc-config
	numbering=false
	autoSave=true
	/vscode-markdown-toc-config -->
<!-- /vscode-markdown-toc -->
---


## <a name='Services'></a>Services

| Service | Description | Port interne | Port externe |
|---|---|---|---|
| `webserver` | Serveur Nginx | 80 | 3000 |
| `php-fpm` | PHP | | |
| `pgdb` | Serveur de bases de données PostgreSQL | 5432 | 3001
| `pgadmin` | Interface d'administration pour PostgreSQL | 80 | 5050
| `mariadb` | Serveur de bases de données MariaDB | 3306 | 3002
| `phpmyadmin` | Interface d'administration pour MariaDB | 80 | 5051

- Le **port interne** est interne au container.
- Le **port externe** est exposé par le container.

## <a name='Identifiants'></a>Identifiants

> Voir le fichier `.env`



## <a name='ConfigurationautomatiquedesserveursdanspgAdmin'></a>Configuration automatique des serveurs dans pgAdmin

Le **serveur PostgreSQL** est normalement référencé automatiquement dans **pgAdmin** (vous devriez voir le serveur dans l'arborescence de **pgAdmin**).

Si ce n'est pas le cas, vous avez toujours la possibilité d'ajouter le serveur `pgdb` manuellement à pgAdmin, après son lancement.


## <a name='Dmarragemanueldescontainers'></a>Démarrage manuel des containers

```bash
docker-compose up -d
```

> **Note :** Les containers de base de données peuvent mettre un certain temps à s'initialiser, au premier lancement.

## <a name='Arrtmanueldescontainers'></a>Arrêt manuel des containers

```bash
docker-compose down
```

## <a name='Dmarrageetarrtdescontainersparmake'></a>Démarrage et arrêt des containers par `make`

> Un `makefile` est également fourni pour simplifier la gestion des containers. Les commandes suivantes sont disponibles :

```bash
# Démarrer les containers
make up

# Arrêter les containers
make down

# Arrêter les containers et supprimer les volumes associés
# ATTENTION : dans ce cas, les données sont perdues
make downwipe

# Redémarrer les containers 
make restart

# Se connecter au container PostgreSQL
make pgshell

# Se connecter à psql dans le container PostgreSQL
make psql

# Se connecter au container MariaDB
make myshell

# Se connecter à mysql dans le container MariaDB
make mysql

# Se connecter au container PHP-FPM
# (permet notamment d'utiliser Composer)
make phpshell
```

> **Note** : l'utilisation du `makefile` suppose que `make` est installé sur votre machine. Si ce n'est pas le cas :
> ```bash
> sudo apt install make
> ```

## <a name='Testdelaconfiguration'></a>Test de la configuration

* Un dossier `app` doit être créé pour le serveur Nginx. 
* Le projet PHP sera placé dans `app`. 
* Pour tester l'environnement :

    1. Démarrez les containers.
    2. Créez une page `app/index.php` avec ce contenu :
    ```php
    <?php phpinfo();
    ```
    3. Connectez-vous à `localhost:3000`