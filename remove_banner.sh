#!/bin/bash
for file in $(find | grep "\./output/\S*\.html"); do
	echo $file;
	cat $file > ./temp_remove_banner;
	sed "s/<head>/<head><script>function remove_banner() { var banner = document.getElementsByTagName('div')[0]; banner.innerHTML = banner.style.zIndex > 100 ? \"\" : banner.innerHTML; } window.setTimeout(remove_banner, 400);<\/script>/" temp_remove_banner > $file;
done

rm temp_remove_banner
