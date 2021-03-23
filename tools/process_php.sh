#!/bin/bash
for file in $(find template | grep php); do
	output=$(echo $(echo $file | sed s/.php/.html/) | sed s/template/output/g);
	echo "Building $file at $output"
	php $file > $output;
done
