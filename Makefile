default: media php html md

md: folders
	PATH+=:./tools ./tools/process_md.sh

html: folders
	./tools/move_html_files.sh
	./template/french/vocab/make_tables -d template/french/vocab/Mock -o output/french/vocab/index.html

php: folders
	PATH+=:./tools && ./tools/process_php.sh
	mv ./output/simple.{html,css}
	mv ./output/style.{html,css}

media: folders
	cp ./template/media ./output/ -R

package: default
	./tools/package.sh

folders:
	mkdir -p `find template/ -type d | sed 's/template/output/g'`

clean:
	rm ./output -R
