# Changelog

Todas as alterações relevantes deste projeto serão documentadas neste arquivo. O formato baseia-se no [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), e este projeto segue o [Semantic Versioning](https://semver.org/spec/v2.0.0.html).
  
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
