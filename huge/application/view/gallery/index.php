<?php
/**
 * This file serves as the main view for the gallery page.
 * It displays the user's private images and the public gallery images.
 * Users can upload, delete, share, and unshare their images.
 */
?>
<div class="gallery-container-page">
    <div class="container">
        <h1>Galerie</h1>

        <?php $this->renderFeedbackMessages(); ?>

        <div class="gallery-container">
            <!-- Left column: User's private gallery -->
            <div class="user-gallery">
                <h3>Meine Bilder</h3>
                <ul>
                    <?php if (!empty($this->userImages)) : ?>
                        <?php foreach ($this->userImages as $image): ?>
                            <li>
                                <!-- Thumbnail is clickable, leading to showPicture method -->
                                <a href="<?= Config::get('URL') . 'gallery/showPicture/' . htmlentities($image->id) ?>" target="_blank">
                                    <img src="<?= Config::get('URL_PUBLIC')
                                    . 'user_pictures/'
                                    . htmlentities(Session::get('user_id'))
                                    . '/'
                                    . htmlentities($image->file_name) ?>"
                                         alt="Bild" class="thumbnail">
                                </a>

                                <!-- Form to delete the image -->
                                <form action="<?= Config::get('URL') . 'gallery/delete/' . htmlentities($image->id) ?>"
                                      method="post" class="delete-form">
                                    <button type="submit">Löschen</button>
                                </form>

                                <!-- Form to share/unshare the image -->
                                <?php if (empty($image->is_public)) : ?>
                                    <!-- Share the image if not public -->
                                    <form action="<?= Config::get('URL')
                                    . 'gallery/share/'
                                    . htmlentities($image->id) ?>"
                                          method="post" class="share-form">
                                        <button type="submit">Freigeben</button>
                                    </form>
                                <?php else : ?>
                                    <!-- Revoke sharing if image is public -->
                                    <form action="<?= Config::get('URL')
                                    . 'gallery/unshare/'
                                    . htmlentities($image->id) ?>"
                                          method="post" class="unshare-form">
                                        <button type="submit">Freigabe zurücknehmen</button>
                                    </form>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li>Keine eigenen Bilder gefunden.</li>
                    <?php endif; ?>
                </ul>

                <!-- Form to upload a new image -->
                <form action="<?= Config::get('URL') . 'gallery/upload' ?>" method="post" enctype="multipart/form-data">
                    <label for="fileToUpload">Neues Bild hochladen (nur jpg/jpeg):</label>
                    <input type="file" name="fileToUpload" id="fileToUpload" accept="image/jpeg">
                    <button type="submit">Hochladen</button>
                </form>
            </div>

            <!-- Right column: Public gallery -->
            <div class="public-gallery">
                <h3>Öffentliche Galerie</h3>
                <ul>
                    <?php if (!empty($this->publicImages)) : ?>
                        <?php foreach ($this->publicImages as $image): ?>
                            <li>
                                <!-- Public image link -->
                                <a href="<?= Config::get('URL') . 'gallery/showPicture/' . htmlentities($image->id) ?>"
                                   target="_blank">
                                    <img src="<?= Config::get('URL_PUBLIC')
                                    . 'user_pictures/'
                                    . htmlentities($image->user_id)
                                    . '/'
                                    . htmlentities($image->file_name) ?>"
                                         alt="Bild" class="thumbnail">
                                </a>

                                <!-- Form to download the public image -->
                                <form action="<?= Config::get('URL')
                                . 'gallery/download/'
                                . htmlentities($image->id) ?>"
                                      method="post" class="download-form">
                                    <button type="submit">Herunterladen</button>
                                </form>
                            </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li>Keine öffentlichen Bilder vorhanden.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
