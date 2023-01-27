#!/bin/zsh

getopts "p" option && only_print=1 && shift 1

# Finds an unbroken string starting and ending with "" containing
# 'simple.css'. It then replaces that link with the relative location
# of simple.css in the project root relativises the simple.css. This
# means that the site works with raw files as well as when being
# hosted in a server.
file=${1:-/dev/stdin}
target=$HOME/projects/nu/${2:-template}

# E.g. ../../simple.css for the file chemistry/project/index.php
relative_location=$(realpath $target --relative-to `dirname $file`)/simple.css
[ $only_print ] && echo $relative_location && exit

# Replace the aforemenioned string link containing simple.css
sed 's/\("[^"]*simple.css[^"]*"\|'"'[^']*simple.css[^']*'"'\)/'"\"${relative_location//\//\\/}\"/" $file
