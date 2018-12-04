#!/bin/bash

#scp the rollback package to destination


cd /var/temp

# $1 is filename

#delete contents first
ssh karan@192.168.1.6 'rm -rf *'

#send new rollback version
pv $1 | ssh part@192.168.1.6 'cat | tar xz --strip-components=1 -C *'
