## Pitchingon project

Laravel framework uses

To deploy locally you must using docker.

1) Rename file docker-compose.example.yml (locally you can use default settings) 
2) Execute command:

```docker-compose up -d```

For more information visit [repository](https://gitlab.appus.software/web/docker-info)

### Admin panel

For admin panel we use [AdminLTE](https://adminlte.io/)

### Api documentation 
Go [http://localhost:8888/apidoc/](http://localhost:8888/apidoc/) to see api documentation locally
Apidoc generation:

```apidoc -i docs/ -o public/apidoc/```

### Tests
For tests here used phpunit

### Conventions

+ Project uses [PSR](http://www.php-fig.org/psr/) code standards

+ [Git flow](http://nvie.com/posts/a-successful-git-branching-model/) as git branching model

### Other

For formatting should use [php-cs-fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)