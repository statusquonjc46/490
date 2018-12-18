#1/bin/bash

sshpass -p '1password1' scp -r  ~/git/versions/backend/backend$1.tar test1@192.168.1.115:~/git/490

sshpass -p '1password1' ssh test1@192.168.1.115 "cd /home/test1/git/490; tar -xvf backend$1.tar;"
