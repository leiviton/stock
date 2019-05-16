<?php
/**
 * Created by PhpStorm.
 * User: leiviton.silva
 * Date: 17/04/2019
 * Time: 16:03
 */

namespace Stock\Services;

use Illuminate\Support\Facades\DB;
use Stock\Repositories\CompanyRepository;
use Stock\Repositories\ProtocolRepository;

class ProtocolService
{
    /**
     * @var ProtocolRepository
     */
    private $repository;
    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    /**
     * CompanyService constructor.
     * @param ProtocolRepository $repository
     * @param CompanyRepository $companyRepository
     */
    public function __construct(ProtocolRepository $repository, CompanyRepository $companyRepository)
    {
        $this->repository = $repository;
        $this->companyRepository = $companyRepository;
    }

    /**
     * @param $cnpj
     * @return mixed
     */
    public function getProtocols($id)
    {
        $company = $this->companyRepository->find($id);
        return $this->repository->skipPresenter(false)->getProtocolsCompany($company->cnpj);
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
     */
    public function create($data)
    {
        DB::beginTransaction();
        try {

            $result = $this->repository->create($data);

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
