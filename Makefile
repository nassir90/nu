export PATH := $(PATH):./tools
DESTDIR := ./output
HTML := $(shell find template -name '*.html' -printf '%P\n') \
	$(patsubst %.php,%.html,$(shell find template -name '*.php' -printf '%P\n')) \
	$(patsubst %.md,%.html,$(shell find template -name '*.md' -printf '%P\n'))
CSS := $(patsubst %.php,%,$(shell find template -name '*.css.php' -printf '%P\n'))
FOLDERS := $(shell find template/ -type d -printf '$(DESTDIR)/%P\n')

default: $(FOLDERS) media $(addprefix $(DESTDIR)/,$(HTML)) $(addprefix $(DESTDIR)/,$(CSS))
	./template/french/vocab/make_tables -d template/french/vocab/Mock -o $(DESTDIR)/french/vocab/index.html

$(DESTDIR)/%.css: template/%.css.php | $(FOLDERS)
	php $< > $@

$(DESTDIR)/%.html: template/%.md | $(FOLDERS)
	create $< -s $$(resolve-simple.zsh -p $<) -o $@

$(DESTDIR)/%.html: template/%.html | $(FOLDERS)
	cp $< $@

$(DESTDIR)/%.html: template/%.php | $(FOLDERS)
	php $< > $@.tmp
	resolve-simple.zsh $@.tmp output > $@
	rm $@.tmp

media: | $(FOLDERS)
	cp ./template/media $(DESTDIR)/ -R

$(FOLDERS):
	mkdir -p $@

clean:
	rm $(DESTDIR) -R

