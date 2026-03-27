<?php

declare(strict_types=1);

/** @var \Marktic\Embeddable\Widgets\WidgetsCollection|\Marktic\Embeddable\Widgets\AbstractWidget[] $widgets */
$widgetsArray = method_exists($widgets, 'toArray') ? $widgets->toArray() : (array) $widgets;
$firstWidget = array_key_first($widgetsArray);
?>
<ul class="nav nav-tabs flat-tabs" id="embeddableWidgets" role="tablist">
    <?php foreach ($widgetsArray as $name => $widget) { ?>
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
    <?php foreach ($widgetsArray as $name => $widget) { ?>
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

<script type="text/javascript" src="<?= asset('vendor/embeddable/js/widget-builder.js'); ?>"></script>
