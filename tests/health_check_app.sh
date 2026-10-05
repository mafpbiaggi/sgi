#!/bin/bash
set -euo pipefail

URL="http://localhost/users/login"
for i in {1..20}; do
    if [[ $(curl -fs -I --max-time 5 "$URL" | grep "^HTTP") == *"200"* ]]; then
        echo "[SUCCESS] HTTP endpoint validated successfully."
        exit 0
    fi
    echo "Waiting for application... attempt $i"
    sleep 3
done
echo "[ERROR] HTTP health check failed on $URL."
exit 1
