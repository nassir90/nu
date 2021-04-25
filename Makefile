default: media php html md

md: folders
	./tools/process_md.sh

html: folders
	./tools/move_html_files.sh
	./template/french/vocab/make_tables -d template/french/vocab/Mock -o output/french/vocab/index.html

php: folders
	./tools/process_php.sh
	mv ./output/simple.html ./output/simple.css
	mv ./output/style.html ./output/style.css

media: folders
	cp ./template/media ./output/ -R

package: default
	./tools/package.sh

push: default
	git add .
	git commit
	git push

folders:
	mkdir -p `find template/ -type d | sed 's/template/output/g'`

clean:
	rm ./output -R
	
