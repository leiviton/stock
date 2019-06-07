<?php
/**
 * Created by PhpStorm.
 * User: leiviton.silva
 * Date: 17/04/2019
 * Time: 16:03
 */

namespace Stock\Services;

use Stock\Repositories\CompanyRepository;
use Illuminate\Support\Facades\DB;

class CompanyService
{
    /**
     * @var CompanyRepository
     */
    private $repository;

    /**
     * CompanyService constructor.
     * @param CompanyRepository $repository
     */
    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function getStock($limit)
    {

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

            //$result->configuration_fiscal()->create($data['config_fiscal']);

            DB::commit();

            return ['status' => 'success', 'id' => $result->id];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    /**
     * @return mixed
     */
    public function getCompanies()
    {
        return $this->repository->skipPresenter(false)->paginate();
    }
}
