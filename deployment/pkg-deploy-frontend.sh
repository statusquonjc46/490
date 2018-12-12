#!/bin/bash
#This is the front end tar creation. 
#Creates a Tar file of the html folder from our git.
#Puts it to the desktop, then SCPs the tar file to the desktop of the deployment server.
echo "Creating Tar File:";
tar -cvf ~/Desktop/html.tar --directory=/home/njc46/490/490/ html
echo "Tar created. Attempting SCP Connection: ";
scp -r ~/Desktop/html.tar test1@192.168.2.194:~/
echo "Connected to Deploy. Trasnferring tar files.";

