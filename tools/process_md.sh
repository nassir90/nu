#!/bin/bash

for file in `find template | grep .md` ; do
	html_name=${file%.md}.html
	create $file -s '/simple.css' -o ${html_name/template/output}
done
