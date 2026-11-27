# Sistema de Gestão de Igreja (SGI)

O SGI é um sistema para apoiar a gestão administrativa de uma Igreja Presbiteriana do Brasil. Ele centraliza cadastros de membros e visitantes, administração de acessos e consulta de informações da igreja.

## Acesso e uso básico

O acesso ao sistema começa pela tela de login. Após autenticar-se, o usuário pode navegar pelo painel e pelos módulos disponíveis para sua conta. Para obter acesso ou ajuda com a conta, procure o responsável pela administração do sistema na igreja.

Os principais cadastros permitem consultar registros existentes e, conforme o acesso disponível, incluir, editar ou remover informações. O módulo de relatórios permite consultar dados de membros e gerar um arquivo PDF.

## Módulos

- **Painel:** ponto de entrada para as áreas do sistema.
- **Membros:** cadastro e manutenção dos registros de membros.
- **Visitantes:** cadastro e manutenção dos registros de visitantes.
- **Relatórios de membros:** consulta e geração de relatório de membros em PDF.
- **Usuários:** administração das contas de acesso.
- **Grupos e Permissões:** configuração das permissões associados ao acesso ao sistema.
- **Configurações pessoais:** atualização do perfil, da senha e da aparência da aplicação.

## Componentes de execução

A configuração em [`docker/docker-compose.yml`](../docker/docker-compose.yml) define dois serviços:

- **sgi_app:** aplicação web, publicada na porta definida por `PORT_MAPPING`.
- **sgi_db:** banco de dados MariaDB, com os dados persistidos no volume `sgi_db`.

Os serviços compartilham a rede `sgi`. A aplicação aguarda o banco de dados ficar saudável antes de iniciar, e sua disponibilidade é verificada pelo endpoint `/up`.

## Variáveis de ambiente (`.env`)

O projeto usa arquivos de ambiente em locais diferentes, conforme a etapa. Não existe um `.env` único que substitua os demais; os arquivos reais com valores locais ou segredos não devem ser enviados ao repositório.

| Etapa | Local do arquivo | Finalidade e exemplo |
| --- | --- | --- |
| Execução local da aplicação Laravel e testes de integração | `build/.env` | Configura o Laravel executado a partir de `build/`. Use [`build/.env.example`](../build/.env.example) como referência. O workflow de integração também copia esse exemplo para `build/.env` temporariamente e gera uma chave de teste. |
| Execução com Docker Compose | `docker/.env` | Deve ficar junto de `docker-compose.yml`. O Compose usa os valores para interpolar a imagem e a porta; o mesmo arquivo é passado ao contêiner `sgi_app` como variáveis de ambiente. Use [`docker/.env.example`](../docker/.env.example) como referência. |
| Aplicação dentro do contêiner | `/var/www/html/.env` | Arquivo interno do contêiner, criado pelo [`entrypoint.sh`](../build/build-utils/entrypoint.sh) a partir das variáveis de ambiente quando ainda não existe. Não é um arquivo para criar no repositório nem possui um exemplo separado. |

Nos workflows, os `.env` de teste são efêmeros: o workflow de integração cria `build/.env`, enquanto o teste de ambiente escreve `docker/.env`. Esses arquivos são preparados durante a execução e não precisam ser criados manualmente para uso do CI.

## Execução dos contêineres

O Compose usa a imagem indicada por `IMAGE_NAME`; ele não constrói a imagem. Antes de iniciar, crie `docker/.env` conforme a seção [Arquivos `.env` por etapa](#arquivos-env-por-etapa), preencha os valores necessários e garanta que a imagem indicada esteja disponível localmente ou possa ser obtida do registry.

Configure pelo menos:

- `IMAGE_NAME`: nome e tag da imagem SGI.
- `PORT_MAPPING`: porta disponível na máquina para acessar a aplicação.
- `APP_KEY`: chave da aplicação Laravel.
- `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` e `DB_ROOT_PASSWORD`: banco e credenciais do MariaDB.
- `DB_CONNECTION=mariadb`, `DB_HOST=sgi_db` e `DB_PORT=3306`: conexão da aplicação com o serviço do banco.

Mantenha as credenciais fora do controle de versão. Gere uma chave de aplicação com `php artisan key:generate --show` e informe o valor retornado em `APP_KEY`.

Com o arquivo de ambiente preenchido, execute a partir do diretório `docker/`:

```sh
docker compose up -d
docker compose ps
```

O serviço `sgi_db` usa MariaDB 12.2. As variáveis de banco configuram a inicialização do MariaDB quando o volume ainda está vazio; alterar esses valores não reconfigura um banco já persistido. O `sgi_app` só inicia depois que o health check do banco passar; em seguida, a aplicação executa seu entrypoint e o health check do app verifica `/up`. Acesse `http://localhost:<PORT_MAPPING>`, substituindo pelo valor configurado. Para parar os serviços sem apagar o banco, use `docker compose down`. Os dados permanecem no volume `sgi_db`; remover esse volume apaga os dados persistidos.

### Inicialização dos dados

Na primeira inicialização, o entrypoint aplica as migrations, mas não executa seeders. Para provisionar permissões e a conta master, execute cada seeder uma única vez após os contêineres iniciarem:

```sh
docker compose exec sgi_app php artisan db:seed --class=RolesAndPermissionsSeeder --force
docker compose exec sgi_app php artisan db:seed --class=DatabaseSeeder --force
```

`RolesAndPermissionsSeeder` cria as permissões padrão e o grupo `admin`, associando as permissões a esse grupo. `DatabaseSeeder` cria a conta master inicial; ele não chama o seeder de permissões nem deve ser executado novamente em um banco que já tenha essa conta. As credenciais iniciais estão definidas em [`DatabaseSeeder.php`](../build/database/seeders/DatabaseSeeder.php).

> Altere a senha após o primeiro acesso.

```text
Usuário: master@master
Senha: master
```

## Entrypoint da imagem Docker

O [`entrypoint.sh`](../build/build-utils/entrypoint.sh) é copiado para a imagem pelo [`Dockerfile`](../docker/Dockerfile) com permissão de execução e configurado como `ENTRYPOINT`. O Dockerfile o inclui durante a build da imagem; o script em si é executado quando um contêiner é iniciado, antes do Apache.

Na inicialização, o script:

1. Exige que `APP_KEY` esteja definida. Sem ela, encerra com erro antes de iniciar o serviço.
2. Cria `/var/www/html/.env` com variáveis disponíveis no contêiner e valores padrão, mas somente se o arquivo ainda não existir.
3. Executa `php artisan migrate --force --no-interaction` para aplicar migrations pendentes.
4. Gera os caches de configuração, rotas e eventos do Laravel.
5. Substitui o processo do entrypoint pelo comando recebido — na imagem atual, `apache2-foreground`.

O entrypoint não inicializa o serviço MariaDB, não aguarda nem tenta novamente uma conexão com o banco, não executa `db:seed` e não cria a conta master, grupos ou permissões. No Compose, a dependência com health check do banco controla a ordem de inicialização; os seeders precisam ser executados separadamente, conforme descrito acima. O script também não apaga os dados existentes nem recria tabelas já migradas.
