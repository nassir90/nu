#!/bin/bash
for file in $(find template -name '*.php'); do
	output=$(echo ${file%.php}.html | sed s/template/output/);
	echo "Building $file at $output"
	resolve-simple.zsh $file | php > $output;
done
