php: folders
	php ./template/index.php > ./output/index.html
	php ./template/flashcardapp.php > ./output/flashcardapp.html
	php ./template/notes/
	php ./template/notes/chemistry/acidsandbases.php > ./output/notes/chemistry/acidsandbases.html
	php ./template/notes/irish/caitlinmaude.php > ./output/notes/irish/caitlinmaude.html
	php ./template/style.php > ./output/style.css
	php ./template/notes/irish/hurlamboc.php > ./output/notes/irish/hurlamboc.html
	php ./template/outthere/breakout.php > ./output/outthere/breakout.html

folders:
	mkdir -p ./output
	mkdir -p ./output/notes
	mkdir -p ./output/notes/irish
	mkdir -p ./output/notes/chemistry
	mkdir -p ./output/outthere

clean:
	rm ./output -R
	
