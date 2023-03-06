#!bin/bash

PROJECT=$1
cd $PROJECT

wget -O ./snapshot.tag.lz4 https://snapshots.kjnodes.com/nolus-testnet/snapshot_latest.tar.lz4

if [ $? -eq 0 ]; then
    echo "Download success"
    mv ./snapshot.tag.lz4 ../public/snapshot/latest.tar.lz4
else
    echo "Download error"
fi
