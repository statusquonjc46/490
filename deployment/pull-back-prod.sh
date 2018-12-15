#1/bin/bash

sshpass -p '1password1' scp -r  ~/git/backend$1.tar test1@192.168.1.145:~/git/

sshpass -p '1password1' ssh test1@192.168.1.145 "cd /home/test1/git; tar -xvf backend$1.tar;"
