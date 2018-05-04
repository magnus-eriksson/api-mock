<?php $this->layout('layout') ?>

    <h1>Resource: <?= $resource->id ? $this->e($resource->name) : 'New' ?></h1>

    <div id="messages"></div>

    <form method="POST" action="<?= $this->route('admin.resources.save') ?>" id="resource-form" onsubmit="return false;">

        <input type="hidden" value="<?= $resource->id ?>" id="id" name="id" />

        <div class="form-item">
            <label for="name">Name</label>
            <input type="text" value="<?= $this->e($resource->name) ?>" name="name" id="name" />
        </div>

        <div class="form-item">
            <label for="path">Path <span class="note">Without <code>"/api"</code></span></label>
            <input type="text" value="<?= $this->e($resource->path) ?>" name="path" id="path" />
        </div>

        <div class="form-item">
            <label for="response">Response <span class="note">Use Json format</span></label>
            <textarea rows="1" name="content" id="response"><?= $this->e($resource->content) ?></textarea>
        </div>

        <div class="form-item buttons">
            <button type="submit" id="resource-submit">Save</button>
            <button type="button" class="danger <?= !$resource->id ? 'hidden' : '' ?>" id="resource-delete" data-url="<?= $this->route('admin.resources.delete') ?>">Delete</button>
        </div>



    </form>