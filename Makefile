default: folders media php md

free: default
	./tools/remove_banner.sh

md: folders
	./tools/process_md.sh

php: folders
	./tools/process_php.sh
	mv ./output/simple.html ./output/simple.css
	mv ./output/style.html ./output/style.css

media: folders
	cp ./template/media ./output/ -R
	
folders:
	mkdir -p ./output
	mkdir -p ./output/irish
	mkdir -p ./output/outthere
	mkdir -p ./output/physics
	mkdir -p ./output/chemistry
	mkdir -p ./output/games
	mkdir -p ./output/appliedmaths

package: default
	./tools/package.sh

upload: free
	lftp nazalvfv@files.000webhost.com

clean:
	rm ./output -R
	
