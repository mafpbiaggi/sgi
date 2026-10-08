#!/bin/bash

CONTAINER=$1
if [[ -z $CONTAINER ]]; then
    echo "Usage: db_container_status.sh <container_name>"
    exit 1
fi

for i in {1..10}; do
    STATUS=$(docker inspect --format='{{ .State.Status }}' $CONTAINER)
    if [ "$STATUS" == "running" ]; then
        SERVICE=$(docker logs -n2 $CONTAINER 2>&1 | grep "ready for connections")
        if [[ ! -z $SERVICE ]]; then
            echo "[SUCCESS] Container '${CONTAINER}' is running."
            exit 0
        fi
    fi
    echo "Waiting for container... attempt $i"
    sleep 5
done
echo "[ERROR] Container '${CONTAINER}' status check failed."
echo "--------------------------------------------------------------------"
docker logs ${CONTAINER}
echo "--------------------------------------------------------------------"
exit 1
