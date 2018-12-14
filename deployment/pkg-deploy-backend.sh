#!/bin/bash
#This is the tar creation script for the backend, or everything else.
#Creates a tar file of the 490 folder from our git
#Places the tar file on the desktop, then SCPs it to deploy and places it on the deployments desktop.
echo "Creating Tar File:";
tar -cvf ~/Desktop/html.tar --directory=/home/njc46/490/ 490
echo "Tar created. Attempting SCP Connection: ";
sshpass -f '~/git/490/sshpass.txt' scp -r ~/Desktop/html.tar test1@192.168.2.194:~/
echo "Connected to Deploy. Trasnferring tar files.";


#WE STILL NEED TO ADD VERSION STATUS TO THE TAR NAMES.
