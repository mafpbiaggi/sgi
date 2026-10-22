#!/bin/sh
set -e

# =============================================================================
# SGI - Docker Entrypoint
# Executado antes do Apache iniciar. Realiza bootstrap do Laravel.
# =============================================================================

echo "[entrypoint] Iniciando "${APP_NAME}"..."

# ---------------------------------------------------------------------------
# Verifica se APP_KEY está definida (obrigatória em produção)
# ---------------------------------------------------------------------------
if [ -z "${APP_KEY}" ]; then
    echo "ERRO: APP_KEY não está definida. Gere uma com: php artisan key:generate --show"
    exit 1
fi

# ---------------------------------------------------------------------------
# Cria o arquivo .env a partir das variáveis de ambiente do container
# (evita manter .env no repositório)
# ---------------------------------------------------------------------------
if [ ! -f /var/www/html/.env ]; then
    echo "[entrypoint] Criando .env a partir das variáveis de ambiente..."
    cat > /var/www/html/.env << EOF
APP_NAME=${APP_NAME:-SGI}
APP_ENV=${APP_ENV:-production}
APP_KEY=${APP_KEY}
APP_DEBUG=${APP_DEBUG:-false}
APP_URL=${APP_URL:-}

APP_LOCALE=${APP_LOCALE:-en}
APP_FALLBACK_LOCALE=${APP_FALLBACK_LOCALE:-en}
APP_FAKER_LOCALE=${APP_FAKER_LOCALE:-en_US}
APP_TIMEZONE=${APP_TIMEZONE:-America/Sao_Paulo}

LOG_CHANNEL=${LOG_CHANNEL:-stderr}
LOG_LEVEL=${LOG_LEVEL:-error}

DB_CONNECTION=${DB_CONNECTION:-mariadb}
DB_HOST=${DB_HOST:-}
DB_PORT=${DB_PORT:-3306}
DB_DATABASE=${DB_DATABASE:-}
DB_USERNAME=${DB_USERNAME:-}
DB_PASSWORD=${DB_PASSWORD:-}

SESSION_DRIVER=${SESSION_DRIVER:-database}
SESSION_LIFETIME=${SESSION_LIFETIME:-120}
SESSION_ENCRYPT=${SESSION_ENCRYPT:-true}

CACHE_STORE=${CACHE_STORE:-database}
QUEUE_CONNECTION=${QUEUE_CONNECTION:-database}

BCRYPT_ROUNDS=${BCRYPT_ROUNDS:-12}

MAIL_MAILER=${MAIL_MAILER:-log}
MAIL_HOST=${MAIL_HOST:-}
MAIL_PORT=${MAIL_PORT:-587}
MAIL_USERNAME=${MAIL_USERNAME:-}
MAIL_PASSWORD=${MAIL_PASSWORD:-}
MAIL_FROM_ADDRESS=${MAIL_FROM_ADDRESS:-noreply@example.com}
MAIL_FROM_NAME=${MAIL_FROM_NAME:-SGI}
EOF
fi

# ---------------------------------------------------------------------------
# Executa migrations (apenas novas, não recria tabelas existentes)
# ---------------------------------------------------------------------------
echo "[entrypoint] Executando migrations..."
php artisan migrate --force --no-interaction

# ---------------------------------------------------------------------------
# Otimizações de cache do Laravel para produção
# ---------------------------------------------------------------------------
echo "[entrypoint] Gerando caches de produção..."
php artisan config:cache
php artisan route:cache
php artisan event:cache

echo "[entrypoint] Bootstrap concluído. Iniciando Apache..."

# Executa o comando passado (apache2-foreground)
exec "$@"