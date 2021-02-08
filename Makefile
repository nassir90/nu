free: folders media php
	./remove_banner.sh

php: folders
	./process_php.sh
	mv ./output/simple.html ./output/simple.css
	mv ./output/style.html ./output/style.css

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
	mkdir -p ./output/games
	mkdir -p ./output/appliedmaths

package: free
	mkdir -p packages
	tar cf nazauzoukwu_`date "+%d_%m_%y"`.tar ./template ./preprocessing/ ./*.sh ./Makefile ./README.md

upload: free
	lftp nazalvfv@files.000webhost.com

clean:
	rm ./output -R
	
