<?php
/**
 * Class GalleryModel
 *
 * Handles database operations for the gallery:
 * - Fetching user-specific images
 * - Fetching public images
 * - Saving images
 * - Making images public/private
 * - Deleting images
 */
class GalleryModel
{
    /**
     * Retrieves all images for a given user ID.
     *
     * @param int $userId The user ID for which to retrieve images.
     * @return array An array of image records from the database.
     */
    public static function getUserImages($userId): array
    {
        $db = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM gallery WHERE user_id = :user_id";
        $query = $db->prepare($sql);
        $query->execute([':user_id' => $userId]);

        return $query->fetchAll();
    }

    /**
     * Retrieves a single image by its ID.
     *
     * @param int $imageId The ID of the image to fetch.
     * @return mixed Returns the image record as an object or false if not found.
     */
    public static function getImageById($imageId)
    {
        $db = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM gallery WHERE id = :id";
        $query = $db->prepare($sql);
        $query->execute([':id' => $imageId]);

        return $query->fetch();
    }

    /**
     * Saves a new image to the database.
     *
     * @param int $userId   The user ID to associate with the image.
     * @param string $fileName The filename of the uploaded image.
     * @param string $hashCode A unique hash code for the image record.
     * @return void
     */
    public static function saveImage($userId, $fileName, $hashCode)
    {
        $db = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO gallery (user_id, file_name, hash_code)
                VALUES (:user_id, :file_name, :hash_code)";
        $query = $db->prepare($sql);
        $parameters = [
            ':user_id'   => $userId,
            ':file_name' => $fileName,
            ':hash_code' => $hashCode
        ];
        $query->execute($parameters);
    }

    /**
     * Sets an image to public (is_public = 1).
     *
     * @param int $imageId The ID of the image to make public.
     * @return void
     */
    public static function makeImagePublic($imageId)
    {
        $db = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE gallery 
                SET is_public = 1 
                WHERE id = :id";
        $query = $db->prepare($sql);
        $query->execute([':id' => $imageId]);
    }

    /**
     * Sets an image back to private (is_public = 0).
     *
     * @param int $imageId The ID of the image to make private.
     * @return void
     */
    public static function makeImagePrivate($imageId)
    {
        $db = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE gallery 
                SET is_public = 0
                WHERE id = :id";
        $query = $db->prepare($sql);
        $query->execute([':id' => $imageId]);
    }

    /**
     * Deletes an image record from the database.
     *
     * @param int $imageId The ID of the image to delete.
     * @return void
     */
    public static function deleteImage($imageId)
    {
        $db = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM gallery 
                WHERE id = :id";
        $query = $db->prepare($sql);
        $query->execute([':id' => $imageId]);
    }

    /**
     * Retrieves all images that are marked as public (is_public = 1).
     *
     * @return array An array of public image records from the database.
     */
    public static function getPublicImages(): array
    {
        $db = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM gallery WHERE is_public = 1";
        $query = $db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
}
