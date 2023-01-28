export PATH := $(PATH):./tools
DESTDIR := ./output
HTML := $(shell find template -name '*.html' -printf '$(DESTDIR)/%P\n') \
	$(patsubst %.php,%.html,$(shell find template -name '*.php' -printf '$(DESTDIR)/%P\n')) \
	$(patsubst %.md,%.html,$(shell find template -name '*.md' -printf '$(DESTDIR)/%P\n'))
CSS := $(patsubst %.php,%,$(shell find template -name '*.css.php' -printf '$(DESTDIR)/%P\n'))
FOLDERS := $(shell find template/ -type d -printf '$(DESTDIR)/%P\n')
MEDIA := $(shell find template/media -type f -printf '$(DESTDIR)/media/%P\n')

default: $(FOLDERS) $(MEDIA) $(HTML) $(CSS)
	./template/french/vocab/make_tables -d template/french/vocab/Mock -o $(DESTDIR)/french/vocab/index.html.tmp
	resolve-simple.zsh $(DESTDIR)/french/vocab/index.html.tmp output > $(DESTDIR)/french/vocab/index.html
	rm $(DESTDIR)/french/vocab/index.html.tmp

$(DESTDIR)/%.css: template/%.css.php | $(FOLDERS)
	php $< > $@

$(DESTDIR)/%.html: template/%.md | $(FOLDERS)
	create $< -s $$(resolve-simple.zsh -p $<) -o $@

$(DESTDIR)/%.html: template/%.html | $(FOLDERS)
	resolve-simple.zsh $< > $@

$(DESTDIR)/%.html: template/%.php | $(FOLDERS)
	php $< > $@.tmp
	resolve-simple.zsh $@.tmp output > $@
	rm $@.tmp

$(DESTDIR)/media/%: template/media/%
	cp $< $@

$(FOLDERS):
	mkdir -p $@

clean:
	rm $(DESTDIR) -R

