#1/bin/bash

sshpass -p '1password1' scp -r  ~/git/html$1.tar test1@192.168.1.115:~/git/

sshpass -p '1password1' ssh test1@192.168.1.115 "cd /home/test1/git; tar -xvf html$1.tar;"