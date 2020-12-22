php: folders
	php ./template/index.php > ./output/index.html
	php ./template/flashcardapp.php > ./output/flashcardapp.html
	php ./template/notes/
	php ./template/notes/chemistry/acidsandbases.php > ./output/notes/chemistry/acidsandbases.html
	php ./template/notes/irish/caitlinmaude.php > ./output/notes/irish/caitlinmaude.html
	php ./template/style.php > ./output/style.css
	php ./template/notes/irish/hurlamboc.php > ./output/notes/irish/hurlamboc.html
	php ./template/outthere/breakout.php > ./output/outthere/breakout.html
	php ./template/simple.php > ./output/simple.css
	php ./template/outthere/sales.php > ./output/outthere/sales.html
	php ./template/outthere/message-vol.php > ./output/outthere/message-vol.html
	cp ./template/outthere/MiltonJRosenau.txt ./output/outthere/MiltonJRosenau.txt

folders:
	mkdir -p ./output
	mkdir -p ./output/notes
	mkdir -p ./output/notes/irish
	mkdir -p ./output/notes/chemistry
	mkdir -p ./output/outthere

clean:
	rm ./output -R
	
