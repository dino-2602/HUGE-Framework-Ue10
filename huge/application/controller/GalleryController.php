<?php
/**
 * Class GalleryController
 *
 * Handles user actions related to image management in the gallery:
 * - Displaying the gallery overview
 * - Uploading images
 * - Showing a specific image
 * - Sharing/unsharing images
 * - Downloading images
 * - Deleting images
 */
class GalleryController extends Controller
{
    /**
     * Constructor to initialize the parent Controller and check authentication.
     */
    public function __construct()
    {
        parent::__construct();
        Auth::checkAuthentication();
    }

    /**
     * Renders the gallery overview page.
     * Fetches the user's images and public images from the model,
     * and passes them to the view for rendering.
     */
    public function index()
    {
        $userId = Session::get('user_id');
        $userImages = GalleryModel::getUserImages($userId);
        $publicImages = GalleryModel::getPublicImages();

        $this->View->render('gallery/index', [
            'userImages' => $userImages,
            'publicImages' => $publicImages
        ]);
    }

    /**
     * Handles the image upload process:
     * - Verifies if the uploaded file is a valid image (JPG/JPEG).
     * - Moves the file to the target directory.
     * - Saves the image data in the database using the model.
     * - Sets feedback messages accordingly.
     */
    public function upload()
    {
        $userId = Session::get('user_id');
        $targetDir = Config::get('PATH_USERPICTURES') . $userId . '/';

        // If the user folder does not exist, create it.
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Destination path for the uploaded file
        $targetFile = $targetDir . basename($_FILES['fileToUpload']['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if it is a valid image
        $check = getimagesize($_FILES['fileToUpload']['tmp_name']);
        if ($check === false) {
            Session::add('feedback_negative', 'Die Datei ist kein Bild.');
            Redirect::to('gallery/index');
            return;
        }

        // Allow only JPG/JPEG
        if ($imageFileType !== 'jpg' && $imageFileType !== 'jpeg') {
            Session::add('feedback_negative', 'Nur JPG-Dateien sind erlaubt.');
            Redirect::to('gallery/index');
            return;
        }

        // Move uploaded file to the target folder
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFile)) {
            $hashCode = hash('sha256', uniqid());
            GalleryModel::saveImage($userId, basename($targetFile), $hashCode);
            Session::add('feedback_positive', 'Bild erfolgreich hochgeladen.');
        } else {
            Session::add('feedback_negative', 'Fehler beim Hochladen des Bildes.');
        }

        Redirect::to('gallery/index');
    }

    /**
     * Displays an image in the browser.
     * If the file exists, it sends the image content to the browser directly.
     *
     * @param int $imageId The ID of the image to display.
     */
    public function showPicture($imageId)
    {
        $image = GalleryModel::getImageById($imageId);

        if (!$image) {
            Session::add('feedback_negative', 'Bild nicht gefunden.');
            Redirect::to('gallery/index');
            return;
        }

        $filePath = Config::get('PATH_USERPICTURES') . $image->user_id . '/' . $image->file_name;

        if (file_exists($filePath)) {
            header('Content-Type: image/jpeg');
            readfile($filePath);
            exit; // Stop further script execution to directly output the image
        } else {
            Session::add('feedback_negative', 'Bild konnte nicht angezeigt werden.');
            Redirect::to('gallery/index');
        }
    }

    /**
     * Marks an image as public (is_public = 1).
     *
     * @param int $imageId The ID of the image to share.
     */
    public function share($imageId)
    {
        GalleryModel::makeImagePublic($imageId);
        Session::add('feedback_positive', 'Bild wurde freigegeben.');
        Redirect::to('gallery/index');
    }

    /**
     * Marks an image as private (is_public = 0).
     *
     * @param int $imageId The ID of the image to unshare.
     */
    public function unshare($imageId)
    {
        GalleryModel::makeImagePrivate($imageId);
        Session::add('feedback_positive', 'Freigabe wurde zurückgenommen.');
        Redirect::to('gallery/index');
    }

    /**
     * Allows downloading of an image.
     * Sets the appropriate headers to force download of the requested image.
     *
     * @param int $imageId The ID of the image to download.
     */
    public function download($imageId)
    {
        $image = GalleryModel::getImageById($imageId);

        if (!$image) {
            Session::add('feedback_negative', 'Bild nicht gefunden.');
            Redirect::to('gallery/index');
            return;
        }

        $filePath = Config::get('PATH_USERPICTURES') . $image->user_id . '/' . $image->file_name;

        if (file_exists($filePath)) {
            // Send appropriate headers to trigger file download in the browser
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            exit; // Important to stop further execution and complete download
        } else {
            Session::add('feedback_negative', 'Bild konnte nicht heruntergeladen werden.');
            Redirect::to('gallery/index');
        }
    }

    /**
     * Deletes an image from both the file system and database.
     *
     * @param int $imageId The ID of the image to delete.
     */
    public function delete($imageId)
    {
        $image = GalleryModel::getImageById($imageId);

        if (!$image) {
            Session::add('feedback_negative', 'Bild nicht gefunden.');
            Redirect::to('gallery/index');
            return;
        }

        $filePath = Config::get('PATH_USERPICTURES') . $image->user_id . '/' . $image->file_name;

        if (file_exists($filePath)) {
            unlink($filePath);
            GalleryModel::deleteImage($imageId);
            Session::add('feedback_positive', 'Bild wurde gelöscht.');
        } else {
            Session::add('feedback_negative', 'Bild konnte nicht gelöscht werden.');
        }

        Redirect::to('gallery/index');
    }
}
