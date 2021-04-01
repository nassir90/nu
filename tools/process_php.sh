#!/bin/bash
for file in $(find template | grep php); do
	output=$(echo $file | sed s/.php/.html/ | sed s/template/output/);
	echo "Building $file at $output"
	php $file > $output;
done
