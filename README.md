
# ApiStock

Api Rest desenvolvida em laravel

# Ambiente

- Docker-compose;

# Conteiners :

- Ngix, DB(MySql) , Redis , App(api-stock)


# Como executar o projeto 

Dentro da pasta app (api-stock) 
- execute docker-compose up -d --build 

Verifique os containers executados :
- docker ps

Acessa bash da aplicação
- docker exec -it (ID / Nome do container) bash

Para desligar os containers:
- docker-compose down (opção é passar parâmetro desligar apenas o container que se quer)
