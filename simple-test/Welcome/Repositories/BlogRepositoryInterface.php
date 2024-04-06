<?php

namespace Repositories;

interface BlogRepositoryInterface
{
    public function show();
    public function detail($id);
    public function create($contentVn, $contentEn);
    public function edit($id);
    public function delete($id);
}
