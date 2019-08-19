
# ApiStock

Api Rest desenvolvida em laravel

## Ambiente

- docker ;
- Docker-compose;


## Conteiners :

- Ngix, DB(MySql) , Redis , App(api-web-sac)

##**OBSERVACAO IMPORTANTE**:

- O container de banco roda na porta 3306 por padrão , observar se mysql server instalado localmente esta rodando na mesma porta.


## Como executar o projeto 

Dentro da pasta app (api-stock) 

- execute docker-compose up -d --build 

Verifique os containers executados :

- docker ps

Acessa bash da aplicação

- docker exec -it (ID / Nome do container) bash

Para desligar os containers:

- docker-compose down (opção é passar parâmetro desligar apenas o container que se quer)

Verificar logs dos cointaners:

- docker logs (nome do container)
