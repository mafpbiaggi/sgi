# Workflows de CI/CD

Os workflows abaixo são executados pelo GitHub Actions.

## Fluxos principais

### Validação de pull request

O workflow [`pull_request.yml`](../.github/workflows/pull_request.yml) é acionado em pull requests para qualquer branch quando há alterações em `build/**` ou `docker/Dockerfile`. Execuções anteriores do mesmo pull request são canceladas quando uma nova execução começa.

Os jobs são encadeados nesta ordem:

1. **Integration test:** executa a suíte de testes da aplicação.
2. **Build:** cria a imagem Docker e a disponibiliza como artefato temporário.
3. **Scan:** analisa a imagem criada em busca de vulnerabilidades.
4. **Environment test:** inicia a imagem com o banco de dados e valida a disponibilidade da aplicação.

O fluxo valida a imagem, mas não publica imagens nem cria releases.

### Integração contínua e publicação na branch principal

O workflow [`push_main.yml`](../.github/workflows/push_main.yml) é acionado em pushes para `main` quando há alterações em `build/**`, `docker/Dockerfile` ou `CHANGELOG.md`.

Ele começa pelo workflow [`changes.yml`](../.github/workflows/changes.yml), que verifica se houve alterações em `build/**` ou `docker/Dockerfile`. Quando essas alterações são detectadas, a sequência executa testes de integração, build, análise de vulnerabilidades e teste da imagem em contêineres, antes da publicação. O job de release também pode ser acionado por uma alteração apenas no `CHANGELOG.md`: nesse caso, ele tenta localizar a imagem correspondente à versão registrada em `build/VERSION`.

1. **Publish:** publica a imagem no GitHub Container Registry (GHCR) com a versão definida em `build/VERSION` e com a tag `latest`, quando o build é executado.
2. **Release:** se a execução não foi cancelada nem falhou, verifica se a release correspondente à versão indicada no `CHANGELOG.md` já existe e, se não existir, cria uma release no GitHub com informações da imagem.

Quando os dados da imagem não são recebidos do job de publicação, o workflow de release tenta obter a referência da imagem publicada usando a versão de `build/VERSION`.

## Workflows reutilizáveis

| Workflow | Responsabilidade |
| --- | --- |
| [`integration_test.yml`](../.github/workflows/integration_test.yml) | Instala dependências PHP e Node, prepara a aplicação Laravel e executa `php artisan test`. Também pode ser iniciado manualmente. |
| [`build.yml`](../.github/workflows/build.yml) | Obtém a versão de `build/VERSION`, constrói a imagem usando `build/` e `docker/Dockerfile` e a envia como artefato temporário. |
| [`changes.yml`](../.github/workflows/changes.yml) | Identifica alterações em `build/**` e `docker/Dockerfile` para o fluxo da branch principal. |
| [`scan.yml`](../.github/workflows/scan.yml) | Executa o Trivy na imagem e apresenta vulnerabilidades de severidade `CRITICAL` e `HIGH`, ignorando as que ainda não têm correção disponível. A configuração `exit-code: 0` faz com que os achados, por si só, não reprovem o job. Pode ser iniciado manualmente. |
| [`environment_test.yml`](../.github/workflows/environment_test.yml) | Carrega ou obtém uma imagem, inicia a aplicação e o MariaDB com Docker Compose, valida a saúde dos contêineres e do endpoint e remove os contêineres de teste. Pode ser iniciado manualmente. |
| [`publish.yml`](../.github/workflows/publish.yml) | Publica no GHCR a imagem recebida como artefato, usando as tags da versão e `latest`. |
| [`release.yml`](../.github/workflows/release.yml) | Obtém a versão do `CHANGELOG.md`, evita criar uma release duplicada e, quando necessário, cria uma release do GitHub com a referência da imagem. |

## Acionamento manual

Os workflows de teste de integração, análise de imagem e teste do ambiente oferecem acionamento manual (`workflow_dispatch`). Para análise e teste de ambiente, é possível informar a imagem; quando não informada, a configuração usa a imagem `latest` do GHCR.
