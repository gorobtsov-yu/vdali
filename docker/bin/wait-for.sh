#!/bin/sh

TIMEOUT=30
HOST=$1
PORT=$2
shift 2
CMD="$@"

echo "WAIT FOR: $HOST:$PORT"

i=1
while [ $i -le $TIMEOUT ]; do
    nc -z $HOST $PORT > /dev/null 2>&1
    result=$?
    if [ $result -eq 0 ]; then
        echo "WAIT FOR: $HOST:$PORT connected."
        exec $CMD
        exit 0
    fi
    echo -n "."
    sleep 1
    i=$((i + 1))
done

echo "WAIT FOR: $HOST:$PORT not connected after $TIMEOUT seconds."
exit 1