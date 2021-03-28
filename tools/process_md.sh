#!/bin/bash

for file in `find template | grep .md` ; do
	create $file.html -s "/simple.css"
	html_name=${file%.md}.html
	mv $file.html ${html_name/template/output}
done
