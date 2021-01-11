free: folders media php
	./remove_banner.sh

php: folders
	./process_php.sh

media: folders
	cp ./template/media ./output/ -R
	
folders:
	mkdir -p ./output
	mkdir -p ./output/notes
	mkdir -p ./output/notes/irish
	mkdir -p ./output/notes/chemistry
	mkdir -p ./output/outthere
	mkdir -p ./output/physics
	mkdir -p ./output/chemistry

package: free
	mkdir -p packages
	tar cf nazauzoukwu_`date "+%d_%m_%y"`.tar ./template ./preprocessing/ ./*.sh ./Makefile ./README.md

upload: free
	git add .
	EDITOR=nvim git commit
	git push
	ftp files.000webhost.com

clean:
	rm ./output -R
	
