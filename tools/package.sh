#!/bin/bash
mkdir -p packages
package="nazauzoukwu_`date '+%d-%m-%y'`.tar"
tar cf $package ./template ./php/ ./tools/ ./Makefile ./README.md
mv $package ./packages/
