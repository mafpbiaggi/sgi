#!/bin/bash
set -euo pipefail

PORT_MAPPING="${1:-80}"
URL="${2:-http://localhost:${PORT_MAPPING}/login}"
EXPECTED_STATUS="${3:-200}"
MAX_ATTEMPTS="${4:-20}"
INTERVAL="${5:-3}"

for ((i = 1; i <= MAX_ATTEMPTS; i++)); do
    RESPONSE="$(curl -sS -o /dev/null \
        -w '%{http_code} %{time_total}' \
        --max-time 5 \
        "$URL" 2>/dev/null || true)"

    STATUS="$(echo "$RESPONSE" | awk '{print $1}')"
    TIME="$(echo "$RESPONSE" | awk '{print $2}')"

    if [[ "$STATUS" == "$EXPECTED_STATUS" ]]; then
        echo "[SUCCESS] HTTP endpoint validated: ${URL}"
        echo "[INFO] Status: ${STATUS} | Total time: ${TIME}s"
        exit 0
    fi

    echo "[WAITING] ${URL}: status=${STATUS:-none}, time=${TIME:-0}s (attempt ${i}/${MAX_ATTEMPTS})"
    sleep "$INTERVAL"
done

echo "[ERROR] HTTP health check failed on ${URL}."
exit 1