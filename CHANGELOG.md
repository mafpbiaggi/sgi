# Changelog

Todas as alterações relevantes deste projeto serão documentadas neste arquivo. O formato baseia-se no [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), e este projeto segue o [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [v1.3.0]

### Adicionado
- Script `db_container_status.sh` para verificação específica do
container de banco de dados

### Alterado
- Separa verificação de container de banco e aplicação no workflow de
testes
- Renomeia scripts de verificação para nomenclatura mais descritiva
(`app_container_status.sh`, `app_health_check.sh`)

## [v1.2.0]

### Adicionado
- Sistema de histórico de movimentações de membros
  - Cria tabelas `historico_membros` e `movimentacao_historico`
  - Registra automaticamente mudanças de tipo (Comungante/Não comungante)
  - Exibe histórico de movimentações na view de edição de membros
  - Armazena usuário responsável e data da alteração
- Campos de ordem e ata de admissão/demissão nos formulários de membros
  - Adiciona campos `ordemadmissao`, `ataadmissao` e `atademissao`
  - Exibe número de ordem de admissão na listagem de membros (index)
  - Toggle JavaScript para campo `atademissao` em membros inúmeros

### Corrigido
- Ortografia na mensagem de exceção de membro inválido
- Inconsistência nos IDs de usuários, churchs e permissões no schema
- Criação de usuário com `church_id` NULL no método `add()`

### Alterado
- Substitui campo `ativo` por `situacao` para melhor clareza
- Campo `tipo` de ENUM para INT
- Remove aba "Não Comungantes" da listagem na view index
- Padroniza uso de `empty` nos selects de formulários de membros

### Removido
- Condição de exibição de membros no model

## [v1.0.1]

### Adicinoado
- Variável para utilização de imagem no arquivo .env.examples

### Corrigido
- Definição da imagem usada pelo docker-compose.yaml

## [v1.0.0]

### Adicionado
- Adiciona pipeline de CI/CD com GitHub Actions:
  - pull_request.yml: Validação de PRs (build, scan, test)
  - push_main.yml: CI/CD completo para branch main (build, scan, test, publish e release)
  - changes.yml: Filtro para detectar mudanças em app/** e docker/**
  - build.yml: Build da imagem Docker a partir do diretório build/
  - scan.yml: Scanner de vulnerabilidades com Trivy
  - test.yml: Testes de integração com container e verificação de estado da aplicação
  - publish.yml: Publica imagem no GitHub Container Registry
  - release.yml: Criação automática de releases baseado no CHANGELOG.md

## [v1.0.0-beta]

### Adicionado
- Adiciona campo 'nomeconjuge' no módulo Membros (2026-01-14)
- Adiciona campos no módulo Membros (2026-01-14)
- Adiciona campos no módulo Membros (2026-01-14)
- Adiciona campo 'Motivo Demissão' no módulo Membros (2025-11-14)
- Adiciona situação "Separados" para membros em Rol Separado (2025-10-21)
- Adiciona serviço de validação e sanitização de dados (2026-06-16)
- Adiciona deploy contínuo (2026-06-02)
- Adiciona estrutura para schema.sql em branco (2026-03-11)
- Adiciona lista de presença - módulo Relatórios (2025-11-18)
- Cria diretório para receber arquivos de infraestrutura (containers docker) (2026-02-27)
- Cria estrutura inicial do projeto (2025-10-21)

### Corrigido
- Corrige carregamento de scripts .js na view de edição de membros (2026-08-31)
- Corrige o preenchimento de cargo enquanto não definido (2025-11-14)
- Corrige mensagem quando não há nenhum registro no banco (atas) (2025-10-21)
- Corrige campo de busca para cada view/controller (2025-10-21)
- Corrige arquivo .gitignore (2025-10-21)

### Alterado
- Refatora função index para reaproveitar condições de busca (2026-08-26)
- Reorganiza o layout dos campos para melhorar usabilidade (2026-08-26)
- Atualiza formulários de visitantes (2026-06-02)
- Melhora utilização de scripts js na view membros (2026-03-17)
- Atualiza schema.sql com novos campos na tabela visitantes (2026-03-12)
- Atualiza schema.sql com tabela visitantes (2026-03-11)
- Altera coleta de dados para conexão com banco (2026-03-11)
- Atualiza .gitignore considerando arquivo de variáveis de ambiente (2026-02-27)
- Separação dos campos 'Batizado e Profissão de Fé' (2025-11-14)
- Atualiza situação dos membros para Comungantes, Não Comungantes, Rol Separado, Demitidos (2025-11-14)
- Atualiza situação dos membros para (Comungantes, Não Comungantes, Separados e Excluídos) (2025-11-05)
- Não sincroniza arquivos de perfis e atas com o github (2025-10-21)
- Alteração de tamanho de fonte na view edit para 'Arquivos da Ata' (2025-10-21)
- Atualização de botão 'Remover Filtros' (2025-10-21)
- Alteração do campo de filtro 'Ativo' para 'Situação' (2025-11-14)
- Atualização de função de busca, considerando membros com situação diferente (2025-10-21)
- Atualização do arquivo .gitignore (2025-10-21)

## Removido
- Remove campos de adição de parente/relacionamento das views de membros (2026-08-26)
- Remove função search não utilizada e arquivos órfãos (2026-08-26)
- Remove função teste de botão (2025-11-14)
- Remoção de movimentação de membros nas atas (2025-10-21)
- Remoção de comentários dispensáveis no controller de atas (2025-10-21)

[Unreleased]: https://github.com/mafpbiaggi/sgi/compare/1.0.0...HEAD
[v1.0.0-beta]: https://github.com/mafpbiaggi/sgi/releases/tag/v1.0.0-beta
[v1.0.0]: https://github.com/mafpbiaggi/sgi/releases/tag/v1.0.0
[v1.0.1]: https://github.com/mafpbiaggi/sgi/releases/tag/v1.0.1
[v1.2.0]: https://github.com/mafpbiaggi/sgi/releases/tag/v1.2.0
[v1.3.0]: https://github.com/mafpbiaggi/sgi/releases/tag/v1.3.0
