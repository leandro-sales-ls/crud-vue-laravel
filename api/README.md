## Desafio Before

### Cadastro

-   Produtos.
-   Compras
-   Vendas

### Configuração

Abra o terminal e rode o comando: git clone https://github.com/leandro-sales-ls/desafio-before.git

Configure o ".env" com as informações do banco que deseja utilizar, informando o DB_CONNECTION, DB_HOST,DB_PORT, DB_DATABASE, DB_USERNAME e DB_PASSWORD.

Rode o comando: composer install

Rode o comando: php artisan migrate

Rode o comando: php artisan serve

### Usando as Rotas

## /api/produto (GET POST e UPDATE)

#### Parametros esperados: 

- codigo*
- nome*
- descricao*
- vlr_venda*
- link

## /api/compra (GET e POST)

#### Parametros esperados: 

- dt_compra*
- cod_produto*
- qtd_prod_compra*

## /api/venda (GET e POST)

#### Parametros esperados: 


- dt_venda*
- nome*
- cpf*
- email
- cod_produto*
- qtd_prod_venda*
- (O valor total é preenchido automaticamente)


## /api/produtos-estoque (GET)

### OBS:

#####   Em caso de duvidas, estarei a disposição!
