<?php

namespace Repositories;

use Models\Blog;
use Repositories\BlogRepositoryInterface;

class BlogRepository implements BlogRepositoryInterface
{
    protected $blog;

    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    public function show()
    {
        try {
            $result = $this->blog->getAllBlog();
        } catch (\Throwable $th) {
            $result = [
                "message" => $th->getMessage(),
                "status" => "fail"
            ];
        }

        return $result;
    }

    public function create($contentVn, $contentEn)
    {
        try {
            $result = $this->blog->createBlogByContents($contentVn, $contentEn);
        } catch (\Throwable $th) {
            $result = [
                "message" => $th->getMessage(),
                "status" => "fail"
            ];
        }

        return $result;
    }

    public function detail($id)
    {
        try {
            $result = $this->blog->getDetailBlogById($id);
        } catch (\Throwable $th) {
            $result = [
                "message" => $th->getMessage(),
                "status" => "fail"
            ];
        }

        return $result;
    }

    public function edit($id)
    {
        try {
            $result = $this->blog->editBlogById($id);
        } catch (\Throwable $th) {
            $result = [
                "message" => $th->getMessage(),
                "status" => "fail"
            ];
        }

        return $result;
    }

    public function delete($id)
    {
        try {
            $result = $this->blog->deleteBlogById($id);
        } catch (\Throwable $th) {
            $result = [
                "message" => $th->getMessage(),
                "status" => "fail"
            ];
        }

        return $result;
    }
}
