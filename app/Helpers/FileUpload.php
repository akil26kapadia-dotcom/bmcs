<?php

namespace App\Helpers;

/**
 * Validates and stores uploaded files defensively: never trusts the
 * client-supplied MIME type or extension, checks the real file bytes
 * with finfo, and always writes under a randomly generated filename.
 */
class FileUpload
{
    /**
     * SVG is deliberately excluded: it can embed <script> and event-handler
     * attributes that execute if the uploaded file is ever opened directly
     * (not just used inside an <img> tag), which is a real stored-XSS vector
     * for a public upload directory.
     */
    private const ALLOWED_MIME_TO_EXT = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
        'image/gif' => 'gif',
    ];

    private const MAX_BYTES = 5 * 1024 * 1024; // 5MB

    /**
     * @param array $file A single entry from $_FILES
     * @return string[] Validation error messages (empty array = valid)
     */
    public static function validate(array $file): array
    {
        $errors = [];

        if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            $errors[] = 'Upload failed. Please try again.';
            return $errors;
        }

        if (($file['size'] ?? 0) > self::MAX_BYTES) {
            $errors[] = 'File exceeds the 5MB size limit.';
        }

        if (!is_uploaded_file($file['tmp_name'] ?? '')) {
            $errors[] = 'Invalid upload.';
            return $errors;
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $realMime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!isset(self::ALLOWED_MIME_TO_EXT[$realMime])) {
            $errors[] = 'Unsupported file type.';
        }

        return $errors;
    }

    private const VIDEO_MIME_TO_EXT = ['video/mp4' => 'mp4', 'video/webm' => 'webm'];
    private const VIDEO_MAX_BYTES = 25 * 1024 * 1024; // 25MB

    /**
     * Same defensive checks as validate(), for short background videos
     * (MP4/WebM only, real bytes checked with finfo, 25MB limit).
     *
     * @return string[]
     */
    public static function validateVideo(array $file): array
    {
        if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            return ['Video upload failed. It may be larger than the server allows.'];
        }
        if (($file['size'] ?? 0) > self::VIDEO_MAX_BYTES) {
            return ['Video exceeds the 25MB size limit.'];
        }
        if (!is_uploaded_file($file['tmp_name'] ?? '')) {
            return ['Invalid upload.'];
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $realMime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        return isset(self::VIDEO_MIME_TO_EXT[$realMime]) ? [] : ['Unsupported video type — use MP4 or WebM.'];
    }

    public static function storeVideo(array $file, string $destinationDir): string
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $realMime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        $filename = bin2hex(random_bytes(16)) . '.' . (self::VIDEO_MIME_TO_EXT[$realMime] ?? 'mp4');
        move_uploaded_file($file['tmp_name'], rtrim($destinationDir, '/') . '/' . $filename);

        return $filename;
    }

    /**
     * Stores a validated file under a random, safe filename.
     * Call validate() first; this does not re-validate.
     */
    public static function store(array $file, string $destinationDir): string
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $realMime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        $extension = self::ALLOWED_MIME_TO_EXT[$realMime] ?? 'bin';
        $filename = bin2hex(random_bytes(16)) . '.' . $extension;

        $destination = rtrim($destinationDir, '/') . '/' . $filename;
        move_uploaded_file($file['tmp_name'], $destination);

        return $filename;
    }
}
