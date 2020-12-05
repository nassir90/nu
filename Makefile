php: folders
	php ./template/index.php > ./output/index.html
	php ./template/flashcardsets/acidsandbases.php > ./output/flashcardsets/acidsandbases.html
	cp ./template/style.css ./output/style.css

folders:
	mkdir -p ./output
	mkdir -p ./output/flashcardsets

clean:
	rm ./output/* -R
	
