# Sistema de Gestão de Igreja (SGI)

[![Full CI/CD](https://github.com/mafpbiaggi/sgi/actions/workflows/push_main.yml/badge.svg?branch=main)](https://github.com/mafpbiaggi/sgi/actions/workflows/push_main.yml)
[![Release](https://img.shields.io/badge/Release-v2.0.0-blue)](https://github.com/mafpbiaggi/sgi/releases/tag/v2.0.0)
[![Imagem Docker](https://img.shields.io/badge/Imagem%20Docker-v2.0.0-orange)](https://github.com/mafpbiaggi/sgi/pkgs/container/sgi)

Este repositório contém o Sistema de Gestão da Igreja (SGI). O projeto foi iniciado como um fork do sistema [NFChurch](https://github.com/nfservice/NFChurchWeb) até a versão 1.4.1, sendo adaptado e mantido pela Igreja Presbiteriana de Vila Prudente (IPVP) para uso interno e operacional.

Um novo sistema foi desenvolvido à partir da versão 2.0.0. Verifique o CHANGELOG.md para mais informações.

## Objetivo

Ele foi criado para centralizar informações e processos administrativos, incluindo cadastros, acompanhamento de membros, registros de eventos, controle de usuários e a organização de rotinas internas da igreja.

## Estrutura do projeto

```text
sgi/
├── .github/                 # Workflows e configurações de CI/CD do GitHub
├── build/                   # Código da aplicação e bibliotecas do framework
├── docker/                  # Arquivos de conteinerização
|   ├── .env.examples        # Exemplo de variáveis de ambiente usadas pelo docker-compose
|   ├── Dockerfile           
│   └── docker-compose.yaml  # Configuração do ambiente com Docker
├── docs/                    # Documentação auxiliar do projeto
├── tests/                   # Scripts de verificação e checagem de saúde
├── .gitignore               # Arquivos ignorados pelo Git
├── CHANGELOG.md             # Histórico de mudanças do projeto
└── README.md                # Documentação principal do repositório
```

A estrutura foi organizada para separar a aplicação, os artefatos de infraestrutura, e os scripts de implantação, facilitando manutenção e colaboração no projeto.

## Documentação auxiliar

- [Visão geral do SGI](docs/Sgi.md): módulos, estrutura da aplicação e execução dos contêineres.
- [Workflows de CI/CD](docs/Workflows.md): descrição dos fluxos automatizados do GitHub Actions.
