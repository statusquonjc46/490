#!/bin/bash
#this pushes packages out and creates a tar places it on desktop and pushes it from desktop.
echo "Creating Tar File:";
tar -cvf ~/Desktop/html.tar --directory=/home/njc46/490/ 490
echo "Tar created. Attempting SCP Connection: ";
scp -r ~/Desktop/html.tar test1@192.168.2.194:~/
echo "Connected to Deploy. Trasnferring tar files.";

