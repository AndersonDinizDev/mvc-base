# API REST MVC em PHP 8.2.1 com Docker

Uma API REST moderna seguindo o padrão MVC e implementada com PHP 8.2.1, utilizando Docker para containerização. Este projeto adota boas práticas de desenvolvimento e se inspira na estrutura do Laravel, com um ambiente de desenvolvimento padronizado e isolado.

## Requisitos

- Docker e Docker Compose
- Git

## Stack Tecnológica

- **PHP 8.2.1** - Linguagem base
- **Docker** - Containerização e ambiente de desenvolvimento
- **Slim Framework** - Micro-framework para roteamento e middlewares
- **PHP-DI** - Container de injeção de dependências
- **Doctrine ORM** - Mapeamento objeto-relacional
- **Monolog** - Logging
- **Respect Validation** - Validação de dados
- **Firebase JWT** - Autenticação com tokens JWT
- **PHPUnit** - Testes
- **PostgreSQL** - Banco de dados

## Estrutura do Projeto

```
projeto/
├── app/                    # Código principal da aplicação
│   ├── Controllers/        # Controllers da aplicação
│   ├── Models/             # Models da aplicação
│   ├── Services/           # Camada de serviços (lógica de negócio)
│   ├── Repositories/       # Padrão Repository
│   ├── Exceptions/         # Exceptions personalizadas
│   ├── Middleware/         # Middlewares da aplicação
│   ├── Helpers/            # Funções auxiliares
│   └── Providers/          # Service providers
├── bootstrap/              # Arquivos de inicialização
│   └── app.php             # Bootstrap da aplicação
├── config/                 # Arquivos de configuração
│   ├── app.php             # Configurações gerais
│   ├── database.php        # Configurações do banco de dados
│   └── middleware.php      # Configurações de middleware
├── database/               # Migrações e seeds
│   ├── migrations/         # Migrações do banco de dados
│   └── seeds/              # Dados iniciais
├── docker/                 # Arquivos de configuração Docker
│   ├── nginx/              # Configurações do Nginx
│   └── php/                # Configurações do PHP
├── public/                 # Pasta pública (ponto de entrada)
│   ├── index.php           # Front controller - entrada da aplicação
│   └── .htaccess           # Configurações de reescrita de URL
├── resources/              # Recursos
│   └── views/              # Templates (se utilizar)
├── routes/                 # Definição de rotas
│   ├── api.php             # Rotas da API
├── storage/                # Armazenamento de logs, cache, etc
│   ├── logs/               # Logs da aplicação
│   └── cache/              # Cache da aplicação
├── tests/                  # Testes
│   ├── Unit/               # Testes unitários
│   └── Feature/            # Testes de feature/integração
├── vendor/                 # Pacotes do Composer (gerenciado pelo Composer)
├── .env                    # Variáveis de ambiente
├── .env.example            # Exemplo de variáveis de ambiente
├── .gitignore              # Arquivos ignorados pelo Git
├── composer.json           # Configuração do Composer
├── composer.lock           # Lock de dependências do Composer
├── docker-compose.yml      # Configuração do Docker Compose
├── Makefile                # Comandos make para facilitar operações
├── phpunit.xml             # Configuração do PHPUnit
└── README.md               # Documentação do projeto
```

## Instalação

1. Clone o repositório:

   ```bash
   git clone https://github.com/AndersonDinizDev/mvc-base
   cd mvc-base
   ```

2. Inicie o ambiente Docker:

   ```bash
   make up
   ```

3. Configure o banco de dados:
   ```bash
   # Dentro do container:
   php bin/migrations migrate  # Se estiver usando migrações
   ```

## Design Patterns Utilizados

- **MVC (Model-View-Controller)** - Separação de responsabilidades
- **Repository Pattern** - Abstração da camada de dados
- **Service Layer** - Lógica de negócios centralizada
- **Dependency Injection** - Injeção de dependências para acoplamento reduzido
- **Singleton** - Para instâncias compartilhadas (via DI container)
- **Factory** - Para criação de objetos complexos

## Middlewares

- **CORS Middleware** - Permite requisições cross-origin
- **JSON Response Middleware** - Garante formato JSON para todas as respostas
- **Authentication Middleware** - Protege rotas que exigem autenticação
- **Error Handling Middleware** - Captura e formata erros de forma consistente

## Autenticação

A API utiliza autenticação JWT (JSON Web Token):

- Tokens são gerados durante login/registro
- Tokens devem ser enviados no header `Authorization: Bearer {token}`
- Rotas protegidas verificam a validade do token automaticamente

## Validação de Dados

A validação de dados de entrada é feita usando Respect Validation:

- Validações são implementadas em Controllers ou Services
- Erros de validação retornam status HTTP 422 com detalhes específicos

## Comandos Docker (via Makefile)

```bash
# Iniciar o ambiente Docker
make up

# Parar os containers sem removê-los
make stop

# Iniciar containers parados
make start

# Acessar o shell do container
make container

# Reiniciar os containers
make restart

# Parar e remover os containers
make down

# Reconstruir as imagens
make build

# Ver logs em tempo real
make logs

# Listar containers em execução
make ps

# Limpar recursos Docker (containers, imagens, volumes, redes)
make docker-clean
```

## Comandos Úteis (dentro do container)

```bash
# Executar testes
./vendor/bin/phpunit

# Limpar cache
rm -rf storage/cache/*

# Criar nova migração (se estiver usando Doctrine Migrations)
./bin/migrations generate

# Verificar status das migrações
./bin/migrations status

# Executar migrações pendentes
./bin/migrations migrate
```

## Contribuição

1. Fork o projeto
2. Crie sua Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit suas alterações (`git commit -m 'Add some AmazingFeature'`)
4. Push para a Branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## Licença

Este projeto está licenciado sob a licença MIT - veja o arquivo LICENSE para mais detalhes.
