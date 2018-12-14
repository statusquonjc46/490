#!/bin/bash
#This is the front end tar creation. 
#Creates a Tar file of the html folder from our git.
#Puts it to the desktop, then SCPs the tar file to the desktop of the deployment server.
echo "Creating Tar File:";
tar -cvf ~/Desktop/html$1.tar --directory=/home/njc46/git/490/ html
echo "Tar created. Attempting SCP Connection: ";
sshpass -p '1password1' scp -r ~/Desktop/html$1.tar test1@192.168.1.136:~/
echo "Connected to Deploy. Trasnferring tar files.";

