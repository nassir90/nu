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
relative_location=$(realpath $target --relative-to `dirname $file`)
[ $only_print ] && echo $relative_location/simple.css && exit

# Replace the aforemenioned string link containing simple.css
awk -v single="'([^']*[.]css)'" \
    -v double='"([^"]*[.]css)"' \
    -v prefix=$relative_location \
    'function basename (str) { return gensub(".*/", "", "g", str) }
     match($0, single, m) { gsub(single, prefix "/" basename(m[1])) } \
     match($0, double, m) { gsub(double, prefix "/" basename(m[1])) }
     { print }' $file
