#!/bin/bash

sshpass -p '1password1' scp -r  test1@192.168.1.115:~/Desktop/html$1.tar ~/git/versions/frontend
