<?php

namespace Controllers;

use Services\BlogService;

class BlogController
{
    protected $blogService;
    protected $pathViewBlog;
    protected $pathMultipleText;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
        $this->pathViewBlog = __DIR__ . '/../Views/Blogs';
    }

    public function show()
    {
        $blogs = $this->blogService->show();

        require_once __DIR__ . '/../Configs/MultipleText.php';
        require_once $this->pathViewBlog . '/MainBlog.php';
    }

    public function detail($id, $language)
    {
        $blog = $this->blogService->detail($id);

        require_once __DIR__ . '/../Configs/MultipleText.php';
        require_once $this->pathViewBlog . "/DetailBlog.php";
    }

    public function create()
    {
        $this->blogService->create();

        header("Location: /blog");
    }

    public function edit($id)
    {
        $this->blogService->edit($id);

        header("Location: /blog");
    }

    public function delete($id)
    {
        $this->blogService->delete($id);

        header("Location: /blog");
    }
}
