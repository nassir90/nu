#!/bin/bash

for file in `find template -type f -name '*.md'` ; do
	html_name=${file%.md}.html
	create $file -s $(resolve-simple.zsh -p $file) -o ${html_name/template/output}
done
