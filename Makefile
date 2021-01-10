php: folders media outthere
	php ./template/index.php > ./output/index.html
	php ./template/flashcardapp.php > ./output/flashcardapp.html
	php ./template/notes/chemistry/acidsandbases.php > ./output/notes/chemistry/acidsandbases.html
	php ./template/notes/irish/caitlinmaude.php > ./output/notes/irish/caitlinmaude.html
	php ./template/style.php > ./output/style.css
	php ./template/notes/irish/hurlamboc.php > ./output/notes/irish/hurlamboc.html
	php ./template/simple.php > ./output/simple.css
	php ./template/physics/index.php > ./output/physics/index.html
	php ./template/physics/drop.php > ./output/physics/drop.html
	php ./template/physics/convex.php > ./output/physics/convex.html
	php ./template/chemistry/index.php > ./output/chemistry/index.html
	php ./template/chemistry/saponification.php > ./output/chemistry/saponification.html

outthere:
	mkdir -p ./output/outthere
	php ./template/outthere/breakout.php > ./output/outthere/breakout.html
	php ./template/outthere/maybe.php > ./output/outthere/maybe.html
	php ./template/outthere/message-vol.php > ./output/outthere/message-vol.html
	php ./template/outthere/sales.php > ./output/outthere/sales.html
	php ./template/outthere/breakout.php > ./output/outthere/breakout.html
	php ./template/outthere/index.php > ./output/outthere/index.html
	php ./template/outthere/MiltonJRosenau.php > ./output/outthere/MiltonJRosenau.html
	php ./template/outthere/trumpasgoldstein.php > ./output/outthere/trumpasgoldstein.html
	
media:
	cp ./template/media ./output/ -R

folders:
	mkdir -p ./output
	mkdir -p ./output/notes
	mkdir -p ./output/notes/irish
	mkdir -p ./output/notes/chemistry
	mkdir -p ./output/outthere
	mkdir -p ./output/physics
	mkdir -p ./output/chemistry

clean:
	rm ./output -R
	
