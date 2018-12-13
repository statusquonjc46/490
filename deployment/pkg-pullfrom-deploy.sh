#!/bin/bash
#This is the script that QA and Prod will use to pull from deployment.
#We need to figure out version control.
#this pulls package and then untars it to git/490
echo "Attempting to make and SCP Connection to the deployment server: ";
sshpass -f '~/git/490/sshpass.txt' scp -r test1@192.168.2.2:~/html.tar ~/git/490
echo "Connected to Deployment.";
echo "Untaring files from Deployment: ";
tar -C ~/490/490/ -xvf ~/Desktop/html.tar
echo "Files unzipped and installed successfully.";
