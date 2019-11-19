<?php
/**
 * Created by PhpStorm.
 * User: leiviton.silva
 * Date: 17/04/2019
 * Time: 16:03
 */

namespace Stock\Services;

use Illuminate\Support\Facades\DB;
use Stock\Repositories\ExtensionRepository;
use Stock\Repositories\NewsRepository;

class ExtensionsService
{
    /**
     * @var ExtensionRepository
     */
    private $repository;

    /**
     * ExtensionsService constructor.
     * @param ExtensionRepository $repository
     */
    public function __construct(ExtensionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getId($id)
    {
        return $this->repository->skipPresenter(false)->find($id);
    }

    /**
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    public function create($data)
    {
        DB::beginTransaction();
        try {

            $result = $this->repository->create($data);

            DB::commit();

            return ['status' => 'success'];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    /**
     * @return mixed
     */
    public function getNews()
    {
        return $this->repository->skipPresenter(false)->paginate(15);
    }

    /**
     * @param $id
     * @param $data
     * @return array
     */
    public function update($id, $data) {
        DB::beginTransaction();
        try {

            $result = $this->repository->update($data,$id);

            DB::commit();

            return ['status' => 'success', 'id' => $id];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }
}
