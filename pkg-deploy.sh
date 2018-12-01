#!/bin/bash
#this pushes packages out and creates a tar places it on desktop and pushes it from desktop.
tar -cvf ~/Desktop/html.tar /home/njc46/490/490/html
scp -r ~/Desktop/html.tar test1@192.168.2.194:~/
#this pulls package and then untars it to git/490
#scp -r test1@192.168.2.2:~/html.tar ~/git/490
#tar -xvf ~/git/490/html.tar
