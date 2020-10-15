<?php

namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Media extends Model
    {
        protected $table = 'medias';

        protected $fillable = [
            'filename', 'type', 'mimetype',
        ];

        public function getMimeType()
        {
            return $this->mimetype;
        }

        public function getFilename()
        {
            return $this->filename;
        }

        public function getType()
        {
            return strtolower($this->type);
        }

        public function isVideo()
        {
            return $this->getType() == 'video';
        }

        public function isImage()
        {
            return $this->getType() == 'image';
        }

        public function isAudio()
        {
            return $this->getType() == 'audio';
        }
    }
