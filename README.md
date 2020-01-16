# projet-symfony-ipssi

Projet créé pour l'école IPSSI.

## Installation

### Prequis

* NPM
* Yarn
* PHP >7.2
* Composer

#### NPM

NPM est le gestionnaire de paquets de Nodejs et peut être installé via le [site officiel](https://nodejs.org/).

#### Yarn

Yarn est une alternative à NPM.
Il est installable en récupérant le paquet node `yarn` via la commande suivante :
```bash
npm install -g yarn
```

#### PHP

PHP est téléchargeable via le [site officiel](https://www.php.net/downloads). Pour un fonctionnement optimal du projet, il est fortement recommandé d'utiliser une version de PHP supérieur à la 7.2.

#### Composer

Composer est un gestionnaire de dépendances libres écrites en PHP (de la même manière que NPM). Il est téléchargeable via le [site officiel](https://getcomposer.org/download/).

### Installation des dépendances

Les dépendances sont présents d'une part sur le gestionnaire de dépendances NPM et d'autre part sur celui de Composer.
Pour installer ces dépendances, vous devez lancer les commandes install de composer et de NPM.

```bash
composer install
npm install
```

## Usage

#### Frontend

Pour compiler les scripts et les styles, il faudra que vous lanciez les commandes suivantes en fonction de votre mode de développement (soit `production`, soit `developpement`).

```bash
yarn encore production
```

ou

```bash
yarn encore developpement
```

#### Backend

#### Lancer un serveur local

Pour lancer un serveur local, vous pouvez passez par `symfony` afin de faire cela. La commande suivante devrait lancer le site sur l'adresse URL `http://localhost:8000`.

```
symfony server:start
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
