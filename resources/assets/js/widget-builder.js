/**
 * Embeddable Widget Builder
 *
 * Handles the admin widget builder UI: watches form changes, updates the
 * live iframe preview, refreshes the embed-code block, and copies code to clipboard.
 */
class WidgetBuilder {

    constructor(widget) {
        this.widget = widget;
        this.initialise();
    }

    initialise() {
        this.baseHref = this.widget.data('base-href');
        this.initPreviewBtn();
        this.initPreviewIframe();
        this.initForm();
        this.initCode();
    }

    initPreviewBtn() {
        this.previewBtn = this.widget.find('.preview-btn');
    }

    initPreviewIframe() {
        this.previewIframe = this.widget.find('iframe.embeddable-widget');
    }

    initForm() {
        this.form = this.widget.find('.customize-widget form');
        this.form.find(':input').on('change', this.observeFormChanged.bind(this));
    }

    initCode() {
        this.embedContainer = this.widget.find('.embed-code');
        this.codeContainer = this.embedContainer.find('pre code');

        this.codeBaseHtml = this.codeContainer.html().replace(
            new RegExp(this.escapeRegExp(this.baseHref), 'g'),
            ''
        );

        this.copyBtn = this.embedContainer.find('.copy-btn');
        this.copyBtn.on('click', function () {
            this.copyToClipboard(this.codeContainer.text());
        }.bind(this));
    }

    escapeRegExp(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }

    observeFormChanged() {
        const separator = this.baseHref.includes('?') ? '&' : '?';
        this.changeUrl(this.baseHref + separator + this.form.serialize());
    }

    changeUrl(url) {
        this.previewBtn.attr('href', url);
        this.previewIframe.attr('src', url);
        this.codeContainer.html(
            this.codeBaseHtml.replace('src=""', 'src="' + url + '"')
        );
    }

    copyToClipboard(text) {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text);
            return;
        }
        const textarea = document.createElement('textarea');
        document.body.appendChild(textarea);
        textarea.value = text;
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    $('.widget-builder').each(function () {
        new WidgetBuilder($(this));
    });
});
