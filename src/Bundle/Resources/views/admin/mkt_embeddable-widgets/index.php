<?php

declare(strict_types=1);

/** @var \Marktic\Embeddable\Widgets\AbstractWidget[] $widgets */
$widgets = $this->widgets;
$firstWidget = array_key_first($widgets);
?>
<ul class="nav nav-tabs flat-tabs" id="embeddableWidgets" role="tablist">
    <?php foreach ($widgets as $name => $widget) { ?>
        <li class="nav-item">
            <button class="nav-link <?= $name === $firstWidget ? 'active' : ''; ?>"
                    data-bs-toggle="tab" role="tab"
                    aria-controls="widget-<?= htmlspecialchars($name); ?>"
                    aria-selected="<?= $name === $firstWidget ? 'true' : 'false'; ?>"
                    id="<?= htmlspecialchars($name); ?>-tab"
                    data-bs-target="#widget-<?= htmlspecialchars($name); ?>"
                    type="button">
                <?= htmlspecialchars($widget->getLabel()); ?>
            </button>
        </li>
    <?php } ?>
</ul>

<div class="tab-content" id="embeddableWidgetsContent">
    <?php foreach ($widgets as $name => $widget) { ?>
        <?php
        $widgetURL = $widget->getUrl([]);
        $widgetHTML = $widget->getHtml();
        ?>
        <div class="tab-pane fade <?= $name === $firstWidget ? 'show active' : ''; ?>" role="tabpanel"
             id="widget-<?= htmlspecialchars($name); ?>"
             aria-labelledby="<?= htmlspecialchars($name); ?>-tab">
            <div class="row widget-builder" data-base-href="<?= htmlspecialchars($widgetURL); ?>">
                <div class="col-md-4 pt-6">
                    <div class="customize-widget">
                        <a href="<?= htmlspecialchars($widgetURL); ?>" target="_blank"
                           class="preview-btn float-end btn btn-xs btn-info">
                            Preview in new tab
                        </a>
                        <h3>Customize</h3>
                        <form class="py-6">
                            <?php foreach ($widget->getProperties() as $property) { ?>
                                <?= $property->renderInput(); ?>
                            <?php } ?>
                        </form>
                    </div>

                    <h6 class="mt-7">CODE</h6>
                    <div class="p-4 bg-light border embed-code">
                        <button class="float-end btn btn-xs btn-outline-primary copy-btn" type="button">Copy</button>
                        <pre style="height: 200px;white-space: pre-wrap;"><code><?= htmlentities($widgetHTML); ?></code></pre>
                    </div>
                </div>
                <div class="col-md-8 pt-6">
                    <div class="border rounded p-5 bg-light">
                        <h6 class="fs-6 fw-light text-muted">PREVIEW</h6>
                        <?= $widgetHTML; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<script type="text/javascript">
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
</script>
