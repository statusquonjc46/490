#!/bin/bash
#Dev Machine A pull to server
scp -r test1@192.168.2.2:~/html.tar ~/git/490
tar -xvf ~/git/490/html.tar
#server to QA Machine A
scp -r test1@192.168.2.2:~/html.tar ~/git/490
tar -xvf ~/git/490/html.tar

#QA Machine A to server
#server to prod A

