default: media php html md

free: default
	./tools/remove_banner.sh

md: folders
	./tools/process_md.sh

html: folders
	./tools/move_html_files.sh

php: folders
	./tools/process_php.sh
	mv ./output/simple.html ./output/simple.css
	mv ./output/style.html ./output/style.css

media: folders
	cp ./template/media ./output/ -R
	

package: default
	./tools/package.sh

upload: free
	lftp nazalvfv@files.000webhost.com

folders:
	mkdir -p `find template/ -type d | sed 's/template/output/g'`

clean:
	rm ./output -R
	
