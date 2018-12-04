#!/bin/bash
#Dev Machine A pull to server
scp -r test1@192.168.2.2:~/html.tar ~/git/490
tar -xvf ~/git/4tar -cvf ~/Desktop/html.tar /home/njc46/490/490/html
#server to QA Machine A
tar -cvf ~/Desktop/html.tar /home/njc46/490/490/html
scp -r ~/Desktop/html.tar test1@192.168.2.194:~/
#QA Machine A to server
scp -r test1@192.168.2.194:~/html.tar ~/git/490
tar -xvf ~/git/4tar -cvf ~/Desktop/html.tar /home/njc46/490/490/html
#server to prod A

