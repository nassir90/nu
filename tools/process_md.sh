#!/bin/bash

for file in `find template | grep .md` ; do
	create $file.html -s "/simple.css"
	html_name=${file%%.md}.html
	mv $html_name ${html_name/template/output}
done
