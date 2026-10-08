# Sistema de Gestão de Igreja (SGI)

[![Full CI/CD](https://github.com/mafpbiaggi/sgi/actions/workflows/push_main.yml/badge.svg?branch=main)](https://github.com/mafpbiaggi/sgi/actions/workflows/push_main.yml)
[![Release](https://img.shields.io/badge/Release-v1.3.0-blue)](https://github.com/mafpbiaggi/dokuwiki/releases/tag/v1.3.0)
![Imagem Docker](https://img.shields.io/badge/Imagem%20Docker-2026--10--08-orange)

Este repositório contém o Sistema de Gestão da Igreja (SGI). O projeto é um fork do sistema [NFChurch](https://github.com/nfservice/NFChurchWeb), adaptado e mantido pela Igreja Presbiteriana de Vila Prudente (IPVP) para uso interno e operacional.

## Objetivo

Ele foi criado para centralizar informações e processos administrativos, incluindo cadastros, acompanhamento de membros, registros de eventos, controle de usuários e a organização de rotinas internas da igreja.

## Estrutura do projeto

```text
sgi/
├── .github/                 # Workflows e configurações de CI/CD do GitHub
├── build/                   # Código da aplicação e bibliotecas do framework
├── docker/                  # Arquivos de containerização
|   ├── .env.examples        # Exemplo de variáveis de ambiente usadas pelo docker-compose
|   ├── Dockerfile           
│   └── docker-compose.yaml  # Configuração do ambiente com Docker
├── schema/                  # Esquemas do banco de dados
├── tests/                   # Scripts de verificação e checagem de saúde
├── .gitignore               # Arquivos ignorados pelo Git
├── CHANGELOG.md             # Histórico de mudanças do projeto
└── README.md                # Documentação principal do repositório
```

A estrutura foi organizada para separar a aplicação, os artefatos de infraestrutura, os scripts de implantação e os arquivos de banco de dados, facilitando manutenção e colaboração no projeto.
