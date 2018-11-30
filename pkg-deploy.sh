#!/bin/bash
#this pushes packages out
tar -cvf /home/njc46/490/490/html.tar /home/njc46/490/490/html
scp -r /home/njc46/490/490/html.tar test1@192.168.2.194:/home/njc46/
#this pulls packages. Period after html pulls all the files within that dir.
#scp -r test1@192.168.2.2:/home/njc46/html.tar /home/njc46
#tar -xvf /home/njc46/html.tar
