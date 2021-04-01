#!/bin/bash

for file in `find template | grep '\.html$'`;
do
	cp $file ${file/template/output}
done

