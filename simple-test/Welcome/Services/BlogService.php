<?php

namespace Services;

use Repositories\BlogRepository;

class BlogService
{
    protected $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function show()
    {
        $result = [];

        $result = $this->blogRepository->show();

        return $result;
    }

    public function create()
    {
        $result = [];

        if (isset($_POST['create'])) {
            // Get the form data
            $contentVn = $_POST['content-vn'];
            $contentEn = $_POST['content-en'];

            $result = $this->blogRepository->create($contentVn, $contentEn);
        }

        return $result;
    }

    public function detail($id)
    {
        $result = [];

        $result = $this->blogRepository->detail($id);

        return $result;
    }

    public function edit($id)
    {
        $result = [];

        $result = $this->blogRepository->edit($id);

        return $result;
    }

    public function delete($id)
    {
        $result = [];

        $result = $this->blogRepository->delete($id);

        return $result;
    }
}
