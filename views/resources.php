<?php $this->layout('layout') ?>

    <h1>Resource</h1>

    <div id="resources">

        <?php foreach ($resources as $resource) : ?>

        <div class="item">

            <div class="name">
                <a href="<?= $this->route('admin.resources.edit', [$resource->id]) ?>"><?= $this->e($resource->name) ?></a>
            </div>

            <div class="path">
                <a href="/api<?= $resource->path ?>" target="_blank"><?= $this->e($resource->path) ?></a>
            </div>

        </div>

        <?php endforeach ?>

        <?php if (!$resources) : ?>

            <div id="no-results">No resources added yet</div>

        <?php endif ?>

    </div>
