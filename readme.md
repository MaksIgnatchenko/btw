## SkyCart project

Laravel framework uses

To deploy locally you must install:
+ docker
+ docker-compose 
+ apidoc (optional. for apidoc generation)

1) Rename file docker-compose.example.yml and setup your settings
2) Rename file .env.exanple and setup your settings
3) Execute command: 
```docker-compose up -d```
4) Enter inside container

```docker exec -ti wish_php /bin/bash```

and execute

```composer install```

```sh init_dev.sh```



### Api documentation 
Go [http://localhost/apidoc/](http://localhost/apidoc/) to see api documentation locally
Apidoc generation:

```apidoc -i docs/ -o public/apidoc/```


### Conventions

+ Project uses [PSR](http://www.php-fig.org/psr/) code standards

+ [Git flow](http://nvie.com/posts/a-successful-git-branching-model/) as git branching model

### Other

For formatting should use [php-cs-fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)