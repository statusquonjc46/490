#!/bin/bash
#this pushes packages out
scp -r/home/test1/test. test1@192.168.2.194:/home/test1/git/490/html/
#this pulls packages. Period after html pulls all the files within that dir.
#scp -r test1@192.168.2.2:/home/test1/git/490/html/. /home/test1/test
