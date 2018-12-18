#1/bin/bash

sshpass -p '1password1' scp -r  ~/git/versions/frontend/html$1.tar test1@192.168.1.115:~/git/490/html

sshpass -p '1password1' ssh test1@192.168.1.115 "cd /home/test1/git/490/; tar -xvf html$1.tar;"

sudo cp /home/test1/git/490/html /var/www/html/
