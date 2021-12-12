<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table            = 'posts';
    protected $returnType       = 'array';

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';

    protected $allowedFields = ['title', 'slug', 'body', 'image'];

    // method get post
    public function getRecord($slug = false)
    {
        // jika tidak ada slug
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function search($keyword)
    {
        return $this->table('posts')->like('title', $keyword)->orLike('body', $keyword);
    }

    public function uniqueSlug($slug)
    {
        $postExist = $this->where(['slug' => $slug])->first();
        if (empty($postExist)) {
            return true;
        }
        return false;
    }
}
