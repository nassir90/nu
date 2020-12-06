php: folders
	php ./template/index.php > ./output/index.html
	php ./template/notes/
	php ./template/notes/chemistry/acidsandbases.php > ./output/notes/chemistry/acidsandbases.html
	php ./template/notes/irish/caitlinmaude.php > ./output/notes/irish/caitlinmaude.html
	php ./template/style.php > ./output/style.css

folders:
	mkdir -p ./output
	mkdir -p ./output/notes/irish
	mkdir -p ./output/notes/chemistry

clean:
	rm ./output/* -R
	
