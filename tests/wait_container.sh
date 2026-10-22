#!/bin/bash
set -euo pipefail

CONTAINER="${1:-}"
MAX_ATTEMPTS="${2:-10}"
INTERVAL="${3:-5}"

if [[ -z "$CONTAINER" ]]; then
    echo "Usage: $0 <container_name> [max_attempts] [interval_seconds]"
    exit 1
fi

for ((i = 1; i <= MAX_ATTEMPTS; i++)); do
    STATUS="$(docker inspect --format '{{.State.Status}}' "$CONTAINER" 2>/dev/null || true)"
    HEALTH="$(docker inspect --format '{{.State.Health.Status}}' "$CONTAINER" 2>/dev/null || true)"

    if [[ "$STATUS" == "running" && "$HEALTH" == "healthy" ]]; then
        echo "[SUCCESS] Container '${CONTAINER}' is running and healthy."
        exit 0
    fi

    echo "[WAITING] '${CONTAINER}': status=${STATUS:-unknown}, health=${HEALTH:-none} (attempt ${i}/${MAX_ATTEMPTS})"
    sleep "$INTERVAL"
done

echo "[ERROR] Container '${CONTAINER}' did not become healthy."
echo "--------------------------------------------------------------------"
docker logs --tail 100 "$CONTAINER" 2>&1 || true
echo "--------------------------------------------------------------------"
docker inspect --format '{{json .State.Health}}' "$CONTAINER" 2>/dev/null || true
exit 
